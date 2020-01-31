@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
    <div class="container">
            <ul class="breadcrumb">
                    <li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
            <li>Reward</li>
            </ul>
    </div>
</div>
@endsection

<style media="screen">
.category-sliders .description{
    position: absolute;
    top: 20%;
    width: 100%;
    color: #fff;

}
.catalog .description{
  position: absolute;
  top: 5%;
  text-align: center;
  width: 100%;
  color: #fff;
}
.profile .description{
    position: absolute;
    top: 25%;
    width: 100%;
    color: #fff;
    text-align: center;
    left: 0px;
}
.profile .description img{
    filter: invert(100%);
}

.blue{
    background: #55acee;
}
.btn{
    border-radius: 20px!important;
    padding: 5px 20px!important;
    font-size: 10px;
    text-decoration: none;
    color: #fff;
    position: relative;
    display: inline-block;
}


</style>
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
        @if(Session::has('no-processing'))
          <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
              {{ Session::get('no-processing') }}
          </div>
        @endif
    </div>
  </div>
  <style media="screen">
  .content-text .box-title{
      position: absolute;
      top: 60%;
      width: 100%;
      color: #fff;

  }
  .description{
      text-align: center;
      margin-top: 40px;
  }
  .date{
      text-align: center;
      /*margin-top: 40px;*/
  }
  .voucher{
      text-align: center;
      margin-top: 40px;
  }
  .voucher h4{
     margin-top: 20px;
  }
  .voucher h4 span{

    padding: 10px;
    background: #eee;
    border-radius: 5px;

  }

  </style>
  <div class="col-md-12 content-text">
          <div class="image" style="height:200px;background:url('{{ $row->image }}');background-position: center;background-repeat: no-repeat;background-size: cover;">
          </div>

        <div class="box-title" style="text-align:center;">
            <h3>{{$row->name}}</h3>
        </div>

  </div>
  <div class="col-md-12">
      <div class="description">
          <?php echo nl2br($row->description);?>
      </div>
      <div class="date">
          <?php if ($row->end < $date_now): ?>
             Sorry, voucher sudah kadarluasa
          <?php else: ?>
               Mulai dari tanggal <?php echo date("d F Y", strtotime($row->start));?> Sampai dengan <?php echo date("d F Y", strtotime($row->end));?>
          <?php endif; ?>

      </div>
      <div class="voucher">
          Kode Voucher :
          <h4><span>{{$row->code}}</span></h4>
      </div>
  </div>
  <div class="col-md-12">
      <div class="description">
          Gunakan code voucher dibawah ini di:
      </div>
      <?php
        $str = $row->url;
        $str = preg_replace('#^https?://#', '', rtrim($str,'/'));
        ?>
      <div class="button" style="text-align:center;margin-top:15px;">
         <a class="btn blue" href="{{$row->url}}">{{$str}}</a>
      </div>
  </div>
  <div class="col-md-12" style="margin-top:30px;">
      <?php echo nl2br($row->content); ?>
  </div>
</div>


@endsection()
