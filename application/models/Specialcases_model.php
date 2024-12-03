 <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
  Module: Special cases Model
   Author: Laxmi
  Created Date: 29/December/2017
 * */
class Specialcases_model extends CI_Model
{
  
  public function __construct(){
    parent::__construct();
    
  }
  
  //package check
	public function check_spl($occname){
		$query = $this->db->select('spacial')->from('tbl_spacial')->where(array('spacial'=>$occname))->get();   
        if($query->num_rows() > 0) {
          return 'success';
        }else{
           return 'fail';
        }
		} 
		
	//Save specialcases
	public function saveSpl($data){
		return $this->db->insert('tbl_spacial',$data);
		
	}
	
	//get all special cases
   public function getAllSpl($pdata, $getcount=NULL)
    {

        $tabelcolumns = array(
            0 => 'spl_id',
            1 => 'spacial',
           
        );

       $search_1 = array(
            1 => 'spacial',
        );
        
        //count of records
        if($getcount){ 
            $this->db->select('*')->from('tbl_spacial');
           }
		else{
            $this->db->select('*')->from('tbl_spacial');
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
        $allspls = $query->get()->result_array();
        
        foreach($allspls as $key=>$values){
            $allspls[$key]['sno'] = $generatesno++;
            $allspls[$key]['Name'] = $allspls[$key]['spacial'];
			$allspls[$key]['Status'] = $allspls[$key]['spl_status'];
        }
        return $allspls;
    }
	//edit data
	public function get_spl_by_id($id)
	{
		$this->db->from('tbl_spacial');
		$this->db->where('spl_id',$id);
		$query = $this->db->get();
		return $query->row();
	}	
		  
  //update specialcases
  
  public function spl_update($where,$data){
	  $this->db->update('tbl_spacial', $data, $where);
		return $this->db->affected_rows();
	  
	  }
//delete specialcases	
public function delete_spl_by_id($id)
	{
		$this->db->where('spl_id', $id);
		$this->db->delete('tbl_spacial');
	}  

  
 //status change
 
 public function change_staus_by_id($id, $data){
	 $this->db->where('spl_id',$id);
	 $this->db->update('tbl_spacial', $data);
	return $this->db->affected_rows();
	 } 
	 
	 
	
	     
	  }