@push('css')


@endpush
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
.card {
    margin-bottom: 15px;
    border-radius: 5px;
    
    
}
.card:hover {
    text-decoration: none;
    -webkit-box-shadow: 4px 4px 13px 0px rgba(0,0,0,0.18);
    -moz-box-shadow: 4px 4px 13px 0px rgba(0,0,0,0.18);
    box-shadow: 4px 4px 13px 0px rgba(0,0,0,0.18);
}
.card a {
    text-decoration: none;
}
.card-img {
    width: 100%;
    height: 150px;
    background-size: cover;
    background-position: center center;
}
.card-body {
    height: 100px;
    padding: 15px;
    padding-bottom: 15px;
    background-color: #fafafa00;
}
.card-info {
    padding-bottom: 15px;
    position: absolute;
    left: 20;
    bottom: 0;
}
</style>
<!-- BEGIN CONTRIBUTORS PROFILE BODY-->
<section class="contributor-profile-body mb-25">
<div class="container section-content">
    <div class="row">
      <div class="col-md-3 pt-25 ">
        <?php if ($contri->avatar): ?>
          <img src="{{ asset($contributors->avatar) }}" alt="" class="img-responsive img-center">
        <?php else: ?>
          <img src="{{ asset($contri->slug) }}" alt="" class="img-responsive img-center">
        <?php endif; ?>
        <div class="text-center mt-15">
          <div class="btn-group">
            <button type="button" class="btn btn-primary">{{ count($contributors_total_lessons) }} Tutorial</button>
          </div>
        </div>
      </div>
      
      <div class="col-sm-9" style="margin-top: 20px;">
          <div class="about-text">
            <?= $contributors->about ?>
          </div>
          <div class="row lessons-grid">
          <?php
           if(!count($contributors_lessons) == 0) {
                foreach ($contributors_lessons as $key => $last): ?>  
                  <div class="col-md-3">
                    <div class="card">
                      <a href="{{ url('lessons/'.$last->slug)}}">
                          <?php if (!empty($last->image)) {?>
                            <div class="card-img" style="background-image: url('{{ asset($last->image)}}');"></div>
                          <?php } else {?>
                            <div class="card-img" style="background-image: url('{{ asset('template/web/img/no-image-available.png')}}');"></div>
                          <?php }?>
                          <div class="card-body">
                            <p>{{ $last->title }}</p>
                          </div>
                          <div class="footer">
                            <p>Total <?php echo Helper::getTotalVideo($last->id);?> Video</p>
                          </div>     
                      </a>
                    </div>
                  </div>

              <?php endforeach; 
            } ?>
            <div class="row">
          <div class="col-md-12 text-center">
              {{ $contributors_lessons->links() }}
          </div>
      </div>
          </div>
      </div>
    </div>
  </div>
</section><!-- ./END CONTRIBUTORS PROFILE BODY -->

@push('js')



@endpush