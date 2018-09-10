<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_in extends CI_Controller {
    
	public function index()
	{
		$this->load->view('login');
	}
	
	public function signin()
	{
		$this->load->model('Model');
		
    	$username = $this->input->post('username', true);
    	$password = $this->input->post('password', true);

    	if($username == "" || $password == ""){
    		echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Username dan Password tidak boleh kosong!</div>';
    	} else {
			$cek_user = $this->Model->ambil('username',$username,'tb_login')->row();
			// var_dump($cek_user->username);
			if(!isset($cek_user->username) OR trim($cek_user->username) == ""){
				echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> User Tidak ditemukan !</div>';
			} else {
				$hash = $cek_user->password;
				if(password_verify($password, $hash)){
					$data = array(
						'id' => $cek_user->id_login,
						'is_login' => true,
						'username'  => $cek_user->username,
						'logged_in' => 'sukses',
                		'is_login' => true,
						'rule'     => $cek_user->level,
					);
					$this->session->set_userdata($data);
					echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> User ditemukan, sedang menyambungkan !</div>';
					echo'<script>window.location.href="'.base_url().'admin/beranda";</script>';
				} else {
					echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Password salah !</div>';
				}
		    }
	    }
    }

    public function signout(){
        echo 'Please wait...';
        $this->session->sess_destroy();
        echo'<script>window.location.href="'.base_url().'";</script>';
    }
    
}