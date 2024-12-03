 <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
  Module: Admin Model
   Author: Laxmi
  Created Date: 20/December/2017
 * */
class Admin_model extends CI_Model
{
  
  public function __construct(){
    parent::__construct();
    
  }
   //admin login function 
    public function admin_login($username,$password){
       $count = $this->db->select('*')
               ->from('admin as a')
               ->where("(a.uname='$username' OR  a.mail_id='$username' OR a.mobile='$username')")
               ->where('psw',$password)
               ->get();
       if($count->num_rows()==1){
        $row = $count->row(); 
		$admindata = array('uname' => $row->uname,'mail_id' => $row->mail_id,'admintype'=>$row->admintype);
           $this->session->set_userdata('admindata',$admindata);
           return true;
       }
       else{
           return false;
       }
                                                    
    }
	
	//get userdetails 
	public function get_userdetails($pfcode){
		$query = $this->db->select('tp.fname,tp.sname,tp.lname,tp.profile_code,tp.email')->from('tbl_personel as tp')->where("(tp.profile_code='$pfcode' OR tp.email='$pfcode')")->get();
		
			if($query->num_rows()==1){
			$row = $query->row();	
			$result = $this->db->select('*,COUNT(*) as numberscount')
								->from('tbl_money as tm')
								->join('viewcontactdetails_tbl as vct','tm.profile_code = vct.VMyId','left')
								->where("tm.profile_code='$row->profile_code'")->get()->row();
			$pending = $result->noofviews-$result->numberscount	;
			$name= 	$row->sname.$row->fname.$row->lname;	
			$userdata = array('name'=>$name,'email'=>$row->email,'profilecode'=>$row->profile_code,'noOfviews'=>$result->noofviews,'subscriptionValid'=>$result->subscribe_validity,'viewed'=>$result->numberscount,'pending'=>$pending);
			return $userdata;
			}
		else{
			return false;
			}
		
		}
		
    // get user package 
	 public function get_userpackage($package){
	   return $this->db->select('*')->from('admin_packages')->where('id',$package)->get()->row();
	   }
	   
	 //update package  
	 public function upadate_package($profilecode,$data,$invoice){
	   $result =  $this->db->where(array('profile_code'=>$profilecode));
        	      $this->db->update('tbl_money', $data);
           if($result){
		return $this->db->insert('invoice',$invoice);
	    }
    
	   }
	 
	 //get all married accounts 
	public function getAllMarried($pdata, $getcount=NULL)
    {

        $tabelcolumns = array(
		    0 => 'id',
            1 => 'profile_code',
            2 => 'sname',
            3 => 'email',
			4 =>'mobile',
			
        );

       $search_1 = array(
	        1=>'profile_code',
            2 =>'email',
			3 =>'mobile',
        );
        
        //count of records
        if($getcount){ 
            $this->db->select('profile_code,mobile,email,fname,lname,sname')->from('tbl_personel');
			$this->db->where('marriedstatus',1);
			
           }
		else{
            $this->db->select('profile_code,mobile,email,fname,lname,sname')->from('tbl_personel');
			$this->db->where('marriedstatus',1);
			
        }
        if(isset($pdata['search_text1'])&& $pdata['search_text1']!=""){
           $this->db->like($search_1[$pdata['search_on_1']], $pdata['search_text1'] );
        }
		
        if($getcount){
            return $this->db->get()->num_rows();
        }
        //for records
        $perpage = $pdata['length'];
        $limit = $pdata['start'];

        $orderby_field = $tabelcolumns[$pdata['order'][0]['column']]; 
        $orderby = $pdata['order']['0']['dir'];

        $generatesno = $limit+1;
        $this->db->order_by($orderby_field,$orderby);
        $query = $this->db->limit($perpage,$limit);
		
        $allmarriedaccounts = $query->get()->result_array();
        
        foreach($allmarriedaccounts as $key=>$values){
            $allmarriedaccounts[$key]['sno'] = $generatesno++;
			$allmarriedaccounts[$key]['profile_code'] = $allmarriedaccounts[$key]['profile_code'];
            $allmarriedaccounts[$key]['Name'] = $allmarriedaccounts[$key]['sname'].$allmarriedaccounts[$key]['fname'].$allmarriedaccounts[$key]['lname'];
            $allmarriedaccounts[$key]['Email'] = $allmarriedaccounts[$key]['email'];
            $allmarriedaccounts[$key]['Mobile'] = $allmarriedaccounts[$key]['mobile'];
        }
        return $allmarriedaccounts;
    } 
	   
