<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: ViewProfiles controller
  Author: Laxmi
  Created Date: 2/Febryary/2018
 * */  
class ViewProfiles extends CI_Controller {
	function __construct() {
        parent::__construct(); 
        $this->load->model('Viewprofile_model','profiles');
        $this->load->model('Reports_model','reports');
        $this->load->model('Matrimony_model','matrimony');
        $this->load->model('Admin_model','admin');
        $this->load->model('Mothertongues_model','mothertongues');
        
        if(!isset($this->session->userdata['admindata']['uname']))
        {
	 redirect('/admin');
	}
	}

	public function index() {
            $countries = $this->reports->getcountries();
            $packages = $this->matrimony->getpackage();
            $data = array('countries'=>$countries,'packages'=>$packages);
	   $this->load->view('admin/profiles/ViewAllProfiles',$data);
	}
        
	//get all Profiles	
   	public function allProfilesData(){
	$totalrecords = $this->profiles->getAllReports($_POST,1);
        $allspls = $this->profiles->getAllReports($_POST);
    	$json_data = array(
	        "draw"  => intval( $_POST['draw'] ),
	        "iTotalRecords"  => intval( $totalrecords ),
	        "iTotalDisplayRecords"  => intval( $totalrecords ),
	        "recordsFiltered"  => intval( count($allspls) ),
	        "data"  => $allspls,
	        );
	    header('Access-Control-Allow-Origin: *');
	    header("Content-Type: application/json");
	    echo json_encode($json_data);
	}

        
        //user status change
    public function stausChangeUser(){
	$profilecode = $this->input->post('profilecode');
        $status = $this->input->post('status');
        $email =$this->input->post('email');
        $profilestat = $status == 1 ? "Deactivate" : "Activate";
        
        $email = $this->input->post('email');
	    if($status == 1){
		$data = array(
		   'profile_status'=>0,
	        );
	    }
        else if($status == 0){
	    $data = array(
		'profile_status'=>1,
	    );
	}			
	$result = $this->profiles->change_staus_by_profilecode($profilecode,$data);
        if($result){
          $data['profilecode'] = $profile_code;
           $data['profilestat'] = $profilestat;
           $this->load->library('email',array('mailtype' => 'html'));
           $this->email->from('info@padmashaliindia.com');
           $this->email->to($email);
           $this->email->subject("Profile".$profilestat."From padmashaliindia.com");
           $message = $this->load->view('email/profilestatus', $data, true);
           $this->email->message($message);
           $sent = $this->email->send(); 
           echo json_encode(array("status" => TRUE));
        }
	
	}
        
        //user contacts view details
        public function UserContactsViewDetails(){
            $profilecode = $this->uri->segment(3);
            $vieweddata = $this->profiles->viewed_by_me($profilecode);
            $data = array('vieweddata'=>$vieweddata);
           $this->load->view('admin/profiles/user_view_details',$data); 
            
        }
        
        public function UserView(){
            $profilecode = $this->uri->segment(3);
            $data['view'] = $this->profiles->view_data($profilecode);
			$data['edunames'] = $this->matrimony->educationname();
            $data['occupationname'] = $this->matrimony->occupationname();
            $this->load->view('admin/profiles/view',$data); 
            
        }
    public function stausChangePhoto(){
        $profilecode = $this->input->post('profilecode');
        $status = $this->input->post('status');
        $email = $this->input->post('email');
        $photostat = $status == 1 ? "Deactivate" : "Activate";
	    if($status == 1){
		$data = array(
		   'Profile_photo_Status'=>0,
	        );
	    }
        else if($status == 0){
	    $data = array(
		'Profile_photo_Status'=>1,
	    );
	}			
	$result = $this->profiles->change_photostaus_by_profilecode($profilecode,$data);
         if($result){
          $data['profilecode'] = $profile_code;
          $data['photostat'] = $photostat;
           $this->load->library('email',array('mailtype' => 'html'));
           $this->email->from('info@padmashaliindia.com');
           $this->email->to($email);
           $this->email->subject("Photo".$photostat."From padmashaliindia.com");
           $message = $this->load->view('email/profilestatus', $data, true);
           $this->email->message($message);
           $sent = $this->email->send(); 
           echo json_encode(array("status" => TRUE));
        }
	
    } 
    
    
    public function updatePackage(){
	$profilecode = $this->input->post('profile_code');
	$package = $this->input->post('package');
	$packagedata = $this->admin->get_userpackage($package);
	if($packagedata){
		$presentvaliddate=$packagedata->valid;
		$presentnoofviews = $packagedata->views;
		}
	$validityupto= date("Y-m-d", strtotime("+ $presentvaliddate days"));
	
	$data = array(
	'package'=>$package,
	'payment_status'=>3,
	'suscribed_on'=>date('Y-m-d H:i:sa'),
	'subscribe_validity'=>$validityupto,
	'noofviews'=>$presentnoofviews,
	'paidstatus'=>1,
	);
	$invoice = array(
	'profileid'=>$profilecode,
        'package'=>$package,
        'packageview'=>$presentnoofviews,
        'transactiontype'=>3,
        'date'=>date('Y-m-d H:i:sa'),
	);

	$result = $this->admin->upadate_package($profilecode,$data,$invoice);
        echo json_encode(array("status" => TRUE));
		}
                
