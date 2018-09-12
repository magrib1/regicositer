<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Model');
		$this->load->library('image_lib');
		$this->load->library('upload');
		
	}

	public function index(){
		$data = array(
			'page' => 'payment',
			'link' => 'payment',
			'script' => 'script/payment',
			'list' => $this->Model->list_data_all('tb_payment'),
			'list_sub' =>  $this->Model->list_data_all('tb_sub_theme'),
		);
		$this->load->view('user_payment',$data);
	}

	public function tambah_payment(){
		if (!is_uploaded_file($_FILES['payment_upload']['tmp_name'])) {

					$data = array(
					'author' => $this->input->post('author',true),
					'email' => $this->input->post('email', true),
					'date_create' => date('Y-m-d H:i:s'),
					);

					// var_dump($data);
					// die();
					$simpan_ticket = $this->Model->simpan_data($data, 'tb_payment');
					if($simpan_ticket){
						echo "<script>alert('Payment Submitted !');</script>";
						echo'<script>location.reload();</script>';
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
							'date_create' => date('Y-m-d H:i:s'),
							'payment_upload' => $upload_data['file_name']
						);
						// var_dump($data);
						// die();
						$config_mail = Array(
					         'protocol'  => 'smtp',
					         'mailpath'  => '/usr/sbin/sendmail',
               				 'smtp_host' => 'ssl://smtp.gmail.com',
					         'smtp_port' => 465,
					         'smtp_user' => 'icositer2018_payment@itera.ac.id', 
					         'smtp_pass' => '2018payment', 
					         'mailtype'  => 'html',
					         'charset'  => 'iso-8859-1',
					         'wordwrap'  => TRUE
					      );

						$message = '
							   <h3 align="center">Payment Confirmation</h3>
							    <table border="1" width="100%" cellpadding="5">
							     <tr>
							      <td width="30%">Author</td>
							      <td width="70%">'.$this->input->post("author").'</td>
							     </tr>
							     
							     <tr>
							      <td width="30%">Email Address</td>
							      <td width="70%">'.$this->input->post("email").'</td>
							     </tr>
							     
							    </table>
							   ';

						  $this->load->library('email');
						  $this->email->initialize($config_mail);
					      $this->email->set_newline("\r\n");
					      $this->email->from($this->input->post('email', true));
					      $this->email->to('icositer2018_payment@itera.ac.id');
					      $this->email->subject('Payment Confirmation');
					         $this->email->message($message);
					         $this->email->attach($upload_data['full_path']);
					         $this->email->send();
						
						$simpan_ticket = $this->Model->simpan_data($data, 'tb_payment');
						if($simpan_ticket){
							echo "<script>alert('Payment Submitted !');</script>";
							echo'<script>location.reload();</script>';
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