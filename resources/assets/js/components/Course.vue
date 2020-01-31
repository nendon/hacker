<template>
    <!-- Main -->
    <main>

      <!-- Container -->
      <div class="container tabs-course">

        <div class="box header mt-5">
          <div class="row">
            <div class="col-sm-4 col-xs-12">
              <img :src="getCover()" class="img-rounded img-responsive" alt="">
            </div>
            <div class="col-sm-8 col-xs-12">
              <h4>Bootcamp <small class="c-yellow">Draft</small></h4>
              <h2>Become System Administrator Professional</h2>
            </div>
          </div>
        </div>

        <!-- Nav Tabs -->
        <ul class="nav nav-pills mt-5" id="pills-tab" role="tablist">
          <li class="nav-item active">
            <a class="nav-link" id="pills-course-tab" data-toggle="pill" href="#pills-course" role="tab" aria-controls="pills-course" aria-selected="true">Course</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-lampiran-tab" data-toggle="pill" href="#pills-lampiran" role="tab" aria-controls="pills-lampiran" aria-selected="false">Lampiran</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="pills-detail-tab" data-toggle="pill" href="#pills-detail" role="tab" aria-controls="pills-detail" aria-selected="false">Detail</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-harga-tab" data-toggle="pill" href="#pills-harga" role="tab" aria-controls="pills-harga" aria-selected="false">Harga</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-publish-tab" data-toggle="pill" href="#pills-publish" role="tab" aria-controls="pills-publish" aria-selected="false">Publish</a>
          </li>
        </ul>

        <div class="tab-content mt-5" id="pills-tabContent">

            <!-- Tab Course -->
            <div class="tab-pane fade active in" id="pills-course" role="tabpanel" aria-labelledby="pills-course-tab">
              <!-- Title -->
              <div class="box">
                <div class="row">
                  <div class="col-xs-12 p-4">
                    <h4 class="text-inline">Course <i class="far fa-question-circle"></i></h4>
                    <button class="btn btn-green pull-right" id="BuatCourse-show">+ Tambah Course</button>
                  </div>
                </div>
              </div>

              <div class="box mt-4" id="rowBuatCourse">
                  <h5 class="mb-4">Buat Course</h5>
                  <div class="form-group">
                    Judul Course
                    <input class="form-control" type="text" name="" id="" placeholder="" >
                  </div>
                  <div class="form-group">
                    Deskripsi atau Tujuan Belajar
                    <input class="form-control" type="text" name="" id="" placeholder="" >
                  </div>
                  <div class="form-group">
                    Gambar Course
                    <br>
                    <input class="form-control dropify" type="file">
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-3 col-xs-12">
                    Estimasi Selesai Course
                    <input class="form-control" type="number" name="" id="">
                    <small class="text-muted">Dalam hitungan jam</small>
                    </div>
                  </div>
                  <div class="row p-4">
                    <button class="btn btn-green pull-right">+ Simpan</button> 
                    <button class="btn btn-secondary pull-right mx-4" id="BuatCourse-hide">+ Batalkan</button>
                  </div>
                </div>

              <!-- Kurikulum 1 -->
              <div class="box mt-4">
                <div class="row">
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <img :src="getCoverCourse()" class="img-rounded img-responsive" alt="">
                  </div>
                  <div class="col-md-4 col-sm-3 col-xs-12">
                    <h5>Linux Administrator Part1</h5>
                    <span>0 Lesson/0 Konten</span>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12 py-4">
                    12 jam Durasi Selesai
                  </div>
                  <div class="col-md-3 col-sm-4 col-xs-12 py-4 text-right">
                    <button class="btn btn-green">+ Tambah Kurikulum</button>
                    <a class="pull-right collapsed" id="collapse" data-toggle="collapse" href="#collapseCourse" role="button"></a>
                  </div>
                </div>
                <div class="collapse" id="collapseCourse">
                  <hr>
                  <div class="box bg-grey mt-4">
                    <h5 class="mb-4">Edit Course</h5>
                    <div class="form-group">
                      Judul Course
                      <input class="form-control bg-grey" type="text" name="" id="" placeholder="" >
                    </div>
                    <div class="form-group">
                      Deskripsi atau Tujuan Belajar
                      <input class="form-control bg-grey" type="text" name="" id="" placeholder="" >
                    </div>
                    <div class="form-group  bg-grey">
                      Gambar Course
                      <input class="form-control dropify" type="file" name="file" id="" data-default-file="img/head.png">
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-3 col-xs-12">
                      Estimasi Selesai Course
                      <input class="form-control bg-grey" type="number" name="" id="">
                      <small class="text-muted">Dalam hitungan jam</small>
                      </div>
                    </div>
                  </div>
                  <div class="row p-4">
                    <button class="btn btn-green pull-right">+ Simpan</button> 
                    <button class="btn btn-secondary pull-right mx-4">+ Batalkan</button>
                  </div>
                </div>
              </div>

              <!-- Kurikulum 2 -->
              <div class="box mt-4">
                <div class="row">
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <img :src="getCoverCourse()" class="img-rounded img-responsive" alt="">
                  </div>
                  <div class="col-md-4 col-sm-3 col-xs-12">
                    <h5>Linux Administrator Part 2</h5>
                    <span>0 Lesson/0 Konten</span>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12 py-4">
                    00:00 jam Durasi Selesai
                  </div>
                  <div class="col-md-3 col-sm-4 col-xs-12 py-4 text-right">
                    <button class="btn btn-green">+ Tambah Kurikulum</button>
                    <a class="pull-right collapsed" id="collapse" data-toggle="collapse" href="#collapseCourse2" role="button"></a>
                  </div>
                </div>
              </div>

              <!-- Kurikulum 3 -->
              <div class="box my-4">
                <div class="row">
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <img :src="getCoverCourse()" class="img-rounded img-responsive" alt="">
                  </div>
                  <div class="col-md-4 col-sm-3 col-xs-12">
                    <h5>Linux Administrator Part 3</h5>
                    <span>10 Lesson/50 Konten</span>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12 py-4">
                    36 jam Durasi Selesai
                  </div>
                  <div class="col-md-3 col-sm-4 col-xs-12 py-4 text-right">
                    <button class="btn btn-green">+ Edit Kurikulum</button>
                    <a class="pull-right collapsed" id="collapse" data-toggle="collapse" href="#collapseCourse3" role="button"></a>
                  </div>
                </div>
              </div>
            </div>
  
            <!-- Tab Course Lampiran -->
            <div class="tab-pane fade" id="pills-lampiran" role="tabpanel" aria-labelledby="pills-lampiran-tab">
              <!-- row Title -->
              <div class="box">
                <div class="row">
                  <div class="col-xs-12 p-4">
                    <h4 class="text-inline">Lampiran <i class="far fa-question-circle"></i></h4>
                    <button class="btn btn-green pull-right pull-xs-left" id="Lampiran-show">+ Tambah Lampiran</button>
                  </div>
                </div>
              </div>

              <!-- row Content -->
              <div class="box mt-4" id="rowLampiran">
                <div class="row">
                  <div class="col-xs-12">
                    <h5 class="mb-4">Tambah Lampiran</h5>
                  </div>
                </div>
                <div class="form-group">
                  Nama
                  <input class="form-control" type="text" name="" id="" placeholder="" >
                </div>
                <div class="form-group">
                  Deskripsi
                  <input class="form-control" type="text" name="" id="" placeholder="" >
                </div>
                <div class="form-group">
                  File
                  <input class="form-control dropify" type="file" name="" id="">
                </div>
                <div class="row p-4">
                  <button class="btn btn-green pull-right">+ Simpan</button> 
                  <button class="btn btn-secondary pull-right mx-4" id="Lampiran-hide">+ Batalkan</button>
                </div>
              </div>

              <div class="box my-4">
                <div class="row">
                  <div class="col-xs-12">
                    <i class="fa fa-download"></i> Modul Ebook Mikrotik Lengkap dan komprehensif - For Beginner.pdf 300.2kb
                    <a class="pull-right collapsed" id="collapse" data-toggle="collapse" href="#collapseLampiran" role="button"></a>
                  </div>
                </div>
                <div class="collapse" id="collapseLampiran">
                  <div class="box bg-grey mt-4">
                    <h5>Edit Lampiran</h5>
                    <div class="form-group">
                      Judul
                      <input class="form-control bg-grey" type="text" name="" id="" value="Modul Ebook Mikrotik Lengkap dan komprehensif - For Beginner.pdf 300.2kb" >
                    </div>
                    <div class="form-group">
                      Deskripsi
                      <input class="form-control bg-grey" type="text" name="" id="" value="Modul yang isinya sama dengan video, dan dapat digunakan sebagai bahan baca-baca atau kopi paster script." >
                    </div>
                    <div class="form-group">
                      File
                      <input class="form-control bg-grey dropify" type="file" name="" id="">
                    </div>
                  </div>
                  <div class="row p-4">
                    <button class="btn pull-right"><i class="fa fa-ellipsis-v"></i></button>
                    <button class="btn btn-green pull-right  mx-2">+ Simpan</button> 
                    <button class="btn btn-secondary pull-right mx-2">+ Batalkan</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tab Detail -->
            <div class="tab-pane fade" id="pills-detail" role="tabpanel" aria-labelledby="pills-detail-tab">
              <!-- row Title  -->
              <div class="box">
                <div class="row">
                  <div class="col-xs-12 p-4">
                    <h4 class="text-inline">Details <i class="far fa-question-circle"></i></h4>
                  </div>
                </div>
              </div>

              <!-- row Content -->
              <div class="box mt-4">
                <div class="row">
                  <div class="col-xs-12">
                    <h5 class="mb-4">Bootcamp Details</h5>
                    <div class="form-group">
                      Judul
                      <input class="form-control" type="text" name="" id="" value="Modul Ebook Mikrotik Lengkap dan komprehensif - For Beginner.pdf 300.2kb" >
                    </div>
                    <div class="form-group">
                      Sub Judul
                      <input class="form-control" type="text" name="" id="" value="Modul yang isinya sama dengan video, dan dapat digunakan sebagai bahan baca-baca atau kopi paster script." >
                    </div>
                    <div class="form-group">
                      <div class="col-xs-6 pl-0">
                        Kategori
                        <input class="form-control" type="text">
                      </div>
                      <div class="col-xs-6 pl-0">
                        Sub Kategori
                        <input class="form-control" type="text">
                      </div>
                    </div>
                    <br><br><br>
                    <div class="form-group">
                      Cover Bootcamp
                      <input class="form-control dropify" type="file" name="" id="">
                    </div>
                    <div class="form-group">
                      Promotional Video
                      <input class="form-control dropify" type="file" name="" id="">
                    </div>
                    <div class="form-group">
                      Deskripsi Bootcamp
                      <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
                    </div>
                    <button class="btn btn-green pull-right">+ Simpan</button>
                  </div>
                </div>
              </div>

              <div class="box mt-4">
                <div class="row">
                  <div class="col-xs-12">
                    <h5 class="mb-4">Target Student</h5>
                    <div class="form-group">
                      Target Audience
                      <input class="form-control" type="text" name="" id="" value="Siapa yang harus mengikuti bootcamp anad" >
                    </div>
                    <div class="form-group">
                      Preusite and Requirement
                      <input class="form-control" type="text" name="" id="" value="Contoh: Harus memiliki Laptop dan Mikrotik" >
                    </div>
                    <button class="btn btn-green pull-right">+ Simpan</button>
                  </div>
                </div>
              </div>

              <div class="box my-4">
                <div class="row">
                  <div class="col-xs-12">
                    <h5>Profile Instruktur</h5>
                    <div class="alert alert-info mt-4">
                      <i class="fa fa-check-circle c-orange"></i>
                      Semua Profile Anda telah lengkap
                    </div>
                    <img :src="getAvatar()" class="img-profile-instruktur" alt=""> Andriyana
                  </div>
                </div>
              </div>
            </div>

            <!-- Tab Harga -->
            <div class="tab-pane fade" id="pills-harga" role="tabpanel" aria-labelledby="pills-harga-tab">
              <!-- row Title  -->
              <div class="box">
                <div class="row">
                  <div class="col-xs-12 p-4">
                    <h4 class="text-inline">Harga <i class="far fa-question-circle"></i></h4>
                    <button class="btn btn-green pull-right">Lihat Skema Harga dan Pembagian</button>
                  </div>
                </div>
              </div>

              <!-- row Content -->
              <div class="box mt-4">
                <div class="row">
                  <div class="col-xs-12">
                    <h5 class="mb-5">Harga</h5>
                    <h6>Harga Bootcamp</h6>
                    <div class="form-group">
                      <div class="col-sm-2 col-xs-5">  
                        <select class="form-control" name="matauang" id="matauang">
                          <option value="idr">IDR</option>
                          <option value="dollar">$</option>
                        </select>
                      </div>
                      <div class="col-sm-4 col-xs-7">
                        <input class="form-control" type="text" name="harga" id="harga" placeholder="Minimal 50.000">
                      </div>
                    </div>

                    <button class="btn btn-green pull-right mt-4">Upload File</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tab Publish -->
            <div class="tab-pane fade" id="pills-publish" role="tabpanel" aria-labelledby="pills-publish-tab">
            <!-- Title  -->
            <div class="box">
                <div class="row">
                  <div class="col-xs-12 p-4">
                    <h4 class="text-inline">Publish <i class="far fa-question-circle"></i></h4>
                  </div>
                </div>
              </div>

              <div class="box my-4">
                <div class="row">
                  <div class="col-xs-12">
                    <h5 class="mb-4">Publish</h5>
                    <h6 class="text-inline">Bootcamp belum dipublish</h6>
                    <button class="btn btn-green">Publish</button>
                  </div>
                </div>
              </div>
            </div>

        </div>


      </div>

    </main>
