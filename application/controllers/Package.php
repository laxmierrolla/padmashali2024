<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Package controller
  Author: Laxmi
  Created Date: 26/December/2017
 * */  
class Package extends CI_Controller {
	function __construct() {
        parent::__construct(); 
		 $this->load->model('Admin_model','admin');
		 $this->load->model('Matrimony_model','matrimony');
		 $this->load->model('Package_model','package');
		 if(!isset($this->session->userdata['admindata']['uname']))
         {
			 redirect('/admin');
			 }
		
	}

	public function index()
	{
		$this->load->view('admin/packges/viewPackage');
		
	}
	
	//Add packages page 
 public function addpackages(){
		$this->load->view('admin/packges/addPackage');
		}

//	package check
public function packageCheck(){
	 $packagename = $this->input->post('packagename');
        $result = $this->package->check_package($packagename);
        echo $result;
	}	
	public function savePackage(){
		$period =$this->input->post('period');
		$validity =  $this->input->post('validity');
		if($period=='week'){$validdays='7';}else if($period=='months'){$validdays='30';}else if($period=='years'){$validdays='365';}
		$expire=$validity*$validdays;
		$data = array(
		'name'=>$this->input->post('packagename'),
		'views'=>$this->input->post('noofviews'),
		'valid_int'=>$validity,
		'valid_text'=>$period,
		'price'=>$this->input->post('price'),
		'valid'=>$expire,
		'created_on'=>date('Y-m-d H:i:sa'),
		);
		
		$result = $this->package->savePackages($data);
		if($result){
			$this->session->set_flashdata('package_sucess', 'Package renewl successfully');
			redirect('package');
		}
		else{
			$this->session->set_flashdata('package_error', 'Package renewl not done');
			redirect('package');
			}
	}

	//get all packages	
   public function allPackegesData(){
	   $totalrecords = $this->package->getAllPackages($_POST,1);
       $allpackages = $this->package->getAllPackages($_POST);
    $json_data = array(
        "draw"  => intval( $_POST['draw'] ),
        "iTotalRecords"  => intval( $totalrecords ),
        "iTotalDisplayRecords"  => intval( $totalrecords ),
        "recordsFiltered"  => intval( count($allpackages) ),
        "data"  => $allpackages,
        );
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json");
    echo json_encode($json_data);
	   
	   }
	   
	// edit package
	
	public function packageEdit($id)
		{
			$data = $this->package->get_package_by_id($id);
			echo json_encode($data);
		} 
		
		
	//update package
	public function updatePackage(){
		$period =$this->input->post('period');
		$validity =  $this->input->post('validity');
		if($period=='week'){$validdays='7';}else if($period=='months'){$validdays='30';}else if($period=='years'){$validdays='365';}
		$expire=$validity*$validdays;
		$data = array(
		'name'=>$this->input->post('packagename'),
		'views'=>$this->input->post('noofviews'),
		'valid_int'=>$validity,
		'valid_text'=>$period,
		'price'=>$this->input->post('price'),
		'valid'=>$expire,
		);
		$this->package->package_update(array('id' => $this->input->post('package_id')), $data);
		echo json_encode(array("status" => TRUE));
		
		}
	//delete Package
	public function deletePackage($id)
	{
		$this->package->delete_package_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	//package status change
	public function stausChangePackage(){
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
		$this->package->change_staus_by_id($id,$data);
		echo json_encode(array("status" => TRUE));
		}
 	
	//update package views view page
	public function updateViewsPage(){
		$this->load->view('admin/packges/updateViews');
		}
	
	//update Views function	
public function updateViews(){

	$profilecode = $this->input->post('prfscode');
	$oldviews = $this->input->post('noofviews');
	$presentnoofviews = $this->input->post('addviews');
	$totalviews=$oldviews+$presentnoofviews;
	
	$data = array(
	   'noofviews'=>$totalviews,
	);
	$result = $this->package->upadate_views($profilecode,$data);
	if($result){
		$this->session->set_flashdata('views_sucess', 'views updated successfully');
		redirect('package/updateViewsPage');
		}
	else{
		$this->session->set_flashdata('views_error', 'views  not updated');
		redirect('package/updateViewsPage');
			}
	
		}	
		
		
		  			   	
}
