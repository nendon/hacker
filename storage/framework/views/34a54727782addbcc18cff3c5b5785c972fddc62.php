<?php $__env->startSection('title',''); ?>
<?php $__env->startSection('breadcumbs'); ?>
<div id="navigation">
		<ul class="breadcrumb">
				<li><a href="<?php echo e(url('notif')); ?>">Dashboard</a></li>
                <li>Komentar</li>
		</ul>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style>
  #content{
    background: #f4f4f4;
  }
  #exTab1 .nav-pills{
      background: #fff;
  }
  #exTab1 .tab-content {

    background-color: #fff;
    padding : 5px 15px;
  }
  #exTab1 .nav-pills > li > a {
  border-radius: 0;
  background: #fff;
  color: #2BA8E2;
  }
  #exTab1 .nav-pills  .active{
    border-bottom: 2px solid #2BA8E2;
  }
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: none;
    border-bottom: 1px solid #ddd;
}
.table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>th {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: none;
  border: none;
}

.btn {
  border-radius: 10px;
  padding: 5px 20px;
  font-size: 10px;
  text-decoration: none;
  color: #fff;
  position: relative;
  display: inline-block;
}

.blue {
  background-color: #55acee;
}
.blue:hover {
  background-color: #fff;
  border-color: #55acee;
  color: #55acee;
}

.red {
  background-color: #e74c3c;
}
.red:hover{
  background-color: #fff;
  border-color: #e74c3c;
  color: #e74c3c;
}
</style>
<div class="row">
  <div class="col-md-12">
    <div id="exTab1" class="container">
      <ul  class="nav nav-pills">
        <li class="active">
          <a  href="#1a" data-toggle="tab">Unread</a>
        </li>
        <li><a href="#2a" data-toggle="tab">Read</a>
        </li>
        <li><a href="#3a" data-toggle="tab">All</a>
        </li>

      </ul>

      <div class="tab-content clearfix">
        <div class="tab-pane active" id="1a">
          <table class="table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th width="60%">Notification</th>
                <th>Lebih Lanjut</th>
              </tr>
            </thead>
            <tbody>
			<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php
				if($dat->status == 0){
			?>
              <tr>
                <td><?= date('d/m/Y',strtotime($dat->created_at)) ?></td>
                <td><?php echo e($dat->notif); ?></td>
                <td>
                  <a href="<?php echo e(url('lessons/'.$dat->slug)); ?>" onclick="readnotif(<?php echo e($dat->id); ?>)" class="btn blue">Lihat</a>
                 	<a href="javascript:void(0)" class="btn red" onclick="$('#un<?php echo e($dat->id); ?>').submit();">Abaikan</a>
					<form id="un<?php echo e($dat->id); ?>" class="" action="<?php echo e(url('contributor/notif/delete/'.$dat->id)); ?>" method="post">
						<?php echo e(csrf_field()); ?>

					</form>
                </td>
              </tr>

			<?php } ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
        <div class="tab-pane" id="2a">
			<table class="table">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th width="60%">Notification</th>
                  <th>Lebih Lanjut</th>
                </tr>
              </thead>
              <tbody>
  			<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  			<?php
  				if($dat->status == 1){
  			?>
                <tr>
                  <td><?= date('d/m/Y',strtotime($dat->created_at)) ?></td>
                  <td><?php echo e($dat->notif); ?></td>
                  <td>
                    <?php if($dat->category=='coments'): ?>
                     <a href="<?php echo e(url('contributor/comments/detail/'.$dat->id)); ?>" class="btn blue">Lihat</a>
                    <?php elseif($dat->category=='point'): ?>
                     <a href="<?php echo e(url('contributor/point')); ?>"  class="btn blue">Lihat</a>
                    <?php elseif($dat->category=='transfer'): ?>
                     <a href="<?php echo e(url('contributor/income')); ?>" class="btn blue">Lihat</a>
                    <?php else: ?>
                    <a href="#" class="btn blue">Lihat</a>
                    <?php endif; ?>
                     <a href="javascript:void(0)" class="btn red" onclick="$an('#<?php echo e($dat->id); ?>').submit();">Abaikan</a>
					 <form id="an<?php echo e($dat->id); ?>" class="" action="<?php echo e(url('contributor/notif/delete/'.$dat->id)); ?>" method="post">
						 <?php echo e(csrf_field()); ?>

					 </form>
                  </td>
                </tr>
			<?php } ?>
  			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
        </div>
        <div class="tab-pane" id="3a">
			<table class="table">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th width="60%">Notification</th>
                  <th>Lebih Lanjut</th>
                </tr>
              </thead>
              <tbody>
  			<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?= date('d/m/Y',strtotime($dat->created_at)) ?></td>
              <td><?php echo e($dat->notif); ?></td>
              <td>
                <?php if($dat->category=='coments'): ?>
                 <a href="<?php echo e(url('contributor/comments/detail/'.$dat->id)); ?>" onclick="readnotif(<?php echo e($dat->id); ?>)" class="btn blue">Lihat</a>
                <?php elseif($dat->category=='point'): ?>
                 <a href="<?php echo e(url('contributor/point')); ?>" onclick="readnotif(<?php echo e($dat->id); ?>)" class="btn blue">Lihat</a>
                <?php elseif($dat->category=='transfer'): ?>
                 <a href="<?php echo e(url('contributor/income')); ?>" onclick="readnotif(<?php echo e($dat->id); ?>)" class="btn blue">Lihat</a>
                <?php else: ?>
                <a href="#" class="btn blue">Lihat</a>
                <?php endif; ?>
                 <a href="javascript:void(0)" class="btn red" onclick="$('#all<?php echo e($dat->id); ?>').submit();">Abaikan</a>
      				 <form id="all<?php echo e($dat->id); ?>" class="" action="<?php echo e(url('contributor/notif/delete/'.$dat->id)); ?>" method="post">
      					 <?php echo e(csrf_field()); ?>

      				 </form>
              </td>
            </tr>
  			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
      function readnotif(id){
        var token   = "<?php echo e(csrf_token()); ?>";
        var dataString= '_token='+ token + '&id=' + id ;
         $.ajax({
          type:"GET",
          url:"<?php echo e(url('user/notif/view')); ?>",
          data:dataString,
          success:function(data){
          }
        });
      }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>