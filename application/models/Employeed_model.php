 <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
  Module: Employeed_model Model
   Author: Laxmi
  Created Date: 27/December/2017
 * */
class Employeed_model extends CI_Model
{
  
  public function __construct(){
    parent::__construct();
    
  }
  
  //package check
	public function check_emp($empname){
		$query = $this->db->select('employee')->from('tbl_emplin')->where(array('employee'=>$empname))->get();   
        if($query->num_rows() > 0) {
          return 'success';
        }else{
           return 'fail';
        }
		} 
		
	//Save occupation
	public function saveEmp($data){
		return $this->db->insert('tbl_emplin',$data);
		
	}
	
	//get all packages
   public function getAllEmp($pdata, $getcount=NULL)
    {

        $tabelcolumns = array(
            0 => 'emp_id',
            1 => 'employee',
           
        );

       $search_1 = array(
            1 => 'employee',
        );
        
        //count of records
        if($getcount){ 
            $this->db->select('*')->from('tbl_emplin');
           }
		else{
            $this->db->select('*')->from('tbl_emplin');
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
        $allemp = $query->get()->result_array();
        
        foreach($allemp as $key=>$values){
            $allemp[$key]['sno'] = $generatesno++;
            $allemp[$key]['Name'] = $allemp[$key]['employee'];
			$allemp[$key]['Status'] = $allemp[$key]['emp_status'];
        }
        return $allemp;
    }
	//edit data
	public function get_emp_by_id($id)
	{
		$this->db->from('tbl_emplin');
		$this->db->where('emp_id',$id);
		$query = $this->db->get();
		return $query->row();
	}	
		  
  //update occupation
  
  public function emp_update($where,$data){
	  $this->db->update('tbl_emplin', $data, $where);
		return $this->db->affected_rows();
	  
	  }
//delete package	
public function delete_emp_by_id($id)
	{
		$this->db->where('emp_id', $id);
		$this->db->delete('tbl_emplin');
	}  

  
 //status change
 
 public function change_staus_by_id($id, $data){
	 $this->db->where('emp_id',$id);
	 $this->db->update('tbl_emplin', $data);
	return $this->db->affected_rows();
	 } 
	 
	 
	
	     
	  }