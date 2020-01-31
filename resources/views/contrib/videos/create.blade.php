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
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
        <li><a href="{{ url('contributor/lessons') }}">Kelola Tutorial</a></li>
			  <li><a href="{{ url('contributor/lessons/'.$lesson->id.'/view') }}">View Video</a></li>
        <li>Video</li>
		</ul>
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
	    <form class="form-horizontal form-contributor" action="" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}

				<div class="form-title">
					<h3>{{$lesson->title}}</h3>
			 	</div>
				<input type="hidden" id="countrow" value="0">
				<div class="item" id="item0" rowitem="0">
					<input type="hidden" name="count<?php echo $count_video+1; ?>" value="<?php echo $count_video+1; ?>" class="count-all">
					<div class="option">
						<div class="row">
							<div class="col-md-6">
								<h4><?php echo $count_video+1; ?>.Video <?php echo $count_video+1; ?></h4>
							</div>
							<div class="col-md-6 text-right">
								<div class="btn-group">
								  <button type="button" class="btn btn-default btn-outline sorttop"  id="t0"  onclick="sorttop(0)"> <i class="fa fa-arrow-circle-up" aria-hidden="true"></i></button>
								  <button type="button" class="btn btn-default btn-outline sortdown" id="d0" onclick="sortdown(0)" ><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></button>

								  <button type="button" class="btn btn-default btn-outline"><i class="fa fa-trash" aria-hidden="true"></i></button>
								</div>

							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Judul</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="judul[]" id="judul0"placeholder="Contoh:Pengenalan dasar terminal Ubuntu" required>
						</div>
					</div>
					<div class="form-group">
					 <label class="col-sm-2 control-label">Pilih Video</label>
					 <div class="col-sm-10" id="tampilvideo0">
						 <div class="select-file" id="ambilvideo0">
							<a href="#" class="btnfile" id="btnvideo0" onclick="getfilevideo(0)">Choose File</a>
						 	<input type="file" class="form-control fileinput" name="video[]" id="video0" required onchange="getfilename(0)">
							<!-- <input type="text" name="videotext[]" id="videotext0" > -->
							<label id="textvideo0"></label>
					  	 </div>
					 </div>
				 	</div>
	 	      <div class="form-group">
	 	        <label class="col-sm-2 control-label">Description</label>
	 	        <div class="col-sm-10">
	 	        <textarea class="form-control" rows="8" cols="80" name="desc[]" id="desc0" placeholder="Contoh: Active Directory Domain Controller merupakan salah satu keunggulan server windows."></textarea>
	 	        </div>
	 	      </div>
			</div>
			<div class="row" id="dynamic_field">

			</div>

	      <div class="form-group">
					{{-- <div class="col-sm-2">
						<button type="button"  id="addanswer" name="button" class="btn btn-default btn-outline"><i class=""></i>Tambah Video</button>
					</div> --}}

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
<div class="tes1">

</div>

<script type="text/javascript" src="{{asset('template/kontributor/js/jquery.min.js')}}"></script>

<script type="text/javascript">

function getfilevideo(id){
	$("#video"+id).focus().click();
}

function getfilename(id){
	var filename = $("#video"+id).val().split('\\').pop();
	$('#textvideo'+id).html(filename);
	// $('#videotext'+id).val(filename);
}


function getfileimage(id){
	$("#image"+id).focus().click();

}

function getfileimg(id){
	var filename = $("#image"+id).val().split('\\').pop();
	$('#textimage'+id).html(filename);
	// $('#imagetext'+id).val(filename);
}