	//get all emails
	public function getAllEmails($pdata, $getcount=NULL){
		
        $tabelcolumns = array(
		    0 => 'Id',
            1 => 'Email',

        );

       $search_1 = array(
	        1=>'Email',
        );
        
        //count of records
        if($getcount){ 
            $this->db->select('*')->from('email');
			
			
           }
		else{
            $this->db->select('*')->from('email');
		
        }
        if(isset($pdata['search_text1'])&& $pdata['search_text1']!=""){
           $this->db->like($search_1[1], $pdata['search_text1'] );
        }
		
        if($getcount){
            return $this->db->get()->num_rows();
        }
        //for records
        $perpage = $pdata['length'];
        $limit = $pdata['start'];

        $orderby_field = $tabelcolumns[$pdata['order'][0]['column']]; 
        $orderby = $pdata['order']['0']['dir'];

        $generatesno = $limit+1;
        $this->db->order_by($orderby_field,$orderby);
        $query = $this->db->limit($perpage,$limit);
		
        $allemails = $query->get()->result_array();
        
        foreach($allemails as $key=>$values){
            $allemails[$key]['sno'] = $generatesno++;
			$allemails[$key]['Id'] = $allemails[$key]['Id'];
			$allemails[$key]['Email'] = $allemails[$key]['Email'];
            
        }
        return $allemails;
		}
		
	//add userprofile
	
	public function saveUserProfile($pdata,$fdata,$tmdata,$invoice,$profilenums){
      
		$result = $this->db->insert('tbl_personel',$pdata);
		$result1 = $this->db->insert('tbl_family',$fdata);
		$result2 = $this->db->insert('tbl_money',$tmdata);
		$result3 = $this->db->insert('invoice',$invoice);
		$result4 = $this->db->insert('profileserialnum',$profilenums);
		
		if($result&&$result1&&$result2&&$result3&&$result4){
			return true;
			}
		}
		
	//get all canceled
	public function getAllCanceled($pdata, $getcount=NULL){
		
        $tabelcolumns = array(
		    0 => 'id',
            1 => 'Cancel_Email',
            2 => 'Cancel_Reason',
            3 => 'Cancel_ProfileCode',
			4 =>'Cancel_Mobile',
			5=>'CancelReasinFrom'
        );

       $search_1 = array(
	        1=>'Cancel_ProfileCode',
            2 =>'Cancel_Email',
			3 =>'Cancel_Mobile',
        );
        
        //count of records
        if($getcount){ 
            $this->db->select('id,Cancel_Email,Cancel_Reason,Cancel_ProfileCode as profilecode,Cancel_Mobile,CancelReasinFrom')->from('cancelaccount_tbl');
			
			
           }
		else{
            $this->db->select('id,Cancel_Email,Cancel_Reason,Cancel_ProfileCode as profilecode,Cancel_Mobile,CancelReasinFrom')->from('cancelaccount_tbl');
		
        }
        if(isset($pdata['search_text1'])&& $pdata['search_text1']!=""){
           $this->db->like($search_1[$pdata['search_on_1']], $pdata['search_text1'] );
        }
		
        if($getcount){
            return $this->db->get()->num_rows();
        }
        //for records
        $perpage = $pdata['length'];
        $limit = $pdata['start'];

        $orderby_field = $tabelcolumns[$pdata['order'][0]['column']]; 
        $orderby = $pdata['order']['0']['dir'];

        $generatesno = $limit+1;
        $this->db->order_by($orderby_field,$orderby);
        $query = $this->db->limit($perpage,$limit);
		
        $allcanceledaccounts = $query->get()->result_array();
        
        foreach($allcanceledaccounts as $key=>$values){
            $allcanceledaccounts[$key]['sno'] = $generatesno++;
			$allcanceledaccounts[$key]['Email'] = $allcanceledaccounts[$key]['Cancel_Email'];
            $allcanceledaccounts[$key]['Reason'] = $allcanceledaccounts[$key]['Cancel_Reason'];
            $allcanceledaccounts[$key]['Profilecode'] = $allcanceledaccounts[$key]['profilecode'];
            $allcanceledaccounts[$key]['Mobile'] = $allcanceledaccounts[$key]['Cancel_Mobile'];
			$allcanceledaccounts[$key]['Cancelreason'] = $allcanceledaccounts[$key]['CancelReasinFrom'];
        }
        return $allcanceledaccounts;
		}
  
  public function check_email($email){
	  	$query = $this->db->select('Email')->from('email')->where(array('Email'=>$email))->get();   
        if($query->num_rows() > 0) {
          return 'success';
        }else{
           return 'fail';
        }
	  }
		
