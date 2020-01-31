@extends('web.app')
@foreach($categories as $object)
@section('title', 'Kategori')
@section('description', $object->meta_desc)
@endforeach
@section('content')
<style>

@media (max-width:768px) {
    .section-content{
      min-height: 300px;
      padding-top: 50px;
      padding-bottom: 50px;
    }
}
@media (min-width:768px) {
    .section-content{
      min-height: 460px;
      padding-top: 50px;
      padding-bottom: 50px;
    }
}
  .item {
    padding: 25px;
    border-bottom: 1px solid #eee;
  }
  .item a{
    color: #666;
  }
  .item:hover{
    background: #eee;
  }
</style>
<div class="container section-content">
  <div class="row">
    <div class="col-sm-12">
      <h4 style="text-align: center;">Kategori</h4>
      <div id="category_carousel" class="owl-carousel owl-theme">
        <?php foreach ($categories as $key => $category): ?>
          <div class="item cat-img-container">
            <a href="{{ url('lessons/category/'.$category->title)}}">
              <img src="{{ $category->image }}" />
              <p>{{ $category->title }}</p>
            </a>
          </div>
        <?php endforeach; ?>
        <div class="item cat-img-container">
          <a href="{{ url('lessons/browse/all') }}" style="text-decoration:none;">
            <img src="https://www.cilsy.id/assets/source/category/tutorial.png" alt=""></img>
            <p>Semua Tutorial</p>
          </a>
        </div>
      </div>

      <script type="text/javascript">
        $('#category_carousel').owlCarousel({
            loop:false,
            margin:0,
            nav:false,
            // items:1,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        });
      </script>

    </div>
    <div class="col-sm-12">
      <h4>Result</h4>
      <?php if(count($results) == 0){ echo "No Data Available";}?>
      <?php foreach ($results as $key => $result): ?>
        <div class="item">
            <div class="row">
            <div class="col-md-2">
                <a href="{{ url('lessons/'.$result->slug) }}" >
                <img src="{{ $result->image }}" alt="" class="img-responsive">
                 </a>
              </div>
              <div class="col-sm-8">
                <p><a href="{{ url('lessons/'.$result->slug) }}" style="text-decoration:none;"><strong>{{ $result->title }}</strong></a></p>
                <a href="{{ url('lessons/'.$result->slug) }}" style="text-decoration:none;">
                <p><small><?php $sentence= $result->description;
                    $numberofcharacters=500;
                    $print = substr($sentence, 0, $numberofcharacters);
                    echo $print; ?></small></p>
                </a>
                <p><div class="badge badge-default">{{ $result->category_title }}</div>
                  <?=date('d M Y H:i', strtotime($result->created_at));?>
                </p>
              </div>
              <div class="col-md-2">
               <?php if(!empty($result->nilai)){ ?>
                <p style="font-weight:bold color:green;">
                <a href="{{ url('kelas/v3/'.$result->slug) }}" class="btn" style="background-color:#f1c40f; color:white; padding: 6px 22px;">Lihat Tutorial</a>
                </p>
                <?php }else{?>
                <p style="font-weight:bold;">Rp. {{ number_format($result->price, 0, ",", ".") }}</p>
                <?php if(empty($result->hasil)){ ?>
                <p>
                <button id="beli-{{ $result->id }}" type="button" class="btn btn-info" style="padding: 6px 48px"  onclick="addToCart({{ $result->id }})"><i class="fa fa-shopping-cart"></i>Beli </button>
                <a id="guest-{{ $result->id }}" href="{{ url('cart') }}" class="btn" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; display:none" >Lihat Keranjang</a>
                </p>
                <?php }else{ ?>
                <p>
                <a href="{{ url('cart') }}" class="btn" style="background-color:#fff; color:#5bc0de; border-color:#46b8da;">Lihat Keranjang</a>
                </p>
                <?php } ?>
                <?php }?>
              </div>
            </div>
          {{-- </a> --}}
        </div>
      <?php endforeach; ?>
      <div class="row">
          <div class="col-md-12 text-center">
              {{ $results->links() }}
          </div>
      </div>
    </div>
  </div>
</div>
<script>
fbq('track', 'Search');
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
<script type="text/javascript">

  function addToCart(id) {
      var datapost = {
        '_token'    : '{{ csrf_token() }}',
        'id': id
      };
      $.ajax({
          type    : 'POST',
          url     : '{{ url("/cart/add") }}',
          data    : datapost,
          success: function(data){
            if (typeof data !== 'null') {
              @if (!Auth::guard('members')->user())
              console.log('data',data);
                // window.location.href = '{{ url("member/signin") }}';
                var cek = localStorage.getItem('cart');
                if (cek == null) {
                  var cart = [];
                  cart.push({
                    'id': data.id,
                    'image': data.image,
                    'title': data.title,
                    'price': data.price,
                  });
                  console.log('cartA', cart);
                } else {
                  var exist = false;
                  var cart = JSON.parse(cek);
                  console.log('cartB', cart);
                  $.each(cart, function(k,v) {
                    if (v.id == data.id) {
                      exist = true;
                    }
                  })
                  // console.log('eksis', exist);
                  if (!exist) {
                    cart.push({
                      'id': data.id,
                      'image': data.image,
                      'title': data.title,
                      'price': data.price,
                    });
                  }
                }
                
                localStorage.setItem('cart', JSON.stringify(cart));
              @endif
              swal({
                  title: "Menambahkan ke keranjang",
                  text: data.title,
                  type: "success",
                  closeModal: true,
                  showCancelButton: true,
                  focusConfirm: false,
                  cancelButtonText: 'Lihat keranjang',
                  confirmButtonText: "Tutorial lainnya"
              }).then(function(isConfirm) {
                if (isConfirm.value) {
					        window.location.href = SITE_URL+'/cart';
				        }else if(swal.cancelButton){
					        window.location.href = SITE_URL+'/lessons/browse/all';
				        }else {
					        window.location.href = SITE_URL+'/lessons/browse/all';
              }
              });
            } else {
                alert('Koneksi Bermasalah, Silahkan Ulangi');
                location.reload();
            }
          }
      })
  }
</script>
@endsection
