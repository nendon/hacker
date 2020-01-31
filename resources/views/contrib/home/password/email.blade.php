@extends('contrib.home.app')
@section('title','Cilsy Fiolution | Reset Password Contributor')
@section('content')
<div id="sign-container">

    <div class="tab-content">
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

            <form action="{{ url('contributor/password/email') }}" method="post">
              {{ csrf_field() }}
                <div class="form-group @if ($errors->has('email')) has-error @endif">
                    <label for="exampleInputPassword1">Email :</label>
                    <input type="email" class="form-control" name="email">
                    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                </div>
                <button type="submit" class="btn btn-primary">Send Reset Link Password</button>
        </div>
    </div>
</div>
@endsection()