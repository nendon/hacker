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
                            Create Page
                        </h2>
                    <div class="body">
                        @if($errors->all())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <?php echo $error."</br>";?>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ url('system/pages')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group ">
                              <label class="col-sm-3 form-label" style="padding-left:0px">Status</label>
                              <div class="col-sm-9">
                                <input type="checkbox" id="basic_checkbox_2" class="filled-in" checked name="enable" value="1"/>
                                <label for="basic_checkbox_2">Enable</label>
                              </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Title</label>
                                <div class="form-line">
                                   <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="form-label">Url</label>
                                <div class="form-line">
                                   <input type="text" name="url" class="form-control" value="{{ old('url') }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="form-label">Meta Description</label>
                                <div class="form-line">
                                   <input type="text" name="meta_desc" class="form-control" value="{{ old('meta_desc') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Meta Tags</label>
                                <div class="form-line">
                                   <input type="text" name="tags" class="form-control" value="{{ old('tags') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Content</label>
                                <div class="form-line">
                                  <textarea rows="4" name="content" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
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
