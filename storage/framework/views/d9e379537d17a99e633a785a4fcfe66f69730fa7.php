<?php $__env->startSection('title',''); ?>
<?php $__env->startSection('content'); ?>

<?php echo $__env->make('web.blocks.progress', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                      <span class="pull-right"><a href="<?php echo e($row->video); ?>" class="btn btn-info btn-md" download><i class="fa fa-download"></i> Download Video</a></span>
                      <?php }?>
                      <p><?=nl2br($row->description);?></p>
                    </li>
                  </ul>
                </div>

                <?php } ?>
                <div id="tab3" class="tab-pane fade">
                  <?php if ($services) {?>
                      <?php $__currentLoopData = $file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $files): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <a href="<?php echo e($files->source); ?>" class="btn btn-info btn-md" download><i class="fa fa-download"></i> Download <?php echo e($files->title); ?></a><br><br>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php } else {?>
                      <button type="button" name="button"  class="btn btn-info btn-md disabled"><i class="fa fa-download"></i> Download </button>
                  <?php }?>
                </div>
                <div id="tab4" class="tab-pane fade">

                  <?php if (empty(Auth::guard('members')->user()->id)) { ?>
                    <div class="text-center mb-25">
                      Silahkan <a href="<?php echo e(url('member/signin')); ?>" class="btn btn-primary"> Masuk</a> untuk memberikan pertanyaan
                    </div>
                  <?php	}else { ?>
                 <?php if( empty($tutor)): ?>
                    <div class="text-center mb-25">
                      Fitur Diskusi hanya bisa di gunakan jika sudah melakukan pembelian
                    </div>
                  <?php else: ?>
                  <!-- Comment Form -->
                  <div class="comments-form mb-25">
                    <!-- <form id="form-comment" class="mb-25">
                      
                      <input type="hidden" name="lesson_id" value="">
                      <input type="hidden" name="parent_id" value="0"> -->
                      <div class="form-group">
                        <label>Pertanyaan</label>
                        <textarea rows="8" cols="80" class="form-control" name="body" id="textbody0"></textarea>
                      </div>
                      
                      <span id="file_progress" class="float-left"></span>
                      <a id="browse" href="javascript:;" style="float:right" class="uploader"  url="<?php echo e(url('attachment')); ?>" >
                       <button  type="button"  class="btn btn-warning"> <i class="fa fa-paperclip"> </i> Upload </button></a> 
                      <button type="button" class="btn btn-primary" onClick="doComment(<?php echo e($lessons->id); ?>,0)" >Tambah Pertanyaan</button>
                      <button type="button" class="btn btn-warning" onClick="doComment(<?php echo e($lessons->id); ?>,0)" >upload</button>
                  <!-- </form><!--./ Comment Form -->
                  </div>
                  <?php endif; ?>
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
                        <img src="<?php echo e(asset($contributors->avatar)); ?>" alt="" class="img-responsive img-center">
                      <?php else: ?>
                        <img src="<?php echo e(asset($contributors->slug)); ?>" alt="" class="img-responsive img-center">
                      <?php endif; ?>
                      <div class="text-center mt-15">
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary"><?php echo e(count($contributors_total_lessons)); ?> Tutorial</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <strong><?php echo e($contributors->username); ?></strong>
                      <p class="help-block"><?php echo e($contributors->pekerjaan); ?></p>
                      <a href="<?php echo e(url('contributor/profile/'.$contributors->username)); ?>" class="btn btn-warning mb-15">Lihat Profile</a>
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
      var lesson_id = '<?php echo e($lessons->id); ?>';
      // alert(comment_id+' = '+isi_balas);
      var datapost = {
          '_token'    : '<?php echo e(csrf_token()); ?>',
          'isi_kirim' : isi_kirim,
          'lesson_id' : lesson_id
      }

      $.ajax({
          type    :'POST',
          url     :'<?php echo e(url("lessons/coments/kirimcomment")); ?>',
          data    :datapost,
          success:function(data){
          if(data==0){
                  window.location.href = '<?php echo e(url("member/signin")); ?>';
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
        var lesson_id = '<?php echo e($lessons->id); ?>';
        // alert(comment_id+' = '+isi_balas);
        var datapost = {
            '_token'    : '<?php echo e(csrf_token()); ?>',
            'isi_balas' : isi_balas,
            'comment_id': comment_id,
            'lesson_id' : lesson_id
        }

        $.ajax({
            type    :'POST',
            url     :'<?php echo e(url("lessons/coments/postcomment")); ?>',
            data    :datapost,
            success:function(data){
                if (data == 1) {
                    $("#row"+comment_id).load(window.location.href + " #row"+comment_id);
                }
                else if(data==0){
                        window.location.href = '<?php echo e(url("member/signin")); ?>';
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>