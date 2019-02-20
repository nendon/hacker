@extends('contrib.home.app')
@section('title','Daftar | ')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
@section('content')
<div id="sign-container">
    <div class="tab-btn-container">
        <a href="{{ url('contributor/register')}}" id="tab-1">Daftar</a>
        <a href="{{ url('contributor/login')}}" id="tab-2" style="background-color: #ededed">Masuk</a>
    </div>

    <div class="tab-content">
        <div id="tab-1-content">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <strong>Sukses !</strong> {{ Session::get('success') }}.
                </div>
            @endif
          @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

            <form action="{{ url('contributor/register') }}" method="post">
              {{ csrf_field() }}
                <div class="form-group @if ($errors->has('username')) has-error @endif">
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username">
                    @if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif
                </div>
                <div class="form-group @if ($errors->has('email')) has-error @endif">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                </div>
                <div class="form-group @if ($errors->has('password')) has-error @endif">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                </div>
                <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password">
                    @if ($errors->has('password_confirmation')) <p class="help-block">{{ $errors->first('password_confirmation') }}</p> @endif
                </div>
                <div class="form-group">
                    <input type="checkbox" class="" value="syarat" required=""><b>Saya Setuju dengan semua persyaratan layanan</b>
                </div>
                <button type="submit" class="btn btn-primary">DAFTAR</button>
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
<script>
    $(document).ready(function() {
    $('#tgl_lahir').datepicker({
    });
});
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
@endsection