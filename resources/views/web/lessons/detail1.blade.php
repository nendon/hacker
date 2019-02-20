@extends('web.app')
@section('title',$lessons->title.' | ')
@section('description', $lessons->meta_desc)
@section('content')

<style>
  body {
    /*font-family: Arial, sans-serif;*/
  }
<div id="content-section">
@include('web.blocks.video-player')
@include('web.blocks.video-information')
</div>
@endsection
