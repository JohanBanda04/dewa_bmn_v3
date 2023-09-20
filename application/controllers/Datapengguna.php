<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datapengguna extends CI_Controller {

	public function index()
	{
		redirect('datapengguna/v');
	}

	public function v($aksi='', $id='')
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');




		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($level != 'superadmin') {
					redirect('404_content');
			}

			$this->db->where_not_in('level', 'superadmin');
			$data['query'] = $this->db->get("sb_user");
			$data['query_satker'] = $this->db->get("sb_satker")->result();
			//echo "<pre>"; print_r($data['query_satker']);die;

				if ($aksi == 't') {
					$p = "tambah";
					$data['judul_web'] 	  = "Registrasi Pengguna";
				} elseif ($aksi == 'e') {
					$p = "edit";
					$data['judul_web'] 	  = "Edit Data Pengguna";
					$this->db->where_not_in('level', 'superadmin');
					$data['query'] = $this->db->get_where("sb_user", array('id' => "$id"))->row();
					if ($data['query']->id=='') {redirect('404');}
				} elseif ($aksi == 'h') {
//                    echo "hapus";die;
                    //echo $id;die;
					$this->db->where_not_in('level', 'superadmin');
//					$cek_data = $this->db->get_where("tbl_user", array('id_user' => "$id"));
					$cek_data = $this->db->get_where("sb_user", array('id' => "$id"));

					if ($cek_data->num_rows () != 0) {
							//$this->db->delete('tbl_user', array('id_user' => $id));
							$this->db->delete('sb_user', array('id' => $id));
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
							redirect("datapengguna/v");
					}else {
						redirect('404');
					}
				}else{
					$p = "index";
					$data['judul_web'] 	  = "Pengguna";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/datapengguna/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('Y-m-d H:i:s');

					if (isset($_POST['btnsimpan'])) {
						$nama 	 = htmlentities(strip_tags($this->input->post('nama')));
						$level_to_save  = htmlentities(strip_tags($this->input->post('level')));
						$username = htmlentities(strip_tags($this->input->post('username')));
						$password  = htmlentities(strip_tags($this->input->post('password')));
						$password2 = htmlentities(strip_tags($this->input->post('password2')));
                        $satker_id = htmlentities(strip_tags($this->input->post('satker')));

                        //echo crypt($password, "salt-coba") ;die;

//						echo $nama."<br>";
//						echo $level_to_save."<br>";
//						echo $username."<br>";
//						echo $password."<br>";
//						echo $password2."<br>"; ;
//						echo $satker_id."<br>"; die;

						$cek_data = $this->db->get_where('sb_user', array('username'=>$username));
						$pesan  = '';
						$simpan = 'y';

						if ($cek_data->num_rows()!=0) {
							$simpan = 'n';
							$pesan  = "Username '<b>$username</b>' sudah ada";
						} else {
							if ($password!=$password2) {
								$simpan = 'n';
								$pesan  = "Password tidak cocok!";
							}
						}

						/*cara simpan password dengan enkripsi*/
						if ($simpan=='y') {
							$data = array(
								'nama_lengkap' => $nama,
								'username' 		 => $username,
								'password' 		 => crypt($password, "salt-coba"),
								'level' 			 => $level_to_save,
								'tgl_input' 			 => date('Y-m-d H:i:s'),
								'tgl_update' 			 => date('Y-m-d H:i:s'),
								'satker_id' 			 => $satker_id,
							);
							$this->db->insert('sb_user',$data);
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Sukses7!</strong> Berhasil disimpan.
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
							 redirect("datapengguna/v/t");
						}
						 redirect("datapengguna/v");
					}


					if (isset($_POST['btnupdate'])) {
					    //echo "update";die;
						$nama 	 = htmlentities(strip_tags($this->input->post('nama')));
                        $level_to_save  = htmlentities(strip_tags($this->input->post('level')));
						$username = htmlentities(strip_tags($this->input->post('username')));
						$password  = htmlentities(strip_tags($this->input->post('password')));
						$password2 = htmlentities(strip_tags($this->input->post('password2')));
						$satker_id = htmlentities(strip_tags($this->input->post('satker')));
//						echo $nama."<br>";
//						echo $level."<br>";
//						echo $username."<br>";
//						echo $password."<br>";
//						echo $password2."<br>";
//						echo $satker_id."<br>"; die;
						$data_lama = $this->db->get_where('sb_user', array('id'=>$id))->row();
						$cek_data  = $this->db->get_where('sb_user', array(
						    'username'=>$username,
                            'username!='=>$data_lama->username)
                        );

//						echo '<pre>'; var_dump($cek_data) ; die;
						
						$pesan  = '';

						$simpan = 'y';

						if ($cek_data->num_rows()!=0) {
							$simpan = 'n';
							$pesan  = "Username '<b>$username</b>' sudah ada";
						}else {
							$pass_lama = $data_lama->password;
							if ($password=='') {
								$password = $pass_lama;
							}else {
								if ($password!=$password2) {
									$simpan = 'n';
									$pesan  = "Password tidak cocok!";
								}
							}
						}
						if ($simpan=='y') {
						$data = array(
                            'nama_lengkap' => $nama,
                            'username' 		 => $username,
                            'password' 		 => $password,
                            'level' 			 => $level_to_save,
                            'tgl_update' 			 => date('Y-m-d H:i:s'),
                            'satker_id' 			 => $satker_id,


//							'nama_lengkap' => $nama,
//							'username' 		 => $username,
//							'password' 		 => $password,
//							'level'			=> $level
						);
						$this->db->update('sb_user',$data, array('id'=>$id));

						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses5!</strong> Berhasil disimpan.
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
										 redirect("datapengguna/v/e/".hashids_encrypt($id));
					 	 }
						 redirect("datapengguna/v");
					}
		}
	}

}
