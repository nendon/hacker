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
                            Edit Files
                        </h2>
                    <div class="body">
                        @if($errors->all())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <?php echo $error."</br>";?>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ url('system/files/'.$files->id)}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="enable" value="1">
                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="text" name="title" class="form-control" value="{{ $files->title }}">
                                    <label class="form-label">Title</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="lesson_id">
                                        <option value="">-- Please select --</option>
                                        @foreach($lessons as $lesson)
                                            <option value="{{$lesson->id}}" <?php if($lesson->id == $files->lesson_id){echo "selected";} ?>>{{ $lesson-> title}}</option>
                                        @endforeach
                                    </select>
                                    <label class="form-label">Lessons</label>
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="form-label">Source</label>
                              <div class="form-line">
                                <a href="{{ asset('assets/filemanager/akurapopo.php?type=2&field_id=files') }}" class="btn btn-success iframe-btn" type="button" style="margin-bottom:10px;"><i class="ion ion-android-camera"> Choose File</i></a>
                                <input type="text" name="source" class="form-control" id="files" value="{{ $files->source }}">
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
        <script>
//tiket
$(document).ready(function(){
  var i=1;
  $('#add').click(function(){
    j=++i;
    $('#dynamic_field').append('<div id="row'+i+'"><div class="col-sm-4"></div></div><div class="col-sm-7">  <div class="form-group"><div class="input-group"><div class="input-group-addon"><i class="fa fa-upload"></i></div><input type="file" name="file[]" id="filetiket'+j+'" required class="form-control"></div></div></div><div class="col-sm-1"><div class=" form-group"><button type="button" name="remove" id="'+i+'" class="btn btn-sm btn-danger btn_remove">Hapus</button></div></div></div>');
  });
  $(document).on('click', '.btn_remove', function(){
    var button_id = $(this).attr("id");
    $('#row'+button_id+'').remove();
  });

});
</script>
@endsection
