<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- Font OpenSans Reguler -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet">
    <link rel="stylesheet" href="css/video-sidebar.css">
    <link rel="stylesheet" href="css/plyr.css">
    <link rel="stylesheet" href="css/spacing.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Cilsy</title>
  </head>
  <body>

    <!-- Section Content -->
    <section id="wrapper">
      
      <!-- Nav Sidebar -->
      <div id="sidebar-wrapper">

        <div class="tabs-video">
          <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item active">
              <a class="nav-link" id="pills-materi-tab" data-toggle="pill" href="#pills-materi" role="tab" aria-controls="pills-materi" aria-selected="true">Materi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-diskusi-tab" data-toggle="pill" href="#pills-diskusi" role="tab" aria-controls="pills-diskusi" aria-selected="false">Diskusi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-file-praktek-tab" data-toggle="pill" href="#pills-file-praktek" role="tab" aria-controls="pills-file-praktek" aria-selected="false">File Praktek</a>
            </li>
            <div class="tabs-close">
              <a class="btn btn-menu c-blue" onclick="sidebarShow()">
                <i class="fa fa-times"></i>
              </a>
            </div>
          </ul>
        </div>

        <div class="tab-content" id="pills-tabContent">
          <!-- Tab Materi -->
          <div class="tab-pane fade active in" id="pills-materi" role="tabpanel" aria-labelledby="pills-materi-tab">
            <div class="video-materi">
              <div class="number-circle">1</div>
              <a class="collap" id="materi-1" data-toggle="collapse" href="#materi1" role="button">
                <div class="number-circle">1</div>
                <div class="title">
                  Introducion
                  <h6><span class="fa fa-clock"></span> 40:48</h6>
                </div>
                <i class="icon-collap fa fa-chevron-down"></i>
              </a>    
            </div>

            <div class="collapse submateri" id="materi1">
              <ul>
                <li>
                  <a href="#">
                    <div class="sub-materi row">
                      <div class="col-xs-10 px-0">
                        <i class="fas fa-play-circle"></i> 1. Why Linux? Why Sysadmin? Why now?
                      </div>
                      <div class="col-xs-2 px-0 text-right">
                        05:10
                        <i class="fa fa-check-circle ml-2 c-blue"></i>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="sub-materi row">
                      <div class="col-xs-10 px-0">
                        <i class="fas fa-play-circle"></i> 2. Why you should trust me as your instructur ?
                      </div>
                      <div class="col-xs-2 px-0 text-right">
                        05:10
                        <i class="fa fa-circle ml-2"></i>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="sub-materi row">
                      <div class="col-xs-10 px-0">
                        <i class="fas fa-play-circle"></i> 3. Why you should take this course?
                      </div>
                      <div class="col-xs-2 px-0 text-right">
                        05:10
                        <i class="fa fa-circle ml-2"></i>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="sub-materi row">
                      <div class="col-xs-10 px-0">
                          <i class="fas fa-play-circle"></i> 4. Apa saja perangkat dan software yang digunakan?
                      </div>
                      <div class="col-xs-2 px-0 text-right">
                        05:10
                        <i class="fa fa-circle ml-2"></i>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="sub-materi row">
                      <div class="col-xs-10 px-0">
                          <i class="fas fa-play-circle"></i> 5.  Getting all files for the rest of course
                      </div>
                      <div class="col-xs-2 px-0 text-right">
                        05:10
                        <i class="fa fa-circle ml-2"></i>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="sub-materi row">
                      <div class="col-xs-10 px-0">
                        <i class="fas fa-play-circle"></i> 6. FAQ
                      </div>
                      <div class="col-xs-2 px-0 text-right">
                        05:10
                        <i class="fa fa-circle ml-2"></i>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          
            <div class="video-materi">
              <a class="collap" id="materi-8" data-toggle="collapse" href="#materi8" role="button">
                <div class="number-circle">8</div>
                <div class="title">
                  Final Projek
                  <h6><span class="fa fa-clock"></span> 41:05</h6>
                </div>
                <i class="icon-collap fa fa-chevron-down"></i>
              </a>                      
            </div>

            <div class="collapse submateri" id="materi8">                  
              <ul>
                <li>
                  <a href="#">
                    <div class="sub-materi row">
                      <div class="col-xs-10 px-0">
                        <i class="fas fa-clipboard-list"></i> 1. Final Projek                            
                      </div>
                      <div class="col-xs-2 px-0 text-right">
                        <i class="fa fa-check-circle ml-2 c-blue"></i>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#" class="active">
                    <div class="sub-materi row">
                      <div class="col-xs-10 px-0">
                        <i class="fas fa-clipboard-list"></i> 2. Projek Preview                              
                      </div>
                      <div class="col-xs-2 px-0 text-right">
                        <i class="fa fa-check-circle ml-2 c-blue"></i>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
              
          </div>

          <!-- Tab Diskusi-->
          <div class="tab-pane fade" id="pills-diskusi" role="tabpanel" aria-labelledby="pills-diskusi-tab">
            <div class="row box m-4">
              <div class="col-xs-12">
                <h6>Buat Pertanyaan</h6>
                <textarea class="form-control" name="pertanyaan" id="pertanyaan" cols="30" rows="10"></textarea>
                <br>
                <button class="btn btn-primary mb-2">Upload Gambar</button>
                <button class="btn btn-primary mb-2">Tambah Pertanyaan</button>
              </div>

              <hr class="mb-5">

              <div class="col-xs-12">
                <hr>
                <span class="text-muted">Saat ini belum ada diskusi</span>
              </div>

            </div>
          </div>

          <!-- Tab File Praktek -->
          <div class="tab-pane fade" id="pills-file-praktek" role="tabpanel" aria-labelledby="pills-file-praktek-tab">
            <a href="file/bioskop_dataset.csv" download>
              <div class="row box m-4  px-1">
                <div class="col-xs-12">
                  <i class="fa fa-download"></i> bioskop_dataset.csv
                </div>
              </div>
            </a>
          </div>
        </div>

      </div>

      <!-- Content -->
      <div class="container-fluid p-0">
        <div class="row m-0 p-0"  id="page-content-wrapper">

          <div class="project-content project-view col-xs-12 p-0">
            <div class="header">
              <div class="col-xs-11 pl-5">
                Data Science Master Camp <br>
                <small>Basic Statistic : 3. Exercise Mean, Median, dan modus with Python</small>
              </div>
              <div class="col-xs-1 px-4">
                <button type="button" class="plyr__control btn btn-outline-primary px-4" onClick="sidebarShow()"><i class="fa fa-bars"></i></button>
              </div>
            </div>
            
            <div class="row px-5 pt-4">
              <div class="col-xs-12">
                  <style>
                      /* Tambahan Css */
                      .c-red{
                        color: red!important;
                      }
                      ul.exercise-review{
                        list-style: none;
                        list-style-position: inside;
                        padding: 0 20px;
                        padding-left: 30px;
                      }
                      ul.exercise-review li{
                        border: 1px solid #eee;
                        padding: 10px 15px;
                        padding-left: 30px;
                        margin: 10px 0;
                        font-size: 16px;
                      }
                      ul.exercise-review li:before{
                        color: #1fb6ff;
                        content: "\f058";
                        font-weight: bold;
                        font-family: "Font Awesome 5 Free";
                        display: inline-block;
                        width: 1em;
                        position: absolute;
                        margin-left: -23px;
                      }
                      ul.exercise-review li.wrong:before{
                        color: red;
                        content: "\f057";
                        font-weight: bold;
                        font-family: "Font Awesome 5 Free";
                        display: inline-block;
                        width: 1em;
                        position: absolute;
                        margin-left: -23px;
                      }
                      ul.exercise-review li h4{
                        font-weight: normal;
                        margin: 0 0 .5em;
                      }
                    </style>

                  <div class="text-center">
                    <h3 class="c-blue">Exercise Mean, median, modus with Python</h3>
                    <h5><i class="fa fa-check-circle c-blue"></i> 2/2 Pertanyaan</h5>
                    <!-- Wrong
                    <h5><i class="fa fa-times-circle c-red"></i> 2/2 Pertanyaan</h5> 
                    -->
                    <b>Anda Lulus!</b>
                  </div>

                  <br>

                  <div class="card">
                    <div class="card-header text-center">
                      <h5>Exercise Review</h5>
                    </div>
                    <div class="card-body">
                      <ul class="exercise-review">
                        <li>
                          <h4>
                            1. Carilah berapa nilai rata-rata umur dari para penonton bioskop di tahun 2019 menggunakan Python
                            Jupyternetbook (Download di File Praktek file bioskop_dataset.csv):
                          </h4>

                          <p class="text-muted">
                            Benar! Ini adalah nilai Mean. Rumusnya adalah Mean = nilai2 dari sekumpulan data/banyaknya data.
                            Bisa menggunakan command python :
                          </p>

                          <p class="text-muted">
                            mean_age=age.mean()
                            print(mean_age)
                          </p>

                          <p class="text-muted">
                            Dengan catatan:
                            mean_age adalah nama variable untuk menyimpan nilai mean.
                            age adalah kolom age pada file bioskop_dataset, yaitu sekumpulan data yang ingin kita cari nilai meannya.
                          </p>
                        </li>
                        <li class="wrong">
                          <h4>
                            2. Yang manakah yang di bawah ini bukan termasuk pengertian dari mean :
                          </h4>

                          <p class="text-muted">
                            Benar! Ini bukan tujuan dari Mean, melainkan tujuan dari Mode/Modus.
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>

              </div>
            </div> 
          </div>

        </div>
      </div>

    </section>




    <!-- JavaScript -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap2.min.js"></script>
    <script type="text/javascript" src="js/plyr.min.js"></script>
    <script>
    //function Menu sidebar    
    function sidebarShow(){
      if($("#wrapper").hasClass("toggled")){
        $("#wrapper").removeClass('toggled');
      }else{
        $("#wrapper").addClass('toggled');
      }
    }

    $('.collap').click(function(e){
      var datatarget =  $(this).attr("href");
      var idtarget =  $(this).attr("id");
      $(datatarget).on('shown.bs.collapse', function() {
        $('#'+idtarget+' i').removeClass('fa-chevron-down').addClass('fa-chevron-up');        
      });

      $(datatarget).on('hidden.bs.collapse', function() {
        $('#'+idtarget+' i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
      });
    });
    </script>
  </body>
</html>