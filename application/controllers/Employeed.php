<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Employeed controller
  Author: Laxmi
  Created Date: 27/December/2017
 * */  
class Employeed extends CI_Controller {
	function __construct() {
        parent::__construct(); 
		 $this->load->model('Employeed_model','emp');
	}

	public function index(){
	if(isset($this->session->userdata['admindata']['uname'])){
		$this->load->view('admin/employeed/view');}
		else{
			redirect('/admin');
			}	
		
	}
	
	//Add Employeed page 
 public function addEmployeedIn(){
		$this->load->view('admin/employeed/add');
		}

//	Employeed check
public function empCheck(){
	 $occname = $this->input->post('empname');
        $result = $this->emp->check_emp($occname);
        echo $result;
	}	
	public function saveEmp(){
		$data = array(
		'employee'=>$this->input->post('empname'),
		);
		
		$result = $this->emp->saveEmp($data);
		if($result){
			$this->session->set_flashdata('emp_sucess', 'emp successfully');
			redirect('employeed');
		}
		else{
			$this->session->set_flashdata('emp_error', 'emp not done');
			redirect('employeed');
			}
	}

	//get all Employedin	
   public function allEmployeedData(){
	   $totalrecords = $this->emp->getAllEmp($_POST,1);
       $allemp = $this->emp->getAllEmp($_POST);
    $json_data = array(
        "draw"  => intval( $_POST['draw'] ),
        "iTotalRecords"  => intval( $totalrecords ),
        "iTotalDisplayRecords"  => intval( $totalrecords ),
        "recordsFiltered"  => intval( count($allemp) ),
        "data"  => $allemp,
        );
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json");
    echo json_encode($json_data);
	   
	   }
	   
	// edit Employeedin
	
	public function empEdit($id)
		{
			$data = $this->emp->get_emp_by_id($id);
			echo json_encode($data);
		} 
		
		
	//update Employeed
	public function updateEmployeed(){
		$data = array(
		   'employee'=>$this->input->post('empname'),
		);
		$this->emp->emp_update(array('emp_id' => $this->input->post('emp_id')), $data);
		echo json_encode(array("status" => TRUE));
		
		}
	//delete Employeed
	public function deleteEmp($id)
	{
		$this->emp->delete_emp_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	//emp status change
	public function stausChangeemp(){
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		if($status == 1){
			$data = array(
			'emp_status'=>0,
			);
			}
        else if($status == 0){
			$data = array(
			'emp_status'=>1,
			);
			}			
		$this->emp->change_staus_by_id($id,$data);
		echo json_encode(array("status" => TRUE));
		}
 	
	
		  			   	
}
