<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CI_Controller {

	public function index()
	{
		$this->load->model('survey_model');
		$data= $this->survey_model->get_all();
		$this->load->view('includes/header');
		$this->load->view('templates/survey/list',array('data'=>$data));
		$this->load->view('includes/footer');
	}
	public function create(){
		$this->load->view('includes/header');
		$this->load->view('templates/survey/create');
		$this->load->view('includes/footer');
	}
	public function delete($id){
		if (isset($id) && !empty($id) && is_numeric($id)) {
			 $this->load->model('survey_model');
			 if($this->survey_model->delete($id)){
			 	$this->session->set_flashdata('msg','survey deleted successfully :)');
			 }else{
			 	$this->session->set_flashdata('msg','there was an issue processing the request try again please !');

			 }
			 redirect('/');
		}else{
			$this->session->set_flashdata('msg','there was an issue processing the request try again please !');

			redirect('/');
		}

	}
	public function edit($id){
		if (isset($id) && !empty($id) && is_numeric($id)) {
			$this->load->model('survey_model');
			$data= $this->survey_model->get_single($id);
			// echo('<pre>');
			// var_dump($data);
			// echo '</pre>';
			 
			if($data){
				$this->load->view('includes/header');
				$this->load->view('templates/survey/edit',array('data'=>$data));
				$this->load->view('includes/footer');

			}else{
				$this->session->set_flashdata('msg','edit saved successfully :)');
				 redirect('/');
			}

			
		}else{
			$this->session->set_flashdata('msg','there was an issue processing the request try again please !');
			redirect('/');
		}
	}

	public function save($edit_id=null){
		 

    	$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean|required');
    	$this->form_validation->set_rules('intro', 'Introduction', 'trim|xss_clean|max_length[250]|required');
    	$this->form_validation->set_rules('thankyou', 'Thank You', 'trim|xss_clean|max_length[250]');
    	$this->form_validation->set_rules('location', 'Location', 'required|trim|xss_clean|max_length[250]');
    	$this->form_validation->set_rules('location_lat', 'Location lat', 'required|trim|xss_clean|max_length[250]');
    	$this->form_validation->set_rules('location_lng', 'Location lng', 'required|trim|xss_clean|max_length[250]');
     	$this->form_validation->set_rules('questions_data[]', 'Question', 'trim|xss_clean|required',array('required'=>' There is no question attached to this survey !'));
    	if($this->form_validation->run() == FALSE){
    		 
    		echo validation_errors();
    		//redirect('survey');
    	}else{
    		$this->load->model('survey_model');
 			if (isset($edit_id) && $edit_id != null ) {
 				$success = $this->survey_model->save_edit($edit_id);
  			}else {
 				$success = $this->survey_model->save();

  			}
  			var_dump($success);
    		if(isset($success )){
    			$this->session->set_flashdata('msg','edition of survey is done successfully :) ');
    			redirect('/survey');
    		}else{

    			$this->load->view('includes/header');
				$this->load->view('templates/survey/list');
				$this->load->view('includes/footer');	
    		}

    	}
	}
}