// function goToNext() {
// 	var get_next_id = $('.sortdown').next().attr("id");
// 	alert(get_next_id);
// }
//
// $('.sortdown').click(function() {
//  goToNext();
// });

	function sorttop(id){
		var judul_now = $('#judul'+id).val();
		var ambilvideo_now =document.getElementById('ambilvideo'+id);
		var ambilimage_now =document.getElementById('ambilimage'+id);
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

				var ambilvideo_down =document.getElementById('ambilvideo'+i);
				$('#tampilvideo'+id).html(ambilvideo_down);
				$('#tampilvideo'+i).html(ambilvideo_now);

				var ambilimage_down =document.getElementById('ambilimage'+i);
			   $('#tampilimage'+id).html(ambilimage_down);
			   $('#tampilimage'+i).html(ambilimage_now);

			   //video
			   document.getElementById('ambilvideo'+i).setAttribute('id', 'ambilvideo'+id);
			   document.getElementById('video'+i).setAttribute('onchange', 'getfilename('+id+')');
			   document.getElementById('video'+i).setAttribute('id', 'video'+id);
			   document.getElementById('btnvideo'+i).setAttribute('onclick', 'getfilevideo('+id+')');
			   document.getElementById('btnvideo'+i).setAttribute('id', 'btnvideo'+id);
			   document.getElementById('textvideo'+i).setAttribute('id', 'textvideo'+id);

				document.getElementById('ambilvideo'+id).setAttribute('id', 'ambilvideo'+i);
				document.getElementById('video'+id).setAttribute('onchange', 'getfilename('+i+')');
				document.getElementById('video'+id).setAttribute('id', 'video'+i);
				document.getElementById('btnvideo'+id).setAttribute('onclick', 'getfilevideo('+i+')');
				document.getElementById('btnvideo'+id).setAttribute('id', 'btnvideo'+i);
				document.getElementById('textvideo'+id).setAttribute('id', 'textvideo'+i);





				//image
				document.getElementById('ambilimage'+i).setAttribute('id', 'ambilimage'+id);
				document.getElementById('image'+i).setAttribute('onchange', 'getfileimg('+id+')');
				document.getElementById('image'+i).setAttribute('id', 'image'+id);
				document.getElementById('btnimage'+i).setAttribute('onclick', 'getfileimage('+id+')');
				document.getElementById('btnimage'+i).setAttribute('id', 'btnimage'+id);
				document.getElementById('textimage'+i).setAttribute('id', 'textimage'+id);

				document.getElementById('ambilimage'+id).setAttribute('id', 'ambilimage'+i);
				document.getElementById('image'+id).setAttribute('onchange', 'getfileimg('+i+')');
				document.getElementById('image'+id).setAttribute('id', 'image'+i);
				document.getElementById('btnimage'+id).setAttribute('onclick', 'getfileimage('+i+')');
				document.getElementById('btnimage'+id).setAttribute('id', 'btnimage'+i);
				document.getElementById('textimage'+id).setAttribute('id', 'textimage'+i);



			  break;
			}else{

			}
		 }
	}
	function sortdown(id){

		var judul_now = $('#judul'+id).val();
		var ambilvideo_now =document.getElementById('ambilvideo'+id);
		var ambilimage_now =document.getElementById('ambilimage'+id);


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

				 var ambilvideo_down =document.getElementById('ambilvideo'+i);
				 $('#tampilvideo'+id).html(ambilvideo_down);
				 $('#tampilvideo'+i).html(ambilvideo_now);

				 var ambilimage_down =document.getElementById('ambilimage'+i);
				$('#tampilimage'+id).html(ambilimage_down);
				$('#tampilimage'+i).html(ambilimage_now);

				//video
				 document.getElementById('ambilvideo'+id).setAttribute('id', 'ambilvideo'+i);
				 document.getElementById('video'+id).setAttribute('onchange', 'getfilename('+i+')');
				 document.getElementById('video'+id).setAttribute('id', 'video'+i);
				 document.getElementById('btnvideo'+id).setAttribute('onclick', 'getfilevideo('+i+')');
				 document.getElementById('btnvideo'+id).setAttribute('id', 'btnvideo'+i);
				 document.getElementById('textvideo'+id).setAttribute('id', 'textvideo'+i);


				 document.getElementById('ambilvideo'+i).setAttribute('id', 'ambilvideo'+id);
				 document.getElementById('video'+i).setAttribute('onchange', 'getfilename('+id+')');
				 document.getElementById('video'+i).setAttribute('id', 'video'+id);
				 document.getElementById('btnvideo'+i).setAttribute('onclick', 'getfilevideo('+id+')');
				 document.getElementById('btnvideo'+i).setAttribute('id', 'btnvideo'+id);
				 document.getElementById('textvideo'+i).setAttribute('id', 'textvideo'+id);


				 //image
				 document.getElementById('ambilimage'+id).setAttribute('id', 'ambilimage'+i);
				 document.getElementById('image'+id).setAttribute('onchange', 'getfileimg('+i+')');
				 document.getElementById('image'+id).setAttribute('id', 'image'+i);
				 document.getElementById('btnimage'+id).setAttribute('onclick', 'getfileimage('+i+')');
				 document.getElementById('btnimage'+id).setAttribute('id', 'btnimage'+i);
				 document.getElementById('textimage'+id).setAttribute('id', 'textimage'+i);

				 document.getElementById('ambilimage'+i).setAttribute('id', 'ambilimage'+id);
				 document.getElementById('image'+i).setAttribute('onchange', 'getfileimg('+id+')');
				 document.getElementById('image'+i).setAttribute('id', 'image'+id);
				 document.getElementById('btnimage'+i).setAttribute('onclick', 'getfileimage('+id+')');
				 document.getElementById('btnimage'+i).setAttribute('id', 'btnimage'+id);
				 document.getElementById('textimage'+i).setAttribute('id', 'textimage'+id);

			   break;
		   }else{
			    // alert('Does not exist!');
		   }
		 }


	}
