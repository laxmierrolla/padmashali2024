<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: State controller
  Author: Laxmi
  Created Date: 19/Jan/2017
 * */  
class State extends CI_Controller {
	function __construct() {
        parent::__construct(); 
		if(!isset($this->session->userdata['admindata']['uname']))
         {
			redirect('/admin');
		 }
		 $this->load->model('State_model','state');
		 $this->load->model('Matrimony_model','matrimony');
	}

	public function index(){
		$countries = $this->matrimony->getcountries();
		$data = array('countries'=>$countries);
	    $this->load->view('admin/state/View',$data);
	
	}
	
	//Add state page 
 public function addState(){
		$countries = $this->matrimony->getcountries();
		$data = array('countries'=>$countries);
	    $this->load->view('admin/state/Add',$data);

		}

//	state check
public function stateCheck(){
	    $country = $this->input->post('country');
		$state = $this->input->post('state');
        $result = $this->state->check_state($country,$state);
        echo $result;
	}	
	public function saveState(){
		$data = array(
		'name'=>$this->input->post('statename'),
		'country_id'=>$this->input->post('countryname'),
		);
		
		$result = $this->state->saveState($data);
		if($result){
			$this->session->set_flashdata('state_sucess', 'state successfully');
			redirect('state');
		}
		else{
			$this->session->set_flashdata('state_error', 'state  not done');
			redirect('state');
			}
	}

	//get all State	
   public function allStatesData(){
	   $totalrecords = $this->state->getAllStates($_POST,1);
       $allstates = $this->state->getAllStates($_POST);
    $json_data = array(
        "draw"  => intval( $_POST['draw'] ),
        "iTotalRecords"  => intval( $totalrecords ),
        "iTotalDisplayRecords"  => intval( $totalrecords ),
        "recordsFiltered"  => intval( count($allstates) ),
        "data"  => $allstates,
        );
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json");
    echo json_encode($json_data);
	   
	   }
	   
	// edit states
	
	public function stateEdit($id)
		{
			$data = $this->state->get_state_by_id($id);
			echo json_encode($data);
		} 
		
		
	//update state
	public function updateState(){
		$data = array(
		   'name'=>$this->input->post('statename'),
		   'country_id'=>$this->input->post('countryname'),
		);
		$this->state->state_update(array('id' => $this->input->post('state_id')), $data);
		echo json_encode(array("status" => TRUE));
		
		}
	//delete countries
	public function deleteStates($id)
	{
		$this->state->delete_state_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	
 	
	
		  			   	
}
