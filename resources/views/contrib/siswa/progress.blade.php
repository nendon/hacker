@extends('contrib.app')
@section('title', 'Project List')
@section('breadcumbs')
<div id="navigation">
    <div class="container">
        <ul class="breadcrumb">
        <li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
        <li>Progress Siswa</li>
        </ul>
    </div>
</div>
@endsection
@section('content')

<main>
<!-- menampilkan nama kelas dan tipe di bootcamp contributor -->
      <!-- Container -->
    <div class="container">	
        <div class="row mt-5">
          	<div class="col-xs-12 mb-4">
            	<h5>Kelas</h5>
          	</div>
			<table class="table ">
			    <thead>
			    	<tr>
			        	<th>Nama Kelas</th>
			        	<th>Tipe Kelas</th>
			    	</tr>
			    </thead>
			    <tbody>
			  		<?php foreach ($bootcamp as $key => $bootcamps): ?>
			    	<tr>
			        	<td>{{$bootcamps->nama}}</td>
			        	<td>Bootcamp</td>
			        	<td><button id="{{$bootcamps->id}}" style="background-color: #4CAF50;border: none; color: white; padding: 7px 16px;cursor: pointer;"> Laporan progress</button></td>
			    	</tr>
					<?php endforeach?>
			    </tbody>
			</table>
		</div>
		<div class="row">
          	<div class="col-md-12 text-center">
              {{ $bootcamp->links() }}
          	</div>
        </div>
	</div>
</main>
@endsection()	