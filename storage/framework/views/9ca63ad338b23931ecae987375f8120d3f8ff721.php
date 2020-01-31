<?php $__env->startSection('title','Order Summary '); ?>
<?php $__env->startSection('content'); ?>
<style>
    /* CSS used here will be applied after bootstrap.css */
    .shadow {
    -moz-box-shadow:    3px 3px 10px grey;
    -webkit-box-shadow: 3px 3px 10px grey;
    box-shadow:         3px 3px 10px grey;
    /* margin-top: 150px; */
    /* margin-bottom: 150px; */
    }
    .content-section {
        margin-bottom: 30px;
    }
    .cart-list {
        margin: 20px 0;
        font-size: 20px;
    }
    .cart-price {
        font-weight: bold;
        text-align: right
    }
    #cart-total {
        font-size: 16px;
        font-weight: bolder;
        margin-bottom: 20px;
    }
    #cart-total .row {
        border-top: 2px solid #e8e8e8;
        border-bottom: 2px solid #e8e8e8;
        padding: 20px 0;
    }
</style>
<div class="content-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12" style="margin-top: 50px;">
                <h3>Keranjang Belanja (<span id="tutorial-total"><?php echo e(count($carts)); ?></span> tutorial)</h3>
            </div>
        </div>
        <div class="row">
            <?php
                $total = 0;
            ?>

            <?php if(count($carts) > 0): ?>
                <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($cart->bootcamp_id != null && $cart->bootcamp != null): ?>
                        <div class="col-sm-12 well shadow">
                            <div class="row cart-list">
                                <div class="col-md-2">
                                    <center>
                                        <img src="<?php echo e(asset($cart->bootcamp->cover)); ?>" style="max-width:100%;max-height:100px;">
                                    </center>
                                </div>
                                <div class="col-md-7 cart-title">
                                    <?php echo e($cart->bootcamp->title); ?>

                                </div>
                                <div class="col-md-2 cart-price">
                                    Rp<?php echo e(number_format($cart->bootcamp->price, 0, ",", ".")); ?>

                                </div>
                                <div class="col-md-1">
                                    <form action="<?php echo e(url('cart/delete/'.$cart->id)); ?>" method="post">
                                        <?php echo e(csrf_field()); ?>

                                        <?php echo e(method_field('delete')); ?>

                                        <button class="btn btn-default btn-lg">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($cart->lesson_id != null && $cart->lesson != null): ?>
                        <div class="col-sm-12 well shadow">
                            <div class="row cart-list">
                                <div class="col-md-2">
                                    <center><img src="<?php echo e(url($cart->lesson->image)); ?>" style="max-width:100%;max-height:100px;"></center>
                                </div>
                                <div class="col-md-7 cart-title">
                                    <?php echo e($cart->lesson->title); ?>

                                </div>
                                <div class="col-md-2 cart-price">
                                    Rp<?php echo e(number_format($cart->lesson->price, 0, ",", ".")); ?>

                                </div>
                                <div class="col-md-1">
                                    <form action="<?php echo e(url('cart/delete/'.$cart->id)); ?>" method="post">
                                        <?php echo e(csrf_field()); ?>

                                        <?php echo e(method_field('delete')); ?>

                                        <button class="btn btn-default btn-lg"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php
                        if ($cart->lesson_id != null && $cart->lesson != null) {
                            $total += $cart->lesson->price;
                        }
                        else if ($cart->bootcamp_id != null && $cart->bootcamp != null) {
                            $total += $cart->bootcamp->price;
                        }
                        else if (
                            $cart->bootcamp_id != null &&
                            $cart->lesson_id != null &&
                            $cart->lesson != null &&
                            $cart->bootcamp != null
                        ) {
                            $total = $cart->bootcamp->price + $cart->lesson->price;
                        }
                        Session::put('total', $total);
                    ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <div id="cart">
                <div class="col-sm-12 well">
                    <h4>
                        <center>
                            <img src="<?php echo e(url('/template/web/img/CART.png')); ?>" width="80px"><br>
                            <span style="margin: 10px 0;display:block;">Keranjang Anda kosong. Silakan pilih tutorial yang Anda inginkan!</span><br>
                            <a href="<?php echo e(url('/lessons/browse/all')); ?>" class="btn btn-primary btn-lg" style="background-color: #3CA3E0; border:0; padding-top:20px;padding-bottom:20px">Browse Tutorial</a>
                        </center>
                    </h4>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div id="cart-total" class="row  <?php echo e(!count($carts) ? 'hide' : ''); ?>">
            <div class="col-md-offset-8 col-md-4">
                <div class="row">
                    <?php if(! session()->has('coupon')): ?>
                    <span class="col-md-12" style="display:block; color:#2BA8E2;">Gunakan Kode Promo</span>
                    <form action="<?php echo e(url('coupon')); ?>" method="POST" id="form">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" value="<?php echo e($total); ?>" name="total">
                        <div class="input-group">
                        <input type="text" class="form-control" placeholder="Promo Code" name="coupon_code">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit" style="background-color: #3CA3E0;">Gunakan</button>
                        </span>
                        </div><!-- /input-group -->
                    </form>
                        <?php if(count($errors) > 0): ?>
                            <div class="spacer"></div>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo $error; ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="col-md-6">
                        Total
                    </div>
                    <div class="col-md-6" style="text-align:right">
                        <span id="total-price">Rp. <?php echo e(number_format($total, 0, ",", ".")); ?></span>
                    </div>
                    <div class="col-md-6">
                    <?php if(session()->has('coupon')): ?>
                    Diskon <span style="font-size:11px; color:blue;"><?php echo e(session()->get('coupon')['name']); ?></span>
                    <form action="<?php echo e(url('coupon/delete')); ?>" method="POST" style="display:inline">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('delete')); ?>

                        <button type="submit" style="font-size:14px" class="btn-link" alt="Hapus Voucher"><i class="fa fa-trash"></i></button>
                    </form>
                    </div>
                    <div class="col-md-6" style="text-align:right">
                        <?php if(session()->get('coupon')['type'] == 'fixed'): ?>
                        Rp. <?php echo e(number_format(session()->get('coupon')['value'], 0, ",", ".")); ?>

                        <?php elseif(session()->get('coupon')['type'] == 'percent'): ?>
                        Diskon <?php echo e(session()->get('coupon')['percent_off']); ?> %
                        <?php endif; ?>
                    <?php endif; ?>
                    </div>
                    <?php if(session()->has('coupon')): ?>
                    <div class="col-md-6 bawah">
                    </div>
                    <div class="col-md-6 bawah">
                    </div>
                    <div class="col-md-6 bawah">
                    </div>
                    <div class="col-md-6 bawah">
                    Total Pembayaran
                    </div>
                    <?php else: ?>
                    <div class="col-md-6 bawah">
                    </div>
                    <div class="col-md-6">
                        Total Pembayaran
                    </div>
                    <?php endif; ?>
                    <div class="col-md-6" style="text-align:right">
                        <?php if(session()->has('coupon')): ?>
                        <span id="total-price">Rp. <?php echo e(number_format(getNumbers()->get('newSubtotal'), 0, ",", ".")); ?></span>
                        <?php else: ?>
                        <span id="total-harga">Rp. <?php echo e(number_format($total, 0, ",", ".")); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-12">
                        <?php if(session()->has('success_message')): ?>
                            <div class="spacer"></div>
                            <div class="alert alert-success">
                                <?php echo e(session()->get('success_message')); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="cart-pay" class="row  <?php echo e(!count($carts) ? 'hide' : ''); ?>">
            <div class="col-md-offset-8 col-md-4" style="padding:0">
                <form action="<?php echo e(url('member/checkout')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <button class="btn btn-primary btn-lg btn-block" id="inicheckout" style="background-color: #3CA3E0; border:0; padding-top:20px;padding-bottom:20px">Pilih Metode Pembayaran</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