</script>
<script>
     $(document).ready(function(){

          $('#addanswer').click(function(){
							// n=i + 2;
				var no= $('.count-all').last().val();
				 n=parseInt(no) + 1;
				 $('#countrow').val(n);
              //<td width="40%"><input type="text" class="form-control" name="varianname[]" id="varname'+ j +'"></td>
              // <td><input type="hidden" class="form-control" name="qty[]" id="varqty'+ j +'"></td>
               $('#dynamic_field').append('<div class="col-sm-12"style="margin-top:20px;margin-bottom:20px;" id="row'+n+'">'+
			   '<div class="item" id="item'+n+'" rowitem="'+n+'">'+
			   	'<input type="hidden" name="count'+n+'" value="'+n+'" class="count-all">'+
				   '<div class="option">'+
					   '<div class="row">'+
						   '<div class="col-md-6">'+
							   '<h4 class="no'+n+'">'+n+'.Video '+n+'</h4>'+
						   '</div>'+
						   '<div class="col-md-6 text-right">'+
							  ' <div class="btn-group">'+

								 '<button type="button" class="btn btn-default btn-outline" id="t'+n+'" onclick="sorttop('+n+')" ><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></button>'+
								' <button type="button" class="btn btn-default btn-outline sortdown" id="d'+n+'" onclick="sortdown('+n+')"> <i class="fa fa-arrow-circle-down" aria-hidden="true"></i></button>'+
								' <button type="button" class="btn btn-default btn-outline btn_remove " id="'+n+'"> <i class="fa fa-trash" aria-hidden="true"></i></button>'+
							  ' </div>'+
						  ' </div>'+
					   '</div>'+
				   '</div>'+

				   '<div class="form-group">'+
					   '<label class="col-sm-2 control-label">Judul</label>'+
					   '<div class="col-sm-10">'+
						   '<input type="text" class="form-control" name="judul[]" id="judul'+ n +'"placeholder="Contoh:Pengenalan dasar terminal Ubuntu" required>'+
					   '</div>'+
				   '</div>'+
				   '<div class="form-group">'+
					'<label class="col-sm-2 control-label">Pilih Image</label>'+
					'<div class="col-sm-10" id="tampilimage'+ n +'">'+
					'<div class="select-file" id="ambilimage'+ n +'">'+
					   '<a href="#" class="btnfile" id="btnimage'+ n +'" onclick="getfileimage('+ n +')">Choose File</a>'+
					   '<input type="file" class="form-control fileinput" name="image[]" id="image'+ n +'" required onchange="getfileimg('+ n +')">'+
					//   ' <input type="text" name="imagetext[]" id="imagetext'+ n +'" >'+
						'<label id="textimage'+ n +'"></label>'+
					'</div>'+
					'</div>'+
				   '</div>'+
				  ' <div class="form-group">'+
					'<label class="col-sm-2 control-label">Pilih Video</label>'+
					'<div class="col-sm-10" id="tampilvideo'+ n +'">'+
					'<div class="select-file" id="ambilvideo'+ n +'">'+
					   '<a href="#" class="btnfile" id="btnvideo'+ n +'" onclick="getfilevideo('+ n +')">Choose File</a>'+
					   '<input type="file" class="form-control fileinput" name="video[]" id="video'+ n +'" required onchange="getfilename('+ n +')">'+
					//   ' <input type="text" name="videotext[]" id="videotext'+ n +'" >'+
						'<label id="textvideo'+ n +'"></label>'+
					'</div>'+
					'</div>'+
				'</div>'+
			 '<div class="form-group">'+
			   '<label class="col-sm-2 control-label">Description</label>'+
			   '<div class="col-sm-10">'+
			   '<textarea class="form-control" rows="8" cols="80" name="desc[]" id="desc'+ n +'" placeholder="Contoh: Active Directory Domain Controller merupakan salah satu keunggulan server windows."></textarea>'+
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
						$('.no'+idrow).html(hitung+'.Video '+hitung);
						$(this).val(hitung);
					}
			    });
               $('#row'+button_id+'').remove();
          });

     });
</script>

@endsection()
