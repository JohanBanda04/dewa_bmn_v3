<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><?php echo $judul_web; ?></h4>
            </div>
            <div class="panel-body">
                <?php
                echo $this->session->flashdata('msg');
                $link4 = strtolower($this->uri->segment(4));
                ?>
                <form class="form-horizontal" action="" data-parsley-validate="true" method="post"
                      enctype="multipart/form-data">
                  <style>
                    #wajib_isi{color:red;}
                  </style>

                  <h4>Informasi Data Sewa BMN</h4>
                    <div class="form-group">
                      <label class="col-lg-12">Kode Barang <b id='wajib_isi'>*</b></label>
                      <div class="col-lg-12">
                        <input type="text" name="kode_brg" id="kode_brg" class="form-control" value=""
                               placeholder="Kode barang.." required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-12">NUP <b id='wajib_isi'>*</b></label>
                      <div class="col-lg-12">
                        <input type="number" name="no_urut_pendaftaran" class="form-control" value=""
                               placeholder="Nomor Urut Pendaftaran.." required>
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-11">Satker <b id='wajib_isi'>*</b></label>
                        <div class="col-lg-12">
                            <?php if ($this->session->userdata('id_user')=='1' or $this->session->userdata('id_user')=='18') { ?>
                                <select class="form-control default-select2" id="satker_id" name="satker_id"
                                        selected="<?php echo $query->level; ?>" required>
                                    <option value="">- Pilih Satker-</option>
                                    <?php foreach ($satkers->result() as $index=>$satker){ ?>
                                        <?php if ($satker->id!='17'){
                                            ?>
                                            <option value="<?php echo $satker->id; ?>"><?php echo $satker->nama_satker; ?></option>
                                            <?php
                                        }?>
                                    <?php } ?>
                                </select>
                                <?php } else  { ?>
                                <select class="form-control default-select2" id="satker_id" name="satker_id"
                                        selected="<?php echo $query->level; ?>" required>
                                    <option value="">- Pilih Satker-</option>
                                    <?php foreach ($satkers->result() as $index=>$satker){ ?>
                                        <?php if ($satker->id==$this->session->userdata('satker_id')){
                                            ?>
                                            <option value="<?php echo $satker->id; ?>"><?php echo $satker->nama_satker; ?></option>
                                            <?php
                                        }?>
                                    <?php } ?>
                                </select>
                            <?php } ?>

                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-lg-12">Jenis Barang <b id='wajib_isi'>*</b></label>
                        <div class="col-lg-12">
                            <input type="text" name="jenis_brg" class="form-control" value=""
                                   placeholder="Jenis Barang.." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12">Lokasi <b id='wajib_isi'>*</b></label>
                        <div class="col-lg-12">
                            <input type="text" name="lokasi" class="form-control" value=""
                                   placeholder="Lokasi .." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12">Luas Total <b id='wajib_isi'>(m<sup>2</sup>)*</b></label>
                        <div class="col-lg-12">
                            <input type="number" name="luas_total" class="form-control" value=""
                                   placeholder="Luas Total.." required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-12">Luas Disewa <b id='wajib_isi'>(m<sup>2</sup>)*</b></label>
                        <div class="col-lg-12">
                            <input type="number" name="luas_disewa" class="form-control" value=""
                                   placeholder="Luas disewa.." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12">Tarif Besaran Sewa <b id='wajib_isi'>*</b></label>
                        <div class="col-lg-12">
                            <input type="text" name="tarif_besaran_sewa" class="form-control" value=""
                                   placeholder="Tarif Besaran Sewa.." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12">Jangka Waktu <b id='wajib_isi'>(bulan)*</b></label>
                        <div class="col-lg-12">
                            <input type="text" name="jangka_waktu" class="form-control" value=""
                                   placeholder="Jangka Waktu.." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12">Identitas Penyewa <b id='wajib_isi'>*</b></label>
                        <div class="col-lg-12">
                            <input type="text" name="identitas_penyewa" class="form-control" value=""
                                   placeholder="Identitas Penyewa.." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12">Peruntukan Sewa <b id='wajib_isi'>*</b></label>
                        <div class="col-lg-12">
                            <input type="text" name="peruntukan_sewa" class="form-control" value=""
                                   placeholder="Peruntukan Sewa.." required>
                        </div>
                    </div>



                    <div class="form-group">
                      <label class="col-lg-12">Surat Usulan Kanwil</label>
                      <div class="col-lg-12">
                        <input id="surat_usulan_kanwil"
                               type="file"
                               onchange="checkSelectedFileNotRequired(id)"
                               name="surat_usulan_kanwil" class="form-control">
                          <small class="lh-1" style="color: red"><i>.pdf .doc .docx (*wajib)</i></small>
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12">Surat Usulan Sekjen</label>
                        <div class="col-lg-12">
                            <input id="surat_usulan_sekjen"
                                   type="file"
                                   onchange="checkSelectedFileNotRequired(id)"
                                   name="surat_usulan_sekjen" class="form-control">
                            <small class="lh-1" style="color: red"><i>.pdf .doc .docx (*wajib)</i></small>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-lg-12">Surat Persetujuan</label>
                        <div class="col-lg-12">
                            <input id="surat_persetujuan"
                                   type="file"
                                   onchange="checkSelectedFileNotRequired(id)"
                                   name="surat_persetujuan" class="form-control">
                            <small class="lh-1" style="color: red"><i>.pdf .doc .docx (*wajib)</i></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12">Bukti Setor</label>
                        <div class="col-lg-12">
                            <input id="bukti_setor"
                                   type="file"
                                   onchange="checkSelectedFileNotRequired(id)"
                                   name="bukti_setor" class="form-control">
                            <small class="lh-1" style="color: red"><i>.pdf .doc .docx (*wajib)</i></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12">Kontrak</label>
                        <div class="col-lg-12">
                            <input id="kontrak"
                                   type="file"
                                   onchange="checkSelectedFileNotRequired(id)"
                                   name="kontrak" class="form-control">
                            <small class="lh-1" style="color: red"><i>.pdf .doc .docx (*wajib)</i></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12">SK Penetapan</label>
                        <div class="col-lg-12">
                            <input id="surat_penetapan"
                                   type="file"
                                   onchange="checkSelectedFileNotRequired(id)"
                                   name="surat_penetapan" class="form-control">
                            <small class="lh-1" style="color: red"><i>.pdf .doc .docx (*wajib)</i></small>
                        </div>
                    </div>



                    <div class="form-group" style="background-color: ">
                        <!--                        <label class="fw-500">Upload File SK / SP / Nodin / Undangan / Paparan / data pendukung lainnya</label>-->
                        <label class="col-lg-12 " style="background-color:  ">Foto</label>
                        <br>
                        <button class="btn btn-success m-l-15" id="add-more" type="button"
                                style="background-color: ">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Foto
                        </button>
                        <small class="lh-1" style="color: red"><i>.jpeg .jpg .png (*opsional)</i></small>

                        <div id="auth-rows"></div>
                    </div>



                    <div class="form-group " style="margin-left: 2pt" >
                        <div class="g-recaptcha" data-sitekey="6LdJ0pAmAAAAAI7vU7S3seu7_Wt9AnJCINpeceU_"
                             style="width: 40px">

                        </div>
                    </div>


                  <hr>



                  <!--<a href="<?php /*echo strtolower($this->uri->segment(1)); */?>/<?php /*echo strtolower($this->uri->segment(2)); */?>.html"
                     class="btn btn-default">
                      << Kembali
                  </a>-->
