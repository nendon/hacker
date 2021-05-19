@extends('admin.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Daftar Kategori
                </h2>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Tambah Bootcamp Kategori
                            </h2>
                            <div class="header-dropdown m-r--5">
                                <a href="{{action('BootcampKategoriController@create')}}" class="btn btn-primary waves-effect">Tambah Bootcamp Kategori</a>
                                <a href="{{action('BootcampSubKategoriController@create')}}" class="btn btn-primary waves-effect">Tambah Sub Bootcamp Kategori</a>
                            </div>

                        </div>
                        <div class="body">
                            @if(Session::has('success-create'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                                    {{ Session::get('success-create') }}
                                </div>
                            @endif


                            @if(Session::has('success-delete'))
                                <div class="alert alert-info alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                                    {{ Session::get('success-delete') }}
                                </div>
                            @endif
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Bootcamp Kategori</th>
                                    <th>Icon</th>
                                    <!-- <th>Description</th> -->
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Bootcamp Kategori</th>
                                    <th>Icon</th>
                                    <!-- <th>Description</th> -->
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($bootcampkategori as $key => $bootcampkategoris)
                                <tr>
                                    <td>{{$bootcampkategoris->id}}</td>
                                    <td>{{$bootcampkategoris->title}}</td>
                                    <td><i class="material-icons">{{$bootcampkategoris->cover}}</i></td>
                                    
                                    <td>
                                        <form id="{{$bootcampkategoris->id}}" action="{{ url('system/bootcampcat/'.$bootcampkategoris->id)}}" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a href="{{ url('system/bootcampcat/'.$bootcampkategoris->id.'/edit')}}" class="btn btn-info btn-xs"><i class="material-icons">remove_red_eye
                                                </i></a>
                                            <button type="submit" class="btn btn-danger btn-xs" onclick="checkdelete({{$bootcampkategoris->id}})"><i class="material-icons">close</i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                             <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Bootcamp Kategori</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Bootcamp Kategori</th>
                                    <th>Icon</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($sub as $keys)
                                <tr>
                                    <td>{{$keys->id}}</td>
                                    <td>{{$keys->bootcamp_category->title}}</td>
                                    <td>{{$keys->title}}</td>
                                    <td>{{$keys->deskripsi}}</td>
                                    
                                    <td>
                                        <form id="{{$keys->id}}" action="{{ url('system/bootcampsubcat/'.$keys->id)}}" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a href="{{ url('system/bootcampsubcat/'.$keys->id.'/edit')}}" class="btn btn-info btn-xs"><i class="material-icons">remove_red_eye
                                                </i></a>
                                            <button type="submit" class="btn btn-danger btn-xs" onclick="checkdelete({{$keys->id}})"><i class="material-icons">close</i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
    </section>
@endsection
