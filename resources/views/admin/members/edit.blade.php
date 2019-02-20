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
                            Account
                        </h2>
                    </div>
                    <div class="body">
                        @if($errors->all())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <?php echo $error."</br>";?>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ url('system/members/'.$members->id)}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="_method" value="PUT">

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="category_id">
                                        <option value="">-- Please select --</option>
                                        <option value="1" <?php if($members->status == '1'){echo "selected";} ?>>Active</option>
                                        <option value="0" <?php if($members->status == '0'){echo "selected";} ?>>Non Active</option>
                                    </select>
                                    <label class="form-label">Icon</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="text" name="username" class="form-control" value="{{ $members->username }}">
                                    <label class="form-label">Username</label>
                                </div>
                            </div>


                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="email" name="email" class="form-control" value="{{ $members->email }}">
                                    <label class="form-label">Email</label>
                                </div>
                            </div>

                            <legend>Change Password</legend>

                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="password" name="password" class="form-control">
                                    <label class="form-label">Password</label>
                                </div>
                            </div>


                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="password" name="password_confirmation" class="form-control">
                                    <label class="form-label">Retype Password</label>
                                </div>
                            </div>



                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                        </form>
                    </div>
                </div>


                <div class="card">
                    <div class="header">
                        <h2>
                            Services
                        </h2>
                        <div class="header-dropdown m-r--5">
                            <button type="button" id="btncreateModal" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#createModal">Add New</button>
                        </div>


                    </div>
                    <div class="body">

                      <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                          <thead>
                          <tr>
                              <th>ID</th>
                              <th>Status</th>
                              <th>Invoice</th>
                              <th>Package</th>
                              <th>Price</th>
                              <th>Period</th>
                              <th>Created at</th>
                              <th>Updated at</th>
                              <th>Action</th>
                          </tr>
                          </thead>
                          <tbody id="services">
                            <tr>
                              <td colspan="9">Loading . . .</td>
                            </tr>
                          </tbody>
                      </table>

                    </div>
                    <script type="text/javascript">
                      $(document).ready(function() {
                          getServices();
                      });

                      function getServices() {

                        var members_id = "{{ $members->id }}";
                        var postData =
                                    {
                                        "_token":"{{ csrf_token() }}",
                                        "members_id": members_id
                                    }
                        $.ajax({
                          type: "POST",
                          url: "{{ url('system/members/getServices')}}",
                          data: postData,
                          beforeSend: function() {
                            // $('#hasil').html('<tr><td colspan="6">Loading...</td></tr>');
                          },
                          success: function (data){

                            // Adding Services
                            $('#services').html(data);

                          }
                        });
                    }

                    function openEdit(id) {

                      var services_id = id;
                      var postData =
                                  {
                                      "_token":"{{ csrf_token() }}",
                                      "services_id": services_id
                                  }
                      $.ajax({
                        type: "POST",
                        url: "{{ url('system/members/getEditServices')}}",
                        data: postData,
                        beforeSend: function() {
                          // $('#hasil').html('<tr><td colspan="6">Loading...</td></tr>');
                        },
                        success: function (data){

                          // Adding Services
                          $('#editservice').html(data);

                          $('#btneditModal').click();

                        }
                      });
                    }

                    function disabledEdit() {
                      alert("You can't edit expired services !");
                    }
                  </script>
                </div>
            </div>


        </div>
        <!-- Vertical Layout | With Floating Label -->






    </div>
    </section>

    <!-- CREATE SERVICES -->
    <!-- Modal -->
    <div id="createModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Service</h4>
          </div>

          <div class="modal-body">


              <div class="form-group form-float">
                  <div class="form-line">
                      <select class="form-control show-tick" name="services_status">
                          <option value="">-- Please select --</option>
                          <option value="0" <?php if(old('services_status') == 0){ echo "selected";} ?>>Not Active</option>
                          <option value="1" <?php if(old('services_status') == 1){ echo "selected";} ?>>Active</option>
                          <!-- <option value="2" <?php //if(old('services_status') == 2){ echo "selected";} ?>>Expired</option> -->
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


          </div>
          <div class="modal-footer">

            <button type="button" class="btn btn-primary waves-effect" onclick="addServices()">Add</button>
            <button type="button" class="btn btn-default" data-dismiss="modal" style="display:none;" id="btnclosenewservice">Close</button>
          </div>
        </div>

      </div>

      <script type="text/javascript">
          function addServices() {
                  var members_id        = "{{ $members->id }}";
                  var services_status   = $('[name=services_status]').val();
                  var services_packages = $('[name=services_packages]').val();
                  var postData =
                              {
                                  "_token":"{{ csrf_token() }}",
                                  "members_id": members_id,
                                  "services_status": services_status,
                                  "services_packages": services_packages
                              }
                  $.ajax({
                    type: "POST",
                    url: "{{ url('system/members/addServices')}}",
                    data: postData,
                    beforeSend: function() {
                      // $('#hasil').html('<tr><td colspan="6">Loading...</td></tr>');
                    },
                    success: function (data){
                      if (data == 1) { //If success add services
                        $('#btnclosenewservice').click();
                        getServices();
                      }

                    }
                  });
          }
      </script>
    </div>

    <!-- EDIT MODAL -->
    <button type="button" id="btneditModal" class="btn btn-info btn-lg" style="display:none;" data-toggle="modal" data-target="#editModal">Open Modal</button>
    <!-- Modal -->
    <div id="editModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Service</h4>
          </div>

          <div class="modal-body" id="editservice">

            <p>Loading . . .</p>

          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-primary waves-effect" onclick="editServices()">Update</button>
              <button type="button" class="btn btn-default" data-dismiss="modal" style="display:none;" id="btncloseeditservice">Close</button>
          </div>
        </div>

      </div>
    </div>

    <script type="text/javascript">

    function editServices() {
      var members_id        = "{{ $members->id }}";
      var services_id       = $('[name=edit_services_id]').val();
      var services_status   = $('[name=edit_services_status]').val();
      var services_packages = $('[name=edit_services_packages]').val();
      var postData =
                  {
                      "_token":"{{ csrf_token() }}",
                      "members_id": members_id,
                      "services_id": services_id,
                      "services_status": services_status,
                      "services_packages": services_packages
                  }
      $.ajax({
        type: "POST",
        url: "{{ url('system/members/editServices')}}",
        data: postData,
        beforeSend: function() {
          // $('#hasil').html('<tr><td colspan="6">Loading...</td></tr>');
        },
        success: function (data){
          if (data == 1) { //If success add services
            $('#btncloseeditservice').click();
            getServices();
          }

        }
      });

    }

    </script>

@endsection
