<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		$this->load->model('user_model');
		$data = $this->user_model->get_all();
		$this->load->view('includes/header');
		$this->load->view('templates/user/list',array('data'=>$data));
		$this->load->view('includes/footer');
	}
	public function create(){
		$this->load->view('includes/header');
		$this->load->view('templates/user/create');
		$this->load->view('includes/footer');
	}
	public function delete($id){
		if (isset($id) && !empty($id) && is_numeric($id)) {
			 $this->load->model('user_model');
			 if($this->user_model->delete($id)){
			 	$this->session->set_flashdata('msg','User deleted successfully :)');
			 }else{
			 	$this->session->set_flashdata('msg','there was an issue processing the request try again please !');

			 }
			 redirect('/user');
		}else{
			$this->session->set_flashdata('msg','there was an issue processing the request try again please !');

			redirect('/user');
		}

	}
	public function edit($id){
		if (isset($id) && !empty($id) && is_numeric($id)) {
			$this->load->model('user_model');
			$data = $this->user_model->get_single($id);

			// echo('<pre>');
			// var_dump($data);
			// echo '</pre>';

			 
			if($data){
				$this->load->view('includes/header');
				$this->load->view('templates/user/edit',array('data'=>$data));
				$this->load->view('includes/footer');

			}else{
				$this->session->set_flashdata('msg','edit saved successfully :)');

				 redirect('/user');
			}

			
		}else{
			$this->session->set_flashdata('msg','there was an issue processing the request try again please !');
			redirect('/user');
		}
	}

	public function save($edit_id=null){
		 
		 
		$this->form_validation->set_rules('fname','First Name','trim|xss_clean|required');
		$this->form_validation->set_rules('lname','Last Name','trim|xss_clean|required');
		$this->form_validation->set_rules('adr1','Primary Address','trim|xss_clean|required');
		$this->form_validation->set_rules('state','State','trim|xss_clean|required');
		$this->form_validation->set_rules('zipcode','Zip','trim|xss_clean|required');
		$this->form_validation->set_rules('country','country','trim|xss_clean|required');
		$this->form_validation->set_rules('adr2','Secondry Address','trim|xss_clean');
		$this->form_validation->set_rules('mob','Mobile','trim|xss_clean');
		$this->form_validation->set_rules('username','Username','trim|xss_clean|required');
		$this->form_validation->set_rules('password','Password','trim|xss_clean|required');
	   
		 
    	 
    	if($this->form_validation->run() == FALSE){

    		$this->load->view('includes/header');
			$this->load->view('templates/user/create');
			$this->load->view('includes/footer');
    		//redirect('survey');
    	}else{
    		$this->load->model('user_model');
 			if (isset($edit_id) && $edit_id != null ) {
 				$success = $this->user_model->save_edit($edit_id);
  			}else {
 				$success = $this->user_model->save();

  			}
  			 
    		if(isset($success )){
    			$this->session->set_flashdata('msg','edition of User is done successfully :) ');
    		 
    		}else{
    			$this->session->set_flashdata('msg','there is an issue saving data please try again. ');
    			
    		}
			redirect('/user');

    	}
	}
}
