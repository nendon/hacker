@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<style>
	#form-upload {
		font-size: 24px;
		position: relative;
		padding: 20px 20px;
		text-align: center;
		border: 2px dashed transparent
	}
	* {
		-webkit-transition: none!important;
		transition: unset!important
	}

	#file, #drop-icon, #draggable-text {
		display: none
	}

	#drop-icon {
		font-size: 72px;
		border: 2px dashed #000;
		border-radius: 5px;
		padding: 10px 20px;
		display: block!important;
		width: 110px;
		margin: 0 auto;
	}

	.is-draggable #drop-icon, .is-draggable #draggable-text {
		display: inline
	}
	.is-draggable #video-text {
		display: none;
	}

	.is-dragover {
		border: 2px dashed #eee !important;
		border-radius: 5px;
	}

	#form-starter {
		cursor: pointer;
	}
	#file+label:hover strong,
	#file:focus+label strong,
	#file.has-focus+label strong {
		color: #39bfd3;
		cursor: pointer;
		text-decoration: underline;
		text-decoration-style: dashed
	}

	.thumbnail {
		margin-bottom: 0;
	}

	.durasi {
		font-size: 12px;
	}
	
	.bar {
		height: 20px;
		background: #ccc;
	}
	#file-list .videos:first-child {
		margin-top: 0;
	}
	#file-list .videos {
		border: 1px solid #ccc;
		border-radius: 5px;
		margin-top: 20px;
	}
</style>
<div id="navigation">
	<div class="container">
	<ul class="breadcrumb">
		<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
		<li><a href="{{ url('contributor/lessons') }}">Kelola Tutorial</a></li>
		<li><a href="{{ url('contributor/lessons/'.$lesson->id.'/view') }}">View Video</a></li>
		<li>Video</li>
	</ul>
	</div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
	<div class="box-white">
		@if($errors->all())
			<div class="alert\ alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
				@foreach($errors->all() as $error)
					<?php echo $error."</br>";?>
				@endforeach
			</div>
			@endif
			@if(Session::has('success'))
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Alert!</h4>
				{{ Session::get('success') }}
			</div>
			@endif
		@if(Session::has('success-delete'))
			<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Alert!</h4>
				{{ Session::get('success-delete') }}
			</div>
		@endif
		@if(Session::has('no-delete'))
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
				{{ Session::get('no-delete') }}
			</div>
		@endif
	
		<div class="form-title">
			<h3>{{$lesson->title}}</h3>
		</div>
		<form id="form-upload" enctype="multipart/form-data" method="POST">
			@csrf
			<input class="input-files" type="file" name="files[]" id="file" accept=".mp4" multiple />
			<label id="form-starter" for="file">
				<span id="drop-icon" class="fa fa-angle-double-down"></span><br>
				<strong>Pilih<span id="video-text"> video</span></strong>
				<span id="draggable-text"> atau tarik video ke sini</span>
			</label>
			<div id="file-list"></div>
			<div id="btn-submit-group" class="form-group" style="display: none;">
				<div class="col-sm-12 text-right">
					<a href="{{url('contributor/lessons/'.$lesson->id.'/view')}}"class="btn btn-danger">Batal</a>
					<button id="btn-submit" type="submit" class="btn btn-info">Submit</button>
				</div>
			</div>
		</form>
	</div>
  </div>
