<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link3_not_lowercae = $this->uri->segment(3);
$link4 = strtolower($this->uri->segment(4));
$link5 = strtolower($this->uri->segment(5));

$zona_doc = explode('_',$link3);
$zona_document =  $zona_doc[1]."_".$zona_doc[2];

?>
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="dashboard.html">Dashboard</a></li>

        <li class="active"><?php echo $judul_web; ?></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header"> <small><?php echo $judul_web; ?></small></h1>
    <!-- end page-header -->
    <?php


    ?>
    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <?php
            echo $this->session->flashdata('msg');
            $level 	= $this->session->userdata('level');
            $link3  = strtolower($this->uri->segment(3));
            ?>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Data Sewa Barang Milik Negara</h4>

                </div>
                <div class="panel-body">
                    <a  href="<?php echo $link1; ?>/<?php echo $link2; ?>/<?= $link3_not_lowercae; ?>/t.html"
                        <?php if($this->session->userdata('level')=='satker') { ?>
                            class="hidden btn btn-primary"
                        <?php } ?> class="btn btn-primary" ><i
                                class="fa fa-plus-circle"></i> Tambah Dokumen</a>
<!--                            --><?//= $zona_document; ?>
<!--                    <a href="harmonisasi/v/t.html">-->
<!--                        <i class="fa fa-plus-square bg-gray"></i>-->
<!--                        <span>Tambah Dokumen</span>-->
<!--                    </a>-->
                    <hr>
                    <div class="row">
                        <div class="col-md-12"><b>Filter</b></div>
                        <div class="col-md-3">
<!--                            'belum_diproses','perbaikan','draft_sedang_dibuat','menunggu_koreksi','selesai'-->
                            <!--'belum_diproses','perbaikan','draft_sedang_dibuat','menunggu_koreksi','selesai'-->
                            <select class="form-control default-select2" id="stt" onchange="window.location.href='sewabmn/sewa/<?= $link3_not_lowercae; ?>/id/'+this.value;">
                                <option value="semua" <?php if('semua'==$link5){ ?> selected <?php }?> >- Semua -</option>
                                <option value="dokumen_lengkap" <?php if('dokumen_lengkap'==$link5){echo "selected";} ?> >Dokumen Lengkap</option>
                                <option value="dokumen_belum_lengkap" <?php if('dokumen_belum_lengkap'==$link5){echo "selected";} ?> >Dokumen Belum Lengkap</option>
<!--                                <option value="selesai" --><?php //if('selesai'==$link5){echo "selected";} ?><!-- >Selesai</option>-->
                            </select>
                        </div>
                        <div class="col-md-1 hidden">
                            <button class="btn btn-default" onclick="window.location.href='pemda/v2/pemprov_ntb/id/'+$('#stt').val();"><i class="fa fa-search"></i> Filter</button>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-2">
                            <?php if ($level=='pelaksana'): ?>
                                <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/t.html" class="btn btn-primary" style="float:right;">Tambah Bahan Berita</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th >Nomor.</th>
                                <th >Kode Brg</th>
                                <th>NUP</th>
                                <th>Status</th>
                                <th>Jenis Barang</th>
                                <th>Lokasi</th>
                                <th>Luas Total (m<sup>2</sup>)</th>
                                <th>Luas Disewa (m<sup>2</sup>)</th>
                                <th>Tarif</th>
                                <th>Jangka Waktu <sup>(bulan)</sup></th>
                                <th>Identitas Penyewa</th>
                                <th>Peruntukan Sewa</th>
                                <th width="20%" style="text-align: center">Aksi</th>
