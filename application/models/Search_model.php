<?php
defined('BASEPATH') or die('Some thing went wrong..!');
class Search_model extends CI_Model{
    
    public function advancedSearch($params)
    {
       //print_r($params);exit;
        $keyword_search=(isset($params['keyword_search']))?$params['keyword_search']:'';
        $age_from=(isset($params['age_from']))?$params['age_from']:'';
        $age_to=(isset($params['age_to']))?$params['age_to']:'';
        $height_from=(isset($params['height_from']))?$params['height_from']:'';
        $height_to=(isset($params['height_to']))?$params['height_to']:'';
        $maritalstatus=(isset($params['maritalstatus']))?$params['maritalstatus']:'';
        $education=(isset($params['education']))?$params['education']:array();/*Array*/
        $occupation=(isset($params['occupation']))?$params['occupation']:array();/*Array*/
        $anual_income=(isset($params['anual_income']))?$params['anual_income']:'';
        $employee_in=(isset($params['employee_in']))?$params['employee_in']:'';
        $specialcase=(isset($params['specialcase']))?$params['specialcase']:array();/*Array*/
        $rasi=(isset($params['rasi']))?$params['rasi']:'';
        $star=(isset($params['star']))?$params['star']:'';
        $manglik=(isset($params['manglik']))?$params['manglik']:'';
        $country=(isset($params['country']))?$params['country']:'';
        $state=(isset($params['state']))?$params['state']:'';
        $city=(isset($params['city']))?$params['city']:'';
        $residantstatus=(isset($params['residantstatus']))?$params['residantstatus']:'';
        $dite=(isset($params['dite']))?$params['dite']:'';
        $response=array();
        $profilepicpath=  base_url().'uploads/';
        //$where=array('u.gender'=>$params['login_gender']);
        $cols="f.inch,u.age,u.dob,u.id,u.profile_by as profile_by,u.profile_code as profilecode,u.ref_by as ref_by,u.sname as sname,u.fname as fname,u.lname as lname,u.living_in as living_in,u.addedby as addedby,u.thumbimage as thumbimage,f.feet,f.occ_details,city.name as city,country.name as country,f.feet as height,f.edu_details as edu_details,f.occ_details,f.aboutme as aboutme,u.Profile_photo_Status,u.Photoprotect";
        $this->db->select($cols,false)->from('tbl_personel u');
        $this->db->join('tbl_family f','f.profile_code=u.profile_code','inner');
	$this->db->join('cities city','city.id=f.city','left');
	$this->db->join('countries country','country.id=f.country','left');
       // $this->db->where($where);
		/*Filter code start */
        $this->db->where('u.gender',($params['login_gender']=='Male')?'Female':'Male');
        
        if($keyword_search=='')
        {
                $this->db->group_start();
		if(is_numeric($age_from) && !empty($age_from))
		{
			$this->db->where('u.age >=',$age_from);
		}
		if(is_numeric($age_to) && !empty($age_to))
		{
			$this->db->where('u.age <=',$age_to);
		}
                if(!empty($height_from))
		{
			$this->db->where('f.inch >= ',$height_from);
		}
                if(!empty($height_to))
		{
			$this->db->where('f.inch <= ',$height_to); 
		}
                if(!empty($education))
		{
			$this->db->where_in('f.edu',explode(',',$education));
		}
                if(!empty($occupation))
		{
			$this->db->where_in('f.occu',explode(',',$occupation));
		}
                if(!empty($anual_income))
		{
			$this->db->like('f.income',$anual_income,'both');
		}
                if(!empty($employee_in))
		{
                    $this->db->where_in('f.empin',explode(',',$employee_in));
		}
		if(is_numeric($rasi) && !empty($rasi))
		{
			$this->db->where('f.rasi',$rasi);
		}
                if(is_numeric($star) && !empty($star))
		{
			$this->db->where('f.star',$star);
		}
		if(!empty($manglik))
		{
                    $this->db->where_in('f.manglik',explode(',',$manglik));
		}
		
		if(is_numeric($country) && !empty($country))
		{
			$this->db->where('f.country',$country);
		}
		if(is_numeric($state) && !empty($state))
		{
			$this->db->where('f.state',$state);
		}
		if(is_numeric($city) && !empty($city))
		{
			$this->db->where('f.city',$city);
		}
		if(!empty($dite))
		{
			$this->db->like('f.dite',$dite,'both');
		}
                if(!empty($maritalstatus))
		{
                    $this->db->where_in('u.marital_status',explode(',',$maritalstatus));
		}
                if(!empty($residantstatus))
		{
                    $this->db->where_in('f.res_status',explode(',',$residantstatus));
		}
                if(!empty($specialcase))
		{
                    $this->db->where_in('f.splcases',explode(',',$specialcase));
		}
                $this->db->group_end();
        }
        else
        {
            $this->db->group_start();
            //PRofile code search
            $this->db->like('u.profile_code',$keyword_search,'left');
            $this->db->or_like('u.marital_status',$keyword_search,'both');
            if(is_numeric($keyword_search))
            {
                $this->db->where('u.age',$keyword_search);
            }
            $this->db->or_like('f.edu_details',$keyword_search,'both');
            $this->db->or_like('f.occ_details',$keyword_search,'both');
            $this->db->or_like('f.feet',$keyword_search,'both');
            $this->db->or_like('f.cmplxion',$keyword_search,'both');
            $this->db->or_like('f.body_type',$keyword_search,'both');
            $this->db->or_like('city.name',$keyword_search,'both');
            $this->db->group_end();       
        }
                
	/*Filter code end */
        
        $this->db->order_by('u.profile_code','random');
        $sql=$this->db->limit(100)->get();     
        //echo $this->db->last_query();exit;
        //echo $this->db->last_query();exit;  
        $dberror=  $this->db->error();
        $result_count=0;
        if($dberror['code']==0)
        {
            $count= $sql->num_rows();
            $result_count=$count;
            $response['search_result_count']=($count > 0)?$this->advanceSearchCount($params):0;
            $response['code']=($count > 0)?200:204;
            $response['description']=($count > 0)?$count.' results found':'No results found';
            $response['profilepic_path']=$profilepicpath;
            $response['search_result']=($count > 0)?$sql->result():array();
            
            /*Filter Module code start */
            
            /*Filter Module code end*/
        }
        else
        {
            $response['search_result_count']=0;
            $response['code']=575;
            $response['message']='DB error';
            $response['description']='Unfortunately some thing error occured.';
        }
        $response['result_count']=$result_count;
        return  json_encode($response);
    }
	
