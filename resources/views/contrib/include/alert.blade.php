
@if (Session::has('success'))
  <div class="alert alert-success">
    <strong>Well done!</strong> {{ Session::get('success') }}.
  </div>
@endif


@if (Session::has('warning'))
  <div class="alert alert-warning">
    <strong>Warning!</strong> {{ Session::get('warning') }}.
  </div>
@endif

@if (Session::has('info'))
  <div class="alert alert-info">
    <strong>Info!</strong> {{ Session::get('info') }}.
  </div>
@endif

@if (Session::has('danger'))
  <div class="alert alert-danger">
    <strong>Error!</strong> {{ Session::get('danger') }}.
  </div>
@endif
