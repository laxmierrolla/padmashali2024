 <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
  Module: Userdashboard Model
  Author: Laxmi
  Created Date: 29/October/2017
 * */
class Userdashboard_model extends CI_Model
{
  private $tablename = "";
 
  public function __construct(){
    parent::__construct();
    
  }
  
  public function userdata($profileid){ 
      $result = $this->db->select('a.*,b.*,e.education,o.occupation,f.*,ci.name as location,tm.*,ap.name as package')
                         ->from('tbl_personel as a')
                         ->join('tbl_family as f','a.profile_code = f.profile_code','left')
                         ->join('tbl_money as b','a.profile_code = b.profile_code','left')
                         ->join('tbl_education as e','e.edu_id = f.edu','left')
                         ->join('tbl_occupation as o','o.Occ_Id = f.occu','left')
                         ->join('cities as ci','ci.id = f.city','left')
                         ->join('tbl_money as tm','tm.profile_code = a.profile_code','left')
                         ->join('admin_packages as ap','ap.id =tm.package','left')
                         ->where(array('a.profile_code' =>$profileid))
                         ->get()->row(); 
       if($result){
           return $result;
           
       }
  }
  
   public function viewProfile($profilecode){
       $result = $this->db->select('p.*,f.*,e.education,o.occupation,c.name as county,s.name as stat,ci.name as cit,l.Language_Name as language,cu.name as living,em.employee,b.bldgroup,ts.spacial,st.star as stars,r.rasi as rasis,ct.name as countryresidant_from')
                ->from('tbl_personel as p')
                ->join('tbl_family as f','f.profile_code = p.profile_code','left')
                ->join('tbl_education as e','e.edu_id = f.edu','left')
                ->join('tbl_occupation as o','o.Occ_Id = f.occu','left')
                ->join('countries as c','c.id = f.country','left')
                ->join('countries as cu','cu.id = p.living_in','left')
                ->join('countries as ct','ct.id = f.countryresidant_from','left')
                ->join('states as s','s.id = f.state','left')
                ->join('cities as ci','ci.id = f.city','left')
                ->join('language_tbl as l','l.L_ID = f.mothertounge','left')
                ->join('tbl_emplin as em','em.emp_id = f.empin','left')
                ->join('tbl_bldgrp as b','b.bld_id = f.bldgrp','left')
                ->join('tbl_spacial as ts','ts.spl_id = f.splcases','left')
                ->join('tbl_star as st','st.star_id = f.star','left') 
                ->join('tbl_rasi as r','r.rasi_id = f.rasi','left')
                ->where(array('p.profile_code' => $profilecode))
                ->get()->row();

    if($result){
        return $result;
     }
    }                                                                                
  
  public function aboutmedata($profileid){
      $res = $this->db->select('aboutme')->from('tbl_family')->where(array('profile_code'=>$profileid))->get()->row();
      return $res;
  }
 public function aboutmeupdate($profileid,$data){
        $this->db->where(array('profile_code'=>$profileid));
        $this->db->update('tbl_family', $data);
        return $this->db->affected_rows();
 }                                                                                       
 public function basicdedata($profilecode){
     $res = $this->db->select('a.profile_by,a.ref_by,a.sname,a.fname,a.lname,a.gender,a.marital_status,a.dob,b.mothertounge,a.living_in,a.mobile,a.email,a.nochild,a.livig_status')
                        ->from('tbl_personel as a')
                        ->join('tbl_family as b','a.profile_code = b.profile_code')
                        ->where(array('a.profile_code'=>$profilecode))
                        ->get()->row();
                        return $res;
 }
 
 public function basicdupdate(){

     $profilecode = $this->input->post('profile_id');
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
            
            
            $phonecode = $this->input->post('phcode');
            $pcode = explode('_',$phonecode);
            $phncode = $pcode[1]."-";
       $data = array(
                      'profile_by'     =>  $this->input->post('profile_by'),
                      'ref_by'         =>  $this->input->post('reference') ,
                      'sname'          =>  $this->input->post('surname'),
                      'fname'          =>  $this->input->post('firstname'),
                      'lname'          =>  $this->input->post('lastname'),
                      'gender'         =>  $this->input->post('gender'),
                      'marital_status' =>  $this->input->post('maritalstatus'),
                      'dob'            =>  $this->input->post('dob'),
                      'living_in'      =>  $this->input->post('nationality'),
                       'mobile'        =>  $phncode.$this->input->post('umobile'),
                       'email'         =>  $this->input->post('email'),
                       'livig_status'  => $living_status,
                       'nochild'       => $nochilds,
                    );
        $this->db->where(array('profile_code'=>$profilecode));
        $this->db->update('tbl_personel', $data);
        $data1 = array('mothertounge'=>$this->input->post('mothertongue'));
        
      
        $data1 = array('mothertounge'=>$this->input->post('mothertongue'));
        $this->db->where(array('profile_code'=>$profilecode));
        $this->db->update('tbl_family', $data1);
        
        return $this->db->affected_rows();
       
 }
 
