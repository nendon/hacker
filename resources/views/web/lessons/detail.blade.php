@extends('web.app')
@section('title', $lessons->title)
@section('description', $lessons->description)
@section('content')
{{--  <link href="{{ asset('node_modules/video.js/dist/video-js.css') }}" rel="stylesheet">  --}}
<link href="{{ asset('template/web/css/videojs-playlist-ui.vertical.css') }}" rel="stylesheet">
<link href="{{ asset('template/web/css/videojs-errors.css') }}" rel="stylesheet">
<link href="{{ asset('template/web/css/videojs-brand.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>
{{-- <link href="https://vjs.zencdn.net/5.16.0/video-js.min.css" rel="stylesheet"/> --}}
<script src="https://vjs.zencdn.net/5.16.0/video.min.js"></script>
<script src="https://rawgit.com/atlance01/vrapp-ionic/master/www/js/lib/videojs-playlist.js"></script>
<style>
  body {
    /*font-family: Arial, sans-serif;*/
  }

  #cat-images {
   background-color: #fff !important;
  }

  .info {
    background-color: #eee;
    border: thin solid #333;
    border-radius: 3px;
    margin: 0 0 20px;
    padding: 0 5px;
  }

  /*
    We include some minimal custom CSS to make the playlist UI look good
    in this context.
  */
  .player-container {
    background: #1a1a1a;
    overflow: auto;
    width: 100%;
  }

  .video-js {
    float: left;
  }

  .vjs-playlist {
    float: left;
    width: 100%;
    height: 500px;
  }
  @media (min-width:768px) {
    .vjs-playlist {
        width:35%;
        
    }
  }
  .vjs-mouse.vjs-playlist cite{
    font-size: 13px;
  }
  .vjs-mouse.vjs-playlist .vjs-playlist-description{
    font-size: 13px;
  }
  .vjs-playlist .vjs-playlist-thumbnail{
    background: transparent;
  }
  .vjs-mouse.vjs-playlist .vjs-playlist-item{
    height: 69px;
  }
  .tablist {
  position: relative;
  margin: 0;
  padding: 0;
  list-style: none;
  display: table;
  width: 100%;
  }

.tab {
  position: relative;
  background-color: #ededed;
  display: table-cell;
  margin-right: -4px;
  /*text-transform: uppercase;*/
  text-align: center;
  transform: background-color 1s;
  border-left: solid 1px #ddd;
  border-top: solid 1px #ddd;
}

.tab:last-child {
  border-right: solid 1px #ddd;
}

.tab a {
  position: relative;
  display: block;
  padding: 15px 20px;
  color: #666;
  text-decoration: none;
  z-index: 1;
}

/*.tab:after {
  content: '';
  position: absolute;
  top: 100%;
  left: -1px;
  right: -1px;
  bottom: -1px;
  background: #fff;
  border-top: solid 5px transparent;
  transition: top .2s;
}*/

.tab-active a {
  border-bottom: 2px solid #09121a;
}

/*.tab-active:after {
  top: -1px;
}

.tab-active:first-child:after {
  border-top-color: #ff5e10;
}

.tab-active:nth-child(2):after {
   border-top-color: #00ceee;
}

.tab-active:nth-child(3):after {
   border-top-color: #ffd600;
}*/

.tabpanel {
  display: none;
  padding: 20px;
  background: #f5f5f5;
}

.tabpanel.show {
  display: block;
}

.tabpanel h1 {
  margin: 0 0 .3em;
}

.tabpanel p {
  margin: 0 0 1.5em;
}

#panel1 h1 {
  color: #ff5e10;
}

#panel2 h1 {
  color: #00ceee;
}

#panel3 h1 {
  color: #ffd600;
}

.tab-menu {
  display: none;
}

@media (max-width: 600px) {
  .tab {
    display: block;
    display: none;
    margin: 0;
    border: none;
  }

  .tab:after {
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }

  .tab-active {
    display: block;
    top: 0;
  }

  .tab a {
    border-bottom: solid 1px #ddd;
  }

  .tab-menu {
    display: block;
    position: absolute;
    top: 50%;
    right: 10px;
    margin-top: -12px;
    width: 24px;
    height: 22px;
  }

  .tab-menu .line {
    height: 4px;
    background-color: #333;
    border-radius: 2px;
    margin-bottom: 4px;
  }
}

/* Page style */

*,
*:after,
*:before {
  box-sizing: border-box;
}

.description-mobile .panel-default>.panel-heading{
  background-color: #fff;
}
.description-mobile .panel-title>.small, .description-mobile .panel-title>.small>a, .description-mobile .panel-title>a, .description-mobile .panel-title>small, .description-mobile .panel-title>small>a{
  display: block;
  text-decoration: none;
}

.materi_list{
  padding:0px;
  list-style: none;
}

