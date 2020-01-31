@push('css')


@endpush

<!-- BEGIN CONTRIBUTORS PROFILE HEADER-->
<section class="contributor-profile-header pt-25 pb-25 mb-25">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
          <img src="{{ asset('template/kontributor/img/icon/contributor-profesional.png') }}" alt="" class="img-responsive img-center" width="150">
      </div>
      <div class="col-md-9 middle-wrap">
        <!-- <div class=""> -->
          <div class="inner">
            <strong>{{ $contributors->username }}</strong>
            <p class="help-block">{{ $contributors->pekerjaan }}</p>
          </div>
        <!-- </div> -->
      </div>
    </div>
  </div>
</section><!-- ./END CONTRIBUTORS PROFILE HEADER -->

@push('js')
<!-- <script type="text/javascript">
  $(document).ready(function () {
    var h = $('.middle-wrap').height();
    $('.middle-wrap').height();
  });
</script> -->


@endpush
