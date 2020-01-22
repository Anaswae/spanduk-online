<?php

class adminweb extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index() {
		$this->load->view('adminweb/login');
	}

	public function login() {

		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		if ($this->form_validation->run()==FALSE) {

		$this->load->view('adminweb/login');

		}
		else {

			$data['username'] = $this->input->post('username');
			$data['password'] = $this->input->post('password');

			$this->admin_model->CekAdminLogin($data);

		}
	}

	public function home() {

		if($this->session->userdata("logged_in")!=="") {
			$this->template->load('template','adminweb/home');
		}
		else{
			redirect('adminweb');

		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect("adminweb");
	}


	//Awal Bank
	public function bank() {

		$data['data_bank'] = $this->admin_model->GetBank();
		$this->template->load('template','adminweb/bank/index',$data);

	}

	public function bank_tambah() {

		$this->template->load('template','adminweb/bank/add');
	}

	public function bank_simpan() {


			$this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required');
			$this->form_validation->set_rules('nama_pemilik', 'Nama Pemilik', 'required');
			$this->form_validation->set_rules('no_rekening', 'No Rekening', 'required');

			if ($this->form_validation->run() == FALSE)
			{

				$this->template->load('template','adminweb/bank/add');
			}
			else {

				if(empty($_FILES['userfile']['name']))
				{

						$in_data['nama_bank'] = $this->input->post('nama_bank');
						$in_data['nama_pemilik'] = $this->input->post('nama_pemilik');
						$in_data['no_rekening'] = $this->input->post('no_rekening');
						$this->db->insert("tbl_bank",$in_data);

					$this->session->set_flashdata('berhasil','Bank Berhasil Disimpan');
					redirect("adminweb/bank");
				}
				else
				{
					$config['upload_path'] = './images/bank/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= TRUE;
					$config['remove_spaces']	= TRUE;
					$config['max_size']     = '3000';
					$config['max_width']  	= '3000';
					$config['max_height']  	= '3000';


					$this->load->library('upload', $config);

					if ($this->upload->do_upload("userfile")) {
						$data	 	= $this->upload->data();

						/* PATH */
						$source             = "./images/bank/".$data['file_name'] ;
						$destination_thumb	= "./images/bank/thumb/" ;
						$destination_medium	= "./images/bank/medium/" ;
						// Permission Configuration
						chmod($source, 0777) ;

						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;

						/// Limit Width Resize
						$limit_medium   = 800 ;
						$limit_thumb    = 270 ;

						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

						// Percentase Resize
						if ($limit_use > $limit_thumb) {
							$percent_medium = $limit_medium/$limit_use ;
							$percent_thumb  = $limit_thumb/$limit_use ;
						}

						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_thumb ;

						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;

						$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
						$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

			 			// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_medium ;

						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;

						$in_data['nama_bank'] = $this->input->post('nama_bank');
						$in_data['nama_pemilik'] = $this->input->post('nama_pemilik');
						$in_data['no_rekening'] = $this->input->post('no_rekening');
						$in_data['gambar'] = $data['file_name'];


						$this->db->insert("tbl_bank",$in_data);



						$this->session->set_flashdata('berhasil','Bank Berhasil Disimpan');
						redirect("adminweb/bank");

					}
					else
					{
						$this->template->load('template','adminweb/bank/error');
					}
				}

			}

	}

	public function bank_delete() {
		$id_bank = $this->uri->segment(3);
		$this->admin_model->DeleteBank($id_bank);

		$this->session->set_flashdata('message','Bank Berhasil Dihapus');
		redirect('adminweb/bank');

	}

	public function bank_edit() {
		$id_bank = $this->uri->segment(3);
		$query = $this->admin_model->GetBankEdit($id_bank);
		foreach ($query->result_array() as $tampil) {
			$data['id_bank'] = $tampil['id_bank'];
			$data['nama_bank'] = $tampil['nama_bank'];
			$data['nama_pemilik'] = $tampil['nama_pemilik'];
			$data['no_rekening'] = $tampil['no_rekening'];
			$data['gambar'] = $tampil['gambar'];
		}
		$this->template->load('template','adminweb/bank/edit',$data);
	}

	public function bank_update() {
		$id['id_bank'] = $this->input->post("id_bank");

		if(empty($_FILES['userfile']['name']))
				{

						$in_data['nama_bank'] = $this->input->post('nama_bank');
						$in_data['nama_pemilik'] = $this->input->post('nama_pemilik');
						$in_data['no_rekening'] = $this->input->post('no_rekening');

						$this->db->update("tbl_bank",$in_data,$id);

					$this->session->set_flashdata('update','Bank Berhasil Diupdate');
					redirect("adminweb/bank");
				}
				else
				{
					$config['upload_path'] = './images/bank/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= TRUE;
					$config['remove_spaces']	= TRUE;
					$config['max_size']     = '3000';
					$config['max_width']  	= '260';
					$config['max_height']  	= '100';


					$this->load->library('upload', $config);

					if ($this->upload->do_upload("userfile")) {
						$data	 	= $this->upload->data();

						/* PATH */
						$source             = "./images/bank/".$data['file_name'] ;
						$destination_thumb	= "./images/bank/thumb/" ;
						$destination_medium	= "./images/bank/medium/" ;

						// Permission Configuration
						chmod($source, 0777) ;

						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;

						/// Limit Width Resize
						$limit_medium   = 90 ;
						$limit_thumb    = 60 ;

						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

						// Percentase Resize
						if ($limit_use > $limit_thumb) {
							$percent_medium = $limit_medium/$limit_use ;
							$percent_thumb  = $limit_thumb/$limit_use ;
						}

						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_thumb ;

						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;

						////// Making MEDIUM /////////////
						$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
						$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_medium ;

						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;

						$in_data['nama_bank'] = $this->input->post('nama_bank');
						$in_data['nama_pemilik'] = $this->input->post('nama_pemilik');
						$in_data['no_rekening'] = $this->input->post('no_rekening');
						$in_data['gambar'] = $data['file_name'];

						$this->db->update("tbl_bank",$in_data,$id);


						$this->session->set_flashdata('update','Bank Berhasil Diupdate');
						redirect("adminweb/bank");

					}
					else
					{
						$this->template->load('template','adminweb/bank/error');
					}
				}

	}
	//Akhir Bank



    //Awal Admin
    public function admin() {
        if($this->session->userdata("logged_in")!=="") {

            $query = $this->admin_model->GetAdmin();
            foreach ($query->result_array() as $tampil) {
                $data['id_admin'] = $tampil['id_admin'];
                $data['nama'] = $tampil['nama_admin'];
                $data['username'] = $tampil['username'];

            }
            $this->template->load('template','adminweb/admin/index',$data);
        }
        else {
            redirect("adminweb");
        }
    }


    public function admin_edit() {
        $id_admin =$this->input->post("id_admin");
        $nama =$this->input->post("nama");
        $username =$this->input->post("username");
        $password =md5($this->input->post("password"));


        $this->admin_model->AdminEdit($id_admin,$nama,$username,$password);
    }


    //Akhir Admin

    //Awal Admin
    public function users() {
        if($this->session->userdata("logged_in")!=="") {
            $data['data_users'] = $this->admin_model->GetUsers();
            $this->template->load('template','adminweb/users/index',$data);
        }
        else {
            redirect("adminweb");
        }
    }

    public function users_delete() {
        $id = $this->uri->segment(3);
        $this->admin_model->Deleteusers($id);

        $this->session->set_flashdata('message','Users Berhasil Dihapus');
        redirect('adminweb/users');
    }

    //Akhir User



	//Awal Toko
	public function toko () {

		$data['data_toko'] = $this->admin_model->GetToko();
		$this->template->load('template','adminweb/toko/index',$data);
	}
	

	public function toko_tambah(){
		$data['kode_toko'] = $this->admin_model->GetMaxKodeToko();
		$this->template->load('template','adminweb/toko/add',$data);
	}

	public function toko_simpan() {
		$this->form_validation->set_rules('nama_toko','Nama Toko','required');

		if ($this->form_validation->run()==FALSE) {

			$data['kode_toko'] = $this->admin_model->GetMaxKodeToko();
			$this->template->load('template','adminweb/toko/add',$data);

		}
		else {

			if(empty($_FILES['userfile']['name']))
				{

						$in_data['kode_toko'] = $this->input->post('kode_toko');
						$in_data['nama_toko'] = $this->input->post('nama_toko');
						$in_data['harga'] = $this->input->post('harga');
						$this->db->insert("tbl_toko",$in_data);

					$this->session->set_flashdata('berhasil','Toko Berhasil Disimpan');
					redirect("adminweb/toko");
				}
				else
				{
					$config['upload_path'] = './images/toko/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= TRUE;
					$config['remove_spaces']	= TRUE;
					$config['max_size']     = '3000';
					$config['max_width']  	= '268';
					$config['max_height']  	= '249';


					$this->load->library('upload', $config);

					if ($this->upload->do_upload("userfile")) {
						$data	 	= $this->upload->data();

						/* PATH */
						$source             = "./images/toko/".$data['file_name'] ;
						$destination_thumb	= "./images/toko/thumb/" ;
						$destination_medium	= "./images/toko/medium/" ;
						// Permission Configuration
						chmod($source, 0777) ;

						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;

						/// Limit Width Resize
						$limit_medium   = 268 ;
						$limit_thumb    = 249 ;

						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

						// Percentase Resize
						if ($limit_use > $limit_thumb) {
							$percent_medium = $limit_medium/$limit_use ;
							$percent_thumb  = $limit_thumb/$limit_use ;
						}

						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_thumb ;

						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;

						$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
						$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

			 			// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_medium ;

						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;

						$in_data['kode_toko'] = $this->input->post('kode_toko');
						$in_data['nama_toko'] = $this->input->post('nama_toko');
						$in_data['harga'] = $this->input->post('harga');
						$in_data['gambar'] = $data['file_name'];



						$this->db->insert("tbl_toko",$in_data);





						$this->session->set_flashdata('berhasil','Toko Berhasil Disimpan');
						redirect("adminweb/toko");

					}
					else
					{
						$this->template->load('template','adminweb/toko/error');
					}
				}

		}
	}

	public function toko_delete() {
		$id_toko = $this->uri->segment(3);
		$this->admin_model->DeleteToko($id_toko);

		$this->session->set_flashdata('message','Toko Berhasil Dihapus');
		redirect('adminweb/toko');

	}

	public function toko_edit() {
		$id_toko = $this->uri->segment(3);
		$query = $this->admin_model->EditToko($id_toko);
		foreach ($query->result_array() as $tampil) {

			$data['id_toko']= $tampil['id_toko'];
			$data['kode_toko']= $tampil['kode_toko'];
			$data['nama_toko']= $tampil['nama_toko'];
			$data['harga']= $tampil['harga'];

		}
		$this->template->load('template','adminweb/toko/edit',$data);
	}

	public function toko_update() {
		$id['id_toko'] = $this->input->post("id_toko");

		if(empty($_FILES['userfile']['name']))
				{

						$in_data['kode_toko'] = $this->input->post('kode_toko');
						$in_data['nama_toko'] = $this->input->post('nama_toko');
						$in_data['harga'] = $this->input->post('harga');

						$this->db->update("tbl_toko",$in_data,$id);

					$this->session->set_flashdata('update','Toko Berhasil Diupdate');
					redirect("adminweb/toko");
				}
				else
				{
					$config['upload_path'] = './images/toko/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= TRUE;
					$config['remove_spaces']	= TRUE;
					$config['max_size']     = '30000';
					$config['max_width']  	= '268';
					$config['max_height']  	= '249';


					$this->load->library('upload', $config);

					if ($this->upload->do_upload("userfile")) {
						$data	 	= $this->upload->data();

						/* PATH */
						$source             = "./images/toko/".$data['file_name'] ;
						$destination_thumb	= "./images/toko/thumb/" ;
						$destination_medium	= "./images/toko/medium/" ;

						// Permission Configuration
						chmod($source, 0777) ;

						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;

						/// Limit Width Resize
						$limit_medium   = 268 ;
						$limit_thumb    = 249 ;

						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

						// Percentase Resize
						if ($limit_use > $limit_thumb) {
							$percent_medium = $limit_medium/$limit_use ;
							$percent_thumb  = $limit_thumb/$limit_use ;
						}

						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_thumb ;

						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;

						////// Making MEDIUM /////////////
						$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
						$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_medium ;

						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;

						$in_data['kode_toko'] = $this->input->post('kode_toko');
						$in_data['nama_toko'] = $this->input->post('nama_toko');
						$in_data['harga'] = $this->input->post('harga');
						$in_data['gambar'] = $data['file_name'];

						$this->db->update("tbl_toko",$in_data,$id);


						$this->session->set_flashdata('update','Toko Berhasil Diupdate');
						redirect("adminweb/toko");

					}
					else
					{
						$this->template->load('template','adminweb/toko/error');
					}
				}

	}

	//Akhir Toko

	//Awal Pesanan
	public function semua_pesanan () {

		if($this->session->userdata("logged_in")!=="") {

			$data['data_transaksi'] = $this->admin_model->GetTransaksiSudah();

			$this->template->load('template','adminweb/transaksi/sudah',$data);


		}
		else {
			redirect("adminweb");
		}

	}

	


}