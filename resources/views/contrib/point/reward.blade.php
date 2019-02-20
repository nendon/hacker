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

        <div class="col-md-5">
            <div class="col-md-12">
                <h3>Point Saya</h3>
            </div>
            <div class="col-md-12 profile" >
                <a title="Image 1" href="#"><img class="thumbnail img-responsive" src="//placehold.it/600x350"></a>
                <div class="description">
                    <div class="col-md-12">
                        <img class="photo" src="{{asset('template/kontributor/img/icon/Akun.png')}}" height="110px" width="110px" style="object-fit:scale-down;border-radius: 100%;">
                        <h4  style="padding-bottom:10px;">{{$contrib->point}} Pts</h4>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <h3>Reward Saya</h3>
            </div>
         <?php foreach ($myreward as $key => $value): ?>
           <div class="col-md-12 catalog">
              <a title="Image 1" href="#"><img class="thumbnail img-responsive" src="{{$value->image}}"></a>
              <div class="description">
                  <div class="col-md-12">
                      <h4  style="padding-bottom:10px;">{{$value->name}}</h4>
                      <p  style="padding-bottom:10px;"><?php echo nl2br($value->description); ?></p>
                      <h4  style="padding-bottom:10px;">{{$value->poin}} Pts</h4>
                      <a class="btn blue" href="{{url('contributor/reward/'.$value->myid.'/detail')}}">Lihat</a>
                  </div>
              </div>
           </div>
         <?php endforeach; ?>


        </div>
        <div class="col-md-7">
            <div class="col-md-12">
                <h3>Reward</h3>
            </div>
              <?php foreach ($category as $key => $cat): ?>
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme category-sliders" id="category-sliders" style="text-align:center;">
                        <?php foreach ($reward as $key => $value): ?>
                          <?php if ($cat->id == $value->category_id): ?>
                          <div class="item">
                             <a title="Image 1" href="#"><img class="thumbnail img-responsive" src="{{$value->image}}"></a>
                             <div class="description">
                                 <div class="col-md-12">
                                     <h4  style="padding-bottom:10px;">{{$value->name}}</h4>
                                     <p  style="padding-bottom:10px;"><?php echo nl2br($value->description); ?></p>
                                     <h4  style="padding-bottom:10px;">{{$value->poin}} Pts</h4>
                                     <a class="btn blue" href="{{url('contributor/reward/'.$value->slug.'/change')}}">Tukar</a>
                                 </div>
                             </div>
                          </div>
                          <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
              <?php endforeach; ?>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $('.category-sliders').owlCarousel({
    loop:true,
    margin:10,
    // nav:true,
    // navText: ["<i class='fa fa-chevron-left' aria-hidden='true'></i>","<i class='fa fa-chevron-right' aria-hidden='true'></i>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
    })
</script>
@endsection()
