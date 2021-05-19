@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
    <div class="container">
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
                <li>Komentar</li>
    </ul>
    </div>
</div>
@endsection
@section('content')
<style>
  #content{
    background: #f4f4f4;
  }
  #exTab1 .nav-pills{
      background: #fff;
  }
  #exTab1 .tab-content {

    background-color: #fff;
    padding : 5px 15px;
  }
  #exTab1 .nav-pills > li > a {
  border-radius: 0;
  background: #fff;
  color: #2BA8E2;
  }
  #exTab1 .nav-pills  .active{
    border-bottom: 2px solid #2BA8E2;
  }
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: none;
    border-bottom: 1px solid #ddd;
}
.table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>th {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: none;
  border: none;
}

.btn {
  border-radius: 10px;
  padding: 5px 20px;
  font-size: 10px;
  text-decoration: none;
  color: #fff;
  position: relative;
  display: inline-block;
}

.blue {
  background-color: #55acee;
}
.blue:hover {
  background-color: #fff;
  border-color: #55acee;
  color: #55acee;
}

.red {
  background-color: #e74c3c;
}
.red:hover{
  background-color: #fff;
  border-color: #e74c3c;
  color: #e74c3c;
}
.inputFile {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
  }
  .inputFile + label {
    background-color: #2BA8E2;
    border-radius: 3px;
    color: white;
    cursor: pointer;
    display: inline-block;
    font-size: 1em;
    padding: 10px 15px;
    margin-top: 10px;
  }
  .inputFile + label span {
    padding-left: 10px;
  }
  .inputFile:focus + label, .content .inputFile + label:hover {
    background-color: #5f36b3;
  }
