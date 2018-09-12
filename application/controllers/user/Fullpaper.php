<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fullpaper extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Model');
		$this->load->library('image_lib');
		$this->load->library('upload');

	}

	public function index(){
		$data = array(
			'page' => 'user_fullpaper',
			'link' => 'fullpaper',
			'script' => 'script/fullpaper',
			'list' => $this->Model->list_join('tb_fullpaper','tb_sub_theme','tb_fullpaper.id_sub_theme=tb_sub_theme.id_sub_theme'),
			'list_sub' =>  $this->Model->list_data_all('tb_sub_theme'),
		);
		$this->load->view('user_fullpaper',$data);
	}

	public function tambah_fullpaper(){
		if (!is_uploaded_file($_FILES['paper_upload']['tmp_name'])) {

					$data = array(
					'author' => $this->input->post('author',true),
					'title' => $this->input->post('title',true),
					'id_sub_theme' => $this->input->post('id_sub_theme', true),
					'email' => $this->input->post('email', true),
					'date_create' => date('Y-m-d H:i:s'),
					);

					$config_mail = Array(
				         'protocol'  => 'smtp',
				         'smtp_host' => 'smtp.gmail.com',
				         'smtp_port' => 465,
				         'smtp_user' => 'icositer2018_fullpaper@itera.ac.id', 
				         'smtp_pass' => 'fullpaper', 
				         'mailtype'  => 'html',
				         'charset'  => 'iso-8859-1',
				         'wordwrap'  => TRUE
				      );

					// var_dump($data);
					// die();
					$simpan_ticket = $this->Model->simpan_data($data, 'tb_fullpaper');
					if($simpan_ticket){
						echo "<script>alert('File Submitted !');</script>";
						echo'<script>location.reload();</script>';
					}else{
						echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';
					}

			}else{

				$config ['upload_path'] = './assets/file_upload';
	            $config ['allowed_types'] = 'pdf|PDF|doc|DOC|docx|DOCX';
	            $config ['max_size'] = '2048';
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
							'date_create' => date('Y-m-d H:i:s'),
							'paper_upload' => $upload_data['file_name']
						);

						$config_mail = Array(
					         'protocol'  => 'smtp',
					         'mailpath'  => '/usr/sbin/sendmail',
               				 'smtp_host' => 'ssl://smtp.gmail.com',
					         'smtp_port' => 465,
					         'smtp_user' => 'icositer2018_fullpaper@itera.ac.id', 
					         'smtp_pass' => 'fullpaper', 
					         'mailtype'  => 'html',
					         'charset'  => 'iso-8859-1',
					         'wordwrap'  => TRUE
					      );
						$sub_theme = $this->Model->ambil('id_sub_theme',$this->input->post('id_sub_theme', true),'tb_sub_theme')->row();

						$message = '
							   <h3 align="center">Full Paper Submission</h3>
							    <table border="1" width="100%" cellpadding="5">
							     <tr>
							      <td width="30%">Author</td>
							      <td width="70%">'.$this->input->post("author").'</td>
							     </tr>
							     <tr>
							      <td width="30%">Title</td>
							      <td width="70%">'.$this->input->post("title").'</td>
							     </tr>
							     <tr>
							      <td width="30%">Email Address</td>
							      <td width="70%">'.$this->input->post("email").'</td>
							     </tr>
							     <tr>
							      <td width="30%">Sub-Theme</td>
							      <td width="70%">'.$sub_theme->name_sub_theme.'</td>
							     </tr>
							    </table>
							   ';

						  $this->load->library('email');
						  $this->email->initialize($config_mail);
					      $this->email->set_newline("\r\n");
					      $this->email->from($this->input->post('email', true));
					      $this->email->to('icositer2018_fullpaper@itera.ac.id');
					      $this->email->subject('Full Paper Submission');
					         $this->email->message($message);
					         $this->email->attach($upload_data['full_path']);
					         $this->email->send();
				              
					         
						// var_dump($data);
						// die();
						
						$simpan_ticket = $this->Model->simpan_data($data, 'tb_fullpaper');
						if($simpan_ticket){
							echo "<script>alert('File Submitted !');</script>";
							eecho'<script>location.reload();</script>';
						}else{
							echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';
						}
				}
			}
	}

}