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
                            Create Reward
                        </h2>
                    <div class="body">
                        @if($errors->all())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <?php echo $error."</br>";?>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ url('system/reward')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group ">
                              <label class="col-sm-3 form-label" style="padding-left:0px">Status</label>
                              <div class="col-sm-9">
                                <input type="checkbox" id="basic_checkbox_2" class="filled-in" checked name="enable" value="1"/>
                                <label for="basic_checkbox_2">Enable</label>
                              </div>
                            </div>


                            <div class="form-group">
                                <label class="form-label">Code</label>
                                <div class="form-line">
                                   <input type="text" name="code" class="form-control" value="{{ old('code') }}">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Category</label>
                                <div class="form-line">
                                    <select class="form-control show-tick" name="cat">
                                        <option value="">-- Please select --</option>
                                        @foreach($cat as $cats)
                                            <option value="{{$cats->id}}">{{$cats->name}}</option>
                                        @endforeach
                                    </select>
                                    <label class="form-label">Icon</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Title</label>
                                <div class="form-line">
                                   <input type="text" name="name" class="form-control"  id="title" onchange="changeURL()" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="form-label">Slug</label>
                                <div class="form-line">
                                   <input type="text" name="slug" class="form-control" id="change">

                                </div>
                            </div>
                            <div class="form-group">
                            <label class="form-label">Url Reward</label>
                                <div class="form-line">
                                   <input type="text" name="url" class="form-control">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <div class="form-line">
                                     <textarea rows="4" name="desc" class="form-control" placeholder="Please type what you want..."></textarea>
                                </div>
                            </div>

                              <div class="form-group form-float">
                                  <label class="form-label">Type</label>
                                  <div class="form-line">
                                      <select class="form-control show-tick" name="type">
                                            <option value="persent">Percent(%)</option>
                                            <option value="ammount">Ammount(Rp)</option>
                                      </select>
                                      <label class="form-label">Icon</label>
                                  </div>
                              </div>

                            <div class="form-group">
                                <label class="form-label">Value</label>
                                <div class="form-line">
                                   <input type="text" name="value" class="form-control" value="{{ old('value') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Point</label>
                                <div class="form-line">
                                   <input type="text" name="poin" class="form-control" value="{{ old('poin') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Start</label>
                                <div class="form-line">
                                   <input type="date" name="start" class="form-control" value="{{ old('start') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">End</label>
                                <div class="form-line">
                                   <input type="date" name="end" class="form-control" value="{{ old('end') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Limit</label>
                                <div class="form-line">
                                   <input type="text" name="limit" class="form-control" value="{{ old('limit') }}">
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="form-label">Image</label>
                              <div class="form-line">
                                <a href="{{ asset('assets/filemanager/akurapopo.php?type=0&field_id=img') }}" class="btn btn-success iframe-btn" type="button" style="margin-bottom:10px;"><i class="ion ion-android-camera"> Image</i></a>
                                <img src="" id="previmg" class="img-responsive" style="max-width:500px;max-height:500px;"/>
                                <input type="hidden" name="image" class="form-control" id="img">
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
