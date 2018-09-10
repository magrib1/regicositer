<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Restricted {

    private $ci;
	private $apps;
	private $level;
	private $current_apps;
	private $current_level;
	private $current_rule;

	public function __construct(){
      	$this->ci =& get_instance();
        $this->apps = $this->ci->session->userdata('apps');
        $this->level = $this->ci->session->userdata('level');
        $this->current_rule = $this->ci->session->userdata('rule');

    }
	
	public function restrict_check($data=NULL){
		if($this->current_rule == 'mahasiswa' || $this->current_rule == 'dosen' || $this->current_rule == 'admin'){
			return FALSE;
		} else {
			for ($i=0; $i < count($data['apps']); $i++) {
				if ($data['apps'][$i] == $this->current_apps) {
					return $this->current_level=$data['level'][$i];
				}
			}
		}
	}

	public function restrict_get(){
		return $this->level;
	}

	public function restrict_current(){
		return array(
			'apps' => $this->current_apps,
			'level' => $this->current_level
		);
	}

	public function execution($restrict_page, $data){
        $this->current_apps = $this->ci->config->item('client_id');
       
        if (!$this->restrict_check($data)) {
        	switch ($this->current_rule) {
        	    case 'mahasiswa':
	            	redirect(base_url().'user', 'location', 303);
        	    break;
        	    case 'dosen':
	            	redirect(base_url().'user', 'location', 303);
        	    break;
        	    case 'admin':
	            	$this->ci->session->set_userdata(array('level_ppm' => 'admin'));
	                redirect(base_url().'admin', 'location', 303);
	            break;
        	    default:
	                redirect(base_url(), 'location', 303);
	            break;
        	}
		} else {
			switch ($this->current_level) {
	            case 'admin':
	            	$this->ci->session->set_userdata(array('level_ppm' => 'admin'));
	                redirect(base_url().'admin', 'location', 303);
	            break;
	            default:
	                redirect(base_url(), 'location', 303);
	            break;
	        }
		}
	}
    
}