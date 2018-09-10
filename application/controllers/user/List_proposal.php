<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_proposal extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Model');
		$this->load->model('M_simuk');
		$this->load->model('M_siakad');
		$this->load->model('M_ref');
		$this->load->library('image_lib');
		$this->load->library('upload');
		if(!$this->session->userdata('is_login') || $this->session->userdata('rule') != 'dosen'){
            echo '<script>alert("Maaf, anda tidak boleh mengakses halaman ini")</script>';
            echo'<script>window.location.href="'.base_url().'";</script>';
        }
	}

	public function index(){
		$id_anggota = $this->session->userdata('id');
		$data = array(
			'page' => 'list_proposal',
			'link' => 'list_proposal',
			'script' => '',
			'list' => $this->Model->list_join_where_banyak('tb_usulan_proposal','tb_afiliasi_dosen','tb_usulan_proposal.id_proposal=tb_afiliasi_dosen.id_proposal', array('tb_afiliasi_dosen.id_anggota' => $id_anggota, 'tb_usulan_proposal.delete' => '0', 'tb_usulan_proposal.ketua_peneliti <>' => ''))->result(),
		);
		$this->load->view('template/wrapper', $data);
	}

}