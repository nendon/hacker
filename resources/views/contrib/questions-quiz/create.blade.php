@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
        <li><a href="{{ url('contributor/lessons') }}">Kelola Tutorial</a></li>
			  <li><a href="{{ url('contributor/lessons/'.$quiz->lesson_id.'/view') }}">Kelola Quiz</a></li>
				<li><a href="{{ url('contributor/lessons/quiz/'.$quiz->id.'/view') }}">Kelola Soal</a></li>
        <li>Buat Soal</li>
		</ul>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
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
		<div class="box-white">
				<form class="form-horizontal form-contributor" action="{{url('contributor/lessons/'.$quiz->id.'/store_questions')}}"  method="POST">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="hidden" name="method" value="PUT">
					<input type="hidden" id="countrow" value="0">
				<div class="form-title">
					<h3>{{$quiz->title}}</h3>
			 	</div>
				<div class="item">
					<input type="hidden" name="count<?php echo $count_question+1; ?>" value="<?php echo $count_question+1; ?>" class="count-all">
					<div class="option">
						<div class="row">
							<div class="col-md-6">
								<h4><?php echo $count_question+1; ?>.Soal <?php echo $count_question+1; ?></h4>
							</div>
							<div class="col-md-6 text-right">
								<div class="btn-group">
									<button type="button" class="btn btn-default btn-outline sorttop"  id="t0"  onclick="sorttop(0)"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
									<button type="button" class="btn btn-default btn-outline sortdown" id="d0" onclick="sortdown(0)" ><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
								  <button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/delete.png') }}" alt="" width="15"></button>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Judul</label>
						<div class="col-sm-10">
							<input type="text" required class="form-control" name="question[]" id="question0" placeholder="Contoh:Apa kepanjangan dari LTS pada versi Ubuntu?" required>
							<input type="hidden" name="questionid[]" value="0" id="questionid0">
						</div>
					</div>
					<hr>

					<div class="form-group">
						<label class="col-sm-2 control-label">Jawaban A</label>
						<div class="col-sm-1">
							<div class="checkbox">
				        <label>
				          <input type="checkbox" name="question_key0_0" id="question_key0_0">
				        </label>
				      </div>
						</div>
						<div class="col-sm-7">
							<input type="text required" class="form-control" name="answer0[]" id="answer_a0" placeholder="Tulis Jawaban disini" required>
						</div>
						<div class="col-sm-2 text-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-outline" id="ta0_0"  onclick="sorttop_answer(0 , 0)"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
								<button type="button" class="btn btn-default btn-outline" id="da0_0"  onclick="sortdown_answer(0, 0)"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Jawaban B</label>
						<div class="col-sm-1">
							<div class="checkbox">
				        <label>
				          <input type="checkbox" name="question_key0_1" id="question_key0_1">
				        </label>
				      </div>
						</div>
						<div class="col-sm-7">
							<input type="text" required class="form-control" name="answer0[]" id="answer_b0" placeholder="Tulis Jawaban disini" required>
						</div>
						<div class="col-sm-2 text-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-outline" id="ta0_1"  onclick="sorttop_answer(0,1)"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
								<button type="button" class="btn btn-default btn-outline" id="da0_1"  onclick="sortdown_answer(0,1)"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
							</div>

						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-2 control-label">Jawaban C</label>
						<div class="col-sm-1">
							<div class="checkbox">
				        <label>
				          <input type="checkbox" name="question_key0_2" id="question_key0_2">
				        </label>
				      </div>
						</div>
						<div class="col-sm-7">
							<input type="text" required class="form-control" name="answer0[]" id="answer_c0" placeholder="Tulis Jawaban disini" required>
						</div>
						<div class="col-sm-2 text-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-outline"	id="ta2_0"  onclick="sorttop_answer(0,2)"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
								<button type="button" class="btn btn-default btn-outline" id="da2_0"  onclick="sortdown_answer(0,2)"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-2 control-label">Jawaban D</label>
						<div class="col-sm-1">
							<div class="checkbox">
				        <label>
				          <input type="checkbox" name="question_key0_3"id="question_key0_3">
				        </label>
				      </div>
						</div>
						<div class="col-sm-7">
							<input type="text" required class="form-control" name="answer0[]" id="answer_d0" placeholder="Tulis Jawaban disini" required>
						</div>
						<div class="col-sm-2 text-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-outline"	id="ta3_0"  onclick="sorttop_answer(0,3)"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
								<button type="button" class="btn btn-default btn-outline" id="da3_0"  onclick="sortdown_answer(0,3)"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
							</div>
						</div>
					</div>
				</div>

				<div class="row" id="dynamic_field">

				</div>
	      <div class="form-group">
					<div class="col-sm-2">
						<button type="button" name="button" id="addanswer"  class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/tambah.png') }}" alt="" width="15"> Tambah Soal</button>
					</div>
	        <div class="col-sm-10 text-right">
	          <a class="btn btn-danger">Batal</a>
	          <button type="submit" class="btn btn-info">Submit</button>
	        </div>
	      </div>
	    </form>
		</div>
  </div>
