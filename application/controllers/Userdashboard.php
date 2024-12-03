 <?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Userdashboard controller
  Author: Laxmi
  Created Date: 29/October/2017
 * */ 
 class userdashboard extends CI_Controller {
      function __construct() {
        parent::__construct();
		if(!isset($this->session->userdata['user']['username']))
         {
         redirect('matrimony');
         }
        $this->data=array();
		  $this->load->library('pagination');
        $this->load->model('Userdashboard_model','udashboard');
         $this->load->model('Mothertongues_model','mothertongues');
        $this->load->model('Matrimony_model','matrimony');
		$this->load->model('Search_model','search');
       
    }
    
    public function index(){
        if($this->session->userdata['user']['username'])
         {
         
        $profileId = $this->session->userdata['user']['username'];
        $data = $this->udashboard->userdata($profileId);
        
        $education=$this->matrimony->getEducation();
        $occupation=$this->matrimony->getOccupation();
        $contactscount=$this->udashboard->home_menu_count($profileId);
		//patner prefernec based on eduction
		$prefere_edu=$this->udashboard->getprefer_edu($data->gender,$data->Education_from,$data->age);
		$viewdme_list=$this->udashboard->getviewdme($profileId);
		//patner prefernec based on occupation
		$prefere_occu=$this->udashboard->getprefer_occu($data->gender,$data->Occuaption_From,$data->age);
		 $prefered_matches=$this->udashboard->getprefer_matches($data);
		
		//all recent profile
		$recentprofiles=$this->udashboard->getrecent_profile($data->gender,$data->age);
        $result = array('data'=>$data,'occupation'=>$occupation,'education'=>$education,'contactscount'=>$contactscount,'prefer_edu'=>$prefere_edu,'prefer_ocu'=>$prefere_occu,'prefered_matches'=>$prefered_matches,'recent_profile'=>$recentprofiles,'viewdme_list'=>$viewdme_list);
        $this->load->view('User/userDashboard',$result);
        }
		else{
		redirect();
		}

    }
    
    public function viewProfile(){
      $profilecode      = $this->session->userdata['user']['username']; 
      $result           = $this->udashboard->viewProfile($profilecode);
      $mothertongues    = $this->mothertongues->getmothertongues();
      $nationality      = $this->matrimony->getcountries();
      $education        = $this->matrimony->getEducation();
      $occupation       = $this->matrimony->getOccupation();
      $complexion       = $this->matrimony->getComplexion();
      $bloodgroup       = $this->matrimony->getBloodgroup();
      $specilcase       = $this->matrimony->getSpecialcase();
      $rasi             = $this->matrimony->getRasi();
      $employee         = $this->matrimony->getEmployeement();
      $star             = $this->matrimony->getStar(); 
      $country          = $this->matrimony->getcountries();
      $edunames         = $this->matrimony->educationname();
      $occupationname   = $this->matrimony->occupationname();
	  $height=  $this->matrimony->getHeightList();
      $data= array('mothertongues'=>$mothertongues,'nationality'=>$nationality,'result' => $result,'complexion'=>$complexion,'bloodgroup'=>$bloodgroup,'specilcase'=>$specilcase,'education'=>$education,'occupation'=>$occupation,'rasi'=>$rasi,'star'=>$star,'employee'=>$employee,'country'=>$country,'edunames'=>$edunames,'occupationname'=>$occupationname,'height'=>$height);
      $this->load->view('User/viewProfile',$data);
    }
    //edit aboutme 
    public function aboutdata(){
        $profileid = $this->input->post('prfid');
        $data = $this->udashboard->aboutmedata($profileid);            
        echo json_encode($data);
        
    }
    
    //update aboutme    
     public function aboutupdate(){  
        $profileid = $this->input->post('profile_id'); 
        $data = array(
           'aboutme' => $this->input->post('aboutme'),
        );
        $update = $this->udashboard->aboutmeupdate($profileid,$data);
        echo"true";
    }
    public function basicdata(){
        $profileid = $this->input->post('prfid');
        $data = $this->udashboard->basicdedata($profileid);
        echo json_encode($data);
    }
    public function basicupdate(){
        $update = $this->udashboard->basicdupdate($_POST);
        echo"true";
    }
  public function physicaldata(){
       $profileid = $this->input->post('prfid');
        $data = $this->udashboard->physicaldata($profileid);
        echo json_encode($data);
  }
  
  public function physicalupdate(){
      $profileid = $this->input->post('profile_id'); 
        $data = array(
           'feet' => $this->input->post('height'),
           'weight'  =>$this->input->post('weight'),
           'cmplxion' =>$this->input->post('complexion'),
           'bldgrp'  =>$this->input->post('bloodgroup'),
           'splcases'=>$this->input->post('splcase'),
           'dite'  =>$this->input->post('dite'),
           'body_type'=>$this->input->post('bodytype'),
           'drink'=>$this->input->post('Drink'),
           'smoke'    =>$this->input->post('Smoke'),
        );
        $update = $this->udashboard->physicalupdate($profileid,$data);
        echo"true";
      
  }
  
  public function horodata(){
       $profileid = $this->input->post('prfid');
        $data = $this->udashboard->horodata($profileid);
        echo json_encode($data);
  }
  
  public function horoupdate(){
        $profileid = $this->input->post('profile_id'); 
        $data = array(
           'birth_place' => $this->input->post('birthplace'),
           'hrs'  =>$this->input->post('hrs'),
           'mins' =>$this->input->post('minutes'),
           'secs'  =>$this->input->post('secs'),
           'period'=>$this->input->post('period'),
           'birth_name'  =>$this->input->post('birthname'),
           'gowthram'=>$this->input->post('gowthram'),
           'rasi'=>$this->input->post('rasi'),
           'star'    =>$this->input->post('star'),
           'paadam'=>$this->input->post('padam'),
           'horoscope'=>$this->input->post('horoscope'),
           'manglik'    =>$this->input->post('manglik'),
        );
        $update = $this->udashboard->horoupdate($profileid,$data);
        echo"true";
  }
  
 public function professionaldata(){
     $profileid = $this->input->post('prfid');
     $data = $this->udashboard->professionaldata($profileid);
     echo json_encode($data);
 }
 
 public function professionalupdate(){
    $profileid = $this->input->post('profile_id');
    $occupation = $this->input->post('occupation');
	$empdaetails = $this->input->post('empdetails');
	
    if(($occupation == 1)||($occupation == 88)){
       $income = "";
       $empin=4;
       $empdaetails=""; 
    }
    else{
       $income     = $this->input->post('income');
       $empin       = $this->input->post('empin');
       $empdaetails = $this->input->post('empdetails'); 
    }
    
    $data = array(
           'edu'          =>$this->input->post('education'),
           'edu_details'  =>$this->input->post('edudetails'),
           'occu'         =>$occupation,
           'occ_details'  =>$this->input->post('occdetails'),
           'income'       =>$income,
           'empin'        => $empin,
           'employmentdetails'=>$empdaetails,
        );
        $update = $this->udashboard->prfupdate($profileid,$data);
        echo"true"; 
 }
 
 
 public function contactsdata(){
     $profileid = $this->input->post('prfid');
     $data = $this->udashboard->contactsdata($profileid);
     echo json_encode($data);
     
 }
 
 public function contactsupdate(){
     $profileid = $this->input->post('profile_id');
     $data = array(
           'address'          =>$this->input->post('address'),
           'perminantaddress' =>$this->input->post('permanentaddress'),
           'phone'            =>$this->input->post('landline'),
           'fmobile'          =>$this->input->post('mobile'),
           'country'          =>$this->input->post('country'),
           'state'            =>$this->input->post('state'),
           'city'             =>$this->input->post('city'),
           'family_origin'    =>$this->input->post('familyorigin'),
           'res_status'       =>$this->input->post('res_statue'),
           
        );
        $update = $this->udashboard->contactupdate($profileid,$data);
        echo"true"; 
     
 }
 
 public function familydata(){                  
    $profileid = $this->input->post('prfid');
     $data = $this->udashboard->family_data($profileid);
     echo json_encode($data); 
 }
 //update famil details
 public function familyupdate(){
     $profileid = $this->input->post('profile_id');
     $data = array(
           'father_name'          =>$this->input->post('fathername'),
           'fa_alive'             =>$this->input->post('Mr'),
           'father_occupation'    =>$this->input->post('fatheroccupation'),
           'mother_name'          =>$this->input->post('mothername'),
           'ma_alive'             =>$this->input->post('Mrs'),
           'mother_occupation'    =>$this->input->post('motheroccupatin'),
           'elder_bro'            =>$this->input->post('elderbrother'),
           'young_bro'            =>$this->input->post('youngerbrother'),
           'elder_sis'            =>$this->input->post('eldersister'),
           'young_sis'            =>$this->input->post('youngsister'),
           'desc_family'          =>$this->input->post('abtfamily'),
           'elder_bro1'           =>$this->input->post('eldermarried'),
           'young_bro1'           => $this->input->post('yungermarried'),
           'elder_sis1'           => $this->input->post('eldsismarried'),
           'young_sis1'           =>$this->input->post('yousismarried'),
           
        );
        $update = $this->udashboard->familyupdate($profileid,$data);
        echo"true";   
 }
 
 //edit partner data
  public function partnerdata(){
     $profileid = $this->input->post('prfid');
     $data = $this->udashboard->partner_data($profileid);
     echo json_encode($data); 
  }
 
 
 public function partnerupdate(){
	 $profileid = $this->input->post('profile_id');
	 $education = $this->input->post('education');
       $edu_for = $this->input->post('educations');
       $occupation = $this->input->post('occupationtype');
       $occuaption_for = $this->input->post('occupations');
       if($education == 'DoesNotMatter'){
           $partnereducation = '0';
           $partnereducationtype = 'DoesNotMatter';
       }
       else{
         $partnereducationtype = 'Educated';
         $partnereducation = implode(',',$edu_for );  
       }
       
       if($occupation == 'DoesNotMatter'){
            $partneroccuaptiontype = 'DoesNotMatter';
            $partneroccuaption = '0';
       }else
       if($occupation == 'NotWorking'){
            $partneroccuaptiontype = 'NotWorking';
            $partneroccuaption = '0';
       }else
        if($occupation == 'Working'){
            $partneroccuaptiontype = 'Working';
            $partneroccuaption = implode(',',$occuaption_for); 
        }
       $profilecode = $this->input->post('profilecode');
       $heightfrom=str_replace(' ','',$this->input->post('heightfrom'));//here removing the space of height From
       $heightto=str_replace(' ','',$this->input->post('heightto'));
       $looking = $this-> input->post('looking');
       $data = array(
           'look_for'=>implode(",", $looking),
           'age_from '=>$this->input->post('fromage'),
           'age_to'=>$this->input->post('toage'),
           'feet_from'=>$heightfrom,
           'inch_from'=>$heightto,
           'Complexion_from'=>$this->input->post('complexionfor'),
           'countryresidant_from'=>$this->input->post('countryfrom'),
           'Education_from'=>$partnereducation,
           'Occuaption_From'=>$partneroccuaption,
           'AnnualIncome_from'=>$this->input->post('incomefor'),
           'Education_fromType'=>$partnereducationtype,
           'Occuaption_FromType'=>$partneroccuaptiontype,
		  
       );
	  
        $update = $this->udashboard->familyupdate($profileid,$data);
        echo"true";
	 
 }
 
 
   public function changepassword(){
       $this->load->view('User/changepassword');
   }
   
    //check current password
    public function checkpassword(){
        $prfid = $this->input->post('prfid');
        $password = $this->input->post('pass');
        $result = $this->udashboard->check_password($prfid,$password);
        echo $result;
    }
    
   public function passwordchange(){
       $profileid = $this->input->post('prfid');
       $newpassword = $this->input->post('newpass');
       $data = array(
                    'opwd'=>$newpassword,
                    'password'=>md5($newpassword)
                 );
       $result = $this->udashboard->upadtepass($profileid,$data);
       if($result){
		   $this->session->set_flashdata('pass_sucess', 'password cahnged successfully');
           redirect(base_url('userdashboard'));
       }
   }
   
   /*home menu count function added by laxmi (17-11-2017)   */  
   public function homeMenuCount(){
       $profilecode = $this->input->post('profilecode');
       $result = $this->udashboard->home_menu_count($profilecode);
       echo json_encode($result);
       
   }
   
   /*who viewd my profile function added by laxmi (18-11-2017) */ 
 public function viewdMyProfile(){
      $profileId = $this->session->userdata['user']['username'];
        $userinfo = $this->udashboard->userdata($profileId);
		
        $start = $this->uri->segment(3);
        $search_options = array(
            'limit' =>15,
            'start' => $start,
			'profileId'=>$profileId
			);
        $preferlist = $this->udashboard->viewedMyProfile($search_options);
        $data['profilelist'] =  $preferlist;
        $data['starting'] = $start;
        $this->load->library('pagination');
        $config['base_url'] = base_url('userdashboard/viewdMyProfile');
        $config['total_rows'] = $preferlist->ttl_rows;
        $config['per_page'] = 15;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $preferlist = null;
        $this->load->view('profileslist', $data);	
       
   }
   //get all user based on education preference
  public function getall_preferedu()
	{
		
		$profileId = $this->session->userdata['user']['username'];
        $userinfo = $this->udashboard->userdata($profileId);
		
        $start = $this->uri->segment(3);
        $search_options = array(
            'limit' =>15,
            'start' => $start,
			'age'=>$userinfo->age,'gender'=>$userinfo->gender,'edu_prefer'=>$userinfo->Education_from);
        $preferlist = $this->udashboard->getall_edupreferd($search_options);
        $data['profilelist'] =  $preferlist;
        $data['starting'] = $start;
        $this->load->library('pagination');
        $config['base_url'] = base_url('userdashboard/getall_preferedu');
        $config['total_rows'] = $preferlist->ttl_rows;
        $config['per_page'] = 15;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $preferlist = null;
        $this->load->view('profileslist', $data);	
	}
	
	//get all user based on occupation preference created by laxmi
	 public function getall_preferprof()
	{
		
		$profileId = $this->session->userdata['user']['username'];
        $userinfo = $this->udashboard->userdata($profileId);
		
        $start = $this->uri->segment(3);
        $search_options = array(
            'limit' =>15,
            'start' => $start,
			'age'=>$userinfo->age,'gender'=>$userinfo->gender,'occ_prefer'=>$userinfo->Occuaption_From);
        $preferlist = $this->udashboard->getall_occpreferd($search_options);
        $data['profilelist'] =  $preferlist;
        $data['starting'] = $start;
        $this->load->library('pagination');
        $config['base_url'] = base_url('userdashboard/getall_preferprof');
        $config['total_rows'] = $preferlist->ttl_rows;
        $config['per_page'] = 15;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $preferlist = null;
        $this->load->view('profileslist', $data);	
	}
	
	
	//get all user based on recently joined  created by laxmi
	 public function getall_recently()
	{
		
		$profileId = $this->session->userdata['user']['username'];
        $userinfo = $this->udashboard->userdata($profileId);
		
        $start = $this->uri->segment(3);
        $search_options = array(
            'limit' =>15,
            'start' => $start,
			'age'=>$userinfo->age,'gender'=>$userinfo->gender);
        $preferlist = $this->udashboard->getall_recently($search_options);
        $data['profilelist'] =  $preferlist;
        $data['starting'] = $start;
        $this->load->library('pagination');
        $config['base_url'] = base_url('userdashboard/getall_recently');
        $config['total_rows'] = $preferlist->ttl_rows;
        $config['per_page'] = 15;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $preferlist = null;
        $this->load->view('profileslist', $data);	
	}
	
	
	// short listed me created by laxmi
    public function shortlistedMe(){
      $profileId = $this->session->userdata['user']['username'];
        $userinfo = $this->udashboard->userdata($profileId);
		
        $start = $this->uri->segment(3);
        $search_options = array(
            'limit' =>15,
            'start' => $start,
			'profileId'=>$profileId
			);
        $preferlist = $this->udashboard->shortlisted_me($search_options);
        $data['profilelist'] =  $preferlist;
        $data['starting'] = $start;
        $this->load->library('pagination');
        $config['base_url'] = base_url('userdashboard/shortlistedMe');
        $config['total_rows'] = $preferlist->ttl_rows;
        $config['per_page'] = 15;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $preferlist = null;
        $this->load->view('profileslist', $data);	
       
   }  
   
   // viwed my numbers created by laxmi
    public function viewedMYNumber(){
      $profileId = $this->session->userdata['user']['username'];
        $userinfo = $this->udashboard->userdata($profileId);
		
        $start = $this->uri->segment(3);
        $search_options = array(
            'limit' =>15,
            'start' => $start,
			'profileId'=>$profileId
			);
        $preferlist = $this->udashboard->viewed_mymobileno($search_options);
        $data['profilelist'] =  $preferlist;
        $data['starting'] = $start;
        $config['base_url'] = base_url('userdashboard/viewedMYNumber');
        $config['total_rows'] = $preferlist->ttl_rows;
        $config['per_page'] = 15;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $preferlist = null;
        $this->load->view('profileslist', $data);	
       
   }  
  

   // viewdProfiles created by laxmi
    public function viewdProfiles(){
      $profileId = $this->session->userdata['user']['username'];
        $userinfo = $this->udashboard->userdata($profileId);
		
        $start = $this->uri->segment(3);
        $search_options = array(
            'limit' =>15,
            'start' => $start,
			'profileId'=>$profileId
			);
        $preferlist = $this->udashboard->viewed_profiles($search_options);
        $data['profilelist'] =  $preferlist;
        $data['starting'] = $start;
        $config['base_url'] = base_url('userdashboard/viewdProfiles');
        $config['total_rows'] = $preferlist->ttl_rows;
        $config['per_page'] = 15;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $preferlist = null;
        $this->load->view('profileslist', $data);	
       
   }  
   
   // shortlisted profiles created by laxmi
    public function shortlistedProfiles(){
      $profileId = $this->session->userdata['user']['username'];
        $userinfo = $this->udashboard->userdata($profileId);
		
        $start = $this->uri->segment(3);
        $search_options = array(
            'limit' =>15,
            'start' => $start,
			'profileId'=>$profileId
			);
        $preferlist = $this->udashboard->shorlisted_profiles($search_options);
        $data['profilelist'] =  $preferlist;
        $data['starting'] = $start;
        $config['base_url'] = base_url('userdashboard/shortlistedProfiles');
        $config['total_rows'] = $preferlist->ttl_rows;
        $config['per_page'] = 15;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $preferlist = null;
        $this->load->view('profileslist', $data);	
       
   }  
   // numbersViewed created by laxmi
    public function numbersViewed(){
      $profileId = $this->session->userdata['user']['username'];
        $userinfo = $this->udashboard->userdata($profileId);
		
        $start = $this->uri->segment(3);
        $search_options = array(
            'limit' =>15,
            'start' => $start,
			'profileId'=>$profileId
			);
        $preferlist = $this->udashboard->viewed_mobilenos($search_options);
        $data['profilelist'] =  $preferlist;
        $data['starting'] = $start;
        $config['base_url'] = base_url('userdashboard/numbersViewed');
        $config['total_rows'] = $preferlist->ttl_rows;
        $config['per_page'] = 15;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $preferlist = null;
        $this->load->view('profileslist', $data);	
       
   }  
   
   
   //get all user based on prefferd matches
  public function getall_prefermatches()
	{
		
		$profileId = $this->session->userdata['user']['username'];
        $userinfo = $this->udashboard->userdata($profileId);
		
        $start = $this->uri->segment(3);
        $search_options = array(
            'limit' =>15,
            'start' => $start,
			'age'=>$userinfo->age,
			'gender'=>$userinfo->gender,
			'education'=>$userinfo->Education_from,
		    'lookingfor' =>$userinfo->look_for,
		    'country' => $userinfo->country,
		    'fromage' => $userinfo->age_from,
		    'toage' => $userinfo->age_to,
		    'complexion' => $userinfo->Complexion_from,
		    'occupation' => $userinfo->Occuaption_From,
		    'annualincome' => $userinfo->AnnualIncome_from,
			);
        $preferlist = $this->udashboard->getall_preferdmatches($search_options);
        $data['profilelist'] =  $preferlist;
        $data['starting'] = $start;
        $this->load->library('pagination');
        $config['base_url'] = base_url('userdashboard/getall_prefermatches');
        $config['total_rows'] = $preferlist->ttl_rows;
        $config['per_page'] = 15;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $preferlist = null;
        $this->load->view('profileslist', $data);	
	}
	
	//save shortlisted profiles
	public function saveShortlistProfile(){
		$data = array(
		'MyProfile_Code'      => $this->session->userdata['user']['username'],
		'PartnerProfile_Code' => $this->input->post('shorstlistId'),
		'Saved_On'=> date('Y-m-d H:i:s')
		);
		$result = $this->udashboard->shortlist_profile($data);
		if($result){
			echo"success";
			}
		else{
			echo"fail";
			}
		}
	//viewContactDetails  created by laxmi
	public function viewContactDetails(){
	    $profileId = $this->session->userdata['user']['username'];
		$contactcode = $this->input->post('contactcode');
		$result = $this->udashboard->view_partnercontacts($profileId,$contactcode);
		if($result){
			echo json_encode($result);
			}
		}
		
	//Send interest  created by laxmi
	public function sendIntrest(){
		$data = array(
		'FromProfileId' => $this->session->userdata['user']['username'],
		'ToProfileId' => $this->input->post('partnetId'),
		'Message' => $this->input->post('message'),
		'Date' =>  date('Y-m-d H:i:s'),
		'Sent' => 1,
		);
	    $result = $this->udashboard->send_intrest($data);
		if($result){
			echo"success";
			}
			else{
				echo"Fail";
				}
		
		}
		
	
  
  public function package_info(){
	  
	  $this->load->view('User/packege_info');
  }

  
  public function uploadvideo(){
		 //print_r($FILES);
       $profilecode = $this->session->userdata['user']['username'];
      
                $config['upload_path'] = 'uploads/video/'.$profilecode; 
                $config['allowed_types'] = 'avi|flv|mp4|wmv|mov';
                $unique_id=$profilecode."".rand(00,999);
                $imgfile = $_FILES['file']['tmp_name'];
                $ext=explode(".",$_FILES['file']['name']);
		$fimage= $unique_id.".".$ext[1]; 
                $config['file_name'] = $fimage;  
                $this->load->library('upload', $config);
                if (!is_dir('uploads/video/'.$profilecode)) {
                    mkdir('uploads/video/' . $profilecode, 0777, TRUE);
                    } 
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('file')){
                    $error =  $this->upload->display_errors();   
		    $this->myalbum();
                } 
                else { 
                   $videoinfo =array(
               'profile_code' =>$profilecode,
               'video_src' => $config['upload_path'],
               ); 
              $this->db->insert('user_video_profile',$videoinfo); 
			  $this->myalbum();

              }
   }
   
   //delete account page
   public function deleleteAccount(){
	   $reason = $this->udashboard->get_delete_reason();
	   $data = array('reason'=>$reason);
	   $this->load->view('User/deleteaccount',$data);
	   }
	   
	//cancel account
	
	public function deleteUserAccount(){
		$profilecode = $this->input->post('prfid');
		$userdetails = $this->udashboard->get_data_by_id($profilecode);
		$reasons = $this->input->post('reason');
		$otherreason = $this->input->post('other_reason');
		if($reasons == ' Other reasons'){
			$Cancel_Reason = $otherreason;
			}
		else{
				$Cancel_Reason = $reasons;
			}
		
		if($userdetails){
			$mobile = $userdetails->mobile;
			$email =  $userdetails->email;
		}
		
		$data = array(
			'Cancel_Email'=>$email,
			'Cancel_Reason'=>$Cancel_Reason,
			'Cancel_ProfileCode'=>$profilecode,
			'Cancel_Mobile'=>$mobile,
			'CancelReasinFrom'=>$this->input->post('reason'),
			'CancelDate'=>date('Y-m-d H:i:sa'),
		);
		$data1 = array(
		'profile_status'=>2,
		);
		
		$result = $this->udashboard->delete_account($data,$data1,$profilecode);
		if($result){
			 $this->session->set_flashdata('del_sucess', 'deleted successfully');
			 redirect('matrimony');
			}
			
			}
			
