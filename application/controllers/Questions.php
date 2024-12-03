<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Questions controller
  Author: Laxmi
  Created Date: 23/Jan/2018
 * */  
class Questions extends CI_Controller {
    function __construct() {
        parent::__construct(); 
	$this->load->model('Questions_model','question');
	if(!isset($this->session->userdata['admindata']['uname'])){
            redirect('/admin');
	}
		
	}

public function index(){
    $this->load->view('admin/questions/View');
	}
	
//Add Questions page 
 public function addQuestions(){
    $this->load->view('admin/questions/Add');
		}
	
public function saveQues(){
    $data = array(
        'RequestQuestion'=>$this->input->post('quesname'),
		);
    $result = $this->question->saveQuestions($data);
    if($result){
            $this->session->set_flashdata('ques_sucess', 'Package renewl successfully');
            redirect('questions');
    }
    else{
            $this->session->set_flashdata('ques_error', 'Package renewl not done');
            redirect('questions');
	}
	}

//get all questions	
   public function allQuestionsData(){
    $totalrecords = $this->question->getAllQuestions($_POST,1);
    $allquestions = $this->question->getAllQuestions($_POST);
    $json_data = array(
        "draw"  => intval( $_POST['draw'] ),
        "iTotalRecords"  => intval( $totalrecords ),
        "iTotalDisplayRecords"  => intval( $totalrecords ),
        "recordsFiltered"  => intval( count($allquestions) ),
        "data"  => $allquestions,
        );
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json");
    echo json_encode($json_data);
	   
	   }
// edit Question
    public function quesEdit($id){
	$data = $this->question->get_question_by_id($id);
	echo json_encode($data);
    } 
		
		
//update questions
    public function updateQues(){
	
	$data = array(
            'RequestQuestion'=>$this->input->post('quesname'),
	);
	$this->question->questions_update(array('RequestId' => $this->input->post('ques_id')), $data);
	echo json_encode(array("status" => TRUE));
		}
                
  //delete Questions
    public function deleteQues($id){
	$this->question->delete_ques_by_id($id);
	echo json_encode(array("status" => TRUE));
	}
        
   //questions status change
    public function stausChangeQues(){
	$id = $this->input->post('id');
	$status = $this->input->post('status');
	if($status == 1){
            $data = array(
		'RequestStatus'=>0,
		);
	}
        else if($status == 0){
            $data = array(
		'RequestStatus'=>1,
			);
            }			
	$this->question->change_staus_by_id($id,$data);
	echo json_encode(array("status" => TRUE));
    }
 	
		   	
}