      public function editUser($profilecode){
          $profilecode = $this->uri->segment(3);
          $data['education'] = $this->matrimony->getEducation();
        $data['occupation'] = $this->matrimony->getOccupation();
        $data['employee']= $this->matrimony->getEmployeement();
        $data['complexion'] = $this->matrimony->getComplexion();
        $data['bloodgroup'] = $this->matrimony->getBloodgroup();
        $data['specilcase'] = $this->matrimony->getSpecialcase();
        $data['rasi']       = $this->matrimony->getRasi();
        $data['star']       =$this->matrimony->getStar();
        $data['country'] =   $this->matrimony->getcountries();
	$data['height']=  $this->matrimony->getHeightList();
	$data['packages'] = $this->matrimony->getpackage();
	$data['mothertongues'] = $this->mothertongues->getmothertongues();
        $data['userdata'] = $this->profiles->edit_user($profilecode);
        $this->load->view('admin/profiles/edit',$data);
          
      }
      
    public function updateUser(){
  
    $mobile =$this->input->post('mobile');
    $gender  = $this->input->post('gender');
    $height = $this->input->post('feet');
    $inch = substr($height, -6,3);
    $phonecode = $this->input->post('phcode');
   // echo $phonecode;
    $pcode = explode('_',$phonecode);
    //print_r($pcode);
    $phncode = $pcode[1]."-";
    //echo $phncode;
   //exit;
    $gender  = $this->input->post('gender');
    $nochild = $this->input->post('nofchild');
            if($nochild ==""){
                $nochilds ="None";
            }
            else{
               $nochilds = $nochild;
            }

            if($this->input->post('Living')==""){
                $living_status = "None";
            }
            else{
                $living_status = $this->input->post('Living');
            }
	

	   $looking = $this-> input->post('looking');
	   $educationtype = $this->input->post('educationtype');
           $edu_for = $this->input->post('educations');
           $occupationtype = $this->input->post('occupationtype');
           $occuaption_for = $this->input->post('occupations');
   
       if($educationtype == 'DoesNotMatter'){
           $partnereducation = '0';
           $partnereducationtype = 'DoesNotMatter';
       }
       else{
         $partnereducationtype = 'Educated';
         $partnereducation = implode(',',$edu_for );
       }

       if($occupationtype == 'DoesNotMatter'){
            $partneroccuaptiontype = 'DoesNotMatter';
            $partneroccuaption = '0';
       }else
       if($occupationtype == 'NotWorking'){
            $partneroccuaptiontype = 'NotWorking';
            $partneroccuaption = '0';
       }else
        if($occupationtype == 'Working'){
            $partneroccuaptiontype = 'Working';
            $partneroccuaption = implode(',',$occuaption_for);
        }

       //$profilecode = $this->input->post('profilecode');
       $heightfrom=$this->input->post('feetfor');//here removing the space of height From
       $heightto=$this->input->post('feetto');
       $email = $this->input->post('email');
       $profilecode =$this->input->post('profilecode');
	$personaldata = array(
	    'receiptnumber'   =>$this->input->post('receiptnumber'),
	    'profile_by'      =>$this->input->post('profile_by'),
	    'ref_by'	      =>$this->input->post('ref_by'),
	    'sname' 	      =>$this->input->post('surname'),
	    'fname'           =>$this->input->post('firstname'),
	    'lname'           =>$this->input->post('lastname'),
	    'gender'          =>$gender,
	    'marital_status'  =>$this->input->post('maritalstatus'),
            'nochild '        =>$nochilds,
            'livig_status'    =>$living_status,
            'living_in'       =>$this->input->post('nationality'),
	    'mobile'          =>$phncode.$this->input->post('mobile'),
            'email'           =>$email,
	);

	$familydata = array(
	'birth_place'=>$this->input->post('birthplace'),
        'hrs'        =>$this->input->post('hrs'),
        'mins'       =>$this->input->post('minutes'),
        'secs'       =>$this->input->post('secs'),
        'period'     =>$this->input->post('period'),
	'feet'       =>$height,
	'inch'       =>$inch,
	'birth_name '=>$this->input->post('birthname'),
        'gowthram'=>$this->input->post('gowthram'),
        'rasi'=>$this->input->post('rasi'),
        'paadam '=>$this->input->post('paadam'),
        'star'=>$this->input->post('star'),
        'horoscope'=>$this->input->post('horoscope'),
        'manglik'=>$this->input->post('manglik'),
	'country'=>$this->input->post('country'),
        'state'=>$this->input->post('state'),
        'city'=>$this->input->post('city'),
	'res_status'=>$this->input->post('res_status'),
	'address'=>$this->input->post('address'),
        'perminantaddress'=>$this->input->post('paddress'),
	'fmobile'=>$this->input->post('AlternateMobile'),
        'phone'=>$this->input->post('LandLine'),
	'family_origin'=>$this->input->post('family_origin'),
        'aboutme'=>$this->input->post('Aboutme'),
	'father_name'=>$this->input->post('fathername'),
        'fa_alive'=>$this->input->post('Mr'),
        'father_occupation'=>$this->input->post('father_occupation'),
        'mother_name'=>$this->input->post('mothername'),
        'ma_alive'=>$this->input->post('Mrs'),
        'mother_occupation'=>$this->input->post('mother_occupation'),
	'elder_bro'=>$this->input->post('elderbro'),
        'young_bro'=>$this->input->post('youngerbro'),
        'elder_sis'=>$this->input->post('eldersis'),
        'young_sis'=>$this->input->post('youngersis'),
        'elder_bro1'=>$this->input->post('elmarried'),
        'young_bro1'=> $this->input->post('yumaried'),
        'elder_sis1'=> $this->input->post('elsismarried'),
        'young_sis1'=>$this->input->post('ysmarried'),
        'desc_family'=>$this->input->post('aboutfamily'),
	'edu' =>$this->input->post('education'),
        'edu_details'=>$this->input->post('edudetails'),
        'occu'=>$this->input->post('occupation'),
        'occ_details'=>$this->input->post('occdetails'),
	'income'=>$this->input->post('income'),
        'empin'=>$this->input->post('empin'),
        'employmentdetails'=>$this->input->post('empdetails'),
	'mothertounge'    =>$this->input->post('mothertongue'),
	'weight'=>$this->input->post('weight'),
        'cmplxion'=>$this->input->post('complexion'),
        'bldgrp'=>$this->input->post('bloodgroup'),
        'splcases'=>$this->input->post('specilcase'),
        'dite'=>$this->input->post('dite'),
        'body_type'=>$this->input->post('bodytype'),
        'smoke'=>$this->input->post('Smoke'),
        'drink'=>$this->input->post('Drink'),
	'look_for'=>implode(",", $looking),
        'age_from '=>$this->input->post('agefrom'),
        'age_to'=>$this->input->post('ageto'),
        'feet_from'=>$heightfrom,
        'inch_from'=>$heightto,
        'Complexion_from'=>$this->input->post('cmplxionfor'),
        'countryresidant_from'=>$this->input->post('countryfor'),
        'Education_from'=>$partnereducation,
        'Occuaption_From'=>$partneroccuaption,
        'AnnualIncome_from'=>$this->input->post('anualincome'),
        'Education_fromType'=>$partnereducationtype,
        'Occuaption_FromType'=>$partneroccuaptiontype,
	);
	
	$result = $this->profiles->updateUserProfile($personaldata,$familydata,$profilecode);
	if($result){
	
            $data['profilecode'] = $profile_code;
            $data['password']   = $password;
           $this->load->library('email',array('mailtype' => 'html'));
           $this->email->from('info@padmashaliindia.com');
           $this->email->to($email);
           $this->email->subject('Details Updated From Admin');
           $message = $this->load->view('email/update', $data, true);
          $this->email->message($message);
          $sent = $this->email->send();

	    $this->session->set_flashdata('userupdate_sucess', 'User aded successfully');
	    redirect('ViewProfiles');
	}
	else{
	    $this->session->set_flashdata('userupdate_error', 'User  not added');
	    redirect('ViewProfiles');
	}

      }
	  
	  
	public function invoice(){
		$profilecode =	$this->uri->segment(3);
		$data['invoice'] = $this->profiles->invoicedata($profilecode);
	
		$this->load->view('admin/profiles/invoice',$data);
	}  
      
}

