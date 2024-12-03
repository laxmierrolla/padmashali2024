<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Occupation controller
  Author: Laxmi
  Created Date: 27/December/2017
 * */  
class Occupation extends CI_Controller {
	function __construct() {
        parent::__construct(); 
		if(!isset($this->session->userdata['admindata']['uname']))
         {
			redirect('/admin');
		 }
		 $this->load->model('Occupation_model','occupation');
	}

	public function index(){
			 $this->load->view('admin/occupations/view');
	
	}
	
	//Add occupation page 
 public function addOccupation(){
		$this->load->view('admin/occupations/add');
		}

//	occupation check
public function occupationCheck(){
	 $occname = $this->input->post('occname');
        $result = $this->occupation->check_occ($occname);
        echo $result;
	}	
	public function saveOccupation(){
		$data = array(
		'occupation'=>$this->input->post('occname'),
		);
		
		$result = $this->occupation->saveOccupation($data);
		if($result){
			$this->session->set_flashdata('occ_sucess', 'occuaption successfully');
			redirect('occupation');
		}
		else{
			$this->session->set_flashdata('occ_error', 'occuaption  not done');
			redirect('occupation');
			}
	}

	//get all occupations	
   public function allOccupationsData(){
	   $totalrecords = $this->occupation->getAllOccupations($_POST,1);
       $alloccupation = $this->occupation->getAllOccupations($_POST);
    $json_data = array(
        "draw"  => intval( $_POST['draw'] ),
        "iTotalRecords"  => intval( $totalrecords ),
        "iTotalDisplayRecords"  => intval( $totalrecords ),
        "recordsFiltered"  => intval( count($alloccupation) ),
        "data"  => $alloccupation,
        );
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json");
    echo json_encode($json_data);
	   
	   }
	   
	// edit occupation
	
	public function occuEdit($id)
		{
			$data = $this->occupation->get_occ_by_id($id);
			echo json_encode($data);
		} 
		
		
	//update occupation
	public function updateOccupation(){
		$data = array(
		   'occupation'=>$this->input->post('occname'),
		);
		$this->occupation->occupation_update(array('Occ_Id' => $this->input->post('occ_id')), $data);
		echo json_encode(array("status" => TRUE));
		
		}
	//delete occupation
	public function deleteOccupation($id)
	{
		$this->occupation->delete_occupation_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	//package status change
	public function stausChangeocc(){
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		
		if($status == 1){
			$data = array(
			'Occ_status'=>0,
			);
			}
        else if($status == 0){
			$data = array(
			'Occ_status'=>1,
			);
			}			
		$this->occupation->change_staus_by_id($id,$data);
		echo json_encode(array("status" => TRUE));
		}
 	
	
		  			   	
}