.materi_list li{
  border-bottom: 1px solid #eee;
  padding: 15px 0px 0px 0px;
}
.materi_list li:last-of-type{

  border-bottom: none;

}
.video-js .vjs-menu-button-inline.vjs-slider-active,.video-js .vjs-menu-button-inline:focus,.video-js .vjs-menu-button-inline:hover,.video-js.vjs-no-flex .vjs-menu-button-inline {
    width: 10em
}

.video-js .vjs-controls-disabled .vjs-big-play-button {
    display: none!important
}

.video-js .vjs-control {
    width: 3em
}

.video-js .vjs-menu-button-inline:before {
    width: 1.5em
}

.vjs-menu-button-inline .vjs-menu {
    left: 3em
}

.vjs-paused.vjs-has-started.video-js .vjs-big-play-button,.video-js.vjs-ended .vjs-big-play-button,.video-js.vjs-paused .vjs-big-play-button {
    display: block
}

.video-js .vjs-load-progress div,.vjs-seeking .vjs-big-play-button,.vjs-waiting .vjs-big-play-button {
    display: none!important
}

.video-js .vjs-mouse-display:after,.video-js .vjs-play-progress:after {
    padding: 0 .4em .3em
}

.video-js.vjs-ended .vjs-loading-spinner {
    display: none;
}

.video-js.vjs-ended .vjs-big-play-button {
    display: block !important;
}

.video-js *,.video-js:after,.video-js:before {
    box-sizing: inherit;
    font-size: inherit;
    color: inherit;
    line-height: inherit
}

.video-js.vjs-fullscreen,.video-js.vjs-fullscreen .vjs-tech {
    width: 100%!important;
    height: 100%!important
    
}

.video-js {
    font-size: 14px;
    overflow: hidden
}

.video-js .vjs-control {
    color: inherit
    
}

.video-js .vjs-menu-button-inline:hover,.video-js.vjs-no-flex .vjs-menu-button-inline {
    width: 8.35em
}

.video-js .vjs-volume-menu-button.vjs-volume-menu-button-horizontal:hover .vjs-menu .vjs-menu-content {
    height: 3em;
    width: 6.35em
}

.video-js .vjs-control:focus:before,.video-js .vjs-control:hover:before {
    text-shadow: 0 0 1em #fff,0 0 1em #fff,0 0 1em #fff
}

.video-js .vjs-spacer,.video-js .vjs-time-control {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-flex: 1 1 auto;
    -moz-box-flex: 1 1 auto;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto
}

.video-js .vjs-time-control {
    -webkit-box-flex: 0 1 auto;
    -moz-box-flex: 0 1 auto;
    -webkit-flex: 0 1 auto;
    -ms-flex: 0 1 auto;
    flex: 0 1 auto;
    width: auto
}

.video-js .vjs-time-control.vjs-time-divider {
    width: 14px
}

.video-js .vjs-time-control.vjs-time-divider div {
    width: 100%;
    text-align: center
}

.video-js .vjs-time-control.vjs-current-time {
    margin-left: 1em
}

.video-js .vjs-time-control .vjs-current-time-display,.video-js .vjs-time-control .vjs-duration-display {
    width: 100%
}

.video-js .vjs-time-control .vjs-current-time-display {
    text-align: right
}

.video-js .vjs-time-control .vjs-duration-display {
    text-align: left
}

.video-js .vjs-play-progress:before,.video-js .vjs-progress-control .vjs-play-progress:before,.video-js .vjs-remaining-time,.video-js .vjs-volume-level:after,.video-js .vjs-volume-level:before,.video-js.vjs-live .vjs-time-control.vjs-current-time,.video-js.vjs-live .vjs-time-control.vjs-duration,.video-js.vjs-live .vjs-time-control.vjs-time-divider,.video-js.vjs-no-flex .vjs-time-control.vjs-remaining-time {
    display: none
}

.video-js.vjs-no-flex .vjs-time-control {
    display: table-cell;
    width: 4em
}

.video-js .vjs-progress-control {
    position: absolute;
    left: 0;
    right: 0;
    width: 100%;
    height: .5em;
    top: -.5em
}

.video-js .vjs-progress-control .vjs-load-progress,.video-js .vjs-progress-control .vjs-play-progress,.video-js .vjs-progress-control .vjs-progress-holder {
    height: 100%
}

.video-js .vjs-progress-control .vjs-progress-holder {
    margin: 0
}

.video-js .vjs-progress-control:hover {
    height: 1.5em;
    top: -1.5em
}

.video-js .vjs-control-bar {
    -webkit-transition: -webkit-transform .1s ease 0s;
    -moz-transition: -moz-transform .1s ease 0s;
    -ms-transition: -ms-transform .1s ease 0s;
    -o-transition: -o-transform .1s ease 0s;
    transition: transform .1s ease 0s
}

