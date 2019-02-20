@extends('web.app')
@section('title','Dashboard Tutorial | ')
@section('content')
@push('css')


@endpush
<style>
@media (max-width:768px) {
    .section-content{
      min-height: 300px;
      padding-top: 50px;
      padding-bottom: 50px;
    }
}
@media (min-width:768px) {
    .section-content{
      min-height: 460px;
      padding-top: 50px;
      padding-bottom: 50px;
    }
}
  .item {
    padding: 25px;
    border-bottom: 1px solid #eee;
  }
  .item a{
    color: #666;
  }
.card {
    margin-bottom: 15px;
    border-radius: 5px;
    
    
}
.card:hover {
    text-decoration: none;
    -webkit-box-shadow: 4px 4px 13px 0px rgba(0,0,0,0.18);
    -moz-box-shadow: 4px 4px 13px 0px rgba(0,0,0,0.18);
    box-shadow: 4px 4px 13px 0px rgba(0,0,0,0.18);
}
.card a {
    text-decoration: none;
}
.card-img {
    width: 100%;
    height: 150px;
    background-size: cover;
    background-position: center center;
}
.card-body {
    height: 100px;
    padding: 15px;
    padding-bottom: 15px;
    background-color: #FAFAFA;
}
.card-info {
    padding-bottom: 15px;
    position: absolute;
    left: 20;
    bottom: 0;
}

</style>

<div class="container section-content">

<div class="col-sm-12">
@if(empty($progress) || empty($last))
<div class="alert alert-danger" role="alert">
              Belum ada tutorial yang anda tonton 
</div> 
  @else
    <h4>Tutorial Terakhir Ditonton</h4>
        <div class="item">
          <?php
           if($last != '0') { 
             if($progress != '0') { ?>
            <div class="row">
            <div class="col-md-4">
                <img src="{{ $last->image }}" alt="" class="img-responsive">
              </div>
              <div class="col-sm-8">
                <p><strong><h3>{{ $last->title }}</h3></strong></p>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="{{number_format($progress)}}"
                  aria-valuemin="0" aria-valuemax="100" style="width:{{number_format($progress)}}%; background-color: #3CA3E0;">
                    {{number_format($progress)}}%
                  </div>
                </div>
                <p><a href="{{ url('dashboard/'.$last->slug) }}" class="btn btn-primary btn-lg pull-right" style="color :white; background-color: #3CA3E0; border-color: #3CA3E0; margin-top: 100px;">Lanjutkan Tutorial</a></p>
                </p>
              </div>
            </div>
           <?php }else{ ?>
              <div class="alert alert-danger" role="alert">
              Belum ada tutorial yang anda tonton 
              </div>
          <?php }
            }else{ ?>
              <div class="alert alert-danger" role="alert">
              Belum ada tutorial yang anda tonton 
              </div>

            <?php } ?>   
  @endif
 </div>

    <div class="col-sm-12" style="margin-top: 50px;">
      <h4>Tutorial Yang Diikuti</h4>
      <?php
       if(!count($lessons) == 0) {
                $i = 1;
                foreach ($lessons as $key => $lesson): ?>
                    <?php if ($i <= 4) {?>
                      <div class="col-md-3">
                        <a href="{{ url('kelas/v3/'.$lesson->slug)}}" style="text-decoration: none;">
                          <div class="card">
                            <?php if (!empty($lesson->image)) {?>
                              <img src="{{ asset($lesson->image) }}" alt="" class="img-responsive">
                            <?php } else {?>
                              <img src="{{ asset('template/web/img/no-image-available.png') }}" alt="" class="img-responsive">
                            <?php }?>
                            <div class="caption">
                              <p>{{ $lesson->title }}</p>
                            </div>
                            <div class="footer">
                              <p>Total <?php echo Helper::getTotalVideo($lesson->id);?> Video</p>
                            </div>
                          </div>
                        </a>
                      </div>
                  <?php } ?>
                  <?php $i++;?>

              <?php endforeach; 
              }else{ ?>
               <div class="alert alert-danger" role="alert">
               Belum ada tutorial yang anda ikuti 
               </div>

              <?php } ?>
    </div>

    <div class="col-sm-12" style="margin-top: 50px;">
      <h4>Tutorial Terselesaikan</h4>
     @if(empty($full))
         <div class="alert alert-danger" role="alert">
               Belum ada tutorial yang anda selesaikan 
      </div>

      @else
     
      <?php
        if(!count($full) == 0) {
                $i = 1;
                foreach ($full as $key => $full): ?>
                    <?php if ($i <= 4) {?>
                      <div class="col-md-3">
                        <a href="{{ url('kelas/v3/'.$full->slug)}}" style="text-decoration: none;">
                          <div class="card">
                            <?php if (!empty($full->image)) {?>
                              <img src="{{ asset($full->image) }}" alt="" class="img-responsive">
                            <?php } else {?>
                              <img src="{{ asset('template/web/img/no-image-available.png') }}" alt="" class="img-responsive">
                            <?php }?>
                            <div class="caption">
                              <p>{{ $full->title }}</p>
                            </div>
                            <div class="footer">
                              <p>Total <?php echo Helper::getTotalVideo($full->id);?> Video</p>
                            </div>
                          </div>
                        </a>
                      </div>
                  <?php } ?>
                  <?php $i++;?>
              <?php endforeach; ?>
      <?php }else{ ?>
      <div class="alert alert-danger" role="alert">
               Belum ada tutorial yang anda selesaikan 
      </div>

      <?php } ?>
      @endif
    </div>

  <div class="col-sm-12" style="margin-top: 20px;">
      <h4>Tutorial yang sudah di miliki</h4>
      <?php
           if(!count($belitut) == 0) {
                foreach ($belitut as $key => $belitut): ?>  
                  <div class="col-md-3">
                    <div class="card" >
                      <a href="{{ url('kelas/v3/'.$belitut->slug)}}">
                          <?php if (!empty($belitut->image)) {?>
                            <div class="card-img" style="background-image: url('{{ asset($belitut->image)}}');"></div>
                          <?php } else {?>
                            <div class="card-img" style="background-image: url('{{ asset('template/web/img/no-image-available.png')}}');"></div>
                          <?php }?>
                          <div class="card-body"><p class="card-title">{{ $belitut->title }}</p></div>           
                      </a>
                    </div>
                  </div>

              <?php endforeach; 
              }else{ ?>
               <div class="alert alert-danger" role="alert">
               Belum ada tutorial yang anda beli 
               </div>

              <?php } ?>
    </div>


    </div>



</div>
 

   

@endsection