 public function physicaldata($profileid){
         $res = $this->db->select('feet,weight,cmplxion,bldgrp,splcases,dite,body_type,smoke,drink')
                        ->from('tbl_family')
                        ->where(array('profile_code'=>$profileid))
                        ->get()->row();
                        return $res;
 }
 
 public function  physicalupdate($pfid,$data){
       
       $this->db->where(array('profile_code'=>$pfid));
        $this->db->update('tbl_family', $data);
        return $this->db->affected_rows();
 }
 
 public function horodata($profileid){
       $res = $this->db->select('birth_place,hrs,mins,secs,period,birth_name,gowthram,rasi,star,paadam,horoscope,manglik')
                        ->from('tbl_family')
                        ->where(array('profile_code'=>$profileid))
                        ->get()->row();
                        return $res;
     
 }
 
 public function horoupdate($pfid,$data){
     $this->db->where(array('profile_code'=>$pfid));
        $this->db->update('tbl_family', $data);
        return $this->db->affected_rows();
 }
 
 
public function professionaldata($profileid){
    $res = $this->db->select('edu,edu_details,occu,occ_details,income,empin,employmentdetails')
                        ->from('tbl_family')
                        ->where(array('profile_code'=>$profileid))
                        ->get()->row();
                        return $res;
    
}

public function prfupdate($pfid,$data){
     $this->db->where(array('profile_code'=>$pfid));
     $this->db->update('tbl_family', $data);
     return $this->db->affected_rows();
    
}

public function contactsdata($profileid){
    $res = $this->db->select('address,phone,fmobile,res_status,country,state,city,perminantaddress,family_origin')
                        ->from('tbl_family')
                        ->where(array('profile_code'=>$profileid))
                        ->get()->row();
                        return $res;
    
}

public function contactupdate($prfid,$data){
     $this->db->where(array('profile_code'=>$prfid));
     $this->db->update('tbl_family', $data);
     return $this->db->affected_rows();
}

public function family_data($prfid){
    $res = $this->db->select('father_name,fa_alive,father_occupation,mother_name,ma_alive,mother_occupation,elder_bro,young_bro,elder_sis,young_sis,elder_bro1,young_bro1,elder_sis1,young_sis1,desc_family')
                        ->from('tbl_family')
                        ->where(array('profile_code'=>$prfid))
                        ->get()->row();
                        return $res;
    
}

public function familyupdate($prfid,$data){
     $this->db->where(array('profile_code'=>$prfid));
     $this->db->update('tbl_family', $data);
     return $this->db->affected_rows();
    
}

public function partner_data($prfid){
    $res = $this->db->select('look_for,age_from,age_to,countryresidant_from,feet_from,inch_from,Complexion_from,Education_from,Education_fromType,AnnualIncome_from,Occuaption_From,Occuaption_FromType')
                        ->from('tbl_family')
                        ->where(array('profile_code'=>$prfid))
                        ->get()->row();
                        return $res;
    
    
}
 //password checking
public function check_password($prfid,$password){
    $query = $this->db->select('opwd')->from('tbl_personel')->where(array('profile_code'=>$prfid,'opwd'=>$password))->get();
	
        if($query->num_rows() > 0) {
          return 'success';
        }else{
           return 'fail';
        }                                                                                                                                 
}
 
//update password 
public function upadtepass($profileid,$data){
    $this->db->where(array('profile_code'=>$profileid));
    $this->db->update('tbl_personel',$data);
    return $this->db->affected_rows(); 
}