	public function profiledetails($params)
	{
        $response=array();
		$profileid=$params['profilecode'];	
		$profilepicpath=  base_url().'uploads/';
        $where=array('u.profile_code'=>$profileid);
        $cols="u.*,f.*,city.name as city,country.name as country,stat.name as state,mt.Language_Name as mother_tounge,edu.education as education,ocp.occupation,ras.rasi,sta.star as starname";
        $this->db->select($cols)->from('tbl_personel u');
        $this->db->join('tbl_family f','f.profile_code=u.profile_code','inner');                              
		$this->db->join('cities city','city.id=f.city','left');
        $this->db->join('states stat','stat.id=f.state','left');
		$this->db->join('countries country','country.id=f.country','left');
                $this->db->join('language_tbl mt','mt.L_Id=f.mothertounge','left');
                $this->db->join('tbl_education edu','edu.edu_id=f.edu','left');
                $this->db->join('tbl_occupation ocp','ocp.Occ_Id=f.occu','left');
                $this->db->join('tbl_rasi ras','ras.rasi_id=f.rasi','left');
                $this->db->join('tbl_star sta','sta.star_id=f.star','left');
                
                $this->db->where($where);
                $sql=  $this->db->get();
              //  echo $this->db->last_query();
                $db_error=  $this->db->error();
                if($db_error['code']==0)
                {
                    $count=$sql->num_rows();
                    $response['code']=($count > 0)?200:204;
                    $response['message']=($count > 0)?'success':'fail';
                    $response['description']=($count > 0)?"Getting $profileid profile details":'No results found';
                    $response['profile_result']=($count > 0)?$sql->row():(object)null;
                    
                }
                else
                {
                    $response['code']=575;
                    $response['message']='DB Error';
                    $response['description']='Some thing error occured';
                }
				
				if($response){
					$count = $this->db->select('ViewedProfileId')->from('viewedprofile_tbl')->where('ViewedProfileId',$profileid)->get()->num_rows();
					if($count > 0){
						return json_encode($response);
						}
					else{
						 $data = array(
						 	'MyProfileId'=>$this->session->userdata['user']['profilecode'],
							'ViewedProfileId'=>$profileid,
							'ViewedOn'=>date('Y-m-d H:i:s'),
						 );
						 $res = $this->db->insert('viewedprofile_tbl',$data);
						 if($res){
							 return json_encode($response);
							 }
						}	
					
					}
                
	}
        
