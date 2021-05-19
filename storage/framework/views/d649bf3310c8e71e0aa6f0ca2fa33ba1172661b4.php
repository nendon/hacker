<?php $__env->startSection('title',''); ?>
<?php $__env->startSection('breadcumbs'); ?>
<div id="navigation">
    <div class="container">
        
        <button class="btn btn-info pull-right pull-right" data-toggle="modal" data-target="#modalStep"><i class="fa fa-plus" aria-hidden="true"></i>
           Buat Tutorial</button>
        <ul class="breadcrumb">
        <li><a href="<?php echo e(url('contributor/dashboard')); ?>">Dashboard</a></li>
        <li>Kelola Kelas</li>
        </ul>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Main -->
    <main>
      
      <!-- Container -->
      <div class="container">
  
  
        <div class="row mt-5">
          <div class="col-xs-12 mb-4">
            <h5>Kelas</h5>
          </div>

          <hr style="border-top: 1px solid #000;width:98%">

          <div class="col-sm-4 col-xs-12 mb-2">
            Cari Nama Kelas <br>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><i class="fa fa-search"></i></span>
              <input type="text" class="form-control" name="name" id="name" style="border-left:none;" placeholder="Cari Kelas">
            </div>
          </div>

          <div class="col-sm-4 col-xs-12 kelola-tabs">
            Tipe Kelas <br>
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
              <li class="nav-item active">
                <a class="nav-link" id="pills-bootcamp-tab" data-toggle="pill" href="#pills-bootcamp" role="tab" aria-controls="pills-bootcamp" aria-selected="true">Bootcamp</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pills-tutorial-tab" data-toggle="pill" href="#pills-tutorial" role="tab" aria-controls="pills-tutorial" aria-selected="false">Tutorial</a>
              </li>
            </ul>
          </div>

          <div class="col-xs-12">

              <div class="tab-content mt-4" id="pills-tabContent">
                
                  <div class="tab-pane fade active in" id="pills-bootcamp" role="tabpanel" aria-labelledby="pills-bootcamp-tab">
                      <?php if($boot != null): ?>
                      <?php $__currentLoopData = $boot; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $boots): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="box">
                        <div class="row">
                          <div class="col-md-8 col-sm-10 col-xs-12 border-right">
                            <?php if($boots->cover != null): ?>
                            <img src="<?php echo e(asset($boots->cover)); ?>" class="kelolaskelas-img-thumb img-rounded img-responsive"  alt="">
                            <?php else: ?>
                            <img src="<?php echo e(asset('template/kontributor/img/no-image.png')); ?>" class="kelolaskelas-img-thumb img-rounded img-responsive"  alt="">
                            <?php endif; ?>                                        
                            <h5>Bootcamp</h5>
                            <h3 class="kelolakelas-title"><?php echo e($boots->title); ?></h3>
                            <br>
                            <span class="text-muted"><?php echo e($boots->contributor->username); ?></span>
                            <span class="pull-right">Harga - <?php echo e($boots->price); ?></span>
                            </div>
                          <div class="col-md-4 col-sm-2 col-xs-12">
                            <?php if($boots->status == 1): ?>
                            <h5 class="c-green" style="letter-spacing: 2px;">Published</h5>
                            <?php elseif($boots->status == 0): ?>
                            <h5 class="c-orange" style="letter-spacing: 2px;">Draft</h5>
                            <?php endif; ?>
                            <a href="<?php echo e(url('contributor/bootcamp/'.$boots->slug)); ?>" class="btn btn-green"><i class="fa fa-edit"></i> Edit</a>
                            <h6>Terakhir di Ubah: <?php echo e(date("jS F Y", strtotime($boots->updated_at))); ?></h6>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <div class="box">
                        <div class="row">
                          <h3>Anda belum memiliki kelas</h3>
                        </div>
                      </div>
                    <?php endif; ?>
                  </div>

                  <div class="tab-pane fade" id="pills-tutorial" role="tabpanel" aria-labelledby="pills-tutorial-tab">
                    <?php if($data != null): ?>
                      <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="box">
                        <div class="row">
                          <div class="col-md-8 col-sm-10 col-xs-12 border-right">
                            <?php if($keys->image != null): ?>
                            <img src="<?php echo e(asset($keys->image)); ?>" class="kelolaskelas-img-thumb img-rounded img-responsive"  alt="">
                            <?php else: ?>
                            <img src="<?php echo e(asset('template/kontributor/img/no-image.png')); ?>" class="kelolaskelas-img-thumb img-rounded img-responsive"  alt="">
                            <?php endif; ?>                       
                            <h5>Tutorial</h5>
                            <h3 class="kelolakelas-title"><?php echo e($keys->title); ?></h3>
                            <br>
                            <span class="text-muted"><?php echo e($keys->contributor->username); ?></span>
                            <span class="pull-right">Harga - Rp. <?php echo e($keys->price); ?></span>
                            </div>
                            <div class="col-md-4 col-sm-2 col-xs-12">
                              <?php if($keys->status == 1): ?>
                              <h5 class="c-green" style="letter-spacing: 2px;">Published</h5>
                              <?php elseif($keys->status == 0): ?>
                              <h5 class="c-orange" style="letter-spacing: 2px;">Draft</h5>
                              <?php endif; ?>
                            <a href="<?php echo e(url('contributor/lessons/'.$keys->id.'/view')); ?>" class="btn btn-green"><i class="fa fa-edit"></i> Edit</a>
                            <h6>Terakhir di Ubah: <?php echo e(date("jS F Y", strtotime($keys->updated_at))); ?></h6>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                      <div class="box">
                        <div class="row">
                          <h3>Anda belum memiliki Tutorial</h3>
                        </div>
                      </div>
                    <?php endif; ?>
                  </div>
              </div>

          </div>

        </div>

        <div class="row">


          
        </div>
  
          


      </div>

      <div class="m-5"></div>

    </main>
