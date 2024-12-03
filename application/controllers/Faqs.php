<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Faqs controller
  Author: Laxmi
  Created Date: 28/January/2018
 * */  
class Faqs extends CI_Controller {
    function __construct() {
        parent::__construct(); 
	$this->load->model('Faqs_model','faqs');
	if(!isset($this->session->userdata['admindata']['uname'])){
            redirect('/admin');
	}
    }

    public function index(){
	$this->load->view('admin/faqs/View');
	}
	
    //Add Faqs page 
    public function addFaqs(){
	$this->load->view('admin/faqs/Add');
    }
	
    public function saveFaqs(){
	$data = array(
            'FaqQuestion'=>$this->input->post('question'),
	    'FaqAnswer'=>$this->input->post('answer'),
	);
	$result = $this->faqs->saveFaqs($data);
	if($result){
	    $this->session->set_flashdata('faq_sucess', 'Terms added successfully');
	    redirect('faqs');
	}
	else{
	    $this->session->set_flashdata('faq_error', 'Terms  not done');
	    redirect('faqs');
	}
	}

    //get all Faqs	
    public function allFaqData(){
	$totalrecords = $this->faqs->getAllFaqs($_POST,1);
        $allFaqs = $this->faqs->getAllFaqs($_POST);
        $json_data = array(
            "draw"  => intval( $_POST['draw'] ),
            "iTotalRecords"  => intval( $totalrecords ),
            "iTotalDisplayRecords"  => intval( $totalrecords ),
            "recordsFiltered"  => intval( count($allFaqs) ),
            "data"  => $allFaqs,
            );
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");
        echo json_encode($json_data);
    }
	   
    // edit Privacy
    public function faqEdit($id){
	$data = $this->faqs->get_faq_by_id($id);
	echo json_encode($data);
    } 
		
		
    //update Faqs
    public function updateFaq(){
  
	$data = array(
            'FaqQuestion'=>$this->input->post('question'),
            'FaqAnswer'=>$this->input->post('answer'),
	);
	$this->faqs->faq_update(array('FaqId' => $this->input->post('faq_id')), $data);
	echo json_encode(array("status" => TRUE));
	}
//delete Faqs
    public function deleteFaq($id){
	$this->faqs->delete_faq_by_id($id);
	echo json_encode(array("status" => TRUE));
	}
        
//terms status change
    public function stausChangeFaq(){
  
	$id = $this->input->post('id');
        $status = $this->input->post('status');
	    if($status == 1){
		$data = array(
		   'FaqStatus'=>0,
	        );
	    }
        else if($status == 0){
	    $data = array(
		'FaqStatus'=>1,
	    );
	}			
	$this->faqs->change_staus_by_id($id,$data);
	echo json_encode(array("status" => TRUE));
	}
}
