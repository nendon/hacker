@extends('web.app')
@push('css')
<style media="screen">
    .btn-more{
        background-color: #2ba8e2;
        color: #fff;
    }
    .member-point {
        margin-top: 100px;
    }
    .member-point .point-information{
        margin-bottom: 130px;
    }
    .member-point .point-information .cover .member{
        color: #fff;
        min-height: 150px;
    }
    .member-point .point-information .cover .counter {
        position: absolute;
        margin-top: -50px;
        width: 100%;
        padding-right: 8%;
    }
    .member-point .point-information .cover .counter .item {
        color: #fff;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        padding: 0 10%;
    }
    .member-point .point-information .cover .counter .item .middle{
        display: table;
    }
    .member-point .point-information .cover .counter .item .inner{
        display: table-cell;
        vertical-align: middle;
    }
    .green{
        background-color: #1cc327;
    }
    .blue{
        background-color: #2798cc;
    }
    .purple{
        background-color: #a238b9;
    }

</style>
@endpush
@section('content')
<section class="member-point pt-25 pb-25">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="point-information">
                    <div class="cover p-25 pb-0 mb-25" style="background:url('https://d2r2jvvtffo57h.cloudfront.net/assets/img/strains/snow-dome-live-v1_6898d272e815dcba960cda6033ec139f4c287fa3c133f4a0fb967af577830e07.jpg') no-repeat;">
                        <div class="row member">
                            <div class="col-md-12">
                                <div class="avatar text-center">
                                    <img src="{{ asset('assets/source/avatar/1.png') }}" alt="" class="img-circle">
                                </div>
                                <div class="text-center">
                                    <h3 class="name">{{ Auth::guard('members')->user()->username }}</h3>
                                    <p class="total-point"><?= $point_question + $point_reply + $point_complete; ?> pts</p>
                                </div>
                            </div>
                        </div>
                        <div class="row counter">
                            <div class="col-md-4">
                                <div class="item middle text-center green">
                                    <div class="inner">
                                        <img src="" alt="">
                                        <p>Bertanya</p>
                                        <p>{{ $point_question }} pts</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="item middle text-center blue">
                                    <div class="inner">
                                        <img src="" alt="">
                                        <p>Menjawab Pertanyaan</p>
                                        <p>{{ $point_reply }} pts</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="item middle text-center purple">
                                    <div class="inner">
                                        <img src="" alt="">
                                        <p>Menyelesaikan Tutorial</p>
                                        <p>{{ $point_complete }} pts</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="more text-center">
                    <a href="{{ url('point') }}" class="btn btn-default btn-lg btn-more mb-25" target="_blank">Pelajari lebih lanjut tentang Point</a>
                    <p class="term-conditions">Point akan berubah atau bertambah dalam waktu 24 jam</p>
                </div>
            </div>
            <div class="col-md-6">
            <div class="col-md-12">
                <h3>Reward</h3>
            </div>
              <?php foreach ($category as $key => $cat): ?>
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme category-sliders" id="category-sliders" style="text-align:center;">
                        <?php foreach ($reward as $key => $value): ?>
                          <?php if ($cat->id == $value->category_id): ?>
                          <div class="item">
                             <a title="Image 1" href="#"><img class="thumbnail img-responsive" src="{{$value->image}}"></a>
                             <div class="description text-center">
                                 <div class="col-md-12">
                                     <h4  style="padding-bottom:10px;">{{$value->name}}</h4>
                                     <p  style="padding-bottom:10px;"><?php echo nl2br($value->description); ?></p>
                                     <h4  style="padding-bottom:10px;">{{$value->poin}} Pts</h4>
                                     <a class="btn btn-primary" href="{{url('member/reward/'.$value->slug.'/change')}}">Tukar</a>
                                 </div>
                             </div>
                          </div>
                          <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
              <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
<script type="text/javascript">
    $('.category-sliders').owlCarousel({
    loop:true,
    margin:10,
    // nav:true,
    // navText: ["<i class='fa fa-chevron-left' aria-hidden='true'></i>","<i class='fa fa-chevron-right' aria-hidden='true'></i>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
    })
</script>
@endpush
