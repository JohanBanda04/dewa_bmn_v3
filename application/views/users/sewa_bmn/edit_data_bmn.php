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
                        <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                            <style>
                                #wajib_isi{color:red;}
                            </style>

                            <h4>Edit Data Sewa BMN</h4>


                            <?php
                            //echo "id data: ".$edit_data_bmn->row()->id.'<br>';

                            $cek_status = $this->db->get_where("sb_databmn", array('id'=> $edit_data_bmn->row()->id))->row();
                            //echo "status :". $cek_status->status.'<br>';
                            //echo "foto :". $cek_status->foto.'<br>';

                            //$file = json_decode($cek_status->foto);
                            //echo "size foto : ".count($file);

                            ?>
                            <div class="form-group">
                                <label class="col-lg-12">Kode Barang <b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <input type="text" name="kode_brg" id="kode_brg" class="form-control"
                                           value="<?php echo $edit_data_bmn->row()->kode_brg;?>"
                                           placeholder="Kode barang.." required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12">NUP <b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <input type="number" name="no_urut_pendaftaran" class="form-control"
                                           value="<?php echo $edit_data_bmn->row()->nup;?>"
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
                                                    <option <?php if ($satker->id==$edit_data_bmn->row()->satker_id) { ?>
                                                        selected
                                                    <?php } ?> value="<?php echo $satker->id; ?>"><?php echo $satker->nama_satker; ?></option>
                                                    <?php
                                                }?>
                                            <?php } ?>
                                        </select>
                                    <?php } else { ?>
                                        <select class="form-control default-select2" id="satker_id" name="satker_id"
                                                selected="<?php echo $query->level; ?>" required>
                                            <option value="">- Pilih Satker-</option>
                                            <?php foreach ($satkers->result() as $index=>$satker){ ?>
                                                <?php if ($satker->id==$this->session->userdata('satker_id')){
                                                    ?>
                                                    <option <?php if ($satker->id==$edit_data_bmn->row()->satker_id) { ?>
                                                        selected
                                                    <?php } ?> value="<?php echo $satker->id; ?>"><?php echo $satker->nama_satker; ?></option>
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
                                    <input type="text" name="jenis_brg" class="form-control"
                                           value="<?php echo $edit_data_bmn->row()->jenis_brg; ?>"
                                           placeholder="Jenis Barang.." required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12">Lokasi <b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <input type="text" name="lokasi" class="form-control"
                                           value="<?php echo $edit_data_bmn->row()->lokasi; ?>"
                                           placeholder="Lokasi .." required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12">Luas Total <b id='wajib_isi'>(m<sup>2</sup>)*</b></label>
                                <div class="col-lg-12">
                                    <input type="number" name="luas_total" class="form-control"
                                           value="<?php echo $edit_data_bmn->row()->luas_keseluruhan_bmn; ?>"
                                           placeholder="Luas Total.." required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12">Luas Disewa <b id='wajib_isi'>(m<sup>2</sup>)*</b></label>
                                <div class="col-lg-12">
                                    <input type="number" name="luas_disewa" class="form-control"
                                           value="<?php echo $edit_data_bmn->row()->luas_bmn_disewa; ?>"
                                           placeholder="Luas disewa.." required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12">Tarif Besaran Sewa <b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <input type="text" name="tarif_besaran_sewa" class="form-control"
                                           value="<?php echo ($edit_data_bmn->row()->tarif_besaran_sewa); ?>"
                                           placeholder="Tarif Besaran Sewa.." required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12">Jangka Waktu <b id='wajib_isi'>(bulan)*</b></label>
                                <div class="col-lg-12">
                                    <input type="text" name="jangka_waktu" class="form-control"
                                           value="<?php echo $edit_data_bmn->row()->jangka_waktu; ?>"
                                           placeholder="Jangka Waktu.." required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12">Identitas Penyewa <b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <input type="text" name="identitas_penyewa" class="form-control"
                                           value="<?php echo $edit_data_bmn->row()->identitas_penyewa; ?>"
                                           placeholder="Identitas Penyewa.." required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12">Peruntukann Sewa <b id='wajib_isi'>*</b></label>
                                <div class="col-lg-12">
                                    <input type="text" name="peruntukan_sewa" class="form-control"
                                           value="<?php echo $edit_data_bmn->row()->peruntukan_sewa; ?>"
                                           placeholder="Peruntukan Sewa.." required>
                                </div>
                            </div>




                            <!--surat usulan kanwil-->

                            <div class="form-group" style="background-color: ">
                                <label class="col-lg-11" style="background-color:">Surat Usulan Kanwil</label>
                                <br>
                                <div <?php if ($this->session->userdata('level')=='superadmin'){ ?>
                                    class="col-lg-12"
                                <?php } else if ($this->session->userdata('level')=='kanwil') { ?>
                                    class="col-lg-12"
                                <?php } else { ?>
                                    class="col-lg-12 hidden"
                                <?php } ?> >
                                    <!--sinicuk-->
                                    <input id="surat_usulan_kanwil"
                                           type="file"
                                           value=""
                                           onchange="checkFileExtension_docpdf(id)"
                                           name="surat_usulan_kanwil"
                                           class="form-control"
                                        <?php if($edit_data_bmn->row()->surat_usulan_kanwil == null || $edit_data_bmn->row()->surat_usulan_kanwil =="null" || $edit_data_bmn->row()->surat_usulan_kanwil ==""){ ?>

                                        <?php } ?> >
                                    <small class="lh-1" style="color: red"><i>.pdf .doc .docx</i></small>
                                </div>

                            </div>

                            <div class="">


                                    <li class="col-lg-12" style="display: flex ; background-color:  "
                                        id="">
                                        <div class="form-group col-lg-12 m-b-1" style="justify-content: space-between; overflow: auto">
                                            <a style="text-decoration: none; overflow: hidden" href="<?php echo base_url($edit_data_bmn->row()->surat_usulan_kanwil);?>" target="_blank">
<!--                                                <i class="fa fa-check-square" style=" "></i>-->
                                                <?= explode('/',$edit_data_bmn->row()->surat_usulan_kanwil)[2]??'Belum Terlampir';?>

                                            </a>

                                        </div>
                                    </li>


                            </div>


                            <!--surat usulan sekjen-->
                            <div class="form-group" style="background-color: ">
                                <label class="col-lg-11" style="background-color:">Surat Usulan Sekjen</label>
                                <br>
                                <div <?php if ($this->session->userdata('level')=='superadmin'){ ?>
                                    class="col-lg-12"
                                <?php } else if ($this->session->userdata('level')=='kanwil') { ?>
                                    class="col-lg-12"
                                <?php } else { ?>
                                    class="col-lg-12 hidden"
                                <?php } ?> >
                                    <!--sinicuk-->
                                    <input id="surat_usulan_sekjen"
                                           type="file"
                                           value=""
                                           onchange="checkFileExtension_docpdf(id)"
                                           name="surat_usulan_sekjen"
                                           class="form-control"
                                        <?php if($edit_data_bmn->row()->surat_usulan_sekjen == null || $edit_data_bmn->row()->surat_usulan_sekjen =="null" || $edit_data_bmn->row()->surat_usulan_sekjen ==""){ ?>

                                        <?php } ?> >
                                    <small class="lh-1" style="color: red"><i>.pdf .doc .docx</i></small>
                                </div>

                            </div>

                            <div class="">


                                <li class="col-lg-12" style="display: flex ; background-color:  "
                                    id="">
                                    <div class="form-group col-lg-12 m-b-1" style="justify-content: space-between; overflow: auto">
                                        <a style="text-decoration: none; overflow: hidden" href="<?php echo base_url($edit_data_bmn->row()->surat_usulan_sekjen);?>" target="_blank">
                                            <!--                                                <i class="fa fa-check-square" style=" "></i>-->
                                            <?= explode('/',$edit_data_bmn->row()->surat_usulan_sekjen)[2]??'Belum Terlampir';?>

                                        </a>

                                    </div>
                                </li>


                            </div>

                            <!--surat persetujuan-->
                            <div class="form-group" style="background-color: ">
                                <label class="col-lg-11" style="background-color:">Surat Persetujuan</label>
                                <br>
                                <div <?php if ($this->session->userdata('level')=='superadmin'){ ?>
                                    class="col-lg-12"
                                <?php } else if ($this->session->userdata('level')=='kanwil') { ?>
                                    class="col-lg-12"
                                <?php } else { ?>
                                    class="col-lg-12 hidden"
                                <?php } ?> >
                                    <!--sinicuk-->
                                    <input id="surat_persetujuan"
                                           type="file"
                                           value=""
                                           onchange="checkFileExtension_docpdf(id)"
                                           name="surat_persetujuan"
                                           class="form-control"
                                        <?php if($edit_data_bmn->row()->persetujuan == null || $edit_data_bmn->row()->persetujuan =="null" || $edit_data_bmn->row()->persetujuan ==""){ ?>

                                        <?php } ?> >
                                    <small class="lh-1" style="color: red"><i>.pdf .doc .docx</i></small>
                                </div>

                            </div>

                            <div class="">


                                <li class="col-lg-12" style="display: flex ; background-color:  "
                                    id="">
                                    <div class="form-group col-lg-12 m-b-1" style="justify-content: space-between; overflow: auto">
                                        <a style="text-decoration: none; overflow: hidden" href="<?php echo base_url($edit_data_bmn->row()->persetujuan);?>" target="_blank">
                                            <!--                                                <i class="fa fa-check-square" style=" "></i>-->
                                            <?= explode('/',$edit_data_bmn->row()->persetujuan)[2]??'Belum Terlampir';?>

                                        </a>

                                    </div>
                                </li>


                            </div>

                            <!--surat bukti setor-->
                            <div class="form-group" style="background-color: ">
                                <label class="col-lg-11" style="background-color:">Bukti Setor</label>
                                <br>
                                <div <?php if ($this->session->userdata('level')=='superadmin'){ ?>
                                    class="col-lg-12"
                                <?php } else if ($this->session->userdata('level')=='kanwil') { ?>
                                    class="col-lg-12"
                                <?php } else { ?>
                                    class="col-lg-12 hidden"
                                <?php } ?> >
                                    <!--sinicuk-->
                                    <input id="bukti_setor"
                                           type="file"
                                           value=""
                                           onchange="checkFileExtension_docpdf(id)"
                                           name="bukti_setor"
                                           class="form-control"
                                        <?php if($edit_data_bmn->row()->bukti_setor == null || $edit_data_bmn->row()->bukti_setor =="null" || $edit_data_bmn->row()->bukti_setor ==""){ ?>

                                        <?php } ?> >
                                    <small class="lh-1" style="color: red"><i>.pdf .doc .docx</i></small>
                                </div>

                            </div>

                            <div class="">


                                <li class="col-lg-12" style="display: flex ; background-color:  "
                                    id="">
                                    <div class="form-group col-lg-12 m-b-1" style="justify-content: space-between; overflow: auto">
                                        <a style="text-decoration: none; overflow: hidden" href="<?php echo base_url($edit_data_bmn->row()->bukti_setor);?>" target="_blank">
                                            <!--                                                <i class="fa fa-check-square" style=" "></i>-->
                                            <?= explode('/',$edit_data_bmn->row()->bukti_setor)[2]??'Belum Terlampir';?>

                                        </a>

                                    </div>
                                </li>


                            </div>

                            <!--kontrak-->
                            <div class="form-group" style="background-color: ">
                                <label class="col-lg-11" style="background-color:">Kontrak</label>
                                <br>
                                <div <?php if ($this->session->userdata('level')=='superadmin'){ ?>
                                    class="col-lg-12"
                                <?php } else if ($this->session->userdata('level')=='kanwil') { ?>
                                    class="col-lg-12"
                                <?php } else { ?>
                                    class="col-lg-12 hidden"
                                <?php } ?> >
                                    <!--sinicuk-->
                                    <input id="surat_kontrak"
                                           type="file"
                                           value=""
                                           onchange="checkFileExtension_docpdf(id)"
                                           name="surat_kontrak"
                                           class="form-control"
                                        <?php if($edit_data_bmn->row()->kontrak == null || $edit_data_bmn->row()->kontrak =="null" || $edit_data_bmn->row()->kontrak ==""){ ?>
<!--                                            required-->
                                        <?php } ?> >
                                    <small class="lh-1" style="color: red"><i>.pdf .doc .docx</i></small>
                                </div>

                            </div>

                            <div class="">


                                <li class="col-lg-12" style="display: flex ; background-color:  "
                                    id="">
                                    <div class="form-group col-lg-12 m-b-1" style="justify-content: space-between; overflow: auto">
                                        <a style="text-decoration: none; overflow: hidden" href="<?php echo base_url($edit_data_bmn->row()->kontrak);?>" target="_blank">
                                            <!--                                                <i class="fa fa-check-square" style=" "></i>-->
                                            <?= explode('/',$edit_data_bmn->row()->kontrak)[2]??'Belum Terlampir';?>

                                        </a>

                                    </div>
                                </li>


                            </div>

                            <!--sk penetapan-->
                            <div class="form-group" style="background-color: ">
                                <label class="col-lg-11" style="background-color:">SK Penetapan</label>
                                <br>
                                <div <?php if ($this->session->userdata('level')=='superadmin'){ ?>
                                    class="col-lg-12"
                                <?php } else if ($this->session->userdata('level')=='kanwil') { ?>
                                    class="col-lg-12"
                                <?php } else { ?>
                                    class="col-lg-12 hidden"
                                <?php } ?> >
                                    <!--sinicuk-->
                                    <input id="sk_penetapan"
                                           type="file"
                                           value=""
                                           onchange="checkFileExtension_docpdf(id)"
                                           name="sk_penetapan"
                                           class="form-control"
                                        <?php if($edit_data_bmn->row()->sk_penetapan == null || $edit_data_bmn->row()->sk_penetapan =="null" || $edit_data_bmn->row()->sk_penetapan ==""){ ?>
<!--                                            required-->
                                        <?php } ?> >
                                    <small class="lh-1" style="color: red"><i>.pdf .doc .docx</i></small>
                                </div>

                            </div>

                            <div class="">


                                <li class="col-lg-12" style="display: flex ; background-color:  "
                                    id="">
                                    <div class="form-group col-lg-12 m-b-1" style="justify-content: space-between; overflow: auto">
                                        <a style="text-decoration: none; overflow: hidden" href="<?php echo base_url($edit_data_bmn->row()->sk_penetapan);?>" target="_blank">
                                            <!--                                                <i class="fa fa-check-square" style=" "></i>-->
                                            <?= explode('/',$edit_data_bmn->row()->sk_penetapan)[2]??'Belum Terlampir';?>

                                        </a>

                                    </div>
                                </li>


                            </div>



                            <!--sinicuyyy-->
                            <div class="form-group" style="background-color: ">
                                <!--                        <label class="fw-500">Upload File SK / SP / Nodin / Undangan / Paparan / data pendukung lainnya</label>-->
                                <label class="col-lg-11" style="background-color:  ">Foto-foto</label>
                                <br>

                                <button onclick="addFile(<?= $edit_data_bmn->row()->id; ?>)"
                                        class="<?php if($status=="selesai"){ ?> hidden <?php } ?> btn btn-success m-l-15"
                                        id="add-more-edit-<?php echo $edit_data_bmn->row()->id; ?>" type="button"
                                        style="background-color: ">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Fotos
                                </button>
                                <div id="show-file-list-<?= $edit_data_bmn->row()->id; ?>"></div>

                                <div id="auth-rows"></div>
                            </div>
                            <input type="hidden" value="<?php echo $edit_data_bmn->row()->foto;?>" name="foto_foto">
                            <input type="hidden" value="<?php echo $edit_data_bmn->row()->id;?>" name="id_databmn">


                            <div class="">

                                <?php
                                /*NAH INI DIAA UNTUK TAMPILKAN MULTIPLE DATA*/
                                $files = json_decode($edit_data_bmn->row()->foto);

                                foreach ($files as $key=>$file){ ?>
                                    <li class="col-lg-12" style="display: flex ; background-color:  "
                                        id="list-file-<?=$key ?>-<?= $edit_data_bmn->row()->id; ?>">
                                        <div class="form-group col-lg-12 m-b-1" style="justify-content: space-between; overflow: auto">
                                            <a style="text-decoration: none" href="<?= base_url($file); ?>" target="_blank">
                                                <!--                                                <i class="fa fa-check-square m-l-0" style="margin-right: 10px"></i>-->
                                                <?php echo explode("/", $file)[2]; ?>
                                            </a>
                                            <a style="" href="javascript:;"
                                               class="<?php if ($status=="selesai"){ ?> hidden <?php }?> td-n c-red-500 cH-blue-500 fsz-md p-5 pull-right"
                                               onclick="deleteFile('<?php echo $file;?>',<?= $key?>, <?= $edit_data_bmn->row()->id; ?>)">
                                                <i class="fa fa-trash btn btn-danger"></i>
                                            </a>


                                        </div>
                                    </li>
                                <?php  }
                                ?>

                            </div>
                            <hr>

                            <!--sampai sini-->
                            <div class="form-group" style="margin-left: 2pt" >
                                <div class="g-recaptcha" data-sitekey="6LdJ0pAmAAAAAI7vU7S3seu7_Wt9AnJCINpeceU_"
                                     style="width: 40px">

                                </div>
                            </div>

                            <div class="text-right ">
                                <a href="sewabmn/sewa/<?= hashids_encrypt($edit_data_bmn->row()->satker_id);?>"
                                        class="m-t-20 btn btn-warning cur-p float-left"
                                        data-dismiss="modal"
                                        name="">
                                    Kembali
                                </a>



                                <input style="float:right;" type="submit" id="btnsimpan_update"
                                       name="btnsimpan_update" class="m-l-10 m-t-20 btn btn-primary " value="Update Data" />
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- /dashboard content -->
        <script type="text/javascript">
            // $('.clockpicker').clockpicker();

            $( document ).ready(function() {
                console.log( "ready!" );

                //$('#lamp_surat_permohonan_edit').prop('required', true);
                //$('#draft_harmonisasi_edit').prop('required', true);
                //$('#naskah_akademik_edit').prop('required', false);



            });


            var count = 0;

            function checkSelectedFileDocOnly_edit(id) {


                fileName = document.querySelector('#' + id).value;
                extension = fileName.split('.').pop();


                if( document.getElementById(id).files.length == 0 ){
                    console.log("no files selected");
                    $('#'+id).prop('required', false);
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
                            $('#'+id).prop('required',false);
                        }


                    } else {
                        alert("ekstensi file harus DOC, atau DOCX");

                        document.querySelector('#' + id).value = '';
                        $('#'+id).prop('required',false);
                    }



                }

            }

            function checkFileExtension_docpdf(id) {
                fileName = document.querySelector('#'+id).value;
                extension = fileName.split('.').pop();

                if(extension != "pdf" && extension != "doc" && extension != "docx"){
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
            
            function checkFileExtension_edit(id) {
                fileName = document.querySelector('#'+id).value;
                extension = fileName.split('.').pop();

                if(extension != "jpg" && extension != "jpeg" && extension != "png"){
                    alert("ekstensi file harus JPG, JPEG, atau PNG");

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

            function removeFile(element){
                console.log("xxxx");
                document.getElementById(element).remove();
            }

            function addFile($row_id){
                console.log($row_id);
                let elementId = "input-file-element-"+count;
                let divId = "input-dinamis-edit-"+count;
                var html4 = '<div class="form-group input-dinamis m-20" id="'+divId+'">' +
                    '<div class="row">' +
                    '<div class="col-input-dinamis col-lg-10 ">' +
                    '<input type="file" name="url_files[]" class="form-control border-grey" ' +
                    'id="'+elementId+'" onchange="checkFileExtension_edit('+"'"+elementId+"'"+')" ' +
                    'placeholder="Upload file" required>' +
                    '</div>' +
                    '<div class="col-input-dinamis col-lg-2">' +
                    '<button class="btn btn-danger remove-edit" ' +
                    'onclick="removeFile('+"'"+divId+"'"+')" type="button">' +
                    '<i class="fa fa-minus-circle"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $('#show-file-list-'+$row_id).append(html4);
                count++;
            }

            $(function () {
                $('#input-file-element-').change(function(event){
                    console.log(event.target.files[0].name);
                    if(event.target.files[0].name!=""){
                        // $.post("sewabmn/sewa/zona/ubah_status",{
                        //
                        //     exist : 'true',
                        // })
                    }
                });
            })

            $("#add-more").click(function(e){

                var html3 = '<div class="form-group input-dinamis m-20">' +
                    '<div class="row">' +
                    '<div class="col-input-dinamis col-lg-10 ">' +
                    '<input type="file" name="url_files[]" class="form-control border-grey" ' +
                    'id="peserta" placeholder="Upload file" required>' +
                    '</div>' +
                    '<div class="col-input-dinamis col-lg-2">' +
                    '<button class="btn btn-danger remove" type="button">' +
                    '<i class="fa fa-minus-circle"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                $('#auth-rows').append(html3);
            });

            $('#auth-rows').on('click', '.remove', function(e){
                e.preventDefault();
                $(this).parents('.input-dinamis').remove();
            });


            function deleteFile($path,$file_id,$row_id){
                // $path = nama file;
                // $file_id = index file dari record db;
                // $row_id= id unique;
                // confirm("Hapus File?",);
                if (confirm("Hapus File Lampiran?") == true) {
                    $.post("sewabmn/sewa/zona/df",{

                        path : $path,
                        file_id : $file_id,
                        id : $row_id,
                    }).done(function (response) {
                        // console.log(response);
                        console.log($path+" "+$file_id+" "+$row_id);
                        $("#list-file-"+$file_id+"-"+$row_id).remove();
                        //location.reload();
                    });
                }

                // alert("tesss");

            }

            $(document).on('click', '#btnsimpan_update', function() {
                var response = grecaptcha.getResponse();
                if (response.length == 0) {
                    alert("Please verify you are not a robot.");
                    return false;
                }
            });

        </script>
