@push('css')
<link rel="stylesheet" href="{{ asset('template/web/css/video-js.css') }}">
<link rel="stylesheet" href="{{ asset('template/web/css/app.css') }}">
<link rel="stylesheet" href="{{ asset('template/web/css/videojs-playlist-ui.vertical.css') }}">
<link rel="stylesheet" href="{{ asset('template/web/css/video-js-custom.css') }}">
{{--  <link href="{{ asset('node_modules/video.js/dist/video-js.css') }}" rel="stylesheet">  --}}
<link href="{{ asset('node_modules/videojs-playlist-ui/dist/videojs-playlist-ui.vertical.css') }}" rel="stylesheet">
<link href="{{ asset('node_modules/videojs-errors/dist/videojs-errors.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>
{{-- <link href="https://vjs.zencdn.net/5.16.0/video-js.min.css" rel="stylesheet"/> --}}
<script src="https://vjs.zencdn.net/5.16.0/video.min.js"></script>
<script src="https://rawgit.com/atlance01/vrapp-ionic/master/www/js/lib/videojs-playlist.js"></script>
@endpush

<!-- BEGIN VIDEO PLAYER -->


@push('js')




@endpush