        public function similarProfileList($params)
        {
            $response=array();
            $profileid=$params['profilecode'];
            $gender=$params['gender'];
            $profilepicpath=  base_url().'uploads/';
            $where=array('u.gender != '=>$gender,'u.profile_code !='=>$profileid);
            $cols="u.id,u.dob,u.profile_by as profile_by,u.profile_code as profilecode,u.ref_by as ref_by,u.sname as sname,u.living_in as living_in,u.age as age,u.addedby as addedby,u.thumbimage as thumbimage,f.feet,f.occ_details,city.name as city,country.name as country,u.Profile_photo_Status,u.Photoprotect";
            $this->db->select($cols)->from('tbl_personel u');
            $this->db->join('tbl_family f','f.profile_code=u.profile_code','inner');
            $this->db->join('cities city','city.id=f.city','left');
            $this->db->join('countries country','country.id=f.country','left');
            $this->db->where($where);
            $sql=  $this->db->order_by('u.id','DESC')->limit(10)->get();
            $dberror=  $this->db->error();
            if($dberror['code']==0)
            {
                $count=$sql->num_rows();
                $response['code']=($count > 0)?200:204;
                $response['message']=($count > 0)?'success':'fail';
                $response['description']=($count > 0)?'Getting related profile list':'No results found';
                $response['related_profile']=($count > 0)?$sql->result():array();
            }
            else
            {
                $response['code']=575;
                $response['message']='DB Error ';
                $response['description']='Some thing error occured while getting the related profile';
            }
            return json_encode($response);
        }
        
        public function advanceSearchCount($params)
        {
            $response=array();
                $keyword_search=$params['keyword_search'];
                $age_from=$params['age_from'];
		$age_to=$params['age_to'];
		$height_from=$params['height_from'];
		$height_to=$params['height_to'];
		$maritalstatus=$params['maritalstatus'];
		$education=$params['education']; /*Array*/
		$occupation=$params['occupation'];/*Array*/
		$anual_income=$params['anual_income'];
		$employee_in=$params['employee_in'];
		$specialcase=$params['specialcase'];/*Array*/
		$rasi=$params['rasi'];
		$star=$params['star'];
		$manglik=$params['manglik'];
		$country=$params['country'];
		$state=$params['state'];
		$city=$params['city'];
		$residantstatus=$params['residantstatus'];
		$dite=$params['dite'];
        
        //$where=array('u.gender'=>$params['login_gender']);
        $cols="u.profile_code";
        $this->db->select($cols,false)->from('tbl_personel u');
        $this->db->join('tbl_family f','f.profile_code=u.profile_code','inner');
	$this->db->join('cities city','city.id=f.city','left');
	$this->db->join('countries country','country.id=f.country','left');
       // $this->db->where($where);
		/*Filter code start */
        $this->db->where('u.gender',($params['login_gender']=='Male')?'Female':'Male');
        $this->db->group_start();
        if($keyword_search=='')
        {
		if(is_numeric($age_from) && !empty($age_from))
		{
			$this->db->where('u.age >=',$age_from);
		}
		if(is_numeric($age_to) && !empty($age_to))
		{
			$this->db->where('u.age <=',$age_to);
		}
		if(!empty($height_from))
		{
			$this->db->where('f.inch >= ',$height_from);
		}
		if(!empty($height_to))
		{
			$this->db->where('f.inch <= ',$height_to); 
		}
		if(!empty($education))
		{
			$this->db->where_in('f.edu',explode(',',$education));
		}
		if(!empty($occupation))
		{
			$this->db->where_in('f.occu',explode(',',$occupation));
		}
		if(!empty($anual_income))
		{
			$this->db->like('f.income',$anual_income,'both');
		}
		if(!empty($employee_in))
		{
                    $this->db->where_in('f.empin',explode(',',$employee_in));
		}
		if(is_numeric($rasi) && !empty($rasi))
		{
			$this->db->where('f.rasi',$rasi);
		}
		if(is_numeric($star) && !empty($star))
		{
			$this->db->where('f.star',$star);
		}
		if(!empty($manglik))
		{
                    $this->db->where_in('f.manglik',explode(',',$manglik));
		}
		
		if(is_numeric($country) && !empty($country))
		{
			$this->db->where('f.country',$country);
		}
		if(is_numeric($state) && !empty($state))
		{
			$this->db->where('f.state',$state);
		}
		if(is_numeric($city) && !empty($city))
		{
			$this->db->where('f.city',$city);
		}
		if(!empty($dite))
		{
			$this->db->like('f.dite',$dite,'both');
		}
                if(!empty($maritalstatus))
		{
                    $this->db->where_in('u.marital_status',explode(',',$maritalstatus));
		}
                if(!empty($residantstatus))
		{
                    $this->db->where_in('f.res_status',explode(',',$residantstatus));
		}
                if(!empty($specialcase))
		{
                    $this->db->where_in('f.splcases',explode(',',$specialcase));
		}
        }
        else
        {
            
            //PRofile code search
            $this->db->like('u.profile_code',$keyword_search,'left');
            $this->db->or_like('u.marital_status',$keyword_search,'both');
            if(is_numeric($keyword_search))
            {
                $this->db->where('u.age',$keyword_search);
            }
            $this->db->or_like('f.edu_details',$keyword_search,'both');
            $this->db->or_like('f.occ_details',$keyword_search,'both');
            $this->db->or_like('f.feet',$keyword_search,'both');
            $this->db->or_like('f.cmplxion',$keyword_search,'both');
            $this->db->or_like('f.body_type',$keyword_search,'both');
            $this->db->or_like('city.name',$keyword_search,'both');
             
        }
                 $this->db->group_end();
                 $count=  $this->db->get()->num_rows();
                 return $count;
        }

