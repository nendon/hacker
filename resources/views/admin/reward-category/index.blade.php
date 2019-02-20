@extends('admin.app')
@section('content')

<title>Reward - Cilsy</title>


<!-- JQuery DataTable Css -->
<link href="{{ asset('template/admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Reward Category
                <?php
                // $access = PERMISSION_CHECK('create');
                // if($access == true){?>

                <?php //} ?>
                <ol class="breadcrumb breadcrumb-col-pink pull-right">
                    <li><a href="{{ url('system/dashboard') }}">Dashboard</a></li>
                    <li class="active">Reward Category</li>
                </ol>
                <!-- <small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small> -->
            </h2>

        </div>



        <!-- Result Table -->
        <div class="row clearfix">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            LIST
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <!-- <form action="{{ url('master/district/doprint') }}" method="post" target="_blank">
                            {{ csrf_field() }}
                            <input type="hidden" name="by" value="">
                            <input type="hidden" name="keyword" value="">
                            <button type="submit" class="btn bg-brown waves-effect">Print</button>
                        </form> -->
                        <a href="{{ url('system/reward-category/create') }}" class="btn bg-red waves-effect pull-right">Create</a>
                    </ul>
                </div>
                <div class="body">
                    <!-- will be used to show any messages -->


                    @include('admin.include.alert')

                    <div class="table table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Enable</th>
                                    <th>Category</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="result">
                                @foreach($data as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>
                                        <?php if ($row->enable == 0){ ?>
                                            <div class="label label-danger">No</div>
                                        <?php }else if ($row->enable == 1){ ?>
                                            <div class="label label-success">Yes</div>
                                        <?php } ?>
                                    </td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->created_at }}</td>
                                    <td>{{ $row->updated_at }}</td>
                                    <td>
                                        <form id="{{ $row->id }}" action="{{ url('system/reward-category/'.$row->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <div class="btn-group" role="group" aria-label="Default button group">
                                                <a href="{{ url('system/reward-category/'.$row->id) }}/edit" class="btn bg-pink waves-effect"><i class="material-icons">mode_edit</i></a>
                                                <button type="button" class="btn bg-pink waves-effect" onclick="if (confirm('Are you sure?')) { $('#{{$row->id}}').submit() }"><i class="material-icons">delete</i></button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                  <th>ID</th>
                                  <th>Enable</th>
                                  <th>Category</th>
                                  <th>Created At</th>
                                  <th>Updated At</th>
                                  <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Result Table -->
</div>
</section>


<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('template/admin/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('template/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<!-- <script src="{{ asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script> -->
<!-- <script src="{{ asset('template/admin/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script> -->
<script src="{{ asset('template/admin/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
<script src="{{ asset('template/admin/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
<script src="{{ asset('template/admin/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
<script src="{{ asset('template/admin/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
<script src="{{ asset('template/admin/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
<script src="{{ asset('template/admin/plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>

<!-- Custom Js -->
<script src="{{ asset('template/admin/js/admin.js') }}"></script>
<script src="{{ asset('template/admin/js/Reward/tables/jquery-datatable.js') }}"></script>

@endsection
