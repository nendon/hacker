<?php
namespace App\Http\Controllers\Veritrans;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Member;
use App\Models\Package;
use App\Models\TutorialMember;
use App\Models\Cart;
use App\Veritrans\Veritrans;
use DateTime;
use DB;
use Session;
use Mail;
use App\Mail\InvoiceMail;
use App\Mail\SuksesMail;
use Auth;
use Illuminate\Http\Request;
class VtwebController extends Controller {
    public $sk = 'VT-server-_cXc9tYjPxt4JEX7B7qDSQP_';
    public function __construct() {
        $secret = env('VT_SECRET_'.strtoupper(config('app.env')));
        $is_production = (config('app.env') == 'production');
        Veritrans::$serverKey = $this->sk;
        //set Veritrans::$isProduction  value to true for production mode
        Veritrans::$isProduction = true;
    }
    // public function __construct() {
    //     if(env('APP_ENV') == 'production'){
    //         Veritrans::$serverKey = 'VT-server-_cXc9tYjPxt4JEX7B7qDSQP_';
    //         //set Veritrans::$isProduction  value to true for production mode
    //         Veritrans::$isProduction = true;
    //     }else if(env('APP_ENV') == 'local'){
    //         Veritrans::$serverKey = 'VT-server-4O7hlRyievnwHHB5b0J-z-xf';
    //         //set Veritrans::$isProduction  value to true for production mode
    //         Veritrans::$isProduction = false;
    //     }
    // }

    public function vtweb() {
        $members = Auth::guard('members')->user();
        // $packages = Package::where('id', Session::get('packageID'))->first();
        $invoice = Invoice::where('code', Session::get('invoiceCODE'))->first();
        if ($members == null || $invoice == null) {
            die('Anda belum memilih paket langganan Cilsy !');
        }
        $vt = new Veritrans;
        $transaction_details = array(
            'order_id' => $invoice->code,
            'gross_amount' => $invoice->price,
        );
        // Populate items
        $items = [
            array(
                'id' => $invoice->code,
                'price' => $invoice->price,
                'quantity' => 1,
                'name' => "Pembayaran keranjang belanja Cilsy",
            ),
        ];
        // Populate customer's Info
        $customer_details = array(
            'first_name' => $members->username,
            'email' => $members->email,
        );
        // Data yang akan dikirim untuk request redirect_url.
        // Uncomment 'credit_card_3d_secure' => true jika transaksi ingin diproses dengan 3DSecure.
        $transaction_data = array(
            'payment_type' => 'vtweb',
            'vtweb' => array(
                //'enabled_payments'    => [],
                'credit_card_3d_secure' => true,
            ),
            'transaction_details' => $transaction_details,
            'item_details' => $items,
            'customer_details' => $customer_details,
        );
        try {
            $vtweb_url = $vt->vtweb_charge($transaction_data);
            return redirect($vtweb_url);
        } catch (Exception $e) {
            return $e->getMessage;
        }
    }
    public function notification(Request $r) {
        $input = $r->order_id.$r->status_code.$r->gross_amount.$this->sk;
        $signature = openssl_digest($input, 'sha512');
        /* cek request signature */
        if ($signature != $r->signature_key) {
            return response()->json([
                'status' => false,
                'message' => 'Transaction failed'
            ], 200);
        }
        
        $vt = new Veritrans;
        $notif = $vt->status($r->order_id);
        $status = $r->status_code;
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;
        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    Invoice::where('code', $order_id)->update([
                        'status' => 3,
                        'type' => $type,
                        'notes' => "Transaction order_id: " . $order_id . " is challenged by FDS",
                    ]);
                    return response()->json([
                        'status' => true
                    ], 200);
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    // Update status Invoices
                    Invoice::where('code', $order_id)->update([
                        'status' => 1,
                        'type' => $type,
                        'notes' => "Transaction order_id: " . $order_id . " successfully captured using " . $type,
                    ]);
                    // Create New Services
                    $this->create_tutorial_member($order_id);
                    $this->update_flag($order_id);
                    return response()->json([
                        'status' => true
                    ], 200);
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $invoice = Invoice::where('code', $order_id)->update([
                'status' => 1,
                'type' => $type,
                'notes' => "Transaction order_id: " . $order_id . " successfully transfered using " . $type,
            ]);
            // Create New Services
            $this->create_tutorial_member($order_id);
            $this->update_flag($order_id);
            return response()->json([
                'status' => true
            ], 200);
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            Invoice::where('code', $order_id)->update([
                'status' => 2,
                'type' => $type,
                'notes' => "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type,
            ]);
            return response()->json([
                'status' => true
            ], 200);
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            Invoice::where('code', $order_id)->update([
                'status' => 4,
                'type' => $type,
                'notes' => "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.",
            ]);
            return response()->json([
                'status' => true
            ], 200);
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'Expire'
            Invoice::where('code', $order_id)->update([
                'status' => 5,
                'type' => $type,
                'notes' => "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.",
            ]);
            return response()->json([
                'status' => true
            ], 200);
        }
        error_log(print_r($r, TRUE));
    }
    // private function send_mail($order_id) {
    //     $invoice = Invoice::where('code', $order_id)->first();
    //     $members = Member::where('id', $invoice->members_id)->first();
    //     $send = Member::findOrFail($members->id);
    //     Mail::to($members->email)->send(new InvoiceMail($send));
    // }
    private function sukses_mail($order_id) {
        $invoice = Invoice::where('code', $order_id)->first();
        $members = Member::where('id', $invoice->members_id)->first();
        $send = Member::findOrFail($members->id);
        Mail::to($members->email)->send(new SuksesMail($send));
    }
    public function create_tutorial_member($order_id)
    {
        $invoice = Invoice::where('code', $order_id)->with('details')->first();
        if ($invoice) {
            foreach ($invoice->details as $detail) {
                if($detail->lesson_id){
                $tm = TutorialMember::firstOrCreate([
                    'member_id' => $invoice->members_id,
                    'lesson_id' => $detail->lesson_id,
                ]);
                }

                if($detail->bootcamp_id){
                    $tm = BootcampMember::firstOrCreate([
                        'member_id' => $invoice->members_id,
                        'bootcamp_id' => $detail->bootcamp_id,
                    ]);
                    }
            }
            
        }
    }
    private function update_flag($order_id){
        $invoice = Invoice::where('code', $order_id)->first();
        $ud = InvoiceDetail::where('invoice_id', $invoice->id)->update(
            [
                'flag' => 0,
            ]
            );
    }
}