        public function displayStatistics($params)
        {
                $response=array();
                $keyword_search=$params['keyword_search'];
                $age_from=$params['age_from'];
		$age_to=$params['age_to'];
		$height_from=$params['height_from'];
		$height_to=$params['height_to'];
		$maritalstatus=$params['maritalstatus'];
		$education=$params['education']; /*Array*/
		$occupation=$params['occupation'];/*Array*/
		$anual_income=$params['anual_income'];
		$employee_in=$params['employee_in'];
		$specialcase=$params['specialcase'];/*Array*/
		$rasi=$params['rasi'];
		$star=$params['star'];
		$manglik=$params['manglik'];
		$country=$params['country'];
		$state=$params['state'];
		$city=$params['city'];
		$residantstatus=$params['residantstatus'];
		$dite=$params['dite'];
        
        //$where=array('u.gender'=>$params['login_gender']);
        $cols="GROUP_CONCAT(u.profile_code)  as profilecode";
        $this->db->select($cols,false)->from('tbl_personel u');
        $this->db->join('tbl_family f','f.profile_code=u.profile_code','inner');
	$this->db->join('cities city','city.id=f.city','left');
	$this->db->join('countries country','country.id=f.country','left');
       // $this->db->where($where);
		/*Filter code start */
        $this->db->where('u.gender',($params['login_gender']=='Male')?'Female':'Male');
        $this->db->group_start();
        if($keyword_search=='')
        {
		if(is_numeric($age_from) && !empty($age_from))
		{
			$this->db->where('u.age >=',$age_from);
		}
		if(is_numeric($age_to) && !empty($age_to))
		{
			$this->db->where('u.age <=',$age_to);
		}
		if(!empty($height_from))
		{
			$this->db->where('f.inch >= ',$height_from);
		}
		if(!empty($height_to))
		{
			$this->db->where('f.inch <= ',$height_to); 
		}
		if(!empty($education))
		{
			$this->db->where_in('f.edu',explode(',',$education));
		}
		if(!empty($occupation))
		{
			$this->db->where_in('f.occu',explode(',',$occupation));
		}
		if(!empty($anual_income))
		{
			$this->db->like('f.income',$anual_income,'both');
		}
		if(!empty($employee_in))
		{
                    $this->db->where_in('f.empin',explode(',',$employee_in));
		}
		if(is_numeric($rasi) && !empty($rasi))
		{
			$this->db->where('f.rasi',$rasi);
		}
		if(is_numeric($star) && !empty($star))
		{
			$this->db->where('f.star',$star);
		}
		if(!empty($manglik))
		{
                    $this->db->where_in('f.manglik',explode(',',$manglik));
		}
		
		if(is_numeric($country) && !empty($country))
		{
			$this->db->where('f.country',$country);
		}
		if(is_numeric($state) && !empty($state))
		{
			$this->db->where('f.state',$state);
		}
		if(is_numeric($city) && !empty($city))
		{
			$this->db->where('f.city',$city);
		}
		if(!empty($dite))
		{
			$this->db->like('f.dite',$dite,'both');
		}
                if(!empty($maritalstatus))
		{
                    $this->db->where_in('u.marital_status',explode(',',$maritalstatus));
		}
                if(!empty($residantstatus))
		{
                    $this->db->where_in('f.res_status',explode(',',$residantstatus));
		}
                if(!empty($specialcase))
		{
                    $this->db->where_in('f.splcases',explode(',',$specialcase));
		}
        }
        else
        {
            				//PRofile code search
                $this->db->like('u.profile_code',$keyword_search,'left');
                $this->db->or_like('u.marital_status',$keyword_search,'both');
                if(is_numeric($keyword_search))
                {
                        $this->db->where('u.age',$keyword_search);
                }
                $this->db->or_like('f.edu_details',$keyword_search,'both');
                $this->db->or_like('f.occ_details',$keyword_search,'both');
                $this->db->or_like('f.feet',$keyword_search,'both');
                $this->db->or_like('f.cmplxion',$keyword_search,'both');
                $this->db->or_like('f.body_type',$keyword_search,'both');
		$this->db->or_like('city.name',$keyword_search,'both');

            }
                 $this->db->group_end();
                 $sql=  $this->db->get()->row();
                 $users_list=$sql->profilecode;
                 $response['employee_in']=  $this->employeeStatistics($users_list);
                 $response['education']=  $this->educationStatistics($users_list);
                 $response['martial']=  $this->maritalStatistics($users_list);
                 $response['occupation']=  $this->occupationStatistics($users_list);
                 $response['height']=  $this->heightStatistics($users_list);
                 $response['specialcases']=  $this->specialCaseStatistics($users_list);
                 $response['rasi']=  $this->specialCaseStatistics($users_list);
                 $response['specialcases']=  $this->specialCaseStatistics($users_list);
                 $response['rasi']=  $this->rasiStatistics($users_list);
                 $response['star']=  $this->starStatistics($users_list);
                 $response['manglink']=  $this->manglikStatistics($users_list);
                 $response['residantstatus']=  $this->residantStatistics($users_list);
                 $response['dite']=  $this->diteStatistics($users_list);
                 return json_encode($response);
        }
        
        
        /* Employee */
        public  function employeeStatistics($users)
        {
            /*echo $users;
            exit;*/
            $result=0;
             $sql=$this->db->select('e.*,COUNT(f.id) as total_count')
                   ->from('tbl_emplin e')
                   ->join('tbl_family f','f.empin=e.emp_id')
                   ->join('tbl_personel p','p.profile_code=f.profile_code','inner')
                   ->where_in('f.profile_code',explode(',',$users))
                   ->group_by('e.emp_id')->get();
                  //echo $this->db->last_query();
             $count=$sql->num_rows();
            if($count > 0)
            {
                $result= $sql->result();
            }
            return $result;
        }
        /* Employee End*/
        
