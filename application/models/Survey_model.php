<?php
class Survey_model extends CI_Model {


        public function __construct()
        {
                $this->load->database();
        }
        public function get_all(){
        	$this->db->select('survey.*,count(question.question_id) as total');
        	$this->db->from('survey');
        	$this->db->join('question','question.survey_id=survey.survey_id');
        	$this->db->group_by('survey_id');
        	return $this->db->get()->result();

        }
        public function get_survery_from_lat_lng($lat,$lng,$user_id){
			//         	set @orig_lat=29.42; 
			// set @orig_lon=-98.49;

			// SELECT 
			//     *, 
			//     (6373 * 2 * ASIN(SQRT(POWER(SIN((@orig_lat -abs(lat)) * pi()/180 / 2), 2) 
			//     + COS(@orig_lat * pi()/180 ) * COS(abs(lat) * pi()/180) 
			//     * POWER(SIN((@orig_lon - lng) * pi()/180 / 2), 2) )) )  as distance 
			// FROM survey
			//$this->db->set('@orig_lat',$lat);
			//$this->db->set('@orig_lon',$lng);
			$this->db->select("*,(6373 * 2 * ASIN(SQRT(POWER(SIN(($lat -abs(lat)) * pi()/180 / 2), 2) 
			 + COS($lat * pi()/180 ) * COS(abs(lat) * pi()/180) 
			 * POWER(SIN(($lng - lng) * pi()/180 / 2), 2) )) )  as distance");
			 $this->db->from('survey');
			 $this->db->having('distance < 7');
			 $surveys = $this->db->get()->result();
			 $this->db->select('GROUP_CONCAT(question_id) as total_done');
			 $this->db->where('user_id',$user_id);
			 $av = $this->db->get('user_response')->result();
			 if(is_object($av) && !empty($av->total_done)){
			 	 $av_a = explode(',', $av->total_done);
			 	}else{
			 		$av_a = array();
			 	}
			
			 if (count( $surveys)>=1) {
			 	foreach ($surveys as $key => $value) {
			 		$this->db->where('survey_id',$value->survey_id);
			 		$questions =  $this->db->get('question')->result();
			 		foreach ($questions as $k => $v) {
			 			if(in_array($v->question_id, $av_a)){
			 				$questions[$k]->done = true;
			 			}else{
			 				$questions[$k]->done = false;

			 			}
			 		}
			 		$surveys[$key]->questions = $questions;
			 	}
			 }
			 return ['surveys'=>$surveys];


        }
        public function search_for($search_term=''){
        	$this->db->select('survey.*,question.*');
        	$this->db->from('survey');
         	$this->db->join('question','question.survey_id=survey.survey_id','inner');
         	$this->db->like('title',$search_term);
            $this->db->or_like('intro',$search_term);
          	$result = $this->db->get()->result();
         	return is_array($result) ? $result : false;
        }
        public function search_for_surveys($search_term=''){
         
			//         	SELECT question.*,
			// (case when question.question_id = user_response.question_id then true else false end) as done
			// FROM question 
			// #JOIN survey on survey.survey_id = question.survey_id
			// LEFT JOIN user_response ON user_response.question_id = question.question_id 
			// WHERE question.survey_id = 16 GROUP BY question.question_id
        	$this->db->like('title',$search_term);
            $this->db->or_like('intro',$search_term);
            $r_surveys = $this->db->get('survey')->result();
           
            if (count($r_surveys)>=1) {
            	foreach ($r_surveys as $key => $value) {
            		$this->db->select('question.*,(case when question.question_id = user_response.question_id then true else false end) as done');
            		$this->db->from('question');
            		$this->db->join('user_response','user_response.question_id=question.question_id','left');
             		$this->db->where('question.survey_id',$value->survey_id);
             		$this->db->group_by('question.question_id');
            		$questions = $this->db->get()->result();
            		$r_surveys[$key]->questions = $questions;

            	}
            }
            return ['surveys'=>$r_surveys];
        }
       
        public function get_single($id){
        	$this->db->select('survey.*,question.*');
        	$this->db->from('survey');
         	$this->db->join('question','question.survey_id=survey.survey_id','inner');
         	$this->db->where('question.survey_id',$id);
         	$result = $this->db->get()->result();
         	return is_array($result) ? $result : false;
        }
        public function delete($id){
        	$this->db->where('survey_id', $id);
			if($this->db->delete('survey')){
				$this->db->where('survey_id', $id);
				if($this->db->delete('question')){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
			
        }
        /* return id */
        public function save_edit($edit_id=null){
        	  $data = array(
			       'title' => $this->input->post('title'),
			        'intro' => $this->input->post('intro'),
			        'location' => $this->input->post('location'),
			        'lat' => $this->input->post('location_lat'),
			        'lng' => $this->input->post('location_lng'),
			        'thankyou' => $this->input->post('thankyou')
			    );
        	   
			   if($this->db->update('survey', $data,array('survey_id'=>$edit_id))){
				    $survey_id = $edit_id;
				   	$all = $this->input->post('questions_data');
				   	 
				   	$data = [];	
				   	foreach ($all as $key => $value) { 
				   		//data
				   		$data[] = json_decode($value);
				   	}
				   	$questions_update =[];
				   	$questions_insert =[];
				   	$questions_not_delete =[];
			   		foreach($data as $key => $val){
			   			$tmp = $val;
			   			 

			   			$type_input= $tmp->type;
			   			$options = json_encode( $tmp->options);
			   			$qst = array(
			   				'survey_id'=>$survey_id,
			   				'question' => trim($this->db->escape($tmp->title),"'"),
			   				'points' => trim($this->db->escape($tmp->points),"'"),
			   				'required' => trim($this->db->escape($tmp->required),"'") == 'Yes' ? true : false ,
			   				'type_input' => trim($this->db->escape($type_input),"'"),
			   				'options' => trim($this->db->escape($options),"'"),
			   			);
			   			if (isset($tmp->question_id)) {
			   			$qst['question_id'] = intval($tmp->question_id);
			   			array_push($questions_not_delete,intval($tmp->question_id));
			   			array_push($questions_update,$qst);
			   			}else{
			   			array_push($questions_insert,$qst);
			   			}
			   		}
			   		if (count($questions_not_delete)>=1) {
			   			 $this->db->where('survey_id',$survey_id);
			   			 $this->db->where_not_in('question_id',$questions_not_delete);
			   			 $this->db->delete('question');
			   		}
			   		if (count($questions_update)>=1) {
			   			$success = $this->db->update_batch('question',$questions_update,'question_id') ? true : false;
			   		}
			   		if (count($questions_insert)>=1) {
			   			$success = $this->db->insert_batch('question',$questions_insert) ? true : false;
			   		}
			   		
			   		return $success;
			   	}
        }
        public function save(){

			    $data = array(
			        'title' => $this->input->post('title'),
			        'intro' => $this->input->post('intro'),
			        'location' => $this->input->post('location'),
			        'lat' => $this->input->post('location_lat'),
			        'lng' => $this->input->post('location_lng'),
			        'thankyou' => $this->input->post('thankyou')
			    );

			   if($this->db->insert('survey', $data)){
				    $survey_id = $this->db->insert_id();
				   	$all = $this->input->post('questions_data');
				   	 
				   	$data = [];	
				   	foreach ($all as $key => $value) { 
				   		//data
				   		$data[] = json_decode($value);
				   	}
				   	$questions =[];
			   		foreach($data as $key => $val){
			   			$tmp = $val;
			   			 

			   			$type_input= $tmp->type;
			   			$options = json_encode( $tmp->options);
			   			$qst = array('survey_id'=>$survey_id,
			   				'question' => trim($this->db->escape($tmp->title),"'"),
			   				'points' => trim($this->db->escape($tmp->points),"'"),
			   				'required' =>  trim($this->db->escape($tmp->required),"'") == 'Yes' ? true : false,
			   				'type_input' => trim($this->db->escape($type_input),"'"),
			   				'options' => trim($this->db->escape($options),"'"),
			   			);
			   			 
			   			array_push($questions,$qst);
			   		}
			   		 
			   		if($this->db->insert_batch('question',$questions)){
			   			return true;
			   		}else{ 
			   			return false;
			   		}
			   	}
        } 
}