<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Success stories controller
  Author: Laxmi
  Created Date: 28/January/2018
 * */  
class Success_stories extends CI_Controller {
    function __construct() {
        parent::__construct(); 
	$this->load->model('Success_model','stories');
	if(!isset($this->session->userdata['admindata']['uname'])){
            redirect('/admin');
	}
    }

    public function index(){
	$this->load->view('admin/success_stories/View');
	}
	
    //Add Faqs page 
    public function addStories(){
	$this->load->view('admin/success_stories/Add');
    }
	
    public function saveStories(){
	if($_FILES['image']['name']!='') {
	$config['upload_path'] = 'uploads/stories'; 
        $config['allowed_types'] = 'jpg|jpeg|png';
        $unique_id="promotions_".rand(00,99999);  
        $imgfile = $_FILES['image']['tmp_name'];
        $ext=explode(".",$_FILES['image']['name']);
        $fimage= $unique_id.".".$ext[1]; 
        $config['file_name'] = $fimage;  
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('image')){
            $error =  $this->upload->display_errors();
            $this->session->set_flashdata('photo_insert', $error);
            redirect(base_url('success_stories'));   
        } 
	else { 
            $fInfo = $this->upload->data(); //uploading
            $image =$fimage;
        }
        }	
	$data = array(
	    'Couple_Name'=>$this->input->post('couplename'),
	    'Image'=>$image,
	    'Description'=>$this->input->post('desc'),
            'MarriedOn' =>@date('Y-m-d',strtotime($this->input->post('marriedate'))),
	    'CreatedOn'   =>date('Y-m-d H:i:s'),
	);	    
	$result = $this->stories->saveStories($data);
	if($result){
	    $this->session->set_flashdata('storie_sucess', 'stories successfully');
	    redirect('success_stories');
	}
	else{
	    $this->session->set_flashdata('storie_error', 'stories  not done');
	    redirect('success_stories');
	}
	}

    //get all Stories	
    public function allSuccessData(){
	$totalrecords = $this->stories->getAllStories($_POST,1);
        $allStories= $this->stories->getAllStories($_POST);
        $json_data = array(
            "draw"  => intval( $_POST['draw'] ),
            "iTotalRecords"  => intval( $totalrecords ),
            "iTotalDisplayRecords"  => intval( $totalrecords ),
            "recordsFiltered"  => intval( count($allStories) ),
            "data"  => $allStories,
            );
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");
        echo json_encode($json_data);
    }
	   
    // edit storie
    public function storieEdit($id){
	$data = $this->stories->get_storie_by_id($id);
	echo json_encode($data);
    } 
		
		
    //update Stories
    public function updateStories(){
       
	$oldimage = $this->input->post('oldimage');
	if($_FILES['image']['name']!='') {
            $config['upload_path'] = 'uploads/stories'; 
            $config['allowed_types'] = 'jpg|jpeg|png';
            $unique_id="promotions_".rand(00,99999);  
            $imgfile = $_FILES['image']['tmp_name'];
            $ext=explode(".",$_FILES['image']['name']);
            $fimage= $unique_id.".".$ext[1]; 
            $config['file_name'] = $fimage;  
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('image')){
                $error =  $this->upload->display_errors();
                $this->session->set_flashdata('photos_error', $error);
                redirect(base_url('Success_stories'));   
            } 
            else { 
                $fInfo = $this->upload->data(); //uploading
                $image =$fimage;
                unlink('uploads/stories/'.$oldimage);
            }
        }
	else{
	    $image =$oldimage;
	}	
	$data = array(
	    'Couple_Name'=>$this->input->post('couplename'),
	    'Image'=>$image,
	    'Description'=>$this->input->post('desc'),
            'MarriedOn' =>@date('Y-m-d',strtotime($this->input->post('marriedate'))),
	);
	$this->stories->stories_update(array('Story_ID' => $this->input->post('storie_id')), $data);
	echo json_encode(array("status" => TRUE));
   }
//delete stories
    public function deleteStories($id){
	$this->stories->delete_story_by_id($id);
	echo json_encode(array("status" => TRUE));
	}
        
//stories status change
    public function stausChangeStories(){
  
	$id = $this->input->post('id');
        $status = $this->input->post('status');
	    if($status == 1){
		$data = array(
		   'Story_Status'=>0,
	        );
	    }
        else if($status == 0){
	    $data = array(
		'Story_Status'=>1,
	    );
	}			
	$this->stories->change_staus_by_id($id,$data);
	echo json_encode(array("status" => TRUE));
	}
}
