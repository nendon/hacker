@extends('web.app')
@section('title','Daftar | ')
@section('content')
<div id="sign-container">
    <div class="tab-btn-container">
        <a href="{{ url('contributor/register')}}" id="tab-1">Daftar</a>
        <a href="{{ url('contributor/login')}}" id="tab-2" style="background-color: #ededed">Masuk</a>
    </div>

    <div class="tab-content">
        <div id="tab-1-content">
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
                    <label>Nama Pengguna :</label>
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                    @if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif
                </div>
                <div class="form-group @if ($errors->has('username')) has-error @endif">
                    <label >Email :</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                </div>
                <div class="form-group @if ($errors->has('password')) has-error @endif">
                    <label >Password :</label>
                    <input type="password" class="form-control" name="password">
                    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                </div>
                <div class="form-group @if ($errors->has('retype_password')) has-error @endif">
                    <label>Konfirmasi Password :</label>
                    <input type="password" class="form-control" name="retype_password">
                    @if ($errors->has('retype_password')) <p class="help-block">{{ $errors->first('retype_password') }}</p> @endif
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

@endsection
