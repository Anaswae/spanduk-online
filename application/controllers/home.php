i<?php

class home extends CI_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');

    }

	public function index() {
		$data['bank'] 			= $this->home_model->GetBank();
		$data['toko']			= $this->home_model->GetToko();


		$this->load->view('home/index',$data);
	}

	public function login() {
        if($this->session->userdata("logged_user")!="LoginOke") {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {

                $data['bank'] = $this->home_model->GetBank();
                $data['toko'] = $this->home_model->GetToko();


                $this->load->view('home/login', $data);

            } else {

                $data['username'] = $this->input->post('username');
                $data['password'] = $this->input->post('password');

                $this->home_model->CekHomeLogin($data);

            }
        }
        else{
            redirect("home");
        }
	}

    public function logout() {
        $this->session->sess_destroy();
        ?>
        <script type="text/javascript">
            alert("Anda Telah Berhasil Logout!");
        </script>
        <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."home'>";
    }

    public function daftar() {

		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		if ($this->form_validation->run()==FALSE) {

		$data['bank'] 			= $this->home_model->GetBank();
		$data['toko']			= $this->home_model->GetToko();
		$this->load->view('home/daftar',$data);

		}
	}
		public function daftar_kirim() {

		$nama 		= $this->input->post('nama_users');
		$username 	= $this->input->post('username');
		$email 		= $this->input->post('email');
		$password	= md5($this->input->post('password'));
		$phone 		= $this->input->post('phone');
		$alamat 	= $this->input->post('alamat');
		$provinsi	= $this->input->post('provinsi');
		$kota 		= $this->input->post('kota');

            $cek = $this->home_model->UsersSama($username);

            if ($cek->num_rows() > 0) {
                ?>
                <script type="text/javascript">
                    alert("Pendaftaran Gagal, Username yang anda gunakan telah ada. Silahkan gunakan username lain\nTerima Kasih");
                </script>
                <?php
                echo "<meta http-equiv='refresh' content='0; url=".base_url()."home/login'>";
            } else {
                $this->home_model->InsertPendaftaran($nama,$username,$email,$password,$phone,$alamat,$provinsi,$kota);

                $this->session->set_flashdata('sukses','Data Berhasil Dikirim');
                ?>
                <script type="text/javascript">
                    alert("Pendaftaran Berhasil, Silahkan Login Menggunakan Username dan Passowrd Anda.\n Terima Kasih");
                </script>
                <?php
                echo "<meta http-equiv='refresh' content='0; url=".base_url()."home/login'>";
            }


	}

    function pesan() {  
        
        $data['bank']           = $this->home_model->GetBank();
        $data['toko']         = $this->home_model->GetToko();
        $data['kode_pesan'] = $this->home_model->GetMaxKodePesan();
        $data['id_toko']= $this->uri->segment(3);
        if($this->session->userdata("logged_user")== NULL) {
             $this->session->set_flashdata("checkout","Login untuk melakukan pesanan!");
            redirect('home/login');
        }
        $this->load->view('home/pesan', $data);
    }

    public function pesan_simpan() {

        $kode_pesan      = $this->input->post('kode_pesan');
        $id_toko         = $this->input->post('id_toko');
        $jenis_pesanan   = $this->input->post('jenis_pesanan');
        $ukuran          = $this->input->post('ukuran');
        $biaya           = $this->input->post('biaya');
        $pesan           = $this->input->post('pesan');

            
        $this->home_model->InsertPesanan($kode_pesan,$id_toko,$jenis_pesanan,$ukuran,$biaya,$pesan);

        $this->session->set_flashdata('sukses','Data Berhasil Dikirim');
        ?>
        <script type="text/javascript">
            alert("Pesanan Berhasil, No Pesanan <?php echo $kode_pesan ?>, Harap menunggu 2x24 Jam agar pesanan diproses. Untuk info/perubahan desain silahkan hubungi nomor 085263014676.Sertakan nomor pesanan ketika ingin menghubungi\nTerima Kasih");
        </script>
        <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."home/index'>";
    


    }   


	public function cara_belanja() {


		$data['bank'] 			= $this->home_model->GetBank();
        
        



		$this->load->view('home/cara_belanja',$data);
	}

	public function tentang_kami () {
		$data['bank'] 			= $this->home_model->GetBank();
		


		
		$this->load->view('home/tentang_kami',$data);
	}



    public function profile () {
        $data['bank'] 			= $this->home_model->GetBank();
        
        $data['toko']			= $this->home_model->GetToko();
        $id                     = $this->uri->segment(3);
        $data['detail_users']	= $this->home_model->GetUsers($id);

        $this->load->view('home/profile',$data);
    }
    public function profil_update() {

	    $id 		= $this->input->post('id_users');
        $nama 		= $this->input->post('nama_users');
        $username 	= $this->input->post('username');
        $email 		= $this->input->post('email');
        $password	= md5($this->input->post('password'));
        $phone 		= $this->input->post('phone');
        $alamat 	= $this->input->post('alamat');
        $provinsi	= $this->input->post('provinsi');


        $this->home_model->InsertProfileUpdate($id,$nama,$username,$email,$password,$phone,$alamat,$provinsi);

        $this->session->set_flashdata('sukses','Data Berhasil Dikirim');
        ?>
        <script type="text/javascript">
            alert("Data Berhasil Di Update!");
        </script>
        <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."home/profile/$id'>";
    }
}