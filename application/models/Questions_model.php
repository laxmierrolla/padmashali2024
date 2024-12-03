<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
  Module: Questions Model
   Author: Laxmi
  Created Date: 24/January/2018
 * */
class Questions_model extends CI_Model
{
  
  public function __construct(){
    parent::__construct();
    
  }
  

		
//Save Questions
public function saveQuestions($data){
    return $this->db->insert('request_questions',$data);
		
}
	
//get all questions
public function getAllQuestions($pdata, $getcount=NULL)
    {
        $tabelcolumns = array(
            0 => 'RequestId',
            1 => 'RequestQuestion',
        );

       $search_1 = array(
            1 => 'RequestQuestion',
        );
        
        //count of records
        if($getcount){ 
            $this->db->select('*')->from('request_questions');
           }
	else{
            $this->db->select('*')->from('request_questions');
        }
        if(isset($pdata['search_text1'])&& $pdata['search_text1']!=""){
           $this->db->like($search_1[1],$pdata['search_text1']); 
        }
		
        if($getcount){
            return $this->db->get()->num_rows();
        }
        //for records
        $perpage = $pdata['length'];
        $limit = $pdata['start'];

        $orderby_field = $tabelcolumns[$pdata['order'][0]['column']]; 
        $orderby = $pdata['order']['0']['dir'];

        $generatesno = $limit+1;
        $this->db->order_by($orderby_field,$orderby);
        $query = $this->db->limit($perpage,$limit);
        $allquestions = $query->get()->result_array();
        
        foreach($allquestions as $key=>$values){
            $allquestions[$key]['sno'] = $generatesno++;
            $allquestions[$key]['Name'] = $allquestions[$key]['RequestQuestion'];
            $allquestions[$key]['status'] = $allquestions[$key]['RequestStatus'];
        }
        return $allquestions;
    }
	//edit data
public function get_question_by_id($id){
            $this->db->from('request_questions');
            $this->db->where('RequestId',$id);
            $query = $this->db->get();
            return $query->row();
	}	
		  
  //update questions
  public function questions_update($where,$data){
	$this->db->update('request_questions', $data, $where);
	return $this->db->affected_rows();
	  
	  }
//delete questions	
public function delete_ques_by_id($id){
    $this->db->where('RequestId', $id);
    $this->db->delete('request_questions');
}  

  
 //status change
 public function change_staus_by_id($id, $data){
    $this->db->where('RequestId',$id);
    $this->db->update('request_questions', $data);
    return $this->db->affected_rows();
	 } 
	 
	  }