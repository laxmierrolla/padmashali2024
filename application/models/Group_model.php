 <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
  Module: Group Model
   Author: Laxmi
  Created Date: 30/December/2017
 * */
class Group_model extends CI_Model
{
	private $group = 'usergroups_tbl';
  
  public function __construct(){
    parent::__construct();
    
  }

	
	//get all groups
   public function getAllGroups($pdata, $getcount=NULL)
    {

        $tabelcolumns = array(
            0 => 'GroupID',
            1 => 'GroupName',
        );

       $search_1 = array(
            1 => 'GroupName',
        );
        
        //count of records
        if($getcount){ 
            $this->db->select('*')->from($this->group)->where('GroupID!=',1);
           }
		else{
            $this->db->select('*')->from($this->group)->where('GroupID!=',1);
        }
        if(isset($pdata['search_text1'])&& $pdata['search_text1']!=""){
           $this->db->like($search_1[1],$pdata['search_text1']); 
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
		/*echo $this->db->last_query();
		exit;*/
        $allgroups = $query->get()->result_array();
        
        foreach($allgroups as $key=>$values){
            $allgroups[$key]['sno'] = $generatesno++;
            $allgroups[$key]['Name'] = $allgroups[$key]['GroupName'];
            $allgroups[$key]['CreatedOn'] = $allgroups[$key]['CreatedOn'];
			$allgroups[$key]['Status'] = $allgroups[$key]['GroupStatus'];
			
        }
        return $allgroups;
    }

//delete group	
public function delete_group_by_id($id)
	{
		$this->db->where('GroupID', $id);
		$this->db->delete($this->group);
	}  

  
 //status change
 
 public function change_staus_by_id($id, $data){
	 $this->db->where('GroupID',$id);
	 $this->db->update($this->group, $data);
	return $this->db->affected_rows();
	 } 
	 
	 
	 public function upadate_views($profilecode,$data,$invoice){
	   $result =  $this->db->where(array('profile_code'=>$profilecode));
        			$this->db->update('tbl_money', $data);
		return $this->db->affected_rows();			
    
	   }
	     
	  }