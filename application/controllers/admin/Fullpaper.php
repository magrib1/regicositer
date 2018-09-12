<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fullpaper extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Model');
		$this->load->library('image_lib');
		$this->load->library('upload');
		if(!$this->session->userdata('is_login') || $this->session->userdata('level') != 'admin'){
            echo '<script>alert("Maaf, anda tidak boleh mengakses halaman ini")</script>';
            echo'<script>window.location.href="'.base_url().'";</script>';
        }
	}

	public function index(){
		$data = array(
			'page' => 'fullpaper',
			'link' => 'fullpaper',
			'script' => 'script/fullpaper',
			'list' => $this->Model->list_join('tb_fullpaper','tb_sub_theme','tb_fullpaper.id_sub_theme=tb_sub_theme.id_sub_theme'),
			'list_sub' =>  $this->Model->list_data_all('tb_sub_theme'),
		);
		$this->load->view('template/wrapper', $data);
	}

	public function tambah_fullpaper(){
		if (!is_uploaded_file($_FILES['paper_upload']['tmp_name'])) {

					$data = array(
					'author' => $this->input->post('author',true),
					'title' => $this->input->post('title',true),
					'id_sub_theme' => $this->input->post('id_sub_theme', true),
					'email' => $this->input->post('email', true),
					'approve' => $this->input->post('approve',true),
					'date_create' => date('Y-m-d H:i:s'),
					);

					// var_dump($data);
					// die();
					$simpan_ticket = $this->Model->simpan_data($data, 'tb_fullpaper');
					if($simpan_ticket){
						echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close"&times;</a>Berhasil disimpan !</div>';
						echo '<script>window.location.href="'.base_url().'admin/fullpaper";</script>';
					}else{
						echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';
					}

			}else{
				$config ['upload_path'] = './assets/file_upload';
	            $config ['allowed_types'] = 'pdf|PDF|doc|DOC|docx|DOCX';
	            $config ['max_size'] = '1024';
	            //$config ['file_name'] = $this->input->post('kd_kategori').date('dmYHis');
	            $this->upload->initialize($config);
	            if ( ! $this->upload->do_upload('paper_upload')){
	                $error = $this->upload->display_errors();
	                // var_dump($error);
	                // die();

	                $msg = array('status' => 'failed', 'text' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> '.$error.' </div>' );
	                        echo json_encode($msg);
	                }else{
	                	$upload_data = $this->upload->data();
						$data = array(
							'author' => $this->input->post('author',true),
							'title' => $this->input->post('title',true),
							'id_sub_theme' => $this->input->post('id_sub_theme', true),
							'email' => $this->input->post('email', true),
							'approve' => $this->input->post('approve',true),
							'date_create' => date('Y-m-d H:i:s'),
							'paper_upload' => $upload_data['file_name']
						);
						// var_dump($data);
						// die();
						
						$simpan_ticket = $this->Model->simpan_data($data, 'tb_fullpaper');
						if($simpan_ticket){
							echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close"&times;</a>Berhasil disimpan !</div>';
							echo '<script>window.location.href="'.base_url().'admin/fullpaper";</script>';
						}else{
							echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';
						}
				}
			}
	}

}