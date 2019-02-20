@extends('admin.app')
@section('content')
<section class="content">
  <div class="container-fluid">
    <!-- #END# Vertical Layout -->
    <!-- Vertical Layout | With Floating Label -->
    <div class="row clearfix">
      <div class="col-sm-12">
        <div class="card">
          <div class="header">
            <h2>
              Create Videos
            </h2>
            <div class="body">
              @if($errors->all())
              <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                <?php echo $error."</br>";?>
                @endforeach
              </div>
              @endif
              <form action="{{ url('system/videos/') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">


                <div class="form-group form-float">
                  <div class="form-line">
                    <select class="form-control show-tick" name="lesson_id">
                      <option value="">-- Please select --</option>
                      @foreach($lessons as $lesson)
                      <option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
                      @endforeach
                    </select>
                    <label class="form-label">Icon</label>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Title</label>
                  <div class="form-line">
                    <input type="text" name="title" class="form-control">
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
                  <label class="form-label">Video</label>
                  <div class="form-line">
                    <input id="video" type="text" name="video" value="" class="form-control">
                    <a href=javascript:open_popup("assets/filemanager/akurapopo.php?type=3&popup=1&field_id=video") class="btn" type="button">Select</a>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Durasi</label>
                  <div class="form-line">
                    <input type="text" name="durasi" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Type Video</label>
                  <div class="form-line">
                    <select class="form-control show-tick" name="type">
                      <option>Choose One</option>
                      <option value="video/webm">MP4</option>
                      <option value="video/webm">Webm</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Description</label>
                  <div class="form-line">
                    <textarea name="description" class="form-control"></textarea>
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label class="form-label">Upload Video</label>
                  <div class="form-line">
                    <div class="table-responsive" style=" display: inline-table;">
                      <table class="table table-bordered">
                        <tbody id="append">
                          <tr>
                              <td width="200">
                              <input id="video" type="text" name="video" value="" class="form-control">
                              <a href=javascript:open_popup("assets/filemanager/akurapopo.php?type=3&popup=1&field_id=video") class="btn" type="button">Select</a>

                              </td>
                              <td>
                              <button type="button" name="remove" id="'+j+'" class="btn btn-sm btn-danger btn_remove">
                              <i class="material-icons">delete</i>
                              </button>
                              </td>
                              </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div> -->

                <!-- <button type="button" id="add" class="btn btn-success">
                  <i class="material-icons">plus_one</i>
                </button> -->

                <!-- </div> -->

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
  // function changeURL(){
  //   var str =$('#title').val();
  //   str =str.replace(/\s+/g,'-').toLowerCase();
  //   $('#change').val(str);
  // }
  </script>
  <script>
  // function readURL(input) {
  //   if (input.files && input.files[0]) {
  //     var reader = new FileReader();
  //
  //     reader.onload = function (e) {
  //       $('#viewimg').attr('src', e.target.result);
  //     }
  //
  //     reader.readAsDataURL(input.files[0]);
  //   }
  // }
  //
  // function readURL(input) {
  //   if (input.files && input.files[0]) {
  //     var reader = new FileReader();
  //
  //     reader.onload = function (e) {
  //       $('#viewimg').attr('src', e.target.result);
  //     }
  //
  //     reader.readAsDataURL(input.files[0]);
  //   }
  // }
  //
  // function readURL2(input) {
  //   if (input.files && input.files[0]) {
  //     var reader = new FileReader();
  //
  //     reader.onload = function (e) {
  //       $("#view"+input.id).attr('src', e.target.result);
  //     }
  //
  //     reader.readAsDataURL(input.files[0]);
  //   }
  // }
  //
  // $("#img").change(function(){
  //   readURL(this);
  // });
  </script>

  <script>
  // $(document).ready(function(){
    // var i=0;
    // $('#add').click(function(){
    //   j=++i;
    //   if(j<=6)
    //   $('#dynamic_field').append('<tr id="row'+i+'">  <td><img src="" id="viewimgpen'+ j +'" width="100" height="80"/></td><td width="70%"><input type="file" readonly name="gallery[]"class="form-control name_list" id="imgpen'+ j +'" required/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-sm btn-danger btn_remove"><i class="material-icons">delete</i></button></td></tr> <tr><td colspan="3"><div class="form-line"><input type="text" name="title[]" class="form-control" id="title" onchange="changeURL()" placeholder="Title Video"></div> </td> </tr> <tr><td colspan="3"><div class="form-line"><input type="text" name="slug[]" class="form-control" id="change"></div></td></tr>');
    //   $("#imgpen"+j).change(function(){
    //     readURL2(this);
    //   });
    // });
    // $(document).on('click', '.btn_remove', function(){
    //   var button_id = $(this).attr("id");
    //   $('#row'+button_id+'').remove();
    // });
    // $(document).getElementsByName('type')[0].onchange = function() {
    //   if (this.value=='blank') alert('Select something !');
    // };
  // });
  </script>



  <script type="text/javascript">
  //
  // $(document).ready(function() {
  //   var i = 0;
  //   $('#add').click(function() {
  //     j=++i;
  //     $('#append').append('<tr>'+
  //         '<td width="200">'+
  //         '<input id="fieldID'+j+'" type="text" name="video[]" value="" class="form-control">'+
  //         '<a href=javascript:open_popup("assets/filemanager/akurapopo.php?type=3&popup=1&field_id=fieldID'+j+'") class="btn" type="button">Select</a>'+
  //         '</td>'+
  //         '<td>'+
  //         '<button type="button" name="remove" id="'+j+'" class="btn btn-sm btn-danger btn_remove">'+
  //         '<i class="material-icons">delete</i>'+
  //         '</button>'+
  //         '</td>'+
  //         '</tr>');
  //
  //   });
  // });

  function open_popup(url)
  {

    var base_url = window.location.origin + '/' + url;
// =======
//     var base_url = window.location.origin + "/" + url;
// >>>>>>> 1fa815fe4e57ea91c86e2d39bbac4250199260bc
    var w = 880;
    var h = 570;
    var l = Math.floor((screen.width-w)/2);
    var t = Math.floor((screen.height-h)/2);
    var win = window.open(base_url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);

  }
  </script>
  @endsection
