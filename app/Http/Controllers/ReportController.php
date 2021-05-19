<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Member;
use App\Models\User;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
                    
            //MENGAMBIL DATA CUSTOMER
            $customers = Member::orderBy('username', 'ASC')->get();
            //MENGAMBIL DATA USER YANG MEMILIKI ROLE KASIR
            $users = User::orderBy('name', 'ASC')->get();
            //MENGAMBIL DATA TRANSAKSI
            $orders = Invoice::orderBy('invoice.created_at', 'DESC')
            ->join('invoice_details','invoice.id','invoice_details.invoice_id' )
            ->join('members', 'invoice.members_id', 'members.id');

        
            //JIKA PELANGGAN DIPILIH PADA COMBOBOX
            if (!empty($request->id)) {
                //MAKA DITAMBAHKAN WHERE CONDITION
                $orders = $orders->where('members_id', $request->id);
            }

        
            //JIKA USER / KASIR DIPILIH PADA COMBOBOX
            if (!empty($request->user_id)) {
                //MAKA DITAMBAHKAN WHERE CONDITION
                $orders = $orders->where('members_id', $request->user_id);
            }

        
            //JIKA START DATE & END DATE TERISI
            if (!empty($request->start_date) && !empty($request->end_date)) {
                //MAKA DI VALIDASI DIMANA FORMATNYA HARUS DATE
                $this->validate($request, [
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|date'
                ]);
                
                //START & END DATE DI RE-FORMAT MENJADI Y-m-d H:i:s
                $start_date = Carbon::parse($request->start_date)->format('Y-m-d') . ' 00:00:01';
                $end_date = Carbon::parse($request->end_date)->format('Y-m-d') . ' 23:59:59';

        
                //DITAMBAHKAN WHEREBETWEEN CONDITION UNTUK MENGAMBIL DATA DENGAN RANGE
                $orders = $orders->whereBetween('invoice.created_at', [$start_date, $end_date])->get();
            } else {
                //JIKA START DATE & END DATE KOSONG, MAKA DI-LOAD 10 DATA TERBARU
                $orders = $orders->take(10)->skip(0)->get();
            }

        return view('admin.report.index', [
            'orders' => $orders,
            'sold' => $this->countItem($orders),
            'total' => $this->countTotal($orders),
            'total_customer' => $this->countCustomer($orders),
            'customers' => $customers,
            'users' => $users
        ]);
    }
    private function countCustomer(){
        $customer = [];
        //JIKA TERDAPAT DATA YANG AKAN DITAMPILKAN
        if ($orders->count() > 0) {
            //DI-LOOPING UNTUK MENYIMPAN EMAIL KE DALAM ARRAY
            foreach ($orders as $row) {
                $customer[] = $row->customer->email;
            }
        }
        return count(array_unique($customer));

    }
    private function countTotal($orders)
    {
        //DEFAULT TOTAL BERNILAI 0
        $total = 0;
        //JIKA DATA ADA
        if ($orders->count() > 0) {
            //MENGAMBIL VALUE DARI TOTAL -> PLUCK() AKAN MENGUBAHNYA MENJADI ARRAY
            $sub_total = $orders->sum('harga_lesson')->all();
            //KEMUDIAN DATA YANG ADA DIDALAM ARRAY DIJUMLAHKAN
            $total = array_sum($sub_total);
        }
        return $total;
    }
    private function countItem($order)
    {
        //DEFAULT DATA 0
        $data = 0;
        //JIKA DATA TERSEDIA
        if ($order->count() > 0) {
            //DI-LOOPING
            foreach ($order as $row) {
                //UNTUK MENGAMBIL QTY 
                $qty = $row->order_detail->sum('qty')->all();
                //KEMUDIAN QTY DIJUMLAHKAN
                $val = array_sum($qty);
                $data += $val;
            }
        } 
        return $data;
    }
    public function invoicePdf($invoice){

    }
    public function invoiceExcel($invoice){
        
    }
}