          /* education */
        public  function educationStatistics($users)
        {
            $result=0;
             $sql=$this->db->select('e.*,COUNT(f.id) as total_count')
                   ->from('tbl_education e')
                   ->join('tbl_family f','f.edu=e.edu_id')
                   ->where_in('f.profile_code',explode(',',$users))
                   ->group_by('e.edu_id')->get();
             $count=$sql->num_rows();
            if($count > 0)
            {
                $result= $sql->result();
            }
            return $result;
        }
        /* eduction End*/
        public  function maritalStatistics($users)
        {
            $nevermarried_sql=$this->db->select('id')->from('tbl_personel')
                   ->where_in('profile_code',explode(',',$users))->like('marital_status','Never Married','both')->get();
           $nevermarried=$nevermarried_sql->num_rows();
           $widow=  $this->db->select('id')->from(' tbl_personel')
                   ->where_in('profile_code',explode(',',$users))->like('marital_status','Widow','both')->get()->num_rows();
           $divorced=  $this->db->select('id')->from(' tbl_personel')
                   ->where_in('profile_code',explode(',',$users))->like('marital_status','Divorced')->get()->num_rows();
           $separated=  $this->db->select('id')->from(' tbl_personel')
                   ->where_in('profile_code',explode(',',$users))->like('marital_status','Separated','both')->get()->num_rows();
           $result=array(
               'NeverMarried'=>!empty($nevermarried)?$nevermarried:0,
               'Widow'=>!empty($widow)?$widow:0,
               'Divorced'=>!empty($divorced)?$divorced:0,
               'Separated'=>!empty($separated)?$separated:0,
           );
           return $result;
        }
        /* >> Occupation statiscts code star t*/
        public  function occupationStatistics($users)
        {
            $result=array();
             $sql=$this->db->select('o.*,COUNT(f.id) as total_count')
                   ->from('tbl_occupation o')
                   ->join('tbl_family f','f.occu=o.Occ_Id','left')
                   ->where_in('f.profile_code',explode(',',$users))
                   ->group_by('o.Occ_Id')->get();
             $count=$sql->num_rows();
            if($count > 0)
            {
                $result= $sql->result();
            }
            return $result;
        }
        /* Occupation end */
        // Height Module code 
        public  function heightStatistics($users)
        {
            $result=array();
             $sql=$this->db->select('h.*,COUNT(f.id) as total_count')
                   ->from('tbl_feet h')
                   ->join('tbl_family f','f.inch=h.feet_length','left')
                   ->where_in('f.profile_code',explode(',',$users))
                   ->group_by('h.feet_length')->get();
             $count=$sql->num_rows();
            if($count > 0)
            {
                $result= $sql->result();
            }
            return $result;
        }
        //Special case
        
