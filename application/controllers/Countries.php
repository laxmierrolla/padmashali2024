<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Countries controller
  Author: Laxmi
  Created Date: 15/Jan/2017
 * */  
class Countries extends CI_Controller {
	function __construct() {
        parent::__construct(); 
		if(!isset($this->session->userdata['admindata']['uname']))
         {
			redirect('/admin');
		 }
		 $this->load->model('Countries_model','country');
	}

	public function index(){
			 $this->load->view('admin/countries/list');
	
	}
	
	//Add country page 
 public function addCountries(){
		$this->load->view('admin/countries/add');
		}

//	country check
public function countryCheck(){
	 $country = $this->input->post('countryname');
        $result = $this->country->check_country($country);
        echo $result;
	}	
	public function saveCountry(){
		$data = array(
		'name'=>$this->input->post('countryname'),
		'phonecode'=>$this->input->post('phonecode'),
		);
		
		$result = $this->country->saveCountry($data);
		if($result){
			$this->session->set_flashdata('country_sucess', 'country successfully');
			redirect('countries');
		}
		else{
			$this->session->set_flashdata('country_error', 'country  not done');
			redirect('countries');
			}
	}

	//get all Countries	
   public function allCountriesData(){
	   $totalrecords = $this->country->getAllCountries($_POST,1);
       $allcountries = $this->country->getAllCountries($_POST);
    $json_data = array(
        "draw"  => intval( $_POST['draw'] ),
        "iTotalRecords"  => intval( $totalrecords ),
        "iTotalDisplayRecords"  => intval( $totalrecords ),
        "recordsFiltered"  => intval( count($allcountries) ),
        "data"  => $allcountries,
        );
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json");
    echo json_encode($json_data);
	   
	   }
	   
	// edit countries
	
	public function countryEdit($id)
		{
			$data = $this->country->get_country_by_id($id);
			echo json_encode($data);
		} 
		
		
	//update occupation
	public function updateCountry(){
		$data = array(
		   'name'=>$this->input->post('countryname'),
		   'phonecode'=>$this->input->post('phonecode'),
		);
		$this->country->country_update(array('id' => $this->input->post('country_id')), $data);
		echo json_encode(array("status" => TRUE));
		
		}
	//delete countries
	public function deleteCountries($id)
	{
		$this->country->delete_country_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	
 	
	
		  			   	
}