</div>
<script type="text/javascript" src="{{asset('template/kontributor/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('template/kontributor/js/jquery-ui.min.js')}}"></script>
<script>
	var $form = $('#form-upload');
	var nVideo = {{ $count_video }};
	var ajaxCall = [];
	var videos = [];
	var allDone = 0;
	var isSubmitted = false;

	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
		
		$('#file').on('change', function(e) {
			generateList(e.target.files);
			$('[data-toggle="tooltip"]').tooltip();
			$(this).val('')
		})
		
		/* aktifkan fitr drag n' drop */
		if (isAdvancedUpload) {
			var droppedFiles = false;
			$form.addClass('is-draggable');

			$form.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
					e.preventDefault();
					e.stopPropagation();
				})
				.on('dragover dragenter', function() {
					$form.addClass('is-dragover');
				})
				.on('dragleave dragend drop', function() {
					$form.removeClass('is-dragover');
				})
				.on('drop', function(e) {
					droppedFiles = e.originalEvent.dataTransfer.files;
					generateList(droppedFiles);
				});
		}

		$form.on('submit', function(e){
			$('#btn-submit').html('menyimpan.. <i title="Jangan tutup halaman ini, data akan tersimpan otomatis setelah seluruh proses upload selesai." data-toggle="tooltip" class="fa fa-exclamation-circle"></i>').attr('disabled', true);
			e.preventDefault()
			isSubmitted = true

			videos = clearQueue(videos)
			if (allDone == videos.length) {
				$form.unbind('submit').submit()
			}

			return false;
		})
	})

    /* cek fitur drag n' drop */
    var isAdvancedUpload = function() {
        var div = document.createElement('div');
        return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
	}();
	
	/* cancel proses ajax */
	var cancelUpload = function(n) {
		var nV = videos.map(function(arr) {
			return arr.n
		}).indexOf(n)
		
		swal({
			title: "Batalkan upload?",
			text: videos[nV]['title'],
			type: "warning",
			showCloseButton: true,
			showCancelButton: true,
			cancelButtonText: 'Tidak',
			cancelButtonColor: '#3085d6',
			confirmButtonText: "Ya"
		}, function(isConfirm) {
			if (isConfirm) {
				ajaxCall[n].abort()
				$('#videobox'+n).remove()
				delete videos[nV]
				videos = clearQueue(videos)
				if (typeof videos[0] == 'undefined') {
					$('#form-starter').show();
					$('#btn-submit-group').hide();
				}
			}
		})
	}

	/* generate dropped/selected files */
	var generateList = function(files) {
		/* sembunyikan tampilan form utama */
		$('#form-starter').hide();
		$('#btn-submit-group').show();

		/* generate masing2 file */
		$.each(files, function(i, v) {
			/* siapkan variable */
			var title = v.name.split('.').slice(0, -1).join('.');
			var extension = v.name.split('.').pop();
			var extension2 = v.type ? v.type.split('/').pop() : '';
			videos[nVideo] = {
				title: title,
				status: 'ready',
				n: nVideo
			}

			/* validasi awal */
			var maxSize = 1024 * 1024 * {{ env('max_upload_size', 100) }}; // 100MB 
			if (extension != 'mp4' && extension2 != 'mp4') {
				$('#form-starter').show();
				$('#btn-submit-group').hide();
				swal("Ups", "Maaf, format video yang diperbolehkan adalah .mp4", "error");
				return false
			}
			if (v.size > maxSize) {
				$('#form-starter').show();
				$('#btn-submit-group').hide();
				swal("Ups", "Maksimal ukuran video yang dapat diunggah adalah 100MB", "error");
				return false
			}
			
			/* siapkan html */
			var html = '';
			html += '<div id="videobox' + nVideo + '" class="videos row">'+
				'<input id="id' + nVideo + '" type="hidden" name="videos[' + nVideo + '][id]">'+
				'<input id="image' + nVideo + '" type="hidden" name="videos[' + nVideo + '][image]">'+
				'<input id="video' + nVideo + '" type="hidden" name="videos[' + nVideo + '][video]">'+
				'<input id="duration' + nVideo + '" type="hidden" name="videos[' + nVideo + '][duration]">'+
				'<input id="delete' + nVideo + '" type="hidden" name="videos[' + nVideo + '][delete]" value="no">'+
				// '<input id="status' + nVideo + '" type="hidden" name="videos[' + nVideo + '][status]">'+
				'<div class="col-md-12" style="padding:0">'+
					'<div id="progress' + nVideo + '" class="progress" style="height:30px;">'+
						'<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">'+
							'<span class="nilai-persen" style="line-height: 30px;">0</span>%'+
						'</div>'+
						'<div style="position: absolute;top: -5px;right: 0;">'+
							'<div class="btn-group">'+
								'<button type="button" class="btn btn-default handle" style="padding: 4px 8px; cursor: move" title="Ubah Posisi" data-toggle="tooltip"><i class="fa fa-arrows"></i></button>'+
								'<button id="btn-cancel' + nVideo + '" type="button" class="btn btn-default" style="padding: 4px 8px;" title="Batalkan" data-toggle="tooltip" onclick="cancelUpload(' + nVideo + ')"><i class="fa fa-times"></i></button>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>'+
				'<div class="col-md-12">'+
					'<div class="col-md-3" style="padding:0">'+
						'<div id="thumbnail' + nVideo + '" class="thumbnail">'+
							'Menunggu gambar..'+
						'</div>'+
						'<span class="durasi">Durasi: <span id="waktu-durasi' + nVideo + '">...</span></span>'+
					'</div>'+
					'<div class="col-md-9" style="padding-right:0">'+
						'<div class="form-group">'+
							'<input name="videos[' + nVideo + '][title]" class="form-control" placeholder="Judul (Contoh: Pengenalan dasar terminal Ubuntu)" value="' + title + '">'+
						'</div>'+
						'<div class="form-group">'+
							'<textarea name="videos[' + nVideo + '][description]" rows="11" class="form-control" placeholder="Deskripsi (Contoh: Active Directory Domain Controller merupakan salah satu keunggulan server windows.)"></textarea>'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</div>';

			/* tampilkan ke form */
			$('#file-list').append(html);
			
			/* generate sortable */
			$("#file-list").sortable({
				handle: ".handle",
				cancel: ''
			});//.disableSelection();

			/* upload video */
			uploadVideo(v, nVideo);
			nVideo++;
		});

		/* munculkan kembali jika tidak ada video yang ditampilkan */
		if (!nVideo) {
			$('#form-starter').show();
			$('#btn-submit-group').hide();
		}
	}

	var uploadVideo = function(file, n) {
		var newForm = document.createElement('form');
		var ajaxData = new FormData(newForm);
		ajaxData.append('_token', '{{ csrf_token() }}');
		ajaxData.append('video', file);
		ajaxData.append('lesson_id', '{{ $lesson->id }}');
		ajaxData.append('position', n + 1);
		// videos[n].status = 'uploading';

		ajaxCall[n] = $.ajax({
			url: "{{ url('contributor/lessons/'.$lesson->id.'/upload/videos') }}",
			type: 'post',
			data: ajaxData,
			dataType: 'json',
			cache: false,
			contentType: false,
			processData: false,
			xhr: function () {
				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress", function (evt) {
					if (evt.lengthComputable) {
						var percentComplete = evt.loaded / evt.total;
						var percent = Math.round(percentComplete * 100);
						$('#progress'+n+' .progress-bar').css({
							width: percent + '%'
						});
						$('#progress'+n+' .progress-bar .nilai-persen').html(percent)
						if (percent === 100) {
							$('#progress'+n+' .progress-bar').removeClass('active');
							$('#progress'+n+' .progress-bar').removeClass('progress-bar-striped');
							// videos[n].status = 'done';
						}
					}
				}, false);
				
				return xhr;
			},
			success: function(res) {
				if (res.status) {
					allDone++
					
					$('#id'+n).val(res.data.id);
					$('#image'+n).val(res.data.image);
					$('#video'+n).val(res.data.video);
					$('#thumbnail'+n).html('<img src="'+res.data.image+'">');
					$('#waktu-durasi'+n).html(generateDuration(res.data.duration));
					$('#duration'+n).val(res.data.duration);

					videos = clearQueue(videos)
					if (isSubmitted && (allDone == videos.length)) {
						$form.submit()
					}
				} else {

				}
			},
			error: function() {
				// Log the error, show an alert, whatever works for you
			}
		});
	}

	var clearQueue = function(videos) {
		return videos.filter(String)
	}
</script>
@endsection()
