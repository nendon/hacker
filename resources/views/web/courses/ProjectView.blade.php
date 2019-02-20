@extends('web.app')
@section('title','')
@section('content')

    <!-- Section Header -->
    <section class="header">
        <i class="fa fa-circle"></i>
        <a href="{{ url('Bootcamp/Course') }}">Dashboard</a>
    </section>

    <!-- Section Content -->
    <section class="project-view mt-5">
      <div class="container">

        <div class="row">
          <div class="col-xs-12 text-center">
            <h4 class="c-blue">Linux Fundamental </h4>
            <h4 class="c-blue"> Final Projek</h4>
            <h5 class="text-muted">Become System Administrator Profesional</h5>
          </div>
        </div>

        <!-- Row -->
        <div class="row">
          <div class="col-xs-12">
            <div class="card">
              <div class="card-header">
                <h5>Project Preview</h5>
              </div>
              <div class="card-body">
                <ul class="project-preview">
                  <li>
                    1. OS dan Instalasi: Ubuntu 16.04
                    <ul>
                      <li>Link Download dimana dan langkah-langkah untuk membuat USB booting</li>
                      <li>Partisi/100gb/home1TB,swap 2GB</li>
                      <li>Dual boot dengan windows 7</li>
                    </ul>
                  </li>
                  <li>
                    2. Topologi dan jaringan
                    <ul>
                      <li>Desain topologi dan alokasi ip nya serta bagaimana agar koneksi ke internet</li>
                      <li>Bagaimana langkah mengkoneksikannya ke jaringan kabel agar seluruhnya terhubung</li>
                    </ul>
                  </li>
                  <li>
                    3. Apps
                    <ul>
                      <li>
                        Instalasi pengganti Photoshop, Microsoft office dan Corel Draw semuanya melalui CLI
                      </li>
                    </ul>
                  </li>
                  <li>
                    4. CLI
                    <ul>
                      <li>Buatkan 1 folder berisi text welcome.txt di folder /home yang berisi : Selamat datang di Ubuntu kami!. Semuanya harus pake CLI</li>
                    </ul>
                  </li>
                </ul>

                <div class="komentar mx-4">
                  Komentar
                  <div class="textarea">
                      Tidak Ada Komentar
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

@endsection()