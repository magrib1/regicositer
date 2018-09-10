<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Model');
		if(!$this->session->userdata('is_login') || $this->session->userdata('level_ppm') != 'admin'){
            echo '<script>alert("Maaf, anda tidak boleh mengakses halaman ini")</script>';
            echo'<script>window.location.href="'.base_url().'";</script>';
        }
	}

	public function index(){
		$data = array(
			'page' => 'beranda_admin',
			'link' => 'beranda',
			'script' => '',
			'tahun' => $this->Model->group_where_banyak('YEAR(tahun_diajukan) as tahun','vw_rekap_proposal',array('ketua_peneliti<>' => '' ,'delete' => '0', 'YEAR(tahun_diajukan)' => date("Y")), 'YEAR(tahun_diajukan)'),
		);
		$this->load->view('template/wrapper', $data);
	}

}