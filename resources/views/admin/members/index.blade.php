@extends('admin.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Members
                </h2>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                List
                            </h2>
                            <div class="header-dropdown m-r--5">
                                <a href="{{ url('system/members/create')}}" class="btn btn-primary waves-effect">Create Member</a>
                            </div>
                        </div>
                        <div class="body">

                            @include('admin.include.alert')
                            
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Status</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($members as $key => $member)
                                <tr>
                                    <td>{{$member->id}}</td>
                                    <td>
                                      <?php if ($member->status == 1): ?>
                                          <div class="label label-success">Active</div>
                                      <?php else: ?>
                                          <div class="label label-danger">non active</div>
                                      <?php endif; ?>
                                    </td>
                                    <td>{{$member->username}}</td>
                                    <td>{{$member->email}}</td>
                                    <td>{{$member->created_at}}</td>
                                    <td>{{$member->updated_at}}</td>
                                    <td>
                                        <form id="{{ $member->id }}" action="{{ url('system/members/'.$member->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <div class="btn-group" role="group" aria-label="Default button group">
                                                <a href="{{ url('system/members/'.$member->id) }}/edit" class="btn bg-pink waves-effect"><i class="material-icons">mode_edit</i></a>
                                                <button type="button" class="btn bg-pink waves-effect" onclick="if (confirm('Are you sure?')) { $('#{{$member->id}}').submit() }"><i class="material-icons">delete</i></button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Status</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
    </section>
@endsection
