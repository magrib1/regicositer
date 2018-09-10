<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posting extends CI_Controller {
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
			'page' => 'posting_admin',
			'link' => 'posting',
			'script' => 'script/posting',
			'list' => $this->Model->list_data_all('tb_posting'),
		);
		$this->load->view('template/wrapper', $data);
	}

	public function tambah_posting(){
		$data = array(
			'judul_posting' => $this->input->post('judul_posting', true),
			'tgl_posting' => $this->input->post('tgl_posting', true),
			'isi_posting' => $this->input->post('isi_posting', true)
		);
		// var_dump($data);
		// die();
		$simpan = $this->Model->simpan_data($data, 'tb_posting');
		if($simpan){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close"&times;</a>Berhasil disimpan !</div>';
			echo '<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';
		}
	}

	public function ambil_posting(){
		$id = $this->input->post('id',true);
		$data = $this->Model->ambil('id_posting',$id,'tb_posting')->row();
		echo json_encode($data);
	}

	public function ubah_posting(){
		$id=$this->input->post('id_posting', true);
		$data = array(
			'judul_posting' => $this->input->post('judul_posting', true),
			'tgl_posting' => $this->input->post('tgl_posting', true),
			'isi_posting' => $this->input->post('isi_posting', true)
		);
		$ubah = $this->Model->update('id_posting', $id, 'tb_posting', $data);
		if($ubah){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil diupdate !</div>';
            echo'<script>location.reload();</script>';
		}else{
		    echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Gagal diupdate !</div>';
		}
	}

	public function hapus_posting(){
		$id = $this->input->post('id', true);
		//hapus tabel posting
		$hapus = $this->Model->hapus('id_posting',$id,'tb_posting');
		if($hapus){
		echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil dihapus !</div>';
            echo'<script>location.reload();</script>';
        }else{
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Gagal dihapus !</div>';
        }

	}

}