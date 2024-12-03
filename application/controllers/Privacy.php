<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Privacy controller
  Author: Laxmi
  Created Date: 28/January/2018
 * */  
class Privacy extends CI_Controller {
    function __construct() {
        parent::__construct(); 
	$this->load->model('Privacy_model','privacy');
	if(!isset($this->session->userdata['admindata']['uname'])){
            redirect('/admin');
	}
    }

    public function index(){
	$this->load->view('admin/privacy/View');
	}
	
    //Add Terms page 
    public function addPrivacy(){
	$this->load->view('admin/privacy/Add');
    }
	
    public function savePrivacy(){
	$data = array(
            'Name'=>$this->input->post('title'),
	    'Description'=>$this->input->post('desc'),
            'PromotionStatus'=>1,
            'CreatedOn'=>date('Y-m-d H:i:s'),
	);
	$result = $this->privacy->savePrivacy($data);
	if($result){
	    $this->session->set_flashdata('privacy_sucess', 'Terms added successfully');
	    redirect('privacy');
	}
	else{
	    $this->session->set_flashdata('privacy_error', 'Terms  not done');
	    redirect('privacy');
	}
	}

    //get all Terms	
    public function allPrivacyData(){
	$totalrecords = $this->privacy->getAllPrivacy($_POST,1);
        $allPrivacy = $this->privacy->getAllPrivacy($_POST);
        $json_data = array(
            "draw"  => intval( $_POST['draw'] ),
            "iTotalRecords"  => intval( $totalrecords ),
            "iTotalDisplayRecords"  => intval( $totalrecords ),
            "recordsFiltered"  => intval( count($allPrivacy) ),
            "data"  => $allPrivacy,
            );
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");
        echo json_encode($json_data);
    }
	   
    // edit Terms
    public function privacyEdit($id){
	$data = $this->privacy->get_privacy_by_id($id);
	echo json_encode($data);
    } 
		
		
    //update Terms
    public function updatePrivacy(){
	$data = array(
            'Name'=>$this->input->post('title'),
            'Description'=>$this->input->post('desc'),
	);
	$this->privacy->privacy_update(array('Privacy_ID' => $this->input->post('privacy_id')), $data);
	echo json_encode(array("status" => TRUE));
	}
//delete terms
    public function deletePrivacy($id){
	$this->privacy->delete_privacy_by_id($id);
	echo json_encode(array("status" => TRUE));
	}
        
//terms status change
    public function stausChangePrivacy(){
  
	$id = $this->input->post('id');
        $status = $this->input->post('status');
	    if($status == 1){
		$data = array(
		   'PromotionStatus'=>0,
	        );
	    }
        else if($status == 0){
	    $data = array(
		'PromotionStatus'=>1,
	    );
	}			
	$this->privacy->change_staus_by_id($id,$data);
	echo json_encode(array("status" => TRUE));
	}
}