<!--                  <button type="submit" name="btnsimpan" class="btn btn-primary" style="float:right;">Kirim</button>-->
                    <input style="float:right;" type="submit" id="btnsimpan" name="btnsimpan" class="btn btn-primary" value="Simpan" />
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
      <script type="text/javascript">
          $( document ).ready(function() {
              console.log( "ready!" );

              $('#lamp_surat_permohonan').prop('required', true);
              //$('#surat_usulan_kanwil').prop('required', true);

              $('#naskah_akademik_dll').prop('required', false);
              $('#draft_harmonisasi').prop('required', true);


          });
          // $('.clockpicker').clockpicker();

          function checkSelectedFileOptional(id) {


              fileName = document.querySelector('#' + id).value;
              extension = fileName.split('.').pop();


              if( document.getElementById(id).files.length == 0 ){
                  console.log("no files selected");
                  $('#'+id).prop('required', false);
                  // $('.text-field').prop('required',true);
              } else {
                  console.log("there are files selected");
                  // $('#'+id).prop('required',false);

                  if(extension != 'pdf' && extension != 'doc' && extension!='docx'){
                      alert("ekstensi file harus PDF, DOC, atau DOCX");

                      document.querySelector('#' + id).value = '';
                      $('#'+id).prop('required',false);
                  } else {
                      const oFile = document.getElementById(id).files[0];
                      console.log(id);
                      console.log(oFile);
                      $('#'+id).prop('required',false);

                      if (oFile.size > 5*1024*1024) // 500Kb for bytes.
                      {
                          alert("size file terlalu besar");

                          document.querySelector('#' + id).value = '';
                          $('#'+id).prop('required',false);
                      }
                  }



              }

          }

          function checkSelectedFileDocOnly(id) {


              fileName = document.querySelector('#' + id).value;
              extension = fileName.split('.').pop();


              if( document.getElementById(id).files.length == 0 ){
                  console.log("no files selected");
                  $('#'+id).prop('required', true);
                  // $('.text-field').prop('required',true);
              } else {
                  console.log("there are files selected");
                  // $('#'+id).prop('required',false);

                  if(extension == 'doc' || extension=='docx'){

                      const oFile = document.getElementById(id).files[0];
                      console.log(id);
                      console.log(oFile);
                      $('#'+id).prop('required',false);

                      if (oFile.size > 5*1024*1024) // 500Kb for bytes.
                      {
                          alert("size file terlalu besar");

                          document.querySelector('#' + id).value = '';
                          $('#'+id).prop('required',true);
                      }


                  } else {
                      alert("ekstensi file harus DOC, atau DOCX");

                      document.querySelector('#' + id).value = '';
                      $('#'+id).prop('required',true);
                  }



              }

          }


          function checkSelectedFile(id) {


              fileName = document.querySelector('#' + id).value;
              extension = fileName.split('.').pop();


              if( document.getElementById(id).files.length == 0 ){
                  console.log("no files selected");
                  $('#'+id).prop('required', true);

              } else {
                  console.log("there are files selected");

                  if(extension != 'pdf' && extension != 'doc' && extension!='docx'){
                      alert("ekstensi file harus PDF, DOC, atau DOCX");

                      document.querySelector('#' + id).value = '';
                      $('#'+id).prop('required',true);
                  } else {
                      const oFile = document.getElementById(id).files[0];
                      console.log(id);
                      console.log(oFile);
                      $('#'+id).prop('required',false);

                      /*disini penentuan ukuran file*/
                      if (oFile.size > (5*(1024*1024))) // 500Kb for bytes.
                      {
                          alert("size file terlalu besar");

                          document.querySelector('#' + id).value = '';
                          $('#'+id).prop('required',true);
                      }
                  }



              }

          }
          function checkSelectedFileNotRequired(id) {


              fileName = document.querySelector('#' + id).value;
              extension = fileName.split('.').pop();


              if( document.getElementById(id).files.length == 0 ){
                  console.log("no files selected");
                  //sama saja dihilangin required ny ataupun dijadikan false
                  //$('#'+id).prop('required', false);

              } else {
                  console.log("there are files selected");

                  if(extension != 'pdf' && extension != 'doc' && extension!='docx'){
                      alert("ekstensi file harus PDF, DOC, atau DOCX");

                      document.querySelector('#' + id).value = '';
                      //$('#'+id).prop('required',false);
                  } else {
                      const oFile = document.getElementById(id).files[0];
                      console.log(id);
                      console.log(oFile);
                      //$('#'+id).prop('required',false);

                      /*disini penentuan ukuran file*/
                      if (oFile.size > (5*(1024*1024))) // 500Kb for bytes.
                      {
                          alert("size file terlalu besar");

                          document.querySelector('#' + id).value = '';
                          //$('#'+id).prop('required',true);
                      }
                  }



              }

          }

          function checkSelectedFileImageOnly(id) {


              fileName = document.querySelector('#' + id).value;
              extension = fileName.split('.').pop();


              if( document.getElementById(id).files.length == 0 ){
                  console.log("no files selected");
                  $('#'+id).prop('required', true);

              } else {
                  console.log("there are files selected");

                  if(extension != 'jpg' && extension != 'jpeg' && extension!='png'){
                      alert("ekstensi file harus JPG, JPEG, atau PNG");

                      document.querySelector('#' + id).value = '';
                      $('#'+id).prop('required',true);
                  } else {
                      const oFile = document.getElementById(id).files[0];
                      console.log(id);
                      console.log(oFile);
                      $('#'+id).prop('required',false);

                      /*disini penentuan ukuran file*/
                      if (oFile.size > (5*(1024*1024))) // 500Kb for bytes.
                      {
                          alert("size file terlalu besar");

                          document.querySelector('#' + id).value = '';
                          $('#'+id).prop('required',true);
                      }
                  }



              }

          }

          //cara cek file extension dari zanul
          function checkFileExtension(id) {

              //alert(id);
              fileName = document.querySelector('#' + id).value;

              extension = fileName.split('.').pop();
              //alert(extension);
              if (extension != 'pdf' && extension != 'doc' && extension!='docx') {
                  alert("ekstensi file harus PDF, DOC, atau DOCX");

                  document.querySelector('#' + id).value = '';
              }

              const oFile = document.getElementById(id).files[0];
              console.log(id);
              console.log(oFile);

              if (oFile.size > 5*1024*1024) // 500Kb for bytes.
              {
                  alert("size file terlalu besar");

                  document.querySelector('#' + id).value = '';
              }

          }

          var counter = 0;

          $("#add-more").click(function(e){
              var html3 = '<div class="form-group input-dinamis m-20"><div class="row">' +
                  '<div class="col-input-dinamis col-lg-10">' +
                  '<input type="file" name="url_files[]" class="form-control border-grey" ' +
                  'id="peserta'+counter+'" onchange="checkSelectedFileImageOnly(id)" ' +
                  'placeholder="Upload file" required>' +
                  '</div>' +
                  '<div class="col-input-dinamis col-lg-2">' +
                  '<button class="btn btn-danger remove" type="button"><i class="fa fa-minus-circle"></i><' +
                  '/button>' +
                  '</div>' +
                  '</div>' +
                  '</div>';


              $('#auth-rows').append(html3);
              counter++;
          });

          // $("#add-more").click(function(e){
          //
          //     var html3 = '<div class="form-group input-dinamis m-20">' +
          //         '<div class="row">' +
          //         '<div class="col-input-dinamis col-lg-10 ">' +
          //         '<input type="file" name="url_files[]" class="form-control border-grey" id="peserta" placeholder="Upload file" required>' +
          //         '</div>' +
          //         '<div class="col-input-dinamis col-lg-2"><button class="btn btn-danger remove" type="button">' +
          //         '<i class="fa fa-minus-circle">' +
          //         '</i></button>' +
          //         '</div>' +
          //         '</div>' +
          //         '</div>';
          //
          //     $('#auth-rows').append(html3);
          // });

          $('#auth-rows').on('click', '.remove', function(e){
              e.preventDefault();
              $(this).parents('.input-dinamis').remove();
          });

          $(document).on('click', '#btnsimpan', function() {
              var response = grecaptcha.getResponse();
              if (response.length == 0) {
                  alert("Please verify you are not a robot.");
                  return false;
              }
          });



          $('#auth-rows').on('click', '.remove', function(e){
              e.preventDefault();
              $(this).parents('.input-dinamis').remove();
          });



      </script>