</div>
<script type="text/javascript" src="{{asset('template/kontributor/js/jquery.min.js')}}"></script>

<!-- id="ta1_0"  onclick="sorttop_answer(0,1)"
id="da1_0"  onclick="sortdown_answer(0,1)" -->
<script type="text/javascript">
function sorttop_answer(id, type){

	 var question_now=document.getElementById('question_key'+id+'_'+type).checked;
	// var question_b_now=document.getElementById('question_key'+id+'_1').checked;
	// var question_c_now=document.getElementById('question_key'+id+'_2').checked;
	// var question_d_now=document.getElementById('question_key'+id+'_3').checked;
	if(type==0){
		var tp_now= 'a';
	}else if (type==1) {
		var tp_now= 'b';
	}else if (type==2) {
		var tp_now= 'c';

	}else if (type==3) {
		var tp_now= 'd';
	}

	var answer_now=$('#answer_'+tp_now+''+id).val();
	// var answer_b_now=$('#answer_b'+id).val();
	// var answer_c_now=$('#answer_c'+id).val();
	// var answer_d_now=$('#answer_d'+id).val();
		for (i = type; i >= 0; i--) {

				if(i==0){
					var tp_down= 'a';
				}else if (i==1) {
					var tp_down= 'b';
				}else if (i==2) {
					var tp_down= 'c';

				}else if (i==3) {
					var tp_down= 'd';
				}

				if ( i < type ){
				 var answer_down=$('#answer_'+tp_down+''+id).val();
					$('#answer_'+tp_now+''+id).val(answer_down);
					$('#answer_'+tp_down+''+id).val(answer_now);

					var question_down=document.getElementById('question_key'+id+'_'+i).checked;
					 document.getElementById('question_key'+id+'_'+type).checked=question_down;
					 document.getElementById('question_key'+id+'_'+i).checked=question_now;
				 break;
				}
		}
	}

	function sortdown_answer(id, type){

		 var question_now=document.getElementById('question_key'+id+'_'+type).checked;
		// var question_b_now=document.getElementById('question_key'+id+'_1').checked;
		// var question_c_now=document.getElementById('question_key'+id+'_2').checked;
		// var question_d_now=document.getElementById('question_key'+id+'_3').checked;
		if(type==0){
			var tp_now= 'a';
		}else if (type==1) {
			var tp_now= 'b';
		}else if (type==2) {
			var tp_now= 'c';

		}else if (type==3) {
			var tp_now= 'd';
		}

		var answer_now=$('#answer_'+tp_now+''+id).val();
		// var answer_b_now=$('#answer_b'+id).val();
		// var answer_c_now=$('#answer_c'+id).val();
		// var answer_d_now=$('#answer_d'+id).val();
			for (i = type; i <= 3; i++) {

					if(i==0){
						var tp_down= 'a';
					}else if (i==1) {
						var tp_down= 'b';
					}else if (i==2) {
						var tp_down= 'c';

					}else if (i==3) {
						var tp_down= 'd';
					}

				  if ( i > type ){
					 var answer_down=$('#answer_'+tp_down+''+id).val();
					 	$('#answer_'+tp_now+''+id).val(answer_down);
						$('#answer_'+tp_down+''+id).val(answer_now);

						var question_down=document.getElementById('question_key'+id+'_'+i).checked;
						 document.getElementById('question_key'+id+'_'+type).checked=question_down;
						 document.getElementById('question_key'+id+'_'+i).checked=question_now;
					 break;
				  }
			}
	}
