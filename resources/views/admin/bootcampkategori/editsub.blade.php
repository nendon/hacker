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
                            Edit Bootcamp Sub Kategori
                        </h2>
                    <div class="body">
                        @if($errors->all())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <?php echo $error . "</br>"; ?>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ url('system/bootcampsubcat/'.$bsc->id)}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="_method" value="PUT">
                            <!-- input type="hidden" name="enable" value="1"> -->
                            <div class="form-line">
                                <select class="form-control show-tick" name="bcid">
                                    <option value="">-- Please Select Sub Kategori --</option>
                                    @foreach($bcid as $bcids)
                                        <option value="{{$bcids->id}}">{{$bcids->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Title</label>
                                <div class="form-line">
                                    <input type="text" name="title" class="form-control" value="{{$bsc->title}}">
                                    
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <h2 class="card-inside-title">Deskripsi</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea rows="4" name="deskripsi" class="form-control no-resize" value="" placeholder="Please type what you want...">{{$bsc->deskripsi}}</textarea>
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
@endsection