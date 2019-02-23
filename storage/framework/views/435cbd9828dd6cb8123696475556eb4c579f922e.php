<?php $__env->startSection('title',$lessons->title); ?>
<?php $__env->startSection('description', $lessons->description); ?>
<?php $__env->startSection('content'); ?>

<link href="<?php echo e(asset('template/web/css/landing.css')); ?>" rel="stylesheet">
<script src="https://vjs.zencdn.net/5.16.0/video.min.js"></script>

<style>
  .fa-play-circle{
    color: #2BA8E2;
  }
  .close-icon {
    webkit-appearance: none;
    appearance: none;
    position: absolute;
    top: -15px;
    right: -15px;
    width: 35px;
    height: 35px;
    color: #fff;
    font-size: 14px;
    background: #222;
    border: none;
    outline: none;
    border-radius: 50%;
    cursor: pointer;
    vertical-align: middle;
    z-index :100;
  }
</style>
<main>

  <!-- Section Header -->
  <section class="header">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-xs-12 video-preview">
          <img src="<?php echo e(asset($lessons->image)); ?>" class="img-responsive" alt="">
          <a href="#" data-toggle="modal" data-target="#ModalVideo" class="btn"><img src="<?php echo e(asset('/template/web/img/play-button.svg')); ?>" alt=""></a>
        </div>
        <div class="col-md-6 col-xs-12">
          <a href="<?php echo e(url('lessons/category/'.$categories->title)); ?>" class="btn-tag"><?php echo e($categories->title); ?></a>
          
          <h1 class="price">Rp. <?php echo e(number_format($lessons->price, 0, ",", ".")); ?></h1>
          <h2><?php echo e($lessons->title); ?></h2>
          <p><?php echo e($lessons->deskripsi_singkat); ?></p>
          <h6 class="mb-4">Oleh <?php echo e($contributors->username); ?>, Created at <?php echo e($tanggal); ?></h6>
          <a id="guest-<?php echo e($lessons->id); ?>" href="<?php echo e(url('cart')); ?>" class="btn" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; display:none" >Lihat Keranjang</a>        
          <?php if(($cart != null)){ ?>
          <a href="<?php echo e(url('cart')); ?>" class="btn btn-lg btn-primary mb-2" style="background-color:#fff; color:#5bc0de; border-color:#46b8da;" >Lihat Keranjang</a> &nbsp;&nbsp;&nbsp;       
          <?php }else{ ?>          
          <button id="beli-<?php echo e($lessons->id); ?>" class="btn btn-lg btn-primary mb-2" onclick="addToCart(<?php echo e($lessons->id); ?>)"><i class="fa fa-shopping-cart"></i> Beli Tutorial</button> &nbsp;&nbsp;&nbsp;
          <?php } ?>
        </div>
      </div>
    </div>
  </section>

  <section class="mt-5">
    <div class="container">
      <div class="row text-center" style="padding-top:20px; padding-bottom:20px;">
        <div class="col-md-4">
          <div class="col-md-4">
            <img src="<?php echo e(asset('template/web/img/video-icon.png')); ?>" alt="" height="100" width="100">
          </div>
          <div class="col-md-8">
            <h6><?php echo e(count($main_videos)); ?> Video Tutorial Eksklusif</h6>
            <p>Semua video di cilsy eksklusif dan tidak di upload di platform manapun
            </p>
          </div>
        </div>
        <div class="col-md-4">
        <div class="col-md-4">
            <img src="<?php echo e(asset('template/web/img/script.png')); ?>" alt="" height="100" width="100">
          </div>
          <div class="col-md-8">
            <h6>Modul dan Script Praktek</h6>
            <p>Dapatkan modul dan script untuk menunjang praktek anda dalam belajar di Cilsy
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="col-md-4">
              <img src="<?php echo e(asset('template/web/img/diskusi.png')); ?>" alt="" height="100" width="100">
            </div>
            <div class="col-md-8">
              <h6>Diskusi Dengan Kontributor</h6>
              <p>Kesulitan atau mendapat error? silahkan manfaatkan fitur diskusi, maka kontributor kami akan merespon pertanyaan anda
              </p>
            </div>
        </div>
      </div>

      <!-- Row -->
      <div class="row box">
        <div class="col-xs-12">
          
          <h5>Deskripsi Tutorial</h5>
          <?php echo nl2br(substr($lessons->description, 0, 400)); ?>

          <div class="collapse" id="collapseDeskripsi">
          <?php echo nl2br(substr($lessons->description, 400)); ?>

          <h5>Objektif Tutorial</h5>
          <?php echo nl2br($lessons->goal_tutorial); ?>

          </div><br>
          <a id="collapse" data-toggle="collapse" href="#collapseDeskripsi" role="button" style="color:#2BA8E2; font-weight:bold;">+ Tampilkan Lebih Banyak</a>
        </div>
      </div>

      <!-- Row -->
      <div class="row box">
        <div class="col-xs-12">
          <h5 class="mb-4">Kurikulum Tutorial</h5>
          <?php $count = 0; ?>
          <?php $__currentLoopData = $main_videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($count == 3) break; ?>
          <h6><a href="#" data-href="<?php echo e(asset($row->video)); ?>" class="showModal" data-toggle="tooltip" title="Preview Tutorial"><i class="fa fa-play-circle"></i> <?php echo e($row->title); ?></a></h6>
          <span class="pull-right" style="color:#2BA8E2;">
          <?php
          // Set our duration in seconds
          echo gmdate("i:s", $row->durasi);
          ?>
          </span>
          <?php echo nl2br($row->description); ?>

          <hr>
          <?php $count++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          <div class="collapse" id="collapseKurikulum">
              <?php $count = 0; ?>
              <?php $__currentLoopData = $main_videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($count>2): ?>
              <h6><i class="fa fa-lock"></i> <?php echo e($row->title); ?></h6>
              <span class="pull-right">
                <?php
                // Set our duration in seconds
                echo gmdate("i:s", $row->durasi);
                ?>
                </span>
              <?php echo nl2br($row->description); ?>

              <hr>
              <?php endif; ?>
              <?php $count++; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          </div>

          <a id="collapse" data-toggle="collapse" href="#collapseKurikulum" role="button" style="color:#2BA8E2; font-weight:bold;">+ Tampilkan Lebih Banyak</a>
        </div>
      </div>


      <!-- Row -->
      <div class="row box">
        <div class="col-xs-12">
          <h5>Prerequistes dan Requirements</h5>
          <?php echo nl2br($lessons->requirement); ?>


          <h5>Audiens yang dituju</h5>
          <?php echo e($lessons->audiens); ?>


          <h5>Frequently Asked Questions</h5>
          Lihat halaman <a href="/faq"> Frequently Asked Questions</a> untuk menemukan informasi tambahan atau hubungi langsung tim support kami
        </div>
      </div>

      <!-- Row -->
      <div class="row box">
        <div class="col-xs-12 mb-3">
          <b>Kontributor</b>
        </div>
        <div class="col-lg-3 col-md-4 mb-4 text-center">
            <?php if($contributors->avatar): ?>
            <img src="<?php echo e(asset($contributors->avatar)); ?>" alt="" class="img-responsive img-center mb-2">
          <?php else: ?>
            <img src="<?php echo e(asset($contributors->slug)); ?>" alt="" class="img-responsive img-center mb-2">
          <?php endif; ?>
          <div class="row">
            <div class="col-xs-12 ">
            <a href="<?php echo e(url('contributor/profile/'.$contributors->username)); ?>" class="btn" style="background-color:#fff; color:#5bc0de; border-color:#46b8da;">Lihat Profil</a>
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-8">
          <div class="col-md-2">
              <h5 style="color:#2BA8E2; font-weight:bold;"><?php echo e($contributors->username); ?></h5>
          </div>
          <div class="col-md-10">
              <h5>Tutorial</h5>
          </div>
          <div class="col-md-2">
              <h6><?php echo e($contributors->pekerjaan); ?></h6>
          </div>
          <div class="col-md-10">
              <?php echo e(count($contributors_total_lessons)); ?> 
          </div><br><br>
          <div class="col-md-12">
              <p>
                  <?php echo e($contributors->deskripsi); ?>

              </p>
              <a href="#">Lebih Banyak</a>
          </div>
              
         
          
        </div>
      </div>

      <hr>

      <!-- Row -->
      <div class="row">
        <div class="col-lg-offset-3 col-lg-6 col-md-offset-2 col-md-8 text-center mt-5">
          <h3 class="mb-4"><?php echo e($lessons->title); ?></h3>
          <a id="tamu-<?php echo e($lessons->id); ?>" href="<?php echo e(url('cart')); ?>" class="btn" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; display:none" >Lihat Keranjang</a>        
          <?php if(($cart != null)){ ?>
          <a href="<?php echo e(url('cart')); ?>" class="btn btn-lg btn-primary mb-2" style="background-color:#fff; color:#5bc0de; border-color:#46b8da;" >Lihat Keranjang</a> &nbsp;&nbsp;&nbsp;       
          <?php }else{ ?>          
          <button id="jual-<?php echo e($lessons->id); ?>" class="btn btn-lg btn-primary mb-2" onclick="addToCart(<?php echo e($lessons->id); ?>)"><i class="fa fa-shopping-cart"></i> Beli Tutorial</button> &nbsp;&nbsp;&nbsp;
          <?php } ?>
        </div>
      </div>
    </div>
  </section>