     /*home menu count function added by laxmi (17-11-2017)   */
public function home_menu_count($profileid){
    $query1 = $this->db->select('COUNT(DISTINCT(vtbl.MyProfileId)) as pfcount')->from('viewedprofile_tbl as vtbl')->join('tbl_personel as p','vtbl.MyProfileId = p.profile_code')->where(array('vtbl.ViewedProfileId'=>$profileid))->get()->row();

    $query2 = $this->db->select('COUNT(*) as savecount')->from('savedprofile_tbl as stbl')->join('tbl_personel as p','stbl.	MyProfile_Code = p.profile_code')->where(array('PartnerProfile_Code'=>$profileid))->get()->row();
	
    $query3 = $this->db->select('COUNT(*) as mobilecount')->from('viewcontactdetails_tbl as vct')->join('tbl_personel as p','vct.VMyId = p.profile_code')->where(array('VParnerId'=>$profileid))->get()->row();
	
    $query4 = $this->db->select('COUNT(*) as meviewdmobilecount')->from('viewcontactdetails_tbl as vct')->join('tbl_personel as p','vct.VParnerId = p.profile_code')->where(array('VMyId'=>$profileid))->get()->row();
	
	 $query5 = $this->db->select('COUNT(*) as shortlistedcount')->from('savedprofile_tbl as stbl')->join('tbl_personel as p','stbl.PartnerProfile_Code = p.profile_code')->where(array('MyProfile_Code'=>$profileid))->get()->row();
	 
	  $query6 = $this->db->select('COUNT(*) as viewedprofiescount')->from('viewedprofile_tbl as vtbl')->join('tbl_personel as p','vtbl.ViewedProfileId = p.profile_code')->where(array('MyProfileId'=>$profileid))->get()->row();
    
    return array('viewed_myprofile'=>$query1->pfcount,'shortlisted_me'=>$query2->savecount,'viewd_mynumber'=>$query3->mobilecount,'numbersviewed'=>$query4->meviewdmobilecount,'shortlisted'=>$query5->shortlistedcount,'viewedprofies'=>$query6->viewedprofiescount);
    
}

 //patner prefences profiles author:Ashok
  public function getprefer_edu($gender,$edupreffer,$age)
	{
		$profileId = $this->session->userdata['user']['username'];
		
		$this->db->select('tp.*');
		$this->db->from('tbl_personel as tp');
		$this->db->where('tp.gender !=',$gender);
		if($edupreffer != NULL){
			$this->db->join('tbl_family as tf','tf.profile_code=tp.profile_code');
			$edu_where = "FIND_IN_SET( tf.edu,'".$edupreffer."')";
            $this->db->where( $edu_where );
			
		}
		
		if($gender=="Male")
		{
			
			$this->db->where('tp.age <',$age);
		}
		else{
			$this->db->where('tp.age >',$age);
			
		}
		$this->db->order_by('tp.id','RANDOM');
		$this->db->limit('5');
		$pre_list=$this->db->get();
		return $pre_list;
	}
	 public function getprefer_occu($gender,$ocupreffer,$age)
	{
		
		$this->db->select('tp.*');
		$this->db->from('tbl_personel as tp');
		$this->db->where('tp.gender !=',$gender);
		if($ocupreffer != NULL){
			$this->db->join('tbl_family as tf','tf.profile_code=tp.profile_code');
			//$this->db->where_in('tf.occu',$ocupreffer);
			$occ_where = "FIND_IN_SET( tf.occu,'".$ocupreffer."')";
            $this->db->where($occ_where);
		}
		if($gender=="Male")
		{
			
			$this->db->where('tp.age <',$age);
		}
		else{
			$this->db->where('tp.age >',$age);
			
		}
		$this->db->order_by('tp.id','RANDOM');
		$this->db->limit('5');
		$pre_list=$this->db->get();
		return $pre_list;
		
	}
	public function getviewdme($myprofileid)
	{
		$this->db->select('tp.*');
		$this->db->from('tbl_personel as tp');
		$this->db->join('viewedprofile_tbl as vtbl','tp.profile_code=vtbl.MyProfileId');
		$this->db->where('vtbl.ViewedProfileId',$myprofileid);
		
	$this->db->order_by('vtbl.View_Id','desc');
		$this->db->limit('5');
		$viewed_list=$this->db->get();
		return $viewed_list;
		
		
	}
     public function getrecent_profile($gender,$age)
	{
		
		$this->db->select('tp.*');
		$this->db->from('tbl_personel as tp');
		$this->db->where('tp.gender !=',$gender);
		//If need any other extra details to display join this table
		//$this->db->join('tbl_family as tf','tf.profile_code=tp.profile_code');
		if($gender=="Male")
		{
			
			$this->db->where('tp.age <',$age);
		}
		else{
			$this->db->where('tp.age >',$age);
			
		}
		$this->db->order_by('tp.id','desc');
		$this->db->limit('5');
		$pre_list=$this->db->get();
		return $pre_list;
		
	}
	//profiles with pagination
	public function getall_edupreferd($search){
		
		 $start = $search['start'];
		 $limit = $search['limit'];
	     $gender=$search['gender'];
	     $age=$search['age'];
		 $edupreffer=$search['edu_prefer'];
         $this->db->select('');
		$this->db->from('tbl_personel as tp');
		$this->db->where('tp.gender !=',$gender);
		$this->db->join('tbl_family as tf','tf.profile_code=tp.profile_code','left');
		$this->db->join('tbl_money as tm','tm.profile_code=tp.profile_code','left');
			if($edupreffer != NULL){
				$edu_where = "FIND_IN_SET( tf.edu,'".$edupreffer."')";
            $this->db->where( $edu_where );
			//$this->db->where_in('tf.Education_from',$edupreffer);
		}
		if($gender=="Male")
		{
			
			$this->db->where('tp.age <',$age);
		}
		else{
			$this->db->where('tp.age >',$age);
			
		}
		$this->db->order_by('tp.id','desc');
		$this->db->limit($limit,$start);
        $profilelist = $this->db->get();
        $this->db->select('count(tp.id) as ttl_rows');
		$this->db->from('tbl_personel as tp');
		$this->db->where('tp.gender !=',$gender);
		if($edupreffer != NULL){
			$this->db->join('tbl_family as tf','tf.profile_code=tp.profile_code');
			$edu_where = "FIND_IN_SET( tf.edu,'".$edupreffer."')";
            $this->db->where( $edu_where );
		}
		if($gender=="Male")
		{
			
			$this->db->where('tp.age <',$age);
		}
		else{
			$this->db->where('tp.age >',$age);
			
		}
        $row = $this->db->get()->row();
        $profilelist->ttl_rows = $row->ttl_rows;
        return $profilelist;
		
	}
	
