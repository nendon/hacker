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
                            Edit Pages
                        </h2>
                    <div class="body">
                        @if($errors->all())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <?php echo $error."</br>";?>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ url('system/pages/'.$data->id)}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="_method" value="PUT">



                            <div class="form-group ">
                              <label class="col-sm-3 form-label" style="padding-left:0px">Status</label>
                              <div class="col-sm-9">
                                <input type="checkbox" id="basic_checkbox_2" class="filled-in" <?php if ($data->enable== 1){ echo 'checked';}?>name="enable" value="1"/>
                                <label for="basic_checkbox_2">Enable</label>
                              </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Title</label>
                                <div class="form-line">
                                   <input type="text" name="title" class="form-control" value="{{ old('title',$data->title) }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="form-label">Url</label>
                                <div class="form-line">
                                   <input type="text" name="url" class="form-control" value="{{ old('url',$data->url) }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="form-label">Meta Description</label>
                                <div class="form-line">
                                   <input type="text" name="meta_desc" class="form-control" value="{{ old('meta_desc',$data->meta_desc) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Meta Tags</label>
                                <div class="form-line">
                                   <input type="text" name="tags" class="form-control" value="{{ old('tags',$data->tags) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Content</label>
                                <div class="form-line">
                                  <textarea rows="4" name="content" class="form-control no-resize" placeholder="Please type what you want...">{{ old('content',$data->content) }}</textarea>
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
