<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	public function login()
	{
		if($this->session->userdata('logged_in')){
			redirect('/');
		}else{
			$this->load->helper('form');
		    $this->load->library('form_validation');

 
		    $this->form_validation->set_rules('username', 'USERNAME', 'required');
		    $this->form_validation->set_rules('password', 'PASSWORD', 'required');
		    if ($this->form_validation->run() === FALSE){

				$this->load->view('templates/login');
		    	
		    }else{
		    	$user = $this->input->post('username');
		    	$password = $this->input->post('password');
		    	if ($user =='root' && $password =='root') {
		    		$this->session->set_userdata('logged_in',true);
		    		
		    		redirect('/');
		    	}

		    }

		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/admin/login');

	}
}