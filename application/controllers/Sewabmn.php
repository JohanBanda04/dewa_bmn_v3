<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sewabmn extends CI_Controller {

	public function index()
	{
		redirect("berita/v");
	}

    public function v2($aksi='' , $id='', $status='' )
    {
        $id = hashids_decrypt($id);
        $ceks 	 = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level 	 = $this->session->userdata('level');

//		echo $this->uri->segment(1);
//		echo $this->uri->segment(2);
//		echo $this->uri->segment(3); die;

        if($aksi!='t'){
            $this->session->set_flashdata('msg','');

        }

        if(!isset($ceks)) {
            redirect('web/login');
        }

        $data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

        if ($level=='pelaksana') {
            $this->db->where('id_user',$id_user);
        }
        //dicomment
        if ($aksi=='proses' or $aksi=='konfirmasi' or $aksi=='selesai') {
            $this->db->where('status',$aksi);
        }
        $this->db->order_by('id_berita', 'DESC');
        $data['query'] = $this->db->get("tbl_berita");


        $cek_notif = $this->db->get_where("tbl_notif", array('penerima'=>"$id_user"));
        foreach ($cek_notif->result() as $key => $value) {
            $b_notif = $value->baca_notif;
            if(!preg_match("/$id_user/i", $b_notif)) {
                $data_notif = array('baca_notif'=>"$id_user, $b_notif");
                $this->db->update('tbl_notif', $data_notif, array('penerima'=>$id_user));
            }
        }


        if ($aksi == 't') {
//			    echo "tes"; die;
//				if ($level!='pelaksana') {
//					redirect('404');
//				}
            $p = "tambah";
            $data['judul_web'] 	  = "TAMBAH DOKUMEN HARMONISASI";
        } else if ($aksi=='pemprov_ntb'){

            /*'belum_diproses','perbaikan','draft_sedang_dibuat','menunggu_koreksi','selesai'*/
            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemprov_ntb");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemprov_ntb");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemprov_ntb";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMPROV NTB";

        } else if($aksi=='pemkot_mataram'){
            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkot_mataram");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkot_mataram");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkot_mataram";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKOT MATARAM";


//            $this->db->order_by('id_berita', 'DESC');
//            $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkot_mataram"));
//            $p = "pemkot_mataram";
//            $data['judul_web'] 	= "DOKUMEN HARMONISASI PEMKOT MATARAM";
        } else if($aksi=='pemkot_bima'){

            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkot_bima");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkot_bima");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkot_bima";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKOT BIMA";

        } else if($aksi=='pemkab_sumbawa_barat'){
            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkab_sumbawa_barat");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkab_sumbawa_barat");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkab_sumbawa_barat";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB SUMBAWA BARAT";

        } else if($aksi=="pemkab_sumbawa"){
            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkab_sumbawa");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkab_sumbawa");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkab_sumbawa";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB SUMBAWA";


        } else if($aksi=="pemkab_lombok_utara"){
            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkab_lombok_utara");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkab_lombok_utara");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkab_lombok_utara";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK UTARA";


        } else if($aksi=="pemkab_lombok_timur"){
            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkab_lombok_timur");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkab_lombok_timur");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkab_lombok_timur";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK TIMUR";


        } else if($aksi=="pemkab_lombok_tengah"){
            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkab_lombok_tengah");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkab_lombok_tengah");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkab_lombok_tengah";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK TENGAH";


        } else if($aksi=="pemkab_lombok_barat"){
            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkab_lombok_barat");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkab_lombok_barat");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkab_lombok_barat";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK BARAT";



        } else if($aksi=="pemkab_dompu"){

            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkab_dompu");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkab_dompu");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkab_dompu";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB DOMPU";

        } else if($aksi=="pemkab_bima"){

            if ($status=='belum_diproses' or $status=='perbaikan' or $status=='draft_sedang_dibuat' or $status=='menunggu_koreksi' or $status=='selesai') {
                $this->db->where('status',$status);
                $this->db->where('zona_dokumen',"pemkab_bima");
            } else if($status=='semua'){
                redirect("harmonisasi/v/pemkab_bima");
            }
            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get("tbl_berita");
            /*tabel ny di select belakangan*/

            $p = "pemkab_bima";
            $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB BIMA";

        } elseif ($aksi == 'd') {
            $p = "detail";
            $data['judul_web'] 	  = "RINCIAN BAHAN BERITA";
            $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => "$id"))->row();
            if ($data['query']->id_berita=='') {redirect('404');}

            $data['cek_notif'] = $this->db->get_where("tbl_notif", array('penerima'=>"$id_user", 'id_berita'=>"$id"))->row();

            $b_notif = $data['cek_notif']->baca_notif;
            if(!preg_match("/$id_user/i", $b_notif)) {
                $data_notif = array('baca_notif'=>"$id_user, $b_notif");
                $this->db->update('tbl_notif', $data_notif, array('penerima'=>$id_user, 'id_berita'=>"$id"));
            }
        }
        else if ($aksi == 'e') {
            if($pemda=='pemprov_ntb'){
//                    echo "edit dokumen pemprov ntb";
//                    echo "<br>id:".$id; die;
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMPROV NTB";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if($pemda=='pemkot_mataram'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKOT MATARAM";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if($pemda=='pemkot_bima'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKOT BIMA";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if($pemda=='pemkab_sumbawa_barat'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB SUMBAWA BARAT";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if($pemda=='pemkab_sumbawa'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB SUMBAWA";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if($pemda=='pemkab_lombok_utara'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK UTARA";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if($pemda=='pemkab_lombok_timur'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK TIMUR";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            }else if($pemda=='pemkab_lombok_tengah'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK TENGAH";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            }else if($pemda=='pemkab_lombok_barat'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK BARAT";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            }else if($pemda=='pemkab_dompu'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB DOMPU";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            }else if($pemda=='pemkab_bima'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB BIMA";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            }



        } else if ($aksi == 'h') {

//			    echo "hapus data bro"; die;
            $cek_data = $this->db->get_where("tbl_berita", array('id_berita' => $id));
            $lamp_surat_lama = $cek_data->row()->lamp_surat_undangan;
//				echo $lamp_surat_lama; die;
//				echo $cek_data->result_array()[0]['lamp_surat_undangan'];die;
//				echo $cek_data->row()->lamp_surat_undangan;die;
//				echo $cek_data->num_rows();die;
//                $this->db->delete('tbl_berita', array('id_berita' => $id));die;
            if ($cek_data->num_rows() != 0) {
//					if ($cek_data->row()->status!='menunggu') {
//							redirect('404');
//						}
//						if ($cek_data->row()->lampiran != '') {
//							unlink($cek_data->row()->lampiran);
//						}
                // $this->db->delete('tbl_notif', array('pengirim'=>$id_user,'id_berita'=>$id));
                $this->db->delete('tbl_berita', array('id_berita' => $id));
                try {
                    unlink($lamp_surat_lama);
                } catch (Exception $e) {
                    echo json_encode($e);
                }

                $this->session->set_flashdata('msg',
                    '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil dihapus.
							</div>
							<br>'
                );


                if($pemda=='pemprov_ntb'){

                    redirect("harmonisasi/v/pemprov_ntb");
                } else if($pemda=='pemkot_mataram'){
                    redirect("harmonisasi/v/pemkot_mataram");
                } else if ($pemda=='pemkot_bima'){
                    redirect("harmonisasi/v/pemkot_bima");
                } else if($pemda=='pemkab_sumbawa_barat'){
                    redirect("harmonisasi/v/pemkab_sumbawa_barat");
                } else if($pemda=='pemkab_sumbawa'){
                    redirect("harmonisasi/v/pemkab_sumbawa");
                } else if($pemda=="pemkab_lombok_utara"){
                    redirect("harmonisasi/v/pemkab_lombok_utara");
                } else if($pemda=="pemkab_lombok_timur"){
                    redirect("harmonisasi/v/pemkab_lombok_timur");
                } else if ($pemda=="pemkab_lombok_tengah"){
                    redirect("harmonisasi/v/pemkab_lombok_tengah");
                } else if($pemda=="pemkab_lombok_barat") {
                    redirect("harmonisasi/v/pemkab_lombok_barat");
                } else if ($pemda=="pemkab_dompu"){
                    redirect("harmonisasi/v/pemkab_dompu");
                } else if($pemda=="pemkab_bima"){
                    redirect("harmonisasi/v/pemkab_bima");
                }

//						redirect("berita/v");
                redirect("harmonisasi/v/pemprov_ntb");
            }else {
                redirect('404_content');
            }
        } else if($aksi == 'df'){
            echo "delete lampiran";die;
        }else{
            $p = "index";
            $data['judul_web'] 	  = "Bahan Berita";
        }

        $this->load->view('users/header', $data);
        $this->load->view("users/harmonisasi/$p", $data);
        $this->load->view('users/footer');

        date_default_timezone_set('Asia/Singapore');
        $tgl = date('Y-m-d H:i:s');

//        $lokasi = 'file/bahan_berita';
        $lokasi = 'file/data_sewa_bmn';

        $this->upload->initialize(array(
            "upload_path"   => "./$lokasi",
            "allowed_types" => "*"
        ));

        if (isset($_POST['btnsimpan'])) {


            $nama_kegiatan 	 = htmlentities(strip_tags($this->input->post('nama_kegiatan')));
            $jenis_dokumen 	 = htmlentities(strip_tags($this->input->post('jenis_dokumen')));
            $zona_dokumen 	 = htmlentities(strip_tags($this->input->post('zona_dokumen')));

            $simpan = '';



            if ( ! $this->upload->do_upload('lamp_surat_undangan'))
            {
                $simpan = 'n';
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
            } else {
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $lamp_surat_undangan = preg_replace('/ /', '_', $filename);
                $simpan = 'y';
            }
//            echo $lamp_surat_undangan; die;
            if ($simpan=='y') {
//					    echo "tes"; die;
                $data = array(
                    'lamp_surat_undangan'	=> $lamp_surat_undangan,

                    'id_user'				=> $id_user,
                    'nama_kegiatan'   		=> $nama_kegiatan,
                    'jenis_dokumen'   		=> $jenis_dokumen,
                    'zona_dokumen'   		=> $zona_dokumen,

                );
                $this->db->insert('tbl_berita',$data);

                $id_berita = $this->db->insert_id();
                $this->Mcrud->kirim_notif($id_user,'humas',$id_berita,'berita','pelaksana_kirim_berita');

                $this->session->set_flashdata('msg',
                    '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil disimpan.
							</div>
							<br>'
                );
            }else {

                $this->session->set_flashdata('msg',
                    '
	 							<div class="alert alert-warning alert-dismissible" role="alert">
	 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 									 <span aria-hidden="true">&times;</span>
	 								 </button>
	 								 <strong>Gagal!</strong> '.$pesan.'.
	 							</div>
	 						 <br>'
                );

//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
            }
//					 redirect("berita/v");

//					 redirect("harmonisasi/v/pemprov_ntb");
            redirect("harmonisasi/v/".$zona_dokumen);

        }

        if (isset($_POST['btnsimpan_edit'])) {
//            echo $pemda;die;

//            echo "btnsimpan_edit"; die;
            $nama_kegiatan 	 = htmlentities(strip_tags($this->input->post('nama_kegiatan')));
            $jenis_dokumen 	 = htmlentities(strip_tags($this->input->post('jenis_dokumen')));
            $zona_dokumen 	 = htmlentities(strip_tags($this->input->post('zona_dokumen')));

            $data_lama = $this->db->get_where('tbl_berita',array('id_berita'=>$id))->row();
            $lamp_surat_undangan_lama = $data_lama->lamp_surat_undangan;

//            echo $lamp_surat_undangan_lama; die;
            if ( ! $this->upload->do_upload('lamp_surat_undangan'))
            {
                $simpan = 'n';
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
            }
            else
            {
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $lamp_surat_undangan_baru = preg_replace('/ /', '_', $filename);
                $simpan = 'y';


            }


//            echo $lamp_surat_undangan_lama; die;
            $pesan = '';
            $simpan = 'y';

            if ($simpan=='y') {
//					    echo "tes"; die;

                if($lamp_surat_undangan_baru==""){
//                    echo "masih dgn data lama"; die;
                    $lamp_surat_undangan_update = $lamp_surat_undangan_lama;

                    /*ini dia cara hapus file di storage*/
                } else if($lamp_surat_undangan_baru!=""){
//                    echo "data baru tidak sama dengan data lama"; die;
                    $lamp_surat_undangan_update = $lamp_surat_undangan_baru;
                    try{
                        $path_lama_akan_dihapus = $lamp_surat_undangan_lama;
                        unlink($path_lama_akan_dihapus);

                    } catch (Exception $e){
                        echo json_encode($e);
                    }
                }
                $data = array(
                    'lamp_surat_undangan'	=> $lamp_surat_undangan_update,


                    'nama_kegiatan'   		=> $nama_kegiatan,
                    'jenis_dokumen'   		=> $jenis_dokumen,
                    'zona_dokumen'   		=> $zona_dokumen,

                );
                $this->db->update('tbl_berita',$data, array('id_berita'=>$id));


                $this->session->set_flashdata('msg',
                    '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil disimpan.
							</div>
							<br>'
                );



            } else {

                $this->session->set_flashdata('msg',
                    '
	 							<div class="alert alert-warning alert-dismissible" role="alert">
	 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 									 <span aria-hidden="true">&times;</span>
	 								 </button>
	 								 <strong>Gagal!</strong> '.$pesan.'.
	 							</div>
	 						 <br>'
                );

//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
            }
//					 redirect("berita/v");
            redirect("harmonisasi/v/".$zona_dokumen);

        }




    }

    public function sewa($zona='',$aksi='' , $status='', $pemda='' )
    {
        //echo ($zona);die;
       // echo $status; die;

        $ceks 	 = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level 	 = $this->session->userdata('level');


//        if($aksi!='t'){
//            $this->session->set_flashdata('msg','');
//        }


        if(!isset($ceks)) {
            redirect('web/login');
        }
        //echo $zona; die;

        /*tambahan dari sini*/
        //$tbl_zona = $this->db->get_where('sb_satker',array('id'=>$_SESSION['satker_id']));
        $sb_satker = $this->db->get_where('sb_satker',array('id'=>$_SESSION['satker_id']));

        $data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
        $data['users']  	 = $this->Mcrud->get_users();
        $data['nama_panjang_admin']  	 = $sb_satker->row()->nama_satker;
        $data['zona_pemda']  	 = $sb_satker->row()->nama_satker;



        /*sampai sini */

        $data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

        $this->db->order_by('id', 'DESC');

        //echo $zona; die;
        //echo $data['nama_panjang_admin']; die;
        $cek_nama_panjang_zona = $this->db->get_where("sb_satker",array("id"=>hashids_decrypt($zona)));

//        echo "<pre>"; print_r($cek_nama_panjang_zona->result());die;

        $data['judul_web'] 	  = "DOKUMEN SEWA BMN SATKER ". strtoupper($cek_nama_panjang_zona->result()[0]->nama_satker);
        $data['cek_nama_panjang_zona'] 	  = $cek_nama_panjang_zona;

        if(hashids_decrypt($zona)==0 || hashids_decrypt($zona)=="0"){
            $data['query'] = $this->db->get("sb_databmn");
        } else {
            $data['query'] = $this->db->get_where("sb_databmn",array("satker_id"=>hashids_decrypt($zona)));

        }
        if ($status=='dokumen_lengkap' or $status=='dokumen_belum_lengkap' or $status=='draft_sedang_dibuat' or $status=='sedang_diproses' or $status=='menunggu_koreksi' or $status=='selesai') {
            if(hashids_decrypt($zona)==0){
                $this->db->where('status',$status);
                $this->db->order_by('id', 'DESC');
                $data['query'] = $this->db->get("sb_databmn");
            } else {
                $this->db->where('status',$status);
                $this->db->where('satker_id',hashids_decrypt($zona));
                $this->db->order_by('id', 'DESC');
                $data['query'] = $this->db->get("sb_databmn");
            }

        } else if($status=='semua'){
            redirect("sewabmn/sewa/".$zona);
        }


        $cek_notif = $this->db->get_where("tbl_notif", array('penerima'=>"$id_user"));
        foreach ($cek_notif->result() as $key => $value) {
            $b_notif = $value->baca_notif;
            if(!preg_match("/$id_user/i", $b_notif)) {
                $data_notif = array('baca_notif'=>"$id_user, $b_notif");
                $this->db->update('tbl_notif', $data_notif, array('penerima'=>$id_user));
            }
        }


        //awal dari seluruh if pd function ini
        if ($aksi == 't') {
            /*aksis*/
//			    echo $zona."<br>".$aksi; die;
//			    echo "tes"; die;
//				if ($level!='pelaksana') {
//					redirect('404');
//				}

            $p = "tambah_data_sewa";
            $data['judul_web'] 	  = "TAMBAH DATA SEWA BMN ".strtoupper($cek_nama_panjang_zona->result()[0]->nama_satker) ;
            $data['satkers'] 	  =  $this->db->get("sb_satker");
        }  elseif ($aksi == 'd') {
            $p = "detail";
            $data['judul_web'] 	  = "RINCIAN BAHAN BERITA";
            $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => "$id"))->row();
            if ($data['query']->id_berita=='') {redirect('404');}

            $data['cek_notif'] = $this->db->get_where("tbl_notif", array('penerima'=>"$id_user", 'id_berita'=>"$id"))->row();

            $b_notif = $data['cek_notif']->baca_notif;
            if(!preg_match("/$id_user/i", $b_notif)) {
                $data_notif = array('baca_notif'=>"$id_user, $b_notif");
                $this->db->update('tbl_notif', $data_notif, array('penerima'=>$id_user, 'id_berita'=>"$id"));
            }
        } else if ($aksi == 'e') {
            if($pemda=='pemprov_ntb'){
//                    echo "edit dokumen pemprov ntb";
//                    echo "<br>id:".$id; die;
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMPROV NTB";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if($pemda=='pemkot_mataram'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKOT MATARAM";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if($pemda=='pemkot_bima'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKOT BIMA";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if($pemda=='pemkab_sumbawa_barat'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB SUMBAWA BARAT";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if($pemda=='pemkab_sumbawa'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB SUMBAWA";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if($pemda=='pemkab_lombok_utara'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK UTARA";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            } else if($pemda=='pemkab_lombok_timur'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK TIMUR";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            }else if($pemda=='pemkab_lombok_tengah'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK TENGAH";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            }else if($pemda=='pemkab_lombok_barat'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK BARAT";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            }else if($pemda=='pemkab_dompu'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB DOMPU";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            }else if($pemda=='pemkab_bima'){
                $p = "edit";
                $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB BIMA";
                $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                if ($data['query']->id_berita == '') {
                    redirect('404');
                }
            }

        } else if($aksi=='se'){
            if(!isset($ceks)){
                redirect('web/login');
            }

            $id_draft_permohonan_edit = htmlentities(strip_tags($this->input->post('id_draft_permohonan_edit')));
            $judul_draft_permohonan_edit = htmlentities(strip_tags($this->input->post('judul_draft_permohonan_edit')));
            $jenis_dokumen_edit = htmlentities(strip_tags($this->input->post('jenis_dokumen_edit')));

            $cek_data = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan_edit));

            $surat_permohonan_old = $cek_data->row()->lamp_surat_permohonan;
            $data_lama_url_data_dukung = $cek_data->row()->url_data_dukung;


            $max_size = 1024*5;
            $lokasi = 'file/data_sewa_bmn';
            $this->upload->initialize(array(
                "upload_path" => "./$lokasi",
                "allowed_types" => "*",
                "max_size" => $max_size
            ));

            if (!is_dir($lokasi)) {
                # jika tidak maka folder harus dibuat terlebih dahulu
                mkdir($lokasi, 0777, $rekursif = true);
            }

            //MENANGKAP data dari inputan file 'lamp_surat_permohonan_edit'

            if(!$this->upload->do_upload('lamp_surat_permohonan_edit')){
//                    echo "tidak upload data maka gunakan DATA LAMA";die;
                $lamp_surat_permohonan = $surat_permohonan_old;
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                $simpan = 'n';

            } else  {
//                    echo "upload data maka gunakan DATA BARU";die;
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $lamp_surat_permohonan = preg_replace('/ /', '_', $filename);

                try{
                    unlink($surat_permohonan_old);
                } catch (Exception $e){
                    echo json_encode($e);
                }

                $simpan = 'y';
            }
//                echo $lamp_surat_permohonan; die;

            //berikutnya MENANGKAP lampiran post 'url_files_edit'
//            echo $_FILES['url_files_edit']; die;
            if ($_FILES['url_files_edit']['name'][0] == null) {
                $count_edit = 0;
            } else {
                $count_edit = count($_FILES['url_files_edit']['name'][0]);
            }

//                echo $count_edit; die;


            if($count_edit != 0 ){

                for($i = 0; $i < $count_edit; $i++){
                    if(!empty($_FILES['url_files_edit']['name'][$i])){
                        $_FILES['file']['name'] = $_FILES['url_files_edit']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['url_files_edit']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['url_files_edit']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['url_files_edit']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['url_files_edit']['size'][$i];

                        if ( ! $this->upload->do_upload('file')) {
                            $simpan = 'n';
                            $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                        } else if($this->upload->do_upload('file')) {
                            $gbr = $this->upload->data();
                            $filename = "$lokasi/" . $gbr['file_name'];
                            $url_file[$i] = preg_replace('/ /', '_', $filename);
                            $simpan = 'y';
                        }
                    }
                }
                $file_lama = json_decode($data_lama_url_data_dukung=='null'?"[]":$data_lama_url_data_dukung);
                $url_data_dukung =  json_encode(array_merge($file_lama, $url_file));
            } else{
                $url_data_dukung = $data_lama_url_data_dukung;
                $simpan = 'y';
            }

//                echo $url_data_dukung; die;

            if ($simpan == 'y') {
//                    echo "tes simpanz"; die;
                $data = array(
                    'nama_draft_permohonan' => $judul_draft_permohonan_edit,
                    'jenis_dokumen' => $jenis_dokumen_edit,
                    'tgl_update' => date('Y-m-d H:i:s'),
                    'lamp_surat_permohonan' => $lamp_surat_permohonan,
                    'url_data_dukung' => $url_data_dukung
                );


                $this->db->update('tbl_draft',$data, array('id_draft_permohonan'=>$id_draft_permohonan_edit));
                $this->session->set_flashdata('msg',
                    '
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Sukses!</strong> Berhasil disimpan.
					</div>
				<br>'
                );
            } else {
                $this->session->set_flashdata('msg',
                    '
					<div class="alert alert-warning alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						 </button>
						 <strong>Gagal!</strong> ' . $pesan . '.
					</div>
				 <br>'
                );
            }

            redirect('pemda/v/'.$id);

        } else if($aksi=='ce'){


            //$status disini merupakan $id dari data
            //echo hashids_decrypt($zona).'<br>';
            //echo hashids_decrypt($status).'<br>';die;
            $id_draft_permohonan = hashids_decrypt($status);
            $id_databmn = hashids_decrypt($status);
            //echo $id_databmn; die;
//            echo $id_draft_permohonan; die;
            $p = "edit_data_bmn";
            $sb_databmn = $this->db->get_where("sb_databmn", array('id'=> $id_databmn))->row();

            //echo $sb_databmn->foto;die; tapi dia butuh di refresh sekali lagi
//            if($sb_databmn->foto=='null' or $sb_databmn->foto==null){
//                $status_doc = "dokumen_belum_lengkap";
//
//            }
//
//            //echo $status_doc; die;
//            $data_status_only = array(
//                'status' => $status_doc,
//            );
//            $this->db->update('sb_databmn',$data_status_only, array('id'=>$id_databmn));


            $status = $sb_databmn->status;

            $data['edit_data_bmn'] = $this->db->get_where("sb_databmn", array('id' => $id_databmn));
            $data['id_data_bmn'] = $id_databmn;
            $data['status'] = $status;
            //$data['dt_tbl_berita'] = $dt_tbl_berita;


            $data['satkers'] 	  =  $this->db->get("sb_satker");
            $data['satker'] = $this->db->get_where("sb_satker", array('id' => hashids_decrypt($zona)));
            $nama_satker = $data['satker']->row()->nama_satker;
//            $nama_satker = explode('_',$pemda);
//            $zona_document =  $zona_doc[1]." ".$zona_doc[2];
            $data['judul_web'] = "EDIT DATA SEWA BMN ". strtoupper($nama_satker) ;
            $cek_data = $this->db->get_where("sb_databmn", array('id' => $id_databmn));


        } else if($aksi=='ce_kasub_perancang'){
            /*LANJUT DISINI BRO untuk part KASUB PERANCANG*/
            $id_draft_permohonan = hashids_decrypt($status);
//            echo $id_draft_permohonan;die;
            $p = "edit_proses_kasub_perancang";

            $dt_tbl_berita = $this->db->get_where("tbl_berita", array('id_draft'=> $id_draft_permohonan))->row();
            $status = $dt_tbl_berita->status;

            $data['edit_draft'] = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan));
            $data['id_draft_permohonan'] = $id_draft_permohonan;
            $data['status'] = $status;
            $data['dt_tbl_berita'] = $dt_tbl_berita;

            $data['pemda'] = $pemda;


            $zona_doc = explode('_',$pemda);
            $zona_document =  $zona_doc[1]." ".$zona_doc[2];
            $data['judul_web'] = "PROSES DRAFT PERMOHONAN ". strtoupper($zona_document) ;
            $cek_data = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan));


        } else if($aksi=='ce_perancang'){
            $id_draft_permohonan = hashids_decrypt($status);
            $p = "edit_proses_perancang";
//            echo $id_draft_permohonan; die;

            $data['edit_draft'] = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan));
            $data['id_draft_permohonan'] = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan));
            $data['tbl_berita_by_draft_id'] = $this->db->get_where("tbl_berita", array('id_draft' => $id_draft_permohonan));

            $data['pemda'] = $pemda;


            $zona_doc = explode('_',$pemda);

            if($zona_doc[3]!=""){
                $zona_document_strip =  $zona_doc[1]."_".$zona_doc[2]."_".$zona_doc[3];
                $zona_document =  $zona_doc[1]." ".$zona_doc[2]." ".$zona_doc[3];
            } else if($zona_doc[3]=="") {
                $zona_document_strip =  $zona_doc[1]."_".$zona_doc[2];
                $zona_document =  $zona_doc[1]." ".$zona_doc[2];
            }