fbq('track', 'AddToCart');
</script>

<script type="text/javascript">
  var button = document.getElementById('inicheckout');
  button.addEventListener(
    'click',
    function() {
      fbq('track', 'InitiateCheckout');
    },
    false
  );
</script>

<?php if(!Auth::guard('members')->user()): ?>
<script>
    $('document').ready(function(){
        var cart = localStorage.getItem('cart');
        if (cart != null) {
            var carts = JSON.parse(cart);
            if (carts.length > 0){
                var html = '';
                var total = 0;
                $.each(carts, function(k,v) {
                    html += '<div id="cart-'+v.id+'" class="col-sm-12 well shadow">';
                    html += '<div class="row cart-list">';
                    html += '<div class="col-md-2">'
                    html += '<center><img src="'+v.image+'" style="max-width:100%;max-height:100px;"></center>';
                    html += '</div>';
                    html += '<div class="col-md-7 cart-title">';
                    html += v.title;
                    html += '</div>'
                    html += '<div class="col-md-2 cart-price">';
                    html += 'Rp'+v.price.toLocaleString('id', 'idr');
                    html += '</div>';
                    html += '<div class="col-md-1">';
                    html += '<button type="button" onclick="deleteCart('+v.id+')" class="btn btn-default btn-lg"><i class="fa fa-trash"></i></button>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    total += parseInt(v.price);
                });
                $('#tutorial-total').html(carts.length);
                $('#cart').html(html);
                $('#cart-total, #cart-pay').removeClass('hide');
                $('#total-price').html('Rp'+total.toLocaleString('id', 'idr'));
                $('#total-harga').html('Rp'+total.toLocaleString('id', 'idr'));
            }
        }
    });
</script>

<?php endif; ?>
<script>
$(document).ready(function(){
    $("#hide").click(function(){
        document.getElementById('form').style.display = 'block';
        document.getElementById('hide').style.display = 'none';
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>