<!--                                <th width="" style="text-align: center">Hapus</th>-->
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $no=1;
                            foreach ($query->result() as $index=>$baris):?>

                                <tr>
                                    <td><b><?php echo $no++; ?>.</b>  </td>
                                    <td><?php echo $baris->kode_brg; ?></td>
                                    <td><?php echo $baris->nup; ?></td>
                                    <td><?php echo $this->Mcrud->cek_status_berita($baris->status) ; ?></td>
                                    <td><?php echo $baris->jenis_brg; ?></td>
                                    <td><?php echo $baris->lokasi; ?></td>
                                    <td><?php echo $baris->luas_keseluruhan_bmn; ?></td>
                                    <td><?php echo $baris->luas_bmn_disewa; ?></td>
                                    <td><?php echo number_format($baris->tarif_besaran_sewa); ?></td>
                                    <td><?php echo $baris->jangka_waktu; ?></td>
                                    <td><?php echo $baris->identitas_penyewa; ?></td>
                                    <td><?php echo $baris->peruntukan_sewa; ?></td>
                                    <?php
                                    $explode_all = explode(' ', $this->Mcrud->tgl_id($baris->tgl_input));
                                    $explode_date_only = explode('-', $explode_all[0]);

                                    $tgl_indonesia = $explode_date_only[2]."-".$explode_date_only[1]."-".$explode_date_only[0];
                                    ?>


                                    <td align="center">


                                        <a
                                                href=""
                                                class="btn btn-info btn-xs"
                                                data-toggle="modal" title="Lihat Detail Sewa"
                                                data-target="#detail_sewa_bmn<?php echo $baris->id; ?>">
                                            <i class="fa fa-info-circle"></i>
                                        </a>


                                        <a
                                                href=""
                                                <?php if ($this->session->userdata('level')=='satker'){ ?>
                                                    class="hidden btn btn-danger btn-xs"
                                                <?php } ?>class="btn btn-danger btn-xs"
                                                data-toggle="modal" title="Hapus Data Sewa BMN"
                                                data-target="#delete_confirm<?php echo $baris->id; ?>"
                                        ><i class="fa fa-trash-o"></i
                                            ></a>

                                        <!--dari sini di hidden , jangan dihiraukan-->
                                        <a
                                                href=""
                                                class="hidden btn btn-success btn-xs"
                                                data-toggle="modal"
                                                data-target="#edit_draft_berita<?php echo $baris->id_draft_permohonan; ?>"
                                        ><i class="fa fa-edit"></i
                                            ></a>
                                        <!--sampai sini di hidden-->

                                        <a title="Edit Data Sewa BMN" href="sewabmn/sewa/<?= $link3_not_lowercae; ?>/ce/<?= hashids_encrypt($baris->id);?>"
                                           <?php if ($this->session->userdata('level')=='superadmin') { ?>
                                               class="btn btn-warning btn-xs"
                                           <?php } else if($this->session->userdata('level')=='kanwil'){ ?>
                                               class="btn btn-warning btn-xs"
                                           <?php } else { ?>
                                               class="hidden btn btn-success btn-xs"
                                           <?php } ?> >
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!--sementara tombol edit oleh kanwil di hidden, krn belum dikelola kelanjutannya-->
                                        <a  title="Edit oleh Kanwil" href="pemda/draft/<?= $link3_not_lowercae; ?>/ce_kasub_perancang/<?= hashids_encrypt($baris->id);?>"
                                            <?php if ($this->session->userdata('level')=='superadmin') { ?>
                                                class="hidden btn btn-success btn-xs"
                                            <?php } else if($this->session->userdata('level')=='kanwil'){ ?>
                                                class="hidden btn btn-success btn-xs"
                                            <?php } else { ?>
                                                class="hidden btn btn-success btn-xs"
                                            <?php } ?> >
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!--sementara tombol edit oleh satker di hidden, krn belum dikelola kelanjutannya-->
                                        <a title="Edit oleh Satker" href="pemda/draft/<?= $link3_not_lowercae; ?>/ce_perancang/<?= hashids_encrypt($baris->id);?>"
                                            <?php if ($this->session->userdata('level')=='superadmin') { ?>
                                                class="hidden btn btn-primary btn-xs"
                                            <?php } else if($this->session->userdata('level')=='kanwil'){ ?>
                                                class="hidden btn btn-primary btn-xs"
                                            <?php } else if ($this->session->userdata('level')=='satker'){ ?>
                                                class="hidden btn btn-primary btn-xs"
                                            <?php } ?> >
                                            <i class="fa fa-edit"></i>
                                        </a>