//                $zona_document_strip =  $zona_doc[1]."_".$zona_doc[2];
//                $zona_document =  $zona_doc[1]." ".$zona_doc[2];


            $this->db->order_by('id_berita', 'DESC');
            $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>$zona_document));
            /*tabel ny di select belakangan*/
//                $p = "pemprov_ntb";
//                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMPROV NTB";
//                $data['edit_berita'] = $this->db->get_where("tbl_berita", array('zona_dokumen' => $zona_document_strip));

            $data['judul_web'] = "PROSES DRAFT PERMOHONAN ". strtoupper($zona_document) ;
            $cek_data = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan));


        } else if ($aksi == 'h') {

            if (!isset($ceks)) {
                redirect('web/login');
            }

//            echo $zona; die;


            $id_databmn = $this->input->post('id_databmn');

            $cek_data = $this->db->get_where("sb_databmn", array('id' => $id_databmn));

            $surat_usulan_kanwil = $cek_data->row()->surat_usulan_kanwil;
            $surat_usulan_sekjen = $cek_data->row()->surat_usulan_sekjen;
            $surat_persetujuan = $cek_data->row()->persetujuan;
            $bukti_setor = $cek_data->row()->bukti_setor;
            $kontrak = $cek_data->row()->kontrak;
            $sk_penetapan = $cek_data->row()->sk_penetapan;
            $foto = $cek_data->row()->foto;
            $files_photo = json_decode($foto, true);


            if($cek_data->num_rows() != 0){

                try{
                    unlink($surat_usulan_kanwil);
                } catch (Exception $e){
                    echo json_encode($e);
                }

                try{
                    unlink($surat_usulan_sekjen);
                } catch (Exception $e){
                    echo json_encode($e);
                }

                try{
                    unlink($surat_persetujuan);
                } catch (Exception $e){
                    echo json_encode($e);
                }

                try{
                    unlink($bukti_setor);
                } catch (Exception $e){
                    echo json_encode($e);
                }


                try{
                    unlink($kontrak);
                } catch (Exception $e){
                    echo json_encode($e);
                }

                try{
                    unlink($sk_penetapan);
                } catch (Exception $e){
                    echo json_encode($e);
                }


                    if($cek_data->row()->foto != null || $cek_data->row()->foto != "null" || $cek_data->row()->foto != ""){
                        foreach ($files_photo as $key => $file){
                            try{
                                unlink($file);
                            } catch (Exception $e){
                                echo json_encode($e);
                            }
                        }
                    }



                $this->db->delete('sb_databmn', array('id' => $id_databmn));


                $this->session->set_flashdata('msg',
                    '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil dihapus.
							</div>
							<br>'
                );

                //redirect("pemda/draft/".$zona);
                redirect("sewabmn/sewa/".$zona);

            } else {

                redirect('404_content');
            }



        } else if($aksi == 'df'){
            /*lanjutkan disini, ketika dihapus 1 dari 2 atau lebih foto, mengapa jadi belum lengkap*/
//            echo 'deletefile';die;
            $counter = 0;
            $id_databmn = $this->input->post('id');
            $cek_data = $this->db->get_where('sb_databmn',array('id'=>$id_databmn));

            //$cek_data->row()->foto; die;


            $file = json_decode($cek_data->row()->foto);
            $counter = count($file);
            //cuyydf
            $cek_foto = $cek_data->row()->foto;

            $array_cek_lengkap = array();
            $status_dokumen = "";


            if($cek_data->row()->surat_usulan_kanwil!=""){
                array_push($array_cek_lengkap,'surat_usulan_kanwil');
            }

            if($cek_data->row()->surat_usulan_sekjen!=""){
                array_push($array_cek_lengkap,'surat_usulan_sekjen');
            }

            if($cek_data->row()->persetujuan!=""){
                array_push($array_cek_lengkap,'persetujuan');
            }

            if($cek_data->row()->bukti_setor!=""){
                array_push($array_cek_lengkap,'bukti_setor');
            }

            if($cek_data->row()->kontrak!=""){
                array_push($array_cek_lengkap,'kontrak');
            }

            if($cek_data->row()->sk_penetapan!=""){
                array_push($array_cek_lengkap,'sk_penetapan');
            }

            if (!isset($ceks)) {
                redirect('web/login');
            }

            try {
                $path = $this->input->post('path');

                /*ngebug disini*/
                if (unlink($path)) {
                    //$file = json_decode($cek_data->row()->foto);
//                    $count = count($file);

                    if(sizeof($array_cek_lengkap)==6 && count($file)>0){
                        $status_dokumen = 'dokumen_lengkap';
                    } else if(sizeof($array_cek_lengkap)<6 && count($file)>0){
                        $status_dokumen = 'dokumen_belum_lengkap';
                    } else if (sizeof($array_cek_lengkap)==6 && count($file)==0){
                        $status_dokumen = 'dokumen_belum_lengkap';
                    }

//                    if(count($array_cek_lengkap)== 6 && $counter>0){
//                        $status_dokumen = 'dokumen_lengkap';
//                        //echo "dokumen lengkap"; die;
//                    } else if ((count($array_cek_lengkap)<6 && $counter==0) or (count($array_cek_lengkap)==6 && $counter==0)){
//                        //echo "dokumen belum lengkap"; die;
//                        $status_dokumen = 'dokumen_belum_lengkap';
//                    }else if ((count($array_cek_lengkap)<6 && $counter<0) or (count($array_cek_lengkap)==6 && $counter<0)){
//                        //echo "dokumen belum lengkap"; die;
//                        $status_dokumen = 'dokumen_belum_lengkap';
//                    } else if ((count($array_cek_lengkap)<6 && $counter>0)){
//                        $status_dokumen = 'dokumen_belum_lengkap';
//                    } else if (count($array_cek_lengkap)==6 && $cek_foto == 'null'){
//                        $status_dokumen = 'dokumen_belum_lengkap';
//                    }else if (count($array_cek_lengkap)==6 && $cek_foto == null){
//                        $status_dokumen = 'dokumen_belum_lengkap';
//                    } else {
//                        $status_dokumen = 'dokumen_belum_lengkap';
//                    }
//                    var_dump($file); die;
//                    unset($file[$this->input->post('file_id')]);
                    unset($file[$this->input->post('file_id')]);

                    $data = array(

                        'kode_brg'	=> $cek_data->row()->kode_brg,
                        'status'	=> $status_dokumen,
                        'nup'	=> $cek_data->row()->nup,
                        'user_id'	=> $this->session->userdata('id_user'),
                        'satker_id'	=> $cek_data->row()->satker_id,
                        'tgl_input'	=> $cek_data->row()->tgl_input,
                        'tgl_update'	=> date('Y-m-d H:i:s'),
                        'status'	=> $status_dokumen,
                        'jenis_brg'	=> $cek_data->row()->jenis_brg,
                        'lokasi'	=> $cek_data->row()->lokasi,
                        'luas_keseluruhan_bmn'	=> $cek_data->row()->luas_keseluruhan_bmn,
                        'luas_bmn_disewa'	=> $cek_data->row()->luas_bmn_disewa,
                        'tarif_besaran_sewa'	=> $cek_data->row()->tarif_besaran_sewa,
                        'jangka_waktu'	=> $cek_data->row()->jangka_waktu,
                        'identitas_penyewa'	=> $cek_data->row()->identitas_penyewa,
                        'peruntukan_sewa'	=> $cek_data->row()->peruntukan_sewa,
                        'surat_usulan_kanwil'	=> $cek_data->row()->surat_usulan_kanwil,
                        'surat_usulan_sekjen'	=> $cek_data->row()->surat_usulan_sekjen,
                        'persetujuan'	=> $cek_data->row()->persetujuan,
                        'bukti_setor'	=> $cek_data->row()->bukti_setor,
                        'kontrak'	=> $cek_data->row()->kontrak,
                        'sk_penetapan'	=> $cek_data->row()->sk_penetapan,
                        'foto' => json_encode(count($file)>0?array_values($file):null),

                    );

//                        $this->Guzzle_model->updateAgenda($id_draft_permohonan_update, $data);
                    $this->db->update('sb_databmn',$data, array('id'=>$id_databmn));
                    $this->session->set_flashdata('msg',
                        '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil update.
							</div>
							<br>'
                    );
                } else {
                    $this->session->set_flashdata('msg',
                        '
	 							<div class="alert alert-warning alert-dismissible" role="alert">
	 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 									 <span aria-hidden="true">&times;</span>
	 								 </button>
	 								 <strong>Gagal!</strong> '." upload data!".'.
	 							</div>
	 						 <br>'
                    );
                }
//                    echo "success : " . json_encode($file);
                redirect("sewabmn/sewa/".$zona."/ce/".$status);

            } catch (Exception $e) {
                echo json_encode($e);
            }

        }else{
            $p = "index";
//            $data['judul_web'] 	  = "Bahan Berita";
        }

        $this->load->view('users/header', $data);
        $this->load->view("users/sewa_bmn/$p", $data);
        $this->load->view('users/footer');

        date_default_timezone_set('Asia/Singapore');
        $tgl = date('Y-m-d H:i:s');


        $max_size = 1024*5;
        $lokasi = 'file/data_sewa_bmn';
        $this->upload->initialize(array(
            "upload_path" => "./$lokasi",
            "allowed_types" => "*",
            "max_size" => $max_size
        ));

        if (isset($_POST['btnsimpan_update'])) {

            $array_cek_lengkap = array();
            $status_dokumen = "null";


            if(!isset($ceks)){
                redirect('web/login');
            }

            if (!is_dir($lokasi)) {
                # jika tidak maka folder harus dibuat terlebih dahulu
                mkdir($lokasi, 0777, $rekursif = true);
            }

            //DARI SINI
//                    echo $_FILES['url_files']['name'];die;
            if ($_FILES['url_files']['name'][0] == null) {

                $count_edit = 0;
            } else {
                $count_edit = count($_FILES['url_files']['name']);
            }

            $kode_brg = htmlentities(strip_tags($this->input->post('kode_brg'))) ;
            $nup = htmlentities(strip_tags($this->input->post('no_urut_pendaftaran'))) ;
            $satker_id = htmlentities(strip_tags($this->input->post('satker_id'))) ;
            $jenis_brg = htmlentities(strip_tags($this->input->post('jenis_brg'))) ;
            $lokasi_to_save = htmlentities(strip_tags($this->input->post('lokasi'))) ;
            $luas_total = htmlentities(strip_tags($this->input->post('luas_total'))) ;
            $luas_disewa = htmlentities(strip_tags($this->input->post('luas_disewa'))) ;
            $tarif_besaran_sewa = htmlentities(strip_tags($this->input->post('tarif_besaran_sewa'))) ;
            $jangka_waktu = htmlentities(strip_tags($this->input->post('jangka_waktu'))) ;
            $identitas_penyewa = htmlentities(strip_tags($this->input->post('identitas_penyewa'))) ;
            $peruntukan_sewa = htmlentities(strip_tags($this->input->post('peruntukan_sewa'))) ;


            //dapat id datanya
            //echo $id_databmn; die;
           //$cek_data = $this->db->get_where("tbl_draft", array('id' => $id_databmn))->row();
            $cek_data = $this->db->get_where("sb_databmn", array('id' =>$id_databmn))->row();
            $data_lama_foto = $cek_data->foto;


            $data_lama_surat_usulan_kanwil = $cek_data->surat_usulan_kanwil;
            //echo $data_lama_surat_usulan_kanwil; die;
            $data_lama_surat_usulan_sekjen = $cek_data->surat_usulan_sekjen;
            $data_lama_persetujuan = $cek_data->persetujuan;
            $data_lama_bukti_setor = $cek_data->bukti_setor;
            $data_lama_kontrak = $cek_data->kontrak;
            $data_lama_sk_penetapan = $cek_data->sk_penetapan;
            $data_id_user = $cek_data->user_id;
            $status = $cek_data->status;


//            $data_id_user = $cek_data->id_user;
//            echo $status;die;
//            echo $data_id_user;die;


            if($count_edit != 0 ){

                for($i = 0; $i < $count_edit; $i++){
                    if(!empty($_FILES['url_files']['name'][$i])){
                        $_FILES['file']['name'] = $_FILES['url_files']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['url_files']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['url_files']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['url_files']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['url_files']['size'][$i];

                        if ( ! $this->upload->do_upload('file')) {
                            $simpan = 'n';
                            $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                        } else  {
                            $gbr = $this->upload->data();
                            $filename = "$lokasi/" . $gbr['file_name'];
                            $url_file[$i] = preg_replace('/ /', '_', $filename);
                            $simpan = 'y';
                        }
                    }
                }
//                echo $url_file;die;
                $file_lama = json_decode($data_lama_foto=='null'?"[]":$data_lama_foto);
                //$url_data_dukung =  json_encode(array_merge($file_lama, $url_file));
                $foto =  json_encode(array_merge($file_lama, $url_file));
            } else{
                //$url_data_dukung = $data_lama_url_data_dukung;
                $foto = $data_lama_foto;
                $simpan = 'y';
            }


            /*surat usulan kanwil*/
            if( ! $this->upload->do_upload('surat_usulan_kanwil')){
//                    echo "tidak upload data maka gunakan DATA LAMA";die;
                //$lamp_surat_permohonan = $data_lama_lamp_surat_permohonan;
                $surat_usulan_kanwil = $data_lama_surat_usulan_kanwil;
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
//                $simpan = 'n';
                if($data_lama_surat_usulan_kanwil!=""){
                    array_push($array_cek_lengkap,'surat_usulan_kanwil');
                }

            } else  {
//                    echo "upload data maka gunakan DATA BARU";die;
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $surat_usulan_kanwil = preg_replace('/ /', '_', $filename);

                try{
                    unlink($data_lama_surat_usulan_kanwil);
                } catch (Exception $e){
                    echo json_encode($e);
                }

                $simpan = 'y';
                array_push($array_cek_lengkap,'surat_usulan_kanwil');
            }

            /*surat usulan sekjen*/

            if( !$this->upload->do_upload('surat_usulan_sekjen')){
                $surat_usulan_sekjen = $data_lama_surat_usulan_sekjen;
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
//                $simpan = 'n';
                if($data_lama_surat_usulan_sekjen!=""){
                    array_push($array_cek_lengkap,'surat_usulan_sekjen');
                }

            } else  {
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $surat_usulan_sekjen = preg_replace('/ /', '_', $filename);

                try{
                    unlink($data_lama_surat_usulan_sekjen);
                } catch (Exception $e){
                    echo json_encode($e);
                }

                $simpan = 'y';
                array_push($array_cek_lengkap,'surat_usulan_sekjen');
            }

            /*surat persetujuan*/
            if( !$this->upload->do_upload('surat_persetujuan')){
                $surat_persetujuan = $data_lama_persetujuan;
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
//                $simpan = 'n';

                if($data_lama_persetujuan!=""){
                    array_push($array_cek_lengkap,'surat_persetujuan');
                }

            } else  {
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $surat_persetujuan = preg_replace('/ /', '_', $filename);

                try{
                    unlink($data_lama_persetujuan);
                } catch (Exception $e){
                    echo json_encode($e);
                }

                $simpan = 'y';
                array_push($array_cek_lengkap,'surat_persetujuan');
            }

            /*bukti setor*/
            if( !$this->upload->do_upload('bukti_setor')){
                $bukti_setor = $data_lama_bukti_setor;
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
//                $simpan = 'n';
                if($data_lama_bukti_setor!=""){
                    array_push($array_cek_lengkap,'bukti_setor');
                }

            } else  {
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $bukti_setor = preg_replace('/ /', '_', $filename);

                try{
                    unlink($data_lama_bukti_setor);
                } catch (Exception $e){
                    echo json_encode($e);
                }

                $simpan = 'y';
                array_push($array_cek_lengkap,'bukti_setor');
            }

            /*kontrak*/
            if( !$this->upload->do_upload('surat_kontrak')){
                $surat_kontrak = $data_lama_kontrak;
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
//                $simpan = 'n';
                if($data_lama_kontrak!=""){
                    array_push($array_cek_lengkap,'kontrak');
                }

            } else  {
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $surat_kontrak = preg_replace('/ /', '_', $filename);

                try{
                    unlink($data_lama_kontrak);
                } catch (Exception $e){
                    echo json_encode($e);
                }

                $simpan = 'y';
                array_push($array_cek_lengkap,'kontrak');
            }

            /*sk penetapan*/
            if( !$this->upload->do_upload('sk_penetapan')){
                $sk_penetapan = $data_lama_sk_penetapan;
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
//                $simpan = 'n';
                if($data_lama_sk_penetapan!=""){
                    array_push($array_cek_lengkap,'sk_penetapan');
                }

            } else  {
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $sk_penetapan = preg_replace('/ /', '_', $filename);

                try{
                    unlink($data_lama_sk_penetapan);
                } catch (Exception $e){
                    echo json_encode($e);
                }

                $simpan = 'y';
                array_push($array_cek_lengkap,'sk_penetapan');
            }


            $file_foto_lama = json_decode($data_lama_foto);

           //echo count($array_cek_lengkap).'<br>';
            //echo $data_lama_foto.'<br>';
            //echo $count_edit.'<br>';
            //echo count($file_foto_lama).'<br>';

            if((count($array_cek_lengkap)== 6 &&  ($count_edit>0 or $data_lama_foto!='null'))){
                $status_dokumen = 'dokumen_lengkap';
            } else if ((count($array_cek_lengkap)<=6 && $count_edit<=0)
                or (count($array_cek_lengkap)<= 6 && $data_lama_foto==null )
                or (count($array_cek_lengkap)<= 6 && $data_lama_foto=='null' ) ){
                $status_dokumen = 'dokumen_belum_lengkap';
            } else if((count($array_cek_lengkap)== 6 && $data_lama_foto=='null')){
                $status_dokumen = 'dokumen_belum_lengkap';
            } else if ((count($array_cek_lengkap)<6 && $count_edit>0) ){
//                echo "dokumen belum lengkap"; die;
                $status_dokumen = 'dokumen_belum_lengkap';
            }

            //$file_lama = json_decode($data_lama_url_data_dukung=='null'?"[]":$data_lama_url_data_dukung);

            //cuyysize
            //echo $status_dokumen;die;

            //cuyyyupdate
//            echo $id_databmn.'<br>';
//            echo $kode_brg.'<br>';
//            echo $nup.'<br>';
//            echo $satker_id.'<br>';
//            echo $jenis_brg.'<br>';
//            echo $lokasi_to_save.'<br>';
//            echo $luas_total.'<br>';
//            echo $luas_disewa.'<br>';
//            echo $tarif_besaran_sewa.'<br>';
//            echo $jangka_waktu.'<br>';
//            echo $identitas_penyewa.'<br>';
//            echo $peruntukan_sewa.'<br>';
//
//            echo $surat_usulan_kanwil.'<br>';
//            echo $surat_usulan_sekjen.'<br>';
//            echo $surat_persetujuan.'<br>';
//            echo $bukti_setor.'<br>';
//            echo $surat_kontrak.'<br>';
//            echo $sk_penetapan.'<br>';
//            echo $foto.'<br>';die;
//            $simpan = '';



            if($simpan=='y'){


                $data = array(


                    'kode_brg'	=> $kode_brg,
                    'nup'	=> $nup,
                    'user_id'	=> $this->session->userdata('id_user'),
//                    'satker_id'	=> $this->session->userdata('satker_id'),
                    'satker_id'	=> $satker_id,
                    'tgl_update'	=> date('Y-m-d H:i:s'),
                    'status'	=> $status_dokumen,
                    'jenis_brg'	=> $jenis_brg,
                    'lokasi'	=> $lokasi_to_save,
                    'luas_keseluruhan_bmn'	=> $luas_total,
                    'luas_bmn_disewa'	=> $luas_disewa,
                    'tarif_besaran_sewa'	=> $tarif_besaran_sewa,
                    'jangka_waktu'	=> $jangka_waktu,
                    'identitas_penyewa'	=> $identitas_penyewa,
                    'peruntukan_sewa'	=> $peruntukan_sewa,
                    'surat_usulan_kanwil'	=> $surat_usulan_kanwil,
                    'surat_usulan_sekjen'	=> $surat_usulan_sekjen,
                    'persetujuan'	=> $surat_persetujuan,
                    'bukti_setor'	=> $bukti_setor,
                    'kontrak'	=> $surat_kontrak,
                    'sk_penetapan'	=> $sk_penetapan,
                    'foto'      => $foto,


                );


//                echo $id; die;
                $this->db->update('sb_databmn',$data, array('id'=>$id_databmn));
                $this->session->set_flashdata('msg',
                    '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil Mengubah Data.
							</div>
							<br>'
                );
            } else {

                $this->session->set_flashdata('msg',
                    '
	 							<div class="alert alert-warning alert-dismissible" role="alert">
	 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 									 <span aria-hidden="true">&times;</span>
	 								 </button>
	 								 <strong>Gagal!</strong> '.$pesan.'.
	 							</div>
	 						 <br>'
                );
//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
            }

            redirect("sewabmn/sewa/".$zona);
        }

        if (isset($_POST['btnsimpan_update_perancang'])) {
            //LANJUTKAN DISINI UTK MELAKUKAN UPDATE PADA FILE CONTROLLER PEMDA DAN VIEW EDIT DARI PEMDA,KASUB,PERANCANG
            //PADA PROJECT DI SERVER PUSDATIN
//            echo $id;die;
//            echo $id_draft_permohonan;die;
            echo "btnsimpan_update_perancang"; die;
            //$cek_nama_judul = htmlentities(strip_tags($this->input->post('nama_draft')));
            //echo $cek_nama_judul; die;
            $zona_doc = explode('_',$zona);
            if($zona_doc[2]!=""){
                $zona_document_strip =  $zona_doc[0]."_".$zona_doc[1]."_".$zona_doc[2];
                $zona_document =  $zona_doc[0]." ".$zona_doc[1]." ".$zona_doc[2];
            } else if($zona_doc[2]=="") {
                $zona_document_strip =  $zona_doc[0]."_".$zona_doc[1];
                $zona_document =  $zona_doc[0]." ".$zona_doc[1];
            }

            if(!isset($ceks)){
                redirect('web/login');
            }

            if (!is_dir($lokasi)) {
                # jika tidak maka folder harus dibuat terlebih dahulu
                mkdir($lokasi, 0777, $rekursif = true);
            }

            //DARI SINI
//                    echo $_FILES['url_files']['name'];die;
            if ($_FILES['url_files']['name'][0] == null) {

                $count_edit = 0;
            } else {
                $count_edit = count($_FILES['url_files']['name']);
            }

            $nama_draft = htmlentities(strip_tags($this->input->post('nama_draft'))) ;
            $jenis_dokumen = htmlentities(strip_tags($this->input->post('jenis_dokumen'))) ;
            $status = htmlentities(strip_tags($this->input->post('status_dokumen'))) ;

            //echo $status; die;
//            echo $id; die;
            $simpan = '';

            $cek_data = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan))->row();
            $data_lama_url_data_dukung = $cek_data->url_data_dukung;
            $data_lama_lamp_surat_permohonan = $cek_data->lamp_surat_permohonan;
            $nama_perancang = $cek_data->nama_perancang;
            $data_id_user = $cek_data->id_user;

            //echo $nama_perancang; die;

            $cek_data_harmonisasi = $this->db->get_where("tbl_berita",array('id_draft' => $id_draft_permohonan))->row();
            $data_lama_lamp_harmonisasi = $cek_data_harmonisasi->lamp_surat_undangan;

            if($count_edit != 0 ){

                for($i = 0; $i < $count_edit; $i++){
                    if(!empty($_FILES['url_files']['name'][$i])){
                        $_FILES['file']['name'] = $_FILES['url_files']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['url_files']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['url_files']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['url_files']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['url_files']['size'][$i];

                        if ( ! $this->upload->do_upload('file')) {
                            $simpan = 'n';
                            $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                        } else  {
                            $gbr = $this->upload->data();
                            $filename = "$lokasi/" . $gbr['file_name'];
                            $url_file[$i] = preg_replace('/ /', '_', $filename);
                            $simpan = 'y';
                        }
                    }
                }
//                echo $url_file;die;
                $file_lama = json_decode($data_lama_url_data_dukung=='null'?"[]":$data_lama_url_data_dukung);
                $url_data_dukung =  json_encode(array_merge($file_lama, $url_file));
            } else{
                $url_data_dukung = $data_lama_url_data_dukung;
                $simpan = 'y';
            }

            //echo $url_data_dukung; die;

            /*menangkap data file untuk lamp_surat_permohonan_edit*/
            if( !$this->upload->do_upload('lamp_surat_permohonan_edit')){
//                    echo "tidak upload data maka gunakan DATA LAMA";die;
                $lamp_surat_permohonan = $data_lama_lamp_surat_permohonan;
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
//                $simpan = 'n';

            } else  {
//                    echo "upload data maka gunakan DATA BARU";die;
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $lamp_surat_permohonan = preg_replace('/ /', '_', $filename);

                try{
                    unlink($data_lama_lamp_surat_permohonan);
                } catch (Exception $e){
                    echo json_encode($e);
                }

                $simpan = 'y';
            }

            //echo $lamp_surat_permohonan;die;

            /*menangkap data file untuk hasil lamp_harmonisasi*/
            //lamp_harmonisasi cukx
            if( !$this->upload->do_upload('lamp_harmonisasi')){
                $lamp_surat_harmonisasi = $data_lama_lamp_harmonisasi;
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));

            } else  {
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $lamp_surat_harmonisasi = preg_replace('/ /', '_', $filename);
//                $lamp_surat_permohonan = preg_replace('/ /', '_', $filename);

                try{
                    unlink($data_lama_lamp_harmonisasi);
                } catch (Exception $e){
                    echo json_encode($e);
                }

                $simpan = 'y';
            }

            //sampai sini bisa
            //echo $lamp_surat_harmonisasi; die;
            $cek_data_tbl_berita = $this->db->get_where("tbl_berita", array('id_draft' => $id_draft_permohonan));

            if($simpan=='y'){
                $data = array(
                    //'nama_draft_permohonan' => $nama_draft,
                    //'jenis_dokumen' => $jenis_dokumen,
                    //'tgl_update' => date('Y-m-d H:i:s'),
                    //'lamp_surat_permohonan' => $lamp_surat_permohonan,
                    //'url_data_dukung' => $url_data_dukung

                    'nama_draft_permohonan' => $nama_draft,
                    'jenis_dokumen' => $jenis_dokumen,
                    'status' => $status,
                    'nama_perancang' => $nama_perancang,
                    'tgl_update' => date('Y-m-d H:i:s'),
                    'lamp_surat_permohonan' => $lamp_surat_permohonan,
                    'url_data_dukung' => $url_data_dukung
                );

                if($cek_data_tbl_berita->num_rows()<=0){
                    $data_tbl_berita = array(
                        'id_user' => $data_id_user,
                        'nama_kegiatan' => $nama_draft,
                        'tgl_kegiatan' => date('Y-m-d H:i:s'),
                        'tgl_input' => date('Y-m-d H:i:s'),
                        'status' => $status,
                        'jenis_dokumen' => $jenis_dokumen,
                        'zona_dokumen' => $zona_document,
                        'id_draft' => $id_draft_permohonan,
                    );

                    $this->db->insert('tbl_berita',$data_tbl_berita);
                } else {
                    $data_tbl_berita = array(
                        'tgl_update' => date('Y-m-d H:i:s'),
                        'status' => $status,
                        'nama_kegiatan' => $nama_draft,
                        'lamp_surat_undangan' => $lamp_surat_harmonisasi,
                    );
                    $this->db->update('tbl_berita',$data_tbl_berita, array('id_draft'=>$id_draft_permohonan));
                }

//                echo $id; die;
                $this->db->update('tbl_draft',$data, array('id_draft_permohonan'=>$id_draft_permohonan));
                $this->session->set_flashdata('msg',
                    '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil update.
							</div>
							<br>'
                );
            } else {

                $this->session->set_flashdata('msg',
                    '
	 							<div class="alert alert-warning alert-dismissible" role="alert">
	 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 									 <span aria-hidden="true">&times;</span>
	 								 </button>
	 								 <strong>Gagal!</strong> '.$pesan.'.
	 							</div>
	 						 <br>'
                );
//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
            }
            redirect("pemda/draft/".$zona);
        }

        if (isset($_POST['btnsimpan_update_kasub_perancang'])) {
//            echo $zona; die;
//            echo $id; die;
            echo "btnsimpan_update_kasub_perancang"; die;
            $zona_doc = explode('_',$zona);
            if($zona_doc[2]!=""){
                $zona_document_strip =  $zona_doc[0]."_".$zona_doc[1]."_".$zona_doc[2];
                $zona_document =  $zona_doc[0]." ".$zona_doc[1]." ".$zona_doc[2];
            } else if($zona_doc[2]=="") {
                $zona_document_strip =  $zona_doc[0]."_".$zona_doc[1];
                $zona_document =  $zona_doc[0]." ".$zona_doc[1];
            }


            if(!isset($ceks)){
                redirect('web/login');
            }

            if (!is_dir($lokasi)) {
                # jika tidak maka folder harus dibuat terlebih dahulu
                mkdir($lokasi, 0777, $rekursif = true);
            }

//                    echo $_FILES['url_files']['name'];die;
            if ($_FILES['url_files']['name'][0] == null) {

                $count_edit = 0;
            } else {
                $count_edit = count($_FILES['url_files']['name']);
            }

            $id_draft_permohonan = htmlentities(strip_tags($this->input->post('id_draft_permohonan'))) ;
//            echo $id_draft_permohonan; die;
            $nama_draft = htmlentities(strip_tags($this->input->post('nama_draft'))) ;
            $jenis_dokumen = htmlentities(strip_tags($this->input->post('jenis_dokumen'))) ;
            $status = htmlentities(strip_tags($this->input->post('status_dokumen'))) ;
            $nama_perancang = htmlentities(strip_tags($this->input->post('nama_perancang'))) ;

            $simpan = '';

            $cek_data = $this->db->get_where("tbl_draft", array('id_draft_permohonan' => $id_draft_permohonan))->row();
            $data_lama_url_data_dukung = $cek_data->url_data_dukung;
            $data_lama_lamp_surat_permohonan = $cek_data->lamp_surat_permohonan;
            $data_id_user = $cek_data->id_user;



            if($count_edit != 0 ){

                for($i = 0; $i < $count_edit; $i++){
                    if(!empty($_FILES['url_files']['name'][$i])){
                        $_FILES['file']['name'] = $_FILES['url_files']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['url_files']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['url_files']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['url_files']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['url_files']['size'][$i];

                        if ( ! $this->upload->do_upload('file')) {
                            $simpan = 'n';
                            $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                        } else  {
                            $gbr = $this->upload->data();
                            $filename = "$lokasi/" . $gbr['file_name'];
                            $url_file[$i] = preg_replace('/ /', '_', $filename);
                            $simpan = 'y';
                        }
                    }
                }
//                echo $url_file;die;
                $file_lama = json_decode($data_lama_url_data_dukung=='null'?"[]":$data_lama_url_data_dukung);
                $url_data_dukung =  json_encode(array_merge($file_lama, $url_file));
            } else{
                $url_data_dukung = $data_lama_url_data_dukung;
                $simpan = 'y';
            }

//            lamp_surat_permohonan_edit
            if( !$this->upload->do_upload('lamp_surat_permohonan_edit')){
//                    echo "tidak upload data maka gunakan DATA LAMA";die;
                $lamp_surat_permohonan = $data_lama_lamp_surat_permohonan;
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
//                $simpan = 'n';

            } else  {
//                    echo "upload data maka gunakan DATA BARU";die;
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $lamp_surat_permohonan = preg_replace('/ /', '_', $filename);

                try{
                    unlink($data_lama_lamp_surat_permohonan);
                } catch (Exception $e){
                    echo json_encode($e);
                }

                $simpan = 'y';
            }

            //echo $data_lama_lamp_surat_permohonan;die;
            //echo $url_data_dukung;die;

            $cek_data_tbl_berita = $this->db->get_where("tbl_berita", array('id_draft' => $id_draft_permohonan));
//            echo $cek_data_tbl_berita->num_rows(); die;


//            echo $id_draft_permohonan;die;
            if($simpan=='y'){
                $data = array(
                    'nama_draft_permohonan' => $nama_draft,
                    'jenis_dokumen' => $jenis_dokumen,
                    'status' => $status,
                    'nama_perancang' => $nama_perancang,
                    'tgl_update' => date('Y-m-d H:i:s'),
                    'lamp_surat_permohonan' => $lamp_surat_permohonan,
                    'url_data_dukung' => $url_data_dukung
                );

                if($cek_data_tbl_berita->num_rows()<=0){
                    //maka insert
                    /*belum masuk id_user*/
                    $data_tbl_berita = array(
                        'id_user' => $data_id_user,
                        'nama_kegiatan' => $nama_draft,
                        'tgl_kegiatan' => date('Y-m-d H:i:s'),
                        'tgl_input' => date('Y-m-d H:i:s'),
                        'status' => $status,
                        'jenis_dokumen' => $jenis_dokumen,
                        'zona_dokumen' => $zona,
                        'id_draft' => $id_draft_permohonan,
                    );

                    $this->db->insert('tbl_berita',$data_tbl_berita);

                } else {
                    //maka update
                    $data_tbl_berita = array(
                        'tgl_update' => date('Y-m-d H:i:s'),
                        'status' => $status,
                    );

                    $this->db->update('tbl_berita',$data_tbl_berita, array('id_draft'=>$id_draft_permohonan));
                }

                $this->db->update('tbl_draft',$data, array('id_draft_permohonan'=>$id_draft_permohonan));

                $this->session->set_flashdata('msg',
                    '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil update.
							</div>
							<br>'
                );
            } else {

                $this->session->set_flashdata('msg',
                    '
	 							<div class="alert alert-warning alert-dismissible" role="alert">
	 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 									 <span aria-hidden="true">&times;</span>
	 								 </button>
	 								 <strong>Gagal!</strong> '.$pesan.'.
	 							</div>
	 						 <br>'
                );
//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
            }
            redirect("pemda/draft/".$zona);
        }

        if (isset($_POST['btnsimpan'])) {
            /*wkwkwk*/
            //echo "simpandata";die;
            $array_cek_lengkap = array();
            $status_dokumen = "null";

            if(!isset($ceks)){
                redirect('web/login');
            }

            if (!is_dir($lokasi)) {
                mkdir($lokasi, 0777, $rekursif = true);
            }

            if ($_FILES['url_files']['name'][0] == null) {

                $count = 0;
            } else {
                $count = count($_FILES['url_files']['name']);
            }

            /*LANJUTKAN DISINI*/
//                    echo '<pre>'; print_r($_FILES); exit;

            if ($count != 0) {
                for ($i = 0; $i < $count; $i++) {

                    if (!empty($_FILES['url_files']['name'][$i])) {

                        $_FILES['file']['name'] = $_FILES['url_files']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['url_files']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['url_files']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['url_files']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['url_files']['size'][$i];

                        if (!$this->upload->do_upload('file')) {
                            $simpan = 'n';
                            $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                        } else {
                            $gbr = $this->upload->data();
                            $filename = "$lokasi/" . $gbr['file_name'];
                            $url_file[$i] = preg_replace('/ /', '_', $filename);
                            $simpan = 'y';
//                            var_dump($filename); exit;
                        }
                    }
                }
            } else {
                $simpan = 'y';
            }



            $kode_brg = htmlentities(strip_tags($this->input->post('kode_brg')));
            $no_urut_pendaftaran = htmlentities(strip_tags($this->input->post('no_urut_pendaftaran')));
            $satker_id = htmlentities(strip_tags($this->input->post('satker_id')));
            $jenis_brg = htmlentities(strip_tags($this->input->post('jenis_brg')));
            $lokasi_to_save = htmlentities(strip_tags($this->input->post('lokasi')));
            $luas_total = htmlentities(strip_tags($this->input->post('luas_total')));
            $luas_disewa = htmlentities(strip_tags($this->input->post('luas_disewa')));
            $tarif_besaran_sewa = htmlentities(strip_tags($this->input->post('tarif_besaran_sewa')));
            $jangka_waktu = htmlentities(strip_tags($this->input->post('jangka_waktu')));
            $identitas_penyewa = htmlentities(strip_tags($this->input->post('identitas_penyewa')));
            $peruntukan_sewa = htmlentities(strip_tags($this->input->post('peruntukan_sewa')));

            //echo count($array_cek_lengkap);die;



            $simpan = '';

            /*upload surat usulan kanwil*/
            if( ! $this->upload->do_upload('surat_usulan_kanwil')){
                $simpan = 'n';
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
            } else {

                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $surat_usulan_kanwil = preg_replace('/ /', '_', $filename);
                $simpan = 'y';

                array_push($array_cek_lengkap,"surat_usulan_kanwil");
            }


            /*upload surat usulan sekjen*/
            if( ! $this->upload->do_upload('surat_usulan_sekjen')){
                $simpan = 'n';
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
            } else {
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $surat_usulan_sekjen = preg_replace('/ /', '_', $filename);
                $simpan = 'y';
                array_push($array_cek_lengkap,"surat_usulan_sekjen");
            }


            /*upload surat persetujuan*/
            if( ! $this->upload->do_upload('surat_persetujuan')){
                $simpan = 'n';
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
            } else {
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $surat_persetujuan = preg_replace('/ /', '_', $filename);
                $simpan = 'y';
                array_push($array_cek_lengkap,"surat_persetujuan");
            }


            /*upload bukti setor*/
            if( ! $this->upload->do_upload('bukti_setor')){
                $simpan = 'n';
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
            } else {
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $bukti_setor = preg_replace('/ /', '_', $filename);
                $simpan = 'y';
                array_push($array_cek_lengkap,"bukti_setor");
            }

            /*upload surat kontrak*/
            if( ! $this->upload->do_upload('kontrak')){
                $simpan = 'n';
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
            } else {
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $kontrak = preg_replace('/ /', '_', $filename);
                $simpan = 'y';
                array_push($array_cek_lengkap,"kontrak");
            }

            /*upload surat penetapan*/
            if( ! $this->upload->do_upload('surat_penetapan')){
                $simpan = 'n';
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
            } else {
                $gbr = $this->upload->data();
                $filename = "$lokasi/".$gbr['file_name'];
                $surat_penetapan = preg_replace('/ /', '_', $filename);
                $simpan = 'y';
                array_push($array_cek_lengkap,"surat_penetapan");
            }


            //$count adalah size lampiran foto
            if(count($array_cek_lengkap)== 6 && $count>0){
                $status_dokumen = 'dokumen_lengkap';
                //echo "dokumen lengkap"; die;
            } else if ((count($array_cek_lengkap)<6 && $count<=0) or (count($array_cek_lengkap)==6 && $count<=0)){
                //echo "dokumen belum lengkap"; die;
                $status_dokumen = 'dokumen_belum_lengkap';
            } else if ((count($array_cek_lengkap)<6 && $count>0) or (count($array_cek_lengkap)==6 && $count>0)){
                $status_dokumen = 'dokumen_belum_lengkap';
            }

            //cuyyy
//            echo $kode_brg.'<br>';
//            echo $no_urut_pendaftaran.'<br>';
//            echo $jenis_brg.'<br>';
//            echo $lokasi_to_save.'<br>';
//            echo $luas_total.'<br>';
//            echo $luas_disewa.'<br>';
//            echo $tarif_besaran_sewa.'<br>';
//            echo $jangka_waktu.'<br>';
//            echo $identitas_penyewa.'<br>';
//            echo $peruntukan_sewa.'<br>';
//            echo $surat_usulan_kanwil.'<br>';
//            echo $surat_usulan_sekjen.'<br>';
//            echo $surat_persetujuan.'<br>';
//            echo $bukti_setor.'<br>';
//            echo $kontrak.'<br>';
//            echo $surat_penetapan.'<br>';
//            echo 'length array push :'. count($array_cek_lengkap).'<br>';
//            echo 'jml data foto: '.$count.'<br>';
//            echo 'user_id sdg login '.$this->session->userdata('id_user').'<br>';
//            echo 'status dokumen : '.$status_dokumen; die;

            /*jgn lupa ubah nilai variabel $simpan jadi $simpan='y' meskipun tdk ada file lampiran yg di upload*/
            $simpan='y';
            //lanjutkan disini
            if($simpan=='y'){
                //echo "simpandata";die;
                $data = array(


                    'kode_brg'	=> $kode_brg,
                    'nup'	=> $no_urut_pendaftaran,
                    'user_id'	=> $this->session->userdata('id_user'),
//                    'satker_id'	=> $this->session->userdata('satker_id'),
                    'satker_id'	=> $satker_id,
                    'tgl_input'	=> date('Y-m-d H:i:s'),
                    'tgl_update'	=> date('Y-m-d H:i:s'),
                    'status'	=> $status_dokumen,
                    'jenis_brg'	=> $jenis_brg,
                    'lokasi'	=> $lokasi_to_save,
                    'luas_keseluruhan_bmn'	=> $luas_total,
                    'luas_bmn_disewa'	=> $luas_disewa,
                    'tarif_besaran_sewa'	=> $tarif_besaran_sewa,
                    'jangka_waktu'	=> $jangka_waktu,
                    'identitas_penyewa'	=> $identitas_penyewa,
                    'peruntukan_sewa'	=> $peruntukan_sewa,
                    'surat_usulan_kanwil'	=> $surat_usulan_kanwil,
                    'surat_usulan_sekjen'	=> $surat_usulan_sekjen,
                    'persetujuan'	=> $surat_persetujuan,
                    'bukti_setor'	=> $bukti_setor,
                    'kontrak'	=> $kontrak,
                    'sk_penetapan'	=> $surat_penetapan,
                    'foto'      => json_encode($url_file),


                );

                $this->db->insert('sb_databmn',$data);

//                $id_berita = $this->db->insert_id();
//                $this->Mcrud->kirim_notif($id_user,'humas',$id_berita,'berita','pelaksana_kirim_berita');

                $this->session->set_flashdata('msg',
                    '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil disimpan.
							</div>
							<br>'
                );
            } else {

                $this->session->set_flashdata('msg',
                    '
	 							<div class="alert alert-warning alert-dismissible" role="alert">
	 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 									 <span aria-hidden="true">&times;</span>
	 								 </button>
	 								 <strong>Gagal!</strong> '.$pesan.'.
	 							</div>
	 						 <br>'
                );
//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
            }
//            redirect("pemda/draft/".$zona);
            //cihuy
            redirect("sewabmn/sewa/".$zona);
        }



        /*nah ini dia ketika di klik simpan saat selesai edit*/
        if (isset($_POST['btnsimpan_edit'])) {
//            echo $pemda;die;

//            echo "btnsimpan_edit"; die;
            $nama_kegiatan 	 = htmlentities(strip_tags($this->input->post('nama_kegiatan')));
            $jenis_dokumen 	 = htmlentities(strip_tags($this->input->post('jenis_dokumen')));
            $zona_dokumen 	 = htmlentities(strip_tags($this->input->post('zona_dokumen')));
            $status	 = htmlentities(strip_tags($this->input->post('status')));

            $data_lama = $this->db->get_where('tbl_berita',array('id_berita'=>$id))->row();
            $lamp_surat_undangan_lama = $data_lama->lamp_surat_undangan;

//            echo $lamp_surat_undangan_lama; die;
            if ( ! $this->upload->do_upload('lamp_surat_undangan'))
            {
                $simpan = 'n';
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                $lamp_surat_undangan_baru = "";
            }
            else
            {
                $gbr = $this->upload->data();
                /*keterangan : $lokasi = 'file/bahan_berita';*/
                $filename = "$lokasi/".$gbr['file_name'];
                $lamp_surat_undangan_baru = preg_replace('/ /', '_', $filename);
                $simpan = 'y';


            }


//            echo $lamp_surat_undangan_lama; die;
            $pesan = '';
            $simpan = 'y';

            if ($simpan=='y') {
//					    echo "tes"; die;

                if($lamp_surat_undangan_baru==""){
//                    echo "masih dgn data lama"; die;
                    $lamp_surat_undangan_update = $lamp_surat_undangan_lama;

                    /*ini dia cara hapus file di storage*/
                } else if($lamp_surat_undangan_baru!=""){

//                    echo "data baru tidak sama dengan data lama"; die;
                    $lamp_surat_undangan_update = $lamp_surat_undangan_baru;
                    try{
                        $path_lama_akan_dihapus = $lamp_surat_undangan_lama;
                        unlink($path_lama_akan_dihapus);

                    } catch (Exception $e){
                        echo json_encode($e);
                    }
                }
                $data = array(
                    'lamp_surat_undangan'	=> $lamp_surat_undangan_update,


                    'nama_kegiatan'   		=> $nama_kegiatan,
                    'jenis_dokumen'   		=> $jenis_dokumen,
                    'zona_dokumen'   		=> $zona_dokumen,
                    'status'   		        => $status,

                );
                $this->db->update('tbl_berita',$data, array('id_berita'=>$id));


                $this->session->set_flashdata('msg',
                    '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil disimpan.
							</div>
							<br>'
                );



            } else {

                $this->session->set_flashdata('msg',
                    '
	 							<div class="alert alert-warning alert-dismissible" role="alert">
	 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 									 <span aria-hidden="true">&times;</span>
	 								 </button>
	 								 <strong>Gagal!</strong> '.$pesan.'.
	 							</div>
	 						 <br>'
                );

//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
            }
//					 redirect("berita/v");
            redirect("harmonisasi/v/".$zona_dokumen);

        }




    }

	public function v($aksi='' , $id='', $pemda='',$status='' )
	{
	    //echo $_SESSION['nama_zona'];die;
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');

//		echo $this->uri->segment(1);
//		echo $this->uri->segment(2);
//		echo $this->uri->segment(3); die;

		if($aksi!='t'){
            $this->session->set_flashdata('msg','');

        }
        if($this->session->flashdata('msg')!=null){
            echo $this->session->flashdata('msg');
        }

		if(!isset($ceks)) {
			redirect('web/login');
		}
		    /*tambahan dari sini*/
        $tbl_zona = $this->db->get_where('tbl_zona',array('id_zona'=>$_SESSION['id_zona']));

        $data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
        $data['users']  	 = $this->Mcrud->get_users();
        $data['nama_panjang_admin']  	 = $tbl_zona->row()->nama_panjang;
        $data['zona_pemda']  	 = $tbl_zona->row()->nama_zona;

            /*sampai sini */
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($level=='pelaksana') {
				$this->db->where('id_user',$id_user);
			}
			//dicomment
			if ($aksi=='proses' or $aksi=='konfirmasi' or $aksi=='selesai') {
				$this->db->where('status',$aksi);
			}
			$this->db->order_by('id_berita', 'DESC');
			$data['query'] = $this->db->get("tbl_berita");
			

			$cek_notif = $this->db->get_where("tbl_notif", array('penerima'=>"$id_user"));
			foreach ($cek_notif->result() as $key => $value) {
				$b_notif = $value->baca_notif;
				if(!preg_match("/$id_user/i", $b_notif)) {
					$data_notif = array('baca_notif'=>"$id_user, $b_notif");
					$this->db->update('tbl_notif', $data_notif, array('penerima'=>$id_user));
				}
			}


			if ($aksi == 't') {
//			    echo "tes"; die;
//				if ($level!='pelaksana') {
//					redirect('404');
//				}
                //echo "page tambah nih"; die;
				$p = "tambah";
				$data['judul_web'] 	  = "TAMBAH DOKUMEN HARMONISASI";
			} else if($aksi=='harmonisasi'){
			    //echo "harmonisasi";die;
                //redirect('dashboard');
//                $p = "dashboard_harmonisasi";
                //$p = "dashboard_satker";
                $p = "dashboard_satker_bmn";
                $data['judul_web'] 	  = "DASHBOARD SEWA BMN SATKER";

            } else if($aksi=='draft_pemda'){
                $p = "dashboard_draft_pemda";
                $data['judul_web'] 	  = "DASHBOARD DRAFT PEMDA";

            } else if ($aksi=='pemprov_ntb'){
			    //echo "pemprov ntb nich";die;

                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemprov_ntb"));
                /*tabel ny di select belakangan*/
                $p = "pemprov_ntb";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMPROV NTB";

            } else if($aksi=='pemkot_mataram'){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkot_mataram"));
                $p = "pemkot_mataram";
                $data['judul_web'] 	= "DOKUMEN HARMONISASI PEMKOT MATARAM";
            } else if($aksi=='pemkot_bima'){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkot_bima"));
                $p = "pemkot_bima";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKOT BIMA";
            } else if($aksi=='pemkab_sumbawa_barat'){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_sumbawa_barat"));
                $p = "pemkab_sumbawa_barat";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB SUMBAWA BARAT";
            } else if($aksi=="pemkab_sumbawa"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_sumbawa"));
                $p = "pemkab_sumbawa";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB SUMBAWA ";
            } else if($aksi=="pemkab_lombok_utara"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_lombok_utara"));
                $p = "pemkab_lombok_utara";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK UTARA ";
            } else if($aksi=="pemkab_lombok_timur"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_lombok_timur"));
                $p = "pemkab_lombok_timur";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK TIMUR ";
            } else if($aksi=="pemkab_lombok_tengah"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_lombok_tengah"));
                $p = "pemkab_lombok_tengah";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK TENGAH ";
            } else if($aksi=="pemkab_lombok_barat"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_lombok_barat"));
                $p = "pemkab_lombok_barat";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK BARAT ";
            } else if($aksi=="pemkab_dompu"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_dompu"));
                $p = "pemkab_dompu";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB DOMPU ";
            } else if($aksi=="pemkab_bima"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_bima"));
                $p = "pemkab_bima";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB BIMA ";
            } elseif ($aksi == 'd') {
				$p = "detail";
				$data['judul_web'] 	  = "RINCIAN BAHAN BERITA";
				$data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => "$id"))->row();
				if ($data['query']->id_berita=='') {redirect('404');}

				$data['cek_notif'] = $this->db->get_where("tbl_notif", array('penerima'=>"$id_user", 'id_berita'=>"$id"))->row();

				$b_notif = $data['cek_notif']->baca_notif;
				if(!preg_match("/$id_user/i", $b_notif)) {
					$data_notif = array('baca_notif'=>"$id_user, $b_notif");
					$this->db->update('tbl_notif', $data_notif, array('penerima'=>$id_user, 'id_berita'=>"$id"));
				}
			}
			else if ($aksi == 'e') {
			    if($pemda=='pemprov_ntb'){
//                    echo "edit dokumen pemprov ntb";
//                    echo "<br>id:".$id; die;
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMPROV NTB";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                } else if($pemda=='pemkot_mataram'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKOT MATARAM";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                } else if($pemda=='pemkot_bima'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKOT BIMA";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                } else if($pemda=='pemkab_sumbawa_barat'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB SUMBAWA BARAT";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                } else if($pemda=='pemkab_sumbawa'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB SUMBAWA";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                } else if($pemda=='pemkab_lombok_utara'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK UTARA";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                } else if($pemda=='pemkab_lombok_timur'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK TIMUR";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                }else if($pemda=='pemkab_lombok_tengah'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK TENGAH";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                }else if($pemda=='pemkab_lombok_barat'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB LOMBOK BARAT";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                }else if($pemda=='pemkab_dompu'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB DOMPU";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                }else if($pemda=='pemkab_bima'){
                    $p = "edit";
                    $data['judul_web'] = "EDIT DOKUMEN RAPERDA PEMKAB BIMA";
                    $data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => $id))->row();
                    if ($data['query']->id_berita == '') {
                        redirect('404');
                    }
                }



			} else if ($aksi == 'h') {

//			    echo "hapus data bro"; die;
				$cek_data = $this->db->get_where("tbl_berita", array('id_berita' => $id));
				$lamp_surat_lama = $cek_data->row()->lamp_surat_undangan;
//				echo $lamp_surat_lama; die;
//				echo $cek_data->result_array()[0]['lamp_surat_undangan'];die;
//				echo $cek_data->row()->lamp_surat_undangan;die;
//				echo $cek_data->num_rows();die;
//                $this->db->delete('tbl_berita', array('id_berita' => $id));die;
				if ($cek_data->num_rows() != 0) {
//					if ($cek_data->row()->status!='menunggu') {
//							redirect('404');
//						}
//						if ($cek_data->row()->lampiran != '') {
//							unlink($cek_data->row()->lampiran);
//						}
						// $this->db->delete('tbl_notif', array('pengirim'=>$id_user,'id_berita'=>$id));
						$this->db->delete('tbl_berita', array('id_berita' => $id));
                        try {
                            unlink($lamp_surat_lama);
                        } catch (Exception $e) {
                            echo json_encode($e);
                        }

						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil dihapus.
							</div>
							<br>'
						);


						if($pemda=='pemprov_ntb'){

                            redirect("harmonisasi/v/pemprov_ntb");
                        } else if($pemda=='pemkot_mataram'){
                            redirect("harmonisasi/v/pemkot_mataram");
                        } else if ($pemda=='pemkot_bima'){
                            redirect("harmonisasi/v/pemkot_bima");
                        } else if($pemda=='pemkab_sumbawa_barat'){
                            redirect("harmonisasi/v/pemkab_sumbawa_barat");
                        } else if($pemda=='pemkab_sumbawa'){
                            redirect("harmonisasi/v/pemkab_sumbawa");
                        } else if($pemda=="pemkab_lombok_utara"){
                            redirect("harmonisasi/v/pemkab_lombok_utara");
                        } else if($pemda=="pemkab_lombok_timur"){
                            redirect("harmonisasi/v/pemkab_lombok_timur");
                        } else if ($pemda=="pemkab_lombok_tengah"){
                            redirect("harmonisasi/v/pemkab_lombok_tengah");
                        } else if($pemda=="pemkab_lombok_barat") {
                            redirect("harmonisasi/v/pemkab_lombok_barat");
                        } else if ($pemda=="pemkab_dompu"){
                            redirect("harmonisasi/v/pemkab_dompu");
                        } else if($pemda=="pemkab_bima"){
                            redirect("harmonisasi/v/pemkab_bima");
                        }

//						redirect("berita/v");
						redirect("harmonisasi/v/pemprov_ntb");
				}else {
					redirect('404_content');
				}
			} else if($aksi == 'df'){
			    echo "delete lampiran";die;
            }else{
				$p = "index";
				$data['judul_web'] 	  = "Bahan Berita";
			}

				$this->load->view('users/header', $data);
				$this->load->view("users/harmonisasi/$p", $data);
				$this->load->view('users/footer');

				date_default_timezone_set('Asia/Singapore');
				$tgl = date('Y-m-d H:i:s');

