<?php
class User_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }
        public function get_all(){
        	return $this->db->get('user')->result();
        }
        public function delete($id)
        { 
        	$this->db->where('userID', $id);
			if($this->db->delete('user')){
			 	return true;
			}else{
				return false;
			}
        }
        public function exist_user($username){
            $this->db->where(array('username'=>$username));
            $result = $this->db->get('user')->row();
            return is_array($result) && count($result) == 11 ? true : false;
        }
        public function login($username,$password){
            $this->db->where('username',$username);
            $this->db->where('password',$password);
            return $this->db->get('user')->row();
        }

        public function get_single($id){
        	$this->db->where('userID',$id);
         	$result = $this->db->get('user')->result();
         	return is_array($result) ? $result : false;
        }
        public function save_edit($edit_id){
        	$data = array(
			        'firstName' => $this->input->post('fname'),
			        'lastName' => $this->input->post('lname'),
			        'uAddress1' => $this->input->post('adr1'),
			        'uAddress2' => $this->input->post('adr2'),
			        'uState' => $this->input->post('state'),
			        'uZipCode' => $this->input->post('zipcode'),
			        'uCountry' => $this->input->post('country'),
			        'uMobNum' => $this->input->post('mob'),
			        'Username' => $this->input->post('username'),
			        'password' => $this->input->post('password')
			);
        	if($this->db->update('user', $data,array('userID'=>$edit_id))){
        		return true;
        	} else {
        		return false;
        	}
        }
        
        public function save_android(){
 
            $data = array(
                    'firstName' => $this->input->post('FIRSTNAME'),
                    'lastName' => $this->input->post('LASTNAME'),
                    'uAddress1' => $this->input->post('ADDRESS'),
                    'uAddress2' => "",
                    'uState' => $this->input->post('STATE'),
                    'uZipCode' => $this->input->post('ZIPCODE'),
                    'uCountry' => $this->input->post('COUNTRY'),
                    'uMobNum' => $this->input->post('MOBILE'),
                    'Username' => $this->input->post('USERNAME'),
                    'password' => $this->input->post('PASSWORD')
            );
            return $this->db->insert('user',$data) == true ? true : false;
             
        }
        public function save(){
 
        	$data = array(
			        'firstName' => $this->input->post('fname'),
			        'lastName' => $this->input->post('lname'),
			        'uAddress1' => $this->input->post('adr1'),
			        'uAddress2' => $this->input->post('adr2'),
			        'uState' => $this->input->post('state'),
			        'uZipCode' => $this->input->post('zipcode'),
			        'uCountry' => $this->input->post('country'),
			        'uMobNum' => $this->input->post('mob'),
			        'Username' => $this->input->post('username'),
			        'password' => $this->input->post('password')
			);
        	return $this->db->insert('user',$data) == true ? true : false;
			 
        }
}