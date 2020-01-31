@extends('admin.app')
@section('content')
<section class="content">
  <div class="container-fluid">
    <!-- #END# Vertical Layout -->
    <!-- Vertical Layout | With Floating Label -->
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>
              Edit Video
            </h2>
            <div class="body">
              @if($errors->all())
              <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                <?php echo $error."</br>";?>
                @endforeach
              </div>
              @endif
              <form action="{{ url('system/videos/'.$videos->id) }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="enable" value="1">



                <div class="form-group form-float">
                  <div class="form-line">
                    <select class="form-control show-tick" name="lesson_id">
                      <option value="">-- Please select --</option>
                      @foreach($lessons as $lesson)
                      <option value="{{ $lesson->id }}" <?php if($lesson->id == $videos->lessons_id){echo "selected";} ?>>{{ $lesson->title }}</option>
                      @endforeach
                    </select>
                    <label class="form-label">Icon</label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Title</label>
                  <div class="form-line">
                    <input type="text" name="title" class="form-control" value="{{ $videos->title }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Image</label>
                  <div class="form-line">
                    <a href="{{ asset('assets/filemanager/akurapopo.php?type=0&field_id=img') }}" class="btn btn-success iframe-btn" type="button" style="margin-bottom:10px;"><i class="ion ion-android-camera"> Image</i></a>
                    <img src="{{ $videos->image }}" id="previmg" class="img-responsive" style="max-width:500px;max-height:500px;"/>
                    <input type="hidden" name="image" class="form-control" id="img" value="{{ $videos->image }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Video</label>
                  <div class="form-line">
                    <input id="video" type="text" name="video" value="{{ $videos->video }}" class="form-control">
                    <a href=javascript:open_popup("assets/filemanager/akurapopo.php?type=3&popup=1&field_id=video") class="btn" type="button">Select</a>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Durasi</label>
                  <div class="form-line">
                    <input type="text" name="durasi" class="form-control" value="{{ $videos->durasi }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Type Video</label>
                  <div class="form-line">
                    <select class="form-control show-tick" name="type">
                      <option>Choose One</option>
                      <option value="video/mp4" <?php if($videos->type_video == 'video/mp4'){echo "selected";} ?>>MP4</option>
                      <option value="video/webm" <?php if($videos->type_video == 'video/webm'){echo "selected";} ?>>Webm</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Description</label>
                  <div class="form-line">
                    <textarea name="description" class="form-control">{{ $videos->description }}</textarea>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Vertical Layout | With Floating Label -->
    </div>
  </section>
  <script>
  function changeURL(){
    var str =$('#title').val();
    str =str.replace(/\s+/g,'-').toLowerCase();
    $('#change').val(str);
  }
  </script>
  @endsection