	//Save Emails
	public function saveEmail($data){
		return $this->db->insert('email',$data);
		
	}	
	
	//delete emails
	
	public function delete_email($email){
		$query = $this->db->where_in('Id', $email);
		          $this->db->delete('email');
		
		return $query;
        
		} 
 //restore profile
 public function restore_profile($id,$profilecode){
		 $data =array(
				 'profile_status'=>1,
				);
			
			
	 	$res1 = $this->db->where('profile_code',$profilecode);
		        $this->db->update('tbl_personel',$data);
		if($res1){
	    $res = $this->db->where('id',$id);
	        $this->db->delete('cancelaccount_tbl');
		}
		 }	

//delete profile
public function delete_profile($profilecode){
$this->db->delete('tbl_personel', array('profile_code' => $profilecode));
$this->db->delete('tbl_family', array('profile_code' => $profilecode));
$this->db->delete('tbl_money', array('profile_code' => $profilecode));
}

//get recent users
public function get_recent_users(){
    $result = $this->db->select('fname,lname,sname,gender,email,profile_code')->from('tbl_personel')->order_by("id", "desc")->limit(5)->get()->result();
    if($result){
        return $result;
    }
}

//get today users
public function get_today_users(){
    $today = date('Y-m-d');
    $todayusers = array();
    $result = $this->db->select('p.fname,p.lname,p.sname,p.gender,p.email,p.profile_code,m.subscribe_validity,m.payment_status')
                        ->from('tbl_personel as p')
                        ->join('tbl_money as m','p.profile_code = m.profile_code')
                        ->where("Addedon LIKE '%$today%'")
                        ->order_by("p.id", "desc")->get();
    $count = $result->num_rows();

    if($count > 0){
        $todayusers[] = $result->result_array();
        $todayusers['count'] = $count;
    }
    else{
       $todayusers['message'] = "Today no registrations done";
       $todayusers['count'] = $count;
    }
     return $todayusers;
}

//get male users
public function male_users_count(){
    $male = array();
    $total = $this->db->select('count(id) as total')->from('tbl_personel')->where('gender','Male')->get()->row();
    $active = $this->db->select('count(id) as active')->from('tbl_personel')->where(array('gender'=>'Male','profile_status'=>'1'))->get()->row();
    $inactive = $this->db->select('count(id) as inactive')->from('tbl_personel')->where(array('gender'=>'Male','profile_status'=>'0'))->get()->row();
    if($total && $active && $inactive){
        $male['total'] = $total->total;
        $male['active'] = $active->active;
        $male['inactive'] = $inactive->inactive;
        
        return $male;
    }
    
}

//female userscount
public function female_users_count(){
    $female = array();
    $total = $this->db->select('count(id) as total')->from('tbl_personel')->where('gender','Female')->get()->row();
    $active = $this->db->select('count(id) as active')->from('tbl_personel')->where(array('gender'=>'Female','profile_status'=>'1'))->get()->row();
    $inactive = $this->db->select('count(id) as inactive')->from('tbl_personel')->where(array('gender'=>'Female','profile_status'=>'0'))->get()->row();
    if($total && $active && $inactive){
        $female['total'] = $total->total;
        $female['active'] = $active->active;
        $female['inactive'] = $inactive->inactive;
        return $female;
    }
    
}

public function membership_count(){
    $membership =array();
    $offline = $this->db->select('count(p.profile_code) as offline')->from('tbl_personel as p')->join('tbl_money as m','p.profile_code = m.profile_code','left')->where(array('m.payment_status'=>'3','p.addedby'=>'ADMIN'))->get()->row();
    $online = $this->db->select('count(p.profile_code) as online')->from('tbl_personel as p')->join('tbl_money as m','p.profile_code = m.profile_code','left')->where(array('m.payment_status'=>'3','p.addedby'=>'SELF'))->get()->row();
    $free = $this->db->select('count(p.profile_code) as free')->from('tbl_personel as p')->join('tbl_money as m','p.profile_code = m.profile_code','left')->where(array('m.payment_status'=>'0'))->get()->row();
    $expired = $this->db->select('count(p.profile_code) as expired')->from('tbl_personel as p')->join('tbl_money as m','p.profile_code = m.profile_code','left')->where(array('m.payment_status'=>'1'))->get()->row();
    if($offline && $online && $free && $expired){
        $membership['offline'] = $offline->offline;
        $membership['online'] = $online->online;
        $membership['free'] = $free->free;
        $membership['expired'] = $expired->expired;
        
        return $membership;
    }
}
}