<!--                                        <a href="--><?php //echo $link1; ?><!--/v/e/--><?php //echo hashids_encrypt($baris->id_berita); ?><!--/pemprov_ntb"-->
<!--                                           class="btn btn-success btn-xs" title="Edit">-->
<!--                                            <i class="fa fa-edit"></i>-->
<!--                                        </a>-->

                                    </td>



                                </tr>
                                <div class="modal fade" id="delete_confirm<?php echo $baris->id; ?>">
                                    <div class="modal-dialog" role="document">
<!--                                        --><?//= $zona_document; ?>
                                        <div class="modal-content">
                                            <div class="bd p-15"><h5 class="m-0">Hapus Data</h5></div>
                                            <div class="modal-body">
<!--                                                <form method="POST" action="pemda/v/h">-->
                                                <!--kunci kesuksesan contoh cara kirim action menuju controller tertentu dengan form-->
                                                <form method="POST" action="<?php echo $link1; ?>/<?php echo $link2; ?>/<?php echo $link3_not_lowercae; ?>/h">
                                                    <input type="hidden" value="<?php echo $baris->id; ?>" name="id_databmn" />
                                                    <div>Apakah Anda yakin akan menghapus data draft raperda <?= ucfirst($cek_nama_panjang_zona->result()[0]->nama_panjang);?> ini?</div>
                                                    <hr>
                                                    <div class="text-right">
                                                        <button
                                                                class="btn btn-primary cur-p float-left"
                                                                data-dismiss="modal"
                                                                name="">Tidak
                                                        </button>
                                                        <button class="btn btn-danger cur-p"
                                                                name="">Ya
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="detail_sewa_bmn<?php echo $baris->id; ?>">

                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title" style="color: #110f76">Detail Dokumen Sewa BMN</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-horizontal">
                                                    <span style="font-weight: bold; font-size: 15px">Kode Barang :</span>
                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->kode_brg; ?></span>

                                                    <br>
                                                    <div style="height: 15px"></div>

                                                    <!---->
                                                    <span style="font-weight: bold; font-size: 15px">Nomor Urut Pendaftaran</span>
                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->nup; ?></span>

                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <!---->

                                                    <!---->
                                                    <span style="font-weight: bold; font-size: 15px">Status Dokumen</span>
                                                    <br>
                                                    <div style="height: 15px"></div>

                                                    <span style="font-weight: normal; font-size: 15px">
                                                        <?php echo ucfirst(explode('_',$baris->status)[0])." ".ucfirst(explode('_',$baris->status)[1])." ".ucfirst(explode('_',$baris->status)[2])??'' ?></span>

                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <!---->

                                                    <!---->
                                                    <span style="font-weight: bold; font-size: 15px">Jenis Barang</span>
                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->jenis_brg; ?></span>

                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <!---->

                                                    <!---->
                                                    <span style="font-weight: bold; font-size: 15px">Lokasi</span>
                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->lokasi; ?></span>

                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <!---->

                                                    <!---->
                                                    <span style="font-weight: bold; font-size: 15px">Luas Total BMN</span>
                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->luas_keseluruhan_bmn; ?> <span style="font-weight: bold">m<sup>2</sup></span>

                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <!---->

                                                    <!---->
                                                    <span style="font-weight: bold; font-size: 15px">Luas BMN Disewa</span>
                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->luas_bmn_disewa; ?> <span style="font-weight: bold">m<sup>2</sup></span>

                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <!---->

                                                    <!---->
                                                    <span style="font-weight: bold; font-size: 15px">Jangka Waktu</span>
                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->jangka_waktu; ?> <span style="font-weight: bold">bulan</span>

                                                    <br>
                                                    <div style="height: 15px"></div>
                                                     <!---->

                                                    <!---->
                                                    <span style="font-weight: bold; font-size: 15px">Identitas Penyewa</span>
                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->identitas_penyewa; ?>

                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <!---->

                                                    <!---->
                                                    <span style="font-weight: bold; font-size: 15px">Peruntukan Sewa</span>
                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <span style="font-weight: normal; font-size: 15px"><?= $baris->peruntukan_sewa; ?>

                                                    <br>
                                                    <div style="height: 15px"></div>
                                                    <!---->
                                                    <!--cuyyy-->

                                                    <!---->
                                                    <span style="font-weight: bold; font-size: 15px">Surat Usulan Kanwil :</span>
                                                    <br>
                                                    <div style="height: 15px"></div>

                                                    <div class="form-group col-lg-12" style="justify-items: end; background-color: ">
                                                        <div class="row m-l-1" style=" overflow: hidden;  ">
                                                            <a style="text-decoration: none" href="<?php echo base_url($baris->surat_usulan_kanwil);?>" target="_blank">
                                                                <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                                                <?= explode('/',$baris->surat_usulan_kanwil)[2]??'Belum Terlampir';?>

                                                            </a>
                                                        </div>

                                                    </div>

                                                    <br>

                                                    <div style="height: 15px"></div>
                                                    <!---->

                                                    <!---->
                                                    <span style="font-weight: bold; font-size: 15px">Surat Usulan Sekjen :</span>
                                                    <br>
                                                    <div style="height: 15px"></div>

                                                    <div class="form-group col-lg-12" style="justify-items: end; background-color: ">
                                                        <div class="row m-l-1" style=" overflow: hidden;  ">
                                                            <a style="text-decoration: none" href="<?php echo base_url($baris->surat_usulan_sekjen);?>" target="_blank">
                                                                <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                                                <?= explode('/',$baris->surat_usulan_sekjen)[2]??'Belum Terlampir';?>

                                                            </a>
                                                        </div>

                                                    </div>

                                                    <br>

                                                    <div style="height: 15px"></div>
                                                    <!---->

                                                    <!---->
                                                    <span style="font-weight: bold; font-size: 15px">Surat Persetujuan :</span>
                                                    <br>
                                                    <div style="height: 15px"></div>

                                                    <div class="form-group col-lg-12" style="justify-items: end; background-color: ">
                                                        <div class="row m-l-1" style=" overflow: hidden;  ">
                                                            <a style="text-decoration: none" href="<?php echo base_url($baris->persetujuan);?>" target="_blank">
                                                                <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                                                <?= explode('/',$baris->persetujuan)[2]??'Belum Terlampir';?>

                                                            </a>
                                                        </div>

                                                    </div>

                                                    <br>

                                                    <div style="height: 15px"></div>
                                                    <!---->

                                                    <!---->
                                                    <span style="font-weight: bold; font-size: 15px">Bukti Setor : </span>
                                                    <br>
                                                    <div style="height: 15px"></div>

                                                    <div class="form-group col-lg-12" style="justify-items: end; background-color: ">
                                                        <div class="row m-l-1" style=" overflow: hidden;  ">
                                                            <a style="text-decoration: none" href="<?php echo base_url($baris->bukti_setor);?>" target="_blank">
                                                                <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                                                <?= explode('/',$baris->bukti_setor)[2]??'Belum Terlampir';?>

                                                            </a>
                                                        </div>

                                                    </div>

                                                    <br>

                                                    <div style="height: 15px"></div>
                                                    <!---->

                                                    <!---->
                                                    <span style="font-weight: bold; font-size: 15px">Kontrak :</span>
                                                    <br>
                                                    <div style="height: 15px"></div>

                                                    <div class="form-group col-lg-12" style="justify-items: end; background-color: ">
                                                        <div class="row m-l-1" style=" overflow: hidden;  ">
                                                            <a style="text-decoration: none" href="<?php echo base_url($baris->kontrak);?>" target="_blank">
                                                                <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                                                <?= explode('/',$baris->kontrak)[2]??'Belum Terlampir';?>

                                                            </a>
                                                        </div>

                                                    </div>

                                                    <br>

                                                    <div style="height: 15px"></div>
                                                    <!---->

                                                    <!---->
                                                    <span style="font-weight: bold; font-size: 15px">Penetapan :</span>
                                                    <br>
                                                    <div style="height: 15px"></div>

                                                    <div class="form-group col-lg-12" style="justify-items: end; background-color: ">
                                                        <div class="row m-l-1" style=" overflow: hidden;  ">
                                                            <a style="text-decoration: none" href="<?php echo base_url($baris->sk_penetapan);?>" target="_blank">
                                                                <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                                                <?= explode('/',$baris->sk_penetapan)[2]??'Belum Terlampir';?>

                                                            </a>
                                                        </div>

                                                    </div>

                                                    <br>

                                                    <div style="height: 15px"></div>
                                                    <!---->

                                                    <!---->
                                                    <span style="font-weight: bold; font-size: 15px">Foto-foto :</span>
                                                    <br>
                                                    <div style="height: 15px"></div>

                                                        <?php
                                                        $files = json_decode($baris->foto);
                                                        ?>
                                                    <div class="form-group col-lg-12" style="justify-items: end; background-color: ">
                                                        <?php if ($baris->foto=="" || $baris->foto==null || $baris->foto=='null'){ ?>
                                                            <span style="font-weight: normal; font-size: 15px">foto belum terlampir</span>
                                                        <?php } else {
                                                            foreach ($files as $key => $element){
                                                                ?>
                                                                <div class="row m-l-1" style=" overflow: hidden;  ">
                                                                   <a style="text-decoration: none"
                                                               href="<?php echo base_url($element);?>" target="_blank">
                                                                <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                                                <?= explode('/',$element)[2]??'Belum Terlampir';?>

                                                                  </a>
                                                                 </div>
                                                                <?php
                                                            }
                                                        } ?>



                                                    </div>

                                                    <br>

                                                    <div style="height: 15px"></div>
                                                    <!---->



                                                    <?php
                                                    $dt_tbl_berita = $this->db->get_where("tbl_berita", array('id_draft'=> $baris->id_draft_permohonan))->row();
                                                    $status = $dt_tbl_berita->status;

                                                    if($status=="selesai"){
                                                        ?>

                                                        <span style="font-weight: bold; font-size: 15px">Hasil Harmonisasi :</span>
                                                        <br>
                                                        <div style="height: 15px"></div>

                                                        <div class="form-group col-lg-12" style="justify-items: end">
                                                            <div class="row m-l-1" style=" overflow: hidden;  ">

                                                                <a style="text-decoration: none" href="<?php echo base_url($dt_tbl_berita->lamp_surat_undangan);?>" target="_blank">
                                                                    <i class="fa fa-check-square" style=" "></i>
                                                                    <span>
                                                                        <?= explode('/',$dt_tbl_berita->lamp_surat_undangan)[2];?>
                                                                    </span>



                                                                </a>
                                                            </div>

                                                        </div>

                                                        <?php
                                                    }
                                                    ?>




                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="edit_draft_berita<?php echo $baris->id_draft_permohonan; ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Edit Draft Raperda</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="pemda/v/se/<?php echo strtolower($this->uri->segment(3)); ?>" enctype="multipart/form-data">
                                                    <input type="hidden" value="<?= $baris->id_draft_permohonan;?>" name="id_draft_permohonan_edit">
                                                    <div class="form-group" for="judul_draft_permohonan_edit">
                                                        <label class="fw-500" style="font-weight: bold">Judul</label>
                                                        <br>

                                                        <input
                                                                class="form-control border-grey"
                                                                rows="5"
                                                                name="judul_draft_permohonan_edit"
                                                                id="judul_draft_permohonan_edit" value="<?php echo $baris->nama_draft_permohonan ?>"
                                                                required
                                                        >
                                                    </div>
                                                    <div class="form-group" style="align-items: flex-start" for="jenis_dokumen_edit">
                                                        <label class="" style="font-weight: bold">Jenis</label>

                                                        <br>
                                                        <div class="">
                                                            <select class="form-control " name="jenis_dokumen_edit" selected=   required>
                                                                <option value="">- Pilih Jenis Raperda-</option>
                                                                <option value="raperda" <?php if ($baris->jenis_dokumen=='raperda') { echo "selected" ;}?> >Raperda</option>
                                                                <option value="raperkada" <?php if ($baris->jenis_dokumen=='raperkada') { echo "selected" ;}?> >Raperkada</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" for="lamp_surat_permohonan_edit">
                                                        <label class="" style="font-weight: bold">Permohonan Harmonisasi</label>
                                                        <div class="m-b-10">
                                                            <input  type="file" value="" name="lamp_surat_permohonan_edit" id="lamp_surat_permohonan_edit" class="form-control" >
                                                        </div>

                                                        <div style="overflow: hidden ">
                                                            <a href="<?php echo base_url($baris->lamp_surat_permohonan);?>" target="_blank">
                                                                <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                                                <?= explode('/',$baris->lamp_surat_permohonan)[2];?>
                                                            </a>
                                                        </div>

                                                    </div>
                                                    <div class="form-group" style="background-color: " for="">
                                                        <label class=" " style="font-weight: bold">Upload Draft Harmonisasi</label>
                                                        <br>

                                                        <button class="btn btn-success m-b-10" id="add-more-edit-<?php echo $baris->id_draft_permohonan; ?>"
                                                                type="button">
                                                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah / Ubah file
                                                        </button>
                                                        <div id="auth-rows-edit-<?php echo $baris->id_draft_permohonan; ?>"></div>

                                                    </div>

                                                    <div class="mb-4">

                                                        <?php
                                                        $files = json_decode($baris->url_data_dukung);

                                                        foreach ($files as $key=>$file){ ?>
                                                            <li style="display: flex ; justify-content: space-between"
                                                                id="list-file-<?=$key ?>-<?= $baris->id_draft_permohonan; ?>">
                                                                <div class="form-group" style="justify-items: end">
                                                                    <a href="<?= base_url($file); ?>" target="_blank">
                                                                        <i class="fa fa-check-square" style="margin-right: 15px"></i>
                                                                        <?php echo explode("/", $file)[2]; ?>
                                                                    </a>
                                                                    <a style="" href="javascript:;"
                                                                       class="td-n c-red-500 cH-blue-500 fsz-md p-5"
                                                                       onclick="deleteFile('<?php echo $file;?>',<?= $key?>, <?= $baris->id_draft_permohonan; ?>)">
                                                                        <i class="fa fa-trash btn btn-danger"></i>
                                                                    </a>


                                                                </div>
                                                                <!--<a href="javascript:;"
                                                                   class="td-n c-red-500 cH-blue-500 fsz-md p-5"
                                                                   onclick="deleteFile('<?php /*echo $file;*/?>',<?/*= $key*/?>, <?/*= $baris->id_draft_permohonan; */?>)">
                                                                    <i class="fa fa-trash btn btn-danger"></i>
                                                                </a>-->
                                                            </li>
                                                        <?php  }
                                                        ?>

                                                    </div>



                                                    <div class="text-right">
                                                        <button
                                                                class="btn btn-info cur-p float-left"
                                                                data-dismiss="modal"
                                                                name="">
                                                            Kembali
                                                        </button>
                                                        <button
                                                                class="btn btn-warning cur-p"
                                                                name="">
                                                            Simpan Edit
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
<!--                                            <div class="modal-footer">-->
<!--                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--                                            </div>-->
                                        </div>
                                    </div>
                                </div>



                            <?php endforeach; ?>


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>



    <!-- end row -->
