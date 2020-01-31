@push('css')


@endpush

<section class="intro" style="margin-bottom: 0px; padding: 20px;">
  <div class="container">
    <div class="row ">
      <div class="col-md-6">
        <div class="middle-wrap">
          <div class="inner">
            @if (!empty(Auth::guard('members')->user()->id))
              <h2 style="margin-top: 4px;">Perpanjang Paket Sekarang</h2>
            @else
                <h2 style="margin-top: 4px;">Akses ke semua tutorial sekarang!</h2>
            @endif
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="middle-wrap">
          <div class="inner text-center">
            @if (!empty(Auth::guard('members')->user()->id))
              <a href="{{ url('member/package')}}" class="btn btn-default btn-lg">Pilih Paket</a>
            @else
              <a href="{{ url('member/signup')}}" class="btn btn-default btn-lg">Buat Akun</a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- ./END CALL TO ACTION --> 

@push('js')



@endpush
