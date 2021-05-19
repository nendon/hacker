@extends('contrib.app')
@section('title','')
@section('breadcumbs')
@section('content')
<!-- Main -->
    <main>

      <!-- Container -->
      <div class="container">

        <!-- Nav -->
        <div class="row bg-white py-4">
          <div class="col-sm-4 col-xs-12">
            <h4 class="m-2">Bootcamp</h4>
          </div>
          <div class="col-sm-4 col-xs-8 text-center text-xs-left">
            <select  style="border:none;cursor: pointer;font-size: 16px;margin: 5px 0">
              <option value="">Linux Administrator</option>
              <option value="">1</option>
              <option value="">2</option>
              <option value="">3</option>
            </select>
          </div>
          <div class="col-sm-4 col-xs-4 text-right">
            <button class="btn btn-green">+ Simpan</button>
          </div>
        </div>

        <div class="tabs-course">
          <!-- Nav Tabs -->
          <ul class="nav nav-pills mt-5" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link" id="pills-kurikulum-tab" data-toggle="pill" href="#pills-kurikulum" role="tab" aria-controls="pills-kurikulum" aria-selected="false">Kurikulum</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" id="pills-bulkuploader-tab" data-toggle="pill" href="#pills-bulkuploader" role="tab" aria-controls="pills-bulkuploader" aria-selected="false">Bulk Uploader</a>
            </li>
          </ul>

          <!-- Nav Content -->
          <div class="tab-content mt-5" id="pills-tabContent">
              <!-- Tab Kurikulum -->
              <div class="tab-pane fade" id="pills-kurikulum" role="tabpanel" aria-labelledby="pills-kurikulum-tab">
                <!-- row Title  -->
                <div class="box">
                  <div class="row">
                    <div class="col-xs-12 p-4">
                      <h4 class="text-inline">File Sebelah <i class="far fa-question-circle"></i></h4>
                    </div>
                  </div>
                </div>

              </div>

              <!-- Tab Bulk Uploader -->
              <div class="tab-pane fade active in" id="pills-bulkuploader" role="tabpanel" aria-labelledby="pills-bulkuploader-tab">
              <div class="row">

                <div class="col-sm-4 col-xs-12 col-sm-push-8">
                  <div class="row">
                    <div class="col-xs-12">
                      <ul class="kurikulum-item" id="items">
                        <!-- Diisi Jquery -->
                      </ul>
                      <button class="btn btn-green w-100 mb-4">Tambah Lesson</button>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-12 px-4">
                        <div class="card h-100">
                        <div class="card-header">
                          Debug Messages
                        </div>
            
                        <ul class="list-group list-group-flush" id="debug">
                          <li class="list-group-item text-muted empty">Loading plugin....</li>
                        </ul>
                      </div>
                    </div>
                  </div> <!-- /debug -->
                </div>

                <div class="col-sm-8 col-xs-12 col-sm-pull-4">
                  <div  class="list-group" id="contentItem">
                  </div>
                  <button class="btn btn-secondary mb-4">Tambah Lesson</button>
                </div>

              </div>



              </div>

          </div>
        </div>

      </div>

    </main>
    <script type="text/javascript" src="{{asset('template/kontributor/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/kontributor/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/kontributor/js/jquery.dm-uploader.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/kontributor/js/jquery.dm-uploader.ui.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/kontributor/js/jquery.dm-uploader.config.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/kontributor/js/Ply.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/kontributor/js/Sortable.min.js')}}"></script>

endsection()