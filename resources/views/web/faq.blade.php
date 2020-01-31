@extends('web.app')
@section('title','F.A.Q | ')
@section('description', 'Ini Halaman F.A.Q')
@section('content')
@push('css')
@endpush

<!-- BEGIN FAQ -->
<section class="intro">
  <div class="container">
    <h1 style="text-align: center;">F.A.Q</h1>
    <h4 style="text-align: center;">Biarkan kami membantu anda</h4>
  </div>
</section>
<section class="faq mb-50 pl-15">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">

                <span class="number">1</span>
                Berapa harga untuk kursus online di Cilsy?
              </a>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse collapse">
            <div class="panel-body">
            Harganya ada di kisaran Rp. 10.000 - Rp. 2.000.000 tergantung materi tutorial yang anda pilih. Untuk melihat materi apa saja yang terdapat di cilsy Anda dapat lihat link ini : <a href="{{ url('lessons/browse/all')}}"target="_blank">Browse Tutorial</a>
	    </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

      <div class="col-md-12">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2">

                <span class="number">2</span>
                Apakah kursus online ini cocok untuk pemula ?
              </a>
            </h4>
          </div>
          <div id="collapse2" class="panel-collapse collapse">
            <div class="panel-body">
              Sangat cocok. Karena materi-materi disini banyak yang dibuat bertahap mulai dari dasar sampai mahir. Anda tinggal pilih dan sesuaikan judul tutorial yang sesuai dengan kebutuhan Anda.
            </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

      <div class="col-md-12">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3">

                <span class="number">3</span>
                Apa Saya sekali bayar bisa dapat semua tutorial??
              </a>
            </h4>
          </div>
          <div id="collapse3" class="panel-collapse collapse">
            <div class="panel-body">
	   Tidak. Kursus online di Cilsy sistemnya adalah membeli per judul tutorial. Hal ini agar membuat Anda dapat lebih fokus dalam mempelajari materi yang Anda beli.
	   </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

      <div class="col-md-12">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <span class="border">&nbsp;</span>

              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                <span class="number">4</span>

                <span class="title">Apakah semua Tutorial disini bisa didownload?</span>
              </a>
            </h4>
          </div>
          <div id="collapse4" class="panel-collapse collapse">
            <div class="panel-body">
           Bisa, Anda bisa mendownload seluruh isi video maupun modul dari tutorial yang sudah Anda beli. 
	   </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>


     <div class="col-md-12">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
<span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                <span class="number">5</span>
                Apakah saya dapat semua tutorial di semua kategori ketika sudah berlangganan?
              </a>
            </h4>
          </div>
          <div id="collapse5" class="panel-collapse collapse">
            <div class="panel-body">
              Tidak. Di Cilsy sistemnya adalah beli per judul/materi tutorial. Bukan 1x bayar dapat semua materi tutorial.
            </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

     <div class="col-md-12">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
<span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                <span class="number">6</span>
                Bagaimana sistem belajar di cilsy ini?
              </a>
            </h4>
          </div>
          <div id="collapse6" class="panel-collapse collapse">
            <div class="panel-body">
              Belajar di Cilsy sangat mudah. Anda tinggal pilih judul materi yang sudah anda beli -> tonton dan praktekkan materi dari video tutorial yang kami sediakan -> kalau kesulitan/bingung bisa bertanya ke trainer Cilsy via fitur komentar di halaman tutorial yang Anda beli.
            </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

     <div class="col-md-12">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
<span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                <span class="number">7</span>
                Apakah ada jaminan saya akan dipandu sampai bisa?
              </a>
            </h4>
          </div>
          <div id="collapse7" class="panel-collapse collapse">
            <div class="panel-body">
              Ada, tim kami akan selalu siap memandu dan menjawab semua pertanyaan anda selama proses belajar anda di Cilsy.
            </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

<div class="col-md-12">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
<span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse8">
                <span class="number">8</span>
                Apakah ada materi bentuk ebooknya?
              </a>
            </h4>
          </div>
          <div id="collapse8" class="panel-collapse collapse">
            <div class="panel-body">
              Saat ini sekitar 40% materi yang ada di Cilsy sudah tersedia bentuk ebooknya. Dan kami akan terus tambahkan hingga 100%.
            </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

