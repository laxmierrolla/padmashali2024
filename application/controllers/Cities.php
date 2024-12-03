<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: City controller
  Author: Laxmi
  Created Date: 19/Jan/2017
 * */  
class Cities extends CI_Controller {
	function __construct() {
        parent::__construct(); 
		if(!isset($this->session->userdata['admindata']['uname']))
         {
			redirect('/admin');
		 }
		 $this->load->model('City_model','city');
		 $this->load->model('Matrimony_model','matrimony');
	}

	public function index(){
		$countries = $this->matrimony->getcountries();
		$data = array('countries'=>$countries);
	    $this->load->view('admin/city/View',$data);
	
	}
	
	//Add City page 
 public function addCity(){
		$countries = $this->matrimony->getcountries();
		$data = array('countries'=>$countries);
	    $this->load->view('admin/city/Add',$data);

		}

//	city check
public function cityCheck(){
		$state = $this->input->post('state');
		$city = $this->input->post('city');
        $result = $this->city->check_city($city,$state);
        echo $result;
	}
		
	public function saveCities(){
		$data = array(
		'name'=>$this->input->post('cityname'),
		'state_id'=>$this->input->post('statename'),
		);
		
		$result = $this->city->saveCity($data);
		if($result){
			$this->session->set_flashdata('city_sucess', 'city successfully');
			redirect('cities');
		}
		else{
			$this->session->set_flashdata('city_error', 'city  not done');
			redirect('cities');
			}
	}

	//get all State	
   public function allCitiesData(){
	   $totalrecords = $this->city->getAllCities($_POST,1);
       $allcities = $this->city->getAllCities($_POST);
    $json_data = array(
        "draw"  => intval( $_POST['draw'] ),
        "iTotalRecords"  => intval( $totalrecords ),
        "iTotalDisplayRecords"  => intval( $totalrecords ),
        "recordsFiltered"  => intval( count($allcities) ),
        "data"  => $allcities,
        );
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json");
    echo json_encode($json_data);
	   
	   }
	   
	// edit Cities
	
	public function cityEdit($id)
		{
			$data = $this->city->get_city_by_id($id);
			echo json_encode($data);
		} 
		
		
	//update city
	public function updateCity(){
	
		$data = array(
		   'name'=>$this->input->post('cityname'),
		   'state_id'=>$this->input->post('statename'),
		);
		$this->city->city_update(array('id' => $this->input->post('city_id')), $data);
		echo json_encode(array("status" => TRUE));
		
		}
	//delete cities
	public function deleteCities($id)
	{
		$this->city->delete_city_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	
 	
	
		  			   	
}
