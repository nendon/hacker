@extends('web.app')
@section('title','Petunjuk Pembayaran | ')
@section('description', 'Ini Halaman Petunjuk Pembayaran')
@section('content')
<style>
.centered-pills { text-align:center; }
.centered-pills ul.nav-pills { display:inline-block; }
.centered-pills li { display:inline; }
.centered-pills a { float:left; }
@media(max-width: 768px) {
	.centered-pills { text-align:center; }
}
.videoWrapper {
	position: relative;
	padding-bottom: 56.25%; /* 16:9 */
	padding-top: 25px;
	height: 0;
}
.videoWrapper iframe {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}
</style>
@push('css')
@endpush

<section class="intro">
  <div class="container">
    <h1 style="text-align: center;">Petunjuk Cara Pembayaran</h1>
    <h4 style="text-align: center;">Biarkan kami membantu anda menyelesaikan pembayaran</h4>
  </div>
</section>
<div class="container">
	<section class="faq mb-50 pl-15">
<div class="row" style="margin-top:20px;">
  <div class="span12 centered-pills">
    <ul class="nav nav-pills">
      <li class="active"><a data-toggle="pill" href="#cc" style="padding: 17px 91px;">KARTU KREDIT</a></li>
      <li class="dropdown">
	    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 17px 91px;">TRANSFER BANK
	    <span class="caret"></span></a>
	    <ul class="dropdown-menu">
	      <li><a data-toggle="pill" href="#mandiri" style="padding: 17px 91px;">BANK MANDIRI</a></li>
	      <li><a data-toggle="pill" href="#bca" style="padding: 17px 91px;">BANK BCA</a></li>
	      <li><a data-toggle="pill" href="#bri" style="padding: 17px 91px;">BANK BRI</a></li>
	      <li><a data-toggle="pill" href="#bni" style="padding: 17px 91px;">BANK BNI</a></li>
	      <!--<li><a data-toggle="pill" href="#permata" style="padding: 17px 91px;">BANK PERMATA</a></li>-->
	      <li><a data-toggle="pill" href="#bersama" style="padding: 17px 91px;">BANK LAINNYA (Selain Bank Diatas)</a></li> 
	    </ul>
	  	</li>
    </ul>
  </div>
