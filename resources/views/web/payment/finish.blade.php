@extends('web.app')
@section('title','Pemesanan Paket Berhasil | ')
@section('content')
<style media="screen">
@media (max-width:768px) {
    .section-content{
      min-height: 300px;
      padding-top: 50px;
    }
}
@media (min-width:768px) {
    .section-content{
      min-height: 460px;
      padding-top: 50px;
    }
}

  .section-content h3{
    font-weight: 700;
    color: #777;
    letter-spacing: 2px;
  }
  .section-content .pay-desc{
    color: #777;
    letter-spacing: 1px;
    line-height: 1.5;
    margin: 25px 0px;
  }
</style>
<div class="section-content">

  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3 text-center ">

        <h3>Pemesanan Tutorial Telah Berhasil! </h3>
	<center><img src="/template/web/img/finish-payment/thumbs-up.jpg" class="img-responsive" alt="finish payment cilsy" style="width:237px;height:141px;"></center>	
        <p class="pay-desc" align="justify">
	Selanjutnya silahkan lakukan pembayaran dengan mengikuti petunjuk pembayaran dari invoice yang sudah anda dapatkan melalui email atau ikuti halaman berikut : <a href="{{ url('petunjuk') }}">Petunjuk Pembayaran</a>.
<br><br>Setelah membayar, tutorial yang Anda beli akan langsung tersedia di menu <a href="{{ url('member/dashboard') }}">Tutorial Saya</a> <b>tanpa perlu konfirmasi</b>. 
<br><br>Jika mengalami kesulitan pembayaran, bisa langsung kontak ke whatsapp 089630713487 atau email ke support@cilsy.id.
<br><br><b>nb : Khusus bagi yang membayar via kartu kredit dan sukses, maka Tutorial yang anda beli sudah aktif dan dapat Anda nikmati.</b></p>
        <a href="{{ url('member/dashboard') }}" class="btn btn-info">Mulai Belajar</a>
	<br>
	<br>
      </div>
    </div>
  </div>

</div>

<script>
fbq('track', 'Purchase', {
value: {{ $invoice->price }},
currency: 'IDR'
});
</script>
<script>
{{--  fbq('track', 'Purchase');  --}}

/* hapus cart*/
localStorage.removeItem('cart')
</script>
@endsection
