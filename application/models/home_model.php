<?php

class home_model extends CI_Model {

	function CekHomeLogin($data) {

		$cek['username'] = mysql_real_escape_string($data['username']);
		$cek['password'] = md5(mysql_real_escape_string($data['password']));

		$ceklogin = $this->db->get_where('tbl_users',$cek);

		if (count($ceklogin->result())>0) {

			foreach ($ceklogin->result() as $value) {
				$sess_data['logged_user'] 	= 'LoginOke';
				$sess_data['id_users']  	= $value->id_users;
				$sess_data['username']  	= $value->username;
				$sess_data['email']  		= $value->email;				
				$sess_data['password']  	= $value->password;
				$sess_data['nama_users']  	= $value->nama_users;
				$sess_data['phone']  		= $value->phone;
				$sess_data['alamat']  		= $value->alamat;
				$sess_data['provinsi'] 		= $value->provinsi;				
				$sess_data['kota'] 			= $value->kota;				



				$this->session->set_userdata($sess_data);

			}

            ?>
            <script type="text/javascript">
                alert("Login Sukses!");
            </script>
            <?php
            echo "<meta http-equiv='refresh' content='0; url=".base_url()."home'>";
	    }
	    else {
            $this->session->set_flashdata("error","Username atau Password Anda Salah!");
            redirect('home/login');
        }
	}

	function InsertPendaftaran($nama,$username,$email,$password,$phone,$alamat,$provinsi,$kota) {
		return $this->db->query("insert into tbl_users values('','$username','$email','$password','$nama','$phone','$alamat','$provinsi','$kota')");
	}

	function GetMaxKodePesan() {

		$query = $this->db->query("select MAX(RIGHT(kode_pesanan,5)) as kode_pesanan from tbl_pesanan");
		$kode ="";
		if($query->num_rows()>0) {
			foreach ($query->result() as $tampil) {
				$kd = ((int)$tampil->kode_pesanan)+1;
				$kode = sprintf("%05s",$kd);
			}
		}
		else {
			$kode="00001";
		}
		return "PSN".$kode;
	}

	function InsertPesanan($kode_pesan,$id_toko,$jenis_pesanan,$ukuran,$biaya,$pesan) {
		return $this->db->query("insert into tbl_pesanan values('','$kode_pesan','$id_toko','$jenis_pesanan','$ukuran','$biaya','$pesan')");
	}

    function UsersSama($username) {
        return $this->db->query("select * from tbl_users where binary(username)='$username' ");
    }

	function GetBank() {
		return $this->db->query("select * from tbl_bank order by id_bank desc");
	}


	function GetToko() {
		return $this->db->query("select * from tbl_toko order by id_toko desc limit 0,6 ");
	}


	function GetTokoId($id_toko) {
		return $this->db->query("select * from tbl_toko where a.id_toko='$id_toko'");
	}


    function GetUsers($id_users) {
        return $this->db->query("select *from tbl_users where id_users='$id_users'");
    }


    function InsertProfileUpdate($id_users,$nama,$username,$email,$password,$phone,$alamat,$provinsi,$kota) {
        return $this->db->query("update tbl_users set username='$username',nama_users='$nama',email='$email',password='$password',phone='$phone',alamat='$alamat',provinsi='$provinsi' where id_users='$id_users'");
    }
}