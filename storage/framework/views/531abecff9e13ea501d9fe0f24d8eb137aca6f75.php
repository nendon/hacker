<?php $__env->startSection('title','Daftar | '); ?>
<?php $__env->startSection('content'); ?>
<div id="sign-container">
    <div class="tab-btn-container">
        <a href="<?php echo e(url('member/signup')); ?><?php echo e(isset($_GET['next']) ? '?next='.$_GET['next'] : ''); ?>" id="tab-1">Daftar</a>
        <a href="<?php echo e(url('member/signin')); ?><?php echo e(isset($_GET['next']) ? '?next='.$_GET['next'] : ''); ?>" id="tab-2" style="background-color: #ededed">Masuk</a>
    </div>

    <div class="tab-content">
        <div id="tab-1-content">
          <?php if(count($errors) > 0): ?>
              <div class="alert alert-danger">
                  <ul>
                      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <li><?php echo e($error); ?></li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
              </div>
          <?php endif; ?>

            <form action="<?php echo e(url('member/signup')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <?php if(isset($_GET['next'])): ?>
                <input type="hidden" name="next" value="<?php echo e($_GET['next']); ?>">
                <?php endif; ?>
                <input type="hidden" name="lessons" value="">
                
                <div class="form-group <?php if($errors->has('username')): ?> has-error <?php endif; ?>">
                    <label>Username :</label>
                    <input type="text" class="form-control" name="username" value="<?php echo e(old('username')); ?>">
                    <?php if($errors->has('username')): ?> <p class="help-block"><?php echo e($errors->first('username')); ?></p> <?php endif; ?>
                </div>
                <div class="form-group <?php if($errors->has('username')): ?> has-error <?php endif; ?>">
                    <label >Email :</label>
                    <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>">
                    <?php if($errors->has('email')): ?> <p class="help-block"><?php echo e($errors->first('email')); ?></p> <?php endif; ?>
                </div>
                <div class="form-group <?php if($errors->has('password')): ?> has-error <?php endif; ?>">
                    <label >Password :</label>
                    <input type="password" class="form-control" name="password" id="password-field">
                    <span title="Click here to show/hide password" toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    
                    <?php if($errors->has('password')): ?> <p class="help-block"><?php echo e($errors->first('password')); ?></p> <?php endif; ?>
                </div>
                <div class="form-group <?php if($errors->has('password_confirmation')): ?> has-error <?php endif; ?>">
                    <label>Konfirmasi Password :</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password">
                    <span title="Click here to show/hide password" toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <?php if($errors->has('password_confirmation')): ?> <p class="help-block"><?php echo e($errors->first('password_confirmation')); ?></p> <?php endif; ?>
                </div>
                <!-- <button type="submit" class="btn btn-primary">DAFTAR</button> -->
                <button type="submit" class="btn btn-primary" style="margin: auto;" id="daftar">DAFTAR</button>
            </form>
        </div>
        <div id="tab-2-content" style="display: none;">
            <!-- <form>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email :</label>
                    <input type="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Password :</label>
                    <input type="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">MASUK</button>
                <div>
                    <a href="#"><p style="text-align: center;margin-top: 15px;">Lupa Password ?</p></a>
                </div>
            </form> -->
        </div>
    </div>
</div>
<script type="text/javascript">
  var button = document.getElementById('daftar');
  button.addEventListener(
    'click',
    function() {
      fbq('track', 'CompleteRegistration');
    },
    false
  );
</script>
<script type="text/javascript">
    $(".toggle-password").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });

    
        var lessonsid = '';
        var cek = localStorage.getItem('cart');
        if (cek != null) {
            var cart = JSON.parse(cek);
            $.each(cart, function(k,v){
                if (k>0) {
                    lessonsid += ',';
                }
                lessonsid += v.id;
            })
            $('input[name=lessons]').val(lessonsid);
        }
    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>