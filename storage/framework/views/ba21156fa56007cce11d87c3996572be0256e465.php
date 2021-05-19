<?php $__env->startSection('title',''); ?>
<?php $__env->startSection('breadcumbs'); ?>
<?php $__env->startSection('content'); ?>


<!-- Main -->
    <main>

      <!-- Container -->
      <div class="container tabs-course">

        <div class="box header mt-5">
          <div class="row">
            <div class="col-sm-4 col-xs-12">
              <img :src="getCover()" class="img-rounded img-responsive" alt="">
            </div>
            <div class="col-sm-8 col-xs-12">
              <h4>Bootcamp 
                <?php if ($bootcamp->status == 0): ?>
                <small class="c-yellow">Draft</small>
                <?php else: ?>
                <small class="c-green">Published</small>
                <?php endif;?>
              </h4>
              <h2><?php echo e($bootcamp->title); ?></h2>
            </div>
          </div>
        </div>

        <?php echo $__env->make('contrib.bootcamp.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="tab-content mt-5" id="pills-tabContent">

            <!-- Tab Course -->
            <div class="tab-pane fade active in" id="pills-course" role="tabpanel" aria-labelledby="pills-course-tab">
              <!-- Title -->
              <div class="box">
                <div class="row">
                  <div class="col-xs-12 p-4">
                    <h4 class="text-inline">Course <i class="far fa-question-circle"></i></h4>
                    <button class="btn btn-green pull-right" id="BuatCourse-show">+ Tambah Course</button>
                  </div>
                </div>
              </div>

              <div class="box mt-4" id="rowBuatCourse">
                  <input type="hidden" name="boot_id" value="<?php echo e($bootcamp->id); ?>">
                  <h5 class="mb-4">Buat Course</h5>
                  <div class="form-group">
                    Judul Course
                    <input class="form-control" type="text" name="title" id="judul" placeholder="" >
                  </div>
                  <div class="form-grou   p">
                    Deskripsi atau Tujuan Belajar
                    <input class="form-control" type="text" name="desk" id="desk" placeholder="" >
                  </div>
                  <div class="form-group">
                    Gambar Course
                    <br>
                    <input class="form-control dropify" type="file" id="img">
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-3 col-xs-12">
                    Estimasi Selesai Course
                    <input class="form-control" type="number" name="estimasi" id="estimasi">
                    <small class="text-muted">Dalam hitungan jam</small>
                    </div>
                  </div>
                  <div class="row p-4">
                    <button class="btn btn-green pull-right" onclick="saveCourse(<?php echo e($bootcamp->id); ?>)">+ Simpan</button> 
                    <button class="btn btn-secondary pull-right mx-4" id="BuatCourse-hide">+ Batalkan</button>
                  </div>
                </div>
              <!-- Kurikulum 1 -->
              <?php if($courses != null): ?>
              <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="box mt-4">
                <div class="row">
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <img src="<?php echo e(asset($key->cover_course)); ?>" class="img-rounded img-responsive" alt="">
                  </div>
                  <div class="col-md-4 col-sm-3 col-xs-12">
                    <h5><?php echo e($key->title); ?></h5>
                    <span>0 Lesson/0 Konten</span>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12 py-4">
                    12 jam Durasi Selesai
                  </div>
                  <div class="col-md-3 col-sm-4 col-xs-12 py-4 text-right">
                    <a href="<?php echo e(url('contributor/bootcamp/course/'.$key->id)); ?>" class="btn btn-green">+ Tambah Kurikulum</a>
                    <a class="pull-right collapsed" id="collapse" data-toggle="collapse" href="#collapseCourse<?php echo e($key->id); ?>" role="button"></a>
                  </div>
                </div>
                <div class="collapse" id="collapseCourse<?php echo e($key->id); ?>">
                  <hr>
                  <div class="box bg-grey mt-4">
                    <h5 class="mb-4">Edit Course</h5>
                    <input type="hidden" name="course_id" value="<?php echo e($key->id); ?>">
                    <input type="hidden" name="boot_id" value="<?php echo e($bootcamp->id); ?>">
                    <div class="form-group">
                      Judul Course
                      <input class="form-control bg-grey" type="text" name="title" id="titleold<?php echo e($key->id); ?>" placeholder="" value="<?php echo e($key->title); ?>">
                    </div>
                    <div class="form-group">
                      Deskripsi atau Tujuan Belajar
                      <input class="form-control bg-grey" type="text" name="desk" id="deskold<?php echo e($key->id); ?>" placeholder="" value="<?php echo e($key->deskripsi); ?>" >
                    </div>
                    <div class="form-group  bg-grey">
                      Gambar Course
                      <input class="form-control dropify" type="file" name="img" id="imgold<?php echo e($key->id); ?>" data-default-file="<?php echo e(asset($key->cover_course)); ?>" value="<?php echo e($key->cover_course); ?>">
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-3 col-xs-12">
                      Estimasi Selesai Course
                      <input class="form-control bg-grey" type="number" name="estimasi" id="estimasiold<?php echo e($key->id); ?>" value="<?php echo e($key->estimasi); ?>">
                      <small class="text-muted">Dalam hitungan jam</small>
                      </div>
                    </div>
                  </div>
                  <div class="row p-4">
                    <button class="btn btn-green pull-right" onclick="updateCourse(<?php echo e($key->id); ?>, <?php echo e($bootcamp->id); ?>)">+ Simpan</button> 
                    <button class="btn btn-secondary pull-right mx-4">+ Batalkan</button>
                  </div>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            </div>

            

           

        </div>


      </div>

    </main>
    <script type="text/javascript" src="<?php echo e(asset('template/kontributor/js/jquery.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('template/kontributor/js/bootstrap.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('template/kontributor/js/dropify.min.js')); ?>"></script>
    <script>

    
    
    function saveCourse(bootcamp_id) {
      var title = $('#judul').val();
      var desk = $('#desk').val();
      var estimasi = $('#estimasi').val();
      var file_data = $('#img').prop("files")[0];
      dataform = new FormData();
      dataform.append( 'image', file_data);
      dataform.append( 'title', title);
      dataform.append( 'estimasi', estimasi);
      dataform.append( 'desk', desk);
      dataform.append( 'boot_id', bootcamp_id);
  
      if (title == '') {
        alert('Harap Isi form !')
      }else {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
        $.ajax({
            type    :"POST",
            url     :'<?php echo e(url("contributor/bootcamp/saveCourse")); ?>',
            data    : dataform,
            dataType : 'json',
            contentType: false,
            processData: false,
            beforeSend: function(){
                 swal({
                  title: "Membuat Course",
                  text: "Mohon Tunggu sebentar, Course sedang dibuat ",
                  imageUrl: "<?php echo e(asset('template/web/img/loading.gif')); ?>",
                  showConfirmButton: false,
                  allowOutsideClick: false
              });
              // Show image container
            },
            success:function(data){
              if (data.success == false) {
                 window.location.href = '<?php echo e(url("contributor/login")); ?>';
              }else if (data.success == true) {
                $('#title').val('');
                swal({
                  title: "Course Berhasil Dibuat !",
                  showConfirmButton: true,
                  timer: 3000
                },
                function(){ 
                  location.reload();
                }
                );
              }
            }
        });
      }
    }
    function updateCourse(course_id, bootcamp_id) {
      var title = $('#titleold'+course_id).val();
      var desk = $('#deskold'+course_id).val();
      var estimasi = $('#estimasiold'+course_id).val();
      var file_data = $('#imgold'+course_id).prop("files")[0];
      dataform = new FormData();
      dataform.append( 'image', file_data);
      dataform.append( 'title', title);
      dataform.append( 'estimasi', estimasi);
      dataform.append( 'desk', desk);
      dataform.append( 'boot_id', bootcamp_id);
      dataform.append( 'course_id', course_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type    :"POST",
            url     :'<?php echo e(url("contributor/bootcamp/updateCourse")); ?>',
            data    : dataform,
            dataType : 'json',
            contentType: false,
            processData: false,
            beforeSend: function(){
                 swal({
                  title: "Membuat Course",
                  text: "Mohon Tunggu sebentar, Course sedang update ",
                  imageUrl: "<?php echo e(asset('template/web/img/loading.gif')); ?>",
                  showConfirmButton: false,
                  allowOutsideClick: false
              });
              // Show image container
            },
            success:function(data){
              if (data.success == false) {
                 window.location.href = '<?php echo e(url("contributor/login")); ?>';
              }else if (data.success == true) {
                $('#title').val('');
                swal({
                  title: "Course Berhasil Diubah!",
                  showConfirmButton: true,
                  timer: 3000
                },
                function(){ 
                  location.reload();
                }
                );
              }
            }
        });
      }
      
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('contrib.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>