<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Events controller
  Author: Laxmi
  Created Date: 25/January/2018
 * */  
class Events extends CI_Controller {
    function __construct() {
        parent::__construct(); 
	$this->load->model('Events_model','events');
	if(!isset($this->session->userdata['admindata']['uname'])){
            redirect('/admin');
	}
    }

    public function index(){
	$this->load->view('admin/events/View');
	}
	
    //Add events page 
    public function addEvents(){
	$this->load->view('admin/events/Add');
    }
	
    public function saveEvents(){
	$data = array(
            'Name'=>$this->input->post('eventname'),
	    'EventDate'=>$this->input->post('eventdate'),
	    'Description'=>$this->input->post('desc'),
	    'CreatedOn'=>date('Y-m-d H:i:s'),
	);
	$result = $this->events->saveEvents($data);
	if($result){
	    $this->session->set_flashdata('events_sucess', 'events added successfully');
	    redirect('events');
	}
	else{
	    $this->session->set_flashdata('events_error', 'events  not done');
	    redirect('events');
	}
	}

    //get all events	
    public function allEventsData(){
	$totalrecords = $this->events->getAllEvents($_POST,1);
        $allevents = $this->events->getAllEvents($_POST);
        $json_data = array(
            "draw"  => intval( $_POST['draw'] ),
            "iTotalRecords"  => intval( $totalrecords ),
            "iTotalDisplayRecords"  => intval( $totalrecords ),
            "recordsFiltered"  => intval( count($allevents) ),
            "data"  => $allevents,
            );
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");
        echo json_encode($json_data);
    }
	   
    // edit package
    public function eventEdit($id){
	$data = $this->events->get_events_by_id($id);
	echo json_encode($data);
    } 
		
		
    //update package
    public function updateEvents(){
	$data = array(
            'Name'=>$this->input->post('eventname'),
            'Description'=>$this->input->post('desc'),
            'EventDate'=>$this->input->post('eventdate'),
	);
	$this->events->events_update(array('EventID' => $this->input->post('event_id')), $data);
	echo json_encode(array("status" => TRUE));
	}
	//delete Events
    public function deleteEvents($id){
	$this->events->delete_events_by_id($id);
	echo json_encode(array("status" => TRUE));
	}
	//Events status change
    public function stausChangeEvent(){
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
	$this->events->change_staus_by_id($id,$data);
	echo json_encode(array("status" => TRUE));
	}
}
