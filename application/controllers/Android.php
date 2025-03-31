<?php
error_reporting(-1);
ini_set('display_errors', 'On');
defined('BASEPATH') OR exit('No direct script access allowed');
class Android extends CI_Controller {
	/*
	this is 
	android controller:
	-register user
	-login user
	-list surveys
	-list rewards aquired
	*/
	function __construct(){
		parent::__construct();
	}
	public function index(){

	}
	public function getMapSurvey(){
		$this->load->model('survey_model');
		if (isset($_POST['lat']) && isset($_POST['lng'])) {
		$result  = $this->survey_model->get_survery_from_lat_lng($_POST['lat'],$_POST['lng'],$_POST['user_id']);
		$this->msg($result);
			 
		}
	}
	public function mySurveys(){
			if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
				$this->load->model('response_model');
				$this->msg($this->response_model->get_my_surveys($_POST['user_id']));
			}	
	}
	public function myRewards(){
			// if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
				$this->load->model('response_model');
				$this->msg($this->response_model->get_my_rewards());
			// }	
	}
	public function search(){

		if (isset($_POST['SEARCHFOR'])) {
			$this->load->model('survey_model');
			$results = $this->survey_model->search_for_surveys($_POST['SEARCHFOR']);
			$this->msg($results);
		}
		
	}
	 
	public function register(){
		//{"success":false,"post":{"ZIPCODE":"890","ADDRESS":"adds","USERNAME":"root","LASTNAME":"UI","STATE":"there","FIRSTNAME":"root","COUNTRY":"da","PASSWORD":"roo","MobNum":"8921303071637010202"}}

		if (isset($_POST['USERNAME'])) {
			$username = $_POST['USERNAME'];
			$this->load->model('user_model');
			if($this->user_model->exist_user($username) == false){
				if ($this->user_model->save_android()) {
					$this->msg(['success'=>true,'message'=>'registration successfull, try to login now !']);
				}else{
					$this->msg(['success'=>true,'message'=>'registration successfull, try to login now !']);
				}
			}else{
				$this->msg(['success'=>false,'message'=>'this username already in use try to login !']);
			}

		}else{
			$this->msg(['success'=>false]);
		}
		
	}
	public function response(){
		if (isset($_POST['UID']) && isset($_POST['QID']) && isset($_POST['RESPONSE'])) {
			 $this->load->model('response_model');
			 if($this->response_model->save()){
			 	$this->msg(['success'=>true]);
			 }else{
			 	$this->msg(['success'=>false]);
			 }
		}
	}
	public function login(){
			/*$this->msg(['success'=>false,'post'=>$_POST,'request'=>$_REQUEST]);
			exit();*/
		 if (isset($_POST['USERNAME']) && isset($_POST['PASSWORD'])) {
		 	 $this->load->model('user_model');
		 	 $user = $_POST['USERNAME'];
		 	 $pass = $_POST['PASSWORD'];
		 	 $userObj = $this->user_model->login($user,$pass);
		 	 // $this->msg(['success'=>false,'post'=>$_POST,'db'=>$userObj]);
		 	 // exit();
		 	 if (isset($userObj->userID)) {
		 	 	 $this->msg(['success'=>true,'user_id'=>$userObj->userID,'username'=>$userObj->username]);

		 	 }else{
		 	 	$this->msg(['success'=>false]);
		 	 }
		 }else{
		 	$this->msg(['success'=>false]);
		 }
	}
	private function msg($msg){
 		header('Content-type: application/json');
		echo json_encode($msg,JSON_UNESCAPED_SLASHES);

	}
}
