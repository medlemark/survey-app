<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Response extends CI_Controller {

	public function index()
	{
		$this->load->model('response_model');
		$data = $this->response_model->get_all();
		$this->load->view('includes/header');
		$this->load->view('templates/response/list',array('data'=>$data));
		$this->load->view('includes/footer');
	}
	
	public function delete($id){
		if (isset($id) && !empty($id) && is_numeric($id)) {
			 $this->load->model('response_model');
			 if($this->response_model->delete($id)){
			 	$this->session->set_flashdata('msg','Response deleted successfully :)');
			 }else{
			 	$this->session->set_flashdata('msg','there was an issue processing the request try again please !');

			 }
			 redirect('/response');
		}else{
			$this->session->set_flashdata('msg','there was an issue processing the request try again please !');

			redirect('/response');
		}

	}
	 

	 
}
