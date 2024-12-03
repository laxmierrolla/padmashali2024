<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Viewprofile_model extends CI_Model {
 
    public function getAllReports($pdata, $getcount=NULL,$cols = "*") {
  
        $tabelcolumns = array(
            0 => 'p.id',
            1=> 'p.profile_code',
        );

       $search_1 = array(
            1 => 'p.profile_code',
	    2 => 'p.fname',
	    3=>  'p.lname',
	    4=>  'p.sname',
            5 => 'p.email',
            6 =>'p.mobile',
        );

       if(isset($pdata['country_wise']) && $pdata['country_wise']!=""){
            $this->db->where('f.country',$pdata['country_wise']);
        }
        if(isset($pdata['state_wise']) && $pdata['state_wise']!=""){
            $this->db->where('f.state',$pdata['state_wise']);
        }
        if(isset($pdata['city_wise']) && $pdata['city_wise']!=""){
            $this->db->where('f.city',$pdata['city_wise']);
        }
        if(isset($pdata['package_type']) && $pdata['package_type']!=""){
            $this->db->where('m.package',$pdata['package_type']);
        }
        if(isset($pdata['marital_status']) && $pdata['marital_status']!=""){
            $this->db->where('p.marital_status',$pdata['marital_status']);
        }
        if(isset($pdata['status_search']) && $pdata['status_search']!=""){
            $this->db->where('p.profile_status',$pdata['status_search']);
        }
        if(isset($pdata['reference_by']) && $pdata['reference_by']!=""){
            $this->db->where('p.ref_by',$pdata['reference_by']);
        }
        if(isset($pdata['payment_type']) && $pdata['payment_type']!=""){
            $this->db->where('m.payment_status',$pdata['payment_type']);
        }
        if(isset($pdata['bride_type']) && $pdata['bride_type']!=""){
            $this->db->where('p.gender',$pdata['bride_type']);
        }
        if(isset($pdata['from_date']) && $pdata['from_date']!="" && isset($pdata['to_date']) && $pdata['to_date']!="" )
	{
	$created_from = date('Y-m-d',strtotime($pdata['from_date']));
                $created_to = date('Y-m-d',strtotime($pdata['to_date']));
		$this->db->where('p.addedon BETWEEN '."'".$created_from."'".' AND '."'".$created_to."'");
	}
        //count of records
        if($getcount){ 
            $this->db->select('p.profile_code as ProfileCode,p.id as id')->from('tbl_personel as p');
			
			$this->db->join('tbl_family as f','f.profile_code=p.profile_code','left');
			$this->db->join('countries as cou','cou.id=f.country AND cou.id=p.living_in','left');
			$this->db->join('tbl_money as m','m.profile_code=p.profile_code','left');
			$this->db->join('admin_packages as ap','m.package=ap.id OR m.package="-"','left');
			$this->db->join('states as st','st.id=f.state','left');
			$this->db->join('cities as ct','ct.id=f.city','left');
			$this->db->join('tbl_education as ed','ed.edu_id=f.edu','left');
			$this->db->join('tbl_occupation as occ','f.occu=occ.Occ_Id','left');
			$this->db->join('tbl_emplin as emp','f.empin=emp.emp_id','left');
			$this->db->join('tbl_rasi as ra','f.rasi=ra.rasi_id','left');
			$this->db->join('tbl_star as sta','f.star=sta.star_id','left');
                        $this->db->order_by('p.id','desc');
           }
	else{
            $this->db->select('p.profile_code as ProfileCode,p.id as id,p.profile_status as ProfileStatus,p.Profile_photo_Status,p.last_login as Lastlogin,p.sname as SurName,p.fname as FirstName,p.lname as LastName,p.gender as Gender,p.dob as DateOfBirth,p.age as Age,p.email as EmailId,p.mobile as MobileNumber,p.marital_status as MartialStatus,p.nochild as NoOfChildrens,cou.name as CountryName,f.phone as PhoneNumber,f.fmobile as AlternateMobileNumber,f.address as PresentAddress,f.perminantaddress as PerminantAddress,cou.name as Country,st.name as State,ct.name as City,ed.education as Education,f.edu_details as EducationDetails,occ.occupation as Occupation,f.occ_details as OccupationDetails,emp.employee as EmployeeIn,f.employmentdetails as EmployemtDetails,f.income as Income,f.feet as Height,f.weight as Weight,f.cmplxion as Complexion,f.body_type as BodyType,f.bldgrp as Bloodgroup,f.splcases as SpecialCases,f.dite as Dite,f.smoke as Smoke,f.drink as Drink,f.aboutme as AbouUs,f.res_status as ResidantType,f.birth_place as BirthPlace,f.hrs as BirthTimeInHours,f.mins as BirthTimeInMin,f.period as BirthTimeperiod,f.birth_name as BirthName,ra.rasi as Rasi,sta.star as StarORNakashtram,f.gowthram as Gowthram,f.paadam as Paadam,f.horoscope as HoroscopeStatus,f.manglik as  ManglinkStatus,f.family_origin as FamilyOrigin,f.father_name as FatherName,f.fa_alive as FatherLiveStatus,f.father_occupation as FatherOccupation,f.mother_name as MotherName,f.ma_alive as MotherAliveStatus,f.mother_occupation as MotherIOccupation,f.elder_bro as NoOfElderNBrothers,f.elder_bro1 as NoOfElderNBrothersMarried,f.young_bro as NoOfYoungerBrothers,f.young_bro1 as NoOfYoungerBrothersMarried,f.elder_sis as NoOfElderSisters,f.elder_sis1 as NoOfElderSistersMarried,f.young_sis as NoOfYoungerSisters,f.young_sis1 as NoOfYoungerSistersMarried,f.age_from as PartnerAgeFrom,f.age_to as partnerAgeTo,f.Complexion_from as PartnerComplexion,f.Education_fromType as partnerEducation,f.EducationDetails_from as PartnerEducationalDetails,f.AnnualIncome_from as PartnerIncome,f.Occuaption_FromType as PartnerEducationFrom,ap.name as Package,m.noofviews as NoOfViews,m.subscribe_validity as Validity,m.suscribed_on as AddedOn,m.payment_status')->from('tbl_personel as p');
			$this->db->join('tbl_family as f','f.profile_code=p.profile_code','left');
			$this->db->join('countries as cou','cou.id=f.country AND cou.id=p.living_in','left');
			$this->db->join('tbl_money as m','m.profile_code=p.profile_code','left');
			$this->db->join('admin_packages as ap','m.package=ap.id OR m.package="-"','left');
			$this->db->join('states as st','st.id=f.state','left');
			$this->db->join('cities as ct','ct.id=f.city','left');
			$this->db->join('tbl_education as ed','ed.edu_id=f.edu','left');
			$this->db->join('tbl_occupation as occ','f.occu=occ.Occ_Id','left');
			$this->db->join('tbl_emplin as emp','f.empin=emp.emp_id','left');
			$this->db->join('tbl_rasi as ra','f.rasi=ra.rasi_id','left');
			$this->db->join('tbl_star as sta','f.star=sta.star_id','left');
                        $this->db->order_by('p.id','desc');
        }
        if(isset($pdata['search_text1'])&& $pdata['search_text1']!=""){
           $this->db->like($search_1[$pdata['search_on1']], $pdata['search_text1'] );
        }
	
        if($getcount){
            return $this->db->get()->num_rows();
        }
        //for records
        if(isset($pdata['length'])){
        $perpage = $pdata['length'];
        $limit = $pdata['start'];

        $orderby_field = $tabelcolumns[$pdata['order'][0]['column']]; 
        $orderby = $pdata['order']['0']['dir'];

        $generatesno = $limit+1;
        $this->db->order_by($orderby_field,$orderby);
        $this->db->limit($perpage,$limit);
        }else{
        $generatesno = 0;
        }
        $allusers = $this->db->get()->result_array();
       // echo $this->db->last_query();exit();
        foreach($allusers as $key=>$values){
        if($cols == "*"){
        	$allusers[$key]['sno'] = $generatesno++;
            	$allusers[$key]['FullName'] = $allusers[$key]['SurName']." ".$allusers[$key]['FirstName']." ".$allusers[$key]['LastName'];
        	}
        }
        return $allusers;
    }

   
    //status change user
public function change_staus_by_profilecode($profilecode, $data){
    $this->db->where('profile_code',$profilecode);
    $this->db->update('tbl_personel', $data);
    return $this->db->affected_rows();
} 

//photo status 
public function change_photostaus_by_profilecode($profilecode, $data){
    $this->db->where('profile_code',$profilecode);
    $this->db->update('tbl_personel', $data);
    return $this->db->affected_rows();
} 


public function viewed_by_me($profilecode){
    $viewdata = array();
    $fullname = $this->db->select('CONCAT(sname,fname,lname) as FullName')->from('tbl_personel')->where('profile_code',$profilecode)->get()->row(); 
   
    $viewbymess = $this->db->select('VParnerId,VDate')->from('viewcontactdetails_tbl')->where('VMyId',$profilecode)->get();
    $viewdbymecount = $viewbymess->num_rows();
    if($viewdbymecount > 0){
       $viewdbyme = $viewbymess->result_array();
       $viewdata['viewedbyme'] = $viewdbyme;
       $viewdata['viewdbymecount'] = $viewdbymecount;
    }
    else{
        $viewdata['viewedbyme'] = "NoDataFound";
        $viewdata['viewdbymecount'] = 0;
    }

    $viewdbyothersss = $this->db->select('VMyId,VDate')->from('viewcontactdetails_tbl')->where('VParnerId',$profilecode)->get();
    $viewdbyotherscount = $viewdbyothersss->num_rows();
    if($viewdbyotherscount > 0){
       $viewdbyothers = $viewdbyothersss->result_array();
       $viewdata['viewdbyothers'] = $viewdbyothers;
       $viewdata['viewdbyotherscount'] = $viewdbyotherscount;
    }
    else{
        $viewdata['viewdbyothers'] = "NoDataFound";
        $viewdata['viewdbyotherscount'] = 0;
    }
      $viewdata['FullName'] = $fullname->FullName;
     // print_r($viewdata);
      //exit;
     return $viewdata;
}
public function view_data($profilecode){
    
    $this->db->select('p.profile_code as ProfileCode,p.thumbimage,p.Profile_photo_Status,l.Language_Name,p.ref_by,p.Photoprotect,p.id as id,p.profile_status as ProfileStatus,p.profile_by,p.last_login as Lastlogin,p.sname as SurName,p.fname as FirstName,p.lname as LastName,p.gender as Gender,p.dob as DateOfBirth,p.age as Age,p.email as EmailId,p.mobile as MobileNumber,p.marital_status as MartialStatus,p.nochild as NoOfChildrens,c.name as country,cu.name as living,ct.name as countryresidant_from,f.phone as PhoneNumber,f.fmobile as AlternateMobileNumber,f.address as PresentAddress,f.perminantaddress as PerminantAddress,st.name as State,ct.name as City,ed.education as Education,f.edu_details as EducationDetails,occ.occupation as Occupation,f.occ_details as OccupationDetails,emp.employee as EmployeeIn,f.employmentdetails as EmployemtDetails,f.income as Income,f.feet as Height,f.weight as Weight,f.cmplxion as Complexion,f.body_type as BodyType,f.bldgrp as Bloodgroup,f.splcases as SpecialCases,f.dite as Dite,f.smoke as Smoke,f.drink as Drink,f.aboutme as AbouUs,f.res_status as ResidantType,f.birth_place as BirthPlace,f.hrs as BirthTimeInHours,f.mins as BirthTimeInMin,f.period as BirthTimeperiod,f.secs,f.birth_name as BirthName,ra.rasi as Rasi,sta.star as StarORNakashtram,f.gowthram as Gowthram,f.paadam as Paadam,f.horoscope as HoroscopeStatus,f.manglik as  ManglinkStatus,f.family_origin as FamilyOrigin,f.father_name as FatherName,f.fa_alive as FatherLiveStatus,f.father_occupation as FatherOccupation,f.mother_name as MotherName,f.ma_alive as MotherAliveStatus,f.mother_occupation as MotherIOccupation,f.elder_bro as NoOfElderNBrothers,f.elder_bro1 as NoOfElderNBrothersMarried,f.young_bro as NoOfYoungerBrothers,f.young_bro1 as NoOfYoungerBrothersMarried,f.elder_sis as NoOfElderSisters,f.elder_sis1 as NoOfElderSistersMarried,f.young_sis as NoOfYoungerSisters,f.young_sis1 as NoOfYoungerSistersMarried,f.age_from as PartnerAgeFrom,f.age_to as partnerAgeTo,f.Complexion_from as PartnerComplexion,f.Education_fromType as partnerEducation,f.EducationDetails_from as PartnerEducationalDetails,f.AnnualIncome_from as PartnerIncome,f.Occuaption_FromType as PartnerEducationFrom,ap.name as Package,ap.price,ap.valid as PackageValidity,m.noofviews as NoOfViews,m.subscribe_validity as Validity,m.suscribed_on as AddedOn,m.payment_status,f.aboutme,f.mothertounge,f.Education_from,f.Occuaption_From,f.feet_from,f.inch_from,p.Addedon as RegisteredOn')->from('tbl_personel as p');
    $this->db->join('tbl_family as f','f.profile_code=p.profile_code','left');
    $this->db->join('countries as c','c.id = f.country','left');
    $this->db->join('countries as cu','cu.id = p.living_in','left');
    $this->db->join('countries as cn','cn.id = f.countryresidant_from','left');
    $this->db->join('tbl_money as m','m.profile_code=p.profile_code','left');
    $this->db->join('admin_packages as ap','m.package=ap.id OR m.package="-"','left');
    $this->db->join('states as st','st.id=f.state','left');
    $this->db->join('cities as ct','ct.id=f.city','left');
    $this->db->join('tbl_education as ed','ed.edu_id=f.edu','left');
    $this->db->join('tbl_occupation as occ','f.occu=occ.Occ_Id','left');
    $this->db->join('tbl_emplin as emp','f.empin=emp.emp_id','left');
    $this->db->join('tbl_rasi as ra','f.rasi=ra.rasi_id','left');
    $this->db->join('tbl_star as sta','f.star=sta.star_id','left');
	$this->db->join('language_tbl as l','l.L_ID = f.mothertounge','left');
    $this->db->where('p.profile_code',$profilecode);
    $data =  $this->db->get()->row();
         
       return $data;                
                       
}


public function edit_user($profilecode){
        $this->db->select('p.*,f.*,m.*');
        $this->db->from('tbl_personel as p');
        $this->db->join('tbl_family as f','f.profile_code=p.profile_code','left');
        $this->db->join('tbl_money as m','m.profile_code=p.profile_code','left'); 
        $this->db->where('p.profile_code',$profilecode);
        $data =  $this->db->get()->row();
       return $data;
}

public function updateUserProfile($personaldata,$familydata,$profilecode){
    
    
     $this->db->where(array('profile_code'=>$profilecode));
     $this->db->update('tbl_personel', $personaldata);
    
     $this->db->where(array('profile_code'=>$profilecode));
     $this->db->update('tbl_family', $familydata);
   
     return $this->db->affected_rows();
}

public function invoicedata($profilecode){
	 $this->db->select('CONCAT(p.fname,p.sname,p.lname) as Fullname,p.profile_code,f.address,ap.name as package,ap.price,ap.valid,m.subscribe_validity,p.receiptnumber')->from('tbl_personel as p');
	 $this->db->join('tbl_family as f','f.profile_code=p.profile_code','left');
     $this->db->join('tbl_money as m','m.profile_code=p.profile_code','left'); 
	 $this->db->join('admin_packages as ap','m.package=ap.id','left'); 
     $this->db->where('p.profile_code',$profilecode);
	  $data =  $this->db->get()->row();
       return $data;
	 
}
}
        