//ashok inbox 07/01/18

public function newmessages(){

$profilecode = $this->session->userdata['user']['username'];
$count =  $this->db->select('*')->from('message_tbl as m')->join('tbl_personel as p','m.FromProfileId = p.profile_code')->where(array('ToProfileId'=>$profilecode,'MessageReadStatus'=>0,'reply_status'=>0,'Trash'=>0))->get()->num_rows();
echo $count;


}
public function getmsgscount(){

$profilecode = $this->session->userdata['user']['username'];
$result['newmsgscount']=$this->db->select('*')->from('message_tbl as m')->join('tbl_personel as p','m.FromProfileId = p.profile_code')->where(array('m.ToProfileId'=>$profilecode,'m.reply_status'=>0,'m.Trash'=>0))->get()->num_rows();
$result['pendingcount']=$this->db->select('*')->from('message_tbl as m')->join('tbl_personel as p','m.FromProfileId = p.profile_code')->where(array('m.ToProfileId'=>$profilecode,'m.MessageReadStatus'=>0,'m.reply_status'=>0,'m.Trash'=>0))->get()->num_rows();
$result['declinedcount']=$this->db->select('*')->from('message_tbl as m')->join('tbl_personel as p','m.FromProfileId = p.profile_code')->where(array('m.ToProfileId'=>$profilecode,'m.reply_status'=>2,'m.Trash'=>0))->get()->num_rows();
$result['acceptcount']=$this->db->select('*')->from('message_tbl as m')->join('tbl_personel as p','m.FromProfileId = p.profile_code')->where(array('m.ToProfileId'=>$profilecode,'m.reply_status'=>1,'m.Trash'=>0))->get()->num_rows();
$result['sentcount']=$this->db->select('*')->from('message_tbl as m')->join('tbl_personel as p','m.ToProfileId = p.profile_code')->where(array('m.FromProfileId'=>$profilecode,'m.sent'=>1))->get()->num_rows();
$result['trashcount']=$this->db->select('*')->from('message_tbl as m')->join('tbl_personel as p','m.FromProfileId = p.profile_code')->where(array('m.ToProfileId'=>$profilecode,'m.Trash'=>1))->get()->num_rows();
echo json_encode($result);
} 

