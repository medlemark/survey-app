<?php
class Response_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function get_all(){
            $this->db->select('user_response.*,user.*,question.*');
            $this->db->join('user','user_response.user_id=user.userID');
        	$this->db->join('question','user_response.question_id=question.question_id');
        	return $this->db->get('user_response')->result();

        }
        public function delete($id)
        { 
        	$this->db->where('response_id', $id);
			if($this->db->delete('user_response')){
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
        public function get_my_rewards($user_id='1'){
            //SELECT SUM(question.points) from question JOIN user_response on user_response.question_id = question.question_id WHERE user_response.user_id = 1
            $this->db->select('sum(question.points) as user_points');
            $this->db->from('question');
            $this->db->join('user_response','user_response.question_id=question.question_id');
            $this->db->where('user_response.user_id',$user_id);
            $result = $this->db->get()->row();
            $won_rewards = array();
            if (intval($result->user_points) >=1 ) {
                $this->db->select('*');
                $all_rewards = $this->db->get('reward')->result();

                foreach ($all_rewards as $key => $value) {

                    if($result->user_points >= intval($value->points)){
                       // $won_rewards[] = $value->title;
                        array_push($won_rewards, $value->title);
                        $result->user_points = $result->user_points - $value->points;
                    }
                }
            }
            return ['rewards'=> $won_rewards];
        }
        public function get_my_surveys($user_id = ''){
            //SELECT GROUP_CONCAT(user_response.question_id) as total_done,question.survey_id,survey.* from user_response
            // JOIN question on question.question_id = user_response.question_id
            // JOIN survey on question.survey_id = survey.survey_id
            // WHERE user_response.user_id = 1
            $this->db->select('GROUP_CONCAT(user_response.question_id) as total_done,question.survey_id,survey.title,survey.intro,survey.thankyou,survey.location,survey.lat,survey.lng');
            $this->db->from('user_response');
            $this->db->join('question','question.question_id=user_response.question_id');
            $this->db->join('survey','survey.survey_id = question.survey_id');
            $this->db->where('user_response.user_id',$user_id);
            $this->db->group_by('survey_id');
            $surveys_done = $this->db->get()->result();
            foreach ($surveys_done as $key => $value) {
                    $this->db->select('*');
                    $this->db->where('survey_id',$value->survey_id);
                    $this->db->from('question');
                    $questions = $this->db->get()->result();
                    $al_d = explode(',', $value->total_done);

                    foreach ($questions as $key => $value) {
                        if (in_array($value->question_id, $al_d)) {
                            $questions[$key]->done = true;
                        }else{
                            $questions[$key]->done = false;

                        }
                    }
                    $surveys_done[$key]->questions = $questions;
            }
            return ['surveys'=>$surveys_done];
            
            //return $questions_done;
          
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
            $this->db->where(['question_id'=> $this->input->post('QID'),'user_id'=> $this->input->post('UID')]);
            $update = $this->db->get('user_response')->row();

        	$data = array(
                    'user_id' => $this->input->post('UID'),
                    'question_id' => $this->input->post('QID'),
                    'data' => $this->input->post('RESPONSE')
			      
			); 
            if (isset($update->question_id)) {
                $this->db->where(['question_id'=> $this->input->post('QID'),'user_id'=> $this->input->post('UID')]);
                unset($data['question_id']);
                unset($data['user_id']);
                $resp = $this->db->update('user_response',$data);
            }else{
                $resp = $this->db->insert('user_response',$data);
            }
        	return $resp == true ? true : false;
			 
        }
}