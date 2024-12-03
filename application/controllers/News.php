<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Events controller
  Author: Laxmi
  Created Date: 27/January/2018
 * */  
class News extends CI_Controller {
    function __construct() {
        parent::__construct(); 
	$this->load->model('News_model','news');
	if(!isset($this->session->userdata['admindata']['uname'])){
            redirect('/admin');
	}
    }

    public function index(){
	$this->load->view('admin/news/View');
	}
	
    //Add news page 
    public function addNews(){
	$this->load->view('admin/news/Addd');
    }
	
    public function saveNews(){
	$data = array(
            'News_Descrtiption'=>$this->input->post('news'),
	    'News_Date'=>date('Y-m-d H:i:s'),
	);
	$result = $this->news->saveNews($data);
	if($result){
	    $this->session->set_flashdata('news_sucess', 'events added successfully');
	    redirect('news');
	}
	else{
	    $this->session->set_flashdata('news_error', 'events  not done');
	    redirect('news');
	}
	}

    //get all News	
    public function allNewsData(){
	$totalrecords = $this->news->getAllNews($_POST,1);
        $allnews = $this->news->getAllNews($_POST);
        $json_data = array(
            "draw"  => intval( $_POST['draw'] ),
            "iTotalRecords"  => intval( $totalrecords ),
            "iTotalDisplayRecords"  => intval( $totalrecords ),
            "recordsFiltered"  => intval( count($allnews) ),
            "data"  => $allnews,
            );
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");
        echo json_encode($json_data);
    }
	   
    // edit package
    public function newsEdit($id){
	$data = $this->news->get_news_by_id($id);
	echo json_encode($data);
    } 
		
		
    //update news
    public function updateNews(){
  
	$data = array(
            'News_Descrtiption'=>$this->input->post('news'),
	);
	$this->news->news_update(array('News_Id' => $this->input->post('news_id')), $data);
	echo json_encode(array("status" => TRUE));
	}
	//delete Events
    public function deleteNews($id){
	$this->news->delete_news_by_id($id);
	echo json_encode(array("status" => TRUE));
	}
	//Events status change
    public function stausChangeNews(){
	    $id = $this->input->post('id');
	    $status = $this->input->post('status');
	    if($status == 1){
		$data = array(
		   'News_Status'=>0,
	        );
	    }
        else if($status == 0){
	    $data = array(
		'News_Status'=>1,
	    );
	}			
	$this->news->change_staus_by_id($id,$data);
	echo json_encode(array("status" => TRUE));
	}
      public function Newsticker(){
	$this->load->view('admin/news/newstickerView');
	}   
        
    public function allNewstickerData(){
        $totalrecords = $this->news->getAllNewsticker($_POST,1);
        $allnews = $this->news->getAllNewsticker($_POST);
        $json_data = array(
            "draw"  => intval( $_POST['draw'] ),
            "iTotalRecords"  => intval( $totalrecords ),
            "iTotalDisplayRecords"  => intval( $totalrecords ),
            "recordsFiltered"  => intval( count($allnews) ),
            "data"  => $allnews,
            );
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");
        echo json_encode($json_data);
    } 
    
    public function newstickerEdit($id){
       $data = $this->news->get_newsticker_by_id($id);
	echo json_encode($data); 
    }
    
    public function updateNewsticker(){
        $data = array(
            'UpdateDesc'=>$this->input->post('news'),
	);
	$this->news->newsticker_update(array('UpdateId' => $this->input->post('news_id')), $data);
	echo json_encode(array("status" => TRUE));
    }
    
    public function stausChangeNewsticker(){
      $id = $this->input->post('id');
      $status = $this->input->post('status');
	    if($status == 1){
		$data = array(
		   'UpdateStatus'=>0,
	        );
	    }
        else if($status == 0){
	    $data = array(
		'UpdateStatus'=>1,
	    );
	}			
	$this->news->change_newsstaus_by_id($id,$data);
	echo json_encode(array("status" => TRUE));  
    }
}
