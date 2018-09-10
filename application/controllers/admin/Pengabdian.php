<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengabdian extends CI_Controller {
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
			'page' => 'pengabdian_admin',
			'link' => 'pengabdian',
			'script' => 'script/pengabdian_admin',
			'list' => $this->Model->ambil_banyak_kondisi('tb_usulan_proposal', array('jenis' => 'pengabdian','delete' => '0') )->result(),
		);
		$this->load->view('template/wrapper', $data);
	}

	public function detail($id){
		$data = array(
			'page' => 'detail_proposal_admin',
			'link' => 'pengabdian',
			'script' => 'script/pengabdian_admin',
			'list' => $this->Model->ambil('id_proposal',$id,'tb_usulan_proposal')->row(),
			'file' => $this->Model->ambil_banyak_kondisi_order('tb_file_upload', array('id_proposal' => $id), 'waktu_upload', 'DESC' )->row(),
			'list_afiliasi_dosen' => $this->Model->ambil('id_proposal',$id,'tb_afiliasi_dosen')->result(),
			'list_afiliasi_mhs' => $this->Model->ambil('id_proposal',$id,'tb_afiliasi_mhs')->result(),
			'list_mitra' => $this->Model->ambil('id_proposal',$id,'tb_mitra')->result(),
		);
		$this->load->view('template/wrapper', $data);

	}

	public function rev($id){
		$data = array(
			'page' => 'rev',
			'link' => 'pengabdian',
			'script' => 'script/pengabdian_admin',
			'list' => $this->Model->ambil('id_proposal',$id,'tb_usulan_proposal')->row(),
			'file' => $this->Model->ambil_banyak_kondisi_order('tb_file_upload', array('id_proposal' => $id), 'waktu_upload', 'DESC' )->row(),
			'list_reviewer' => $this->Model->list_data_all('tb_reviewer'),
			'list_reviewer_proposal' => $this->Model->list_join_where('tb_review_proposal','tb_reviewer','tb_review_proposal.id_reviewer=tb_reviewer.id_reviewer','id_proposal',$id)->result(),
		);
		$this->load->view('template/wrapper', $data);

	}

	 public function tambah_reviewer(){
		
		$data = array(
			'id_proposal' => $this->input->post('id_proposal', true),
			'id_reviewer' => $this->input->post('id_reviewer', true),
			'id_file_upload' => $this->input->post('id_file_upload', true),
			'status' => $this->input->post('status', true),
			'lock_nilai' => '0',
		);

		// var_dump($data);
		// die();

		$simpan =  $this->Model->simpan_data($data, 'tb_review_proposal');
		if($simpan){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil disimpan !</div>';
			echo '<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';		
		}
	}

	public function hapus_reviewer(){
        $id=$this->input->post('id', true);
     
        //hapus tabel upload_mandiri
        $hapus = $this->Model->hapus('id_review_proposal',$id,'tb_review_proposal');
        if($hapus){
            echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil dihapus !</div>';
            echo'<script>location.reload();</script>';
        }else{
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Gagal dihapus !</div>';
        }
    }

	public function ubah_approve(){
		$id=$this->input->post('id_proposal', true);
		$data = array(
			'status' => $this->input->post('status', true),
			'komentar' => $this->input->post('komentar', true),

		);
		// var_dump($id);
		// die();
		$ubah = $this->Model->update('id_proposal',$id, 'tb_usulan_proposal', $data);

		if($ubah){
            echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil disimpan !</div>';
            // echo'<script>window.location.href="'.base_url().'admin/pengabdian";</script>';
            echo'<script>location.reload();</script>';
		}else{
		    echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Gagal diupdate !</div>';
		}
	}

	public function hapus_usulan(){
		$id = $this->input->post('id', true);
		//hapus tabel usulan
		$data = array(
			'delete' => '1',
			'delete_by' => $this->session->userdata('nama'),
			'delete_when' => date('Y-m-d:H-i-s'),
		);


		$hapus = $this->Model->update('id_proposal', $id, 'tb_usulan_proposal', $data);
		
		if($hapus){
		echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil dihapus !</div>';
            echo'<script>location.reload();</script>';
        }else{
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Gagal dihapus !</div>';
        }

	}

	public function ubah_dana(){
		$id=$this->input->post('id_proposal2', true);
		$data = array(
			'didanai' => $this->input->post('didanai', true)

		);
		// var_dump($id);
		// die();
		$ubah = $this->Model->update('id_proposal',$id, 'tb_usulan_proposal', $data);

		if($ubah){
            echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil disimpan !</div>';
            // echo'<script>window.location.href="'.base_url().'admin/penelitian";</script>';
            echo'<script>location.reload();</script>';
		}else{
		    echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Gagal diupdate !</div>';
		}
	}

}