<?php

class admin_model extends CI_Model {

	function CekAdminLogin($data) {

		$cek['username'] = mysql_real_escape_string($data['username']);
		$cek['password'] = md5(mysql_real_escape_string($data['password']));

		$ceklogin = $this->db->get_where('tbl_admin',$cek);

		if (count($ceklogin->result())>0) {

			foreach ($ceklogin->result() as $value) {
				$sess_data['logged_in'] 	= 'LoginOke';
				$sess_data['id_admin']  	= $value->id_admin;
				$sess_data['nama_admin']  	= $value->nama_admin;
				$sess_data['username']  	= $value->username;
				$sess_data['password']  	= $value->password;


				$this->session->set_userdata($sess_data);

			}
			redirect("adminweb/home");
		}
		else {
			$this->session->set_flashdata("error","Username atau Password Anda Salah!");
			redirect('adminweb/index');
		}

	}






	//Awal Bank
	function GetBank() {
		return $this->db->query("select * from tbl_bank order by id_bank desc");
	}
	function DeleteBank($id_bank) {
		return $this->db->query("delete from tbl_bank where id_bank='$id_bank' ");
	}

	function GetBankEdit($id_bank) {
		return $this->db->query("select * from tbl_bank where id_bank='$id_bank' ");
	}
	//Ahir Bank




	//Awal admin
	function Getadmin() {
		return $this->db->query("select *from tbl_admin order by id_admin desc");
	}



    function AdminEdit($id_admin,$nama,$username,$password) {
        return $this->db->query("update tbl_admin set nama_admin='$nama',username='$username',password='$password' where id_admin='$id_admin' ");
    }


	//Akhir admin

    //Awal users
    function GetUsers() {
        return $this->db->query("select *from tbl_users order by id_users desc");
    }

    function Deleteusers($id) {
        return $this->db->query("delete from tbl_users where id_users='$id'");
    }
    //akhir users




	//Awal Toko

	function GetToko() {
		return $this->db->query("select * from tbl_toko order by id_toko desc");
	}

	function GetMaxKodeToko() {

		$query = $this->db->query("select MAX(RIGHT(kode_toko,5)) as kode_toko from tbl_toko");
		$kode ="";
		if($query->num_rows()>0) {
			foreach ($query->result() as $tampil) {
				$kd = ((int)$tampil->kode_toko)+1;
				$kode = sprintf("%05s",$kd);
			}
		}
		else {
			$kode="00001";
		}
		return "BMW".$kode;
	}

	function DeleteToko($id_toko) {
		return $this->db->query("delete from tbl_toko where id_toko='$id_toko' ");
	}

	function EditToko($id_toko){
		return $this->db->query("select * from tbl_toko where id_toko='$id_toko' ");
	}
	//Akhir Toko



	//Awal Transaksi

	function GetTransaksi() {
		return $this->db->query("select a.*,b.*,c.* from tbl_transaksi a
		join tbl_bank b on a.bank_id=b.id_bank join  tbl_users c on a.id_users=c.id_users
		where a.status='0' or a.status='2' order by a.id_transaksi asc  ");
	}

	function UpdateTransaksiHeader($id_transaksi,$status) {
		return $this->db->query("update tbl_transaksi set status='$status' where id_transaksi='$id_transaksi'  ");
	}

	function GetTransaksiheader($id_transaksi) {
		return $this->db->query("select a.*,b.*,c.* from tbl_transaksi a
		join tbl_bank b on a.bank_id=b.id_bank join  tbl_users c on a.id_users=c.id_users
                where a.id_transaksi='$id_transaksi' ");
	}

	function GetDetailTransaksi($kode_transaksi) {
		return $this->db->query("select * from tbl_transaksi_detail where kode_transaksi='$kode_transaksi' order by id_transaksi_detail desc ");
	}

	function GetDetailTotal($kode_transaksi) {
		return $this->db->query("select sum(harga) as total from tbl_transaksi_detail where kode_transaksi='$kode_transaksi' order by id_transaksi_detail desc ");
	}

    function GetTransaksiSudah() {

        return $this->db->query("select a.*,b.* from tbl_pesanan a
		join tbl_toko b on a.id_toko=b.id_toko order by a.id_pesanan asc  ");

    }

	//Akhir Transaki

    function GetDetailPembayaran($kode_transaksi) {
        return $this->db->query("select * from tbl_pembayaran where kode_transaksi='$kode_transaksi' ");

    }


	
}