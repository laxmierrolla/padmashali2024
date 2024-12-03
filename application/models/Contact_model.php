<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
  Module: Contact Model
  Author: Laxmi
  Created Date: 25/January/2018
 * */
class Contact_model extends CI_Model
{
  
  public function __construct(){
    parent::__construct();
    
  }

		
    //Save events
    public function saveContact($data){
	return $this->db->insert('contactus_tbl',$data);
		
	}
	
    //get all Contact
    public function getAllContact($pdata, $getcount=NULL){
    
        $tabelcolumns = array(
            0 =>'Contact_ID',
            1 =>'Contact_Name',
            2 =>'Contact_Desc',
        );

        //count of records
        if($getcount){ 
            $this->db->select('*')->from('contactus_tbl');
            $this->db->where('TrashStatus','0');
           }
	else{
            $this->db->select('*')->from('contactus_tbl');
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
        $allcontact = $query->get()->result_array();
        
        foreach($allcontact as $key=>$values){
            $allcontact[$key]['sno'] = $generatesno++;
            $allcontact[$key]['Name'] = $allcontact[$key]['Contact_Name'];
            $allcontact[$key]['Description'] = $allcontact[$key]['Contact_Desc'];
	    $allcontact[$key]['status'] = $allcontact[$key]['Contact_Status'];
        }
        return $allcontact;
    }
	//edit data
    public function get_contact_by_id($id){
	$this->db->from('contactus_tbl');
	$this->db->where('Contact_ID',$id);
	$query = $this->db->get();
	return $query->row();
    }	
		  
  //update About
    public function contact_update($where,$data){
	$this->db->update('contactus_tbl', $data, $where);
	return $this->db->affected_rows();
    }
          
    //delete about	
    public function delete_contact_by_id($id){
        $this->db->where('Contact_ID', $id);
        $this->db->delete('contactus_tbl');
    }  

  
 //status change
public function change_staus_by_id($id, $data){
    $this->db->where('Contact_ID',$id);
    $this->db->update('contactus_tbl', $data);
    return $this->db->affected_rows();
} 
	}