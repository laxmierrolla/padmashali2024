<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: AboutUs controller
  Author: Laxmi
  Created Date: 28/January/2018
 * */  
class AboutUs extends CI_Controller {
    function __construct() {
        parent::__construct(); 
	$this->load->model('About_model','about');
	if(!isset($this->session->userdata['admindata']['uname'])){
            redirect('/admin');
	}
    }

    public function index(){
	$this->load->view('admin/aboutus/View');
	}
	
    //Add About page 
    public function addAbout(){
	$this->load->view('admin/aboutus/Add');
    }
	
    public function saveAbout(){
	$data = array(
            'Career_Name'=>$this->input->post('title'),
	    'Career_Desc'=>$this->input->post('desc'),
            'CreatedOn'=>date('Y-m-d H:i:s'),
	);
	$result = $this->about->saveAbout($data);
	if($result){
	    $this->session->set_flashdata('about_sucess', 'aboutUs added successfully');
	    redirect('aboutUs');
	}
	else{
	    $this->session->set_flashdata('about_error', 'aboutUs  not done');
	    redirect('aboutUs');
	}
	}

    //get all Aboutus	
    public function allAboutData(){
	$totalrecords = $this->about->getAllAbout($_POST,1);
        $allabout = $this->about->getAllAbout($_POST);
        $json_data = array(
            "draw"  => intval( $_POST['draw'] ),
            "iTotalRecords"  => intval( $totalrecords ),
            "iTotalDisplayRecords"  => intval( $totalrecords ),
            "recordsFiltered"  => intval( count($allabout) ),
            "data"  => $allabout,
            );
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");
        echo json_encode($json_data);
    }
	   
    // edit package
    public function aboutEdit($id){
	$data = $this->about->get_about_by_id($id);
	echo json_encode($data);
    } 
		
		
    //update About
    public function updateAbout(){
	$data = array(
            'Career_Name'=>$this->input->post('title'),
            'Career_Desc'=>$this->input->post('desc'),
	);
	$this->about->about_update(array('Career_ID' => $this->input->post('career_id')), $data);
	echo json_encode(array("status" => TRUE));
	}
	//delete About
    public function deleteAbout($id){
	$this->about->delete_about_by_id($id);
	echo json_encode(array("status" => TRUE));
	}
	//Events status change
    public function stausChangeAbout(){
	    $id = $this->input->post('id');
	    $status = $this->input->post('status');
	    if($status == 1){
		$data = array(
		   'Career_Status'=>0,
	        );
	    }
        else if($status == 0){
	    $data = array(
		'Career_Status'=>1,
	    );
	}			
	$this->about->change_staus_by_id($id,$data);
	echo json_encode(array("status" => TRUE));
	}
}