<!-- Modal -->
    <div class="modal fade multi-step" id="modalStep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><i class="far fa-times-circle"></i></button>
              <h4>Pilih Kelas yang akan dibuat</h4>
            </div>
            <form action="<?php echo e(url('contributor/bootcamp/save')); ?>" method="post" enctype="multipart/form-data">
              <?php echo e(csrf_field()); ?>

              <div class="modal-body">
                <!-- Step 1 -->
                <div class="row setup-content" id="step-1">
                  <div class="col-sm-6 col-xs-12">
                    <div class="card mt-4">
                      <i class="fa fa-tv"></i>
                      <p class="mt-3">
                        Kelas dengan biaya rendah tidak terlalu kompleks namun tetap bisa mendapatkan minat yang kuat.
                      </p>
                      <a href="<?php echo e(url('contributor/lessons/create')); ?>" class="btn btn-outline-modal nextBtn" type="button">Pilih</a>
                    </div>
                  </div>
                  <div class="col-sm-6 col-xs-12">
                      <div class="card mt-4">
                        <i class="fa fa-tv"></i>
                        <p class="mt-3">
                          Buat kelas online lengkap menggunakan kurikulum yang terstruktur dan komprehensif.
                          <br><br>
                        </p>
                        <button class="btn btn-outline-modal nextBtn" type="button">Pilih</button>                      
                      </div>
                  </div>
                </div>

                <!-- Step 2 -->
                <div class="row setup-content" id="step-2">
                  <div class="col-xs-12">
                      <div class="form-group">
                          <input type="text" class="form-control" name="judul" id="judul" required placeholder="Judul Kelas">
                      </div>
                      Jangan khawatir jika anda belum bisa memikirkan judul yang bagus sekarang.
                      Anda bisa mengubahnya nanti.
                  </div>
                </div>

                <!-- Step 3 -->
                <div class="row setup-content" id="step-3">
                  <div class="col-xs-12">
                    <div class="form-group">
                      <select class="form-control" name="kategori" id="kategori">
                        <option value="-">Pilih kategori</option>
                        <?php $__currentLoopData = $cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cats => $jeni): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($jeni->id); ?>"><?php echo e($jeni->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                    Jangan khawatir Anda bisa mengubahnya nanti.
                  </div>
                </div>

                <div class="requestwizard mt-5">
                  <div class="requestwizard-row setup-panel">
                    <div class="requestwizard-step">
                        <a href="#step-1" type="button" class="btn btn-primary btn-circle"><i class="fa fa-circle"></i></a>
                        <p>Step 1</p>
                    </div>
                    <div class="requestwizard-step">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-circle"></i></a>
                        <p>Step 2</p>
                    </div>
                    <div class="requestwizard-step">
                        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-circle"></i></a>
                        <p>Step 3</p>
                    </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-green pull-left" type="button"  id="prevBtn">Sebelumnya</button>
                  <button class="btn btn-green pull-right" type="button" id="nextBtn">Selanjutnya</button>
                  <button type="submit" class="btn btn-green pull-right" >Buat Kelas</button>
              </div>
          </form>
        </div>
      </div>
    </div>
    <script>
        function changeSlug(){
          var str =$('#title').val();
          str =str.replace(/\s+/g,'-').toLowerCase();
          $('#slug').val(str);
        }
      </script>
<script>
 function checkpublish(id){

   swal({
     title: "Apakah kamu sudah selesai?",
     text: "Lessons ini akan muncul di halaman cilsy.id. Perhatikan kembali data yang anda akan publish!",
     type: "warning",
     showCancelButton: true,
     confirmButtonColor: "#DD6B55",
     confirmButtonText: "Ya, Publish Tutorial!",
     cancelButtonText: "Tidak, Batalkan!",
     closeOnConfirm: false,
     closeOnCancel: false
     },
     function(isConfirm){
     if (isConfirm) {

       $('#'+id).submit();

       swal("Publish!", "Data Anda telah dipublish.", "success");
     } else {
       swal("Cancelled", "Silahkan lanjutkan kembali :)", "error");
     }
     });
 }
 
 
 </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('contrib.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>