</template>

<script>
    export default {
        data(){
            return {
                 form: new Form({
                    id:'',
                    name : '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            // getProfilePhoto(){
            //     let photo = (this.form.photo.length > 200) ? this.form.photo : "/template/kontributor/img/"+ this.form.photo ;
            //     return photo;
            // },
            getCover(){
                let photo = "/template/kontributor/img/card-1.png" ;
                return photo;
            },
            getCoverCourse(){
                let photo = "/template/kontributor/img/head.png" ;
                return photo;
            },
            getAvatar(){
                let photo = "/template/kontributor/img/users.png" ;
                return photo;
            },
            updateInfo(){
                this.$Progress.start();
                if(this.form.password == ''){
                    this.form.password = undefined;
                }
                this.form.put('api/profile')
                .then(()=>{
                     Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            updateProfile(e){
                let file = e.target.files[0];
                let reader = new FileReader();
                let limit = 1024 * 1024 * 2;
                if(file['size'] > limit){
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file',
                    })
                    return false;
                }
                reader.onloadend = (file) => {
                    this.form.photo = reader.result;
                }
                reader.readAsDataURL(file);
            }
        },
        // created() {
        //     axios.get("api/profile")
        //     .then(({ data }) => (this.form.fill(data)));
        // }
    }
</script>
