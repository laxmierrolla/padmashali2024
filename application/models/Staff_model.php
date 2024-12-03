 <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
  Module: Staff  Model
   Author: Laxmi
  Created Date: 29/December/2017
 * */
class Staff_model extends CI_Model
{
  private $admin = 'admin';
  public function __construct(){
    parent::__construct();
    
  }

public function get_groups(){
	return $this->db->select('*')->from('usergroups_tbl')->where(array('GroupID!='=>'1','GroupStatus'=>'1'))->get()->result();
	}
		
	//Save staff
	public function saveStaff($data){
		return $this->db->insert($this->admin,$data);
	}
	
	//get all staff
   public function getAllStaff($pdata, $getcount=NULL)
    {

        $tabelcolumns = array(
            0 => 'a.admin_id',
            1 => 'a.uname',
			2=>	'a.mail_id',
			3=>	'a.mobile',
			4=>'b.GroupName'
        );

       $search_1 = array(
            1 => 'a.uname',
			2 => 'a.mail_id',
			3=>'a.mobile',
			4=>'b.GroupName'
        );
        
        //count of records
        if($getcount){ 
            $this->db->select('a.*,b.GroupName')->from('admin as a');
			$this->db->join('usergroups_tbl as b','a.admintype = b.GroupID','left');
			$this->db->where('admin_id!=',1);
           }
		else{
            $this->db->select('a.*,b.GroupName')->from('admin as a');
			$this->db->join('usergroups_tbl as b','a.admintype = b.GroupID','left');
			$this->db->where('admin_id!=',1);
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
        $allstaff = $query->get()->result_array();
        
        foreach($allstaff as $key=>$values){
            $allstaff[$key]['sno'] = $generatesno++;
            $allstaff[$key]['UserName'] = $allstaff[$key]['uname'];
			$allstaff[$key]['Email'] = $allstaff[$key]['mail_id'];
			$allstaff[$key]['Mobile'] = $allstaff[$key]['mobile'];
			$allstaff[$key]['GroupName'] = $allstaff[$key]['GroupName'];
			$allstaff[$key]['Status'] = $allstaff[$key]['status'];
        }
        return $allstaff;
    }
	//edit data
	public function get_staff_by_id($id)
	{
		$this->db->from($this->admin);
		$this->db->where('admin_id',$id);
		$query = $this->db->get();
		return $query->row();
	}	
		  
  //update staff
  
  public function staff_update($where,$data){
	  $this->db->update($this->admin, $data, $where);
		return $this->db->affected_rows();
	  
	  }
//delete specialcases	
public function delete_staff_by_id($id){
		$this->db->where('admin_id', $id);
		$this->db->delete($this->admin);
	}  

  
 //status change
 
 public function change_staus_by_id($id, $data){
	 $this->db->where('admin_id',$id);
	 $this->db->update($this->admin, $data);
	 return $this->db->affected_rows();
	 } 
	 
	
	     
	  }