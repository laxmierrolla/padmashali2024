<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Gallery controller
  Author: Laxmi
  Created Date: 03/January/2017
 * */  
class Gallery extends CI_Controller {
	function __construct() {
        parent::__construct(); 
		 $this->load->model('Gallery_model','gallery');
	}

	public function index()
	{
		if(isset($this->session->userdata['admindata']['uname']))
         {
		$this->load->view('admin/gallery/view');}
		else{
			redirect('/admin');
			}
	}
	
	//Add Gallery page 
 public function addGallery(){
		$this->load->view('admin/gallery/add');
		}

	
public function saveGallery(){
		$data = array(
		'GName'=>$this->input->post('galname'),
		'GDate'=>date('Y-m-d H:i:sa')
		);
		
		$result = $this->gallery->saveGallery($data);
		if($result){
			$this->session->set_flashdata('gallery_sucess', 'gallery successfully');
			redirect('gallery');
		}
		else{
			$this->session->set_flashdata('gallery_error', 'gallery  not done');
			redirect('gallery');
			}
	}

	//get all Gallery
   public function allGalleryData(){
	   $totalrecords = $this->gallery->getAllGallery($_POST,1);
       $allgallery = $this->gallery->getAllGallery($_POST);
    $json_data = array(
        "draw"  => intval( $_POST['draw'] ),
        "iTotalRecords"  => intval( $totalrecords ),
        "iTotalDisplayRecords"  => intval( $totalrecords ),
        "recordsFiltered"  => intval( count($allgallery) ),
        "data"  => $allgallery,
        );
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json");
    echo json_encode($json_data);
	   
	   }
	   
	// edit gallery
	
	public function galleryEdit($id)
		{
			$data = $this->gallery->get_gallery_by_id($id);
			echo json_encode($data);
		} 
		
		
	//update occupation
	public function updateGallery(){
		$data = array(
		   'GName'=>$this->input->post('galname'),
		);
		$this->gallery->gallery_update(array('Gid' => $this->input->post('gal_id')), $data);
		echo json_encode(array("status" => TRUE));
		
		}
	//delete Gallery
	public function deleteGallery($id)
	{
		$this->gallery->delete_gallery_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	//gallery status change
	public function stausChangeGallery(){
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		
		if($status == 1){
			$data = array(
			'GStatus'=>0,
			);
			}
        else if($status == 0){
			$data = array(
			'GStatus'=>1,
			);
			}			
		$this->gallery->change_staus_by_id($id,$data);
		echo json_encode(array("status" => TRUE));
		}
		
	// photo gallery view page
	public function photogallery(){
		$gallery = $this->gallery->get_gallery();
		$data = array('gallery'=>$gallery);
		$this->load->view('admin/gallery/PhotoGalleryView',$data);
		
		}
		
//get photogallery
	public function allPhotoGalleryData(){
	   $totalrecords = $this->gallery->getAllPhotoGallery($_POST,1);
       $allphotogallery = $this->gallery->getAllPhotoGallery($_POST);
    $json_data = array(
        "draw"  => intval( $_POST['draw'] ),
        "iTotalRecords"  => intval( $totalrecords ),
        "iTotalDisplayRecords"  => intval( $totalrecords ),
        "recordsFiltered"  => intval( count($allphotogallery) ),
        "data"  => $allphotogallery,
        );
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json");
    echo json_encode($json_data);
	   
	   }
	   
//delete photogallery

public function deletePhotoGallery($id){
	$this->gallery->delete_pgallery_by_id($id);
	echo json_encode(array("status" => TRUE));
	}	   	
 	
	


//photogallery status change
	public function stausChangePhotoGallery(){
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
		$this->gallery->change_pstaus_by_id($id,$data);
		echo json_encode(array("status" => TRUE));
		}
		
//view for photo gallery add page
public function addPhotoGallery(){
	$gallery = $this->gallery->get_gallery();
	$data = array('gallery'=>$gallery);
	$this->load->view('admin/gallery/PhotoGalleryAdd',$data);
	}
	
// photo galleryname check	

public function nameCheck(){
	$name = $this->input->post('name');
	 $result = $this->gallery->check_name($name);
        echo $result;
	}		
	
//save photogallery
public function  savePhotoGallery(){
	$name = $this->input->post('name');
	 if($_FILES['image']['name']!='') {
		  $config['upload_path'] = 'uploads/gallery'; 
          $config['allowed_types'] = 'jpg|jpeg|png';
          $unique_id=$name."".rand(00,999);
          $imgfile = $_FILES['image']['tmp_name'];
          $ext=explode(".",$_FILES['image']['name']);
          $fimage= $unique_id.".".$ext[1]; 
          $config['file_name'] = $fimage;  
          $this->load->library('upload', $config);
          $this->upload->initialize($config);
		   if(!$this->upload->do_upload('image')){
               $error =  $this->upload->display_errors();
               $this->session->set_flashdata('photos_error', $error);
               redirect(base_url('gallery/addPhotoGallery'));   
             } 
		 else { 
              $fInfo = $this->upload->data(); //uploading
               $image =$fimage;
              }
		  }	
		  
	$data = array(
		'gnameid' =>$this->input->post('galname'),
		'name'    =>$name,
		'image'   =>$image,
		'description' =>$this->input->post('desc'),
		'date'        =>date('Y-m-d H:i:s'),
	);	    
	
	$result = $this->gallery->save_photo_gallery($data);
	if($result){
			$this->session->set_flashdata('pgallery_sucess', 'gallery successfully');
			redirect('gallery/photogallery');
		}
		else{
			$this->session->set_flashdata('pgallery_error', 'gallery  not done');
			redirect('gallery/photogallery');
			}
	}
	
	//photo edit 	
	public function pgalleryEdit($id)
		{
			$data = $this->gallery->get_pgallery_by_id($id);
			echo json_encode($data);
		} 
		
//update occupation
	public function updatePGallery(){
		$name = $this->input->post('name'); 
		$oldimage = $this->input->post('oldimage');
		if($_FILES['image']['name']!='') {
		  $config['upload_path'] = 'uploads/gallery'; 
          $config['allowed_types'] = 'jpg|jpeg|png';
          $unique_id=$name."".rand(00,999);
          $imgfile = $_FILES['image']['tmp_name'];
          $ext=explode(".",$_FILES['image']['name']);
          $fimage= $unique_id.".".$ext[1]; 
          $config['file_name'] = $fimage;  
          $this->load->library('upload', $config);
          $this->upload->initialize($config);
		   if(!$this->upload->do_upload('image')){
               $error =  $this->upload->display_errors();
               $this->session->set_flashdata('photos_error', $error);
               redirect(base_url('gallery/photogallery'));   
             } 
		 else { 
              $fInfo = $this->upload->data(); //uploading
               $image =$fimage;
			   unlink('uploads/gallery/'.$oldimage);
              }
		  }
		  else{
			   $image =$oldimage;
			  }	
		$data = array(
		   'gnameid'=>$this->input->post('galname'),
		   'name'=>$name,
		   'image'=>$image,
		   'description'=>$this->input->post('desc'),
		);
		$this->gallery->pgallery_update(array('id' => $this->input->post('pgal_id')), $data);
		echo json_encode(array("status" => TRUE));
		
		}			
		  			   	
}