.video-js.not-hover.vjs-has-started.vjs-paused.vjs-user-active .vjs-control-bar,.video-js.not-hover.vjs-has-started.vjs-paused.vjs-user-inactive .vjs-control-bar,.video-js.not-hover.vjs-has-started.vjs-playing.vjs-user-active .vjs-control-bar,.video-js.not-hover.vjs-has-started.vjs-playing.vjs-user-inactive .vjs-control-bar,.video-js.vjs-has-started.vjs-playing.vjs-user-inactive .vjs-control-bar {
    visibility: visible;
    opacity: 1;
    -webkit-backface-visibility: hidden;
    -webkit-transform: translateY(3em);
    -moz-transform: translateY(3em);
    -ms-transform: translateY(3em);
    -o-transform: translateY(3em);
    transform: translateY(3em);
    -webkit-transition: -webkit-transform 1s ease 0s;
    -moz-transition: -moz-transform 1s ease 0s;
    -ms-transition: -ms-transform 1s ease 0s;
    -o-transition: -o-transform 1s ease 0s;
    transition: transform 1s ease 0s
}

.video-js.not-hover.vjs-has-started.vjs-paused.vjs-user-active .vjs-progress-control,.video-js.not-hover.vjs-has-started.vjs-paused.vjs-user-inactive .vjs-progress-control,.video-js.not-hover.vjs-has-started.vjs-playing.vjs-user-active .vjs-progress-control,.video-js.not-hover.vjs-has-started.vjs-playing.vjs-user-inactive .vjs-progress-control,.video-js.vjs-has-started.vjs-playing.vjs-user-inactive .vjs-progress-control {
    height: .25em;
    top: -.25em;
    pointer-events: none;
    -webkit-transition: height 1s,top 1s;
    -moz-transition: height 1s,top 1s;
    -ms-transition: height 1s,top 1s;
    -o-transition: height 1s,top 1s;
    transition: height 1s,top 1s
}

.video-js.not-hover.vjs-has-started.vjs-paused.vjs-user-active.vjs-fullscreen .vjs-progress-control,.video-js.not-hover.vjs-has-started.vjs-paused.vjs-user-inactive.vjs-fullscreen .vjs-progress-control,.video-js.not-hover.vjs-has-started.vjs-playing.vjs-user-active.vjs-fullscreen .vjs-progress-control,.video-js.not-hover.vjs-has-started.vjs-playing.vjs-user-inactive.vjs-fullscreen .vjs-progress-control,.video-js.vjs-has-started.vjs-playing.vjs-user-inactive.vjs-fullscreen .vjs-progress-control {
    opacity: 0;
    -webkit-transition: opacity 1s ease 1s;
    -moz-transition: opacity 1s ease 1s;
    -ms-transition: opacity 1s ease 1s;
    -o-transition: opacity 1s ease 1s;
    transition: opacity 1s ease 1s
}

.video-js.vjs-live .vjs-live-control {
    margin-left: 1em
}

.video-js .vjs-big-play-button {
    top: 50%;
    left: 50%;
    margin-left: -1em;
    margin-top: -1em;
    width: 2em;
    height: 2em;
    line-height: 2em;
    border: none;
    border-radius: 50%;
    font-size: 3.5em;
    background-color: rgba(0,0,0,.45);
    color: #fff;
    -webkit-transition: border-color .4s,outline .4s,background-color .4s;
    -moz-transition: border-color .4s,outline .4s,background-color .4s;
    -ms-transition: border-color .4s,outline .4s,background-color .4s;
    -o-transition: border-color .4s,outline .4s,background-color .4s;
    transition: border-color .4s,outline .4s,background-color .4s
}

.video-js .vjs-menu-button-popup .vjs-menu {
    left: -3em
}

.video-js .vjs-menu-button-popup .vjs-menu .vjs-menu-content {
    background-color: transparent;
    width: 12em;
    left: -1.5em;
    padding-bottom: .5em
}

.video-js .vjs-menu-button-popup .vjs-menu .vjs-menu-item,.video-js .vjs-menu-button-popup .vjs-menu .vjs-menu-title {
    background-color: #151b17;
    margin: .3em 0;
    padding: .5em;
    border-radius: .3em
}

.video-js .vjs-menu-button-popup .vjs-menu .vjs-menu-item.vjs-selected {
    background-color: #2483d5
}

.video-js .vjs-big-play-button {
    background-color: rgba(14,34,61,0.7);
    font-size: 3.5em;
    border-radius: 12%;
    height: 1.4em !important;
    line-height: 1.4em !important;
    margin-top: -0.7em !important
}

.video-js:hover .vjs-big-play-button,.video-js .vjs-big-play-button:focus,.video-js .vjs-big-play-button:active {
    background-color: #0e223d
}

.video-js .vjs-loading-spinner {
    border-color: rgba(14,34,61,0.84)
}

.video-js .vjs-control-bar2 {
    background-color: #0e223d
}

.video-js .vjs-control-bar {
    background-color: #0e223d !important;
    color: #ffffff;
    font-size: 14px
}

