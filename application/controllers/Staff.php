<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Staff controller
  Author: Laxmi
  Created Date: 29/December/2017
 * */  
class Staff extends CI_Controller {
	function __construct() {
        parent::__construct(); 
		 $this->load->model('Staff_model','staf');
	}

	public function index()
	{
		$groups =   $this->staf->get_groups();
	    $data = array('groups'=>$groups);
		$this->load->view('admin/staff/view',$data);
	}
	
	//Add specialcases page 
 public function addStaff(){
	    $groups =   $this->staf->get_groups();
	    $data = array('groups'=>$groups);
		$this->load->view('admin/staff/add',$data);
		}

	public function saveStaff(){
		$data = array(
		'uname'=>$this->input->post('username'),
		'mail_id'=>$this->input->post('email'),
		'mobile'=>$this->input->post('phone'),
		'psw'=>md5($this->input->post('password')),
		'admintype'=>$this->input->post('group'),
		'addedon'=>date('Y-m-d H:i:sa')
		);
		
		$result = $this->staf->saveStaff($data);
		if($result){
			$this->session->set_flashdata('staff_sucess', 'staff added successfully');
			redirect('staff');
		}
		else{
			$this->session->set_flashdata('staff_error', 'staff error  not done');
			redirect('staff');
			}
	}

	//get all special cases	
   public function allStaffData(){
	   $totalrecords = $this->staf->getAllStaff($_POST,1);
       $allspls = $this->staf->getAllStaff($_POST);
    $json_data = array(
        "draw"  => intval( $_POST['draw'] ),
        "iTotalRecords"  => intval( $totalrecords ),
        "iTotalDisplayRecords"  => intval( $totalrecords ),
        "recordsFiltered"  => intval( count($allspls) ),
        "data"  => $allspls,
        );
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json");
    echo json_encode($json_data);
	   
	   }
	   
	// edit occupation
	
	public function staffEdit($id)
		{
			$data = $this->staf->get_staff_by_id($id);
			echo json_encode($data);
		} 
		
		
	//update staff
	public function updateStaff(){
		$data = array(
		'uname'=>$this->input->post('username'),
		'mail_id'=>$this->input->post('email'),
		'mobile'=>$this->input->post('phone'),
		'psw'=>md5($this->input->post('password')),
		'admintype'=>$this->input->post('group'),
		);
		$this->staf->staff_update(array('admin_id' => $this->input->post('admin_id')), $data);
		echo json_encode(array("status" => TRUE));
		
		}
	//delete staff
	public function deleteStaff($id)
	{
		$this->staf->delete_staff_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	//package status change
	public function stausChangeStaff(){
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		
		if($status == 1){
			$data = array(
			'status'=>0,
			);
			}
        else if($status == 0){
			$data = array(
			'status'=>1,
			);
			}			
		$this->staf->change_staus_by_id($id,$data);
		echo json_encode(array("status" => TRUE));
		}
		  			   	
}
