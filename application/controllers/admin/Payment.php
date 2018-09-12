<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
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
			'page' => 'payment',
			'link' => 'payment',
			'script' => 'script/payment',
			'list' => $this->Model->list_data_all('tb_payment'),
			'list_sub' =>  $this->Model->list_data_all('tb_sub_theme'),
		);
		$this->load->view('template/wrapper', $data);
	}

	public function tambah_payment(){
		if (!is_uploaded_file($_FILES['payment_upload']['tmp_name'])) {

					$data = array(
					'author' => $this->input->post('author',true),
					'email' => $this->input->post('email', true),
					'approve' => $this->input->post('approve',true),
					'date_create' => date('Y-m-d H:i:s'),
					);

					// var_dump($data);
					// die();
					$simpan_ticket = $this->Model->simpan_data($data, 'tb_payment');
					if($simpan_ticket){
						echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close"&times;</a>Berhasil disimpan !</div>';
						echo '<script>window.location.href="'.base_url().'admin/payment";</script>';
					}else{
						echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';
					}

			}else{
				$config ['upload_path'] = './assets/file_upload';
	            $config ['allowed_types'] = 'jpeg|jpg|JPEG|png|PNG';
	            $config ['max_size'] = '2048';
	            //$config ['file_name'] = $this->input->post('kd_kategori').date('dmYHis');
	            $this->upload->initialize($config);
	            if ( ! $this->upload->do_upload('payment_upload')){
	                $error = $this->upload->display_errors();
	                // var_dump($error);
	                // die();

	                $msg = array('status' => 'failed', 'text' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> '.$error.' </div>' );
	                        echo json_encode($msg);
	                }else{
	                	$upload_data = $this->upload->data();
						$data = array(
							'author' => $this->input->post('author',true),
							'email' => $this->input->post('email', true),
							'approve' => $this->input->post('approve',true),
							'date_create' => date('Y-m-d H:i:s'),
							'payment_upload' => $upload_data['file_name']
						);
						// var_dump($data);
						// die();
						
						$simpan_ticket = $this->Model->simpan_data($data, 'tb_payment');
						if($simpan_ticket){
							echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close"&times;</a>Berhasil disimpan !</div>';
							echo '<script>window.location.href="'.base_url().'admin/payment";</script>';
						}else{
							echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';
						}
				}
			}
	}

	public function ambil_payment(){
		$id = $this->input->post('id',true);
		$data = $this->Model->ambil('id_payment',$id,'tb_payment')->row();
		echo json_encode($data);
	}

	public function ubah_payment(){
		$id=$this->input->post('id_payment', true);
		if (!is_uploaded_file($_FILES['payment_upload']['tmp_name'])) {

					$data = array(
					'author' => $this->input->post('author',true),
					'email' => $this->input->post('email', true),
					'approve' => $this->input->post('approve',true),
					'date_create' => date('Y-m-d H:i:s'),
					);

					// var_dump($data);
					// die();
					$ubah = $this->Model->update('id_payment', $id, 'tb_payment', $data);
					if($ubah){
						echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close"&times;</a>Berhasil disimpan !</div>';
						echo '<script>window.location.href="'.base_url().'admin/payment";</script>';
					}else{
						echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';
					}

			}else{
				$config ['upload_path'] = './assets/file_upload';
	            $config ['allowed_types'] = 'pdf|PDF|doc|DOC|docx|DOCX';
	            $config ['max_size'] = '2048';
	            //$config ['file_name'] = $this->input->post('kd_kategori').date('dmYHis');
	            $this->upload->initialize($config);
	            if ( ! $this->upload->do_upload('payment_upload')){
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
							'payment_upload' => $upload_data['file_name']
						);
						// var_dump($data);
						// die();
						
						$ubah = $this->Model->update('id_payment', $id, 'tb_payment', $data);
						if($ubah){
							echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close"&times;</a>Berhasil disimpan !</div>';
							echo '<script>window.location.href="'.base_url().'admin/payment";</script>';
						}else{
							echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';
						}
				}
			}
	}

	public function hapus_payment(){
		$id = $this->input->post('id', true);
		//hapus tabel payment
		$hapus = $this->Model->hapus('id_payment',$id,'tb_payment');
		if($hapus){
		echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil dihapus !</div>';
            echo'<script>location.reload();</script>';
        }else{
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Gagal dihapus !</div>';
        }

	}


}