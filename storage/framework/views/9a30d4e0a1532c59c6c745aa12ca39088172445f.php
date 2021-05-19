<?php $__env->startPush('css'); ?>


<?php $__env->stopPush(); ?>
 <?php if(Auth::guard("members")->user()): ?> 
 <?php if(count($cekdulu) > 0): ?>
 <?php if(count($ratenow) <1): ?>
 <?echo $ratenow ?>
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" onclick="closer()">&times;</button>
        <h4 class="modal-title">Seberapa puas anda dengan Pelayanan kami ? </h4>
      </div>
      <div class="modal-body">
        <input id="input-1" name="inputrate" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" >      
        <h5>Kepuasan pelanggan akan muncul 1 bulan sekali setelah di submit</h5>
        <h5>Berfungsi untuk meningkatkan Pelayanan untuk pelanggan </h5>
        <h9>*note: close untuk melewatkan</h9>
        <div>
        <label for="comment">Comment:</label>
        </div>
        <textarea class="form-control" name="comment" rows="3" id="comment"></textarea>
      </div>
      <div class="modal-footer bg-primary">
        <button type="button" class="btn btn-success btn-lg" data-dismiss="modal" onclick="addRate()">Submit</button>
        <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"  onclick="closer()">Skip</button>
      </div>
    </div>

  </div>
</div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>

<!-- BEGIN MAIN BANNER -->
<section class="main-banner">
  <div class="container">
    <div class="row caption-area " style="margin-bottom: 65px;">
      <div class="col-md-12">
        <div class="caption">
          <div class="inner">
            <p>
              Satu-satunya Kursus Online Jaringan & Server yang dipandu sampai bisa.</br>
              Bergabung sekarang dengan 2000++ pendaftar lainnya.</br>
            </p>
            <?php if(Auth::guard("members")->user()): ?>
	            <a href="<?php echo e(url('lessons/browse/all')); ?>" class="daftar-btn">Browse</a>
            <?php else: ?>
              <a href="<?php echo e(url('member/signup')); ?>" class="daftar-btn">Daftar</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div> 
    <div class="row card-row">
      <div class="card-area">

          <div class="col-md-4">
            <div class="card">
              <strong class="title ">Interaktif</strong>
              <p class="mt-15">Bisa konsultasi dengan Trainer Profesional jika mengalami kesulitan saat praktek.</p>
            </div>
          </div>


          <div class="col-md-4 ">
            <div class="card">
              <strong class="title ">Fleksibel</strong>
              <p class="mt-15">Belajar secara online kapanpun dimanapun sesuka hati. Bahkan bisa download semua materi.</p>
            </div>
          </div>


          <div class="col-md-4 ">
            <div class="card">
              <strong class="title ">Lengkap</strong>
              <p class="mt-15">Terdapat ratusan materi berbentuk video di dukung dengan Ebook dan File Praktek</p>
            </div>
          </div>

      </div>
    </div>
  </div>
   <script type="text/javascript">
   $(window).load(function() {
    $('#myModal').modal({backdrop: 'static', keyboard: false});
  });  
</script>
<script type="text/javascript">
   function addRate() {

    var inputrate   = $('[name=inputrate]').val();
    var comment     = $('[name=comment]').val();
    var postData    =
                {
                    "_token":"<?php echo e(csrf_token()); ?>",
                    "inputrate": inputrate,
                    "comment": comment
                }
    $.ajax({
      type: "POST",
      url: "<?php echo e(url('system/rate')); ?>",
      data: postData,
      beforeSend: function() {
        // $('#hasil').html('<tr><td colspan="6">Loading...</td></tr>');
      },
      success: function (data){
          swal("Terima Kasih!", "Data Telah Kami Simpan", "success");
          $('#btnclosenewservice').click();
          store();
        }

      });
   }
</script>
<script type="text/javascript">
   function closer() {

    var inputrate   = '0';
    var comment     = 'TDK INPUT';
    var postData    =
                {
                    "_token":"<?php echo e(csrf_token()); ?>",
                    "inputrate": inputrate,
                    "comment": comment
                }
    $.ajax({
      type: "POST",
      url: "<?php echo e(url('system/rate')); ?>",
      data: postData,
      beforeSend: function() {
        // $('#hasil').html('<tr><td colspan="6">Loading...</td></tr>');
      },
      success: function (data){
          $('#btnclosenewservice').click();
          store();
          
        }

      });
   }
</script>
</section><!-- ./END MAIN BANNER -->

<?php $__env->startPush('js'); ?>



<?php $__env->stopPush(); ?>
