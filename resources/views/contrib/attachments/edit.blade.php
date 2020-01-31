@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<style media="screen">
	.select-file{
	overflow:hidden;
	position:relative;
	}
	.fileinput{
	position:absolute;
	top:-100px;
	}
</style>
<div id="navigation">
		<div class="container">
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
        <li><a href="{{ url('contributor/lessons') }}">Kelola Tutorial</a></li>
			  <li><a href="{{ url('contributor/lessons/'.$lesson->id.'/view') }}">View Lampiran</a></li>
        <li>Lampiran</li>
		</ul>
		</div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
		<div class="box-white">

	    <form class="form-horizontal form-contributor" action="" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}

				<div class="form-title">
					<h3>{{$lesson->title}}</h3>
			 	</div>
				<?php $i=0;?>
				@if(count($files)==0)
				<input type="hidden" name="count<?php echo $i; ?>" value="<?php echo $i; ?>" class="count-all">
				@endif
				@foreach($files as $value)
				<?php $n= $i + 1; ?>
		        <?php $a= $i++;?>
				<div class="item" id="row{{$i}}">
					<input type="hidden" name="count<?php echo $i; ?>" value="<?php echo $i; ?>" class="count-all">
					<div class="option">
						<div class="row">
							<div class="col-md-6">
								<h4><?php echo $i; ?>.Lampiran <?php echo $i; ?></h4>
							</div>
							<div class="col-md-6 text-right">
								<div class="btn-group">
									<button type="button" class="btn btn-default btn-outline sorttop"  id="t{{$i}}"  onclick="sorttop({{$i}})"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></button>
									<button type="button" class="btn btn-default btn-outline sortdown" id="d{{$i}}" onclick="sortdown({{$i}})" ><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></button>
								  <button type="button" class="btn btn-default btn-outline btn_remove" id="{{$i}}" > <i class="fa fa-trash" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Judul</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="judul[]" id="judul{{$i}}" value="{{$value->title}}"placeholder="Contoh:Pengenalan dasar terminal Ubuntu" required>
						</div>
					</div>

					<div class="form-group">
					 <label class="col-sm-2 control-label">Pilih lampiran</label>
					 <div class="col-sm-10" id="tampilfiles{{$i}}">
					   <div class="select-file" id="ambilfiles{{$i}}">
					    <a href="#" class="btnfile" id="btnfiles{{$i}}" onclick="getfilefiles({{$i}})">Choose File {{$i}}</a>
					    <input type="file" class="form-control fileinput" name="files[]" id="files{{$i}}"  onchange="getfilename({{$i}})">
					    <input type="hidden" name="files_text[]" id="files_text{{$i}}" value="{{$value->source}}" class="form-control">
					    @if($value->source != null )
						<input type="text" name="test" id="files_text{{$i}}" value="Sudah ada data" disabled class="form-control">
						@endif
						<label id="textfiles{{$i}}"></label>
					   </div>
					 </div>
				 	</div>
	 	      <div class="form-group">
	 	        <label class="col-sm-2 control-label">Description</label>
	 	        <div class="col-sm-10">
	 	        <textarea class="form-control" rows="8" cols="80" name="desc[]" id="desc{{$i}}" placeholder="Contoh: Active Directory Domain Controller merupakan salah satu keunggulan server windows."><?php echo nl2br($value->description);?></textarea>
	 	        </div>
	 	      </div>
			</div>

			@endforeach
			<input type="hidden" id="countrow" value="{{$i}}">
			<div class="row" id="dynamic_field">

			</div>

	      <div class="form-group">
					<div class="col-sm-2">
						<button type="button"  id="addanswer" name="button" class="btn btn-default btn-outline"><i class=""></i>Tambah Lampiran</button>
					</div>

	      </div>
		  <div class="form-group">

		   <div class="col-sm-12 text-right">
			 <a href="{{url('contributor/lessons/'.$lesson->id.'/view')}}"class="btn btn-danger">Batal</a>
			  <button type="submit" class="btn btn-info">Submit</button>
		   </div>
		 </div>
	    </form>
		</div>
  </div>
</div>


