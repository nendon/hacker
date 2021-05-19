@extends('web.members.master')
@section('title','Riwayat Pembelian | ')
@section('member-content')
<style>
    .borderless td, .borderless th, .borderless thead {
        border: none;
    }
    
    table {
        border-spacing: 1;
        border-collapse: collapse;
        background: white;
        border-radius: 6px;
        overflow: hidden;
        max-width: 800px;
        width: 100%;
        margin: 0 auto;
        position: relative;
      }
      table * {
        position: relative;
      }
      table td, table th {
        padding-left: 8px;
      }
      table thead tr {
        height: 60px;
        background: #FFED86;
        font-size: 16px;
      }
      table tbody tr {
        height: 48px;
        border-bottom: 1px solid #E3F1D5;
      }
      table tbody tr:last-child {
        border: 0;
      }
      table td, table th {
        text-align: left;
      }
      table td.l, table th.l {
        text-align: right;
      }
      table td.c, table th.c {
        text-align: center;
      }
      table td.r, table th.r {
        text-align: center;
      }
      
      @media screen and (max-width: 35.5em) {
        table {
          display: block;
        }
        table > *, table tr, table td, table th {
          display: block;
        }
        table thead {
          display: none;
        }
        table tbody tr {
          height: auto;
          padding: 8px 0;
        }
        table tbody tr td {
          padding-left: 45% ;
          margin-bottom: 12px;
        }
        table tbody tr td:last-child {
          margin-bottom: 0;
        }
        table tbody tr td:before {
          position: absolute;
          font-weight: 700;
          width: 40%;
          left: 10px;
          top: 0;
        }
        table tbody tr td:nth-child(1):before {
          content: "Rincian";
        }
        table tbody tr td:nth-child(2):before {
          content: "Harga";
        }
        table tbody tr td:nth-child(3):before {
          content: "Metode Pembayaran";
        }
        table tbody tr td:nth-child(4):before {
          content: "Status";
        }
        .table tbody tr td, .table tbody tr th, .table tfoot tr td, .table tfoot tr th, .table thead tr td, .table thead tr th {
            padding: 50px;
            padding-bottom: 5px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
            /* left: 10px; */
        }
      }
      
      blockquote {
        color: white;
        text-align: center;
      }
      
</style>
<div class="col-md-12">
    <h4>Pembelian Dalam Proses</h4>
