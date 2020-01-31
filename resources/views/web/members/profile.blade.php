@extends('web.members.master')
@section('title','Profil ')
@section('member-content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="{{ asset('template/web/css/bootstrap-tagsinput.css') }}">
<style>
    .avatar{
      height: 500px;
      width: 500px;
    }
    .inputfile {
      width: 0.1px;
      height: 0.1px;
      opacity: 0;
      overflow: hidden;
      position: absolute;
      z-index: -1;
    }
    .inputfile + label {
      background-color: #2BA8E2;
      border-radius: 3px;
      color: white;
      cursor: pointer;
      display: inline-block;
      font-size: 1em;
      padding: 10px 15px;
    }
    .inputfile + label span {
      padding-left: 10px;
    }
    .inputfile:focus + label, .content .inputfile + label:hover {
      background-color: #5f36b3;
    }
    input.input-profile{
      background-color: #F5F5F5;
    }
    textarea.form-control{
      background-color: #F5F5F5;

    }

    .btn-simpan{
      background-color: #2BA8E2;
      border-radius: 3px;
      color: white;
      cursor: pointer;
      display: inline-block;
      font-size: 1em;
      padding: 10px 15px;
    }
    .buttons {
      padding: 2rem 0 0 0;
    }
    
    .buttons label {
      line-height: 1rem;
      vertical-align: middle;
    }
    
    
    
    /* 
    hide generic checkbox that belongs to 
    the div with the class-name "custom" 
    */
    .buttons [type="checkbox"] {
      display: none;
    }
    
    /* create container to take role of checkbox */
    .buttons label::before {
      content: "";
      display: inline-block;
      width: 20px;
      height: 20px;
      margin: 0 10px 0 0;
      font-size: 1.5rem;
      border: 2px solid #2BA8E2;
      border-radius: 3px;
      vertical-align: middle;
    }
    
    /* add checkmark once the label is clicked */
    .buttons [type="checkbox"]:checked + label::before {
      text-align: center;
      content: "\2714";
      background-color: white;
      color: #2BA8E2;
    }
    .bootstrap-tagsinput {
      background-color: #F5F5F5;
      border: 1px solid #ccc;
      box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
      display: block;
      padding: 4px 6px;
      color: #555;
      vertical-align: middle;
      border-radius: 4px;
      max-width: 100%;
      line-height: 22px;
      cursor: text;
  }
  .bootstrap-tagsinput input {
      border: none;
      box-shadow: none;
      outline: none;
      background-color: transparent;
      padding: 0 6px;
      margin: 0;
      width: auto;
      max-width: inherit;
  }
</style>
<div>
  <a href="{{ url('member/profile/'.$members->username) }}" class="btn pull-right" style="background-color:#fff; color:#5bc0de; border-color:#46b8da;">Lihat Profil</a>
  <h3>Profil</h3>
  
  <p>
    Ubah informasi tentang diri anda disini
  </p>
  
  <hr>
</div>

@include('web.include.alerts')
<form class="form-horizontal" action="{{ url('member/profile/edit') }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="form-group">
    <div class="col-md-4 col-sm-12">
      @if($members->avatar != null)
      <img class="img-circle img-responsive" src="{{$members->avatar}}" alt="avatar" style="height: 200px; width: 200px;">
      @else
      <img class="img-circle img-responsive" src="{{asset(profil())}}" alt="avatar" style="height: 150px; width: 150px;">
      @endif
    </div>
    <div class="col-md-8 col-sm-12">
        <input class="inputfile" type="file" name="avatar" id="file"/>
        <label for="file"><i class="fa fa-upload"></i><span>Ubah Foto Profil</span></label>
        <p class="help-block">JPG, GIF, atau PNG. Ukuran Maksimum 800 KB</p>
    </div>

  </div>

  <div class="form-group @if ($errors->has('full_name')) has-error @endif">
    <div class="col-md-12">
      <label for="nama lengkap">Nama Lengkap</label>
        <input type="text" class="form-control input-profile" placeholder="Nama Lengkap" name="full_name" value="{{ old('full_name',$members->full_name) }}">
        @if ($errors->has('full_name')) <p class="help-block">{{ $errors->first('full_name') }}</p> @endif
    </div>
      
  </div>
  <div class="form-group @if ($errors->has('gender')) has-error @endif">
    <div class="col-md-12">
    <label class="">Jenis Kelamin</label><br>
    <label class="radio-inline"><input type="radio" name="gender" value="male" {{ $members->gender == 'male' ? 'checked' : '' }}>Laki-Laki</label>
    <label class="radio-inline"><input type="radio" name="gender" value="female" {{ $members->gender == 'female' ? 'checked' : '' }}>Perempuan</label>
    </div>
  </div>

  <div class="form-group @if ($errors->has('tanggal_lahir')) has-error @endif">
    <div class="col-md-12">
      <label for="">Tanggal Lahir</label><br>
        <input type="text" name="bornday" class="datepicker form-control input-profile" data-date-format="yyyy-mm-dd" value="@if($members->tanggal_lahir != null){{ old('tanggal_lahir', $members->tanggal_lahir->format('Y-m-d')) }}@endif">
    </div>
  </div>
  <div class="form-group @if ($errors->has('lokasi')) has-error @endif">
      <div class="col-sm-12">
        <label for="">Lokasi</label><br>
          <input type="text" name="lokasi" class="form-control input-profile" placeholder="Beritahu kami kota, provinsi, atau negara tempat anda tinggal sekarang" value="{{ old('lokasi', $members->lokasi) }}">
      </div>
  </div>
  <div class="form-group @if ($errors->has('keahlian')) has-error @endif">
      <div class="col-md-12">
        <label for="">Keahlian / Kemampuan</label><br>
        <input type="text" name="keahlian" class="input-profile"  value="{{ old('keahlian', $members->keahlian) }}" data-role="tagsinput" />
      </div>
    </div>
    <div class="form-group @if ($errors->has('instansi')) has-error @endif">
        <div class="col-md-12">
          <label for="">Instansi/Perusahaan</label><br>
            <input type="text" name="instansi" class="input-profile form-control" placeholder="Beritahu kami dimana anda bekerja" value="{{ old('instansi', $members->instansi) }}">
        </div>
      </div>
    <div class="form-group @if ($errors->has('role')) has-error @endif">
      <div class="col-md-12">
        <label for="">Jabatan / Peran</label><br>
          <input type="text" name="role" class="form-control input-profile" placeholder="Jabatan atau peran yang anda miliki" value="{{ old('role', $members->role) }}">
      </div>
    </div>
    <div class="form-group @if ($errors->has('bio')) has-error @endif">
        <div class="col-md-12">
          <label for="">Bio</label><br>
            <textarea name="bio" id="" class="form-control" value="{{ old('bio', $members->bio) }}">{{$members->bio}}</textarea>
        </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <div class="buttons">
              <input type="checkbox" id="st-custom" name="public" value="1" {{ old('public', $members->public)  ? ' checked' : '' }} >
              <label for="st-custom">Izinkan Komunitas Cilsy melihat profil saya</label>
            </div>
      </div>
    </div>
  <div class="form-group">
    <div class="col-md-12 col-sm-12">
      <button type="submit" class="btn btn-simpan">Simpan Perubahan</button>
    </div>
  </div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('template/web/js/bootstrap-tagsinput.min.js') }}"></script>
<script>
    $('.datepicker').datepicker();
    $('.tags').bind('keypress', false);
    
</script>
@endsection
