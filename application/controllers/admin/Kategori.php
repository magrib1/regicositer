<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Model');
		$this->load->model('M_simuk');
		if(!$this->session->userdata('is_login') || $this->session->userdata('level_ppm') != 'admin'){
            echo '<script>alert("Maaf, anda tidak boleh mengakses halaman ini")</script>';
            echo'<script>window.location.href="'.base_url().'";</script>';
        }
	}

	public function index(){
		$data = array(
			'page' => 'kategori',
			'link' => 'kategori',
			'script' => 'script/kategori',
			'list' => $this->Model->list_data_all('tb_kategori'),
		);
		$this->load->view('template/wrapper', $data);
	}

	public function tambah_kategori(){
		$data = array(
			'nama_kategori' => $this->input->post('nama_kategori', true)
		);
		// var_dump($data);
		// die();
		$simpan = $this->Model->simpan_data($data, 'tb_kategori');
		if($simpan){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close"&times;</a>Berhasil disimpan !</div>';
			echo '<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';
		}
	}

	public function ambil_kategori(){
		$id = $this->input->post('id',true);
		$data = $this->Model->ambil('id_kategori',$id,'tb_kategori')->row();
		echo json_encode($data);
	}

	public function ubah_kategori(){
		$id=$this->input->post('id_kategori', true);
		$data = array(
			'nama_kategori' => $this->input->post('nama_kategori', true)
		);
		$ubah = $this->Model->update('id_kategori', $id, 'tb_kategori', $data);
		if($ubah){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil diupdate !</div>';
            echo'<script>location.reload();</script>';
		}else{
		    echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Gagal diupdate !</div>';
		}
	}

	public function hapus_kategori(){
		$id = $this->input->post('id', true);
		//hapus tabel kategori
		$hapus = $this->Model->hapus('id_kategori',$id,'tb_kategori');
		if($hapus){
		echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil dihapus !</div>';
            echo'<script>location.reload();</script>';
        }else{
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Gagal dihapus !</div>';
        }

	}


}