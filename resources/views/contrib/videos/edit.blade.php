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
				<?php $i=0;?>

				<input type="hidden" name="count0" value="0" class="count-all">

				@foreach($video as $value)
				<?php $n= $i + 1; ?>
		        <?php $a= $i++;?>
				<div class="item" id="row{{$i}}">
				<input type="hidden" name="count<?php echo $i; ?>" value="<?php echo $i; ?>" class="count-all get<?php echo $i; ?>" rowname="<?php echo $i; ?>">
					<div class="option">
						<div class="row">
							<div class="col-md-6">
								<h4 class="no<?php echo $i; ?>"><?php echo $i; ?>.Video <?php echo $i; ?></h4>
							</div>
							<div class="col-md-6 text-right">
								<div class="btn-group">
								  <button type="button" class="btn btn-default btn-outline sorttop"  id="t{{$i}}"  onclick="sorttop({{$i}})"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></button>
								  <button type="button" class="btn btn-default btn-outline sortdown" id="d{{$i}}" onclick="sortdown({{$i}})" ><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></button>

								  <button type="button" class="btn btn-default btn-outline btn_remove" id="{{$i}}" ><i class="fa fa-trash" aria-hidden="true"></i></button>
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
					 <label class="col-sm-2 control-label">Pilih Video</label>

					 <div class="col-sm-10" id="tampilvideo{{$i}}">
						<div class="select-file" id="ambilvideo{{$i}}">
						   <a href="#" class="btnfile" id="btnvideo{{$i}}" onclick="getfilevideo({{$i}})">Choose File {{$i}}</a>
						   <input type="file" class="form-control fileinput" name="video[]" id="video{{$i}}"  onchange="getfilename({{$i}})">
						   <input type="hidden" name="video_text[]" id="video_text{{$i}}" value="{{$value->video}}" class="form-control">
						   <input type="hidden" name="type_video[]" id="type_video{{$i}}" value="{{$value->type_video}}" disabled class="form-control">
 						@if($value->video != null )
						<input type="text" name="test" id="type_video{{$i}}" value="Sudah ada data" disabled class="form-control">
						@endif
						   <label id="textvideo{{$i}}"></label>
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
						<button type="button"  id="addanswer" name="button" class="btn btn-default btn-outline"><i class=""></i>Tambah Video</button>
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

			   document.getElementById('video_text'+i).setAttribute('id', 'video_text'+id);
			   document.getElementById('type_video'+i).setAttribute('id', 'type_video'+id);

				document.getElementById('ambilvideo'+id).setAttribute('id', 'ambilvideo'+i);
				document.getElementById('video'+id).setAttribute('onchange', 'getfilename('+i+')');
				document.getElementById('video'+id).setAttribute('id', 'video'+i);
				document.getElementById('btnvideo'+id).setAttribute('onclick', 'getfilevideo('+i+')');
				document.getElementById('btnvideo'+id).setAttribute('id', 'btnvideo'+i);
				document.getElementById('textvideo'+id).setAttribute('id', 'textvideo'+i);

				document.getElementById('video_text'+id).setAttribute('id', 'video_text'+i);
				document.getElementById('type_video'+id).setAttribute('id', 'type_video'+i);








				//image
				document.getElementById('ambilimage'+i).setAttribute('id', 'ambilimage'+id);
				document.getElementById('image'+i).setAttribute('onchange', 'getfileimg('+id+')');
				document.getElementById('image'+i).setAttribute('id', 'image'+id);
				document.getElementById('btnimage'+i).setAttribute('onclick', 'getfileimage('+id+')');
				document.getElementById('btnimage'+i).setAttribute('id', 'btnimage'+id);
				document.getElementById('textimage'+i).setAttribute('id', 'textimage'+id);
				document.getElementById('image_text'+i).setAttribute('id', 'image_text'+id);


				document.getElementById('ambilimage'+id).setAttribute('id', 'ambilimage'+i);
				document.getElementById('image'+id).setAttribute('onchange', 'getfileimg('+i+')');
				document.getElementById('image'+id).setAttribute('id', 'image'+i);
				document.getElementById('btnimage'+id).setAttribute('onclick', 'getfileimage('+i+')');
				document.getElementById('btnimage'+id).setAttribute('id', 'btnimage'+i);
				document.getElementById('textimage'+id).setAttribute('id', 'textimage'+i);
				document.getElementById('image_text'+id).setAttribute('id', 'image_text'+id);



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
				 document.getElementById('video_text'+id).setAttribute('id', 'video_text'+i);
				 document.getElementById('type_video'+id).setAttribute('id', 'type_video'+i);



				 document.getElementById('ambilvideo'+i).setAttribute('id', 'ambilvideo'+id);
				 document.getElementById('video'+i).setAttribute('onchange', 'getfilename('+id+')');
				 document.getElementById('video'+i).setAttribute('id', 'video'+id);
				 document.getElementById('btnvideo'+i).setAttribute('onclick', 'getfilevideo('+id+')');
				 document.getElementById('btnvideo'+i).setAttribute('id', 'btnvideo'+id);
				 document.getElementById('textvideo'+i).setAttribute('id', 'textvideo'+id);

				 document.getElementById('video_text'+i).setAttribute('id', 'video_text'+id);
				 document.getElementById('type_video'+i).setAttribute('id', 'type_video'+id)


				 //image
				 document.getElementById('ambilimage'+id).setAttribute('id', 'ambilimage'+i);
				 document.getElementById('image'+id).setAttribute('onchange', 'getfileimg('+i+')');
				 document.getElementById('image'+id).setAttribute('id', 'image'+i);
				 document.getElementById('btnimage'+id).setAttribute('onclick', 'getfileimage('+i+')');
				 document.getElementById('btnimage'+id).setAttribute('id', 'btnimage'+i);
				 document.getElementById('textimage'+id).setAttribute('id', 'textimage'+i);
			 	 document.getElementById('image_text'+id).setAttribute('id', 'image_text'+id);

				 document.getElementById('ambilimage'+i).setAttribute('id', 'ambilimage'+id);
				 document.getElementById('image'+i).setAttribute('onchange', 'getfileimg('+id+')');
				 document.getElementById('image'+i).setAttribute('id', 'image'+id);
				 document.getElementById('btnimage'+i).setAttribute('onclick', 'getfileimage('+id+')');
				 document.getElementById('btnimage'+i).setAttribute('id', 'btnimage'+id);
				 document.getElementById('textimage'+i).setAttribute('id', 'textimage'+id);
				 document.getElementById('image_text'+i).setAttribute('id', 'image_text'+id);

			   break;
		   }else{
			    // alert('Does not exist!');
		   }
		 }


	}
