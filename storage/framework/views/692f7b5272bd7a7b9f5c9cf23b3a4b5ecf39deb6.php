<?php $__env->startSection('title',''); ?>
<?php $__env->startSection('breadcumbs'); ?>
<?php $__env->startSection('content'); ?>
<link href="<?php echo e(asset('template/kontributor/css/dropify.min.css')); ?>" rel="stylesheet">


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
              <h4>Bootcamp <small class="c-yellow">Draft</small></h4>
              <h2><?php echo e($bootcamp->title); ?></h2>
            </div>
          </div>
        </div>

        <!-- Nav Tabs -->
        <?php echo $__env->make('contrib.bootcamp.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <!-- Tab Detail -->
            <div class="tab-pane fade active in" id="pills-detail" role="tabpanel" aria-labelledby="pills-detail-tab">
              <!-- row Title  -->
              <div class="box">
                <div class="row">
                  <div class="col-xs-12 p-4">
                    <h4 class="text-inline">Details <i class="far fa-question-circle"></i></h4>
                  </div>
                </div>
              </div>

              <!-- row Content -->
              <div class="box mt-4">
                <div class="row">
                  <div class="col-xs-12">
                    <h5 class="mb-4">Bootcamp Details</h5>
                    <div class="form-group">
                      Judul
                      <input class="form-control" type="text" name="title" id="judul" value="<?php echo e($bootcamp->title); ?>" >
                    </div>
                    <div class="form-group">
                      Sub Judul (Deskripsi Singkat)
                      <input class="form-control" type="text" name="subjudul" id="subjudul" value="<?php echo e($bootcamp->sub_title); ?>" >
                    </div>
                    <div class="form-group">
                      <div class="col-xs-6 pl-0">
                        Kategori
                        <select class="form-control" name="kat_id" id="kat_id">
                          <?php $__currentLoopData = $cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if(Input::old('bootcamp_category_id') == $cats->id): ?>
                                <option value="<?php echo e($cats->id); ?>" selected><?php echo e($cats->title); ?></option>
                          <?php else: ?>
                                <option value="<?php echo e($cats->id); ?>"><?php echo e($cats->title); ?></option>
                          <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                      <div class="col-xs-6 pl-0">
                        Sub Kategori
                        <select class="form-control" name="sub_kat_id" id="sub_kat_id">
                            <?php $__currentLoopData = $sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php echo $bootcamp->bootcamp_sub_category_id == $subs->id ? "selected" : "" ?> value="<?php echo e($subs->id); ?>"><?php echo e($subs->title); ?></option> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                      </div>
                    </div>
                    <br><br><br>
                    <div class="form-group">
                     
                    <div class="form-group">
                    Cover Bootcamp
                      <input class="form-control dropify" type="file" data-default-file="<?php echo e(asset($bootcamp->cover)); ?>" value="<?php echo e($bootcamp->cover); ?>" id="cover">
                    </div>
                    <div class="form-group">
                      Promotional Video
                      <input class="form-control dropify" type="file" data-default-file="<?php echo e(asset($bootcamp->promote_video)); ?>" value="<?php echo e($bootcamp->promote_video); ?>"  id="video">
                    </div>
                    Gambar Deskripsi Lengkap
                      <input class="form-control dropify" type="file" data-default-file="<?php echo e(asset($bootcamp->picture_desk)); ?>" value="<?php echo e($bootcamp->picture_desk); ?>" id="picture_desk">
                    </div>
                    <div class="form-group">
                      Deskripsi Lengkap Bootcamp
                      <textarea class="form-control" type="text" id="desc"  cols="30" rows="10">  <?php echo e($bootcamp->deskripsi); ?></textarea>

                    </div>
                    <div class="form-group">
                    Gambar Problem
                      <input class="form-control dropify" type="file" data-default-file="<?php echo e(asset($bootcamp->picture_problem)); ?>" value="<?php echo e($bootcamp->cover); ?>" id="picture_problem">
                    </div>
                    <div class="form-group">
                      Problem yang dipecahkan
                      <textarea class="form-control" type="text" id="problem"  cols="30" rows="10">  <?php echo e($bootcamp->problem); ?></textarea>

                    </div>
                    <div class="form-group">
                    Gambar alasan bootcamp
                      <input class="form-control dropify" type="file" data-default-file="<?php echo e(asset($bootcamp->picture_alasan)); ?>" value="<?php echo e($bootcamp->picture_alasan); ?>" id="picture_alasan">
                    </div>
                    <div class="form-group">
                      Kenapa belajar bootcamp ini ?
                      <textarea class="form-control" type="text" id="alasan"  cols="30" rows="10">  <?php echo e($bootcamp->alasan); ?></textarea>

                    </div>
                    <button class="btn btn-green pull-right" onclick="saveDetail(<?php echo e($bootcamp->id); ?>)">+ Simpan</button>
                  </div>
                </div>
              </div>

              <div class="box mt-4">
                <div class="row">
                  <div class="col-xs-12">
                    <h5 class="mb-4">Target Student</h5>
                    <div class="form-group">
                      Target Audience
                      <input class="form-control" type="text" name="target" id="target" value="<?php echo e($bootcamp->audience); ?>" placeholder="Siapa yang harus mengikuti bootcamp anda">
                    </div>
                    <div class="form-group">
                      Preusite and Requirement
                      <input class="form-control" type="text" name="require" id="require" value="<?php echo e($bootcamp->pre_and_req); ?>" placeholder="Contoh: Harus memiliki Laptop dan Mikrotik" >
                    </div>
                    <div class="form-group">
                      Link download Silabus
                      <input class="form-control" type="text" name="silabus" id="silabus" value="<?php echo e($bootcamp->silabus); ?>" >
                    </div>
                    <button class="btn btn-green pull-right" onclick="saveDetail(<?php echo e($bootcamp->id); ?>)">+ Simpan</button>
                  </div>
                </div>
              </div>

              <div class="box my-4">
                <div class="row">
                  <div class="col-xs-12">
                    <h5>Profile Instruktur</h5>
                    <div class="alert alert-info mt-4">
                      <i class="fa fa-check-circle c-orange"></i>
                      Semua Profile Anda telah lengkap
                    </div>
                    <img src="<?php echo e(asset($contrib->avatar)); ?>" class="img-profile-instruktur" alt=""> <?php echo e($contrib->username); ?>

                  </div>
                </div>
              </div>
            </div>
        </div>


    </div>

  </main>
  <script type="text/javascript" src="<?php echo e(asset('template/kontributor/js/jquery.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('template/kontributor/js/bootstrap.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('template/kontributor/js/dropify.min.js')); ?>"></script>
  <script>
      $(document).ready(function() {
        $('select[name=kat_id]').change(function() {
                var url = '<?php echo e(url('contributor/get/sub')); ?>' + '/' + $(this).val();
                $.get(url, function(data) {
                    var select = $('form select[name=sub_kat_id]');
                    select.empty();
                    $.each(data,function(key, value) {
                        select.append('<option value=' + value.id + '>' + value.title + '</option>');
                    });
                });
            });
        });

        

      function saveDetail(bootcamp_id) {
      var title = $('#judul').val();
      var subjud = $('#subjudul').val();
      var subkat = $('#sub_kat_id').val();
      var kat = $('#kat_id').val();
      var desc = $('#desc').val();
      var problem = $('#problem').val();
      var alasan = $('#alasan').val();
      var silabus = $('#silabus').val();
      var file_data = $('#cover').prop("files")[0];
      var file_video = $('#video').prop("files")[0];
      var file_problem = $('#picture_problem').prop("files")[0];
      var file_alasan= $('#picture_alasan').prop("files")[0];
      var file_desk = $('#picture_desk').prop("files")[0];
      var target = $('#target').val();
      var req = $('#require').val();

      dataform = new FormData();
      dataform.append( 'image', file_data);
      dataform.append( 'video', file_video);
      dataform.append( 'file_problem', file_problem);
      dataform.append( 'file_alasan', file_alasan);
      dataform.append( 'file_desk', file_desk);
      dataform.append( 'title', title);
      dataform.append( 'desc', desc);
      dataform.append( 'problem', problem);
      dataform.append( 'alasan', alasan);
      dataform.append( 'silabus', silabus);
      dataform.append( 'subjud', subjud);
      dataform.append( 'subkat', subkat);
      dataform.append( 'kat', kat);
      dataform.append( 'boot_id', bootcamp_id);
      dataform.append( 'target', target);
      dataform.append( 'req', req);
  
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
            url     :'<?php echo e(url("contributor/bootcamp/saveDetail")); ?>',
            data    : dataform,
            dataType : 'json',
            contentType: false,
            processData: false,
            beforeSend: function(){
                 swal({
                  title: "Create Detail",
                  text: "Mohon Tunggu sebentar, Detail sedang dibuat ",
                  imageUrl: "<?php echo e(asset('template/web/img/loading.gif')); ?>",
                  showConfirmButton: false,
                  allowOutsideClick: false
              });
            },
            success:function(data){
              if (data.success == false) {
                 window.location.href = '<?php echo e(url("contributor/login")); ?>';
              }else if (data.success == true) {
                $('#title').val('');
                swal({
                  title: "Detail Bootcamp Berhasil Dibuat !",
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

  
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('contrib.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>