</div>
<div class="tab-content">
	<div id="mandiri" class="tab-pane fade">
	<div class="col-md-6">
	Langkah Langkah Membayar menggunakan Bank Mandiri<br>
	</div>
	<div class="col-md-6">
		<ol>
			<li>
				<b>Pilih Pembayaran ATM/Bank Transfer</b> <br>
				<img class="img-responsive" src="{{ asset('template/web/img/step-1-mandiri.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Pilih Mandiri</b><br>
				<img class="img-responsive" src="{{ asset('template/web/img/step-2-mandiri.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Klik Lihat Nomor Rekening</b>
				<img class="img-responsive" src="{{ asset('template/web/img/step-3-mandiri.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Catat Nomor rekening/Kode Bayar dan Kode Perusahaan untuk melanjutkan pembayaran melalui ATM/Internet Banking Mandiri. Klik Selesai</b>
				<img class="img-responsive" src="{{ asset('template/web/img/step-4-mandiri.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Segera lakukan pembayaran dalam waktu 24 jam.  Jika Anda membayar menggunakan ATM Mandiri Anda bisa mengikuti video berikut :
					<div class="videoWrapper">
						<iframe width="560" height="349" src="https://www.youtube.com/embed/_h_7TAKp75Y" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
                                Jika Anda membayar menggunakan Internet Banking Mandiri : 
                               <div class="videoWrapper"> <iframe width="560" height="349" src="https://www.youtube.com/embed/2mJIELuoUdM" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					</div>
                        Setelah pembayaran dilakukan, Akun Anda sudah otomatis aktif tanpa perlu melakukan Konfirmasi Pembayaran. </b>
			</li>
		</ol>
		</div>
	</div>
	<div id="cc" class="tab-pane fade in active">
	<div class="col-md-6">
	Langkah Langkah Membayar menggunakan Kartu Kredit<br>
	</div>
	<div class="col-md-6">
		<ol>
			<li>
				<b>Pilih Pembayaran Kartu Kredit</b> <br>
				<img class="img-responsive" src="{{ asset('template/web/img/image-cc-1.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Isikan data kartu kredit Anda lalu klik 'BAYAR SEKARANG'</b><br>
				<img class="img-responsive" src="{{ asset('template/web/img/image-cc-2.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Pembayaran berhasil. Klik tombol Selesai.</b>
				<img class="img-responsive" src="{{ asset('template/web/img/image-cc-3.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Anda tidak diharuskan untuk melakukan konfirmasi pembayaran. Silahkan anda login kembali dan akun anda sudah aktif secara otomatis. Jika Anda masih kesulitan saat melakukan pembayaran, Anda bisa coba lihat video berikut : </b>
				<div class="videoWrapper">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/S3MnLRBwhN8" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
				</div>
				
			</li>
		</ol>	
	</div>
	</div>
	<div id="bersama" class="tab-pane fade">
	<div class="col-md-6">
	Langkah Langkah Membayar menggunakan Bank Lainnya (Jika anda menggunakan bank BJB, CIMB, Maybank, dll).<br>
	</div>
	<div class="col-md-6">
		<ol>
			<li>
				<b>Pilih Pembayaran ATM/Bank Transfer</b> <br>
				<img class="img-responsive" src="{{ asset('template/web/img/step-1-mandiri.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Pilih Bank Lainnya</b><br>
				<img class="img-responsive" src="{{ asset('template/web/img/step-2-lainnya.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Pilih Lihat Nomor Rekening</b>
				<img class="img-responsive" src="{{ asset('template/web/img/step-3-lainnya.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<!--<li>
				<b>Catat Nomor Rekening untuk melanjutkan pembayaran melalui bank anda masing-masing. Ikuti Petunjuk pada tab Bagaimana Cara Bayar untuk melakukan pembayaran. Klik Selesai</b>
				<img class="img-responsive" src="{{ asset('template/web/img/step-4-lainnya.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Invoice dan cara pembayaran akan di kirimkan melalui email. Segera lakukan pembayaran sebelum tanggal yang tercantum. Anda tidak diharuskan untuk melakukan konfirmasi pembayaran. Jika pembayaran sudah dilakukan, akan ada pemberitahuan melalui email. Setelahnya silahkan anda login kembali dan akun anda sudah aktif secara otomatis. </b>
			</li>-->
                        <li>
                                <b>Catat Nomor Rekening Bank Permata milik Cilsy Fiolution yang muncul. Jika sudah dicatat, Klik Selesai</b>
                                <img class="img-responsive" src="{{ asset('template/web/img/step-4-lainnya.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
                        </li>
                        <li>
                                <b>Segera lakukan pembayaran dalam waktu 24 jam.  Untuk Invoice dan Tata cara pembayaran yang lebih lengkap dapat Anda lihat di Email Anda. Setelah pembayaran dilakukan, Akun Anda sudah otomatis aktif tanpa perlu melakukan Konfirmasi Pembayaran. </b>
                        </li>
		</ol>
		</div>
	</div>
	<div id="bca" class="tab-pane fade">
	<div class="col-md-6">
	Langkah Langkah Membayar menggunakan Bank BCA<br>
	</div>
	<div class="col-md-6">
		<ol>
			<li>
				<b>Pilih Pembayaran ATM/Bank Transfer</b> <br>
				<img class="img-responsive" src="{{ asset('template/web/img/step-1-mandiri.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Pilih Bank Lainnya</b><br>
				<img class="img-responsive" src="{{ asset('template/web/img/step-2-lainnya.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Pilih Lihat Nomor Rekening</b>
				<img class="img-responsive" src="{{ asset('template/web/img/step-3-lainnya.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Catat Nomor Rekening Bank Permata milik Cilsy Fiolution yang muncul. Jika sudah dicatat, Klik Selesai</b>
				<img class="img-responsive" src="{{ asset('template/web/img/step-4-lainnya.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				
					<b>Segera lakukan pembayaran dalam waktu 24 jam.  Jika Anda membayar menggunakan ATM BCA Anda bisa mengikuti video berikut :
				<div class="videoWrapper"><iframe width="560" height="315" src="https://www.youtube.com/embed/OzLhzNojY_E" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
				Jika Anda membayar menggunakan Mobile Banking BCA : 
<div class="videoWrapper"><iframe width="560" height="315" src="https://www.youtube.com/embed/yxL4hVHBYWk" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
			Setelah pembayaran dilakukan, Akun Anda sudah otomatis aktif tanpa perlu melakukan Konfirmasi Pembayaran. Sebagai catatan, Anda juga dapat melihat Invoice dan Tata Cara Pembayaran di Email Anda.</b>
			
				
			</li>
		</ol>
		</div>
	</div>

	<div id="bri" class="tab-pane fade">
	<div class="col-md-6">
	Langkah Langkah Membayar menggunakan Bank BRI<br>
	</div>
	<div class="col-md-6">
		<ol>
			<li>
				<b>Pilih Pembayaran ATM/Bank Transfer</b> <br>
				<img class="img-responsive" src="{{ asset('template/web/img/step-1-mandiri.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Pilih Bank Lainnya</b><br>
				<img class="img-responsive" src="{{ asset('template/web/img/step-2-lainnya.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Pilih Lihat Nomor Rekening</b>
				<img class="img-responsive" src="{{ asset('template/web/img/step-3-lainnya.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<!--<li>
				<b>Catat Nomor Rekening untuk melanjutkan pembayaran melalui bank anda masing-masing. Ikuti Petunjuk pada tab Bagaimana Cara Bayar untuk melakukan pembayaran. Klik Selesai</b>
				<img class="img-responsive" src="{{ asset('template/web/img/step-4-lainnya.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Invoice dan cara pembayaran akan di kirimkan melalui email. Segera lakukan pembayaran sebelum tanggal yang tercantum. Anda tidak diharuskan untuk melakukan konfirmasi pembayaran. Jika pembayaran sudah dilakukan, akan ada pemberitahuan melalui email. Setelahnya silahkan anda login kembali dan akun anda sudah aktif secara otomatis. </b>
			</li>-->
			<li>
				<b>Catat Nomor Rekening Bank Permata milik Cilsy Fiolution yang muncul. Jika sudah dicatat, Klik Selesai</b>
				<img class="img-responsive" src="{{ asset('template/web/img/step-4-lainnya.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Segera lakukan pembayaran dalam waktu 24 jam.  Jika Anda membayar menggunakan ATM BRI Anda bisa mengikuti video berikut :
				<div class="videoWrapper"><iframe width="560" height="315" src="https://www.youtube.com/embed/oHFSjxYWFPs" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
				Jika Anda membayar menggunakan Internet Banking BRI : 
