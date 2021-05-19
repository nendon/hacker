@push('css')


@endpush
    <!-- Nav Tabs -->
        <ul class="nav nav-pills mt-5" id="pills-tab" role="tablist">
          <li class="nav-item {{ request()->is('contributor/bootcamp/'.$bootcamp->slug) ? 'active' : '' }}">
            <a class="nav-link" id="pills-course-tab" href="{{url('contributor/bootcamp/'.$bootcamp->slug)}}">Course</a>
          </li>
          <li class="nav-item {{ request()->is('contributor/bootcamp/'.$bootcamp->slug.'/lampiran') ? 'active' : '' }}">
            <a class="nav-link" id="pills-lampiran-tab"  href="{{url('contributor/bootcamp/'.$bootcamp->slug.'/lampiran')}}" >Lampiran</a>
          </li>
          <li class="nav-item {{ request()->is('contributor/bootcamp/'.$bootcamp->slug.'/detail') ? 'active' : '' }}">
              <a class="nav-link" id="pills-detail-tab"  href="{{url('contributor/bootcamp/'.$bootcamp->slug.'/detail')}}">Detail</a>
          </li>
          <li class="nav-item {{ request()->is('contributor/bootcamp/'.$bootcamp->slug.'/harga') ? 'active' : '' }}">
            <a class="nav-link" id="pills-harga-tab"  href="{{url('contributor/bootcamp/'.$bootcamp->slug.'/harga')}}" >Harga</a>
          </li>
          <li class="nav-item {{ request()->is('contributor/bootcamp/'.$bootcamp->slug.'/publish') ? 'active' : '' }}">
            <a class="nav-link" id="pills-publish-tab"  href="{{url('contributor/bootcamp/'.$bootcamp->slug.'/publish')}}" >Publish</a>
          </li>
        </ul>

@push('js')



@endpush