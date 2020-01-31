@extends('admin.app')
@section('content')
    <section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Members
            </h2>
        </div>
        <!-- #END# Vertical Layout -->
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Create New Member
                        </h2>
                    <div class="body">
                        @if($errors->all())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <?php echo $error."</br>";?>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ url('system/members')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <legend>Account</legend>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="status">
                                        <option value="">-- Please select --</option>
                                        <option value="1" <?php if(old('status') == 1){ echo "selected";} ?>>Active</option>
                                        <option value="0" <?php if(old('status') == 0){ echo "selected";} ?>>Not Active</option>
                                    </select>
                                    <label class="form-label">Icon</label>
                                </div>
                            </div>


                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                                    <label class="form-label">User name</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="email" name="email" class="form-control"  value="{{ old('email') }}">
                                    <label class="form-label">Email</label>
                                </div>
                            </div>


                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="password" name="password" class="form-control">
                                    <label class="form-label">Password</label>
                                </div>
                            </div>


                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="password" name="retype_password" class="form-control">
                                    <label class="form-label">Retype Password</label>
                                </div>
                            </div>

                            <legend>Add Services</legend>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="services_status">
                                        <option value="">-- Please select --</option>
                                        <option value="0" <?php if(old('services_status') == 0){ echo "selected";} ?>>Not Active</option>
                                        <option value="1" <?php if(old('services_status') == 1){ echo "selected";} ?>>Active</option>
                                        <option value="2" <?php if(old('services_status') == 2){ echo "selected";} ?>>Expired</option>
                                    </select>
                                    <label class="form-label">Icon</label>
                                </div>
                            </div>


                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="services_packages">
                                        <option value="">-- Please select --</option>
                                        @foreach($packages as $package)
                                            <option value="{{ $package->id }}" <?php if(old('services_packages') == $package->id){ echo "selected";} ?> >{{ $package->title }} - Rp {{ $package->price }} ( {{ $package->expired }} days )</option>
                                        @endforeach
                                    </select>
                                    <label class="form-label">Icon</label>
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