.video-js .vjs-play-progress,.video-js  .vjs-volume-level {
    background-color: rgba(14,34,61,0.8)
}
.video-holder,
.video-holder * {
  box-sizing: border-box !important
}

.video-holder {
  background: #1b1b1b;
  padding: 10px
}

.centered {
  width: 100%
}

#video {
  border-radius: 8px
}

.video-holder .vjs-big-play-button {
  left: 50%;
  width: 100px;
  margin-left: -50px;
  height: 80px;
  top: 50%;
  margin-top: -40px
}


/* CUSTOM BUTTONS */
[class^="icon-"]:before,
[class*=" icon-"]:before {
  font-family: FontAwesome;
  font-weight: normal;
  font-style: normal;
  display: inline-block;
  text-decoration: inherit;
}
.icon-angle-left:before {
    content: "\f048";
}
.icon-angle-right:before {
    content: "\f051";
}

.video-js .icon-angle-right, .video-js .icon-angle-left {
    cursor: pointer;
    -webkit-box-flex: none;
    -moz-box-flex: none;
    -webkit-flex: none;
    -ms-flex: none;
    flex: none;
}
.vjs-fade-out {
  display: block;
  visibility: hidden;
  opacity: 0;

  -webkit-transition: visibility 1.5s, opacity 1.5s;
     -moz-transition: visibility 1.5s, opacity 1.5s;
      -ms-transition: visibility 1.5s, opacity 1.5s;
       -o-transition: visibility 1.5s, opacity 1.5s;
          transition: visibility 1.5s, opacity 1.5s;

  /* Wait a moment before fading out the control bar */
  -webkit-transition-delay: 2s;
     -moz-transition-delay: 2s;
      -ms-transition-delay: 2s;
       -o-transition-delay: 2s;
          transition-delay: 2s;
}
.vjs-default-skin.vjs-user-inactive .vjs-control-bar {
  display: block;
  visibility: hidden;
  opacity: 0;

  -webkit-transition: visibility 1.5s, opacity 1.5s;
     -moz-transition: visibility 1.5s, opacity 1.5s;
      -ms-transition: visibility 1.5s, opacity 1.5s;
       -o-transition: visibility 1.5s, opacity 1.5s;
          transition: visibility 1.5s, opacity 1.5s;
}
.vjs-fullscreen.vjs-user-inactive {
  cursor: none;
}
table{
  width: 100%;
}
td{
  padding:5px;
}
@media screen and (max-width: 600px) {
	table td {
		display: block;
		text-align: justify;
	}
	table td:before {
		content: attr(data-label);
		float: left;
		font-weight: bold;
		text-transform: uppercase;
	}
  .vjs-playlist {
        width:100%;
        height:270px;
    }
}
.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

