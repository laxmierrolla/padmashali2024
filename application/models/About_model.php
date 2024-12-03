<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
  Module: About Model
  Author: Laxmi
  Created Date: 25/January/2018
 * */
class About_model extends CI_Model
{
  
  public function __construct(){
    parent::__construct();
    
  }

		
    //Save events
    public function saveAbout($data){
	return $this->db->insert('aboutus_tbl',$data);
		
	}
	
    //get all About
    public function getAllAbout($pdata, $getcount=NULL){
    
        $tabelcolumns = array(
            0 =>'Career_ID',
            1 =>'Career_Name',
            2 =>'Career_Desc',
        );

        //count of records
        if($getcount){ 
            $this->db->select('*')->from('aboutus_tbl');
            $this->db->where('TrashStatus','0');
           }
	else{
            $this->db->select('*')->from('aboutus_tbl');
            $this->db->where('TrashStatus','0');
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
        $allabout = $query->get()->result_array();
        
        foreach($allabout as $key=>$values){
            $allabout[$key]['sno'] = $generatesno++;
            $allabout[$key]['Name'] = $allabout[$key]['Career_Name'];
            $allabout[$key]['Description'] = $allabout[$key]['Career_Desc'];
	    $allabout[$key]['status'] = $allabout[$key]['Career_Status'];
        }
        return $allabout;
    }
	//edit data
    public function get_about_by_id($id){
	$this->db->from('aboutus_tbl');
	$this->db->where('Career_ID',$id);
	$query = $this->db->get();
	return $query->row();
    }	
		  
  //update About
    public function about_update($where,$data){
	$this->db->update('aboutus_tbl', $data, $where);
	return $this->db->affected_rows();
    }
          
    //delete about	
    public function delete_about_by_id($id){
        $this->db->where('Career_ID', $id);
        $this->db->delete('aboutus_tbl');
    }  

  
 //status change
public function change_staus_by_id($id, $data){
    $this->db->where('Career_ID',$id);
    $this->db->update('aboutus_tbl', $data);
    return $this->db->affected_rows();
} 
	
	  }