</script>
<script type="text/javascript">
function sorttop(id){

	var question_now = $('#question'+id).val();
	// var questionid_now=$('#questionid'+id).val();

	var question_a_now=document.getElementById('question_key'+id+'_0').checked;

	var question_b_now=document.getElementById('question_key'+id+'_1').checked;
	var question_c_now=document.getElementById('question_key'+id+'_2').checked;
	var question_d_now=document.getElementById('question_key'+id+'_3').checked;

	var answer_a_now=$('#answer_a'+id).val();
	var answer_b_now=$('#answer_b'+id).val();
	var answer_c_now=$('#answer_c'+id).val();
	var answer_d_now=$('#answer_d'+id).val();

	var max =	 $('#countrow').val();

	for (i = id; i >= 0; i--) {

		var text = $('#question'+i);
		 if (text.length &&  i < id){
			 var question_down = $('#question'+i).val();
			 $('#question'+id).val(question_down);
			 $('#question'+i).val(question_now);

				// var questionid_down=$('#questionid'+i).val();
				// $('#questionid'+id).val(questionid_down);
				// $('#questionid'+i).val(questionid_now);

				var question_a_down=document.getElementById('question_key'+i+'_0').checked;
				document.getElementById('question_key'+id+'_0').checked=question_a_down;
				document.getElementById('question_key'+i+'_0').checked=question_a_now;

				var question_b_down=document.getElementById('question_key'+i+'_1').checked;
				document.getElementById('question_key'+id+'_1').checked=question_b_down;
				document.getElementById('question_key'+i+'_1').checked=question_b_now;

				var question_c_down=document.getElementById('question_key'+i+'_2').checked;
				document.getElementById('question_key'+id+'_2').checked=question_c_down;
				document.getElementById('question_key'+i+'_2').checked=question_c_now;

				var question_d_down=document.getElementById('question_key'+i+'_3').checked;
				document.getElementById('question_key'+id+'_3').checked=question_d_down;
				document.getElementById('question_key'+i+'_3').checked=question_d_now;


				var question_a_down=$('#question_key'+i+'_0').val();
				$('#question_key'+id+'_0').val(question_a_down);
				$('#question_key'+i+'_0').val(question_a_now);

				var question_b_down=$('#question_key'+i+'_1').val();
				$('#question_key'+id+'_1').val(question_b_down);
				$('#question_key'+i+'_1').val(question_b_now);

				var question_c_down=$('#question_key'+i+'_2').val();
				$('#question_key'+id+'_2').val(question_c_down);
				$('#question_key'+i+'_2').val(question_c_now);

				var question_d_down=$('#question_key'+i+'_3').val();
				$('#question_key'+id+'_3').val(question_d_down);
				$('#question_key'+i+'_3').val(question_d_now);


				var answer_a_down=$('#answer_a'+i).val();
				$('#answer_a'+id).val(answer_a_down);
				$('#answer_a'+i).val(answer_a_now);

				var answer_b_down=$('#answer_b'+i).val();
				$('#answer_b'+id).val(answer_b_down);
				$('#answer_b'+i).val(answer_b_now);

				var answer_c_down=$('#answer_c'+i).val();
				$('#answer_c'+id).val(answer_c_down);
				$('#answer_c'+i).val(answer_c_now);

				var answer_d_down=$('#answer_d'+i).val();
				$('#answer_d'+id).val(answer_d_down);
				$('#answer_d'+i).val(answer_d_now);
			 break;
		 }else{
				// alert('Does not exist!');
		 }
	 }
}
function sortdown(id){

	var question_now = $('#question'+id).val();
	// var questionid_now=$('#questionid'+id).val();
	var question_a_now=document.getElementById('question_key'+id+'_0').checked;
	var question_b_now=document.getElementById('question_key'+id+'_1').checked;
	var question_c_now=document.getElementById('question_key'+id+'_2').checked;
	var question_d_now=document.getElementById('question_key'+id+'_3').checked;

	var answer_a_now=$('#answer_a'+id).val();
	var answer_b_now=$('#answer_b'+id).val();
	var answer_c_now=$('#answer_c'+id).val();
	var answer_d_now=$('#answer_d'+id).val();

	var max =	 $('#countrow').val();

	 for (i = id; i <= max; i++) {
		 var text = $('#question'+i);
		 if (text.length &&  i > id){
			 var question_down = $('#question'+i).val();
			 $('#question'+id).val(question_down);
			 $('#question'+i).val(question_now);

				// var questionid_down=$('#questionid'+i).val();
				// $('#questionid'+id).val(questionid_down);
				// $('#questionid'+i).val(questionid_now);

				var question_a_down=document.getElementById('question_key'+i+'_0').checked;
				document.getElementById('question_key'+id+'_0').checked=question_a_down;
				document.getElementById('question_key'+i+'_0').checked=question_a_now;

				var question_b_down=document.getElementById('question_key'+i+'_1').checked;
				document.getElementById('question_key'+id+'_1').checked=question_b_down;
				document.getElementById('question_key'+i+'_1').checked=question_b_now;

				var question_c_down=document.getElementById('question_key'+i+'_2').checked;
				document.getElementById('question_key'+id+'_2').checked=question_c_down;
				document.getElementById('question_key'+i+'_2').checked=question_c_now;

				var question_d_down=document.getElementById('question_key'+i+'_3').checked;
				document.getElementById('question_key'+id+'_3').checked=question_d_down;
				document.getElementById('question_key'+i+'_3').checked=question_d_now;


				var question_a_down=$('#question_key'+i+'_0').val();
				$('#question_key'+id+'_0').val(question_a_down);
				$('#question_key'+i+'_0').val(question_a_now);

				var question_b_down=$('#question_key'+i+'_1').val();
				$('#question_key'+id+'_1').val(question_b_down);
				$('#question_key'+i+'_1').val(question_b_now);

				var question_c_down=$('#question_key'+i+'_2').val();
				$('#question_key'+id+'_2').val(question_c_down);
				$('#question_key'+i+'_2').val(question_c_now);

				var question_d_down=$('#question_key'+i+'_3').val();
				$('#question_key'+id+'_3').val(question_d_down);
				$('#question_key'+i+'_3').val(question_d_now);


				var answer_a_down=$('#answer_a'+i).val();
				$('#answer_a'+id).val(answer_a_down);
				$('#answer_a'+i).val(answer_a_now);

				var answer_b_down=$('#answer_b'+i).val();
				$('#answer_b'+id).val(answer_b_down);
				$('#answer_b'+i).val(answer_b_now);

				var answer_c_down=$('#answer_c'+i).val();
				$('#answer_c'+id).val(answer_c_down);
				$('#answer_c'+i).val(answer_c_now);

				var answer_d_down=$('#answer_d'+i).val();
				$('#answer_d'+id).val(answer_d_down);
				$('#answer_d'+i).val(answer_d_now);
			 break;
		 }else{
				// alert('Does not exist!');
		 }
	 }

}
</script>
<script>
     $(document).ready(function(){
          var i=0;
          $('#addanswer').click(function(){
						// n=i + 2;
						var no= $('.count-all').last().val();
						 n=parseInt(no) + 1;
						 $('#countrow').val(n);

              j=++i;
              //<td width="40%"><input type="text" class="form-control" name="varianname[]" id="varname'+ j +'"></td>
              // <td><input type="hidden" class="form-control" name="qty[]" id="varqty'+ j +'"></td>
               $('#dynamic_field').append('<div class="col-sm-12"style="margin-top:20px;margin-bottom:20px;" id="row'+n+'">'+
							 '<div class="item">'+
							 '<input type="hidden" name="count'+n+'" value="'+n+'" class="count-all">'+
							 '<div class="option">'+
							 '<div class="row">'+
							 '<div class="col-md-6">'+
							'<h4 class="no'+n+'">'+n+'.Soal '+n+'</h4>'+
							 '</div>'+
							 '<div class="col-md-6 text-right">'+
							 '<div class="btn-group">'+
							 '<button type="button" class="btn btn-default btn-outline "  id="t'+n+'" onclick="sorttop('+j+')"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>'+
							 '<button type="button" class="btn btn-default btn-outline" id="d'+n+'" onclick="sortdown('+j+')"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>'+
							 '<button type="button" class="btn btn-default btn-outline btn_remove" id="'+n+'"><img src="{{ asset('template/kontributor/img/icon/delete.png') }}" alt="" width="15"></button>'+
							 '</div>'+
							 '</div>'+
							 '</div>'+
							 '</div>'+

							 '<div class="form-group">'+
							 '<label class="col-sm-2 control-label">Judul</label>'+
							 '<div class="col-sm-10">'+
							 '<input type="text" required class="form-control" name="question[]" id="question'+ j +'" placeholder="Contoh:Apa kepanjangan dari LTS pada versi Ubuntu?" required>'+
							 '<input type="hidden" name="questionid[]" value="'+ j +'" id="questionid'+ j +'">'+
							 '</div>'+
							 '</div>'+
							 '<hr>'+

							 '<div class="form-group">'+
							 '<label class="col-sm-2 control-label">Jawaban A</label>'+
							 '<div class="col-sm-1">'+
							 '<div class="checkbox">'+
							 '<label>'+
							 '<input type="checkbox" name="question_key'+ j +'_0" id="question_key'+ j +'_0" >'+
							 '</label>'+
							 '</div>'+
							 '</div>'+

							 '<div class="col-sm-7">'+
							  '<input type="text" required class="form-control" name="answer'+ j +'[]" id="answer_a'+ j +'" placeholder="Tulis Jawaban disini" required>'+
							 '</div>'+
							 '<div class="col-sm-2 text-right">'+
							 '<div class="btn-group">'+
							 '<button type="button" class="btn btn-default btn-outline" id="ta0_'+j+'"  onclick="sorttop_answer('+j+',0)"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>'+
							 '<button type="button" class="btn btn-default btn-outline"  id="da0_'+j+'"  onclick="sortdown_answer('+j+',0)"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>'+
							 '</div>'+
							 '</div>'+
							 '</div>'+

							 '<div class="form-group">'+
							 '<label class="col-sm-2 control-label">Jawaban B</label>'+
							 '<div class="col-sm-1">'+
							 '<div class="checkbox">'+
							 '<label>'+
							 '<input type="checkbox" name="question_key'+ j +'_1" id="question_key'+ j +'_1">'+
							 '</label>'+
							 '</div>'+
							 '</div>'+
							 '<div class="col-sm-7">'+
							 '<input type="text" required class="form-control" name="answer'+ j +'[]" id="answer_b'+ j +'" placeholder="Tulis Jawaban disini" required>'+
							 '</div>'+
							 '<div class="col-sm-2 text-right">'+
							 '<div class="btn-group">'+
							 '<button type="button" class="btn btn-default btn-outline" id="ta1_'+j+'"  onclick="sorttop_answer('+j+',1)"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>'+
							 '<button type="button" class="btn btn-default btn-outline"  id="da1_'+j+'"  onclick="sortdown_answer('+j+',1)"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>'+
							 '</div>'+
							 '</div>'+
							 '</div>'+

							 '<div class="form-group">'+
							 '<label class="col-sm-2 control-label">Jawaban C</label>'+
							 '<div class="col-sm-1">'+
							 '<div class="checkbox">'+
							 '<label>'+
							 '<input type="checkbox" name="question_key'+ j +'_2" id="question_key'+ j +'_2" >'+
							 '</label>'+
							 '</div>'+
							 '</div>'+
							 '<div class="col-sm-7">'+
							 '<input type="text" required class="form-control" name="answer'+ j +'[]" id="answer_c'+ j +'" placeholder="Tulis Jawaban disini" required>'+
							 '</div>'+
							 '<div class="col-sm-2 text-right">'+
							 '<div class="btn-group">'+
							 '<button type="button" class="btn btn-default btn-outline"  id="ta2_'+j+'"  onclick="sorttop_answer('+j+',2)"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>'+
							 '<button type="button" class="btn btn-default btn-outline" id="da2_'+j+'"  onclick="sortdown_answer('+j+',2)"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>'+
							 '</div>'+
							 '</div>'+
							 '</div>'+

							 '<div class="form-group">'+
							 '<label class="col-sm-2 control-label">Jawaban D</label>'+
							 '<div class="col-sm-1">'+
							 '<div class="checkbox">'+
							 '<label>'+
							 '<input type="checkbox" name="question_key'+ j +'_3" id="question_key'+ j +'_3">'+
							 '</label>'+
							 '</div>'+
							 '</div>'+
							 '<div class="col-sm-7">'+
							 '<input type="text" required class="form-control" name="answer'+ j +'[]" id="answer_d'+ j +'" placeholder="Tulis Jawaban disini" required>'+
							 '</div>'+
							 '<div class="col-sm-2 text-right">'+
							 '<div class="btn-group">'+
							 '<button type="button" class="btn btn-default btn-outline" id="ta3_'+j+'"  onclick="sorttop_answer('+j+',3)"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>'+
							 '<button type="button" class="btn btn-default btn-outline"  id="da3_'+j+'"  onclick="sortdown_answer('+j+',3)"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>'+
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
					  $('.no'+idrow).html(hitung+'.Soal '+hitung);
					  $(this).val(hitung);
				  }
			  });
               $('#row'+button_id+'').remove();
          });

     });
</script>

@endsection()