<div class="videoWrapper"><iframe width="560" height="315" src="https://www.youtube.com/embed/kvHhclBalJ8" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
			Setelah pembayaran dilakukan, Akun Anda sudah otomatis aktif tanpa perlu melakukan Konfirmasi Pembayaran. Sebagai catatan, Anda juga dapat melihat Invoice dan Tata Cara Pembayaran di Email Anda.</b>
			
				
			</li>
		</ol>
		</div>
	</div>

	<div id="bni" class="tab-pane fade">
	<div class="col-md-6">
	Langkah Langkah Membayar menggunakan Bank BNI<br>
	</div>
	<div class="col-md-6">
		<ol>
			<li>
				<b>Pilih Pembayaran ATM/Bank Transfer</b> <br>
				<img class="img-responsive" src="{{ asset('template/web/img/step-1-mandiri.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Pilih Bank Lainnya</b><br>
				<img class="img-responsive" src="{{ asset('template/web/img/step-2-lainnya.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Pilih Lihat Nomor Rekening</b>
				<img class="img-responsive" src="{{ asset('template/web/img/step-3-lainnya.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<!--<li>
				<b>Catat Nomor Rekening untuk melanjutkan pembayaran melalui bank anda masing-masing. Ikuti Petunjuk pada tab Bagaimana Cara Bayar untuk melakukan pembayaran. Klik Selesai</b>
				<img class="img-responsive" src="{{ asset('template/web/img/step-4-lainnya.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Invoice dan cara pembayaran akan di kirimkan melalui email. Segera lakukan pembayaran sebelum tanggal yang tercantum. Anda tidak diharuskan untuk melakukan konfirmasi pembayaran. Jika pembayaran sudah dilakukan, akan ada pemberitahuan melalui email. Setelahnya silahkan anda login kembali dan akun anda sudah aktif secara otomatis. </b>
			</li>-->
			<li>
				<b>Catat Nomor Rekening Bank Permata milik Cilsy Fiolution yang muncul. Jika sudah dicatat, Klik Selesai</b>
				<img class="img-responsive" src="{{ asset('template/web/img/step-4-lainnya.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				
					<b>Segera lakukan pembayaran dalam waktu 24 jam.  Jika Anda membayar menggunakan ATM BNI Anda bisa mengikuti video berikut :
			<div class="videoWrapper"><iframe width="560" height="315" src="https://www.youtube.com/embed/rrBWhfJR0oM" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
			Setelah pembayaran dilakukan, Akun Anda sudah otomatis aktif tanpa perlu melakukan Konfirmasi Pembayaran. Sebagai catatan, Anda juga dapat melihat Invoice dan Tata Cara Pembayaran di Email Anda.</b>
				
				
			</li>
		</ol>
		</div>
	</div>
	<!--<div id="permata" class="tab-pane fade">
	<div class="col-md-6">
	Langkah Langkah Membayar menggunakan Bank Permata
	</div>
	<div class="col-md-6">
		<ol>
			<li>
				<b>Pilih Pembayaran ATM/Bank Transfer</b> <br>
				<img class="img-responsive" src="{{ asset('template/web/img/step-1-mandiri.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Pilih Permata</b><br>
				<img class="img-responsive" src="{{ asset('template/web/img/step-2-permata.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Klik Lihat Nomor Rekening</b>
				<img class="img-responsive" src="{{ asset('template/web/img/permata-3.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Catat Nomor rekening untuk melanjutkan pembayaran melalui Bank Permata, Ikuti Petunjuk pada tab Bagaimana Cara Bayar untuk melakukan pembayaran. Klik Selesai</b>
				<img class="img-responsive" src="{{ asset('template/web/img/permata-4.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Invoice dan cara pembayaran akan di kirimkan melalui email. Segera lakukan pembayaran sebelum tanggal yang tercantum. Anda tidak diharuskan untuk melakukan konfirmasi pembayaran. Jika pembayaran sudah dilakukan, akan ada pemberitahuan melalui email. Setelahnya silahkan anda login kembali dan akun anda sudah aktif secara otomatis. </b>
			</li>
		</ol>
		</div>
	</div>-->
</div>

</section>
</div>


@push('js')



@endpush
@endsection