</main>


<!-- Modal -->
<div class="modal fade" id="ModalVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <a class="btn close-icon" data-dismiss="modal" ><i class="fa fa-times" aria-hidden="true"></i></a>
        <div class="modal-body p-0">
          <video width="100%" height="350" controls name="preview" controlsList="nodownload" ><source src="<?php echo e(asset($preview->video)); ?>"></video>
        </div>
        <div class="modal-body">
            <?php $count = 0; ?>
            <?php $__currentLoopData = $main_videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($count == 3) break; ?>
            <h6><i class="fa fa-play-circle"></i> <a href="#" data-href="<?php echo e(asset($row->video)); ?>" class="showModal"> <?php echo e($row->title); ?> </a></h6>
            <?php echo nl2br($row->description); ?>

            <hr>
            <?php $count++; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  fbq('track', 'ViewContent');
</script>
<script>
    var cek = localStorage.getItem('cart');
    if(cek != null){
      var results = JSON.parse(cek);
      if (results.length > 0){
        $.each(results, function(k,v) {
              $('#beli-'+v['id']).hide();
              $('#guest-'+v['id']).show();
              $('#jual-'+v['id']).hide();
              $('#tamu-'+v['id']).show();
        });
      }
    }
    <?php if($cart != null): ?>
    var cek = localStorage.getItem('cart');
    if(cek != null){
      var results = JSON.parse(cek);
      if (results.length > 0){
        $.each(results, function(k,v) {
          $('#guest-'+v['id']).hide();
          $('#tamu-'+v['id']).hide();
        });
      }
    }
    
    <?php endif; ?>

  </script>
  <script>
    $('#collapse').click(function(){ 
        $(this).text(function(i,old){
            return old=='+ Tampilkan Lebih Banyak' ?  '- Tampilkan Lebih Sedikit' : '+ Tampilkan Lebih Banyak';
        });
    });
    $(function(){
      $('#ModalVideo').modal({
          show: false
      }).on('hidden.bs.modal', function(){
          $(this).find('video')[0].pause();
      });
    });
    $(document).ready(function(){
      $(".showModal").click(function(e){
        e.preventDefault();
        var url = $(this).attr("data-href");
        $("#ModalVideo video").attr("src", url);
        $("#ModalVideo").modal("show");
      });
     });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>