public function inbox(){

$profilecode = $this->session->userdata['user']['username'];

 $data['messages']=$this->db->select('mt.*,tp.fname,tp.lname,tp.profile_code,tf.image')->from('tbl_personel as tp')->join('message_tbl as mt','tp.profile_code=mt.FromProfileId','left')
 ->join('tbl_family as tf','tf.profile_code=mt.FromProfileId','left')
->where(array('mt.ToProfileId'=>$profilecode,'reply_status'=>0,'mt.Trash'=>0))
->order_by('mt.MessageReadStatus','asc')->order_by('mt.Date','desc')
->get();
// echo $this->db->last_query();exit;
 
$this->load->view('messages/inbox',$data);
}
//for msg status update
public function updatemsgstatus(){
//$data['ToProfileId'] = $this->session->userdata['user']['username'];
$data['MessageId']=$this->input->post('msgid');
$info['MessageReadStatus'] = 1;

echo $status=$this->db->update('message_tbl', $info, $data);
} 
//for accept and decline
public function update_interest(){

//$data['ToProfileId'] = $this->session->userdata['user']['username'];
$data['MessageId']=$this->input->post('msgid');
$info['reply_status']=$this->input->post('interest');
echo $status=$this->db->update('message_tbl', $info, $data);

}	
 public function inbox_accepted(){
		
		 $profilecode = $this->session->userdata['user']['username'];
		 
		   $data['messages']=$this->db->select('mt.*,tp.fname,tp.lname,tp.profile_code,tf.image')->from('tbl_personel as tp')->join('message_tbl as mt','tp.profile_code=mt.FromProfileId','left')
		  ->join('tbl_family as tf','tf.profile_code=mt.FromProfileId','left')
		 ->where('mt.ToProfileId',$profilecode)->where('mt.reply_status',1)->where('mt.Trash',0)
		->order_by('mt.Date','desc')
		->get();
		 
		 $this->load->view('messages/inbox-accepted',$data);
		
		
	}
	public function inbox_declined(){
		
		$profilecode = $this->session->userdata['user']['username'];
		 
		   $data['messages']=$this->db->select('mt.*,tp.fname,tp.lname,tp.profile_code,tf.image')->from('tbl_personel as tp')->join('message_tbl as mt','tp.profile_code=mt.FromProfileId','left')
		  ->join('tbl_family as tf','tf.profile_code=mt.FromProfileId','left')
		 ->where('mt.ToProfileId',$profilecode)->where('mt.reply_status',2)->where('mt.Trash',0)
		->order_by('mt.Date','desc')
		->get();
		//echo $this->db->last_query();
		//exit;
		$this->load->view('messages/inbox-declined',$data);
		
	}
	// pending messages data 
