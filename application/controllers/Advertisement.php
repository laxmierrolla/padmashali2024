<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Advertisement stories controller
  Author: Laxmi
  Created Date: 28/January/2018
 * */  
class Advertisement extends CI_Controller {
    function __construct() {
        parent::__construct(); 
	$this->load->model('Advertisement_model','adv');
	if(!isset($this->session->userdata['admindata']['uname'])){
            redirect('/admin');
	}
    }

    public function index(){
	$this->load->view('admin/advertisements/View');
	}
	
    //Add Advertisemnts page 
    public function addAdvertisemts(){
	$this->load->view('admin/advertisements/Add');
    }
	
    public function saveAdds(){
	if($_FILES['image']['name']!='') {
	$config['upload_path'] = 'uploads/advertaisement'; 
        $config['allowed_types'] = 'jpg|jpeg|png';
        $unique_id="PSadv_".rand(00,99999);     
        $imgfile = $_FILES['image']['tmp_name'];
        $ext=explode(".",$_FILES['image']['name']);
        $fimage= $unique_id.".".$ext[1]; 
        $config['file_name'] = $fimage;  
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('image')){
            $error =  $this->upload->display_errors();
            $this->session->set_flashdata('photo_insert', $error);
            redirect(base_url('advertisement'));   
        } 
	else { 
            $fInfo = $this->upload->data(); //uploading
            $image =$fimage;
        }
        }	
	$data = array(
	    'AddPage'=>$this->input->post('selectpage'),
	    'AddImage'=>$image,
	    'AddWebLink'=>$this->input->post('weblink'),
            'AddStatus'=>1,
	    'AddDate'   =>date('Y-m-d H:i:s'),
	);	    
	$result = $this->adv->saveAdds($data);
	if($result){
	    $this->session->set_flashdata('add_sucess', 'adds successfully');
	    redirect('advertisement');
	}
	else{
	    $this->session->set_flashdata('add_error', 'adds  not done');
	    redirect('advertisement');
	}
	}

    //get all Advertisements	
    public function allData(){
     
	$totalrecords = $this->adv->getAllData($_POST,1);
        $alldata= $this->adv->getAllData($_POST);
        $json_data = array(
            "draw"  => intval( $_POST['draw'] ),
            "iTotalRecords"  => intval( $totalrecords ),
            "iTotalDisplayRecords"  => intval( $totalrecords ),
            "recordsFiltered"  => intval( count($alldata) ),
            "data"  => $alldata,
            );
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");
        echo json_encode($json_data);
    }
	   
    // edit adds
    public function addEdit($id){
	$data = $this->adv->get_add_by_id($id);
	echo json_encode($data);
    } 
		
		
    //update Adds
    public function updateAdds(){
       
	$oldimage = $this->input->post('oldimage');
	if($_FILES['image']['name']!='') {
            $config['upload_path'] = 'uploads/advertaisement'; 
            $config['allowed_types'] = 'jpg|jpeg|png';
            $unique_id="PSadv_".rand(00,99999);    
            $imgfile = $_FILES['image']['tmp_name'];
            $ext=explode(".",$_FILES['image']['name']);
            $fimage= $unique_id.".".$ext[1]; 
            $config['file_name'] = $fimage;  
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('image')){
                $error =  $this->upload->display_errors();
                $this->session->set_flashdata('photos_error', $error);
                redirect(base_url('advertisement'));   
            } 
            else { 
                $fInfo = $this->upload->data(); //uploading
                $image =$fimage;
                unlink('uploads/advertaisement/'.$oldimage);
            }
        }
	else{
	    $image =$oldimage;
	}	
	$data = array(
	    'AddPage'=>$this->input->post('selectpage'),
	    'AddImage'=>$image,
	    'AddWebLink'=>$this->input->post('link'),
            
	);
	$this->adv->add_update(array('AddId' => $this->input->post('add_id')), $data);
	echo json_encode(array("status" => TRUE));
   }
//delete adds
    public function deleteAdd($id){
	$this->adv->delete_adds_by_id($id);
	echo json_encode(array("status" => TRUE));
	}
        
//adds status change
    public function stausChangeAdds(){
  
	$id = $this->input->post('id');
        $status = $this->input->post('status');
	    if($status == 1){
		$data = array(
		   'AddStatus'=>0,
	        );
	    }
        else if($status == 0){
	    $data = array(
		'AddStatus'=>1,
	    );
	}			
	$this->adv->change_staus_by_id($id,$data);
	echo json_encode(array("status" => TRUE));
	}
}