</script>
<script>
     $(document).ready(function(){

          var count="{{$count_video}}";
		  var i= parseInt(count);
          $('#addanswer').click(function(){
			   var no= $('.count-all').last().val();
			   n=parseInt(no) + 1;
			    $('#countrow').val(n);
              //<td width="40%"><input type="text" class="form-control" name="varianname[]" id="varname'+ j +'"></td>
              // <td><input type="hidden" class="form-control" name="qty[]" id="varqty'+ j +'"></td>
               $('#dynamic_field').append('<div class="col-sm-12"style="margin-top:20px;margin-bottom:20px;" id="row'+n+'">'+
			   '<div class="item">'+
			   	'<input type="hidden" name="count'+n+'" value="'+n+'" class="count-all get'+n+'" rowname="'+n+'">'+
				   '<div class="option">'+
					   '<div class="row">'+
						   '<div class="col-md-6">'+
							   '<h4 class="no'+n+'">'+n+'.Video '+n+'</h4>'+
						   '</div>'+
						   '<div class="col-md-6 text-right">'+
							  ' <div class="btn-group">'+

								'<button type="button" class="btn btn-default btn-outline" id="t'+n+'" onclick="sorttop('+n+')" ><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></button>'+
							   ' <button type="button" class="btn btn-default btn-outline sortdown" id="d'+n+'" onclick="sortdown('+n+')"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></button>'+
								' <button type="button" class="btn btn-default btn-outline btn_remove " id="'+n+'"><i class="fa fa-trash" aria-hidden="true"></i></button>'+
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
				   '<div class="form-group">'+
					'<label class="col-sm-2 control-label">Pilih Image</label>'+

					'<div class="col-sm-10" id="tampilimage'+ n +'">'+
					'<div class="select-file" id="ambilimage'+ n +'">'+
					   '<a href="#" class="btnfile" id="btnimage'+ n +'" onclick="getfileimage('+ n +')">Choose File '+ n +'</a>'+
					   '<input type="file" class="form-control fileinput" name="image[]" id="image'+ n +'"  onchange="getfileimg('+ n +')">'+
					'<input type="hidden" name="image_text[]" id="image_text'+n+'" value="" class="form-control">'+

						'<label id="textimage'+ n +'"></label>'+
					'</div>'+
					'</div>'+

				   '</div>'+
				  ' <div class="form-group">'+
					'<label class="col-sm-2 control-label">Pilih Video</label>'+
					'<div class="col-sm-10" id="tampilvideo'+ n +'">'+
					'<div class="select-file" id="ambilvideo'+ n +'">'+
					   '<a href="#" class="btnfile" id="btnvideo'+ n +'" onclick="getfilevideo('+ n +')">Choose File '+ n +'</a>'+
					   '<input type="file" class="form-control fileinput" name="video[]" id="video'+ n +'"  onchange="getfilename('+ n +')">'+
						'<input type="hidden" name="video_text[]" id="video_text'+n+'" value="" class="form-control">'+
						' <input type="hidden" name="type_video[]" id="type_video'+n+'" value="" class="form-control">'+
						'<label id="textvideo'+ n +'"></label>'+
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
			   var get=$('.get'+button_id).val();

				  // 	  alert(button_id);
			   $(".count-all").each(function(){
				  var idrow=$(this).val();
				  if(idrow > get){
					  var hitung = parseInt(idrow)-1;
					  var rowname= $(this).attr('rowname');
					  $('.no'+rowname).html(hitung+'.Video '+hitung);
					  $(this).val(hitung);
				  }
			  });
               $('#row'+button_id+'').remove();
          });

     });
</script>

@endsection()
