<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
  Module: Package Model
   Author: Laxmi
  Created Date: 26/December/2017
 * */
class Package_model extends CI_Model
{
  
  public function __construct(){
    parent::__construct();
    
  }
  
  //package check
	public function check_package($package){
		$query = $this->db->select('name')->from('admin_packages')->where(array('name'=>$package))->get();   
        if($query->num_rows() > 0) {
          return 'success';
        }else{
           return 'fail';
        }
		} 
		
	//Save packages
	public function savePackages($data){
		return $this->db->insert('admin_packages',$data);
		
	}
	
	//get all packages
   public function getAllPackages($pdata, $getcount=NULL)
    {

        $tabelcolumns = array(
            0 => 'id',
            1 => 'name',
            2 => 'views',
			3 =>'valid_int',
			4 =>'valid',
			5 =>'price',
        );

       $search_1 = array(
            1 => 'name',
        );
        
        //count of records
        if($getcount){ 
            $this->db->select('*')->from('admin_packages');
           }
		else{
            $this->db->select('*')->from('admin_packages');
        }
        if(isset($pdata['search_text1'])&& $pdata['search_text1']!=""){
           $this->db->like($search_1[1],$pdata['search_text1']); 
        }
		/*echo $this->db->last_query();
		exit;*/
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
        $allpackages = $query->get()->result_array();
        
        foreach($allpackages as $key=>$values){
            $allpackages[$key]['sno'] = $generatesno++;
            $allpackages[$key]['Name'] = $allpackages[$key]['name'];
            $allpackages[$key]['views'] = $allpackages[$key]['views'];
            $allpackages[$key]['valid_period'] = $allpackages[$key]['valid_int'].$allpackages[$key]['valid_text'];
			$allpackages[$key]['valid'] = $allpackages[$key]['valid']."days";
            $allpackages[$key]['price'] = $allpackages[$key]['price'];
		    $allpackages[$key]['status'] = $allpackages[$key]['status'];
        }
        return $allpackages;
    }
	//edit data
	public function get_package_by_id($id)
	{
		$this->db->from('admin_packages');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}	
		  
  //update package
  
  public function package_update($where,$data){
	  $this->db->update('admin_packages', $data, $where);
		return $this->db->affected_rows();
	  
	  }
//delete package	
public function delete_package_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('admin_packages');
	}  

  
 //status change
 
 public function change_staus_by_id($id, $data){
	 $this->db->where('id',$id);
	 $this->db->update('admin_packages', $data);
	return $this->db->affected_rows();
	 } 
	 
	 
	 public function upadate_views($profilecode,$data,$invoice){
	   $result =  $this->db->where(array('profile_code'=>$profilecode));
        			$this->db->update('tbl_money', $data);
		return $this->db->affected_rows();			
    
	   }
	     
	  }