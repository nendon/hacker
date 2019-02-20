@extends('web.app')
@section('title', $members->full_name)
@section('content')
<link href="{{ asset('template/web/css/landing.css') }}" rel="stylesheet">
<style>
        .btn-tag {
            display: inline-block;
            position: relative;
            margin: 5px 10px 5px 0px;
            background-color: white;
            color:black;
            padding:10px 25px;
            border-radius:50px;
          }
</style>
<section class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-xs-12 col-sm-12">
                    @if($members->avatar != null)
                    <img class="img-circle img-responsive" src="{{$members->avatar}}" alt="avatar" style="height: 150px; width: 150px;">
                    @else
                    <img class="img-circle img-responsive" src="{{asset(profil())}}" alt="avatar" style="height: 150px; width: 150px;">
                    @endif
            </div>
            <div class="col-md-10">
                <h2>{{ ucwords($members->full_name) }}</h2>
                <h4>{{ ucwords($members->role)}} di {{ucwords($members->instansi)}}</h4>
                <p><i class="fa fa-map-marker" style="font-size:20px;color:white"></i> Bandung, Jawa Barat</p>
                <p>{{substr($members->bio, '0', 800)}}</p>
                
                @foreach(explode(',', $members->keahlian) as $info) 
                <div class="btn-tag">
                        {{$info}}
                </div>
                @endforeach
            </div>
        </div>
        
    </div>
</section>
<div class="container">
  @if(Auth::guard('members')->user()->id != $members->id)
    @if($members->public == 0 )
      <div class="row">
        <h4>Profil member ini tidak publik</h4>
      </div>
    @else
          <div class="row">
              <h4>Tutorial yang {{ $members->full_name}} ikuti</h4>
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
                                <p>Total <?php echo Helper::getTotalVideo($lesson->lesson_id);?> Video</p>
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
    @endif
    @else
    <div class="row">
        <h4>Tutorial yang {{ $members->full_name}} ikuti</h4>
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
    @endif
    
</div>
@endsection