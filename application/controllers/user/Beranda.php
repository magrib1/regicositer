<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Model');
		if(!$this->session->userdata('is_login') || $this->session->userdata('rule') != 'dosen'){
            echo '<script>alert("Maaf, anda tidak boleh mengakses halaman ini")</script>';
            echo'<script>window.location.href="'.base_url().'";</script>';
        }
		
	}

	public function index(){
		$data = array(
			'page' => 'beranda_author',
			'link' => 'beranda',
			'script' => '',
		);
		$this->load->view('template/wrapper', $data);
	}

}