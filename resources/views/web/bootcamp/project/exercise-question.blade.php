@extends('web.app')
@section('title','')
@section('content')
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

        <div class="tab-content tab-content-video-page" id="pills-tabContent">
         <!-- Tab Materi -->
         <div class="tab-pane fade active in" id="pills-materi" role="tabpanel" aria-labelledby="pills-materi-tab">
          <?php
             $a = 1;
             foreach ($stn as $key => $section): 
              $valid = DB::table('section')
              ->join('video_section', 'section.id','video_section.section_id')
              ->leftjoin('project_section', 'section.id', 'project_section.section_id')
              ->leftjoin('project_user', function($join){
               $join->on('project_section.id', '=', 'project_user.project_section_id')
               ->where('project_user.member_id', '=', Auth::guard('members')->user()->id);})
              ->leftjoin('history', function($join){
                 $join->on('video_section.id', '=', 'history.video_id')
                 ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
              ->where('section.id', $section->id)
              ->select('section.id as section','section.position as posisi', DB::raw('count( DISTINCT video_section.id) + count(distinct project_section.id) as project'), DB::raw('count(DISTINCT project_user.id)+ count(distinct history.id) as hasil'))
              ->groupby('section.id', 'section.position')
              ->first();
             $persen = number_format($valid->hasil / $valid->project*100); 
             
             $n = $valid->posisi;
             $sect = $valid->section;

          ?>
             
              <div class="video-materi">
                <a class="collap" id="<?php echo "materi-".$a ?>" data-toggle="collapse" href="#{{$section->id}}" role="button">
               
                  <div class="number-circle"><?php echo $a ;?></div>
                  <div class="title">
                     {{$section->title}}
                    <h6><span class="fa fa-clock"></span>
                      <!-- menambahkan fungsi untuk memanggil total menit section -->
                      <?php 
                          $totalmenit = DB::table('video_section')
                          ->where('section_id', $section->id)
                          ->select(DB::raw('sum(durasi) as total'))
                          ->first();

                          echo gmdate("H:i:s", $totalmenit->total);
                      ?>
                    </h6>
                  </div>
                  <i class="icon-collap fa fa-chevron-down"></i>
                </a>
              </div>
              <?php if($valid->project == $valid->hasil)    {   ?>
              <div class="collapse submateri" id="{{$section->id}}">
                <ul>
                <?php
                 $i = 1;
                 foreach ($section->video_section as $key => $materi): ?>
                  <li> 
                    <a href="{{ url('bootcamp/'.$bc->slug.'/videoPage/'.$materi->section_id)}}"
                        data-url="{{$materi->file_video}}"
                        data-title="{{$materi->title}}"
                        data-video_id="{{$materi->id}}"
                        data-section_id="{{$materi->section_id}}"
                        onclick="changeVideo(this), saveHistory(this)"
                    >
                      <div class="sub-materi row">
                        <!-- mengubah col-xs-10 jadi 8 -->
                        <div class="col-xs-8 px-0">
                          <i class="fas fa-play-circle"></i><?php echo " $i."; ?> {{$materi->title}}
                        </div>
                        <!-- mengubah col-xs-2 jadi 0 -->
                        <div class="col-xs-0 px-0 text-right">
                          <!-- {{$materi->durasi}} -->
                           <!-- menambahkan fungsi untuk mengubah durasi menit ke format waktu -->
                           <?php 
                              echo gmdate("H:i:s", $materi->durasi);
                            ?>
                          <?php 
                          $history = DB::table('video_section')
                          ->join('history', 'video_section.id', 'history.video_id')->where('video_section.id', $materi->id)->where('history.member_id', '=', Auth::guard('members')->user()->id)->first();
                          if($history){        
                          ?>
                          <i class="fa fa-check-circle ml-2 c-blue"></i>
                          <?php }else{ ?>
                          <i class="fa fa-circle ml-2"></i>
                          <?php } ?>
                        </div>
                      </div>
                    </a>
                  </li>
                  <?php $i++;?>
                  <?php endforeach; ?>
                  <?php
                  foreach ($section->project_section as $key => $projects): ?>
                  <li>
                  <a href="{{ url('bootcamp/'.$bc->slug.'/projectSubmit/'.$section->id) }}">
                    <div class="sub-materi row">
                      <div class="col-xs-10 px-0">
                        <i class="fas fa-clipboard-list"></i>  {{$projects->title}}
                      </div>
                      <div class="col-xs-2 px-0 text-right">
                      <?php 
                         $cek = DB::table('project_section')
                         ->join('project_user', 'project_section.id', 'project_user.project_section_id')
                         ->where('project_section.id', $projects->id)
                         ->where('project_user.status', 2)
                         ->where('project_user.member_id', '=', Auth::guard('members')->user()->id)
                         ->first();
                          if($cek){        
                          ?>
                        <i class="fa fa-check-circle ml-2 c-blue"></i>
                          <?php }else{ ?>
                          <i class="fa fa-circle ml-2"></i>
                        <?php } ?>
                      </div>
                    </div>
                  </a >
                </li>
                <?php endforeach; ?>
                </ul>
              </div>
              <?php }else{
                        
              if($valid->posisi == '1'){ ?>
              <div class="collapse submateri" id="{{$section->id}}">
                <ul>
                <?php
                 $i = 1;
                 foreach ($section->video_section as $key => $materi): ?>
                  <li>
                    <a href="{{ url('bootcamp/'.$bc->slug.'/videoPage/'.$materi->section_id)}}"
                        data-url="{{$materi->file_video}}"
                        data-title="{{$materi->title}}"
                        data-video_id="{{$materi->id}}"
                        data-section_id="{{$materi->section_id}}"
                        onclick="changeVideo(this), saveHistory(this)"
                    >
                      <div class="sub-materi row">
                        <div class="col-xs-10 px-0">
                          <i class="fas fa-play-circle"></i><?php echo " $i."; ?> {{$materi->title}}
                        </div>
                        <div class="col-xs-2 px-0 text-right">
                            <?php 
                              echo gmdate("H:i:s", $materi->durasi);
                            ?>
                          <?php 
                          $history = DB::table('video_section')
                          ->join('history', 'video_section.id', 'history.video_id')->where('video_section.id', $materi->id)->where('history.member_id', '=', Auth::guard('members')->user()->id)->first();
                          if($history){        
                          ?>
                          <i class="fa fa-check-circle ml-2 c-blue"></i>
                          <?php }else{ ?>
                          <i class="fa fa-circle ml-2"></i>
                          <?php } ?>
                        </div>
                      </div>
                    </a>
                  </li>
                  <?php $i++;?>
                  <?php endforeach; ?>
                  <?php
                  foreach ($section->project_section as $key => $projects): ?>
                  <li>
                  <a href="{{ url('bootcamp/'.$bc->slug.'/projectSubmit/'.$section->id) }}">
                    <div class="sub-materi row">
                      <div class="col-xs-10 px-0">
                        <i class="fas fa-clipboard-list"></i>  {{$projects->title}}
                      </div>
                      <div class="col-xs-2 px-0 text-right">
                      <?php 
                          $cek = DB::table('project_section')
                          ->join('project_user', 'project_section.id', 'project_user.project_section_id')
                          ->where('project_section.id', $projects->id)
                          ->where('project_user.status', 2)
                          ->where('project_user.member_id', '=', Auth::guard('members')->user()->id)
                          ->first();
                          if($cek){        
                          ?>
                        <i class="fa fa-check-circle ml-2 c-blue"></i>
                          <?php }else{ ?>
                          <i class="fa fa-circle ml-2"></i>
                        <?php } ?>
                      </div>
                    </div>
                  </a >
                </li>
                <?php endforeach; ?>
                </ul>
              </div>
              <?php }else{
                 $n = $valid->posisi-1;
                 $sect = $valid->section-1;
                 
                 $lihat = DB::table('section')
                         ->join('video_section', 'section.id','video_section.section_id')
                         ->leftjoin('project_section', 'section.id', 'project_section.section_id')
                         ->leftjoin('project_user', function($join){
                         $join->on('project_section.id', '=', 'project_user.project_section_id')
                         ->where('project_user.member_id', '=', Auth::guard('members')->user()->id)
                         ->where('project_user.status', '2');})
                         ->leftjoin('history', function($join){
                           $join->on('video_section.id', '=', 'history.video_id')
                           ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
                         ->where('section.id', $sect)->where('section.position', $n)
                         ->select('section.id as section', DB::raw('count( DISTINCT video_section.id) + count(distinct project_section.id) as project'), DB::raw('count(DISTINCT project_user.id)+ count(distinct history.id) as hasil'))
                         ->groupby('section.id')
                         ->first();
              if($lihat->project == $lihat->hasil){ ?>
               <div class="collapse submateri" id="{{$section->id}}">
                <ul>
                <?php
                 $i = 1;
                 foreach ($section->video_section as $key => $materi): ?>
                  <li>
                    <a href="{{ url('bootcamp/'.$bc->slug.'/videoPage/'.$materi->section_id)}}"
                        data-url="{{$materi->file_video}}"
                        data-title="{{$materi->title}}"
                        data-video_id="{{$materi->id}}"
                        data-section_id="{{$materi->section_id}}"
                        onclick="changeVideo(this), saveHistory(this)"
                    >
                      <div class="sub-materi row">
                        <div class="col-xs-10 px-0">
                          <i class="fas fa-play-circle"></i><?php echo " $i."; ?> {{$materi->title}}
                        </div>
                        <div class="col-xs-2 px-0 text-right">
                            <?php 
                              echo gmdate("H:i:s", $materi->durasi);
                            ?>
                          <?php 
                          $history = DB::table('video_section')
                          ->join('history', 'video_section.id', 'history.video_id')->where('video_section.id', $materi->id)->where('history.member_id', '=', Auth::guard('members')->user()->id)->first();
                          if($history){        
                          ?>
                          <i class="fa fa-check-circle ml-2 c-blue"></i>
                          <?php }else{ ?>
                          <i class="fa fa-circle ml-2"></i>
                          <?php } ?>
                        </div>
                      </div>
                    </a>
                  </li>
                  <?php $i++;?>
                  <?php endforeach; ?>
                  <?php
                  foreach ($section->project_section as $key => $projects): ?>
                  <li>
                  <a href="{{ url('bootcamp/'.$bc->slug.'/projectSubmit/'.$section->id) }}">
                    <div class="sub-materi row">
                      <div class="col-xs-10 px-0">
                        <i class="fas fa-clipboard-list"></i>  {{$projects->title}}
                      </div>
                      <div class="col-xs-2 px-0 text-right">
                      <?php 
                          $cek = DB::table('project_section')
                                  ->join('project_user', 'project_section.id', 'project_user.project_section_id')
                                  ->where('project_section.id', $projects->id)
                                  ->where('project_user.status', 2)
                                  ->where('project_user.member_id', '=', Auth::guard('members')->user()->id)
                                  ->first();
                        
                                  if($cek){        
                          ?>
                        <i class="fa fa-check-circle ml-2 c-blue"></i>
                          <?php }else{ ?>
                          <i class="fa fa-circle ml-2"></i>
                        <?php } ?>
                      </div>
                    </div>
                  </a >
                </li>
                <?php endforeach; ?>
                </ul>
               </div>
              <?php }else{ ?>
                <a disabled class="btn btn-primary float-right disable">Terkunci</a>
              <?php } 
              }
            }?>           
              <?php $a++;?>
                  <?php endforeach; ?>
          </div>

          <!-- Tab Diskusi-->
          <div class="tab-pane fade" id="pills-diskusi" role="tabpanel" aria-labelledby="pills-diskusi-tab">
              <div class="row box m-4">
                <div class="col-xs-12">
                  <h6>Buat Pertanyaan</h6>
                  <form id="form-comment" class="mb-25" enctype="multipart/form-data" method="POST">
                        @csrf 
                        {{ method_field('POST') }}
                        <input type="hidden" name="bootcamp_id" value="{{ $bc->id }}">
                        <input type="hidden" name="parent_id" value="0"> 
                        <div class="form-group">
                          <textarea style="white-space: pre-line" rows="8" cols="80" class="form-control" name="body" id="textbody0"></textarea>
                        </div>
                       
                        <input class="inputfile" type="file" name="image" id="file" data-multiple-caption="{count} files selected" multiple="multiple"/>
                        <label for="file"><i class="fa fa-upload"></i><span>Upload File</span></label>
                       
                      <button type="button" class="btn btn-primary upload-image" onclick="doComment({{ $bc->id}}, 0)">Tambah Pertanyaan</button> 
                  </form><!--./ Comment Form -->
                </div>

                <hr class="mb-5">

                <div class="col-xs-12">
                <div id="comments-lists">
                    <p>Memuat Pertanyaan . . .</p>
                </div>
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

          <div class="project-content col-xs-12 p-0">
            <div class="header">
              <div class="col-xs-11 pl-5">
                {{$bc->title}} <br>
                <small>{{$course->title}} : Exercise {{$exercise->title}}</small>
              </div>
              <div class="col-xs-1 px-4">
                <button type="button" class="plyr__control btn btn-outline-primary px-4" onClick="sidebarShow()"><i class="fa fa-bars"></i></button>
              </div>
            </div>
            
            <div class="row px-5 pt-4">
              <div class="col-xs-12">
                <div class="progress">
                  <div id="progress-count" class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="2"></div>
                </div>
                <h5 class="text-muted" id="question-count">Pertanyaan 1/2</h5>

                <br>

                <section class="content container-fluid" id="quiz">
                  <!-- Konten Dari Javascript -->
                </section>
                
                <button class="btn btn-default" id="start">Jadian lagi</button> 
                <button class="btn btn-primary my-4" id="submit" style=  "background: rgb(0, 170, 113)">Submit dan Lihat Hasilnya</button>


                <div class="text-right">
                  <button class="btn btn-primary my-4" id="prev">Pertanyaan Sebelumnya</button>
                  <button class="btn btn-primary my-4" id="next">Pertanyaan Selanjutnya</button>
                </div>
              </div>
            </div> 
          </div>

        </div>
      </div>

    </section>




    <!-- JavaScript -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/plyr.min.js"></script>
    <!-- <script type="text/javascript" src="js/quiz.js"></script> -->
    <script>
    // JavaScript Document
    $(document).ready(function(){
      "use strict";
      
      var questions = [
      //   {
      //   question: "Carilah berapa nilai rata-rata umur dari para penonton bioskop di tahun 2019 menggunakan Python Jupyternetbook (Download di File Praktek file bioskop_dataset.csv):",
      //   choices: ['24', '28', '30', '45'],
      //   correctAnswer: 1
      // }, {
      //   question: "Yang manakah yang dibawah ini <b>BUKAN</b> termasuk pengertian dari Mean :",
      //   choices: ["Mean adalah teknik yang digunakan untuk mencari nilai rata-rata dari serangkaian data.", "Mean = nilai2 dari sekumpulan data/banyaknya data", "Mean bertujuan untuk mencari nilai terbanyak yang muncul dari serangkaian data.", "Mean = nilaidarisekumpulandata.mean()"],
      //   correctAnswer: 1
      // }
      ];
      $.ajaxSetup({ 
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: '{{ url("/questions/".$exercise->id) }}',
        method: 'GET',
        dataType: 'JSON',
        success: function(result){
          console.log(result);
          console.log(typeof result);
          questions = result;
      
          // Display initial question
          displayNext();
        },
        error: function(data) {
            console.log("data: " + JSON.stringify(data));
        }
      });
      
      var questionCounter = 0; //Tracks question number
      var selections = []; //Array containing user choices
      var quiz = $('.content'); //Quiz div object
      
      // Click handler for the 'next' button
      $('#next').on('click', function (e) {
        e.preventDefault();
        
        // Suspend click listener during fade animation
        if(quiz.is(':animated')) {        
          return false;
        }
        choose();
        
        // If no user selection, progress is stopped
        if (isNaN(selections[questionCounter])) {
          $('#warning').text('Pilih salah satu jawaban!');
        } else {
          questionCounter++;
          displayNext();
          $('#warning').text('');
        }
      });
      
      // Click handler for the 'prev' button
      $('#prev').on('click', function (e) {
        e.preventDefault();
        
        if(quiz.is(':animated')) {
          return false;
        }
        choose();
        questionCounter--;
        displayNext();
      });
      
      // Click handler for the 'Start Over' button
      $('#start').on('click', function (e) {
        e.preventDefault();
        
        if(quiz.is(':animated')) {
          return false;
        }
        questionCounter = 0;
        selections = [];
        displayNext();
        $('#next').removeAttr('disabled');
        $('#start').hide();
      });
      
      // Creates and returns the div that contains the questions and 
      // the answer selections
      function createQuestionElement(index) {
        var qElement = $('<div>', {
          id: 'question'
        });
        $('#progress-count').css("width", 100 / ( questions.length / (index+1) )+"%")
        $('#question-count').text("Pertanyaan "+(index+1)+"/"+questions.length)
        // var header = $('<h2>Question ' + (index + 1) + ':</h2>');
        // qElement.append(header);
        
        var question = $('<p>').append(questions[index].question);
        qElement.append(question);
        
        var radioButtons = createRadios(index);
        qElement.append(radioButtons);

        // this is new
        var warningText = $('<p id="warning">');
        qElement.append(warningText);
        
        return qElement;

      }
      
      // Creates a list of the answer choices as radio inputs
      function createRadios(index) {
        var radioList = $('<ul>');
        var item;
        var input = '';
        for (var i = 0; i < questions[index].choices.length; i++) {
          item = $('<li>');
          input = '<input type="radio" name="answer" value=' + i + ' id="question-'+i+'"  />';
          input += '<label for="question-'+i+'">'+questions[index].choices[i]+'</label>';
          item.append(input);
          radioList.append(item);
        }
        return radioList;
      }
      
      // Reads the user selection and pushes the value to an array
      function choose() {
        selections[questionCounter] = +$('input[name="answer"]:checked').val();
      }
      function sendAnswer(){
        $.ajaxSetup({ 
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: '{{ url("/questions/".$exercise->id) }}',
          method: 'POST',
          dataType: 'JSON',
          success: function(result){
            console.log(result);
            console.log(typeof result);
            questions = result;
            console.log(choose());
          },
          error: function(data) {
              console.log("data: " + JSON.stringify(data));
          }
        });
      }
      
      // Displays next requested element
      function displayNext() {
        // alert(questions.length);
        quiz.fadeOut(function() {
          $('#question').remove();
          
          if(questionCounter <= questions.length){
            var nextQuestion = createQuestionElement(questionCounter);
            quiz.append(nextQuestion).fadeIn();
            if (!(isNaN(selections[questionCounter]))) {
              $('input[value='+selections[questionCounter]+']').prop('checked', true);
            }
            $('#next').removeAttr('disabled');
            
            // Controls display of 'prev' button
            if (questionCounter == questions.length-1){
              $('#submit').show();
              $('#next').attr('disabled','disabled');
              $('#prev').removeAttr('disabled');
            }else if(questionCounter === 1){
              $('#submit').hide();
              $('#prev').removeAttr('disabled');
              $('#next').removeAttr('disabled');
            } else if(questionCounter === 0){
              $('#submit').hide();
              $('#prev').attr('disabled','disabled');
              $('#next').show();
            }
          }
        });
      }

    $("#submit").click(function(){
      choose();
      // If no user selection, progress is stopped
      if (isNaN(selections[questionCounter])) {
        $('#warning').text('Pilih salah satu jawaban!');
      } else {
        /* Show Score 
        $('#question').remove();
        var scoreElem = displayScore();
        quiz.append(scoreElem).fadeIn();
        $('#start').show();
        $(this).hide();
        $('#next').hide();
        $('#prev').hide();
        */

      $.ajaxSetup({ 
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: '{{ url("/questions/".$exercise->id) }}',
        method: 'POST',
        dataType: 'JSON',
        success: function(result){
          console.log(result);
          console.log(typeof result);
          questions = result;
      
          // Display initial question
          displayNext();
        },
        error: function(data) {
            console.log("data: " + JSON.stringify(data));
        }
      });

        // Redirect 
        window.location.href = "review"
      }
    })
      
      // Computes score and returns a paragraph element to be displayed
      function displayScore() {
        var text;
        var score = $('<h3>',{id: 'question'});
        var ques = $('<p>');
        
        text= "";
        var numCorrect = 0;
        for (var i = 0; i < selections.length; i++) {
          if (selections[i] === questions[i].correctAnswer) {
            numCorrect++;
            text += "Betul "+i+"\n";
          }else{
            text += "Salah "+i+"\n";
          }
        }
        
        console.log(text);
        // Calculate score and display relevant message
        var percentage = numCorrect / questions.length;
        if (percentage >= 0.9){
            score.append(numCorrect + ' / ' + questions.length + ' Pertanyaan Benar');
        }
        
        else if (percentage >= 0.5){
            score.append(numCorrect + ' / ' + questions.length + ' Pertanyaan Salah');
        }

        else {
            score.append(numCorrect + ' / ' + questions.length + ' Pertanyaan Salah');
        }

        return score;
      }
    });
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
    
    <script>
    $(function(){
          $('#footer').addClass('hide')
          
        });
    </script>
@endsection()