<script type="text/javascript" src="{{asset('template/kontributor/js/jquery.min.js')}}"></script>
<script type="text/javascript">
	function getfilefiles(id){
		$("#files"+id).focus().click();

	}

	function getfilename(id){
		var filename = $("#files"+id).val().split('\\').pop();
		$('#textfiles'+id).html(filename);
		// $('#filestext'+id).val(filename);
	}


		function sorttop(id){


			var judul_now = $('#judul'+id).val();
			var ambilfiles_now =document.getElementById('ambilfiles'+id);
			var desc_now=$('#desc'+id).val();

			var max =	 $('#countrow').val();

			 for (i = id; i >= 0; i--) {
				 var text = $('#judul'+i);

				if (text.length &&  i < id){

					var judul_down = $('#judul'+i).val();
					$('#judul'+id).val(judul_down);
					$('#judul'+i).val(judul_now);

					var desc_down = $('#desc'+i).val();
					$('#desc'+id).val(desc_down);
					$('#desc'+i).val(desc_now);

					var ambilfiles_down =document.getElementById('ambilfiles'+i);
					 $('#tampilfiles'+id).html(ambilfiles_down);
					 $('#tampilfiles'+i).html(ambilfiles_now);


	 				//files
	 				document.getElementById('ambilfiles'+i).setAttribute('id', 'ambilfiles'+id);
	 				document.getElementById('files'+i).setAttribute('onchange', 'getfilename('+id+')');
	 				document.getElementById('files'+i).setAttribute('id', 'files'+id);
	 				document.getElementById('btnfiles'+i).setAttribute('onclick', 'getfilefiles('+id+')');
	 				document.getElementById('btnfiles'+i).setAttribute('id', 'btnfiles'+id);
	 				document.getElementById('textfiles'+i).setAttribute('id', 'textfiles'+id);
					document.getElementById('files_text'+i).setAttribute('id', 'files_text'+id);

	 				document.getElementById('ambilfiles'+id).setAttribute('id', 'ambilfiles'+i);
	 				document.getElementById('files'+id).setAttribute('onchange', 'getfilename('+i+')');
	 				document.getElementById('files'+id).setAttribute('id', 'files'+i);
	 				document.getElementById('btnfiles'+id).setAttribute('onclick', 'getfilefiles('+i+')');
	 				document.getElementById('btnfiles'+id).setAttribute('id', 'btnfiles'+i);
	 				document.getElementById('textfiles'+id).setAttribute('id', 'textfiles'+i)
					document.getElementById('files_text'+id).setAttribute('id', 'files_text'+i);


					break;
				}else{

				}
			 }
		}
	function sortdown(id){

		var judul_now = $('#judul'+id).val();
		var ambilfiles_now =document.getElementById('ambilfiles'+id);


		var desc_now=$('#desc'+id).val();
		var max =	 $('#countrow').val();
		 for (i = id; i <= max; i++) {
			 var text = $('#judul'+i);
			 if (text.length &&  i > id){
				 var judul_down = $('#judul'+i).val();
				 $('#judul'+id).val(judul_down);
 			   	 $('#judul'+i).val(judul_now);

				 var desc_down = $('#desc'+i).val();
				 $('#desc'+id).val(desc_down);
				 $('#desc'+i).val(desc_now);

				 var ambilfiles_down =document.getElementById('ambilfiles'+i);

				$('#tampilfiles'+id).html(ambilfiles_down);
				$('#tampilfiles'+i).html(ambilfiles_now);

				 //files
				 document.getElementById('ambilfiles'+id).setAttribute('id', 'ambilfiles'+i);
				 document.getElementById('files'+id).setAttribute('onchange', 'getfilename('+i+')');
				 document.getElementById('files'+id).setAttribute('id', 'files'+i);
				 document.getElementById('btnfiles'+id).setAttribute('onclick', 'getfilefiles('+i+')');
				 document.getElementById('btnfiles'+id).setAttribute('id', 'btnfiles'+i);
				 document.getElementById('textfiles'+id).setAttribute('id', 'textfiles'+i);
				 	document.getElementById('files_text'+id).setAttribute('id', 'files_text'+i);

				 document.getElementById('ambilfiles'+i).setAttribute('id', 'ambilfiles'+id);
				 document.getElementById('files'+i).setAttribute('onchange', 'getfilename('+id+')');
				 document.getElementById('files'+i).setAttribute('id', 'files'+id);
				 document.getElementById('btnfiles'+i).setAttribute('onclick', 'getfilefiles('+id+')');
				 document.getElementById('btnfiles'+i).setAttribute('id', 'btnfiles'+id);
				 document.getElementById('textfiles'+i).setAttribute('id', 'textfiles'+id);
				 document.getElementById('files_text'+i).setAttribute('id', 'files_text'+id);
			   break;
		   }else{
			    // alert('Does not exist!');
		   }
		 }

	}