//				$lokasi = 'file/bahan_berita';
				$lokasi = 'file/bahan_draft_raperda';
				$this->upload->initialize(array(
					"upload_path"   => "./$lokasi",
					"allowed_types" => "*"
				));

				if (isset($_POST['btnsimpan'])) {

				    //echo "btnsimpan tambah hasil harmonisasi nich";die;
					$nama_kegiatan 	 = htmlentities(strip_tags($this->input->post('nama_kegiatan')));
					$jenis_dokumen 	 = htmlentities(strip_tags($this->input->post('jenis_dokumen')));
					$zona_dokumen 	 = htmlentities(strip_tags($this->input->post('zona_dokumen')));
					$status 	 = htmlentities(strip_tags($this->input->post('status')));

					$simpan = '';



                    if ( ! $this->upload->do_upload('lamp_surat_undangan'))
                    {
                        $simpan = 'n';
                        $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                    }
                    else
                    {
                        $gbr = $this->upload->data();
                        $filename = "$lokasi/".$gbr['file_name'];
                        $lamp_surat_undangan = preg_replace('/ /', '_', $filename);
                        $simpan = 'y';
                    }

					if ($simpan=='y') {
//					    echo "tes"; die;
                        /*darimana id_user*/
						$data = array(
							'lamp_surat_undangan'	=> $lamp_surat_undangan,

							'id_user'				=> $id_user,
							'nama_kegiatan'   		=> $nama_kegiatan,
							'tgl_input'   		    => date('Y-m-d H:i:s'),
							'tgl_update'   		    => date('Y-m-d H:i:s'),
							'jenis_dokumen'   		=> $jenis_dokumen,
							'zona_dokumen'   		=> $zona_dokumen,

							'status'   		        => $status,

						);
						$this->db->insert('tbl_berita',$data);

						$id_berita = $this->db->insert_id();
						$this->Mcrud->kirim_notif($id_user,'humas',$id_berita,'berita','pelaksana_kirim_berita');

						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil disimpan.
							</div>
							<br>'
						   );
						}else {
						
							 $this->session->set_flashdata('msg',
	 							'
	 							<div class="alert alert-warning alert-dismissible" role="alert">
	 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 									 <span aria-hidden="true">&times;</span>
	 								 </button>
	 								 <strong>Gagal!</strong> '.$pesan.'.
	 							</div>
	 						 <br>'
	 						);

//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
					 }