public function inbox_pending(){
		$profilecode = $this->session->userdata['user']['username'];
		$data['messages']=$this->db->select('mt.*,tp.fname,tp.lname,tp.profile_code,tf.image')->from('tbl_personel as tp')->join('message_tbl as mt','tp.profile_code=mt.FromProfileId','left')
		  ->join('tbl_family as tf','tf.profile_code=mt.FromProfileId','left')
		 ->where('mt.ToProfileId',$profilecode)->where('mt.MessageReadStatus',0)->where('mt.reply_status',0)->where('mt.Trash',0)
		->order_by('mt.Date','desc')
		->get();
		$this->load->view('messages/inbox-pending',$data);
	} 			
	
// Sent messages data 
public function sent_message(){
		$profilecode = $this->session->userdata['user']['username'];
		$data['messages']=$this->db->select('mt.*,tp.fname,tp.lname,tp.profile_code,tf.image')->from('tbl_personel as tp')->join('message_tbl as mt','tp.profile_code=mt.ToProfileId','left')
		  ->join('tbl_family as tf','tf.profile_code=mt.ToProfileId','left')
		 ->where('mt.FromProfileId',$profilecode)->where('mt.Sent',1)->order_by('mt.Date','desc')
		->get();
		$this->load->view('messages/sentmessage',$data);
	} 	
	
