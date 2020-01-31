@extends('contrib.home.app')
@section('title','Cilsy Fiolution | Login Contributor')
@section('content')
<div id="sign-container">
    <div class="tab-btn-container">
      <a href="{{ url('contributor/register')}}" id="tab-1" style="background-color: #ededed">Daftar</a>
      <a href="{{ url('contributor/login')}}" id="tab-2" >Masuk</a>
    </div>

    <div class="tab-content">
        <div id="tab-1-content" style="display: none;">
            <!-- <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Lengkap :</label>
                    <input type="nama" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email :</label>
                    <input type="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Password :</label>
                    <input type="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Konfirmasi Password :</label>
                    <input type="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">DAFTAR</button>
            </form> -->
        </div>
        <div id="tab-2-content" >

            @if (Session::has('success'))
              <div class="alert alert-success">
                <strong>Well done!</strong> {{ Session::get('success') }}.
              </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong><br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ url('contributor/login') }}" method="post">
              {{ csrf_field() }}
                @if (isset($_GET['next']))
                <input type="hidden" name="next" value="{{ $_GET['next'] }}">
                @endif
                <div class="form-group @if ($errors->has('email')) has-error @endif">
                    <label for="exampleInputPassword1">Email :</label>
                    <input type="email" class="form-control" name="email">
                    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                </div>
                <div class="form-group @if ($errors->has('password')) has-error @endif">
                    <label for="exampleInputFile">Password :</label>
                    <input type="password" class="form-control" name="password">
                    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                </div>
                <button type="submit" class="btn btn-primary">MASUK</button>
                <div>
                    <a href="{{ url('contributor/password/reset') }}"><p style="text-align: center;margin-top: 15px;">Lupa Password ?</p></a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection()