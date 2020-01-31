@extends('web.app')
@section('title','Harga')
@section('description', 'Ini Halaman Harga')
@section('content')
 <style>
  .owl-theme .owl-dots .owl-dot span {
    width: 45px;
    height: 10px;
    margin: 5px 7px;
    background: #D6D6D6;
    display: block;
    -webkit-backface-visibility: visible;
    transition: opacity .2s ease;
    border-radius: 30px;
}
.columns {
    float: left;
    width: 40%;
    padding: 8px;
}
hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    width: 77%;
    border-top: 5px solid rgba(238, 238, 238, 1);
}
.price {
    list-style-type: none;
    border: 1px solid #eee;
    margin: 0;
    padding: 0;
    -webkit-transition: 0.3s;
    transition: 0.3s;
    min-height: 660px;
}

.price-recomended {
    list-style-type: none;
    border: 5px solid #FFEC19;
    margin: 0;
    padding: 0;
    -webkit-transition: 0.3s;
    transition: 0.3s;
    min-height: 660px;
}


.price:hover {
    box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

.price .header {
    background-color: #fff;
    color: black;
    font-size: 25px;
}

.price li {
    padding: 20px;
    text-align: center;
}

.price .grey {
    background-color: #fff;
    font-size: 20px;
    color: #2BA8E2;
}
.price-recomended:hover {
    box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

.price-recomended .header {
    background-color: #fff;
    color: black;
    font-size: 25px;
}

.price-recomended li {
    padding: 20px;
    text-align: center;
}

.price-recomended .grey {
    background-color: #fff;
    font-size: 20px;
    color: #2BA8E2;
}
.button {
    background-color: #2BA8E2;
    border: none;
    border-radius: 5px;
    color: white;
    padding: 10px 25px;
    text-align: center;
    text-decoration: none;
    font-size: 18px;
    margin-bottom: 20px;
}

.button a{
    text-decoration: none;
}

.button:hover{
  text-decoration: none;
  background-color: #2BA8E2;
  color :#fff;
}
@media only screen and (max-width: 600px) {
    .columns {
        width: 100%;
}
.kotak {
	margin-bottom: 20px;
}
}
.plan-highlight {
  margin: auto;
  margin-top: 0;
  margin-bottom: 0;
  width: 400px;
  border: 4px solid #FFEC19;
}

.plan-highlight .plan-button {
  font-size: 18px;
  line-height: 49px;
  background: #FFEC19;
  border-color: #FFEC19;
  border-color: rgba(0, 0, 0, 0.15);
}

.plan-recommended {
  border-radius: 5px;
  width: auto;
  line-height: auto;
  font-weight: bold;
  color: black;
  text-align: center;
  text-shadow: 0 1px rgba(0, 0, 0, 0.05);
  background: #FFEC19;
  border-radius: 0 0 4px 4px;
}
</style>
{{-- <div id="table-bg"> --}}
<section class="intro">
  <div class="container">
    <h1 style="text-align: center;">HARGA</h1>
    <h4 style="text-align: center;">Bandingkan pilihan paket langganan sesuai kebutuhan anda</h4>
  </div>
</section>
<div id="table-section">
<div class="col-md-4 kotak  " style="border-radius: 5px;">
    <form action="{{ url('member/package')}}" method="post">
    {{ csrf_field() }} 
    <input type="hidden" name="packages_id" value="1">
    <ul class="price">
    <li class="header">Pro</li>
    <hr>
    <li class="grey"><font color="red"><font size="3"><strike>Rp. 119000</strike> | Diskon 10%!</font></font>
    <br>Rp. <?=$packages['0']->price;?> / <?=$packages['0']->expired;?> Hari</li>
    <li>Bebas Streaming ke Semua Video Tutorial</li>
    <li>Update Hingga 50 Video lebih perbulan</li>
    <li>Konsultasi dengan trainer via chat dijawab max dalam 3x24 Jam</li>
    <li><strike><font color="red">Download Semua Materi Video</font></strike></li>
    <li><strike><font color="red">Download Ebook & File Praktek</font></strike></li>
    <li><strike><font color="red">Support Remote Teamviewer</font></strike></li>
    <li></li>
    <hr>
    <?php if (Session::get('memberID')): ?>
        <li class=""><button type="submit" class="button" id="pilih">PILIH PAKET</button></li>
    <?php else: ?>
        <li class=""><a class="button" href="{{ url('member/signup') }}" style="color: #ffffff;"">DAFTAR</a></li>
    <?php endif;?>
    </ul>
    </form>
</div>

<div class="col-md-4" style="border-radius: 5px;">
    <form action="{{ url('member/package')}}" method="post">
    {{ csrf_field() }} 
    <input type="hidden" name="packages_id" value="2">
  <h3 class="plan-recommended" style="margin-top: 0px; margin-bottom: 0px;">Best Value</h3>
  <ul class="price-recomended">
    <li class="header">Premium</li>
    <hr>
    <li class="grey"><font color="red"><font size="3"><strike>Rp. 349000</strike> | Diskon 10%!</font></font>
    <br>Rp. <?=$packages['1']->price;?> / <?=$packages['1']->expired;?> Hari</li>
    <li>Bebas Streaming ke Semua Video Tutorial</li>
    <li>Update Hingga 50 Video lebih perbulan</li>
    <li>Konsultasi dengan trainer via chat dijawab max dalam 2x24 Jam</li>
    <li>Download Semua Materi Video</li>
    <li>Download Ebook & File Praktek</li>
    <li><strike><font color="red">Support Remote Teamviewer</font></strike></li>
    <li></li>
    <hr>
    <?php if (Session::get('memberID')): ?>
        <li class=""><button type="submit" class="button" id="pilih">PILIH PAKET</button></li>
    <?php else: ?>
        <li class=""><a class="button" href="{{ url('member/signup') }}" style="color: #ffffff;"">DAFTAR</a></li>
    <?php endif;?>
    </ul>
</form>
</div>
<div class="col-md-4" style="border-radius: 5px;">
    <form action="{{ url('member/package')}}" method="post">
    {{ csrf_field() }} 
    <input type="hidden" name="packages_id" value="3">
  <ul class="price">
    <li class="header">Platinum</li>
    <hr>
    <li class="grey"><font color="red"><font size="3"><strike>Rp. 499000</strike> | Diskon 10%!</font></font>
    <br>Rp. <?=$packages['2']->price;?> / <?=$packages['2']->expired;?> Hari</li>
    <li>Bebas Streaming ke Semua Video Tutorial</li>
    <li>Update Hingga 50 Video lebih perbulan</li>
    <li>Konsultasi dengan Trainer via chat dijawab max dalam 1x24 Jam</li>
    <li>Download Semua Materi Video</li>
    <li>Download Ebook & File Praktek</li>
    <li>Support Remote Teamviewer (Kuota remote 2x perbulan, durasi per-remote 1 jam)</li>
    <hr>
    <?php if (Session::get('memberID')): ?>
        <li class=""><button type="submit" class="button" id="pilih">PILIH PAKET</button></li>
    <?php else: ?>
        <li class=""><a class="button" href="{{ url('member/signup') }}" style="color: #ffffff;"">DAFTAR</a></li>
    <?php endif;?>
  </ul>
</div>

</div>
<section class="intro" style="padding: 25px;">
  <div class="container">
    <h1 style="text-align: center;">TESTIMONIAL USER</h1>
      <div class="owl-carousel owl-theme">
            <div class="card-container manual-flip">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                        </div>
                        <div class="user">
                            <img class="img-circle" src="{{ url('/assets/source/images/testimoni/fitrih.png') }}"/>
                        </div>
                        <div class="content">
                            <div class="main">
                                <p class="text-center">"Alhamdulillaah...saya mendapat banyak ilmu disini. Mudah2an saya bisa lebih percaya diri mengajar karena banyak kosakata baru di dunia IT."</p>
                                <h3 class="name">Fitri Handayani</h3>
                                <p class="profession">Guru SMK</p>
                            </div>
                        </div>
                    </div> <!-- end front panel -->
                    <div class="back">
                        <div class="header">
                            <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                        </div>
                        <div class="content">
                            <div class="main">
                                <h4 class="text-center">Job Description</h4>
                                <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>

                                <div class="stats-container">
                                    <div class="stats">
                                        <h4>235</h4>
                                        <p>
                                            Followers
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>114</h4>
                                        <p>
                                            Following
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>35</h4>
                                        <p>
                                            Projects
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="footer">
                            <button class="btn btn-simple" rel="tooltip" title="Flip Card" onclick="rotateCard(this)">
                                <i class="fa fa-reply"></i> Back
                            </button>
                            <div class="social-links text-center">
                                <a href="http://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                                <a href="http://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                                <a href="http://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                            </div>
                        </div>
                    </div> <!-- end back panel -->
                </div> <!-- end card -->
            </div> <!-- end card-container -->
            <div class="card-container manual-flip">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                        </div>
                        <div class="user">
                            <img class="img-circle" src="{{ url('/assets/source/images/testimoni/ludy.png') }}"/>
                        </div>
                        <div class="content">
                            <div class="main">
                                <p class="text-center">"Materi sangat bagus dan bisa didownload. Jadi bisa belajar kapanpun dirumah.<br>Saya pun bisa minta dipandu step by stepnya oleh trainernya. Jadi ngga takut gagal. <br>Mau perpanjang langganan kursus lagi aahh. hehehe"</p>
                                <h3 class="name">Ludy</h3>
                                <p class="profession">Sysadmin</p>
                            </div>
                        </div>
                    </div> <!-- end front panel -->
                    <div class="back">
                        <div class="header">
                            <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                        </div>
                        <div class="content">
                            <div class="main">
                                <h4 class="text-center">Job Description</h4>
                                <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>

                                <div class="stats-container">
                                    <div class="stats">
                                        <h4>235</h4>
                                        <p>
                                            Followers
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>114</h4>
                                        <p>
                                            Following
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>35</h4>
                                        <p>
                                            Projects
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="footer">
                            <button class="btn btn-simple" rel="tooltip" title="Flip Card" onclick="rotateCard(this)">
                                <i class="fa fa-reply"></i> Back
                            </button>
                            <div class="social-links text-center">
                                <a href="http://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                                <a href="http://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                                <a href="http://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                            </div>
                        </div>
                    </div> <!-- end back panel -->
                </div> <!-- end card -->
            </div> <!-- end card-container -->
            <div class="card-container manual-flip">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                        </div>
                        <div class="user">
                            <img class="img-circle" src="{{ url('/assets/source/images/testimoni/ekas.png') }}"/>
                        </div>
                        <div class="content">
                            <div class="main">
                                <p class="text-center">"Pengajar bersertifikasi dan berpengalaman, <br>nanya-nanya sama trainernya pun malem juga tetep dijawab. mantap. <br>Saya belajar banyak ilmu baru disini yang berguna menunjang pekerjaan saya."</p>
                                <h3 class="name">Eka Saeful</h3>
                                <p class="profession">Trainer Mikrotik</p>
                            </div>
                        </div>
                    </div> <!-- end front panel -->
                    <div class="back">
                        <div class="header">
                            <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                        </div>
                        <div class="content">
                            <div class="main">
                                <h4 class="text-center">Job Description</h4>
                                <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>

                                <div class="stats-container">
                                    <div class="stats">
                                        <h4>235</h4>
                                        <p>
                                            Followers
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>114</h4>
                                        <p>
                                            Following
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>35</h4>
                                        <p>
                                            Projects
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="footer">
                            <button class="btn btn-simple" rel="tooltip" title="Flip Card" onclick="rotateCard(this)">
                                <i class="fa fa-reply"></i> Back
                            </button>
                            <div class="social-links text-center">
                                <a href="http://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                                <a href="http://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                                <a href="http://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                            </div>
                        </div>
                    </div> <!-- end back panel -->
                </div> <!-- end card -->
            </div> <!-- end card-container -->
            <div class="card-container manual-flip">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                        </div>
                        <div class="user">
                            <img class="img-circle" src="{{ url('/assets/source/images/testimoni/muhf.png') }}"/>
                        </div>
                        <div class="content">
                            <div class="main">
                                <p class="text-center">"Dengan Harga yang terjangkau saya merasa puas dengan semua materi yang diberikan. <br>Pilihan materi pun banyak dan bagus-bagus. Cocok untuk pemula hingga advanced. Orang jaringan sangat recommended kursus online disini."</p>
                                <h3 class="name">Muh Fitrah</h3>
                                <p class="profession">Network Admin</p>
                            </div>
                        </div>
                    </div> <!-- end front panel -->
                    <div class="back">
                        <div class="header">
                            <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                        </div>
                        <div class="content">
                            <div class="main">
                                <h4 class="text-center">Job Description</h4>
                                <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>

                                <div class="stats-container">
                                    <div class="stats">
                                        <h4>235</h4>
                                        <p>
                                            Followers
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>114</h4>
                                        <p>
                                            Following
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>35</h4>
                                        <p>
                                            Projects
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="footer">
                            <button class="btn btn-simple" rel="tooltip" title="Flip Card" onclick="rotateCard(this)">
                                <i class="fa fa-reply"></i> Back
                            </button>
                            <div class="social-links text-center">
                                <a href="http://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                                <a href="http://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                                <a href="http://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                            </div>
                        </div>
                    </div> <!-- end back panel -->
                </div> <!-- end card -->
            </div> <!-- end card-container -->
            <div class="card-container manual-flip">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                        </div>
                        <div class="user">
                            <img class="img-circle" src="{{ url('/assets/source/images/testimoni/safarulm.png') }}"/>
                        </div>
                        <div class="content">
                            <div class="main">
                                <p class="text-center">"Alhamdulillah cukup puas dengan materi yang disampaikan.<br>Singkat, padat dan jelas. <br>Lebih paham, sekalipun peserta awam."</p>
                                <h3 class="name">Safarul M</h3>
                                <p class="profession">IT Support</p>
                            </div>
                        </div>
                    </div> <!-- end front panel -->
                    <div class="back">
                        <div class="header">
                            <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                        </div>
                        <div class="content">
                            <div class="main">
                                <h4 class="text-center">Job Description</h4>
                                <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>

                                <div class="stats-container">
                                    <div class="stats">
                                        <h4>235</h4>
                                        <p>
                                            Followers
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>114</h4>
                                        <p>
                                            Following
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>35</h4>
                                        <p>
                                            Projects
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="footer">
                            <button class="btn btn-simple" rel="tooltip" title="Flip Card" onclick="rotateCard(this)">
                                <i class="fa fa-reply"></i> Back
                            </button>
                            <div class="social-links text-center">
                                <a href="http://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                                <a href="http://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                                <a href="http://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                            </div>
                        </div>
                    </div> <!-- end back panel -->
                </div> <!-- end card -->
            </div> <!-- end card-container -->
            <div class="card-container manual-flip">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                        </div>
                        <div class="user">
                            <img class="img-circle" src="{{ url('/assets/source/images/testimoni/sentota.png') }}"/>
                        </div>
                        <div class="content">
                            <div class="main">
                                <p class="text-center">"Sangat interaktif, penjelasan juga analogi pemahamannya mudah dipahami<br>sehingga materi yang disampaikan dapat langsung diaplikasikan"</p>
                                <h3 class="name">Sentot Andi</h3>
                                <p class="profession">Staff IT</p>
                            </div>
                        </div>
                    </div> <!-- end front panel -->
                    <div class="back">
                        <div class="header">
                            <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                        </div>
                        <div class="content">
                            <div class="main">
                                <h4 class="text-center">Job Description</h4>
                                <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>

                                <div class="stats-container">
                                    <div class="stats">
                                        <h4>235</h4>
                                        <p>
                                            Followers
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>114</h4>
                                        <p>
                                            Following
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>35</h4>
                                        <p>
                                            Projects
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="footer">
                            <button class="btn btn-simple" rel="tooltip" title="Flip Card" onclick="rotateCard(this)">
                                <i class="fa fa-reply"></i> Back
                            </button>
                            <div class="social-links text-center">
                                <a href="http://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                                <a href="http://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                                <a href="http://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                            </div>
                        </div>
                    </div> <!-- end back panel -->
                </div> <!-- end card -->
            </div> <!-- end card-container -->
            <div class="card-container manual-flip">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                        </div>
                        <div class="user">
                            <img class="img-circle" src="{{ url('/assets/source/images/testimoni/aguss.png') }}"/>
                        </div>
                        <div class="content">
                            <div class="main">
                                <p class="text-center">"Updatean materinya ditunggu mas. hehehe <br>Ngga sabar buat belajar materi-materi baru terus di cilsy."</p>
                                <h3 class="name">Agus Supriyono</h3>
                                <p class="profession">Technical Support</p>
                            </div>
                        </div>
                    </div> <!-- end front panel -->
                    <div class="back">
                        <div class="header">
                            <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                        </div>
                        <div class="content">
                            <div class="main">
                                <h4 class="text-center">Job Description</h4>
                                <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>

                                <div class="stats-container">
                                    <div class="stats">
                                        <h4>235</h4>
                                        <p>
                                            Followers
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>114</h4>
                                        <p>
                                            Following
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>35</h4>
                                        <p>
                                            Projects
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="footer">
                            <button class="btn btn-simple" rel="tooltip" title="Flip Card" onclick="rotateCard(this)">
                                <i class="fa fa-reply"></i> Back
                            </button>
                            <div class="social-links text-center">
                                <a href="http://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                                <a href="http://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                                <a href="http://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                            </div>
                        </div>
                    </div> <!-- end back panel -->
                </div> <!-- end card -->
            </div> <!-- end card-container -->
            <div class="card-container manual-flip">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                        </div>
                        <div class="user">
                            <img class="img-circle" src="{{ url('/assets/source/images/testimoni/michaels.png') }}"/>
                        </div>
                        <div class="content">
                            <div class="main">
                                <p class="text-center">"Penyampaian materi sangat mudah dipahami, harga kursus online sangat terjangkau. Sukses Selalu Buat Cilsy Foulation"</p>
                                <h3 class="name">Michael Situmorang</h3>
                                <p class="profession">Network Admin</p>
                            </div>
                        </div>
                    </div> <!-- end front panel -->
                    <div class="back">
                        <div class="header">
                            <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                        </div>
                        <div class="content">
                            <div class="main">
                                <h4 class="text-center">Job Description</h4>
                                <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>

                                <div class="stats-container">
                                    <div class="stats">
                                        <h4>235</h4>
                                        <p>
                                            Followers
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>114</h4>
                                        <p>
                                            Following
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>35</h4>
                                        <p>
                                            Projects
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="footer">
                            <button class="btn btn-simple" rel="tooltip" title="Flip Card" onclick="rotateCard(this)">
                                <i class="fa fa-reply"></i> Back
                            </button>
                            <div class="social-links text-center">
                                <a href="http://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                                <a href="http://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                                <a href="http://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                            </div>
                        </div>
                    </div> <!-- end back panel -->
                </div> <!-- end card -->
            </div> <!-- end card-container -->
      </div>
    </div> <!-- end col sm 3 -->
  </div>
</section>
<!-- BEGIN FAQ -->
<section class="faq mb-50 pl-15">
  <div class="container">
    <div class="row mb-25">
      <div class="col-md-12 text-center ">
        <h3>FAQ</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">

                <span class="number">1</span>
                Berapa harga untuk kursus online di Cilsy?
              </a>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse collapse">
            <div class="panel-body">
              Harganya ada di kisaran Rp. 119.000 - Rp. 499.000 tergantung paket langganan yang anda pilih. Untuk melihat perbedaan antar paket bisa lihat link ini : <a href="{{ url('pages/harga')}}" target="_blank">Lihat Perbedaan antar paket</a>
            </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

      <div class="col-md-6">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2">

                <span class="number">2</span>
                Apakah kursus online ini cocok untuk pemula ?
              </a>
            </h4>
          </div>
          <div id="collapse2" class="panel-collapse collapse">
            <div class="panel-body">
              Sangat cocok. Karena materi-materi disini dibuat bertahap mulai dari dasar sampai mahir. 
            </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

      <div class="col-md-6">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <span class="border">&nbsp;</span>
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3">

                <span class="number">3</span>
                Apa perbedaan paket Pro, Premium dan Platinum?
              </a>
            </h4>
          </div>
          <div id="collapse3" class="panel-collapse collapse">
            <div class="panel-body">
              Perbedaan utama dari 3 paket tersebut adalah dari segi durasi dan fasilitas yang didapatkan. Paket yang paling lengkap fasilitasnya dan paling hemat adalah paket PLATINUM dengan masa aktif 6 bulan, bisa download video, ebook, serta dapat support remote teamviewer. Untuk melihat perbedaan antar paket lebih jelas bisa lihat link ini : <a href="{{ url('pages/harga')}}"target="_blank">Lihat Perbedaan antar paket</a>
            </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

      <div class="col-md-6">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <span class="border">&nbsp;</span>

              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                <span class="number">4</span>

                <span class="title">Apakah semua video disini bisa didownload?</span>
              </a>
            </h4>
          </div>
          <div id="collapse4" class="panel-collapse collapse">
            <div class="panel-body">
              Bisa, apabila anda berlangganan paket PREMIUM atau PLATINUM. Untuk melihat lebih jelas perbedaan antar paket bisa lihat di link berikut : <a href="{{ url('pages/harga')}}"target="_blank">Lihat Perbedaan antar paket</a>
            </div>
          </div>
        </div>
        <!-- ./ Panel -->
      </div>

    </div>


    <div class="row">
      <div class="col-md-12 text-center">
        <a href="{{ url('faq')}}" class="btn btn-link btn-more">Lihat semua pertanyaan <i class="ion-arrow-right-c"></i></a>
      </div>
    </div>
  </div>
</section><!-- ./END GUIDE -->
<!-- BEGIN CALL TO ACTION -->
<section class="intro" style="margin-bottom: 0px; padding: 20px;">
  <div class="container">
    <div class="row ">
      <div class="col-md-6">
        <div class="middle-wrap">
          <div class="inner">
            <?php if (Session::get('memberID')): ?>
              <h2 style="margin-top: 4px;">Perpanjang Paket Sekarang!</h2>
            <?php else: ?>
                <h2 style="margin-top: 4px;">Akses ke semua tutorial sekarang!</h2>
            <?php endif;?>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="middle-wrap">
          <div class="inner text-center">
            <?php if (Session::get('memberID')): ?>
              <a href="{{ url('member/packages')}}" class="btn btn-default btn-lg">Pilih Paket</a>
            <?php else: ?>
              <a href="{{ url('member/signup')}}" class="btn btn-default btn-lg">Buat Akun</a>
            <?php endif;?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- ./END CALL TO ACTION -->

<script type="text/javascript">
  function select_package(id) {
    $('[name=packages_id]').val(id);
  }
</script>
<script>
fbq('track', 'CompleteRegistration');
</script>
<script type="text/javascript">
  var button = document.getElementById('pilih');
  button.addEventListener(
    'click',
    function() {
      fbq('track', 'InitiateCheckout');
    },
    false
  );
</script>
<script type="text/javascript" src="{{asset('template/web/js/owl.carousel.min.js') }}"></script>
<script>
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin: 5,
    // nav:true,
    responsive:{
        0:{
            items:1,
            dots:false
        },
        600:{
            items:3,
            dots:false
        },
        1000:{
            items:3
        }
    }
})
</script>
@endsection