//delete messages
public function deleteMessage(){

		$messageid = $this->input->post('msgids');
		$data['Trash'] = 1;
		$result = $this->udashboard->delete_message($messageid,$data);
		if($result){echo "success";}
		else{echo"fail";}
		}				
// trash messages data 
public function trash(){
		$profilecode = $this->session->userdata['user']['username'];
		$data['messages']=$this->db->select('mt.*,tp.fname,tp.lname,tp.profile_code,tf.image')->from('tbl_personel as tp')->join('message_tbl as mt','tp.profile_code=mt.FromProfileId','left')
		  ->join('tbl_family as tf','tf.profile_code=mt.FromProfileId','left')
		 ->where('mt.ToProfileId',$profilecode)->where('mt.Trash',1)
		->order_by('mt.Date','desc')
		->get();
		$this->load->view('messages/trash',$data);
	}
        //user Images created by ashok
	
	//user photo management

        	//user Images created by ashok
	public function myalbum(){
		
		$profileId = $this->session->userdata['user']['username'];
        $data['userinfo'] = $this->udashboard->userdata($profileId);
		$data['defaultimage'] = $this->udashboard->get_default_images($profileId);
		$this->load->view('photoalbum', $data);
	}
	//user photo management
	public function managephotos($image_type){
		
		if($image_type=="personal"){
			$image_type=1;
			
		}
		elseif($image_type=="selfy"){
			$image_type=2;
		}
		elseif($image_type=="family"){
			$image_type=3;
		}
		else{
			
			$this->myalbum();
		}
		$profileId = $this->session->userdata['user']['username'];
		$data['image_info']=$this->udashboard->get_images($image_type,$profileId);
		$data['image_type']=$image_type;
		$data['protect']=$this->udashboard->get_protect_status($profileId)->Photoprotect;
		$this->load->view('photo_manage', $data);	
	}
	
	
	
   public function uploadimage(){
	  
       $profilecode = $this->session->userdata['user']['username'];
      
                $config['upload_path'] = 'uploads/profilepics/'.$profilecode; 
                $config['allowed_types'] = 'jpg|jpeg|png';
                $unique_id=$profilecode."".rand(00,999);
                $imgfile = $_FILES['file']['tmp_name'];
                $ext=explode(".",$_FILES['file']['name']);
               $fimage= $unique_id.".".$ext[1]; 
                $config['file_name'] = $fimage;  
                $this->load->library('upload', $config);
                if (!is_dir('uploads/profilepics/'.$profilecode)) {
                    mkdir('uploads/profilepics/' . $profilecode, 0777, TRUE);
                    } 
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('file')){
                   echo $error =  $this->upload->display_errors();
                    
                  
				   
                } 
                else { 
				
                    // $fInfo = $this->upload->data(); //uploading
					 $image_info =array(
               'profile_id' =>$profilecode,
               'img_src' =>  $config['file_name'],
			   'image_type'=>$this->input->post('image_type'),
			   'is_approved'=>0,
			   'posted_date'=>strtotime('now')
               ); 
              $status=$this->db->insert('user_images',$image_info);
					
					
					echo $status;
					
              }
		
       
   }
   public function remove_image(){
	   
	   $img_id=$this->input->post('img_id');
	//remove image from location not working we will test later  
	   $img=$this->db->select('img_src,profile_id')->from('user_images')->where('image_id',$img_id)->get()->result_array();
	   print_r($img);
	   exit;
	    //$imgpath=base_url().'/uploads/profilepics/'.$img['profile_id'].'/'.$img['img_src'];
	   unlink('uploads/profilepics/'.$img['profile_id'].'/'.$img['img_src']);
	  $this->db->where('image_id',$img_id);
	  $status= $this->db->delete('user_images');	
	
	   
	   return $status;
   }
   public function change_protect()
   {
	   $photo_status=$this->input->post('photo_status');
	   $newstatus= $photo_status==0?1:0;
	   $profileId = $this->session->userdata['user']['username'];
	   $this->db->where('profile_code',$profileId);
	   return $info=$this->db->update('tbl_personel',array('Photoprotect'=>$newstatus));
	   
   }
   
   public function crop_box($image_id){
	    $profilecode = $this->session->userdata['user']['username'];	 
		   $this->db->select('image_id,img_src,profile_id');
		   $this->db->from('user_images');
		   $this->db->where('image_id',$image_id);
		    $this->db->where('profile_id',$profilecode);
	   $data['image_info']=$this->db->get()->row_array();
	    $this->load->view('cropbox',$data);
	   
   }
   public function create_thumbnail(){
	   
	   $image=$this->input->post('imgsrc');
	   $cpc = $this->session->userdata['user']['username'];
	   $new_name="thumb".$cpc.rand(0000,9999).".jpg";//here giving name to the image
        $path="./uploads/profilepics/".$cpc.'/';//giving path
        $nw = $nh = 214; # image with # height
       $src = base_url().'uploads/profilepics/'.$cpc.'/'.$image;
        $size = getimagesize($src);
        $x = (int) $_POST['x'];
        $y = (int) $_POST['y'];
        $w = (int) $_POST['w'] ? $_POST['w'] : $size[0];
        $h = (int) $_POST['h'] ? $_POST['h'] : $size[1];
       $data = file_get_contents($src);
        $vImg = imagecreatefromstring($data);
        $dstImg = imagecreatetruecolor($nw, $nh);
        imagecopyresampled($dstImg, $vImg, 0, 0, $x, $y, $nw, $nh, $w, $h);
        imagejpeg($dstImg,$path.$new_name);
		
		$this->db->where('profile_id',$cpc);
		 $this->db->update('user_images',array('is_default_img'=>0));
		
			
	     $this->db->where('img_src',$image);
		 $this->db->where('profile_id',$cpc);
		 $this->db->update('user_images',array('is_default_img'=>1));
		 
		 $image = $this->db->select('thumbimage')->from('tbl_personel')->where('profile_code',$cpc)->get()->row();
		 unlink('uploads/profilepics/'.$cpc.'/'.$image->thumbimage);
		 
		 $this->db->where('profile_code',$cpc);
		 $this->db->update('tbl_personel',array('thumbimage'=>$new_name));
		 
       // echo $insert=$this->db->query("UPDATE tbl_personel SET thumbimage='$new_name' WHERE profile_code='$cpc'");
       
	 
   }
   
   
   public function send_photo_request(){
	   
	   $request['notify_from']= $this->session->userdata['user']['username'];
	   $requeststatus =$this->udashboard->get_photorequest($request['notify_from']);
	   if($requeststatus>0){
		   
		   echo "waiting for approve";
	   }else{
	   
	   
	   
	   $request['notify_to']=$this->input->post('to_id');
	   $request['notify_date']=strtotime('now');
	  echo $result=$this->udashboard->send_photorequest($request);
	   }
   
   }
   
    //Notification ashok
	 public function getnotifycount(){
		 
	 $profilecode = $this->session->userdata['user']['username'];
     echo $notify = $this->udashboard->get_notify($profilecode)->num_rows();
	 }
	 //notify list
		public function getnotifylist(){
			
			$profilecode = $this->session->userdata['user']['username'];
		
		echo $notify= $this->udashboard->get_notifylist($profilecode);
			
		
			
			
		}
		
		public function accept_request(){
			$profilecode = $this->session->userdata['user']['username'];
			$id=$this->input->post('id');
			 
			$this->db->where('notify_from',$profileid);
			$this->db->where('notify_to',$profileid);
			echo $status=$this->db->update('notifications',array('is_accepted'=>1));
			
		}
	 
	 
	 
	public function printpartnerdetails(){
		$search['profilecode'] = $this->uri->segment(3);
		$data['profile_data']=  $this->search->profiledetails($search);
		$this->load->view('user/print_partnerdetails',$data);
		
		
	}
	

        
 }

?>