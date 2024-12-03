<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Group controller
  Author: Laxmi
  Created Date: 30/December/2017
 * */  
class Group extends CI_Controller {
	function __construct() {
        parent::__construct(); 
		
		 $this->load->model('Group_model','group');
	}

	public function index()
	{
		$this->load->view('admin/groups/list');
	}
	
	


	

	//get all groups	
   public function allGroupsData(){
	   $totalrecords = $this->group->getAllGroups($_POST,1);
       $allgroups = $this->group->getAllGroups($_POST);
	   $json_data = array(
			"draw"  => intval( $_POST['draw'] ),
			"iTotalRecords"  => intval( $totalrecords ),
			"iTotalDisplayRecords"  => intval( $totalrecords ),
			"recordsFiltered"  => intval( count($allgroups) ),
			"data"  => $allgroups,
			);
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json");
    echo json_encode($json_data);
	   
	   }
	
	//delete Group
	public function deleteGroup($id)
	{
		$this->group->delete_group_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	//package status change
	public function stausChangeGroup(){
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		
		if($status == 1){
			$data = array(
			'GroupStatus'=>0,
			);
			}
        else if($status == 0){
			$data = array(
			'GroupStatus'=>1,
			);
			}			
		$this->group->change_staus_by_id($id,$data);
		echo json_encode(array("status" => TRUE));
		}
 	
	
		  			   	
}
