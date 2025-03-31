<?php
class Reward_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function get_all(){
        	 
        	return $this->db->get('reward')->result();

        }
        public function delete($id)
        { 
        	$this->db->where('reward_id', $id);
			if($this->db->delete('reward')){
			 	return true;
			}else{
				return false;
			}
        }
        public function get_single($id){
        	$this->db->where('reward_id',$id);
         	$result = $this->db->get('reward')->result();
         	return is_array($result) ? $result : false;
        }
        public function save_edit($edit_id){
        	$data = array(
			        'title' => $this->input->post('title'),
			        'points' => $this->input->post('points'),
			);
        	if($this->db->update('reward', $data,array('reward_id'=>$edit_id))){
        		return true;
        	} else {
        		return false;
        	}
        }
        public function save(){
 
        	$data = array(
                    'title' => $this->input->post('title'),
                    'points' => $this->input->post('points')
			      
			);
        	return $this->db->insert('reward',$data) == true ? true : false;
			 
        }
}