	//get all occupation preffered
	
	public function getall_occpreferd($search){
		
		$start = $search['start'];
		$limit = $search['limit'];
	    $gender=$search['gender'];
	    $age=$search['age'];
		$occpreffer=$search['occ_prefer'];
        $this->db->select('');
		$this->db->from('tbl_personel as tp');
		$this->db->where('tp.gender !=',$gender);
		$this->db->join('tbl_family as tf','tf.profile_code=tp.profile_code','left');
		$this->db->join('tbl_money as tm','tm.profile_code=tp.profile_code','left');
		if($occpreffer != NULL){
			$occu_where = "FIND_IN_SET( tf.occu,'".$occpreffer."')";
            $this->db->where( $occu_where );
		}
		if($gender=="Male")
		{
			
			$this->db->where('tp.age <',$age);
		}
		else{
			$this->db->where('tp.age >',$age);
		}
		$this->db->order_by('tp.id','desc');
		$this->db->limit($limit,$start);
        $profilelist = $this->db->get();
        $this->db->select('count(tp.id) as ttl_rows');
		$this->db->from('tbl_personel as tp');
		$this->db->where('tp.gender !=',$gender);
		if($occpreffer != NULL){
			$this->db->join('tbl_family as tf','tf.profile_code=tp.profile_code');
			$occu_where = "FIND_IN_SET( tf.occu,'".$occpreffer."')";
            $this->db->where( $occu_where );
		}
		if($gender=="Male")
		{
			$this->db->where('tp.age <',$age);
		}
		else{
			$this->db->where('tp.age >',$age);
		}
        $row = $this->db->get()->row();
        $profilelist->ttl_rows = $row->ttl_rows;
        return $profilelist;
		
	}
	
	
	//get all People joined recently
	
	public function getall_recently($search){
		$start = $search['start'];
		$limit = $search['limit'];
	    $gender=$search['gender'];
	    $age=$search['age'];
		$this->db->select('');
		$this->db->from('tbl_personel as tp');
		$this->db->where('tp.gender !=',$gender);
		$this->db->join('tbl_family as tf','tf.profile_code=tp.profile_code','left');
		$this->db->join('tbl_money as tm','tm.profile_code=tp.profile_code','left');
		
		if($gender=="Male"){
			$this->db->where('tp.age <',$age);
		}
		else{
			$this->db->where('tp.age >',$age);
		}
		$this->db->order_by('tp.id','desc');
		$this->db->limit($limit,$start);
        $profilelist = $this->db->get();
        
        $this->db->select('count(tp.id) as ttl_rows');
		$this->db->from('tbl_personel as tp');
		$this->db->where('tp.gender !=',$gender);
		if($gender=="Male"){
			$this->db->where('tp.age <',$age);
		}
		else{
			$this->db->where('tp.age >',$age);
		}
        $row = $this->db->get()->row();
        $profilelist->ttl_rows = $row->ttl_rows;
        return $profilelist;
		
	}
	
