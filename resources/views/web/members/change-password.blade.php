@extends('web.members.master')
@section('title','Ubah Password')
@section('member-content')
<style>
  .btn-simpan{
    background-color: #2BA8E2;
    border-radius: 3px;
    color: white;
    cursor: pointer;
    display: inline-block;
    font-size: 1em;
    padding: 10px 15px;
  }
</style>
<div>
  <h3>Akun</h3>
  
  <p>
    Kelola akun Anda disini
  </p>
  
  <hr>
</div>
@include('web.include.alerts')
<form class="form-group" action="{{ url('member/edit/akun') }}" method="post">
  {{ csrf_field() }}
  <div class="form-group @if ($errors->has('email')) has-error @endif">
    <label class="control-label">Email</label>
      <input type="email" class="form-control" name="email" value="{{ old('email', $member->email) }}">
      @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
  </div>
  <div class="form-group @if ($errors->has('username')) has-error @endif">
    <label class="control-label">Username</label>
      <input type="text" class="form-control" name="username" value="{{ old('username',$member->username) }}">
      @if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif
  </div>
  <div class="form-group">
      <button type="submit" class="btn btn-simpan">Simpan</button>
  </div>
</form>
<form action="{{ url('member/change-password') }}" method="post">
  {{ csrf_field() }}
  <div class="form-group @if ($errors->has('current_password')) has-error @endif">
    <label class=" control-label">Password Lama</label>
      <input type="password" class="form-control" name="current_password">
      @if ($errors->has('current_password')) <p class="help-block">{{ $errors->first('current_password') }}</p> @endif
  </div>
  <div class="form-group  @if ($errors->has('password')) has-error @endif">
    <label class="control-label">Password Baru</label>
      <input type="password" class="form-control" name="password">
      @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
  </div>
  <div class="form-group  @if ($errors->has('password_confirmation')) has-error @endif">
    <label class="control-label">Konfirmasi Password</label>
      <input type="password" class="form-control"  name="password_confirmation">
      @if ($errors->has('password_confirmation')) <p class="help-block">{{ $errors->first('password_confirmation') }}</p> @endif
  </div>

  <div class="form-group">
      <button type="submit" class="btn btn-simpan">Simpan</button>
  </div>
</form>

@endsection
