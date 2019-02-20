@extends('web.app')
@section('title','Dashboard')
@section('content')
    <!-- Main -->
    <main>

      <!-- Section Header -->
      <section class="header">
      </section>

      <section>

        <!-- Container -->
        <div class="container">

          <!-- Row -->
          <div class="row box p-0">
            <div class="col-sm-4 col-xs-12 p-0 image-preview" style="background: url({{asset('img/head.png')}});">
              <!-- Image for full width  & height -->
            </div>
            <div class="col-sm-8 col-xs-12">
              <h4>Training to Become a Sysadmin Professional</h4>
              <h6>Linux Fundamental</h6>
              <!-- Timeline -->
              <div class="timeline">
                  <div class="timeline__wrap">
                    <div class="timeline__items">
                      <div class="timeline__item active">
                        <div class="timeline__content">
                          <h5 class="lesson-title">Lesson 1</h5>
                        </div>
                      </div>
                      <div class="timeline__item">
                        <div class="timeline__content">
                          <h5 class="lesson-title">Lesson 2</h5>
                        </div>
                      </div>
                      <div class="timeline__item">
                        <div class="timeline__content">
                          <h5 class="lesson-title">Lesson 3</h5>
                        </div>
                      </div>
                      <div class="timeline__item">
                        <div class="timeline__content">
                          <h5 class="lesson-title">Lesson 4</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
               <!-- Timeline -->

               
              <a href="{{ url('Bootcamp/VideoPage') }}" class="btn btn-primary btn-lg mt-5 mb-2">Lanjutkan ke Lesson 2</a>
            </div>
          </div>


          <!-- Tabs-->
          <div class="tabs-dashboard">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item active">
                <a class="nav-link pills-filter" id="pills-tutorial-tab" data-toggle="pill" href="#pills-tutorial" role="tab" aria-controls="pills-tutorial" aria-selected="true">Tutorial</a>
              </li>
              <li class="nav-item">
                <a class="nav-link pills-filter" id="pills-learning-tab" data-toggle="pill" href="#pills-learning" role="tab" aria-controls="pills-learning" aria-selected="false">Learning Path</a>
              </li>
            </ul>
          </div>

          <div class="tab-content" id="pills-tabContent">

            <!-- Tab Tutorial -->
            <div class="tab-pane fade active in" id="pills-tutorial" role="tabpanel" aria-labelledby="pills-tutorial-tab">
              <div class="row">
                <div class="col-sm-8 col-xs-12">
                  <h4 class="c-blue mt-4">Semua Tutorial yang diikuti dan Terselesaikan</h4>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <div class="filter">
                    <ul class="filter-nav">
                      <li class="filter-item active" data-id="tutorial" data-filter="*">
                        <span class="filter-link" href="#">Semua</span>
                      </li>
                      <li class="filter-item" data-id="tutorial" data-filter=".diikuti">
                        <span class="filter-link" href="#">Diikuti</span>
                      </li>
                      <li class="filter-item" data-id="tutorial" data-filter=".selesai">
                        <span class="filter-link" href="#">Selesai</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
                 
              <div class="row grid">
                <!-- Box Content -->
                <div class="col-md-3 col-sm-6 col-xs-12 p-4 all diikuti">
                  <div class="card">
                    <div class="label">
                      Tutorial
                    </div>
                    <img src="{{asset('img/card-1.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <div class="card-author">
                        <img src="{{asset('img/users.png')}}" class="img-author" alt="">
                        Official Cilsy
                      </div>
                      <h5 class="card-title">
                        Panduan Lengkap dan Kompherensif Menguasai Mikrotik - For beginner
                      </h5>
                      <div class="card-progress">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                          <div class="progress-number">
                            10%
                          </div>
                        </div>
                      </div>
                      <a href="#" class="btn btn-outline-primary">Lanjutkan</a>
                    </div>
                  </div>
                </div> 
                <!-- End Box Conten -->

                <!-- Box Content -->
                <div class="col-md-3 col-sm-6 col-xs-12 p-4 all diikuti">
                  <div class="card">
                    <div class="label">
                      Tutorial
                    </div>
                    <img src="{{asset('img/card-2.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <div class="card-author">
                        <img src="{{asset('img/users.png')}}" class="img-author" alt="">
                        Official Cilsy
                      </div>
                      <h5 class="card-title">
                        Membangun Jaringan Hotspot Skala Besar dengan Mikrotik Freeradius
                      </h5>
                      <div class="card-progress">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          <div class="progress-number">
                            0%
                          </div>
                        </div>
                      </div>
                      <a href="#" class="btn btn-outline-primary">Lanjutkan</a>
                    </div>
                  </div>
                </div> 
                <!-- End Box Conten -->

                <!-- Box Content -->
                <div class="col-md-3 col-sm-6 col-xs-12 p-4 all diikuti">
                  <div class="card">
                    <div class="label">
                      Tutorial
                    </div>
                    <img src="{{asset('img/card-2.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <div class="card-author">
                        <img src="{{asset('img/users.png')}}" class="img-author" alt="">
                        Official Cilsy
                      </div>
                      <h5 class="card-title">
                        Membangun Jaringan Hotspot Skala Besar dengan Mikrotik Freeradius
                      </h5>
                      <div class="card-progress">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                          <div class="progress-number">
                            70%
                          </div>
                        </div>
                      </div>
                      <a href="#" class="btn btn-outline-primary">Lanjutkan</a>
                    </div>
                  </div>
                </div> 
                <!-- End Box Conten -->

                <!-- Box Content -->
                <div class="col-md-3 col-sm-6 col-xs-12 p-4 all diikuti">
                  <div class="card">
                    <div class="label">
                      Tutorial
                    </div>
                    <img src="{{asset('img/card-2.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <div class="card-author">
                        <img src="{{asset('img/users.png')}}" class="img-author" alt="">
                        Official Cilsy
                      </div>
                      <h5 class="card-title">
                        Membangun Jaringan Hotspot Skala Besar dengan Mikrotik Freeradius
                      </h5>
                      <div class="card-progress">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                          <div class="progress-number">
                            70%
                          </div>
                        </div>
                      </div>
                      <a href="#" class="btn btn-outline-primary">Lanjutkan</a>
                    </div>
                  </div>
                </div> 
                <!-- End Box Conten -->
              </div>

            </div>
            <!-- End Tab Tutorial -->

            <!-- Tab Learning Path -->
            <div class="tab-pane fade" id="pills-learning" role="tabpanel" aria-labelledby="pills-learning-tab">
              <div class="container">
                <div class="row">
                  <div class="col-sm-8 col-xs-12">
                    <h4 class="c-blue mt-4">Semua Learning Path yang diikuti dan Terselesaikan</h4>
                  </div>
                  <div class="col-sm-4 col-xs-12">
                    <div class="filter">
                      <ul class="filter-nav">
                          <li class="filter-item active"  data-id="learning" data-filter="*">
                            <span class="filter-link">Semua</span>
                          </li>
                          <li class="filter-item"  data-id="learning" data-filter=".diikuti">
                            <span class="filter-link">Diikuti</span>
                          </li>
                          <li class="filter-item"  data-id="learning" data-filter=".selesai">
                            <span class="filter-link">Selesai</span>
                          </li>
                        </ul>
                    </div>
                  </div>
                </div>
                      
                <div class="row grid">
                  <!-- Box Content -->
                  <div class="col-md-3 col-sm-6 col-xs-12 p-4 all diikuti">
                    <div class="card">
                      <div class="label">
                        Learning Path
                      </div>
                      <img src="{{asset('img/card-1.png')}}" class="card-img-top" alt="...">
                      <div class="card-body">
                        <div class="card-author">
                          <img src="{{asset('img/users.png')}}" class="img-author" alt="">
                          Official Cilsy
                        </div>
                        <h5 class="card-title">
                          Training to Become a Sysadmin Professional
                        </h5>
                        <div class="card-progress">
                          <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">10%</div>
                            <div class="progress-number">
                              10%
                            </div>
                          </div>
                        </div>
                        <a href="{{ url('Bootcamp/CourseSylabus') }}" class="btn btn-outline-primary">Lanjutkan</a>
                      </div>
                    </div>
                  </div> 
                  <!-- End Box Conten -->
    
                  <!-- Box Content -->
                  <div class="col-md-3 col-sm-6 col-xs-12 p-4 all diikuti">
                    <div class="card">
                      <div class="label">
                        Learning Path
                      </div>
                      <img src="{{asset('img/card-2.png')}}" class="card-img-top" alt="...">
                      <div class="card-body">
                        <div class="card-author">
                          <img src="{{asset('img/users.png')}}" class="img-author" alt="">
                          Official Cilsy
                        </div>
                        <h5 class="card-title">
                          Training to Become a Data Science with Python
                        </h5>
                        <div class="card-progress">
                          <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                            <div class="progress-number">
                              0%
                            </div>
                          </div>
                        </div>
                        <a href="#" class="btn btn-outline-primary">Lanjutkan</a>
                      </div>
                    </div>
                  </div> 
                  <!-- End Box Conten -->
    
                  <!-- Box Content -->
                  <div class="col-md-3 col-sm-6 col-xs-12 p-4 all diikuti selesai">
                    <div class="card">
                      <div class="label">
                        Learning Path
                      </div>
                      <img src="{{asset('img/card-3.png')}}" class="card-img-top" alt="...">
                      <div class="card-body">
                        <div class="card-author">
                          <img src="{{asset('img/users.png')}}" class="img-author" alt="">
                          Official Cilsy
                        </div>
                        <h5 class="card-title">
                          Training to Become a Devops Engineer
                        </h5>
                        <div class="card-progress">
                          <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                            <div class="progress-number">
                              0%
                            </div>
                          </div>
                        </div>
                        <a href="#" class="btn btn-outline-primary">Lanjutkan</a>
                      </div>
                    </div>
                  </div> 
                  <!-- End Box Conten -->
                </div>
                
              </div>  
            </div>

          </div>


        </div>
      </section>

    </main>

    


    <!-- JavaScript -->
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script>
    /* Timeline */
		$(function(){
			$('.timeline').timeline({
				mode: 'horizontal',
				forceVerticalMode: 100
			});
		});

    //------- Filter  js --------//  
    $('.filter-nav li').click(function(){
      $('.filter-nav li').removeClass('active');
      $(this).addClass('active');

      var id = $(this).attr('data-id');
      var data = $(this).attr('data-filter');

      if(id="tutorial"){
        $gridtutorial.isotope({
          filter: data
        })
      }
      if(id="learning"){
        $gridlearning.isotope({
          filter: data
        })
      }
    });

    if($("#pills-tutorial.tab-pane")||$("#pills-learning.tab-pane")){
        var $gridtutorial = $("#pills-tutorial .grid").isotope({
          itemSelector: ".all",
          layoutMode: 'masonry',
          percentPosition: true,
          masonry: {
            columnWidth: ".all"
          }
        })
        var $gridlearning = $("#pills-learning .grid").isotope({
          itemSelector: ".all",
          layoutMode: 'masonry',
          percentPosition: true,
          masonry: {
            columnWidth: ".all"
          }
        })
    };


    $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
      var tabIsotope =  $(this).attr("aria-controls");
      if(tabIsotope=='pills-tutorial'){
        $gridtutorial.isotope('layout');
        }else{
        $gridlearning.isotope('layout');
      }
    });
    </script>
@endsection()