<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  /**
  Module: Admin controller
  Author: Laxmi
  Created Date: 20/December/2017
 * */
  class Admin extends CI_Controller {
      function __construct() {
        parent::__construct();
            $this->load->helper('captcha');
            $this->load->model('Admin_model','admin');
            $this->load->model('Mothertongues_model','mothertongues');
            $this->load->model('Matrimony_model','matrimony');
            $this->load->library('email');
	}

	public function index(){
	    $this->captcha_setting();

	}

	//logout function
	public function logout(){
            $this->session->sess_destroy();
            redirect('admin');
        }

	public function login(){
	    if(empty($_POST)){
		$this->captcha_setting();
	    }
	    else{
                if($this->input->post('login')){
		if (strcasecmp($_SESSION['captchaWord'], $_POST['captcha']) !== 0) {
                echo "<script type='text/javascript'> alert('Captcha is incorrect'); </script>";
                $this->captcha_setting();
           }
	    else{
            $username = $this->input->post('email');
            $password = md5($this->input->post('password'));
            if($this->admin->admin_login($username,$password))
            {
               redirect('admin/adminDashboard');
            }
            else{
              $message = "Please enter valid username/password";
              $this->session->set_flashdata('loginfail',$message);
              redirect('admin');
            }
	}
        }
	}
    }

	// This function generates CAPTCHA image and store in "image folder".
        public function captcha_setting(){
            $values = array(
            'word' => '',
            'word_length' => 4,
            'img_path' => './images/',
            'img_url' => base_url() .'images/',
            'font_path' => base_url() . 'system/fonts/texb.ttf',
            'img_width' => '150',
            'img_height' => 50,
            'expiration' => 3600,

            );
        $data = create_captcha($values);
        $_SESSION['captchaWord'] = $data['word'];
        $this->load->view('Admin/login',$data);
   }


 // For new image on click refresh button.
    public function captcha_refresh(){
                $values = array(
                'word' => '',
                'word_length' => 4,
                'img_path' => './images/',
                'img_url' =>  base_url() .'images/',
                'font_path'  => base_url() . 'system/fonts/texb.ttf',
                'img_width' => '150',
                'img_height' => 50,
                'expiration' => 3600,
                 'font_size' => 30
               );
            $data = create_captcha($values);
            $_SESSION['captchaWord'] = $data['word'];
           echo $data['image'];

       }

//admin dashboard
public function adminDashboard(){
        $data['recentusers'] = $this->admin->get_recent_users();
        $data['todayusers'] = $this->admin->get_today_users();
        $data['maleusers'] = $this->admin->male_users_count();
        $data['femaleusers'] = $this->admin->female_users_count();
        $data['membership'] = $this->admin->membership_count();
        $this->load->view('Admin/dashboard',$data);
	}

//Add user profile thurough admin
public function addUserProfile(){
	$education = $this->matrimony->getEducation();
        $occupation = $this->matrimony->getOccupation();
        $employee = $this->matrimony->getEmployeement();
        $complexion = $this->matrimony->getComplexion();
        $bloodgroup = $this->matrimony->getBloodgroup();
        $specilcase = $this->matrimony->getSpecialcase();
        $rasi       = $this->matrimony->getRasi();
        $star       =$this->matrimony->getStar();
        $country =   $this->matrimony->getcountries();
	$height=  $this->matrimony->getHeightList();
	$packages = $this->matrimony->getpackage();
	$mothertongues = $this->mothertongues->getmothertongues();
        $data= array('education'=>$education,'occupation'=>$occupation,'employee'=>$employee,'complexion'=>$complexion,'bloodgroup'=>$bloodgroup,'specilcase'=>$specilcase,'rasi'=>$rasi,'star'=>$star,'country'=>$country,'height'=>$height,'packages'=>$packages,'mothertongues'=>$mothertongues);
	$this->load->view('Admin/addUser',$data);
	}

//add user detais in database
public function addUser(){
    $mobile =$this->input->post('mobile');
    $dob = $this->input->post('dob');
    $age = (date('Y') - date('Y',strtotime($dob)));
    $gender  = $this->input->post('gender');
    $height = $this->input->post('feet');
    $inch = substr($height, -6,3);
    $password = "PDML" . rand(0000, 999999);
    $cpassword = md5($password);
    $addedby = 'ADMIN';
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
		   $last_id = $this->matrimony->profileserialnum();
		   $user_id = $last_id->Id + 1;
	       $length = strlen($user_id);
           if($gender == 'Male'){
               if ($length == 1) {
                    $profile_code = "PDM0000" . $user_id;
                } else if ($length == 2) {
                    $profile_code = "PDM000" . $user_id;
                } elseif ($length == 3) {
                    $profile_code = "PDM00" . $user_id;
                } elseif ($length == 4) {
                    $profile_code = "PDM0" . $user_id;
                } elseif ($length == 5) {
                    $profile_code = "PDM" . $user_id;
                }

           }
           if($gender == 'Female'){
               if ($length == 1) {
                    $profile_code = "PDF0000" . $user_id;
                } else if ($length == 2) {
                    $profile_code = "PDF000" . $user_id;
                } elseif ($length == 3) {
                    $profile_code = "PDF00" . $user_id;
                } elseif ($length == 4) {
                    $profile_code = "PDF0" . $user_id;
                } elseif ($length == 5) {
                    $profile_code = "PDF" . $user_id;
                }
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

	if($_FILES['image1']['name']!='') {
	   $config['upload_path'] = 'uploads/profilepics/'.$profile_code;
          $config['allowed_types'] = 'jpg|jpeg|png';
          $unique_id=$profile_code."".rand(00,999);
          $imgfile = $_FILES['image1']['tmp_name'];
          $ext=explode(".",$_FILES['image1']['name']);
          $fimage= $unique_id.".".$ext[1];
          $config['file_name'] = $fimage;
          $this->load->library('upload', $config);
          if(!is_dir('uploads/profilepics/'.$profile_code)) {
                mkdir('uploads/profilepics/' . $profile_code, 0777, TRUE);
            }
            $this->upload->initialize($config);
	    if(!$this->upload->do_upload('image1')){
               $error =  "image1". $this->upload->display_errors();
               $this->session->set_flashdata('photos_error', $error);
               redirect(base_url('admin/addUserProfile'));
             }
	    else {
              $fInfo = $this->upload->data(); //uploading
              $orgimage = $fimage;
            }
        }

	if($_FILES['image2']['name']!='') {
	  $config['upload_path'] = 'uploads/profilepics/'.$profile_code;
          $config['allowed_types'] = 'jpg|jpeg|png';
          $unique_id=$profile_code."".rand(00,999);
          $imgfile = $_FILES['image2']['tmp_name'];
          $ext=explode(".",$_FILES['image2']['name']);
          $fimage= $unique_id.".".$ext[1];
          $config['file_name'] = $fimage;
          $this->load->library('upload', $config);
          if(!is_dir('uploads/profilepics/'.$profile_code)) {
            mkdir('uploads/profilepics/' . $profile_code, 0777, TRUE);
          }
          $this->upload->initialize($config);
            if(!$this->upload->do_upload('image2')){
               $error = "image2". $this->upload->display_errors();
               $this->session->set_flashdata('photos_error', $error);
               redirect(base_url('admin/addUserProfile'));
             }
	    else {
              $fInfo = $this->upload->data(); //uploading
               $image2 =$fimage;
            }
        }
	if($_FILES['image3']['name']!='') {
	    $config['upload_path'] = 'uploads/profilepics/'.$profile_code;
            $config['allowed_types'] = 'jpg|jpeg|png';
            $unique_id=$profile_code."".rand(00,999);
            $imgfile = $_FILES['image3']['tmp_name'];
            $ext=explode(".",$_FILES['image3']['name']);
            $fimage= $unique_id.".".$ext[1];
            $config['file_name'] = $fimage;
            $this->load->library('upload', $config);
            if(!is_dir('uploads/profilepics/'.$profile_code)) {
                mkdir('uploads/profilepics/' . $profile_code, 0777, TRUE);
            }
            $this->upload->initialize($config);
	    if(!$this->upload->do_upload('image3')){
               $error = "image3". $this->upload->display_errors();
               $this->session->set_flashdata('photos_error', $error);
               redirect(base_url('admin/addUserProfile'));
             }
	    else {
              $fInfo = $this->upload->data(); //uploading
               $image3 =$fimage;
            }
        }
	if($_FILES['image4']['name']!='') {
	   $config['upload_path'] = 'uploads/profilepics/'.$profile_code;
           $config['allowed_types'] = 'jpg|jpeg|png';
           $unique_id=$profile_code."".rand(00,999);
           $imgfile = $_FILES['image4']['tmp_name'];
           $ext=explode(".",$_FILES['image4']['name']);
           $fimage= $unique_id.".".$ext[1];
           $config['file_name'] = $fimage;
           $this->load->library('upload', $config);
            if(!is_dir('uploads/profilepics/'.$profile_code)) {
                mkdir('uploads/profilepics/' . $profile_code, 0777, TRUE);
            }
            $this->upload->initialize($config);
	    if(!$this->upload->do_upload('image4')){
               $error ="image4". $this->upload->display_errors();
               $this->session->set_flashdata('photos_error', $error);
               redirect(base_url('admin/addUserProfile'));
             }
	    else {
              $fInfo = $this->upload->data(); //uploading
              $image4 ='uploads/'.$profile_code.'/'.$fimage;
              }
	}
	if($_FILES['image5']['name']!='') {
            $config['upload_path'] = 'uploads/profilepics/'.$profile_code;
            $config['allowed_types'] = 'jpg|jpeg|png';
            $unique_id=$profile_code."".rand(00,999);
            $imgfile = $_FILES['image5']['tmp_name'];
            $ext=explode(".",$_FILES['image5']['name']);
            $fimage= $unique_id.".".$ext[1];
            $config['file_name'] = $fimage;
            $this->load->library('upload', $config);
            if(!is_dir('uploads/profilepics/'.$profile_code)) {
                    mkdir('uploads/profilepics/' . $profile_code, 0777, TRUE);
            }
            $this->upload->initialize($config);
	    if(!$this->upload->do_upload('image5')){
               $error ="image5".  $this->upload->display_errors();
               $this->session->set_flashdata('photos_error', $error);
               redirect(base_url('admin/addUserProfile'));
             }
	    else {
              $fInfo = $this->upload->data(); //uploading
               $image5 =$fimage;
              }
    }
$email = $this->input->post('email');
	$personaldata = array(
	    'profile_code'    =>$profile_code,
	    'receiptnumber'   =>$this->input->post('receiptnumber'),
	    'profile_by'      =>$this->input->post('profile_by'),
	    'ref_by'	      =>$this->input->post('ref_by'),
	    'sname' 	      =>$this->input->post('surname'),
	    'fname'           =>$this->input->post('firstname'),
	    'lname'           =>$this->input->post('lastname'),
	    'dob'             =>date('Y-m-d',strtotime($dob)),
	    'age'             =>$age,
	    'gender'          =>$gender,
	    'marital_status'  =>$this->input->post('maritalstatus'),
            'nochild '        =>$nochilds,
            'livig_status'    =>$living_status,
            'living_in'       =>$this->input->post('nationality'),
	    'mobile'          =>$phncode.$this->input->post('mobile'),
            'email'           =>$email,
	    'password'        =>$cpassword,
            'opwd'            =>$password,
            'addedby'         =>$addedby,
            'Addedon'         =>date('Y-m-d H:i:s'),
	    'Profile_photo_Status'=>1,
	);

	$familydata = array(
	'profile_code'    =>$profile_code,
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
	'image'=>$orgimage,
	'image1'=>$image2,
	'image2'=>$image3,
	'image3'=>$image4,
	'image4'=>$image5,
	);
	$payment = $this->input->post('payment');
	$package = $this->input->post('package');
        if($package!=""){
	$packagedetails = $this->admin->get_userpackage($package);
	$day_valid = $packagedetails->valid; //getting the expire date
        }
	 if ($payment == "Free") {
		 $package ='-';
		 $Sub_date = date("Y-m-d", strtotime("+ 15 days"));
		 $noofviews= 0;
		 $payment_status = 0;
		 $transactiontype=0;

		 }
	else{
		$package = $this->input->post('package');
		$Sub_date = date("Y-m-d", strtotime("+ $day_valid days"));
		$noofviews=$packagedetails->views;
		$payment_status = 3;
		$transactiontype=3;

		}

	$money = array(
	 'profile_code'    =>$profile_code,
	 'package'=>$package,
	 'suscribed_on'=>date('Y-m-d H:i:sa'),
	 'subscribe_validity'=>$Sub_date,
	 'subscribe_status'=>1,
	 'noofviews'=>$noofviews,
	 'payment_status'=>$payment_status,
	);

	$invoice = array(
	 'profileid'    =>$profile_code,
	 'package'=>$package,
	 'packageview'=>$noofviews,
	 'transactiontype'=>$transactiontype,
	 'date'=>date('Y-m-d H:i:sa'),
	);

	$profilesnotable = array(
	 'prosno'    =>$profile_code,
	 'date'=>date('Y-m-d H:i:sa'),
	);
    
	$result = $this->admin->saveUserProfile($personaldata,$familydata,$money,$invoice,$profilesnotable);
	if($result){
	    $msg=urlencode("Welcome to Padmashali.Your registration completed successfully.Your login details are : User Id: ".$profile_code." Password: ".$password." Thank You For Registering");
            $sms = array('mobile' =>$mobile,'otp' => $msg);
	    $this->sms($sms);
            
            $data['profilecode'] = $profile_code;
            $data['password']   = $password;
           $this->load->library('email',array('mailtype' => 'html'));
           $this->email->from('info@padmashaliindia.com');
           $this->email->to($email);
           $this->email->subject('Thank you for Registering with padmashaliindia.com');
           $message = $this->load->view('email/register', $data, true);
           $this->email->message($message);
           $sent = $this->email->send();

	    $this->session->set_flashdata('useradd_sucess', 'User aded successfully');
	    redirect('ViewProfiles');
	}
	else{
	    $this->session->set_flashdata('useradd_error', 'User  not added');
	    redirect('ViewProfiles');
	}

	}

	//renewl packge page
	public function packageRenewal(){
    $packages = $this->matrimony->getpackage();
	$data = array('packages'=>$packages);
	$this->load->view('admin/package_renewal',$data);
	}

 //get user details
public function getUserDetails(){
	$profilecode = $this->input->post('profilecode');
	$userdetails = $this->admin->get_userdetails($profilecode);
    echo json_encode($userdetails);
	}

//update package function
public function updatePackage(){
	$profilecode = $this->input->post('prfscode');
	$package = $this->input->post('package');
	$packagedata = $this->admin->get_userpackage($package);
	$oldvaliditydate = $this->input->post('oldvaliditydate');
	$oldviews = $this->input->post('noofviews');

	if($packagedata){
		$presentvaliddate=$packagedata->valid;
		$presentnoofviews = $packagedata->views;
		}
	$validityupto= date('Y-m-d',strtotime($oldvaliditydate) + (24*3600*$presentvaliddate));
	$totalviews=$oldviews+$presentnoofviews;

	$data = array(
	'package'=>$package,
	'payment_status'=>3,
	'suscribed_on'=>date('Y-m-d H:i:sa'),
	'subscribe_validity'=>$validityupto,
	'noofviews'=>$totalviews,
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
	if($result){
		$this->session->set_flashdata('renewl_sucess', 'Package renewl successfully');
		redirect('admin/packageRenewal');
		}
	else{
		$this->session->set_flashdata('renewl_error', 'Package renewl not done');
		redirect('admin/packageRenewal');
			}

		}
	// married accounts page
	public function marriedAccounts(){
		$this->load->view('admin/married_accounts');

		}

	//get all married Accounts
	  public function allMarriedAcounts(){
	   $totalrecords = $this->admin->getAllMarried($_POST,1);
       $allmarriedaccounts = $this->admin->getAllMarried($_POST);
       $json_data = array(
        "draw"  => intval( $_POST['draw'] ),
        "iTotalRecords"  => intval( $totalrecords ),
        "iTotalDisplayRecords"  => intval( $totalrecords ),
        "recordsFiltered"  => intval( count($allmarriedaccounts) ),
        "data"  => $allmarriedaccounts,
        );
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json");
    echo json_encode($json_data);

	   }

	   // Cancelled accounts page
	public function cancelledAccounts(){
		$this->load->view('Admin/cancel_account');

		}


  //get all cancel Account
  public function allCancelAccounts(){
	  $totalrecords = $this->admin->getAllCanceled($_POST,1);
       $allcanceledaccounts = $this->admin->getAllCanceled($_POST);
       $json_data = array(
        "draw"  => intval( $_POST['draw'] ),
        "iTotalRecords"  => intval( $totalrecords ),
        "iTotalDisplayRecords"  => intval( $totalrecords ),
        "recordsFiltered"  => intval( count($allcanceledaccounts) ),
        "data"  => $allcanceledaccounts,
        );
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json");
    echo json_encode($json_data);

	  }

	//sending sms function
    public function sms($data){
        $to = $data['mobile'];
        $from = "PSHALI";
        $username = urlencode("pshali");
        $password = urlencode("Ku51RjiV");
        $msg = urlencode($data['otp']);
        $params = "username=$username&password=$password&from=$from&to=$to&msg=$msg&type=1&dnd_check=0";
        $fp = fopen("http://pointsms.in/API/sms.php?$params","r");
        $response = stream_get_contents($fp);
        fpassthru($fp);
        fclose($fp);

    }

	//emai page
	public function emails(){
		$this->load->view('admin/email/view');
		}

   //get all cancel Account
  public function allEmails(){
	  $totalrecords = $this->admin->getAllEmails($_POST,1);
       $allemails = $this->admin->getAllEmails($_POST);
       $json_data = array(
        "draw"  => intval( $_POST['draw'] ),
        "iTotalRecords"  => intval( $totalrecords ),
        "iTotalDisplayRecords"  => intval( $totalrecords ),
        "recordsFiltered"  => intval( count($allemails) ),
        "data"  => $allemails,
        );
    header('Access-Control-Allow-Origin: *');
    header("Content-Type: application/json");
    echo json_encode($json_data);

	  }


	 //emai add page
	public function Addemails(){
		$this->load->view('admin/email/add');
		}



//	email  check
public function emailCheck(){
	 $email = $this->input->post('email');
        $result = $this->admin->check_email($email);
        echo $result;
	}
	public function saveEmail(){
		$data = array(
		'Email'=>$this->input->post('email'),
		);

		$result = $this->admin->saveEmail($data);
		if($result){
			$this->session->set_flashdata('email_sucess', 'email successfully');
			redirect('admin/emails');
		}
		else{
			$this->session->set_flashdata('email_error', 'email  not done');
			redirect('admin/emails');
			}
	}
	//delete email

	public function deleteEmail(){
		$emails = $this->input->post('mails');
		$result = $this->admin->delete_email($emails);
		if($result){echo "success";}
		else{echo"fail";}
		}

// delete profiles
	public function deleteProfiles(){
		$this->load->view('Admin/delete_profile');
		}

//restore user profile
public function restoreProfile(){
	$profilecode = $this->input->post('profilecode');
	$id          = $this->input->post('id');

	$this->admin->restore_profile($id,$profilecode);
	echo json_encode(array("status" => TRUE));

	}
  // delete user profile
public function deleteProfile(){
	$profilecode = $this->input->post('profilecode');
	$id          = $this->input->post('id');
	$this->admin->delete_profile($profilecode);
	echo json_encode(array("status" => TRUE));
}

public function createFolder(){
    $result = $this->db->select('profile_code')->from('tbl_personel')->get()->result();
    foreach($result as $value){
      if (!is_dir('uploads/profilepics/'.$value->profile_code)) {
                    mkdir('uploads/profilepics/' . $value->profile_code, 0777, TRUE);
      } 
    }
    
}

public function imageMove1(){
   $result = $this->db->select('profile_code,image,image1,image2')->from('tbl_family')->get()->result();
  
     foreach($result as $value){
        if($value->image!=""){
          
            $old="uploads/profilepics/".$value->image;
            if(file_exists($old)){
               $new = "uploads/profilepics/".$value->profile_code."/".$value->image;  
               rename($old,$new);
             
            }
			 else{
                echo"fail";
            }
          }
		  
          
          if($value->image1!=""){
             $old="uploads/profilepics/".$value->image1;
             if(file_exists($old)){
               $new = "uploads/profilepics/".$value->profile_code."/".$value->image1;  
                rename($old,$new);
            }
            else{
                echo"fail1";
            }
  
          }
          
          if($value->image2!=""){
             $old="uploads/profilepics/".$value->image2;
            if(file_exists($old)){
               $new = "uploads/profilepics/".$value->profile_code."/".$value->image2;  
              rename($old,$new);
            }
			else{
                echo"fail2";
            }
  
  
          }
        
      }
  
    
    }

    public function imageMove(){
   $result = $this->db->select('profileid,photo,photo1,photo2')->from('profilehistory_tbl')->get()->result();
  
     foreach($result as $value){
        if($value->photo!=""){
         
            $old="uploads/profilepics/".$value->photo;
			$new = "uploads/profilepics/".$value->profileid."/".$value->photo; 
            if(file_exists($old) && !file_exists($new)){
               
             rename($old,$new);
             
            }
          }
          
          if($value->photo1!=""){
             $old="uploads/profilepics/".$value->photo1;
			 $new = "uploads/profilepics/".$value->profileid."/".$value->photo1; 
             if(file_exists($old) && !file_exists($new)){
              rename($old,$new);
            }
            else{
                echo"fail1"."<br>";
            }
  
          }
          
          if($value->photo2!=""){
             $old="uploads/profilepics/".$value->photo2;
			 $new = "uploads/profilepics/".$value->profileid."/".$value->photo2;  
            if(file_exists($old) && !file_exists($new)){
               
            rename($old,$new);
            }
  
          }
        
      }
 
    
    }
	
	public function Movethumb(){
   $result = $this->db->select('profile_code,thumbimage')->from('tbl_personel')->get()->result();
  
     foreach($result as $value){
        if($value->thumbimage!=""){
         
            $old="uploads/profilepics/thumb/".$value->thumbimage;
			
            if(file_exists($old)){
             $new = "uploads/profilepics/".$value->profile_code."/".$value->thumbimage;   
             rename($old,$new);
             
            }
          }
          
      
         
        
      }
 
    
    }
	
	
	
public function imagesquery(){
	  $result = $this->db->select('profile_code,image,image1,image2')->from('tbl_family')->get()->result();
  
     foreach($result as $value){
        if($value->image!=""){
			
			$info['profile_id'] = $value->profile_code;
			$info['img_src'] = $value->image;
			$info['is_approved'] = 1;
			$info['posted_date'] =strtotime('now');
			
          $this->db->insert('user_images',$info);
          
          }
		  
          
          if($value->image1!=""){
             $info['profile_id'] = $value->profile_code;
			$info['img_src'] = $value->image1;
			$info['is_approved'] = 1;
			$info['posted_date'] =strtotime('now');
			
          $this->db->insert('user_images',$info);
  
          }
          
          if($value->image2!=""){
            $info['profile_id'] = $value->profile_code;
			$info['img_src'] = $value->image2;
			$info['is_approved'] = 1;
			$info['posted_date'] =strtotime('now');
			
          $this->db->insert('user_images',$info);
  
  
          }
	
	
}

}

public function imagesquery1(){
	  $result = $this->db->select('profileid,photo')->from('profilehistory_tbl')->where('photostatus',0)->get()->result();
	  $result1 = $this->db->select('profileid,photo1')->from('profilehistory_tbl')->where('photo1status',0)->get()->result();
	  $result2 = $this->db->select('profileid,photo2')->from('profilehistory_tbl')->where('photo2status',0)->get()->result();
  
     foreach($result as $value){
        if($value->photo!=""){
			
			$info['profile_id'] = $value->profileid;
			$info['img_src'] = $value->photo;
			$info['posted_date'] =strtotime('now');
			
          $this->db->insert('user_images',$info);
          
          }
}

foreach($result1 as $value){
        if($value->photo1!=""){
			
			$info['profile_id'] = $value->profileid;
			$info['img_src'] = $value->photo1;
			$info['posted_date'] =strtotime('now');
			
          $this->db->insert('user_images',$info);
          
          }
}
foreach($result2 as $value){
        if($value->photo2!=""){
			
			$info['profile_id'] = $value->profileid;
			$info['img_src'] = $value->photo2;
			$info['posted_date'] =strtotime('now');
			
          $this->db->insert('user_images',$info);
          
          }
}





}



  }