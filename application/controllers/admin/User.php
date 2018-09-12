<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Model');
		if(!$this->session->userdata('is_login') || $this->session->userdata('level') != 'admin')  {
            echo '<script>alert("Maaf, anda tidak boleh mengakses halaman ini")</script>';
            echo'<script>window.location.href="'.base_url().'";</script>';
        }
	}

	public function index(){
		$data = array(
			'page' => 'user_admin',
			'link' => 'user',
			'script' => 'script/user_admin',
			'list' => $this->Model->list_data_all('tb_login'),
		);
		$this->load->view('template/wrapper', $data);
	}

	public function tambah_user(){
		$data = array(
			'username' => $this->input->post('username', true),
			'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT) ,
			'level' => 'admin'
		);
		// var_dump($data);
		// die();
		$simpan = $this->Model->simpan_data($data, 'tb_login');
		if($simpan){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close"&times;</a>Berhasil disimpan !</div>';
			echo '<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';
		}
	}

	public function ambil_user(){
		$id = $this->input->post('id',true);
		$data = $this->Model->ambil('id_login',$id,'tb_login')->row();
		echo json_encode($data);
	}

	public function ubah_user(){
		$id=$this->input->post('id_login', true);


		if ($this->input->post('password', true) == '') {
			$data = array(
			
			'username' => $this->input->post('username', true)
		);
		}else{
			$data = array(
			
			'username' => $this->input->post('username', true),
			'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT) ,
		);
		}

		$ubah = $this->Model->update('id_login', $id, 'login', $data);
		if($ubah){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil diupdate !</div>';
            echo'<script>location.reload();</script>';
		}else{
		    echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Gagal diupdate !</div>';
		}
	}

	public function hapus_user(){
		$id = $this->input->post('id', true);
		//hapus tabel user
		$hapus = $this->Model->hapus('id_login',$id,'login');
		if($hapus){
		echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil dihapus !</div>';
            echo'<script>location.reload();</script>';
        }else{
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Gagal dihapus !</div>';
        }

	}


}