 /*viewed my profile    */
public function viewedMyProfile($search){
	$start = $search['start'];
	$limit = $search['limit'];$profileId = $search['profileId'];
		
      $this->db->select('');
		$this->db->from('tbl_personel as tp');
		$this->db->join('viewedprofile_tbl as vtbl','tp.profile_code = vtbl.MyProfileId','left');
		$this->db->join('tbl_family as tf','tf.profile_code=tp.profile_code','left');
		$this->db->join('tbl_money as tm','tm.profile_code=tp.profile_code','left');
		$this->db->where('vtbl.ViewedProfileId',$profileId);
		$this->db->order_by('vtbl.View_Id','desc');
		$this->db->limit($limit,$start);
        $profilelist = $this->db->get();
		
		$this->db->select('count(vtbl.View_ID) as ttl_rows');
		$this->db->from('tbl_personel as tp');
		$this->db->join('viewedprofile_tbl as vtbl','tp.profile_code = vtbl.MyProfileId','left');
		$this->db->where('vtbl.ViewedProfileId',$profileId);
		
        $row = $this->db->get()->row();
        $profilelist->ttl_rows = $row->ttl_rows;
        return $profilelist;
    
} 

/*short listed my profile  created by laxmi   */
public function shortlisted_me($search){
	$start = $search['start'];
	$limit = $search['limit'];
	$profileId = $search['profileId'];
		
      $this->db->select('');
		$this->db->from(' tbl_personel as tp');
		$this->db->join('savedprofile_tbl as stbl','tp.profile_code =stbl.MyProfile_Code','left');
		$this->db->join('tbl_family as tf','tf.profile_code=tp.profile_code','left');
		$this->db->join('tbl_money as tm','tm.profile_code=tp.profile_code','left');
		$this->db->where('stbl.PartnerProfile_Code',$profileId);
		$this->db->order_by('stbl.Saved_Id','desc');
		$this->db->limit($limit,$start);
        $profilelist = $this->db->get();
		
		$this->db->select('count(stbl.Saved_Id) as ttl_rows');
		$this->db->from(' tbl_personel as tp');
		$this->db->join('savedprofile_tbl as stbl','tp.profile_code =stbl.MyProfile_Code','left');
		$this->db->where('stbl.PartnerProfile_Code',$profileId);
		
        $row = $this->db->get()->row();
        $profilelist->ttl_rows = $row->ttl_rows;
        return $profilelist;
    
} 

/*viewed my mobilenumber  created by laxmi */
public function viewed_mymobileno($search){
	$start = $search['start'];
	$limit = $search['limit'];
	$profileId = $search['profileId'];
		
      $this->db->select('');
		$this->db->from('tbl_personel as tp');
		$this->db->join('viewcontactdetails_tbl as vctbl','tp.profile_code=vctbl.VMyId ','left');
		$this->db->join('tbl_family as tf','tf.profile_code=tp.profile_code','left');
		$this->db->join('tbl_money as tm','tm.profile_code=tp.profile_code','left');
		$this->db->where('vctbl.VParnerId',$profileId);
		$this->db->order_by('vctbl.VId','desc');
		$this->db->limit($limit,$start);
        $profilelist = $this->db->get();
		
		$this->db->select('count(vctbl.VId) as ttl_rows');
		$this->db->from('tbl_personel as tp');
		$this->db->join('viewcontactdetails_tbl as vctbl','tp.profile_code=vctbl.VMyId ','left');
		$this->db->where('vctbl.VParnerId',$profileId);
		
        $row = $this->db->get()->row();
        $profilelist->ttl_rows = $row->ttl_rows;
        return $profilelist;
    
} 

/*viewed others profile created by laxmi   */
public function viewed_profiles($search){
	$start = $search['start'];
	$limit = $search['limit'];$profileId = $search['profileId'];
		
        $this->db->select('');
		$this->db->from('tbl_personel as tp');
		$this->db->join('viewedprofile_tbl as vtbl','tp.profile_code =vtbl.ViewedProfileId','left');
		$this->db->join('tbl_family as tf','tf.profile_code=tp.profile_code','left');
		$this->db->join('tbl_money as tm','tm.profile_code=tp.profile_code','left');
		$this->db->where('vtbl.MyProfileId',$profileId);
		$this->db->order_by('vtbl.View_Id','desc');
		$this->db->limit($limit,$start);
        $profilelist = $this->db->get();
		
		$this->db->select('count(vtbl.View_Id) as ttl_rows');
		$this->db->from('tbl_personel as tp');
		$this->db->join('viewedprofile_tbl as vtbl','tp.profile_code =vtbl.ViewedProfileId','left');
		$this->db->where('vtbl.MyProfileId',$profileId);
		
        $row = $this->db->get()->row();
        $profilelist->ttl_rows = $row->ttl_rows;
        return $profilelist;
    
} 

/*short listed profiles  created by laxmi   */
public function shorlisted_profiles($search){
	$start = $search['start'];
	$limit = $search['limit'];
	$profileId = $search['profileId'];
		
      $this->db->select('');
		$this->db->from('tbl_personel as tp');
		$this->db->join('savedprofile_tbl as stbl','tp.profile_code = stbl.PartnerProfile_Code','left');
		$this->db->join('tbl_family as tf','tf.profile_code=tp.profile_code','left');
		$this->db->join('tbl_money as tm','tm.profile_code=tp.profile_code','left');
		$this->db->where('stbl.MyProfile_Code',$profileId);
		$this->db->order_by('stbl.Saved_Id','desc');
		$this->db->limit($limit,$start);
        $profilelist = $this->db->get();
		
		$this->db->select('count(stbl.Saved_Id) as ttl_rows');
		$this->db->from('tbl_personel as tp');
		$this->db->join('savedprofile_tbl as stbl','tp.profile_code = stbl.PartnerProfile_Code','left');
		$this->db->where('stbl.MyProfile_Code',$profileId);
		
        $row = $this->db->get()->row();
        $profilelist->ttl_rows = $row->ttl_rows;
        return $profilelist;
    
} 

/*viewed my mobilenumber  created by laxmi */
public function viewed_mobilenos($search){
	$start = $search['start'];
	$limit = $search['limit'];
	$profileId = $search['profileId'];
		
        $this->db->select('');
		$this->db->from('tbl_personel as tp');
		$this->db->join('viewcontactdetails_tbl as vctbl','tp.profile_code=vctbl.VParnerId','left');
		$this->db->join('tbl_family as tf','tf.profile_code=tp.profile_code','left');
		$this->db->join('tbl_money as tm','tm.profile_code=tp.profile_code','left');
		$this->db->where('vctbl.VMyId',$profileId);
		$this->db->order_by('vctbl.VId','desc');
		$this->db->limit($limit,$start);
        $profilelist = $this->db->get();
		
		$this->db->select('count(vctbl.VId) as ttl_rows');
		$this->db->from('tbl_personel as tp');
		$this->db->join('viewcontactdetails_tbl as vctbl','tp.profile_code=vctbl.VParnerId','left');
		$this->db->where('vctbl.VMyId',$profileId);
		
        $row = $this->db->get()->row();
        $profilelist->ttl_rows = $row->ttl_rows;
        return $profilelist;
    
} 

//prefered matches created by laxmi
public function getprefer_matches($data){
	
		$gender = $data->gender;
		$lookingfor = $data->look_for;
		$country = $data->country;
		$fromage = $data->age_from;
		$toage = $data->age_to;
		$complexion = $data->Complexion_from;
		$education = $data->Education_from;
		$occupation = $data->Occuaption_From;
		$annualincome = $data->AnnualIncome_from;
		
		$this->db->select('tp.*',FALSE);
		$this->db->from('tbl_personel as tp');
		$this->db->where('tp.gender !=',$gender);
		$this->db->join('tbl_family as tf','tf.profile_code=tp.profile_code');
		if(!is_null($fromage) && !empty($fromage))
		{			
		   $this->db->where('tp.age >',$fromage);
		 }
		if(!is_null($toage) && !empty($toage))
		{			
		   $this->db->where('tp.age <',$toage); 
		 } 
		 if(!is_null($country) && !empty($country))
		{			
		   $this->db->where('tf.country',$country);
		 } 
		if(!is_null($complexion) && !empty($complexion))
		{			
		   $this->db->where('tf.cmplxion',$complexion);
		 } 
		if(!is_null($annualincome) && !empty($annualincome))
		{			
		   $this->db->where('tf.income',$annualincome);
		 }  
		if(!is_null($lookingfor) && !empty($lookingfor))
		{
			$looking_where = "FIND_IN_SET(tp.marital_status,'".$lookingfor."')";
		    $this->db->where( $looking_where );
		} 
		if(!is_null($education) && !empty($education))
		{
			$edu_where = "FIND_IN_SET(tf.edu,'".$education."')";
            $this->db->where( $edu_where );
		} 
		/*if(!is_null($occupation) && !empty($occupation))
		{
			$occ_where = "FIND_IN_SET(tf.occu,'".$occupation."')";
            $this->db->where( $occ_where );
            
		}  */
		
		$this->db->order_by('tp.id','RANDOM');
		$this->db->limit('5');
		$pre_list=$this->db->get();
		return $pre_list;
		}
		
	
//get all prefferred matches created by laxmi	
	public function getall_preferdmatches($search){
		
		$start = $search['start'];
		$limit = $search['limit'];
	    $gender=$search['gender'];
	    $fromage=$search['fromage'];
		$toage=$search['toage'];
		$lookingfor=$search['lookingfor'];
		$country=$search['country'];
		$complexion=$search['complexion'];
		$education=$search['education'];
		$occupation=$search['occupation'];
		$annualincome=$search['annualincome'];
		       
        $this->db->select('');
		$this->db->from('tbl_personel as tp');
		$this->db->where('tp.gender !=',$gender);
		$this->db->join('tbl_family as tf','tf.profile_code=tp.profile_code','left');
		$this->db->join('tbl_money as tm','tm.profile_code=tp.profile_code','left');
		
		
		if(!is_null($fromage) && !empty($fromage))
		{			
		   $this->db->where('tp.age >',$fromage);
		 }
		if(!is_null($toage) && !empty($toage))
		{			
		   $this->db->where('tp.age <',$toage);
		 } 
		 if(!is_null($country) && !empty($country))
		{			
		   $this->db->where('tf.country',$country);
		 } 
		/*if(!is_null($complexion) && !empty($complexion))
		{			
		   $this->db->or_where('tf.cmplxion',$complexion);
		 } */
		if(!is_null($annualincome) && !empty($annualincome))
		{			
		   $this->db->or_like('tf.income',$annualincome,'both');
		 }  
		if(!is_null($lookingfor) && !empty($lookingfor))
		{
			$looking_where = "FIND_IN_SET(tp.marital_status,'".$lookingfor."')";
		    $this->db->where( $looking_where );
		} 
		if(!is_null($education) && !empty($education))
		{
			$edu_where = "FIND_IN_SET(tf.edu,'".$education."')";
            $this->db->or_where( $edu_where );
		} 
		/*if(!is_null($occupation) && !empty($occupation))
		{
			$occ_where = "FIND_IN_SET(tf.occu,'".$occupation."')";
            $this->db->or_where( $occ_where );
            
		}  */
		
		$this->db->order_by('tp.id','desc');
		$this->db->limit($limit,$start);
        $profilelist = $this->db->get();
        
		
        $this->db->select('count(tp.id) as ttl_rows');
		$this->db->from('tbl_personel as tp');
		$this->db->join('tbl_family as tf','tf.profile_code=tp.profile_code','left');
		$this->db->where('tp.gender !=',$gender);
		$this->db->group_start();
		if(!is_null($fromage) && !empty($fromage))
		{			
		   $this->db->where('tp.age >',$fromage);
		 }
		if(!is_null($toage) && !empty($toage))
		{			
		   $this->db->where('tp.age <',$toage);
		 } 
		 if(!is_null($country) && !empty($country))
		{			
		   $this->db->where('tf.country',$country);
		 } 
		/*if(!is_null($complexion) && !empty($complexion))
		{			
		   $this->db->or_where('tf.cmplxion',$complexion);
		 } */
		if(!is_null($annualincome) && !empty($annualincome))
		{			
		   $this->db->like('tf.income',$annualincome,'both');
		 }  
		if(!is_null($lookingfor) && !empty($lookingfor))
		{
			$looking_where = "FIND_IN_SET(tp.marital_status,'".$lookingfor."')";
		    $this->db->where( $looking_where );
		} 
		/*if(!is_null($education) && !empty($education))
		{
			$edu_where = "FIND_IN_SET('".$education."', tf.edu)";
            $this->db->or_where( $edu_where );
		} 
		if(!is_null($occupation) && !empty($occupation))
		{
			$occ_where = "FIND_IN_SET('".$occupation."', tf.occu)";
            $this->db->or_where( $occ_where );
            
		}*/
		 $this->db->group_end();
        $row = $this->db->get()->row();
        $profilelist->ttl_rows = $row->ttl_rows;
        return $profilelist;
		
	}


/*short listed profilescodes for view page  created by laxmi   */
public function shorlisted_profilescodes($profileid){
      $this->db->select('PartnerProfile_Code as partnercode');
	  $this->db->from('savedprofile_tbl as stbl');
	  $this->db->where('stbl.MyProfile_Code',$profileid);
      $partnercodes = $this->db->get()->result();
      return $partnercodes;
} 

public function sent_intrst_profilescodes($profileid){
      $this->db->select('ToProfileId as partnerids');
	  $this->db->from('message_tbl as stbl');
	  $this->db->where(array('stbl.FromProfileId'=>$profileid,'stbl.sent'=>1));
      $intrstcodes = $this->db->get()->result();
      return $intrstcodes;
} 


//insert shorlisted profiles created by laxmi
public function shortlist_profile($data){
	return $this->db->insert('savedprofile_tbl',$data);
	}
//view partner contacts created by laxmi

public function view_partnercontacts($profileId,$contactcode){
	         $this->db->select('tp.mobile,tp.email');
	         $this->db->from('tbl_personel as tp');
			 $this->db->where('tp.profile_code',$profileId);
			 $result = $this->db->get();
			 if($result->num_rows() > 0){
				 $contacts =$result->row();
				  $this->db->select('vtb.VParnerId');
	              $this->db->from('viewcontactdetails_tbl as vtb');
			      $this->db->where('vtb.VMyId',$profileId);
			      $result1 = $this->db->get();
				   if($result1->num_rows() > 0){
					   return $contacts;
					   }
				  else{
					 $data = array(
				     'VMyId'=>$profileId,
					 'VParnerId'=>$contactcode,
					 'VDate'=>date('Y-m-d H:i:s'),
				     );
				   $res =  $this->db->insert('viewcontactdetails_tbl',$data);
				 if($res){
					 return $contacts;
					 }
					 }    
				 
				 }
	
	}	
	
//get dlete reasons

public function get_delete_reason(){
	return $this->db->select('*')->from('request_questions')->where('RequestStatus',1)->get()->result();
	}	
//get data for cancelled account
public function get_data_by_id($profilecode){
	return $this->db->select('email,mobile')->from('tbl_personel')->where('profile_code',$profilecode)->get()->row();
	}
	public function delete_account($data,$data1,$profilecode){
		$res = $this->db->where(array('profile_code'=>$profilecode));
               $this->db->update('tbl_personel', $data1);
		$res1 = $this->db->insert('cancelaccount_tbl',$data) ;
		if($res && $res1 ) {
			    return true;
			} 
     
		
		}	
		
		
// send interest 
public function send_intrest($data){
	return $this->db->insert('message_tbl',$data);
	}
	