.custom-span{ font-family: Arial; font-weight: bold;font-size: 25px; color: #FE57A1}
#uploadFile{border: none;margin-left: 10px; width: 50px;}
.custom-para{font-family: arial;font-weight: bold;font-size: 6px; color:#585858;}
</style>
<div class="row">
  <div class="col-md-12">
    <div class="container" style="background-color:#fff;padding-bottom:25px;">
        <div class="col-md-12">
            <h3>{{ $datalesson->title }}</h3>
            <hr>
            <img src="{{ $datalesson->cover }}" class="img-responsive">
        </div>
        <!-- <div class="clearfix"></div> -->
        <div class="col-md-12">
            <h3>Pertanyaan</h3>
            <hr>

            <div class="content-reload">
                @foreach($datacomment as $comment)
                <div class="col-md-12" style="margin-bottom:30px;" id="row{{ $comment->id }}">
                    <strong> @if($comment->desc == 0)  {{ $comment->username }} @else ($comment->desc == 1)  {{ $comment->contriname }} @endif </strong> pada <strong><?= date('d/m/Y',strtotime($comment->created_at)) ?></strong>
					<strong style="color:#ff5e10;">@if($comment->desc == 0)  User @else ($comment->desc == 1)  Contributor @endif</strong>
					<div class="col-md-12" style="margin-top:10px;padding-left:5%; white-space:pre-line;">
                            {{ $comment->body }}
                    <?php if(!empty($comment->images)) { ?>
                            <a id="firstlink" data-gall="myGallery" class="venobox" data-vbtype="iframe" href="{{ asset($comment->images) }}"><img src="{{ asset($comment->images) }}" alt="image alt" style="height:50px; width:50px; margin-left: 15px; margin-bottom: 20px;"/></a>
                    <?php } ?>
					</div>

                    
						<br><br>
						<?php
						$getchild = DB::table('comments_bootcamp')
							->leftJoin('members','members.id','=','comments_bootcamp.member_id')
              ->leftJoin('contributors','contributors.id','=','comments_bootcamp.contributor_id')
              ->leftJoin('profile', DB::raw('left(members.username, 1)'), '=', 'profile.huruf')
              ->leftJoin('profile as B', DB::raw('left(contributors.username, 1)'), '=', 'B.huruf')
							->where('comments_bootcamp.bootcamp_id',$datalesson->id)
							->where('parent_id',$comment->id)
							->orderBy('comments_bootcamp.created_at','ASC')
							->select('comments_bootcamp.*','members.username as username','contributors.username as contriname', 'contributors.avatar as avatar','members.avatar as ava', 'profile.slug as slug', 'B.slug as slg')
							->get();
						if (count($getchild) > 0) {
							foreach ($getchild as $child) {
						?>
						<div class="col-md-12" style="margin-top:10px;padding-left:5%;">
            <?php if($child->desc == 0){ ?>
              @if(!empty($child->ava))
							<img class="user-photo" src="{{ $child->ava }}"height="40px" width="40px" style="object-fit:scale-down;border-radius: 100%;margin-bottom:10px;">
              @else
							<img class="user-photo" src="{{asset($child->slug) }}"height="40px" width="40px" style="object-fit:scale-down;border-radius: 100%;margin-bottom:10px;">
              @endif
            <?php }else{ ?>
              @if(!empty($child->avatar))
              <img class="user-photo" src="{{ $child->avatar }}"height="40px" width="40px" style="object-fit:scale-down;border-radius: 100%;margin-bottom:10px;">

              @else
              <img class="user-photo" src="{{asset($child->slg) }}"height="40px" width="40px" style="object-fit:scale-down;border-radius: 100%;margin-bottom:10px;">

              @endif
            <?php } ?>

								<strong>
									<?php if($child->desc == 0){ ?>
										{{ $child->username }}
									<?php }else{ ?>
										{{ $child->contriname }}
									<?php } ?>
								</strong> pada <strong><?= date('d/m/Y',strtotime($child->created_at)) ?></strong>
								<strong style="color:#ff5e10;">@if($child->desc == 0)  User @else ($child->desc == 1)  Contributor @endif</strong>
								<div class="col-md-12" style="margin-top:10px;margin-bottom:10px;padding-left:5%; white-space: pre-line">
                                    {{ $child->body }}
                                    <?php if($child->images != null) { ?>
                                        <a id="firstlink" data-gall="myGallery" class="venobox" data-vbtype="iframe" href="{{ asset($child->images) }}"><img src="{{ asset($child->images) }}" alt="image alt" style="height:50px; width:50px; margin-left: 15px; margin-bottom: 20px;"/></a>
                                <?php } ?>
								</div>
								<div class="clearfix"></div>
						</div>
                        <?php
                            }
                        }
                        ?>

                    <div class="col-md-12" id="balas{{ $comment->id }}" style="padding-top:10px;padding-left:5%; ">
                        <a href="javascript:void(0)" class="btn btn-info pull-right" onclick="formbalas({{ $comment->id }})" style="border-radius:3px;">Balas</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function formbalas(comment_id){
        $('#balas'+comment_id).html('<label class="col-md-1" style="padding-left:0px;">Anda</label>'+
                                '<div class="col-md-11" style="padding-right:0px;">'+
                                '<textarea class="form-control" id="input_balas'+comment_id+'" name="balasan" placeholder="tambahkan komentar/balasan" value="" style="white-space: pre-line" rows="8" cols="80"></textarea>'+
                                '<input class="inputFile" type="file" name="image" id="file" data-multiple-caption="{count} files selected" multiple="multiple"/>'+
                                '<label for="file"><i class="fa fa-upload"></i><span>Upload Image</span></label>'+
                                '</div>'+
                                '<a href="javascript:void(0)" class="btn btn-info pull-right" onclick="dobalas('+comment_id+')" style="float:right;margin-top:10px; border-radius:3px;">Kirim</a>');
    }
    $(function (){
        $('.inputFile').each(function() {
            var $input	 = $(this),
                $label	 = $input.next('label'),
                labelVal = $label.html();
          
            $input.on('change', function(e) {
              var fileName = '';
          
              if(this.files && this.files.length > 1)
                fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
              else if(e.target.value)
                fileName = e.target.value.split('\\').pop();
          
              if(fileName)
                $label.find('span').html(fileName);
              else
                $label.html(labelVal);
            });
          });
    });
    function dobalas(comment_id){
        var token = '{{ csrf_token() }}';
        var isi_balas = $('#input_balas'+comment_id).val();
        var file_data = $('#file').prop("files")[0];
        var bootcamp_id = '{{ $comment->bootcamp_id }}';
        var member_id = '{{ $comment->member_id}}';
        dataform = new FormData();
        dataform.append( '_token', token);
        dataform.append( 'image', file_data);
        dataform.append( 'body', isi_balas);
        dataform.append( 'bootcamp_id', bootcamp_id);
        dataform.append( 'member_id', member_id);
        dataform.append( 'comment_id', comment_id);

        if (isi_balas == '') {
          alert('Harap Isi Komentar !')
        }else {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              type    :"POST",
              url     :'{{ url("contributor/bootcamp/comments/postcomment") }}',
              data    : dataform,
              dataType : 'json',
              contentType: false,
              processData: false,
              beforeSend: function(){
                   swal({
                    title: "Sedang mengirim Komentar",
                    text: "Mohon Tunggu sebentar",
                    imageUrl: "{{ asset('template/web/img/loading.gif') }}",
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                // Show image container
              },
              success:function(data){
                if (data == 1) {
                    swal({
                        title: "Anda Berhasil Membalas Komentar",
                        showConfirmButton: true,
                        icon: "success",
                        timer: 3000
                    });
                    $('.inputFile').each(function() {
                        var $input	 = $(this),
                            $label	 = $input.next('label'),
                            labelVal = $label.html();
                            $label.find('span').html('Upload Image');
                      });
                    $("#row"+comment_id).load(window.location.href + " #row"+comment_id);
                }
                else if(data==0){
                    window.location.href = '{{url("contributor/login")}}';
                }else {
                            alert('Koneksi Bermasalah, Silahkan Ulangi');
                            location.reload();
                  }
                }
          });
        }
      }
    

    function loadcontent(){
        $(".content-reload").load(window.location.href + " .content-reload");
        console.log('reload');
    }

    // setInterval(function(){
    //     loadcontent()
    // }, 5000);
</script>

@endsection()
