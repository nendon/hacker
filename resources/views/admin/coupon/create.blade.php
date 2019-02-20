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
                            Create Coupon
                        </h2>
                    <div class="body">
                        @if($errors->all())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <?php echo $error."</br>";?>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ url('system/coupon')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group ">
                              <label class="col-sm-3 form-label" style="padding-left:0px">Status</label>
                              <div class="col-sm-9">
                                <input type="checkbox" id="basic_checkbox_2" class="filled-in" checked name="enable" value="1"/>
                                <label for="basic_checkbox_2">Enable</label>
                              </div>
                            </div> <br>
                            <div class="form-group">
                            <div class="form-line">
                                <select class="form-control show-tick" name="type">
                                <option value="">-- Please select --</option>
                                <option value="fixed">Fixed</option>
                                <option value="percent">Percent</option>                                
                                </select>
                                <label class="form-label">Type</label>
                            </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Code</label>
                                <div class="form-line">
                                   <input type="text" name="code" class="form-control" value="{{ old('code') }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="form-label">Limit Coupon</label>
                                <div class="form-line">
                                   <input type="text" name="limit_coupon" class="form-control" value="{{ old('limit_coupon') }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="form-label">Minimum Harga</label>
                                <div class="form-line">
                                   <input type="text" name="minimum" class="form-control" value="{{ old('minimum_checkout') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Value</label>
                                <div class="form-line">
                                   <input type="text" name="value" class="form-control" value="{{ old('value') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Percent Off</label>
                                <div class="form-line">
                                   <input type="text" name="percent_off" class="form-control" value="{{ old('percent_off') }}">
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