.btn-upload{
  border: 2px solid gray;
  color: gray;
  background-color: white;
  padding: 8px 20px;
  height:50px;
  border-radius: 5px;
  font-weight: bold;
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
}
.fileUpload {
	position: relative;
	overflow: hidden;
	margin: 10px;
	background-color: #BDBDBD;
	height: 50px;
	width: 50px;
	text-align: center;
}
.fileUpload input.upload {
	position: absolute;
	top: 0;
	right: 0;
	margin: 0;
	padding: 0;
	font-size: 6px;
	cursor: pointer;
	opacity: 0;
	filter: alpha(opacity=0);
	height: 100%;
	text-align: center;
}
.custom-span{ font-family: Arial; font-weight: bold;font-size: 25px; color: #FE57A1}
#uploadFile{border: none;margin-left: 10px; width: 50px;}
.custom-para{font-family: arial;font-weight: bold;font-size: 6px; color:#585858;}
.content {
  background: #fff;
  border-radius: 3px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.075), 0 2px 4px rgba(0, 0, 0, 0.0375);
  padding: 30px 30px 20px;
}
.inputfile {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}
.inputfile + label {
  background-color: #2BA8E2;
  border-radius: 3px;
  color: white;
  cursor: pointer;
  display: inline-block;
  font-size: 1em;
  padding: 10px 15px;
}
.inputfile + label span {
  padding-left: 10px;
}
.inputfile:focus + label, .content .inputfile + label:hover {
  background-color: #5f36b3;
}

.inputfile-2 {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}
.inputfile-2 + label {
  background-color: #2BA8E2;
  border-radius: 3px;
  color: white;
  cursor: pointer;
  display: inline-block;
  font-size: 1em;
  padding: 10px 15px;
}
.inputfile-2 + label span {
  padding-left: 10px;
}
.inputfile-2:focus + label, .content .inputfile-2 + label:hover {
  background-color: #5f36b3;
}
.video-wrapper{
  position :relative;
}
.video-wrapper:before{
  content: "";
  position: absolute;
  background: url('https://www.cilsy.id/template/web/img/logo.png');
  width: 44px;
  height:30px;
  right:20px;
  bottom:20px;

}
</style>
<div id="content-section">

  <div id="cat-images"> 
    <div class="container">


      <section class="video-player mb-50">
      <div class="container">
        <!-- Title -->
        <div class="row pt-25 pb-15"> 
          <div class="col-xs-12 col-md-10">
            <p class="lesson-title">{{ $lessons->title }}</p>
            <p><img src="{{asset('template/web/img/video.png')}}" alt="" style="height:25px; width:25px;"> <b>{{ count($main_videos) }}</b> Video</p>
          </div>
          <div class="col-xs-12 col-md-2">
          <ul style="right">
          @if($tutor == null)
              @if(count($invo) != 0)
                @if($invo->status == '2')
                <div class="lesson-video-count">Rp{{ number_format($lessons->price, 0, ",", ".") }}</div>
                <button type="button" class="btn disabled" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; display:none;" >Menunggu Pembayaran</button>
                @else
                <div class="lesson-video-count">Rp{{ number_format($lessons->price, 0, ",", ".") }}</div>
                <button type="button" class="lesson-video-count" onclick="addToCart({{ $lessons->id }})"><i class="fa fa-shopping-cart"></i> Beli</button>
                @endif
              @else
              <div class="lesson-video-count">Rp{{ number_format($lessons->price, 0, ",", ".") }}</div>
              <button type="button" class="lesson-video-count" onclick="addToCart({{ $lessons->id }})"><i class="fa fa-shopping-cart"></i> Beli</button>
              @endif
            @endif
          </div>
        </div><!--./ Title -->

        <!-- Video -->
        <div class="row">
          <div class="col-md-12">
            <div class="player-container">
              <!-- Main Video -->
              <div class="video-wrapper">
                  <video id="video" class="video-js vjs-default-skin vjs-big-play-centered" height="500" width="70%">
                      @if (count($last_videos) > 0) 
                          <source src="{{ !empty($last_videos->video) ? $last_videos->video : '' }}" type="{{ (!empty($last_videos->type_video)) ? $last_videos->type_video : '' }}">
                      @endif 
                    </video>
              </div>
              

              <!-- Playlist Video -->
              <div class="vjs-playlist"></div>
              <button class="previous" hidden>Previous</button>
              <button class="next" hidden>Next</button>
              <button class="jump" hidden>Play Third</button>
              
            </div>
          </div>
        </div><!--./ Video -->
      </div>
    </section><!-- ./VIDEO PLAYER -->
      <section class="video-information mb-50">
        <div class="container">
          <div class="row video mb-25">
            <div class="col-md-12">
              <!-- Tabs -->
              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab1">Deskripsi Tutorial</a></li>
                <li><a data-toggle="tab" href="#tab2">Daftar Materi</a></li>
                <li><a data-toggle="tab" href="#tab3">Berkas Praktek</a></li>
                <li><a data-toggle="tab" href="#tab4">Diskusi</a></li>
              </ul>

              <div class="tab-content" style="margin-top:0px;">
                <div id="tab1" class="tab-pane fade in active">
                  {!! nl2br($lessons->description) !!}
                </div>
                <div id="tab2" class="tab-pane fade">
                  <?php $number=1 ?>
                  <ul class="materi_list">
                    @foreach ($main_videos as $row)
                    <li>
                    <table> 
                        <tr>
                          <td><strong><?php echo $number ?> {{ $row->title }}</strong>
                              <p>{!! nl2br($row->description) !!}</p>
                          </td>
                          <td>
                          @if ($tutor)
                          <span class="pull-right"><a href="{{ $row->video }}" class="btn btn-info btn-md" download><i class="fa fa-download"></i> Download Video</a></span>
                          @endif
                          </td>
                        </tr>
                    </table>
                    </li>
                    <?php $number++; ?>
                    @endforeach
                  </ul>
                </div>
                <div id="tab3" class="tab-pane fade">
                  @if ($tutor)
                      @foreach($file as $key => $files)
                          <a href="{{ $files->source }}" class="btn btn-info btn-md" download><i class="fa fa-download"></i> Download {{ $files->title}}</a><br><br>
                      @endforeach
                  @else
                      <button type="button" name="button"  class="btn btn-info btn-md disabled"><i class="fa fa-download"></i> Download </button>
                  @endif
                </div>
                <div id="tab4" class="tab-pane fade">

                  @if (empty(Auth::guard('members')->user()->id))
                    <div class="text-center mb-25">
                      Silahkan <a href="{{ url('member/signin') }}" class="btn btn-primary"> Masuk</a> untuk memberikan pertanyaan
                    </div>
                  @else
                    @if (empty($tutor))
                     <div class="text-center mb-25">
                      Fitur Diskusi hanya bisa di gunakan jika sudah melakukan pembelian
                    </div>
                    @else
                    <!-- Comment Form -->
                    <div class="comments-form mb-25">
                     <form id="form-comment" class="mb-25" enctype="multipart/form-data" method="POST">
                        @csrf
                        {{ method_field('POST') }}
                        <input type="hidden" name="lesson_id" value="{{ $lessons->id }}">
                        <input type="hidden" name="parent_id" value="0"> 
                        <div class="form-group">
                          <label>Buat Pertanyaan</label>
                          <textarea style="white-space: pre-line" rows="8" cols="80" class="form-control" name="body" id="textbody0"></textarea>
                        </div>
                       
                        <input class="inputfile" type="file" name="image" id="file" data-multiple-caption="{count} files selected" multiple="multiple"/>
                        <label for="file"><i class="fa fa-upload"></i><span>Upload File</span></label>
                       
                      <button type="button" class="btn btn-primary upload-image" onclick="doComment({{ $lessons->id}}, 0)">Tambah Pertanyaan</button> 
                      
                      </form><!--./ Comment Form -->
                    </div>
                    @endif

                  @endif
        
                  <!-- Comments Lists -->
                  <div id="comments-lists">
                    <p>Memuat Pertanyaan . . .</p>
                  </div>
                  <!--./ Comments Lists -->



                </div>
              </div><!--./ Tabs -->

            </div>
          </div>
          @if ($contributors)

          <div class="row contributor mb-25">
            <div class="col-md-12">
              <!-- Panel -->
              <div class="panel panel-default">
                <div class="panel-heading">Kontributor</div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-3">
                      @if ($contributors->avatar)
                        <img src="{{ asset($contributors->avatar) }}" alt="" class="img-responsive img-center">
                      @else
                        <img src="{{ asset($contributors->slug) }}" alt="" class="img-responsive img-center">
                      @endif
                      <div class="text-center mt-15">
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary">{{ count($contributors_total_lessons) }} Tutorial</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <strong>{{ $contributors->username }}</strong>
                      <p class="help-block">{{ $contributors->pekerjaan }}</p>
                      <a href="{{ url('contributor/profile/'.$contributors->username) }}" class="btn btn-warning mb-15">Lihat Profile</a>
                      <div class="about-text">
                        {{ $contributors->deskripsi }}
                      </div>
                      <a href="#">Lebih Banyak</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ./Panel -->
            </div>
          </div>

          @endif
        </div>
      </section><!-- ./VIDEO INFORMATION -->

    </div>

</div>
<script src="{{ asset('template/web/js/video.js') }}"></script>
<script src="{{ asset('template/web/js/videojs-playlist.js') }}"></script>
<script src="{{ asset('template/web/js/videojs-playlist-ui.js') }}"></script>
<script src="{{ asset('template/web/js/videojs-errors.js') }}"></script>
<script src="{{ asset('template/web/js/videojs-brand.min.js') }}"></script>
<script type="text/javascript" src="https://unpkg.com/sweetalert2@7.9.2/dist/sweetalert2.all.js"></script>
<script src="{{ asset('template/web/js/component.js') }}"></script>
<script src="{{ asset('template/web/js/control-bar/control-bar.js') }}"></script>
<script>
  $(function () {
    $(":file").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
});

function imageIsLoaded(e) {
    $('#myImg').attr('src', e.target.result);
};
</script>


<script>
  $(function () {
    $(":file").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageLoaded;
            reader.readAsDataURL(this.files[0]);
        } 
    });
});

