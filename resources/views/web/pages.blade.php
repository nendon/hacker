@extends('web.app')
@section('title',$pages->title)
@section('description', $pages->meta_desc)
@section('content')
<style media="screen">
  .section-content{
    min-height: 350px;
    padding-top: 50px;
  }
  .section-content h3{
    font-weight: 700;
    color: #777;
    letter-spacing: 2px;
    text-align: center;
  }
  .section-content .content{
    color: #777;
    letter-spacing: 1px;
    line-height: 1.5;
    margin: 25px 0px;
    text-align: justify;
  }
</style>
<div class="section-content">

  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h3>{{ $pages->title }}</h3>
        <p class="content"><?= nl2br($pages->content); ?></p>
      </div>
    </div>
  </div>

</div>

@endsection
