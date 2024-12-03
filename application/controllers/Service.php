<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Service controller
  Author: Laxmi
  Created Date: 28/January/2018
 * */  
class Service extends CI_Controller {
    function __construct() {
        parent::__construct(); 
	$this->load->model('Service_model','services');
	if(!isset($this->session->userdata['admindata']['uname'])){
            redirect('/admin');
	}
    }

    public function index(){
	$this->load->view('admin/services/View');
	}
	
    //Add Faqs page 
    public function addService(){
	$this->load->view('admin/services/Add');
    }
	
    public function saveService(){
	
	if($_FILES['image']['name']!='') {
	$config['upload_path'] = 'uploads/services'; 
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
            redirect(base_url('service'));   
        } 
	else { 
            $fInfo = $this->upload->data(); //uploading
            $image =$fimage;
        }
        }	
	$data = array(
		'Name'        =>$this->input->post('name'),
		'Image'       =>$image,
		'Description' =>$this->input->post('desc'),
		'CreatedOn'   =>date('Y-m-d H:i:s'),
	);	    
	$result = $this->services->saveServices($data);
	if($result){
	    $this->session->set_flashdata('service_sucess', 'services successfully');
	    redirect('service');
	}
	else{
	    $this->session->set_flashdata('service_error', 'service  not done');
	    redirect('service');
	}
	}

    //get all Services	
    public function allServicesData(){
	$totalrecords = $this->services->getAllServices($_POST,1);
        $allServices= $this->services->getAllServices($_POST);
        $json_data = array(
            "draw"  => intval( $_POST['draw'] ),
            "iTotalRecords"  => intval( $totalrecords ),
            "iTotalDisplayRecords"  => intval( $totalrecords ),
            "recordsFiltered"  => intval( count($allServices) ),
            "data"  => $allServices,
            );
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");
        echo json_encode($json_data);
    }
	   
    // edit services
    public function serviceEdit($id){
	$data = $this->services->get_service_by_id($id);
	echo json_encode($data);
    } 
		
		
    //update Services
    public function updateServices(){
       
	$oldimage = $this->input->post('oldimage');
	if($_FILES['image']['name']!='') {
            $config['upload_path'] = 'uploads/services'; 
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
                redirect(base_url('service'));   
            } 
            else { 
                $fInfo = $this->upload->data(); //uploading
                $image =$fimage;
                unlink('uploads/services/'.$oldimage);
            }
        }
	else{
	    $image =$oldimage;
	}	
	$data = array(
	    'Name'=>$this->input->post('name'),
	    'Image'=>$image,
	    'Description'=>$this->input->post('desc'),
	);
	$this->services->service_update(array('ServiceID' => $this->input->post('service_id')), $data);
	echo json_encode(array("status" => TRUE));
   }
//delete services
    public function deleteServices($id){
	$this->services->delete_service_by_id($id);
	echo json_encode(array("status" => TRUE));
	}
        
//services status change
    public function stausChangeServices(){
  
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
	$this->services->change_staus_by_id($id,$data);
	echo json_encode(array("status" => TRUE));
	}
}
