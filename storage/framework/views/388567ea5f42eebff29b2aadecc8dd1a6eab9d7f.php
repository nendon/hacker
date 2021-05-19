<?php $__env->startSection('title', 'Project Submit List'); ?>
<?php $__env->startSection('breadcumbs'); ?>
<div id="navigation">
    <div class="container">
        <ul class="breadcrumb">
        <li><a href="<?php echo e(url('contributor/dashboard')); ?>">Dashboard</a></li>
        <li>Project Submit</li>
        </ul>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row mt-5">
    <div class="col-xs-12 mb-4">
      <h5>Projek Submit</h5>
    </div>

    <hr style="border-top: 1px solid #000;width:98%">

    <div class="col-sm-4 col-xs-12">
      Cari Nama Siswa <br>
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-search"></i></span>
        <input type="text" class="form-control" name="name" id="name" style="border-left:none;">
      </div>
    </div>

    <div class="col-sm-4 col-xs-12">
      Nama Projek <br>
      <select class="form-control">
        <option value="">Explore Weather Trends</option>
        <option value="">1</option>
        <option value="">2</option>
        <option value="">3</option>
      </select>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4 col-xs-12 mt-4">
      <div class="box pr-0">
        <h5>Nama Siswa</h5>
        <div class="list-group">
            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lists): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(url('contributor/project/submit/'.$lists->project_section_id.'/detail/'.$lists->id)); ?>" class="list-group-item <?php echo e(request()->is('contributor/project/submit/'.$lists->project_section_id.'/detail/'.$lists->id) ? 'active' : ''); ?>">
                <img src="img/user.png" class="img-table" alt=""> <?php echo e($lists->member->username); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>

    <div class="col-sm-8 col-xs-12 mt-4">
      <div class="box">
        <div class="pull-right">
          <a href="#"><i class="fa fa-times-circle"></i></a>
        </div>

        <div class="row">
          <div class="col-xs-4">
            <h5>Nama Projek:</h5>
            <b><?php echo e(ucwords($section->title)); ?></b>
          </div>
          <div class="col-xs-8">
            <h5>Deskripsi Projek :</h5>
            <?php echo e($section->deskripsi_project); ?>

          </div>
        </div>

        <hr>

        <div>
          <h5>Instruksi Projek</h5>
          <p class="read-more"><?php echo e($section->instruksi); ?></p>
        </div>

        <hr>

        <div>
          <h5>komentar</h5>
          <p><?php echo e($user->komentar_user); ?></p>
        </div>

        <br>

        <div>
          <h5>Lampiran Project</h5>
          <a href="<?php echo e(asset($user->file)); ?>" class="btn btn-green" download><i class="fa fa-file-alt" style="color: #00000080!important;"></i> <?php echo e($user->file); ?> <i class="fa fa-download"></i></a>
        </div>

        <br>

        <div>
          <h5>Tambahkan komentar anda</h5>
          <textarea class="form-control" name="komentar" id="komentar" cols="30" rows="4" placeholder="Tulis komentar atau review Anda, beritahu siswa anda"></textarea>
        </div>
        
        <div class="text-right mt-2">
          <button class="btn btn-green"><i class="fa fa-paper-plane"></i> Kirim</button>
        </div>

        <div class="row mt-4">
          <div class="col-xs-6 px-4">
            <button class="btn btn-white w-100 py-4" onclick="accProject(<?php echo e($user->id); ?>, 1)">Tidak Lulus</button>
          </div>
          <div class="col-xs-6 px-4">
            <button class="btn btn-green w-100 py-4" onclick="accProject(<?php echo e($user->id); ?>, 2)">Lulus</button>
          </div>
        </div>
      </div>
    </div>

  </div>
<script>
    function accProject(pid, id){
        dataform = new FormData();
        dataform.append('id', pid);
        dataform.append('status', id);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type    :"POST",
            url     :'<?php echo e(url("/contributor/project/accproject")); ?>',
            data    : dataform,
            dataType : 'json',
            contentType: false,
            processData: false,
            success:function(data){
                if(data.status == 1){
                    swal({
                        title: "Project Tidak di acc",
                        showConfirmButton: true,
                        timer: 3000
                      });
                } else if(data.status == 2)
                {
                    swal({
                        title: "Project Telah di ACC",
                        showConfirmButton: true,
                        timer: 3000
                      });
                }
                
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('contrib.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>