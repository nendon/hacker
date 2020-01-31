@extends('web.app')
@section('title','')
@section('content')

@include('web.blocks.progress')
<section class="video-information mb-50">
        <div class="container">
          <div class="row video mb-25">
           <?php if($full != null) {?>
           
              

            </div>
            <?php }else{ ?>
            <div class="col-md-12">
              <!-- Tabs -->
              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab1">Deskripsi Tutorial</a></li>
                <li><a data-toggle="tab" href="#tab2">Daftar Materi</a></li>
                <li><a data-toggle="tab" href="#tab3">Berkas Praktek</a></li>
                <li><a data-toggle="tab" href="#tab4">Diskusi</a></li>
              </ul>

              <div class="tab-content" style="margin-top:0px;">
                <div id="tab1" class="tab-pane fade in active">
                  <?= $lessons->description ?></p>
                </div>
                <div id="tab2" class="tab-pane fade">
                  <ul class="materi_list">
                    <?php foreach ($main_videos as $row) {?>
                    <li>
                      <strong><?= $row->title ?></strong>
                      <?php if ($services) {?>
                      <span class="pull-right"><a href="{{ $row->video }}" class="btn btn-info btn-md" download><i class="fa fa-download"></i> Download Video</a></span>
                      <?php }?>
                      <p><?=nl2br($row->description);?></p>
                    </li>
                  </ul>
                </div>

                <?php } ?>
                <div id="tab3" class="tab-pane fade">
                  <?php if ($services) {?>
                      @foreach($file as $key => $files)
                          <a href="{{ $files->source }}" class="btn btn-info btn-md" download><i class="fa fa-download"></i> Download {{ $files->title}}</a><br><br>
                      @endforeach
                  <?php } else {?>
                      <button type="button" name="button"  class="btn btn-info btn-md disabled"><i class="fa fa-download"></i> Download </button>
                  <?php }?>
                </div>
                <div id="tab4" class="tab-pane fade">

                  <?php if (empty(Auth::guard('members')->user()->id)) { ?>
                    <div class="text-center mb-25">
                      Silahkan <a href="{{ url('member/signin') }}" class="btn btn-primary"> Masuk</a> untuk memberikan pertanyaan
                    </div>
                  <?php	}else { ?>
                 @if ( empty($tutor))
                    <div class="text-center mb-25">
                      Fitur Diskusi hanya bisa di gunakan jika sudah melakukan pembelian
                    </div>
                  @else
                  <!-- Comment Form -->
                  <div class="comments-form mb-25">
                    <!-- <form id="form-comment" class="mb-25">
                      {{-- csrf_field() --}}
                      <input type="hidden" name="lesson_id" value="{{-- $lessons->id --}}">
                      <input type="hidden" name="parent_id" value="0"> -->
                      <div class="form-group">
                        <label>Pertanyaan</label>
                        <textarea rows="8" cols="80" class="form-control" name="body" id="textbody0"></textarea>
                      </div>
                      
                      <span id="file_progress" class="float-left"></span>
                      <a id="browse" href="javascript:;" style="float:right" class="uploader"  url="{{ url('attachment')}}" >
                       <button  type="button"  class="btn btn-warning"> <i class="fa fa-paperclip"> </i> Upload </button></a> 
                      <button type="button" class="btn btn-primary" onClick="doComment({{ $lessons->id }},0)" >Tambah Pertanyaan</button>
                      <button type="button" class="btn btn-warning" onClick="doComment({{ $lessons->id }},0)" >upload</button>
                  <!-- </form><!--./ Comment Form -->
                  </div>
                  @endif
                  <?php } ?>

                  <!-- Comments Lists -->
                  <div id="comments-lists">
                    <p>Memuat Pertanyaan . . .</p>
                  </div>
                  <!--./ Comments Lists -->



                </div>
              </div><!--./ Tabs -->

            </div>
            <?php } ?>
          </div>
          <?php if ($contributors): ?>

          <div class="row contributor mb-25">
            <div class="col-md-12">
              <!-- Panel -->
              <div class="panel panel-default">
                <div class="panel-heading">Kontributor</div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-3">
                      <?php if ($contributors->avatar): ?>
                        <img src="{{ asset($contributors->avatar) }}" alt="" class="img-responsive img-center">
                      <?php else: ?>
                        <img src="{{ asset($contributors->slug) }}" alt="" class="img-responsive img-center">
                      <?php endif; ?>
                      <div class="text-center mt-15">
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary">{{ count($contributors_total_lessons) }} Tutorial</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <strong>{{ $contributors->username }}</strong>
                      <p class="help-block">{{ $contributors->pekerjaan }}</p>
                      <a href="{{ url('contributor/profile/'.$contributors->username) }}" class="btn btn-warning mb-15">Lihat Profile</a>
                      <div class="about-text">
                        <?= $contributors->deskripsi ?>
                      </div>
                      <a href="#">Lebih Banyak</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ./Panel -->
            </div>
          </div>

          <?php endif; ?>
        </div>
      </section><!-- ./VIDEO INFORMATION -->

<script type="text/javascript">

  function dokirim(){
      var isi_kirim = $('#input_kirim').val();
      var lesson_id = '{{ $lessons->id }}';
      // alert(comment_id+' = '+isi_balas);
      var datapost = {
          '_token'    : '{{ csrf_token() }}',
          'isi_kirim' : isi_kirim,
          'lesson_id' : lesson_id
      }

      $.ajax({
          type    :'POST',
          url     :'{{ url("lessons/coments/kirimcomment") }}',
          data    :datapost,
          success:function(data){
          if(data==0){
                  window.location.href = '{{url("member/signin")}}';
          } else if (data !== 'null') {
                  // $("#row"+comment_id).load(window.location.href + " #row"+comment_id);
                  $('.content-reload').prepend(data);
              }else {
                  alert('Koneksi Bermasalah, Silahkan Ulangi');
                  location.reload();
              }
          }
      })
  }
</script>
<script type="text/javascript">
    function formbalas(comment_id){

        $('#balas'+comment_id).html('<label class="col-md-1" style="padding-left:0px;">Anda</label>'+
                                '<div class="col-md-11" style="padding-right:0px;">'+
                                '   <input type="text" class="form-control" id="input_balas'+comment_id+'" name="balasan" placeholder="tambahkan Pertanyaan/balasan" value="">'+
                                '</div>'+
                                '<a href="javascript:void(0)" class="btn btn-info pull-right" onclick="dobalas('+comment_id+')" style="float:right;margin-top:10px;">Kirim</a>');
    }

    function dobalas(comment_id){
        var isi_balas = $('#input_balas'+comment_id).val();
        var lesson_id = '{{ $lessons->id }}';
        // alert(comment_id+' = '+isi_balas);
        var datapost = {
            '_token'    : '{{ csrf_token() }}',
            'isi_balas' : isi_balas,
            'comment_id': comment_id,
            'lesson_id' : lesson_id
        }

        $.ajax({
            type    :'POST',
            url     :'{{ url("lessons/coments/postcomment") }}',
            data    :datapost,
            success:function(data){
                if (data == 1) {
                    $("#row"+comment_id).load(window.location.href + " #row"+comment_id);
                }
                else if(data==0){
                        window.location.href = '{{url("member/signin")}}';
                }else {
                    alert('Koneksi Bermasalah, Silahkan Ulangi');
                    location.reload();
                }
            }
        })
    }

    function loadcontent(){
        $(".content-reload").load(window.location.href + " .content-reload");
        console.log('reload');
    }

    // setInterval(function(){
    //     loadcontent()
    // }, 5000);
</script>
@endsection