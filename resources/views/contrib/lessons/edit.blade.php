@extends('contrib.app')
@section('title','Edit Tutorial')
<link href='https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_editor.min.css' rel='stylesheet' type='text/css' />
<link href='https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_style.min.css' rel='stylesheet' type='text/css' />
@section('breadcumbs')

<div id="navigation">
		<div class="container">
		<ul class="breadcrumb">
						<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
            <li><a href="{{ url('contributor/lessons') }}">Kelola Tutorial</a></li>
            <li><a href="{{ url('contributor/lessons/'.$row->id.'/view') }}">View Tutorial</a></li>
            <li>Edit tutorial</li>
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
							 <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
							 {{ Session::get('success') }}
					 </div>
			 @endif

			@if(Session::has('success-delete'))
				<div class="alert alert-info alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>	<i class="icon fa fa-check"></i> Alert!</h4>
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
	      <h3>Edit Tutorial</h3>
	    </div>
	    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
            <input type="hidden" name="method" value="PUT">
	      <div class="form-group">
	        <label class="col-sm-2 control-label">Judul</label>
	        <div class="col-sm-10">
	          <input type="text" class="form-control" placeholder="Contoh:Tutorial Administrasi Server dengan ubuntu 12.04" name="title" value="{{$row->title}}">
	        </div>
				</div>
				<div class="form-group">
						<label class="col-sm-2 control-label">Deskripsi Singkat</label>
						<div class="col-sm-10">
							<textarea type="text"  required class="form-control" placeholder="deskripsi singkat mengenai tutorial" name="desk_singkat" value="{{$row->deskripsi_singkat}}">{{$row->deskripsi_singkat}}</textarea>
						</div>
				</div>
	      <div class="form-group">
	        <label class="col-sm-2 control-label">Pilih Kategori</label>
	        <div class="col-sm-10">
	          <select class="form-control" name="category_id">
	            <option value="">-</option>
							<?php foreach ($categories as $key => $value): ?>

		                            <option value="{{ $value->id }}" <?php if($value->id==$row->category_id){echo 'selected="selected"';}?>>{{ $value->title }}</option>
							<?php endforeach; ?>
	          </select>
	        </div>
	      </div>
				<div class="form-group">
	        <label class="col-sm-2 control-label">Harga</label>
	        <div class="col-sm-10">
	          <input type="text"  required class="form-control" placeholder="minimum : 10000" name="price" value="{{ $row->price }}">
	        </div>
				</div>
				<div class="form-group">
						<label class="col-sm-2 control-label">Audiens</label>
						<div class="col-sm-10">
							<input type="text"  required class="form-control" placeholder="Newbie" name="audien" value="{{ $row->audiens }}">
						</div>
				</div>
	      <div class="form-group">
	        <label class="col-sm-2 control-label">Upload gambar</label>
	        <div class="col-sm-10">
	          <input type="file" name="image" class="form-control">
              <input type="hidden" name="image_text" value="{{$row->image}}" class="form-control">
	        </div>
				</div>
				<div class="form-group">
						<label class="col-sm-2 control-label">Goal Tutorial</label>
						<div class="col-sm-10">
							<textarea id="summergoal" name="goal" value="{{$row->goal_tutorial}}">{{$row->goal_tutorial}}</textarea>
						</div>
				</div>
	      <div class="form-group">
	        <label class="col-sm-2 control-label">Description</label>
	        <div class="col-sm-10">
							<textarea id="summernote" name="description" value="{{$row->description}}">{{$row->description}}</textarea>
	        </div>
				</div>
				<div class="form-group">
						<label class="col-sm-2 control-label">Requirement</label>
						<div class="col-sm-10">
								<textarea id="textedit" name="requirement" value="{{$row->requirement}}">{{$row->requirement}}</textarea>
						</div>
					</div>
	      <div class="form-group">
	        <div class="col-sm-offset-2 col-sm-10 text-right">
	          <a href="{{ url('contributor/lessons') }}" class="btn btn-danger">Batal</a>
					<button type="submit" class="btn btn-info">Submit</button>
	        </div>
	      </div>
	    </form>
		</div>
  </div>
</div>
<!-- Include JS file. -->
<script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=i0jmzdrvxazq4u69bg81bp4ukmsok5rv2xb2dm13bfnb6u5d'></script>
{{--  <script>
	$('#summernote').summernote('code', '{!! $row->description !!}');
	$('#textedit').summernote('code', '{!! $row->requirement !!}');
	$('#summergoal').summernote('code', '{!! $row->goal_tutorial !!}');
	$('#summernote').summernote({
		height: 500,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
		focus: true,                  // set focus to editable area after initializing summernote 
	});
	$('#textedit').summernote({
		height: 500,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
		focus: true                  // set focus to editable area after initializing summernote
	});
	$('#summergoal').summernote({
		height: 500,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
		focus: true                  // set focus to editable area after initializing summernote
	});
</script>  --}}
<script>
  tinymce.init({
    selector: '#summernote'
  });
	</script>
	<script>
		tinymce.init({
			selector: '#textedit'
		});
		</script>
		<script>
			tinymce.init({
				selector: '#summergoal'
			});
			</script>
@endsection()
