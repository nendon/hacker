@extends('web.members.master')
@section('title','Status Berlangganan | ')
@section('member-content')

<h3>Status Langganan</h3>
<div class="form-horizontal">

  <?php if (!$service): ?>
    <div class="alert alert-warning">
      Anda belum berlangganan
    </div>
  <?php else: ?>
    <div class="form-group">
      <label class="col-sm-3 control-label">Paket Langganan</label>
      <div class="col-sm-9">
        <p class="form-control-static">{{ $service->title }}</p>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 control-label">Status</label>
      <div class="col-sm-9">
        <p class="form-control-static">
          <?php if ($service->status == 1): ?>
            Aktif
          <?php elseif($service->status == 2): ?>
            Berakhir
          <?php endif; ?>
        </p>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 control-label">Tanggal daftar langganan</label>
      <div class="col-sm-9">
        <p class="form-control-static">{{ $service->start }}</p>
        <a href="{{ url('member/package') }}" class="btn btn-primary">Perpanjang</a>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 control-label">Masa Aktif Langganan</label>
      <div class="col-sm-9">
        <p class="form-control-static">Masa aktif paket {{ $service->title }} Anda akan berakhir pada tanggal {{ $service->expired }}</p>
        <a href="javascript:void(0)" class="btn btn-danger" onclick="unsubscribeConfirm({{$service->id}})">Hentikan</a>
      </div>
    </div>
  <?php endif; ?>


  <h3>Riwayat</h3>

  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Paket</th>
          <th>Periode</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($services) == 0): ?>
          <tr>
            <td colspan="3">Tidak ada Data</td>
          </tr>
        <?php else: ?>
          <?php foreach ($services as $key => $value): ?>
          <tr>
            <td>{{ $value->title }}</td>
            <td>{{ $value->start }} - {{ $value->expired }}</td>
            <td>
              <?php if ($value->status == 1): ?>
                <div class="label label-success">
                  Aktif
                </div>
              <?php elseif ($value->status == 2): ?>
                <div class="label label-danger">
                  Berakhir
                </div>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</div>


@push('js')
<script type="text/javascript">
  function unsubscribeConfirm(id) {

    var c = confirm("Yakin Berhenti berlangganan paket ini ?");
    if (c == true) {
        window.location = '{{ url("member/subscriptions/unsubscribe/") }}/'+id;
    }
  }
</script>
@endpush
@endsection
