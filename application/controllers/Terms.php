<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Terms controller
  Author: Laxmi
  Created Date: 28/January/2018
 * */  
class Terms extends CI_Controller {
    function __construct() {
        parent::__construct(); 
	$this->load->model('Terms_model','terms');
	if(!isset($this->session->userdata['admindata']['uname'])){
            redirect('/admin');
	}
    }

    public function index(){
	$this->load->view('admin/terms/View');
	}
	
    //Add Terms page 
    public function addTerm(){
	$this->load->view('admin/terms/Add');
    }
	
    public function saveTerms(){
	$data = array(
            'Name'=>$this->input->post('title'),
	    'Description'=>$this->input->post('desc'),
            'PromotionStatus'=>1,
            'CreatedOn'=>date('Y-m-d H:i:s'),
	);
	$result = $this->terms->saveTerms($data);
	if($result){
	    $this->session->set_flashdata('term_sucess', 'Terms added successfully');
	    redirect('terms');
	}
	else{
	    $this->session->set_flashdata('term_error', 'Terms  not done');
	    redirect('terms');
	}
	}

    //get all Terms	
    public function allTermsData(){
	$totalrecords = $this->terms->getAllTerms($_POST,1);
        $allTerms = $this->terms->getAllTerms($_POST);
        $json_data = array(
            "draw"  => intval( $_POST['draw'] ),
            "iTotalRecords"  => intval( $totalrecords ),
            "iTotalDisplayRecords"  => intval( $totalrecords ),
            "recordsFiltered"  => intval( count($allTerms) ),
            "data"  => $allTerms,
            );
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");
        echo json_encode($json_data);
    }
	   
    // edit Terms
    public function termsEdit($id){
	$data = $this->terms->get_terms_by_id($id);
	echo json_encode($data);
    } 
		
		
    //update Terms
    public function updateTerms(){
	$data = array(
            'Name'=>$this->input->post('title'),
            'Description'=>$this->input->post('desc'),
	);
	$this->terms->terms_update(array('terms_ID' => $this->input->post('term_id')), $data);
	echo json_encode(array("status" => TRUE));
	}
//delete terms
    public function deleteTerms($id){
	$this->terms->delete_terms_by_id($id);
	echo json_encode(array("status" => TRUE));
	}
        
//terms status change
    public function stausChangeTerms(){
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
	$this->terms->change_staus_by_id($id,$data);
	echo json_encode(array("status" => TRUE));
	}
}