<div class="col-md-12">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
<span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse9">
                <span class="number">9</span>
                Apakah ada grup diskusi bersama member lain?
              </a>
            </h4>
          </div>
          <div id="collapse9" class="panel-collapse collapse">
            <div class="panel-body">
              Ada, kita punya grup diskusi di telegram. Nanti bisa anda tanyakan ke tim kami melalui chat/whatsapp/email untuk link join grupnya.
            </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

<div class="col-md-12">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
<span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse10">
                <span class="number">10</span>
                Apakah saya bisa request materi saya sendiri?
              </a>
            </h4>
          </div>
          <div id="collapse10" class="panel-collapse collapse">
            <div class="panel-body">
              Bisa. Silahkan sampaikan ke tim kami melalui chat/whatsapp/email dan kami akan segera buatkan materinya.
            </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

<div class="col-md-12">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
<span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse11">
                <span class="number">11</span>
                Bagaimana cara saya beli materi tutorial yang saya inginkan/daftar kursus onlinenya?
              </a>
            </h4>
          </div>
          <div id="collapse11" class="panel-collapse collapse">
            <div class="panel-body">
              Anda cukup mengikuti langkah di halaman ini : <a href="{{ url('carapesan')}}" target="_blank">Detil Cara Pesan</a>
            </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

<div class="col-md-12">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
<span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse12">
                <span class="number">12</span>
                Metode apa saja yang digunakan untuk pembayaran?
              </a>
            </h4>
          </div>
          <div id="collapse12" class="panel-collapse collapse">
            <div class="panel-body">
              Saat ini Anda bisa membayar via kartu kredit dan bank transfer. Untuk bayar via bank transfer, saat ini nomor rekening kami hanya tersedia untuk Bank Permata dan Bank Mandiri. Sehingga apabila anda menggunakan bank selain itu maka akan ada tambahan biaya transfer beda bank. Silahkan lihat petunjuk pembayaran disini : <a href="{{ url('petunjuk')}}"target="_blank">Petunjuk Pembayaran</a>
            </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

<div class="col-md-12">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
<span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse13">
                <span class="number">13</span>
                Jika saya sudah membayar, apakah saya perlu konfirmasi pembayaran saya?
              </a>
            </h4>
          </div>
          <div id="collapse13" class="panel-collapse collapse">
            <div class="panel-body">
              Tidak perlu. Sistem kami bisa mendeteksi secara otomatis pembayaran anda berdasarkan nomor invoice yang Anda dapatkan.
            </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

<div class="col-md-12">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
<span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse14">
                <span class="number">14</span>
		Bagaimana cara saya bisa konsultasi dengan trainer?
              </a>
            </h4>
          </div>
          <div id="collapse14" class="panel-collapse collapse">
            <div class="panel-body">
              Bisa melalui fitur komentar di halaman tutorial yang sudah Anda beli.
            </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

<div class="col-md-12">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
<span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse15">
                <span class="number">15</span>
		Bagaimana cara saya bisa minta support remote teamviewer?
              </a>
            </h4>
          </div>
          <div id="collapse15" class="panel-collapse collapse">
            <div class="panel-body">
              Saat ini Kami sudah tidak menyediakan support remote teamviewer. Fasilitas ini hanya berlaku untuk member lama Cilsy di old.cilsy.id selama masa aktif mereka masih berlaku.
            </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

<div class="col-md-12">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse16">
		<span class="number">16</span>
		Apakah tutorial yang saya beli ada masa berlakunya?
              </a>
            </h4>
          </div>
          <div id="collapse16" class="panel-collapse collapse">
            <div class="panel-body">
              Tidak ada. Tutorial yang sudah Anda beli sudah menjadi milik Anda selamanya.
            </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

    </div>

    <div class="row">
      <div class="col-md-12 text-center">
        <p>Tidak menemukan pertanyaan anda?</p>
        <p>Hubungi Kami Sekarang!</p>
        <div class="col-md-6">
          <h3>Whatsapp</h3>
          <h4>089630713487</h4>
        </div>
        <div class="col-md-6">
          <h3>Email</h3>
          <h4>halo@cilsy.id</h4>
        </div>
      </div>
    </div>
  </div>
</section><!-- ./END GUIDE -->

@push('js')



@endpush
@endsection