</script>
<script>
     $(document).ready(function(){

          var count="{{$count_files}}";
		  var i= parseInt(count);
          $('#addanswer').click(function(){
			   var no= $('.count-all').last().val();
			   n=parseInt(no) + 1;
				 	$('#countrow').val(n);
              //<td width="40%"><input type="text" class="form-control" name="varianname[]" id="varname'+ j +'"></td>
              // <td><input type="hidden" class="form-control" name="qty[]" id="varqty'+ j +'"></td>
               $('#dynamic_field').append('<div class="col-sm-12"style="margin-top:20px;margin-bottom:20px;" id="row'+n+'">'+
			   '<div class="item">'+
			   	 '<input type="hidden" name="count'+n+'" value="'+n+'" class="count-all">'+
				   '<div class="option">'+
					   '<div class="row">'+
						   '<div class="col-md-6">'+
							   '<h4 class="no'+n+'">'+n+'.Lampiran '+n+'</h4>'+
						   '</div>'+
						   '<div class="col-md-6 text-right">'+
							  ' <div class="btn-group">'+
								'<button type="button" class="btn btn-default btn-outline" id="t'+n+'" onclick="sorttop('+n+')" >  <i class="fa fa-arrow-circle-up" aria-hidden="true"></i></button>'+
							   ' <button type="button" class="btn btn-default btn-outline sortdown" id="d'+n+'" onclick="sortdown('+n+')"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></button>'+
								' <button type="button" class="btn btn-default btn-outline btn_remove " id="'+n+'"> <i class="fa fa-trash" aria-hidden="true"></i></button>'+
							  ' </div>'+
						  ' </div>'+
					   '</div>'+
				   '</div>'+

				   '<div class="form-group">'+
					   '<label class="col-sm-2 control-label">Judul</label>'+
					   '<div class="col-sm-10">'+
						   '<input type="text" class="form-control" name="judul[]" id="judul'+n+'"placeholder="Contoh:Pengenalan dasar terminal Ubuntu" required>'+
					   '</div>'+
				   '</div>'+

				  ' <div class="form-group">'+
					'<label class="col-sm-2 control-label">Pilih lampiran</label>'+
					'<div class="col-sm-10" id="tampilfiles'+ n +'">'+
					'<div class="select-file" id="ambilfiles'+ n +'">'+
					'<a href="#" class="btnfile" id="btnfiles'+ n +'"  onclick="getfilefiles('+ n +')">Choose File '+ n +'</a>'+
					'<input type="file" class="form-control fileinput"  name="files[]" id="files'+ n +'"  onchange="getfilename('+ n +')">'+
					'<input  name="files_text[]" id="files_text'+n+'" value="tes" class="form-control">'+

					  '<label id="textfiles'+ n +'"></label>'+
					'</div>'+
					'</div>'+

				'</div>'+
			 '<div class="form-group">'+
			   '<label class="col-sm-2 control-label">Description</label>'+
			   '<div class="col-sm-10">'+
			   '<textarea class="form-control" rows="8" cols="80" name="desc[]" id="desc'+n+'" placeholder="Contoh: Active Directory Domain Controller merupakan salah satu keunggulan server windows."></textarea>'+
			   '</div>'+
			 '</div>'+
		   '</div>'+
			  '</div>');

          });
          $(document).on('click', '.btn_remove', function(){
               var button_id = $(this).attr("id");
			   $(".count-all").each(function(){
				  var idrow=$(this).val();
				  if(idrow > button_id){
					  var hitung = parseInt(idrow)-1;
					  $('.no'+idrow).html(hitung+'.Lampiran '+hitung);
					  $(this).val(hitung);
				  }
			  });
               $('#row'+button_id+'').remove();
          });

     });
</script>

@endsection()
