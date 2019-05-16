@extends('web.app')
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
@section('title','Order Summary ')
@section('content')
<style>
    /* CSS used here will be applied after bootstrap.css */
    .shadow {
    -moz-box-shadow:    3px 3px 10px grey;
    -webkit-box-shadow: 3px 3px 10px grey;
    box-shadow:         3px 3px 10px grey;
    /* margin-top: 150px; */
    /* margin-bottom: 150px; */
    }
    .content-section {
        margin-bottom: 30px;
    }
    .cart-list {
        margin: 20px 0;
        font-size: 20px;
    }
    .cart-price {
        font-weight: bold;
        text-align: right
    }
    #cart-total {
        font-size: 16px;
        font-weight: bolder;
        margin-bottom: 20px;
    }
    #cart-total .row {
        border-top: 2px solid #e8e8e8;
        border-bottom: 2px solid #e8e8e8;
        padding: 20px 0;
    }
  
</style>


<div class="content-section">
    <div class="container">
    
        <div class="row">
            <div class="col-sm-12" style="margin-top: 50px;">
            </div>
        </div>

        @if($carts)
        <div class="row">
            @php
                $total = 0;
                $subtotal = 0;
            @endphp

            @if (count($carts) > 0)
              @foreach ($carts as $cart)
                <div class="col-sm-8 col-xs-12 mb-4">
                    <h3 class="mb-4">Total 1 Kelas dalam kerangjang</h3>
                    <div class="box">
                        <div class="table-responsive">
                            <table class="table cart">
                                <thead>
                                    <th>Nama Kelas</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <td style="min-width: 250px">
                                        <img src="{{ asset($cart->bootcamp->cover) }}" class="img-rounded img-thumb-cart" alt="">
                                        <h4 class="mb-0">{{ $cart->bootcamp->title }}</h4>
                                        <small>oleh {{ $cart->contributor->username }}</small>
                                    </td>
                                    <td>
                                    @if($cart->cicilan)
                                    Rp {{ number_format($cart->bootcamp->normal_price, 0, ",", ".") }}
                                    @else
                                    Rp {{ number_format($cart->bootcamp->price, 0, ",", ".") }}
                                    @endif
                                    </td>
                                    <td>
                                    <a href="browse/bootcamp">
                                    <button class="btn btn-default btn-lg">
                                            <i class="fa fa-trash"></i>
                                    </button>
                                    </a>
                                    <!-- <form action="{{ url('cart/delete/'.$cart->id)}}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button class="btn btn-default btn-lg">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form> -->
                                    </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @php
                        if($cart->cicilan){
                            $total = $cart->bootcamp->normal_price/3;
                            $subtotal = $cart->bootcamp->normal_price;

                        }else{
                        if ($cart->bootcamp_id != null && $cart->bootcamp != null) {
                            $total += $cart->bootcamp->price;
                            $subtotal += $cart->bootcamp->price;

                        }
                        else if (
                            $cart->bootcamp_id != null &&
                            $cart->bootcamp != null
                        ) {
                            $subtotal += $cart->bootcamp->price;
                            $total = $cart->bootcamp->price;
                        }
                        }
                        Session::put('subtotal', $subtotal);
                        Session::put('total', $total);
                    @endphp
                @endforeach
                @else
                <div id="cart">
                <div class="col-sm-12 well" style="width:65%;">
                    <h4>
                        <center>
                            <img src="{{ url('/template/web/img/CART.png') }}" width="80px"><br>
                            <span style="margin: 10px 0;display:block;">Keranjang Anda kosong. Silakan pilih tutorial yang Anda inginkan!</span><br>
                            <a href="{{ url('/browse/bootcamp') }}" class="btn btn-primary btn-lg" style="background-color: #3CA3E0; border:0; padding-top:20px;padding-bottom:20px">Browse Bootcamp</a>
                        </center>
                    </h4>
                </div> 
                </div>
                @endif                
                <div class="col-sm-4 col-xs-12">
                    <div class="card-blue">
                        <div class="card-title">
                        @if($cart->cicilan)
                            Cicilan
                        @else
                            Bayar Langsung
                        @endif
                        </div>
                        <div class="card-body">
                            Rincian Pembayaran
                            <hr class="my-4">
                            @if($cart->cicilan)
                            <h4 class="c-blue">Rp {{number_format($cart->bootcamp->normal_price/3)}}/ 3x Bayaran</h4>
                            <!-- <div class="rincian-cicilan-pembayaran">
                                <h5>Jadwal Pembayaran:</h5>
                                <ul>
                                    <li><h6>25 Desember 2018  <span>Rp. {{number_format($cart->bootcamp->normal_price/3)}}</span></h6></li>
                                    <div class="collapse" id="collapse-rincian-cicilan">
                                            <li><h6>26 April 2019     <span>Rp. {{number_format($cart->bootcamp->normal_price/3)}}</span></h6></li>
                                            <br>
                                            <li><h6>26 Mei 2019     <span>Rp. {{number_format($cart->bootcamp->normal_price/3)}}</span></h6></li>
                                    </div>
                                </ul>
                                <a href="#collapse-rincian-cicilan" id="tampil-rincian-cicilan" data-toggle="collapse">Tampilkan Semua</a>
                            </div> -->
                            <hr class="my-4">
                            @else
                            <h4 class="c-blue">Rp {{number_format($cart->bootcamp->price)}}/ 1x Bayaran</h4>
                            <hr class="my-4">
                            @endif
                            @if($cart->cicilan)
                            Total Sampai Lunas    <span class="pull-right"> Rp. {{ number_format($subtotal, 0, ",", ".") }}</span>

                            @else
                            Sub Total     <span class="pull-right"> Rp. {{ number_format($subtotal, 0, ",", ".") }}</span>

                            @endif
                            <div class="spacer"></div>
                            @if(!$cart->cicilan)
                            <hr class="my-4">
                            <div class="voucher-rincian-cicilan">
                            @if (! session()->has('coupon'))
                                <a class="c-blue collapsed" href="#voucher" data-toggle="collapse">Gunakan kode voucher disini</a>
                                <div class="collapse" id="voucher">
                                    <div class="input-group">
                                    <form action="{{ url('coupon') }}" method="POST" id="form">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{$subtotal}}" name="total">
                                        <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Promo Code" name="coupon_code">
                                        <span class="input-group-btn">
                                            <button class="btn" type="submit">Gunakan</button>
                                        </span>
                                        </div><!-- /input-group -->
                                    </form>
                                    
                                    </div>
                                </div>
                                @if(count($errors) > 0)
                                <div class="spacer"></div>
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{!! $error !!}</li>
                                        @endforeach
                                    </ul>
                                    </div>
                                    @endif
                                @endif
                            
                            @if (session()->has('coupon'))
                                <div class="col-md-6">
                                Diskon <span style="font-size:11px; color:blue;">{{ session()->get('coupon')['name'] }}</span>
                                <form action="{{ url('coupon/delete') }}" method="POST" style="display:inline">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit" style="font-size:14px" class="btn-link" alt="Hapus Voucher"><i class="fa fa-trash"></i></button>
                                </form>
                                </div>
                                <div class="col-md-6" style="text-align:right">
                                @if(session()->get('coupon')['type'] == 'fixed')
                                Rp. {{ number_format(session()->get('coupon')['value'], 0, ",", ".") }}
                                @elseif(session()->get('coupon')['type'] == 'percent')
                                Diskon {{ session()->get('coupon')['percent_off'] }} %
                                @endif
                                </div>
                            @endif
                             </div>
                            
                            <br><br>
                            @endif
                            <hr class="my-4">
                            @if(session()->has('coupon'))
                                @if($cart->cicilan)
                                Total <b class="pull-right">Rp. {{ number_format(getNumbers()->get('newSubtotal'), 0, ",", ".") }}</b>
                                @else
                                Total <b class="pull-right">Rp. {{ number_format(getNumbers()->get('newSubtotal'), 0, ",", ".") }}</b>
                                @endif
                            @else
                                @if($cart->cicilan)
                                Total Bayar Cicilan Pertama <b class="pull-right">Rp. {{ number_format($total, 0, ",", ".") }}</b>
                                @else
                                Total <b class="pull-right">Rp. {{ number_format($total, 0, ",", ".") }}</b>
                                @endif
                            @endif
                            <br>
                            <br>
                            @if($cart->cicilan)
                            <form action="{{ url('cicilan/checkout')}}" method="post">
                                {{ csrf_field() }}
                                <button class="btn btn-blue w-100" id="inicheckout">Bayar Sekarang</button>
                            </form>
                            @else
                            <form action="{{ url('bootcamp/checkout')}}" method="post">
                                {{ csrf_field() }}
                                <button class="btn btn-blue w-100" id="inicheckout">Bayar Sekarang</button>
                            </form>
                            @endif
                        </div>
                    </div>

                    <br><br>

                    <h4>Sudah termasuk dalam Bootcamp</h4>
                    <ul class="fitur">
                        <li><span>Ebook</span></li>
                        <li><span>Script Konfig</span></li>
                        <li><span>Video Tutorial</span></li>
                        <li><span>Team Support</span></li>

                        <li><span>FREE Download</span></li>
                        <li><span>Unlimited Time</span></li>
                        <li><span>Free Update</span></li>
                        <li><span>Sertifikat</span></li>
                    </ul>
            </div>
            <!-- batas -->
            </div>
            
        </div>
        @endif
    </div>