        public  function specialCaseStatistics($users)
        {
            $result=array();
            
             $sql=$this->db->select('s.*,COUNT(f.id) as total_count')
                   ->from('tbl_spacial s')
                   ->join('tbl_family f','f.splcases=s.spacial','left')
                   ->where_in('f.profile_code',explode(',',$users))
                   ->group_by('s.spl_id')->get();
             $count=$sql->num_rows();
             //echo $this->db->last_query();exit;
            if($count > 0)
            {
                $result= $sql->result();
            }
            return $result;
        }
        
        //Rasi Module code
        public  function rasiStatistics($users)
        {
            $result=0;
             $sql=$this->db->select('r.*,COUNT(f.id) as total_count')
                   ->from('tbl_rasi r')
                   ->join('tbl_family f','f.rasi=r.rasi_id','left')
                   ->where_in('f.profile_code',explode(',',$users))
                   ->group_by('r.rasi_id')->get();
             $count=$sql->num_rows();
            if($count > 0)
            {
                $result= $sql->result();
            }
            return $result;
        }
        //Star Module code
        public  function starStatistics($users)
        {
            $result=array();
             $sql=$this->db->select('s.*,COUNT(f.id) as total_count')
                   ->from('tbl_star s')
                   ->join('tbl_family f','f.star=s.star_id','left')
                   ->where_in('f.profile_code',explode(',',$users))
                   ->group_by('s.star_id')->get();
             $count=$sql->num_rows();
            if($count > 0)
            {
                $result= $sql->result();
            }
            return $result;
        }
        //Manglik Module code 
        public  function manglikStatistics($users)
        {
            $result=array();
            $dontknow_sql=$this->db->select('id')->from('tbl_family')
                   ->where_in('profile_code',explode(',',$users))->like('manglik','Dont Know','both')->get();
           $dontknow=$dontknow_sql->num_rows();
           $yes_sql=$this->db->select('id')->from('tbl_family')
                   ->where_in('profile_code',explode(',',$users))->where('manglik','Yes')->get();
           $yes=$yes_sql->num_rows();
           //echo $this->db->last_query();
           $no_sql=$this->db->select('id')->from('tbl_family')
                   ->where_in('profile_code',explode(',',$users))->where('manglik','No')->get();
           $no=$dontknow_sql->num_rows();
           $result=array(
               'dontknow'=>!empty($dontknow)?$dontknow:0,
               'yes'=>!empty($yes)?$yes:0,
               'no'=>!empty($no)?$no:0,
           );
           return $result;
        }
        
