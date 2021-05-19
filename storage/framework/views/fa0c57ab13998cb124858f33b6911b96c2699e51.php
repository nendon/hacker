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

    <div class="col-xs-12 mt-4">
      <div class="box">
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th>Nama Siswa</th>
              <th>Komentar</th>
              <th>Tanggal Submit</th>
              <th>Status</th>
              <th>Lebih Lanjut</th>
            </tr>

            <?php $__currentLoopData = $user_project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><img src="<?php echo e(asset($user->member->avatar)); ?>"class="img-table img-responsive" alt=""> <?php echo e($user->member->username); ?></td>
              <td><?php echo e($user->komentar_user); ?></td>
              <td><?php echo e(date("jS F Y", strtotime($user->created_at))); ?></td>
              <?php if($user->status == 0): ?>
              <td><span class="c-yellow">Menunggu</span></td>
              <?php elseif($user->status == 1): ?>
              <td><span class="c-red">Tidak Lulus</span></td>
              <?php elseif($user->status == 2): ?>
              <td><span class="c-green">Lulus</span></td>
              <?php endif; ?>
              <td><a href="<?php echo e(url('contributor/project/submit/'.$user->project_section_id.'/detail/'.$user->id)); ?>" class="btn btn-green"><i class="fa fa-eye"></i> Lihat</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


          </table>
        </div>

        <div class="row">
          <div class="col-sm-6 col-xs-12">
            <b>Halaman 1 dari 5</b>
          </div>

          <div class="col-sm-6 col-xs-12 text-right">
            <nav aria-label="Page navigation">
              <ul class="pagination m-0">
                <li>
                  <a href="#" aria-label="Previous">
                    <span aria-hidden="true"><i class="fa fa-chevron-left"></i></span>
                  </a>
                </li>
                <li><a href="#">1</a></li>
                <li class="active"><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                  <a href="#" aria-label="Next">
                    <span aria-hidden="true"><i class="fa fa-chevron-right"></i></span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>

      </div>
    </div>

  </div>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('contrib.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>