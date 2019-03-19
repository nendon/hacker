@extends('web.app')
@section('title','')
@section('content')

    <!-- Section Header -->
    <section class="header">
        <i class="fa fa-circle"></i>
        <a style="color:white;" href="{{ url('bootcamp/course') }}">Dashboard</a>
    </section>

    <!-- Section Content -->
    <section class="project-view mt-5">
      <div class="container">

        <div class="row">
          <div class="col-xs-12 text-center">
            <h4 class="c-blue">Bootcamp {{$bcs->title}}</h4>
            <h4 class="c-blue">Course {{$course->title}}</h4>
            <h5 class="text-muted">Lessons {{$sect->title}}</h5>
          </div>
        </div>

        <!-- Row -->
        <div class="row">
          <div class="col-xs-12">
            <div class="card">
              <div class="card-header">
                <h5>Project Preview {{$project->title}}</h5>
              </div>
              <div class="card-body">

                @foreach($projectUser as $key => $projectUser )
                <div class="card" >
                  @if($projectUser->status == 1)
                  <br>
                  <div class="col-xs-2 px-100 text-left" style="width: 100%;"> <?php echo date_format($projectUser->created_at,"d F Y - H:i:s"); ?></div>
                  <br>
                  <div class="col-xs-2 px-100 text-left" style="color:red;width: 100%;"> Project Anda belum lolos review ! <br>
                  <i class="fa fa-circle ml-2"> </i> {{$projectUser->komentar_user}} 
                  </div>
                  <div class="col-xs-2 px-100 text-left"  style="width: 100%;">
                  pesan dari kontributor : <br> {{$projectUser->komentar_contributor}} 
                  </div>
                  @elseif($projectUser->status == 2) 
                  
                  <br>
                  <div class="col-xs-2 px-100 text-left" style="width: 100%;"> <?php echo date_format($projectUser->created_at,"d F Y - H:i:s"); ?> </div>
                  <br>
                  <div class="col-xs-2 px-100 text-left" style="color:blue;width: 100%;">  Project Anda telah berhasil lolos review ! <br>
                  <i class="fa fa-check-circle ml-2 c-blue"> </i> {{$projectUser->komentar_user}} 
                  </div>
                  <div class="col-xs-2 px-100 text-left" style="width: 100%;">
                  pesan dari kontributor :<br> {{$projectUser->komentar_contributor}} 
                  </div>
                  @endif 
                  <br>
                  <br>
                </div>
                @endforeach
              
              <br><br>
                
                
             
           </div> 
          </div>
        </div>

      </div>
    </section>

@endsection()