</div><br><br>
<?php if(count($get_hist) !=0){ ?>
@foreach($get_hist as $get_hist => $cari)
    @if(!empty($cari->type) )
<div class="panel panel-default">

    <div class="panel-body">
  
        <div class="col-md-6">
            <h6>{{$cari->invoice}}</h6>
            <p>{{$cari->hari}}</p>
        </div>
        <div class="col-md-6 ">
            <a class="btn pull-right" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; " href="{{ url('/petunjuk')}}" >
                Cara Pembayaran
            </a><br><br>
            <?php if($cari->disc == 0){?>
                <?php }else{ ?>
              <p class="pull-right">Potongan Diskon : {{$cari->disc}}</p><br><br>
              <?php } ?>
            <p class="pull-right">Total Bayar: {{$cari->total}}</p>         

        </div>

        <table class="table borderless">
                <thead>
                    <tr>
                    <th colspan="2">Rincian</th>
                    <th>Harga</th>
                    <th>Metode Pembayaran</th>
                    <th>Status</th>
                    </tr>
                </thead>
            @if(!is_array($cari))
            <?php
                  $getdos = DB::table('invoice')
                  ->join('invoice_details as B', 'invoice.id', '=', 'B.invoice_id')
                  ->join('lessons as C', 'B.lesson_id', '=', 'C.id')
                  ->where('invoice.code', '=', $cari->invoice)
                  ->where('B.harga_lesson', '<>', '0')
                  ->orderBy('invoice.created_at', 'desc')
                  ->distinct()
                  ->select(['invoice.code as invoice' , 'invoice.created_at as hari', 'C.title as title', 'B.harga_lesson as harga', 'invoice.type as type', 
                  DB::raw('DATE_ADD(invoice.created_at, INTERVAL 23 HOUR) as batas') , 'invoice.status as status', 'invoice.price as total'])
                  ->get();
				?>
                @foreach($getdos as $tes) 
                <tbody>
                    <tr>
                        <td colspan="2">{{$tes->title}}</td>
                        <td>{{$tes->harga}}</td>
                        <td>{{$tes->type}}</td>
                        <td><i class="fa fa-checklist"></i><?php if($tes->status == "2"){?> Waiting Payment <?php } ?> </td>
                    </tr>
                </tbody>
            @endforeach
            @endif
        </table>
        <div class="alert alert-info" style="background-color:white; color:#5bc0de;" role="alert">
				<b>Batas Pembayaran : {{$cari->batas}} </b>
		</div>
    </div>
 
  </div>
   @endif
@endforeach
<?php }else{?>
<div class="alert alert-danger" role="alert">
              Belum Pernah melakukan pemesanan
 </div>
<?php } ?>


  <div class="col-md-12">
        <h4>Pembelian Sebelumnya</h4>
    </div><br><br>
    <?php if(count($get_tot) != 0) {?>
    @foreach($get_tot as $get_tot => $cari)
    @if(!empty($cari->type) )
    <div class="panel panel-default">

    <div class="panel-body">
  
        <div class="col-md-6">
            <h6>{{$cari->invoice}}</h6>
            <p>{{$cari->hari}}</p>
        </div>
        <div class="col-md-6 ">
        <!-- <a class="btn pull-right" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; " href="{{ url('/member/invoice/'.$cari->invoice)}}" >
                Download Invoice
                </a><br><br> -->
              <?php if($cari->status == 1){?>
                <a class="btn pull-right" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; " href="{{ url('/member/invoice/'.$cari->invoice)}}" >
                Download Invoice
                </a><br><br>
              <?php }else if($cari->status == 5 || $cari->status == 4){ ?>
                <ul class="left" style="margin-left: 218px;">
                <!-- <button id="{{ $cari->invoice }}" type="button" class="btn btn-info" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; "  onclick="riway({{ $cari->invoice }})"><i class="fa fa-shopping-cart"></i>Beli Lagi</button> -->
                </ul>
              <?php } ?>
              <?php if($cari->disc == 0){?>
                <?php }else{ ?>
              <p class="pull-right">Potongan Diskon : {{$cari->disc}}</p><br><br>
              <?php } ?>
              <p class="pull-right">Total Bayar: {{$cari->total}}</p>

        </div>
       
        <table class="table borderless">
                <thead>
                    <tr>
                    <th colspan="2">Rincian</th>
                    <th>Harga</th>
                    <th>Metode Pembayaran</th>
                    <th>Status</th>
                    <?php if($cari->status == 5 || $cari->status == 4){?>
                    <th> </th>
                    <?php } ?>
                    </tr>
                </thead>
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
                @foreach($getdos as $tes) 
                <tbody>
                    <tr>
                        <td colspan="2">{{$tes->title}}</td>
                        <td>{{$tes->harga}}</td>
                        <td>{{$tes->type}}</td>
                        <td>
                        <?php if($tes->status == "1"){?> 
                        Selesai <?php }else if($tes->status == "5" || $tes->status == "4"){ ?> dibatalkan <?php }?>
                        </td>
                        
                        <?php 
                        if(!empty($tes->ada)){
                        ?>
                        <td>
                        <!-- <a href="{{ url('kelas/v3/'.$tes->slug) }}" class="btn pull-right" style="background-color:#f1c40f; color:white; padding: 6px 22px;">
                        Lihat tutorial
                        </a> -->
                        sudah memiliki
                        </td>
                         <?php }else{
                        if($tes->status == 5 || $tes->status == 4){ ?>
                        <td>
                        <button id="{{ $tes->id }}" type="button" class="btn btn-info" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; padding: 6px 31px; "  onclick="addToCart({{ $tes->id }})"><i class="fa fa-shopping-cart"></i>Beli Lagi</button>
                        </td>
                        <?php }} ?>
                    </tr>
                </tbody>
            @endforeach
            @endif
        </table>
        
    </div>
 
  </div>
@endif
@endforeach
<?php }else{?>
<div class="alert alert-danger" role="alert">
              Belum Pernah melakukan pemesanan
 </div>
<?php } ?>
@endsection