//					 redirect("berita/v");

//					 redirect("harmonisasi/v/pemprov_ntb");
					 redirect("harmonisasi/v/".$zona_dokumen);

				}

				/*nah ini dia ketika di klik simpan saat selesai edit*/
        if (isset($_POST['btnsimpan_edit'])) {
//            echo $pemda;die;

            //echo "btnsimpan_edit nih"; die;
            $nama_kegiatan 	 = htmlentities(strip_tags($this->input->post('nama_kegiatan')));
            $jenis_dokumen 	 = htmlentities(strip_tags($this->input->post('jenis_dokumen')));
            $zona_dokumen 	 = htmlentities(strip_tags($this->input->post('zona_dokumen')));
            $status	 = htmlentities(strip_tags($this->input->post('status')));

            $data_lama = $this->db->get_where('tbl_berita',array('id_berita'=>$id))->row();
            $lamp_surat_undangan_lama = $data_lama->lamp_surat_undangan;

//            echo $lamp_surat_undangan_lama; die;
            if ( ! $this->upload->do_upload('lamp_surat_undangan'))
            {
                $simpan = 'n';
                $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                $lamp_surat_undangan_baru = "";
            }
            else
            {
                $gbr = $this->upload->data();
                /*keterangan : $lokasi = 'file/bahan_berita';*/
                $filename = "$lokasi/".$gbr['file_name'];
                $lamp_surat_undangan_baru = preg_replace('/ /', '_', $filename);
                $simpan = 'y';


            }


//            echo $lamp_surat_undangan_lama; die;
            $pesan = '';
            $simpan = 'y';

            if ($simpan=='y') {
//					    echo "tes"; die;

                if($lamp_surat_undangan_baru==""){
//                    echo "masih dgn data lama"; die;
                    $lamp_surat_undangan_update = $lamp_surat_undangan_lama;

                    /*ini dia cara hapus file di storage*/
                } else if($lamp_surat_undangan_baru!=""){

//                    echo "data baru tidak sama dengan data lama"; die;
                    $lamp_surat_undangan_update = $lamp_surat_undangan_baru;
                    try{
                        $path_lama_akan_dihapus = $lamp_surat_undangan_lama;
                        unlink($path_lama_akan_dihapus);

                    } catch (Exception $e){
                        echo json_encode($e);
                    }
                }
                $data = array(
                    'lamp_surat_undangan'	=> $lamp_surat_undangan_update,


                    'nama_kegiatan'   		=> $nama_kegiatan,
                    'jenis_dokumen'   		=> $jenis_dokumen,
                    'zona_dokumen'   		=> $zona_dokumen,
                    'tgl_update'   		    => date('Y-m-d H:i:s'),
                    'status'   		        => $status,

                );
                $this->db->update('tbl_berita',$data, array('id_berita'=>$id));


                $this->session->set_flashdata('msg',
                    '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil disimpan.
							</div>
							<br>'
                );



            } else {

                $this->session->set_flashdata('msg',
                    '
	 							<div class="alert alert-warning alert-dismissible" role="alert">
	 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 									 <span aria-hidden="true">&times;</span>
	 								 </button>
	 								 <strong>Gagal!</strong> '.$pesan.'.
	 							</div>
	 						 <br>'
                );

//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
            }
//					 redirect("berita/v");
            redirect("harmonisasi/v/".$zona_dokumen);

        }




    }


	public function ajax()
	{
		if (isset($_POST['btnkirim'])) {
			$id = $this->input->post('id');
			$data = $this->db->get_where('tbl_berita',array('id_berita'=>$id))->row();
			$pesan_humas = $data->pesan_humas;
			$status = $data->status;
			echo json_encode(array('pesan_petugas'=>$pesan_humas,'status'=>$status));
		} else {
			redirect('404');
		}
	}

}
