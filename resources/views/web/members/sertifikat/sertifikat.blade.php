<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>CILSY INVOICE</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 2px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #5bc0de;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
        color:white;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
    @foreach($get_hist as $get_hist => $cari)
        <table cellpadding="0" cellspacing="0">
            <tr class="top" style="background:#d9edf7;">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{asset('template/web/img/logobaru.png')}}" style="max-width: 165px;">
                            </td>
                            <td>
                            <h1 style="color:#2ba8e2; text-align:right;">cilsy.id</h1>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information" style="background:#d9edf7;  font-weight: bold;">
                <td colspan="2" >
                    <table>
                        <tr>
                            <td>
                                Invoice To<br>
                                {{$cari->user}}<br>
                                {{$cari->email}}
                            </td>
                            
                            <td>
                                Tanggal {{$cari->hari}}<br>
                                Batas Pembayaran {{$cari->batas}}<br>
                                No. Invoice #{{$cari->invoice}}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            @if(!is_array($cari))
            <?php
                  $getdos = DB::table('invoice')
                  ->join('invoice_details as B', 'invoice.id', '=', 'B.invoice_id')
                  ->join('lessons as C', 'B.lesson_id', '=', 'C.id')
                  ->leftjoin('tutorial_member', function($join){
                    $join->on('C.id', '=', 'tutorial_member.lesson_id')
                    ->where('tutorial_member.member_id','=', Auth::guard('members')->user()->id);})
                  ->where('invoice.code', '=', $cari->invoice)
                  ->where('B.harga_lesson', '<>', '0')
                  ->orderBy('invoice.created_at', 'desc')
                  ->distinct()
                  ->select(['C.id as id', 'C.slug as slug', 'tutorial_member.id as ada', 'invoice.code as invoice' , 'invoice.created_at as hari', 'C.title as title', 'B.harga_lesson as harga', 'invoice.type as type', 
                  DB::raw('DATE_ADD(invoice.created_at, INTERVAL 23 HOUR) as batas') , 'invoice.status as status', 'invoice.price as total'])
                  ->get();
                ?>
              
            <tr class="heading">
                <td>
                    Rincian
                </td>
                
                <td>
                    Harga
                </td>
            </tr>
            @foreach($getdos as $tes) 
            <tr class="item">
                <td>
                {{$tes->title}}
                </td>
                
                <td>
                {{$tes->harga}}
                </td>
            </tr>
            @endforeach

            <tr class="total">
                <td></td>
                
                <td style="color:red;">
                   Subtotal Rp. {{$cari->subtotal}}<br><br>
                   Disc Rp. {{$cari->disc}}<br><br>
                   Total Rp. {{$cari->total}}
                </td>
            </tr>

           
            @endif
        </table>
       
        <p style="font-weight: bold;">Metode Pembayaran</p>
                  <p><?php if($cari->type== "bank_transfer"){ ?> Bank Transfer <?php }else{?>{{$cari->type}} <?php }?></p>
    @endforeach
    <h3 style="text-align:center;"> TERIMA KASIH ATAS KEPERCAYAAN ANDA </h3>

    </div>
</body>
</html>
