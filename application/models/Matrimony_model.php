  <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
  Module: Matrimony Model
  Author: Laxmi
  Created Date: 7/July/2017
 * */
class Matrimony_model extends CI_Model
{
  private $tablename = "";
 
  public function __construct(){
    parent::__construct();
    
  }
 
    
    public function getcountries(){
       return  $this->db->select('id,name,phonecode')->from('countries')->get()->result();
        
    }
    
     public function getEducation(){
       return $this->db->select('edu_id,education,edu_status,TrashStatus')->from('tbl_education')->where(array('edu_status'=>'1','TrashStatus'=>'0'))->order_by("education","ASC")->get()->result();
      
    }
    
     public function getOccupation(){
       return $this->db->select('*')->from('tbl_occupation')->where(array('Occ_status'=>'1','TrashStatus'=>'0'))->order_by("occupation","ASC")->get()->result();
      
    }
    
    public function getEmployeement(){
       return $this->db->select('*')->from('tbl_emplin')->where(array('emp_status'=>'1','TrashStatus'=>'0'))->get()->result();
      
    }
    
    public function getComplexion(){
       return $this->db->select('*')->from('tbl_complexion')->where(array('cmplex_status'=>'1'))->get()->result();
      
    }
    
    public function getBloodgroup(){
       return $this->db->select('*')->from('tbl_bldgrp')->where(array('bld_status'=>'1','TrashStatus'=>'0'))->get()->result();
      
    }
    
     public function getHeightList(){
       return $this->db->select('*')->from('tbl_feet')->where(array('ft_status'=>'1','TrashStatus'=>'0'))->get()->result();
      
    }
    public function getSpecialcase(){
       return $this->db->select('*')->from('tbl_spacial')->where(array('spl_status'=>'1','TrashStatus'=>'0'))->get()->result();
      
    }
    
    
    public function getRasi(){
       return $this->db->select('*')->from('tbl_rasi')->where(array('rasi_status'=>'1','TrashStatus'=>'0'))->get()->result();
      
    }
    
      public function getStar(){
       return $this->db->select('*')->from('tbl_star')->where(array('star_status'=>'1','TrashStatus'=>'0'))->get()->result();
      
    }

   public function getpackage(){
	   return $this->db->select('*')->from('admin_packages')->where(array('status'=>'1'))->get()->result();
	   }

 public function profileserialnum(){
	   return $this->db->select('MAX(sno) as Id')->from('profileserialnum')->get()->row();
	   }

 //check email   
    public function checkemail($email){  
        $query = $this->db->select('email')->from('tbl_personel')->where(array('email'=>$email))->get();   
	
        if($query->num_rows() > 0) {
          return 'success';
        }else{
           return 'fail';
        }
    }

 //check mobile number   
    
    public function checkmobile($mobile){  
        $query = $this->db->select('mobile')->from('tbl_personel')->where(array('mobile'=>$mobile))->get();   
        if($query->num_rows() > 0) {
          return 'success';
        }else{
           return 'fail';
        }
    }
    
     public function add_user($data,$family,$profilesnotable,$money){
        $result = $this->db->insert('tbl_personel',$data);
		$result1 = $this->db->insert('tbl_family',$family);
		$result2 = $this->db->insert('tbl_money',$money);
		$result3 = $this->db->insert('profileserialnum',$profilesnotable);
		
		if($result&&$result1&&$result2&&$result3){
			return true;
			}
      }
      
    
    
   //get states based on countries
     public function get_states($country){
        $this->db->select('*');
        $this->db->from('states');
        $this->db->where('country_id',$country);
        $query = $this->db->get();
        return $query->result();
    }
    
    
    //get cities based on state
     public function get_cities($state){
        $this->db->select('*');
        $this->db->from('cities');
        $this->db->where('state_id',$state);
        $query = $this->db->get();
        return $query->result();
    }
    
    //insert personal details into family table
    
    public function personalAdd($profilecode,$data){
       $this->db->where(array('profile_code'=>$profilecode));
       $this->db->update('tbl_family', $data);
       
        return $this->db->affected_rows();
        
    }
    //profile pics update
    public function profilepics($profilecode,$image){
        $this->db->set('b.image',$image['orgimage']);
        $this->db->where(array('b.profile_code'=>$profilecode));
        $this->db->update('tbl_family as b');
        return $this->db->affected_rows();
    }
 //add otp method
    public function addOtp($data){
        return $this->db->insert('otp',$data);
    }
    
//update required match
    public function addRequiredMatch($profilecode,$data){
       $this->db->where(array('profile_code'=>$profilecode));
       $this->db->update('tbl_family',$data);
       return $this->db->affected_rows(); 
        
    }
    
     //login function 
    public function login($username,$password){
       $count = $this->db->select('a.*,b.payment_status,b.noofviews,b.package')
               ->from('tbl_personel as a')
               ->join('tbl_money as b','a.profile_code = b.profile_code')
               ->where("(a.profile_code='$username' OR  a.mobile='$username' OR a.email='$username')")
               ->where('a.opwd',$password)
			   ->get();
       if($count->num_rows()==1){
        $row = $count->row(); 
		$profilestatus = $row->profile_status;
		if($profilestatus ==2){
			return "profilestatusfail";
			}
		else{	
		$user = array('username' => $username,'gender' => $row->gender,'profile_by'=>$row->profile_by,'payment_status'=>$row->payment_status,'name'=>$row->sname." ".$row->fname." ".$row->lname,'thumbimage'=>$row->thumbimage,'noofviews'=>$row->noofviews,'package'=>$row->package,'profilecode'=>$row->profile_code,'Profile_photo_Status'=>$row->Profile_photo_Status);
           $this->session->set_userdata('user',$user);
                   $data = array(
                    'last_login' => date('Y-m-d H:i:s'),
                     );
           $this->db->where('profile_code',$username);
           $this->db->update('tbl_personel', $data);
           return "success";
       }}
       else{
           return "error";
       }
                                                    
    }
 
    
    public function educationname(){
        $result = $this->db->select('*')->from('tbl_education')->get()->result();
        if($result){
            return $result;
        }
    }  
    
     public function occupationname(){
        $result = $this->db->select('*')->from('tbl_occupation')->get()->result();
        if($result){
            return $result;
        }
    }  
   
   //forgot password created by laxmi
   
   public function forgot_password($email){
	$result = $this->db->select('t.profile_code,t.opwd,CONCAT(t.sname,t.fname,t.lname)as Fullname')->from('tbl_personel as t')->get()->row();
	   if($result){
		   return $result;
	}
	   }
    
    public function save_package($profile_code,$money,$invoice){
	
		$result = $this->db->where(array('profile_code'=>$profile_code));
       				$this->db->update('tbl_money',$money);
       $result1 = $this->db->insert('invoice',$invoice);
		if($result && $result1){
			return true;
			}
		}

}

