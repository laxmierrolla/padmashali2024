<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: ContactUs controller
  Author: Laxmi
  Created Date: 28/January/2018
 * */  
class ContactUs extends CI_Controller {
    function __construct() {
        parent::__construct(); 
	$this->load->model('Contact_model','contact');
	if(!isset($this->session->userdata['admindata']['uname'])){
            redirect('/admin');
	}
    }

    public function index(){
	$this->load->view('admin/contactus/View');
	}
	
    //Add Contact page 
    public function addContact(){
	$this->load->view('admin/contactus/Add');
    }
	
    public function saveContact(){
	$data = array(
            'Contact_Name'=>$this->input->post('title'),
	    'Contact_Desc'=>$this->input->post('desc'),
            'Contact_Status'=>1,
            'CreatedOn'=>date('Y-m-d H:i:s'),
	);
	$result = $this->contact->saveContact($data);
	if($result){
	    $this->session->set_flashdata('contact_sucess', 'ContactUs added successfully');
	    redirect('contactUs');
	}
	else{
	    $this->session->set_flashdata('contact_error', 'ContactUs  not done');
	    redirect('contactUs');
	}
	}

    //get all Contact	
    public function allContactData(){
	$totalrecords = $this->contact->getAllContact($_POST,1);
        $allcontact = $this->contact->getAllContact($_POST);
        $json_data = array(
            "draw"  => intval( $_POST['draw'] ),
            "iTotalRecords"  => intval( $totalrecords ),
            "iTotalDisplayRecords"  => intval( $totalrecords ),
            "recordsFiltered"  => intval( count($allcontact) ),
            "data"  => $allcontact,
            );
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");
        echo json_encode($json_data);
    }
	   
    // edit Contact
    public function contactEdit($id){
	$data = $this->contact->get_contact_by_id($id);
	echo json_encode($data);
    } 
		
		
    //update Contact
    public function updateContact(){
	$data = array(
            'Contact_Name'=>$this->input->post('title'),
            'Contact_Desc'=>$this->input->post('desc'),
	);
	$this->contact->contact_update(array('Contact_ID' => $this->input->post('contact_id')), $data);
	echo json_encode(array("status" => TRUE));
	}
//delete Contact
    public function deleteContact($id){
	$this->contact->delete_contact_by_id($id);
	echo json_encode(array("status" => TRUE));
	}
        
//Contact status change
    public function stausChangeContact(){
	$id = $this->input->post('id');
        $status = $this->input->post('status');
	    if($status == 1){
		$data = array(
		   'Contact_Status'=>0,
	        );
	    }
        else if($status == 0){
	    $data = array(
		'Contact_Status'=>1,
	    );
	}			
	$this->contact->change_staus_by_id($id,$data);
	echo json_encode(array("status" => TRUE));
	}
}
