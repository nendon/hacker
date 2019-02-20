@extends('web.app')
@section('title','')
@section('content')

    <!-- Main -->
    <main>

      <!-- Section Header -->
      <section class="header" style="background: url({{asset('img/bg-head.jpg')}});background-size: cover;padding-bottom: 80px">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <h6 class="mb-5">Training to Become a {{$bc->slug}} / Couse Part 1</h6>
              <h2 class="mb-4">{{$course->title}}</h2>
              <h6>
                {{$course->deskripsi}}
              </h6>
              <br>
              <button class="btn btn-second btn-lg mb-2">Mulai belajar</button>
            </div>
          </div>
        </div>
      </section>

      <!-- Section Content -->
      <section class="container-fluid lesson">
          <div class="row">
            <div class="col-sm-8 col-xs-12">
              <ul class="durationlesson">
                <li>08 Jam 31 Menit</li>
                <li>Deadline 2 Hari</li>
                <li>5 Projek</li>
                <li>3 Exercises</li>
              </ul>
            </div>
            <div class="col-sm-3 col-xs-10" style="margin-top:10px;">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="col-sm-1 col-xs-2">
              0%
            </div>
          </div>
      </section>

      <section class="mt-5">

        <!-- Container -->
        <div class="container">
          
          <!-- Content Timeline -->
          <ul class="timelines">
            <?php
             $i = 1;
             $a =1;
             foreach ($stn as $key => $section): ?>
             
            <li>
              <div class="timelines-number"><?php echo $i; ?></div>
              <div class="timelines-content">
                <div class="row box p-0">
                  <div class="col-xs-12">
                    <h6>Lesson <?php echo $i; ?></h6> <?php $i++;?> 
      
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                          <h4>{{$section->title}}</h4>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                          1 Jam 20 Menit
                        </div>
                        <div class="col-md-2 col-sm-5 col-xs-5 mt-3">
                            <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-sm-1 col-xs-1 p-0 pt-1">
                          0%
                        </div>
                    </div>
      
                    <p>
                     {{$section->deskripsi}}
                    </p>
      
                    <br>

                    <div class="collapse" id="{{$section->id}}">

                      <ul class="lesson-detail">
                        <?php
                           foreach ($section->video_section as $key => $vs): ?>
                        <li>
                            <h4><i class="fas fa-play-circle"></i>{{$vs->title}}</h4>
                            <div class="row">
                              <div class="col-xs-10">
                                {{$vs->deskripsi_video}}  
                              </div>
                              <div class="col-sm-1 col-xs-2 p-0">
                                {{$vs->durasi}}
                              </div>
                              <div class="col-xs-1 p-0">
                                <i class="fa fa-check-circle"></i>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        </li>
                      </ul>

                    </div>
                  </div>
                  <div class="col-xs-12 px-5 py-3 bg-grey">
                      <a class="collap" id="<?php echo "collapse-".$a ?>" data-toggle="collapse" href="#{{$section->id}}" role="button"><span>Lihat Detail Lesson <i class="fa fa-chevron-down"></i></span></a>
                      <a href="{{ url('bootcamp/'.$bc->slug.'/videoPage/'.$section->id) }}" class="btn btn-primary float-right">Mulai Belajar</a>
                  </div>
                </div>
              </div>
              
                
                <?php $a++;?>
                <?php endforeach; ?>
            </li>
          </ul>
        </div>

      </section>

    </main>


    <!-- Javascript -->
    <script type="text/javascript" src="{{asset('js/jquery-2.2.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script>
    $('.collap').click(function(e){
      var datatarget =  $(this).attr("href");
      var idtarget =  $(this).attr("id");
      $(datatarget).on('shown.bs.collapse', function() {
        $('#'+idtarget).html('Sembunyikan Detail Lesson <i class="fa fa-chevron-up"></i>'); 
      });

      $(datatarget).on('hidden.bs.collapse', function() {
        $('#'+idtarget).html('Lihat Detail Lesson <i class="fa fa-chevron-down"></i>'); 
      });
    });
    </script>
@endsection()