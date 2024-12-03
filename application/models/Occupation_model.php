 <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
  Module: Occupation Model
   Author: Laxmi
  Created Date: 27/December/2017
 * */
class Occupation_model extends CI_Model
{
  
  public function __construct(){
    parent::__construct();
    
  }
  
  //package check
	public function check_occ($occname){
		$query = $this->db->select('occupation')->from('tbl_occupation')->where(array('occupation'=>$occname))->get();   
        if($query->num_rows() > 0) {
          return 'success';
        }else{
           return 'fail';
        }
		} 
		
	//Save occupation
	public function saveOccupation($data){
		return $this->db->insert('tbl_occupation',$data);
		
	}
	
	//get all packages
   public function getAllOccupations($pdata, $getcount=NULL)
    {

        $tabelcolumns = array(
            0 => 'Occ_Id',
            1 => 'occupation',
           
        );

       $search_1 = array(
            1 => 'occupation',
        );
        
        //count of records
        if($getcount){ 
            $this->db->select('*')->from('tbl_occupation');
           }
		else{
            $this->db->select('*')->from('tbl_occupation');
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
        $alloccupations = $query->get()->result_array();
        
        foreach($alloccupations as $key=>$values){
            $alloccupations[$key]['sno'] = $generatesno++;
            $alloccupations[$key]['Name'] = $alloccupations[$key]['occupation'];
			$alloccupations[$key]['Status'] = $alloccupations[$key]['Occ_status'];
        }
        return $alloccupations;
    }
	//edit data
	public function get_occ_by_id($id)
	{
		$this->db->from('tbl_occupation');
		$this->db->where('Occ_Id',$id);
		$query = $this->db->get();
		return $query->row();
	}	
		  
  //update occupation
  
  public function occupation_update($where,$data){
	  $this->db->update('tbl_occupation', $data, $where);
		return $this->db->affected_rows();
	  
	  }
//delete package	
public function delete_occupation_by_id($id)
	{
		$this->db->where('Occ_Id', $id);
		$this->db->delete('tbl_occupation');
	}  

  
 //status change
 
 public function change_staus_by_id($id, $data){
	 $this->db->where('Occ_Id',$id);
	 $this->db->update('tbl_occupation', $data);
	return $this->db->affected_rows();
	 } 
	 
	 
	
	     
	  }