</div>
<!-- end #content -->

<script type="text/javascript">


    // var currentId = 0;


    $("[id^='add-more-edit-']").click(function (e) {

        var html4 = '<div class="form-group input-dinamis-edit">' +
            '<div class="row">' +
            '<div class="col-input-dinamis-edit col-lg-10">' +
            '<input type="file" name="url_files_edit[]" ' +
            'class="form-control border-grey" id="peserta" placeholder="Upload file" required>' +
            '</div>' +
            '<div class="col-input-dinamis-edit col-lg-2"><button class="btn btn-danger remove-edit" type="button">' +
            '<i class="fa fa-minus-circle"></i>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</div>';

        $("[id^='auth-rows-edit-']").append(html4);
    });

    $("[id^='auth-rows-edit-']").on('click', '.remove-edit', function (e) {
        e.preventDefault();
        $(this).parents('.input-dinamis-edit').remove();
    });



    function deleteFile($path,$file_id,$row_id){
        // $path = nama file;
        // $file_id = index file dari record db;
        // $row_id= id unique;
        // confirm("Hapus File?",);
        if (confirm("Hapus File Lampiran?") == true) {
            $.post("pemda/v/df",{

                path : $path,
                id : $row_id,

                file_id : $file_id
            }).done(function (response) {
                // console.log(response);
                console.log($path);
                $("#list-file-"+$file_id+"-"+$row_id).remove();
            });
        }

        // alert("tesss");

    }
</script>