        public function residantStatistics($users)
        {
             $dontwant_sql=$this->db->select('id')->from('tbl_family')
                   ->where_in('profile_code',explode(',',$users))->like('res_status','Dont Want be Specific','both')->get();
            $dont_count=$dontwant_sql->num_rows();
            
            $rental_sql=$this->db->select('id')->from('tbl_family')
                   ->where_in('profile_code',explode(',',$users))->where('res_status','Rental')->get();
            $rental_count=$rental_sql->num_rows();
            
            $own_sql=$this->db->select('id')->from('tbl_family')
                   ->where_in('profile_code',explode(',',$users))->where('res_status','Own')->get();
            $own_count=$own_sql->num_rows();
            $result=array(
               'dontwant'=>!empty($dont_count)?$dont_count:0,
               'rental'=>!empty($rental_count)?$rental_count:0,
               'own'=>!empty($own_count)?$own_count:0,
           );
           return $result;
        }
        
        public function diteStatistics($users)
        {
             $veg_sql=$this->db->select('id')->from('tbl_family')
                   ->where_in('profile_code',explode(',',$users))->where('dite','Veg')->get();
             $veg_count=$veg_sql->num_rows();
            
            $nonveg_sql=$this->db->select('id')->from('tbl_family')
                   ->where_in('profile_code',explode(',',$users))->where('dite','Non-Veg')->get();
            $nonveg_count=$nonveg_sql->num_rows();
            
            $both_sql=$this->db->select('id')->from('tbl_family')
                   ->where_in('profile_code',explode(',',$users))->where('dite','Both')->get();
            $both_count=$both_sql->num_rows();
            $result=array(
               'veg'=>!empty($veg_count)?$veg_count:0,
               'nonveg'=>!empty($nonveg_count)?$nonveg_count:0,
               'both'=>!empty($both_count)?$both_count:0,
           );
           return $result;
        }
        
        public function basicSearch($params)
    {
            //print_r($params);exit;
                $age_from=(isset($params['age_from']))?$params['age_from']:'';
		$age_to=(isset($params['age_to']))?$params['age_to']:'';
		$height_from=(isset($params['height_from']))?$params['height_from']:'';
		$height_to=(isset($params['height_to']))?$params['height_to']:'';
		$gender=$params['gender'];
        $response=array();
        $profilepicpath=  base_url().'uploads/';
        $cols="u.id,u.dob,u.profile_by as profile_by,u.profile_code as profilecode,u.ref_by as ref_by,u.sname as sname,u.fname as fname,u.lname as lname,u.living_in as living_in,u.addedby as addedby,u.thumbimage as thumbimage,f.feet,f.occ_details,city.name as city,country.name as country,f.feet as height,f.edu_details as edu_details,f.occ_details,f.aboutme as aboutme";
        $this->db->select($cols,false)->from('tbl_personel u');
        $this->db->join('tbl_family f','f.profile_code=u.profile_code','inner');
	$this->db->join('cities city','city.id=f.city','left');
	$this->db->join('countries country','country.id=f.country','left');
       /*Filter code start */
       $this->db->where('u.gender',$gender); 
       if($age_from!='' || $age_to!='' || $height_from!='' || $height_to!='')
       {
         $this->db->group_start();
		if(is_numeric($age_from) && !empty($age_from))
		{
			$this->db->where('u.age >=',$age_from);
		}
                if(is_numeric($age_to) && !empty($age_to))
		{
			$this->db->where('u.age <=',$age_to);
		}
		if(!empty($height_from))
		{
			$this->db->where('f.inch >= ',$height_from);
		}
                if(!empty($height_to))
		{
			$this->db->where('f.inch <= ',$height_to); 
		}  
                $this->db->group_end();
       }
        $this->db->order_by('u.profile_code','random');
        $sql=$this->db->limit(100)->get();
        $dberror=  $this->db->error();
        //echo $this->db->last_query();exit;
        $result_count=0;
        if($dberror['code']==0)
        {
            $count= $sql->num_rows();
            $result_count=$count;            
            $response['code']=($count > 0)?200:204;
            $response['description']=($count > 0)?$count.' results found':'No results found';
            $response['profilepic_path']=$profilepicpath;
            $response['search_result']=($count > 0)?$sql->result():array();
            $response['search_count']=($count > 0)?$this->basicSearchCount($params):0;
           
        }
        else
        {
            $response['search_result_count']=0;
            $response['code']=575;
            $response['message']='DB error';
            $response['description']='Unfortunately some thing error occured.';
        }
        $response['result_count']=$result_count;
        return  json_encode($response);
    }
    