	public function delete_message($messageid, $data){
		
		$query = $this->db->where_in('MessageId', $messageid);
		         $this->db->update('message_tbl', $data);
        return $query;
		
		} 
            //ashok get_images
public function get_images($image_type,$profileid){
	
	
	
	 $image_list=$this->db->select('*')->from('user_images')->where(array('profile_id'=>$profileid,'image_type'=>$image_type))->get();
	return $image_list;
}
public function get_default_images($profileid){
	
	 $image_list=$this->db->select('*')->from('user_images')->where(array('profile_id'=>$profileid,'is_default_img'=>1))->get()->row_array();
	return $image_list;
}





	//get protect status
public function get_protect_status($prfid)
{
    $query = $this->db->select('Photoprotect')->from('tbl_personel')->where('profile_code',$prfid)->get()->row();
	
       
          return $query;
                                                                                                                                       
}
//send photo request ashok

public function send_photorequest($request){
	
	return $status=$this->db->insert('notifications',$request);
}
public function get_photorequest($prfid){
	
	return $query = $this->db->select('')->from('notifications')->where('notify_from',$prfid)->get()->num_rows();
}
//ashok notify
public function get_notify($profileid){
      $this->db->select('');
	  $this->db->from('notifications');
	  $this->db->where('notify_to',$profileid);
	  
	  
		$this->db->where('is_seen',0);  
	  
	   
      $notifications = $this->db->get();
      return $notifications;
}
public function get_notifylist($profileid){
	
	    $this->db->select('*');
	  $this->db->from('notifications');
	  $this->db->where('notify_to',$profileid);
	   
     return $notifications = $this->db->get();
	  
       
	
	
	
}

}