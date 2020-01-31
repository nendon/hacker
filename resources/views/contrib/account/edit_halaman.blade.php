@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
    <div class="container">
    <ul class="breadcrumb">
        <li><a href="{{ url('contributor') }}">Dashboard</a></li>
        <li>Kelola Halaman</li>
    </ul>
    </div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box-white">
        @if($errors->all())
         <div class="alert\ alert-danger">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
             @foreach($errors->all() as $error)
             <?php echo $error."</br>";?>
             @endforeach
         </div>
         @endif
         @if(Session::has('success'))
             <div class="alert alert-success alert-dismissable">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h4> <i class="icon fa fa-check"></i> Alert!</h4>
                 {{ Session::get('success') }}
             </div>
         @endif

        @if(Session::has('success-delete'))
          <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
              {{ Session::get('success-delete') }}
          </div>
        @endif
        @if(Session::has('no-delete'))
          <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
              {{ Session::get('no-delete') }}
          </div>
        @endif

        <ul class="nav nav-tabs" style="margin-bottom: 20px;">
          <li class=""><a href="{{ url('contributor/account/informasi') }}">Informasi Akun</a></li>
          <li class="active"><a href="{{ url('contributor/account/profile') }}">Halaman Kontributor</a></li>
        </ul>

        <div class="tab-content" >

      <!-- left column -->
      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="col-md-3">
        <div class="text-center">
        @if(Helper::contrib('avatar') != null)
          <img src="{{$contrib->avatar}}" class="avatar img-circle" alt="avatar" style="height: 150px; width: 150px;">
        @else
          <img src="{{asset(profilcon())}}" class="avatar img-circle" alt="avatar" style="height: 150px; width: 150px;">
        @endif
          <h6>Upload a different photo...</h6>
          
          <input type="file" class="form-control" name="avatar">
          <input type="hidden" class="form-control" name="avatar" value="{{ $contrib->avatar}}">

        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">   
        
          <div class="form-group">
            <label class="col-lg-3 control-label">Username :</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="{{ $contrib->username }}" name="username">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">First name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="{{ $contrib->first_name }}" name="first_name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Last name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="{{ $contrib->last_name }}" name="last_name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Pekerjaan :</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="{{ $contrib->pekerjaan }}" name="pekerjaan">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Tempat Lahir:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="{{ $contrib->tempat_lahir }}" name="tempat_lahir">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Tanggal Lahir:</label>
            <div class="col-lg-8">
              <div class="input-group date">
              <input type="text" class="form-control" value="{{ $contrib->tanggal_lahir }}" name="tanggal_lahir">
              <div class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Bio:</label>
            <div class="col-md-8">
              <textarea class="form-control" name="bio" id="" cols="30" rows="10">{{ $contrib->deskripsi }}</textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4 pull-right">
              <input type="submit" class="btn btn-primary" value="Save Changes">
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel">
            </div>
          </div>
      </div>
      </form>
      
          </div>
        </div>
    </div>
  </div>
</div>
<script>
  $(function(){
   $('.date').datepicker({
      format: 'dd/mm/yyyy'
    });
});
</script>
@endsection()