function imageLoaded(e) {
    $('#Img').attr('src', e.target.result);
};
</script>
<script>            
$(document).ready(function(){
    $('.venobox').venobox(); 
    $('#video_html5_api').ready(function(){
      setTimeout(function(){
        $('#video_html5_api').attr('src',$('#video_html5_api>source').attr('src'))
        setTimeout(function(){document.querySelector('.vjs-playlist').scrollTo(0,document.querySelector('.vjs-playlist-now-playing').getBoundingClientRect().y)},1000)
        },5000)
    });
});
</script>

<script type="text/javascript">
    function formbalas(comment_id){

        $('#balas'+comment_id).html('<label class="col-md-1" style="padding-left:0px;">Anda</label>'+
                                '<div class="col-md-11" style="padding-right:0px;">'+
                                '   <input type="text" class="form-control" id="input_balas'+comment_id+'" name="balasan" placeholder="tambahkan komentar/balasan" value="">'+
                                '</div>'+
                                '<a href="javascript:void(0)" class="btn btn-info pull-right" onclick="dobalas('+comment_id+')" style="float:right;margin-top:10px;">Kirim</a>');
    }

    function dobalas(comment_id){
        var isi_balas = $('#input_balas'+comment_id).val();
        var lesson_id = '{{ $lessons->id }}';
        // alert(comment_id+' = '+isi_balas);
        var datapost = {
            '_token'    : '{{ csrf_token() }}',
            'isi_balas' : isi_balas,
            'comment_id': comment_id,
            'lesson_id' : lesson_id
        }

        $.ajax({
            type    :'POST',
            url     :'{{ url("lessons/coments/postcomment") }}',
            data    :datapost,
            success:function(data){
                if (data == 1) {
                    $("#row"+comment_id).load(window.location.href + " #row"+comment_id);
                }
                else if(data==0){
                        window.location.href = '{{url("member/signin")}}';
                }else {
                    alert('Koneksi Bermasalah, Silahkan Ulangi');
                    location.reload();
                }
            }
        })
    }

    function loadcontent(){
        $(".content-reload").load(window.location.href + " .content-reload");
        console.log('reload');
    }

    // setInterval(function(){
    //     loadcontent()
    // }, 5000);
