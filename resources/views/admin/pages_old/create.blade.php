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
                            Tambah Lesson
                        </h2>
                    <div class="body">
                        @if($errors->all())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <?php echo $error."</br>";?>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ url('system/page')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="form-group ">
                            <label class="col-sm-3 form-label">Status</label>
                            <div class="col-sm-9">
                                  <input type="checkbox" id="basic_checkbox_2" class="filled-in" checked name="status"/>
                                <label for="basic_checkbox_2">Enable</label>
                            </div>
                          </div>
                          <br>
                            <div class="form-group ">
                                <div class="form-line">
                                   <input type="text" name="title" class="form-control" id="title" onchange="changeURL()">
                                    <label class="form-label">Title</label>
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="form-label">Url</label>
                                <div class="form-line">
                                   <input id="change" type="text" class="form-control" name="slug">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="text" name="meta_tags" class="form-control">
                                    <label class="form-label">Meta Tag</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <h2 class="card-inside-title">Meta Descripition</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea rows="4" name="meta_desc" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="form-label">Image</label>
                              <div class="form-line">
                                <a href="{{ asset('assets/filemanager/dialog.php?type=0&field_id=img') }}" class="btn btn-success iframe-btn" type="button" style="margin-bottom:10px;"><i class="ion ion-android-camera"> Image</i></a>
                                <img src="" id="previmg" class="img-responsive" style="max-width:500px;max-height:500px;"/>
                                <input type="hidden" name="image" class="form-control" id="img">
                              </div>
                            </div>
                            <div class="form-group form-float">
                                <h2 class="card-inside-title">Content</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea rows="4" name="content" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                            </div>
                                        </div>
                                    </div>
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