    public function basicSearchCount($params)
    {
        $age_from=(isset($params['age_from']))?$params['age_from']:'';
		$age_to=(isset($params['age_to']))?$params['age_to']:'';
		$height_from=(isset($params['height_from']))?$params['height_from']:'';
		$height_to=(isset($params['height_to']))?$params['height_to']:'';
		$gender=$params['gender'];
        $response=array();
        $profilepicpath=  base_url().'uploads/';
        $cols="u.id";
        $this->db->select($cols,false)->from('tbl_personel u');
        $this->db->join('tbl_family f','f.profile_code=u.profile_code','inner');
	
       /*Filter code start */
       $this->db->where('u.gender',$gender);
       if($age_from!='' || $age_to!='' || $height_from!='' || $height_to!='')
       {
         $this->db->group_start();
		if(is_numeric($age_from) && !empty($age_from))
		{
			$this->db->where('u.age >=',$age_from);
		}
                if(is_numeric($age_to) && !empty($age_to))
		{
			$this->db->where('u.age <=',$age_to);
		}
		if(!empty($height_from))
		{
			$this->db->where('f.inch >= ',$height_from);
		}
                if(!empty($height_to))
		{
			$this->db->where('f.inch <= ',$height_to); 
		}  
                $this->db->group_end();
       }
        $this->db->order_by('u.profile_code','random');
        $count=$this->db->get()->num_rows();
        return (is_numeric($count))?$count:0;
    }
    
    public function basicSearchStatistics($params)
        {
                $response=array();
                $age_from=(isset($params['age_from']))?$params['age_from']:'';
		$age_to=(isset($params['age_to']))?$params['age_to']:'';
		$height_from=(isset($params['height_from']))?$params['height_from']:'';
		$height_to=(isset($params['height_to']))?$params['height_to']:'';
		$gender=$params['gender'];
        
        //$where=array('u.gender'=>$params['login_gender']);
        $cols="GROUP_CONCAT(u.profile_code)  as profilecode";
        $this->db->select($cols,false)->from('tbl_personel u');
        $this->db->join('tbl_family f','f.profile_code=u.profile_code','inner');
	
		/*Filter code start */
        $this->db->where('u.gender',$gender);   
         if($age_from!='' || $age_to!='' || $height_from!='' || $height_to!='')
       {
                $this->db->group_start();
		if(is_numeric($age_from) && !empty($age_from))
		{
			$this->db->where('u.age >=',$age_from);
		}
		if(is_numeric($age_to) && !empty($age_to))
		{
			$this->db->where('u.age <=',$age_to);
		}
		if(!empty($height_from))
		{
			$this->db->where('f.inch >= ',$height_from);
		}
		if(!empty($height_to))
		{
			$this->db->where('f.inch <= ',$height_to); 
		}
		
                 $this->db->group_end();
       }
                 $sql=  $this->db->get()->row();
                 $users_list=$sql->profilecode;
                 $response['employee_in']=  $this->employeeStatistics($users_list);
                 $response['education']=  $this->educationStatistics($users_list);
                 $response['martial']=  $this->maritalStatistics($users_list);
                 $response['occupation']=  $this->occupationStatistics($users_list);
                 $response['height']=  $this->heightStatistics($users_list);
                 $response['specialcases']=  $this->specialCaseStatistics($users_list);
                 $response['rasi']=  $this->specialCaseStatistics($users_list);
                 $response['specialcases']=  $this->specialCaseStatistics($users_list);
                 $response['rasi']=  $this->rasiStatistics($users_list);
                 $response['star']=  $this->starStatistics($users_list);
                 $response['manglink']=  $this->manglikStatistics($users_list);
                 $response['residantstatus']=  $this->residantStatistics($users_list);
                 $response['dite']=  $this->diteStatistics($users_list);
                 return json_encode($response);
        }
		
		
		public function get_images($params){
			$profilecode = $params['profilecode'];
			
			$this->db->select('*')->from('user_images')->where('profile_id',$profilecode);
			return $data = $this->db->get()->result_array();
			
		}
		
		
}