</script>
<script type="text/javascript">

$(document).ready(function() {
  getPlayList();
});

function getPlayList() {

  var lessons_id = "{{ $lessons->id }}";
  var postData =
              {
                  "_token":"{{ csrf_token() }}",
                  "lessons_id": lessons_id
              }
  var player = videojs(document.querySelector('video'), {
      inactivityTimeout: 500,
      controls: true,
    });

    {{--  player.brand({
      image: "https://www.cilsy.id/template/web/img/logo.png",
      title: "Logo Title",
      destination: "http://www.google.com",
      destinationTarget: "_top"
    });  --}}

  player.on('ended', function() {
    var videosrc = player.currentSrc();
    videoTracking(videosrc);
  //  lessonsQuiz(videosrc);
  });

    activityCheck = setInterval(function() {

      // Check to see if the mouse has been moved
      if (userActivity) {

        // Reset the activity tracker
        userActivity = false;

        // If the user state was inactive, set the state to active
        if (player.userActive() === false) {
          player.userActive(true);
        }

        // Clear any existing inactivity timeout to start the timer over
        clearTimeout(inactivityTimeout);

        // In X seconds, if no more activity has occurred 
        // the user will be considered inactive
        inactivityTimeout = setTimeout(function() {
          // Protect against the case where the inactivity timeout can trigger
          // before the next user activity is picked up  by the 
          // activityCheck loop.
          if (!userActivity) {
            this.userActive(false);
          }
        }, 500);
      }
    }, 250);
    try {
      // try on ios
      player.volume(1);
      // player.play();
    } catch (e) {}
    //player.playlist(videoList, 4);/// play video 5
    player.playlist(postData);
    document.querySelector('.previous').addEventListener('click', function() {
      player.playlist.previous();
    });
    document.querySelector('.next').addEventListener('click', function() {
      player.playlist.next();
    });
    document.querySelector('.jump').addEventListener('click', function() {
      player.playlist.currentItem(2); // play third
    });

    player.playlist.autoadvance(0); // play all

    Array.prototype.forEach.call(document.querySelectorAll('[name=autoadvance]'), function(el) {
      el.addEventListener('click', function() {
        var value = document.querySelector('[name=autoadvance]:checked').value;
        //alert(value);
        player.playlist.autoadvance(JSON.parse(value));
      });
    });
    
    /* ADD PREVIOUS */
    var Button = videojs.getComponent('Button');

    // Extend default
    var PrevButton = videojs.extend(Button, {
      //constructor: function(player, options) {
      constructor: function() {
        Button.apply(this, arguments);
        //this.addClass('vjs-chapters-button');
        this.addClass('icon-angle-left');
        this.controlText("Previous");
      },

      // constructor: function() {
      //   Button.apply(this, arguments);
      //   this.addClass('vjs-play-control vjs-control vjs-button vjs-paused');
      // },

      // createEl: function() {
      //   return Button.prototype.createEl('button', {
      //     //className: 'vjs-next-button vjs-control vjs-button',
      //     //innerHTML: 'Next >'
      //   });
      // },

      handleClick: function() {
        console.log('click');
        player.playlist.previous();
      }
    });

    /* ADD BUTTON */
    //var Button = videojs.getComponent('Button');

    // Extend default
    var NextButton = videojs.extend(Button, {
      //constructor: function(player, options) {
      constructor: function() {
        Button.apply(this, arguments);
        //this.addClass('vjs-chapters-button');
        this.addClass('icon-angle-right');
        this.controlText("Next");
      },

      handleClick: function() {
        console.log('click');
        player.playlist.next();
      }
    });

    // Register the new component
    videojs.registerComponent('NextButton', NextButton);
    videojs.registerComponent('PrevButton', PrevButton);
    //player.getChild('controlBar').addChild('SharingButton', {});
    player.getChild('controlBar').addChild('PrevButton', {}, 0);
    player.getChild('controlBar').addChild('NextButton', {}, 2);

    player.on('mouseout', function(){ 
      controlBar.addClass('vjs-fade-out'); 
    });

    player.on('mouseover', function(){ 
      controlBar.removeClass('vjs-fade-out'); 
    });

    var resetDelay, inactivityTimeout;

    resetDelay = function(){
        clearTimeout(inactivityTimeout);
        inactivityTimeout = setTimeout(function(){
            player.userActive(false);
        }, 2000);
    };

    player.on('mousemove', function(){
        resetDelay();
    })
    var userActivity, activityCheck;

    player.on('mousemove', function(){
        userActivity = true;
    });
    
  $.ajax({
    type: "POST",
    url: "{{ url('lessons/getplaylist')}}",
    data: postData,
    dataType: "json",
    beforeSend: function() {
      // $('#hasil').html('<tr><td colspan="6">Loading...</td></tr>');
    },
    success: function (data){

      // Adding Playlist
      // var player = videojs('video');
      player.playlist(data);
      player.playlistUi();


      // player.DurationDisplay( player,[options] )
    }
  });
}

