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
                            Edit Lesson
                        </h2>
                    <div class="body">
                        @if($errors->all())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <?php echo $error."</br>";?>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ url('system/lessons/'.$lessons->id)}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="enable" value="1">
                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="text" name="title" class="form-control" id="title" onchange="changeURL()" value="{{ $lessons->title }}">
                                    <label class="form-label">Title</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                   <input type="text" name="price" class="form-control" id="price" value="{{ $lessons->price }}">
                                    <label class="form-label">Harga</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="category_id">
                                        <option value="">-- Please select --</option>
                                        @foreach($categories as $cate)
                                            <option value="{{$cate->id}}" <?php if($cate->id == $lessons->category_id){echo "selected";} ?>>{{$cate->title}}</option>
                                        @endforeach
                                    </select>
                                    <label class="form-label">Icon</label>
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="form-label">Image</label>
                              <div class="form-line">
                                <a href="{{ asset('assets/filemanager/akurapopo.php?type=0&field_id=img') }}" class="btn btn-success iframe-btn" type="button" style="margin-bottom:10px;"><i class="ion ion-android-camera"> Image</i></a>
                                <img src="{{ $lessons->image }}" id="previmg" class="img-responsive" style="max-width:500px;max-height:500px;"/>
                                <input type="hidden" name="image" class="form-control" id="img" value="{{ $lessons->image }}">
                              </div>
                            </div>
                          @if($lessons->contributor_id == '0' ||$lessons->contributor_id == null)
                            <div class="form-group">
                            <label class="form-label">File Praktek</label>
                                <div class="form-line">
                                   <input type="file" name="file[]" id="filetiket1" class="form-control">
                                </div>
                            </div>
                            <div id="dynamic_field">

                            </div>
                             <div id="addimage" class="col-sm-12" style="padding-bottom: 20px;">
                            <button type="button" name="add" id="add" class="btn btn-success">Tambah</button>

                            </div>
                            @endif

                            <div class="form-group form-float">
                                <h2 class="card-inside-title">Deskripsi</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea rows="4" name="description" class="form-control no-resize" placeholder="Please type what you want...">
                                                    <?= $lessons->description ?>
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="form-label">Slug</label>
                                <div class="form-line">
                                   <input type="text" name="slug" class="form-control" id="change" value="{{ $lessons->slug }}">

                                </div>
                            </div>

                            <div class="form-group form-float" id ="note_revisi" style="display:none;">
                                <h2 class="card-inside-title">Notes</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea rows="2" name="notes" class="form-control no-resize" placeholder="Please type what you want...">
                                                </textarea>
                                            </divr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          @if(count($revisi) > 0)
                          <h2>Revision Lists</h2>
                            <div class="table-responsive">
                              <table class="table table-striped table-hover">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Note</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>

                                  <?php $i = 1; ?>
                                  @foreach($revisi as $value)
                                  <tr>
                                    <td>{{ $i }} <input type="hidden" name="revisi_id[]" id="revisi<?php echo $i; ?>" value="{{$value->id}}"></td>
                                    <td><?php echo nl2br($value->notes);?></td>
                                    <td>
                                        <?php
                                        if($value->status==2){
                                            echo "Revision Proses";
                                         }elseif($value->status==3){
                                            echo "Revision Failed";
                                        }elseif ($value->status==1) {
                                            echo "Revision Success";
                                        }else{
                                            echo "Revision Pending";
                                        }
                                        ?>
                                    </td>
                                    <td width="20%">
                                      <select class="form-control show-tick" id="revisi_status<?php echo $i; ?>" name="revisi_status[]" onchange="chageRevisiSatus()">
                                          <!-- <option value="">-- Please select --</option> -->
                                          <option value="0"<?php if($value->status==0){echo "selected";} ?>>Pending</option>
                                          <!-- <option value="2"<?php if($value->status==2){echo "selected";} ?>>Process</option> -->
                                          <option value="1"<?php if($value->status==1){echo "selected";} ?>>Acc</option>
                                          <option value="3"<?php if($value->status==3){echo "selected";} ?>>Failed</option>

                                      </select>
                                    </td>
                                  </tr>
                                  <?php $i++;?>
                                  @endforeach
                                </tbody>
                              </table>
                              </div>
                              @endif

                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
    </div>
    </section>
    <script type="text/javascript">
      function chageRevisi(){
        var status= $('#status').val();
        if(status==3){
          $('#note_revisi').css('display','block');
        }else{
            $('#note_revisi').css('display','none');
        }
      }
    </script>
    <script>
          function changeURL(){
            var str =$('#title').val();
            str =str.replace(/\s+/g,'-').toLowerCase();
            $('#change').val(str);
          }
      </script>
        <script>
//tiket
$(document).ready(function(){
  var i=1;
  $('#add').click(function(){
    j=++i;
    $('#dynamic_field').append('<div id="row'+i+'"><div class="col-sm-4"></div></div><div class="col-sm-7">  <div class="form-group"><div class="input-group"><div class="input-group-addon"><i class="fa fa-upload"></i></div><input type="file" name="file[]" id="filetiket'+j+'" required class="form-control"></div></div></div><div class="col-sm-1"><div class=" form-group"><button type="button" name="remove" id="'+i+'" class="btn btn-sm btn-danger btn_remove">Hapus</button></div></div></div>');
  });
  $(document).on('click', '.btn_remove', function(){
    var button_id = $(this).attr("id");
    $('#row'+button_id+'').remove();
  });

});
</script>
@endsection
