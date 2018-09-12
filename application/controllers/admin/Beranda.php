<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Model');
		if(!$this->session->userdata('is_login') || $this->session->userdata('level') != 'admin'){
            echo '<script>alert("Maaf, anda tidak boleh mengakses halaman ini")</script>';
            echo'<script>window.location.href="'.base_url().'";</script>';
        }
	}

	public function index(){
		$data = array(
			'page' => 'beranda_admin',
			'link' => 'beranda',
			'script' => '',
			'hitung_fullpaper' => $this->Model->default->query("SELECT COUNT(*) as jml FROM tb_fullpaper")->row(),
			'fullpaper_approve' => $this->Model->default->query("SELECT COUNT(*) as jml FROM tb_fullpaper WHERE approve ='Approve' ")->row(),
			'hitung_payment' => $this->Model->default->query("SELECT COUNT(*) as jml FROM tb_payment")->row(),
			'payment_approve' => $this->Model->default->query("SELECT COUNT(*) as jml FROM tb_payment WHERE approve ='Approve' ")->row(),
		);
		$this->load->view('template/wrapper', $data);
	}

}