function videoTracking(videosrc) {
  var postData =
              {
                  "_token":"{{ csrf_token() }}",
                  "videosrc": videosrc
              }
  $.ajax({
    type: "POST",
    url: "{{ url('lessons/videoTracking')}}",
    data: postData,
    // dataType: "json",
    beforeSend: function() {
      $('#hasil').html('<tr><td colspan="6">Loading...</td></tr>');
    },
    success: function (data){

      if (data == true) {
        console.log('Viewers has been updated');
      }

    }
  });
}

</script>

<script type="text/javascript">
  
  $(document).on('ready',function () {
    getComments();
  });

  function getComments() {
    $.ajax({
        type    :'GET',
        url     :'{{ url("lessons/coments/getComments/".$lessons->id) }}',
        success:function(data){
          if (data == '') {
            $('#comments-lists').html('Tidak Ada Pertanyaan');
          }else {
            $('#comments-lists').html(data);
          }
        }
    });
  }

  function doComment(lesson_id, parent_id) {
    var body = $('#textbody'+parent_id).val();
    var file_data = $('#file').prop("files")[0];
    dataform = new FormData();
    dataform.append( 'image', file_data);
    dataform.append( 'body', body);
    dataform.append( 'lesson_id', lesson_id);
    dataform.append( 'parent_id', parent_id);

    if (body == '') {
      alert('Harap Isi form !')
    }else {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type    :"POST",
          url     :'{{ url("/lessons/coments/doComment") }}',
          data    : dataform,
          dataType : 'json',
          contentType: false,
          processData: false,
          beforeSend: function(){
               swal({
                title: "Memuat Pertanyaan",
                text: "Mohon Tunggu sebentar Pertanyaan anda sedang dimuat",
                imageUrl: "{{ asset('template/web/img/loading.gif') }}",
                showConfirmButton: false,
                allowOutsideClick: false
            });
            // Show image container
          },
          success:function(data){
            if (data.success == false) {
               window.location.href = '{{ url("member/signin") }}';
            }else if (data.success == true) {
              $('#textbody'+parent_id).val('');
              $('.inputfile').each(function() {
                var $input	 = $(this),
                    $label	 = $input.next('label'),
                    labelVal = $label.html();
                    $label.find('span').html('Upload Image');
              });
              swal({
                title: "Pertanyaan berhasil terkirim!",
                showConfirmButton: true,
                timer: 3000
              });
              
              getComments();
            }
          }
      });
    }
  }
  function replyComment(lesson_id, parent_id) {
    var body = $('#textbody'+parent_id).val();
    var file_data = $('#file-2').prop("files")[0];
    dataform = new FormData();
    dataform.append( 'image', file_data);
    dataform.append( 'body', body);
    dataform.append( 'lesson_id', lesson_id);
    dataform.append( 'parent_id', parent_id);

    if (body == '') {
      alert('Harap Isi form !')
    }else {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type    :"POST",
          url     :'{{ url("/lessons/coments/doComment") }}',
          data    : dataform,
          dataType : 'json',
          contentType: false,
          processData: false,
          beforeSend: function(){
               swal({
                title: "Memuat Pertanyaan",
                text: "Mohon Tunggu sebentar Pertanyaan anda sedang dimuat",
                imageUrl: "{{ asset('template/web/img/loading.gif') }}",
                showConfirmButton: false,
                allowOutsideClick: false
            });
            // Show image container
          },
          success:function(data){
            if (data.success == false) {
               window.location.href = '{{ url("member/signin") }}';
            }else if (data.success == true) {
              $('#textbody'+parent_id).val('');
              $('.inputfile').each(function() {
                var $input	 = $(this),
                    $label	 = $input.next('label'),
                    labelVal = $label.html();
                    $label.find('span').html('Upload Image');
              });
              swal({
                title: "Pertanyaan berhasil terkirim!",
                showConfirmButton: true,
                timer: 3000
              });
              
              getComments();
            }
          }
      });
    }
  }
</script>
<script>
  var cek = localStorage.getItem('cart');
  if(cek != null){
    var results = JSON.parse(cek);
    if (results.length > 0){
      $.each(results, function(k,v) {
            $('#beli-'+v['id']).hide();
            $('#guest-'+v['id']).show();
      });
    }
  }
</script>
@endsection
