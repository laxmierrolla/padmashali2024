<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Staff controller
  Author: Laxmi
  Created Date: 29/December/2017
 * */  
class Reports extends CI_Controller {
	function __construct() {
        parent::__construct(); 
		$this->load->model('Reports_model','reports');
		$this->load->library('excel');
		//echo "<Pre>";print_r($this->session->userdata());exit();
	}

	public function index() {
		$countries = $this->reports->getcountries();
		$states = $this->reports->getstates();
		$cities = $this->reports->getcities();
		$data = array('countries'=>$countries,'states'=>$states,'cities'=>$cities);
		$this->load->view('admin/reports/view',$data);
	}


	//get all special cases	
   	public function allUserReports(){
	   $totalrecords = $this->reports->getAllReports($_POST,1);
       $allspls = $this->reports->getAllReports($_POST);
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

	public function allUserReportsDownload($search = null,$exceldata = null)
    {
        ini_set('memory_limit', '-1');
        $post = json_decode(base64_decode($search),true);
        ini_set('memory_limit', '-1');
        $fields = $this->getUserColumns();
        $columns = array_keys($fields);
        $filters = "";
        $users = $this->reports->getAllReports($post,null,1);
        $this->load->library('Excel');
        $this->excel->setFileName("UserReports")->setTitle("User Reports")->setFields($fields)->setData($users)->downloadExcel();
    }

    /**
     * [getUserColumns description]
     * @return [type] [description]
     */
    public function getUserColumns(){
        return array(
            "sno" => "Profile Code",
            "CONCAT(firstname,' ',lastname) as fullname" => "Sur Name",
            "a" =>"FirstName",
            "b"=>"lastName",
            "c"=>"Gender",
            "d"=>"Date Of Birth",
            "e"=>"Age",
            "f"=>"Email",
            "g"=>"Mobile",
            "h"=>"Marital Status",
            "i"=>"No of Childrens",
            "j"=>"CountryName",
            "k"=>"PhoneNumber",
           "l"=>"AlternateMobile",
            "1"=>"Present Address",
            "2"=>"Permanent Address",
            "3"=>"Country",
            "4"=>"State",
            "5s"=>"City",
            "6s"=>"Education",
            "7s"=>"Education Details",
            "8s"=>"Occupation",
            "9s"=>"Occupation Details",
            "10s"=>"Employee In",
            "as1"=>"Employee Details",
            "as2"=>"Income",
            "as3"=>"Height",
            "a44"=>"Weight",
            "asa"=>"Body Type",
            "complex"=>"Complexion",
            "as11"=>"Blood Group",
            "as12"=>"Special Cases", 
            "as13"=>"Dite",
            "as14"=>"Smoke", 
            "as15"=>"Drink",
            "sds16"=>"About Us", 
            "sds17"=>"Residant Type", 
            "sds18"=>"Birth Place",
            "sds19"=>"Birth Time(Hours)",
            "sds191"=>"Birth Time(Minuts)",
            "sds192"=>"Birth Time(AM/PM)",
            "sds20"=>"Birth Name", 
            "sds21"=>"Rasi",
            "sds22"=>"Star or Nakshatram", 
            "sds23"=>"Goathram",
            "sds25"=>"Paadam",
            "sds26"=>"Horoscope",
            "sds27"=>"Manglink Status",
            "sds28"=>"Family origin",
            "sds29"=>"Father Name",
            "sds30"=>"Father Live Status",
            "sds31"=>"Father Occupation",
            "sds32"=>"Mother Name",
            "sds33"=>"Mother Alive Status",
            "sds34"=>"Mother Occupation",
            "sds35"=>"NoOfElderNBrothers",
            "sds36"=>"NoOfElderNBrothersMarried",
	    "sds37"=>"NoOfYoungerBrothers",
	    "sds38"=>"NoOfYoungerBrothersMarried",
	    "sds39"=>"NoOfElderSisters",
			"sds40"=>"NoOfElderSistersMarried",
			"sds41"=>"NoOfYoungerSisters",
			"sds42"=>"NoOfYoungerSistersMarried",
			"sds43"=>"PartnerAgeFrom",
			"sds44"=>"partnerAgeTo",
			"sds45"=>"PartnerComplexion",
			"sds46"=>"partnerEducation",
			"sds47"=>"PartnerEducationalDetails",
			"sds48"=>"PartnerIncome",
			"sds49"=>"PartnerEducationFrom",
			"sds50"=>"Package",
			"sds51"=>"NoOfViews",
			"sds52"=>"SubscriptionValidUpto",
			"sds53"=>"AddedOn"
        );
    }

    public function contacts($search = null,$exceldata = null)
    {
    	$post=null;
        ini_set('memory_limit', '-1');
        $fields = $this->getUsercontactColumns();
        $columns = array_keys($fields);
        $filters = "";
        $users = $this->reports->getAllUserContactReports($post,null,1);
        $this->load->library('Excel');
        	$this->excel->setFileName("ContactReports")->setTitle("Contact Reports")->setFields($fields)->setData($users)->downloadExcel();
    }

    /**
     * [getUserColumns description]
     * @return [type] [description]
     */
    public function getUsercontactColumns(){
        return array(
        	"codep"=>"Profile Code",
            "CONCAT(firstname,' ',lastname) as fullname" => "Fullname",
            "email"=>"Email",
            "phone"=>"Mobile No",
            "appartment_number"=>"Gender"
        );
    }
}