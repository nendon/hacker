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
                            Tambah Bootcamp Kategori
                        </h2>
                    <div class="body">
                        @if($errors->all())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <?php echo $error . "</br>"; ?>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{action('BootcampKategoriController@store')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="nama_kat" class="form-control">
                                    <label class="form-label">Bootcamp Kategori</label>
                                </div>
                            </div>

                            <div class="form-group ">
                              <label class="form-label">Cover</label>
                              <div class="form-line">
                                <a href="{{ asset('assets/filemanager/akurapopo.php?type=0&field_id=img') }}" class="btn btn-success iframe-btn" type="button" style="margin-bottom:10px;"><i class="material-icons">camera_enhance</i></a>
                                <img src="" id="previmg" class="img-responsive" style="max-width:500px;max-height:500px;"/>
                                <input type="hidden" name="icon" class="form-control" id="img">
                              </div>
                            </div>
                            <div class="form-group form-float">
                                <h2 class="card-inside-title">Deskripsi</h2>
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