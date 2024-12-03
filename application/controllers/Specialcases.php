<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: SpecialCases controller
  Author: Laxmi
  Created Date: 29/December/2017
 * */  
class Specialcases extends CI_Controller {
	function __construct() {
        parent::__construct(); 
		 $this->load->model('Specialcases_model','spl');
	}

	public function index()
	{
		if(isset($this->session->userdata['admindata']['uname']))
         {
		$this->load->view('admin/splcases/view');}
		else{
			redirect('/admin');
			}
	}
	
	//Add specialcases page 
 public function addSpecialCases(){
		$this->load->view('admin/splcases/add');
		}

//	specilacases check
public function splCheck(){
	 $splname = $this->input->post('splname');
        $result = $this->spl->check_spl($splname);
        echo $result;
	}	
	public function saveSpl(){
		$data = array(
		'spacial'=>$this->input->post('splname'),
		);
		
		$result = $this->spl->saveSpl($data);
		if($result){
			$this->session->set_flashdata('spl_sucess', 'specialcases successfully');
			redirect('specialcases');
		}
		else{
			$this->session->set_flashdata('spl_error', 'specialcases  not done');
			redirect('specialcases');
			}
	}

	//get all special cases	
   public function allSplData(){
	   $totalrecords = $this->spl->getAllSpl($_POST,1);
       $allspls = $this->spl->getAllSpl($_POST);
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
	
	public function splEdit($id)
		{
			$data = $this->spl->get_spl_by_id($id);
			echo json_encode($data);
		} 
		
		
	//update occupation
	public function updateSpl(){
		$data = array(
		   'spacial'=>$this->input->post('splname'),
		);
		$this->spl->spl_update(array('spl_id' => $this->input->post('spl_id')), $data);
		echo json_encode(array("status" => TRUE));
		
		}
	//delete occupation
	public function deleteSpl($id)
	{
		$this->spl->delete_spl_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	//package status change
	public function stausChangeSpl(){
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		
		if($status == 1){
			$data = array(
			'spl_status'=>0,
			);
			}
        else if($status == 0){
			$data = array(
			'spl_status'=>1,
			);
			}			
		$this->spl->change_staus_by_id($id,$data);
		echo json_encode(array("status" => TRUE));
		}
 	
	
		  			   	
}
