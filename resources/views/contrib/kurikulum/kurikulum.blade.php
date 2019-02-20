@extends('contrib.app')
@section('title','')
@section('breadcumbs')
@section('content')
  <!-- Main -->
      <main>
        
        <div class="alert alert-success">
          Sukses Membuat Projek
        </div>
        <!-- Container -->
        <div class="container">

          <!-- Nav -->
          <div class="row bg-white py-4">
            <div class="col-sm-4 col-xs-12">
              <h4 class="m-2">Bootcamp</h4>
            </div>
            <div class="col-sm-4 col-xs-8 text-center text-xs-left">
              <select  style="border:none;cursor: pointer;font-size: 16px;margin: 5px 0">
                @foreach ($courses as $c)
                  <option value="{{ $c->id}}" {{ ($c->id == $course->id) ? 'selected' : '' }}>{{ $c->title }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-4 col-xs-4 text-right">
              <button class="btn btn-green">+ Simpan</button>
            </div>
          </div>

          <div class="tabs-course">
            <!-- Nav Tabs -->
            <ul class="nav nav-pills mt-5" id="pills-tab" role="tablist">
              <li class="nav-item active">
                <a class="nav-link" id="pills-kurikulum-tab" data-toggle="pill" href="#pills-kurikulum" role="tab" aria-controls="pills-kurikulum" aria-selected="false">Kurikulum</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pills-bulkuploader-tab" data-toggle="pill" href="#pills-bulkuploader" role="tab" aria-controls="pills-bulkuploader" aria-selected="false">Bulk Uploader</a>
              </li>
            </ul>

            <!-- Nav Content -->
            <div class="tab-content mt-5" id="pills-tabContent">
                <!-- Tab Kurikulum -->
                <div class="tab-pane fade active in" id="pills-kurikulum" role="tabpanel" aria-labelledby="pills-kurikulum-tab">
                  
                  <div class="row">
                    <div class="col-sm-4 col-xs-12 col-sm-push-8">
                      <div class="row">
                        <div class="col-xs-12">
                          <form id="kurikulum-form">
                            <ul class="kurikulum-item" id="items">
                              <!-- Diisi Jquery -->
                            </ul>
                          </form>
                            <button type="button" class="btn btn-green w-100 mb-4" onClick="CreateLesson()">Tambah Lesson</button>
                          </div>
                        </div>
                    </div>
      
                    <div class="col-sm-8 col-xs-12 col-sm-pull-4">
                      <div id="contentItem">
                      </div>
                    </div>
                  </div>


                </div>

                <!-- Tab Bulk Uploader -->
                <div class="tab-pane fade" id="pills-bulkuploader" role="tabpanel" aria-labelledby="pills-bulkuploader-tab">
                  <!-- row Title  -->
                  <div class="box">
                      <div class="row">
                        <div class="col-xs-12 p-4">
                          <h4 class="text-inline">File Sebelah <i class="far fa-question-circle"></i></h4>
                        </div>
                      </div>
                    </div>
                </div>

            </div>

          </div>

        </div>

      </main>

      <script type="text/javascript" src="{{asset('template/kontributor/js/jquery.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('template/kontributor/js/jquery-ui.min.js')}}"></script>
    <script>
      var lastPositionSection = 0;
      var isUploading = false;

      window.onbeforeunload = function () {
          if (isUploading) {
              return "Anda sedang mengunggah video.";
          }

          return undefined;
      }
      
      $.getJSON("{{url('contributor/bootcamp/course/get/'.$course->id)}}", function (data) {
        var json = data;
        function sideBarRefresh(){
          var sideBarItem = "";
          for (var i=0;i<json.length;++i)
          {
            sideBarItem += `<li id="sideBarItem`+json[i].id+`">
                            <input type="hidden" name="positions[]" value="`+json[i].id+`">
                            <a class="linkcollapse collapsed" data-toggle="collapse" href="#collapse`+json[i].id+`" role="button">
                              <h4>
                                <i class="fa fa-bars handle"></i>
                                `+json[i].title+`
                              </h4>
                            </a>
                            <div class="collapse" id="collapse`+json[i].id+`">`;
    
            for (var o=0;o<=json[i].video_section.length;++o){
              if (json[i].video_section[o] != null){
                sideBarItem += `<div class="box mb-2">
                                    <h5>
                                      <i class="fa fa-bars"></i> &nbsp;
                                      `+json[i].video_section[o].title+`
                                    </h5>
                                    <h5 class="text-muted pl-5"><i class="fa fa-video"></i> video</h5>
                                  </a>
                                </div>`;
              }
            }
            for (var o=0;o<=json[i].project_section.length;++o){
              if (json[i].project_section[o] != null){
                sideBarItem += `<div class="box mb-2">
                                    <h5>
                                      <i class="fa fa-bars"></i> &nbsp;
                                      `+json[i].project_section[o].title+`
                                    </h5>
                                    <h5 class="text-muted pl-5"><i class="fa fa-`+json[i].project_section[o].type+`"></i> `+json[i].project_section[o].type+`</h5>
                                  </a>
                                </div>`;
              }
            }
              sideBarItem += `<div class="rowContentButton mb-4" id="rowContentButton`+json[i].id+`">
                                <a class="c-green px-4" onClick="createVideo(`+json[i].id+`)"><i class="fa fa-video"></i> Video</a>
                                <a class="c-green px-4" onClick="createProjek(`+json[i].id+`)"><i class="fa fa-file-alt"></i> Projek</a>
                              </div>
                              <button type="button" class="btn btn-outline-green" id="btnContentHide`+json[i].id+`" onClick="hideCreateContent(`+json[i].id+`)" style="display:none">Batalkan</button>
                              <button type="button" class="btn btn-green" id="btnContentShow`+json[i].id+`" onClick="showCreateContent(`+json[i].id+`)">+Tambahkan Kontent</button>
                              </div>
                            </li>`;
          }
          lastPositionSection = json.length + 1;
          $('#items').html("");
          $('#items').append(sideBarItem);
          $("#items").sortable({
            handle: ".handle",
            cancel: ''
          });
          $("#items").on( "sortupdate", function(e, ui) {
            $.ajax({
              type    : 'POST',
              url     : '{{ url("contributor/bootcamp/course/section-save-position") }}',
              data    : $('#kurikulum-form').serialize(),
              success: function(data){
                console.log(data)
              }
          })
          });
        };
    
        sideBarRefresh();
      });
      

      function CreateLesson(id){

      
 // 6c9287927c585fe101ad0da9af65d125da270059
        var contentItem = "";
          contentItem += `<h4>Tambah Lesson Baru</h4>
                          <div class="row">
                            <div class="col-xs-12 p-4">
                              <form>
                                <div class="box mb-4">
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                  <div class="form-group">
                                    <label>Judul Lesson</label>
                                    <input class="form-control" type="text" name="judul" id="judul" placeholder="Contoh: Pengelanan">
                                  </div>
                                  <div class="form-group">
                                    <label>Deskripsi Lesson</label>
                                    <input class="form-control" type="text" name="deskripsi" id="deskripsi" placeholder="Contoh: Tuliskan deskripsi atau learning objective">
                                  </div>
                                </div>
                                <div class="text-right">
                                  <button type="button" class="btn btn-outline-green px-5 mr-2" onClick="hideContentItem()">Batalkan</button>
                                  <button type="button" class="btn btn-green px-5 mr-2" onClick="addLesson({{ $course->id}})">Simpan</button>
                                  <div class="dropup">
                                    <button class="btn btn-transparent dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></button>
                                    <ul class="dropdown-menu">
                                      <li><a href="#">Dropdown</a></li>
                                      <li><a href="#">Dropdown</a></li>
                                      <li><a href="#">Dropdown</a></li>
                                    </ul>
                                  </div>
                                  <br>
                                  <button type="button" class="btn btn-outline-red px-5 mt-4" onClick="hideContentItem()">Hapus</button>
                                </div>
                              </form>
                            </div>
                          </div>`;
        $('#contentItem').html("");
        $('#contentItem').append(contentItem).slideDown(500);
      }
  
      function createVideo(id){
        var contentItem = "";
          contentItem += `<h4>Video</h4>
                          <div class="row">
                            <div class="col-xs-12 p-4">
                              <form id="drop-area">
                                <div class="box mb-4">
                                  <div class="form-group">
                                    <label>Judul Video</label>
                                    <input type="hidden" id="type" value="video">
                                    <input type="hidden" id="video_id">
                                    <input class="form-control" type="text" name="judul" id="judul" placeholder="Contoh: Pengenalan">
                                  </div>
                                  <div class="form-group">
                                    <label>Deskripsi Video</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Contoh: Deskripsi Video" rows="3"></textarea>
                                  </div>
                                  <div class="row">
                                    <div class="col-xs-12 px-4">
                                      <div class="cardx">
                                        <!-- <small class="status text-muted">Select a file or drag it over this area..</small> -->
                                        <div class="progress mb-2 d-none hide">
                                          <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0">0%</div>
                                        </div>
                                        <!-- <ul class="list-unstyled p-2" id="file` + id + `">
                                          <li class="text-muted text-center empty">No files uploaded.</li> -->
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                      <div id="drop-area-zone" data-no="` + id + `" data-title="judul-`+id+`" class="dm-uploader p-4">
                                        <div class="row">
                                          <div class="col-md-1" id="d-thumbnail">
                                            <div id="thumbnail-preview">
                                              <i class="fa fa-video"></i>
                                            </div>
                                          </div>
                                          <div class="col-md-9" id="d-text">
                                            <h6 class="text-muted">Maksimal ukuran video yang dapat diunggah adalah 100MB</h6>
                                            <h6 class="text-muted">Tarik dan lepas video ke sini</h6>
                                          </div>
                                          <div class="col-md-2">
                                            <div class="btn btn-green pull-right pull-xs-none my-2">
                                                <span>Pilih Video</span>
                                                <input type="file" name="file" accept=".mp4">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                                <div class="text-right">
                                  <button type="button" class="btn btn-outline-green px-5 mr-2" onClick="hideContentItem()">Batalkan</button>
                                  <button type="button" class="btn btn-green px-5 mr-2" onClick="addVideo(`+id+`)">Simpan</button>
                                  <div class="dropup">
                                    <button class="btn btn-transparent dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></button>
                                    <ul class="dropdown-menu">
                                      <li><a href="#">Dropdowns</a></li>
                                      <li><a href="#">Dropdown</a></li>
                                      <li><a href="#">Dropdown</a></li>
                                    </ul>
                                  </div>
                                  <br>
                                  <button type="button" class="btn btn-outline-red px-5 mt-4" onClick="hideContentItem()">Hapus</button>
                                </div>
                              </form>
                            </div>
                          </div>`;
        $('#contentItem').html("");
        $('#contentItem').append(contentItem).slideDown(500);

        $('#drop-area').dmUploader({ //
          url: '{{ url("contributor/bootcamp/course/video-create-temp") }}',
          maxFileSize: (1024 * 1024) * 100, // 100 MB 
          multiple: false,
          allowedTypes: 'video/*',
          extFilter: ['mp4'],
          extraData: {
            bootcamp_id: '{{ $course->bootcamp_id }}',
            course_id: '{{ $course->id }}',
            section_id: id,
            position: 1,
          },
          onDragEnter: function(){
            // Happens when dragging something over the DnD area
            this.addClass('active');
          },
          onDragLeave: function(){
            // Happens when dragging something OUT of the DnD area
            this.removeClass('active');
          },
          onInit: function(){
            // Plugin is ready to use
            ui_add_log('Penguin initialized :)', 'info');

            this.find('input[type="text"]').val('');
          },
          onComplete: function(){
            // All files in the queue are processed (success or error)
            ui_add_log('All pending tranfers finished');
          },
          onNewFile: function(id, file){
            // When a new file is added using the file selector or the DnD area
            ui_add_log('New file added #' + id);
            $('.progress').removeClass('hide')

            var title = file.name.split('.').slice(0, -1).join('.');
            var extension = file.name.split('.').pop();
            var extension2 = file.type ? file.type.split('/').pop() : '';
            console.log('title', title)
            console.log('extension', extension)
            console.log('extension2', extension2)

            var judul = $('#judul').val();
            if (judul == '') {
              $('#judul').val(title)
            }

            isUploading = true

            /* if (typeof FileReader !== "undefined"){
              var reader = new FileReader();
              var img = this.find('img');
              
              reader.onload = function (e) {
                img.attr('src', e.target.result);
              }
              reader.readAsDataURL(file);
            } */
          },
          onBeforeUpload: function(id){
            // about tho start uploading a file
            ui_add_log('Starting the upload of #' + id);
            ui_single_update_progress(this, 0, true);      
            ui_single_update_active(this, true);

            ui_single_update_status(this, 'Uploading...');
          },
          onUploadProgress: function(id, percent){
            // Updating file progress
            ui_single_update_progress(this, percent);
          },
          onUploadSuccess: function(id, res){
            var response = JSON.stringify(res);
            console.log('ini response', response)
            console.log('ini res', res)

            // A file was successfully uploaded
            ui_add_log('Server Response for file #' + id + ': ' + response);
            ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');

            ui_single_update_active(this, false);

            // You should probably do something with the response data, we just show it
            // this.find('input[type="text"]').val(response);
            // var judul = $('#judul').val();
            // if (judul == '') {
            //   $('#judul').val(response.data.title)
            // }
            $('#video_id').val(res.data.id)
            $('#thumbnail-preview').html('<img src="'+res.data.image+'" class="img-thumbnail"><small><center>'+generateDuration(res.data.duration)+'</center></small>')
            $('#d-thumbnail').removeClass('col-md-1').addClass('col-md-3')
            $('#d-text').removeClass('col-md-9').addClass('col-md-7 p-0')

            ui_single_update_status(this, 'Upload completed.', 'success');

            isUploading = false
          },
          onUploadError: function(id, xhr, status, message){
            // Happens when an upload error happens
            ui_single_update_active(this, false);
            ui_single_update_status(this, 'Error: ' + message, 'danger');
          },
          onFallbackMode: function(){
            // When the browser doesn't support this plugin :(
            ui_add_log('Plugin cant be used here, running Fallback callback', 'danger');
          },
          onFileSizeError: function(file){
            ui_single_update_status(this, 'File excess the size limit', 'danger');

            ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
          },
          onFileTypeError: function(file){
            ui_single_update_status(this, 'File type is not an image', 'danger');

            ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (type error)', 'danger');
          },
          onFileExtError: function(file){
            ui_single_update_status(this, 'File extension not allowed', 'danger');

            ui_add_log('File \'' + file.name + '\' cannot be added: must be an image (extension error)', 'danger');
          }
        });
      }
  
      function createProjek(id){
        var contentItem = "";
          contentItem += `<h4>Projek</h4>
                          <div class="row">
                            <div class="col-xs-12 p-4">
                              <form>
                                <div class="box mb-4">
                                  <div class="form-group">
                                    <label>Nama Projek</label>
                                    <input type="hidden" id="type" value="file">
                                    <input class="form-control" type="text" name="judul" id="judul" placeholder="Contoh: Pengelanan">
                                  </div>
                                  <div class="form-group">
                                    <label>Deskripsi Projek</label>
                                    <input class="form-control" type="text" name="deskripsi" id="deskripsi" placeholder="Tuliskan deskripsi disini">
                                  </div>
                                  <div class="form-group">
                                    <label>Instruksi Projek</label>
                                    <textarea class="form-control" type="text" name="value" id="value" cols="30" rows="10" placeholder="Tuliskan Instruksi Projek"></textarea>
                                  </div>
                                </div>
                                <div class="text-right">
                                  <button type="button" class="btn btn-outline-green px-5 mr-2" onClick="hideContentItem()">Batalkan</button>
                                  <button type="button" class="btn btn-green px-5 mr-2" onClick="addProject(`+id+`)">Simpan</button>
                                  <div class="dropup">
                                    <button class="btn btn-transparent dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></button>
                                    <ul class="dropdown-menu">
                                      <li><a href="#">Dropdown</a></li>
                                      <li><a href="#">Dropdown</a></li>
                                      <li><a href="#">Dropdown</a></li>
                                    </ul>
                                  </div>
                                  <br>
                                  <button type="button" class="btn btn-outline-red px-5 mt-4" onClick="hideContentItem()">Hapus</button>
                                </div>
                              </form>
                            </div>
                          </div>`;
        $('#contentItem').html("");
        $('#contentItem').append(contentItem).slideDown(500);
      }
      
      function removeItem(id){
        if (confirm('Yakin ingin menghapus?')) {
          $('#contentItem'+id).remove();
          $('#sideBarItem'+id).remove();
        } else {
          'OK';
        }
      };


      function addLesson(){
        var judul = $('#judul').val();
        var desk = $('#deskripsi').val();
        var dataform = new FormData();
        dataform.append('title', judul);
        dataform.append('desk', desk);
        dataform.append('course_id', '{{ $course->id}}');
        dataform.append('position', lastPositionSection)

        if (judul == '' || desk == '') {
          swal("Error", "Harap Isi data Form Yang dibutuhkan!", "error");
        } else {
          $.ajax({
              type    :"POST",
              url     :'{{ url("contributor/bootcamp/course/section-create") }}',
              data    : dataform,
              dataType : 'json',
              contentType: false,
              processData: false,
              beforeSend: function(){
                  swal({
                    title: "Membuat Course",
                    text: "Mohon Tunggu sebentar, Section sedang dibuat ",
                    imageUrl: "{{ asset('template/web/img/loading.gif') }}",
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                // Show image container
              },
              success:function(data){
                if (data.success == false) {
                  window.location.href = '{{ url("contributor/login") }}';
                } else if (data.success == true) {
                  $('#judul').val('');
                  $('#desk').val('');

                  swal({
                    title: "Section Berhasil Dibuat !",
                    showConfirmButton: true,
                    timer: 3000
                  }, function(){ 
                    location.reload();
                  });
                }
              },
              error: function (e) {
                swal.close()
              }
          });
        }
      }
  
      function addProject(id) {
        var judul = $('#judul').val();
        var desk = $('#deskripsi').val();
        var type = $('#type').val();
        var value = $('#value').val();
        dataform = new FormData();
        dataform.append('title', judul);
        dataform.append('desk', desk);
        dataform.append('type', type);
        dataform.append('value', desk);
        dataform.append('section_id', id);
        
        if (judul == '' || desk == '' || type == '' || value == '') {
          swal("Error", "Harap isi data form yang dibutuhkan!", "error");
        } else {
          $.ajax({
              type    :"POST",
              url     :'{{ url("contributor/bootcamp/course/project-create") }}',
              data    : dataform,
              dataType : 'json',
              contentType: false,
              processData: false,
              beforeSend: function(){
                  swal({
                    title: "Menyimpan projek",
                    text: "Mohon tunggu sebentar, projek sedang dibuat ",
                    imageUrl: "{{ asset('template/web/img/loading.gif') }}",
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                // Show image container
              },
              success:function(data){
                if (data.success == false) {
                  window.location.href = '{{ url("contributor/login") }}';
                } else if (data.success == true) {
                  swal({
                    title: "Projek berhasil disimpan!",
                    showConfirmButton: true,
                    timer: 3000
                  }, function(){ 
                    location.reload();
                  });
                }
              },
              error: function (e) {
                swal.close()
              }
          });
        }

          var temp = new Object();
              temp["judul"] = $('#judul').val();
              temp["deskripsi"] = $('#deskripsi').val();
              temp["type"] = $('#type').val();
              temp["value"] = $('#value').val();
    
          if (json[id].item === "") {
            json[id].item = array(temp);
            $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $(".alert-success").slideUp(500);
            });
            console.log(temp);
          } else if ( json[id].item.push(temp) ){
            $('#contentItem').slideUp(500);
            $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $(".alert-success").slideUp(500);
            });
          } else {
            alert('error');
          }
    
          sideBarRefresh();
          console.log(json);
      }

      function addVideo(id) {
        var judul = $('#judul').val();
        var desk = $('#deskripsi').val();
        var type = $('#type').val();
        var video_id = $('#video_id').val();
        dataform = new FormData();
        dataform.append('title', judul);
        dataform.append('desk', desk);
        dataform.append('type', type);
        dataform.append('video_id', video_id);
        dataform.append('section_id', id);
        
        if (judul == '' || desk == '' || type == '') {
          swal("Error", "Harap isi data form yang dibutuhkan!", "error");
        } else if (video_id == '') {
          swal("Error", "Video belum diunggah!", "error");
        } else {
          $.ajax({
              type    :"POST",
              url     :'{{ url("contributor/bootcamp/course/video-create") }}',
              data    : dataform,
              dataType : 'json',
              contentType: false,
              processData: false,
              beforeSend: function(){
                  swal({
                    title: "Menyimpan video",
                    text: "Mohon tunggu sebentar, video sedang disimpan",
                    imageUrl: "{{ asset('template/web/img/loading.gif') }}",
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                // Show image container
              },
              success:function(data){
                if (data.success == false) {
                  window.location.href = '{{ url("contributor/login") }}';
                } else if (data.success == true) {
                  swal({
                    title: "Video berhasil disimpan!",
                    showConfirmButton: true,
                    timer: 3000
                  }, function(){ 
                    location.reload();
                  });
                }
              },
              error: function (e) {
                swal.close()
              }
          });
        }
      }
  
      function hideContentItem(){
        $('#contentItem').slideUp(500);
      };
  
      function hideCreateContent(id){
        $('#rowContentButton'+id).slideUp(500);
        $('#btnContentShow'+id).show();
        $('#btnContentHide'+id).hide();
      }
  
      function showCreateContent(id){
        $('#rowContentButton'+id).slideDown(500);
        $('#btnContentHide'+id).show();
        $('#btnContentShow'+id).hide();
      }
    </script>

      <!-- dm-uploader.js : File item template -->
    <script type="text/html" id="files-template">
      <li class="media">
        <div class="media-body mb-1">
          <p class="mb-2">
            <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
          </p>
          <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
              role="progressbar"
              style="width: 0%" 
              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <hr class="mt-1 mb-1" />
        </div>
      </li>
    </script>

    <!-- dm-uploader.js : Debug item template -->
    <script type="text/html" id="debug-template">
      <li class="list-group-item text-%%color%%"><strong>%%title%%</strong>: %%message%%</li>
    </script>
@endsection()