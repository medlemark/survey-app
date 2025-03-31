<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reward extends CI_Controller {

	public function index()
	{
		$this->load->model('reward_model');
		$data = $this->reward_model->get_all();
		$this->load->view('includes/header');
		$this->load->view('templates/reward/list',array('data'=>$data));
		$this->load->view('includes/footer');
	}
	public function create(){
		$this->load->view('includes/header');
		$this->load->view('templates/reward/create');
		$this->load->view('includes/footer');
	}
	public function delete($id){
		if (isset($id) && !empty($id) && is_numeric($id)) {
			 $this->load->model('reward_model');
			 if($this->reward_model->delete($id)){
			 	$this->session->set_flashdata('msg','reward deleted successfully :)');
			 }else{
			 	$this->session->set_flashdata('msg','there was an issue processing the request try again please !');

			 }
			 redirect('/reward');
		}else{
			$this->session->set_flashdata('msg','there was an issue processing the request try again please !');

			redirect('/reward');
		}

	}
	public function edit($id){
		if (isset($id) && !empty($id) && is_numeric($id)) {
			$this->load->model('reward_model');
			$data = $this->reward_model->get_single($id);

			// echo('<pre>');
			// var_dump($data);
			// echo '</pre>';

			 
			if($data){
				$this->load->view('includes/header');
				$this->load->view('templates/reward/edit',array('data'=>$data));
				$this->load->view('includes/footer');

			}else{
				$this->session->set_flashdata('msg','edit saved successfully :)');
				redirect('/reward');
			}

			
		}else{
			$this->session->set_flashdata('msg','there was an issue processing the request try again please !');
			redirect('/reward');
		}
	}

	public function save($edit_id=null){

		$this->form_validation->set_rules('title','Title','trim|xss_clean|required');
		$this->form_validation->set_rules('points','Points','trim|xss_clean|numeric|required');

    	if($this->form_validation->run() == FALSE){

    		$this->load->view('includes/header');
			$this->load->view('templates/reward/create');
			$this->load->view('includes/footer');
    		//redirect('survey');
    	}else{
    		$this->load->model('reward_model');
 			if (isset($edit_id) && $edit_id != null ) {
 				$success = $this->reward_model->save_edit($edit_id);
  			}else {
 				$success = $this->reward_model->save();

  			}
  			 
    		if(isset($success )){
    			$this->session->set_flashdata('msg','edit done successfully :) ');
    		 
    		}else{
    			$this->session->set_flashdata('msg','there is an issue saving data please try again. ');
    			
    		}
			redirect('/reward');

    	}
	}
}