</div>

<script>
fbq('track', 'AddToCart');

$(function(){
          $('#footer').addClass('hide')
});
</script>

<script type="text/javascript">
  var button = document.getElementById('inicheckout');
  button.addEventListener(
    'click',
    function() {
      fbq('track', 'InitiateCheckout');
    },
    false
  );
</script>

@if (!Auth::guard('members')->user())
<script>
    $('document').ready(function(){
        var cart = localStorage.getItem('cart');
        if (cart != null) {
            var carts = JSON.parse(cart);
            if (carts.length > 0){
                var html = '';
                var total = 0;
                $.each(carts, function(k,v) {
                    html += '<div id="cart-'+v.id+'" class="col-sm-12 well shadow">';
                    html += '<div class="row cart-list">';
                    html += '<div class="col-md-2">'
                    html += '<center><img src="'+v.image+'" style="max-width:100%;max-height:100px;"></center>';
                    html += '</div>';
                    html += '<div class="col-md-7 cart-title">';
                    html += v.title;
                    html += '</div>'
                    html += '<div class="col-md-2 cart-price">';
                    html += 'Rp'+v.price.toLocaleString('id', 'idr');
                    html += '</div>';
                    html += '<div class="col-md-1">';
                    html += '<button type="button" onclick="deleteCart('+v.id+')" class="btn btn-default btn-lg"><i class="fa fa-trash"></i></button>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    total += parseInt(v.price);
                });
                $('#tutorial-total').html(carts.length);
                $('#cart').html(html);
                $('#cart-total, #cart-pay').removeClass('hide');
                $('#total-price').html('Rp'+total.toLocaleString('id', 'idr'));
                $('#total-harga').html('Rp'+total.toLocaleString('id', 'idr'));
            }
        }
    });
</script>

@endif
<script>
$(document).ready(function(){
    $("#hide").click(function(){
        document.getElementById('form').style.display = 'block';
        document.getElementById('hide').style.display = 'none';
    });
});
</script>
@endsection
