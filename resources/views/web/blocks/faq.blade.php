@push('css')


@endpush

<!-- BEGIN FAQ -->
<section class="faq mb-50 pl-15">
  <div class="container">
    <div class="row mb-25">
      <div class="col-md-12 text-center ">
        <h3>FAQ</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
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
              Harganya ada di kisaran Rp. 10.000 - Rp. 2.000.000 tergantung materi tutorial yang anda pilih. Untuk melihat materi apa saja yang terdapat di cilsy Anda dapat lihat link ini : <a href="{{ url('lessons/browse/all')}}" target="_blank">Browse Tutorial</a>
            </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

      <div class="col-md-6">
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

      <div class="col-md-6">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3">

                <span class="number">3</span>
                Apakah Saya sekali bayar bisa dapat semua tutorial?
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

      <div class="col-md-6">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <span class="border">&nbsp;</span>

              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                <span class="number">4</span>

                <span class="title">Apakah Tutorial disini bisa didownload?</span>
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

    </div>


    <div class="row">
      <div class="col-md-12 text-center">
        <a href="{{ url('/faq')}}" class="btn btn-link btn-more">Lihat semua pertanyaan <i class="ion-arrow-right-c"></i></a>
      </div>
    </div>
  </div>
</section><!-- ./END GUIDE -->

@push('js')



@endpush
