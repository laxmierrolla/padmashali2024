<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
  Module: Contact Model
  Author: Laxmi
  Created Date: 25/January/2018
 * */
class Terms_model extends CI_Model
{
  private $table = "tbl_terms";
  public function __construct(){
    parent::__construct();
    
  }

		
    //Save Terms
    public function saveTerms($data){
	return $this->db->insert($this->table,$data);
	}
	
    //get all Contact
    public function getAllTerms($pdata, $getcount=NULL){
    
        $tabelcolumns = array(
            0 =>'terms_ID',
            1 =>'Name',
            2 =>'Description',
        );

        //count of records
        if($getcount){ 
            $this->db->select('*')->from($this->table);
            $this->db->where('TrashStatus','0');
           }
	else{
            $this->db->select('*')->from($this->table);
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
        $allterms = $query->get()->result_array();
        
        foreach($allterms as $key=>$values){
            $allterms[$key]['sno'] = $generatesno++;
            $allterms[$key]['Name'] = $allterms[$key]['Name'];
            $allterms[$key]['Description'] = $allterms[$key]['Description'];
	    $allterms[$key]['status'] = $allterms[$key]['PromotionStatus'];
        }
        return $allterms;
    }
	//edit data
    public function get_terms_by_id($id){
	$this->db->from($this->table);
	$this->db->where('terms_ID',$id);
	$query = $this->db->get();
	return $query->row();
    }	
		  
  //update terms
    public function terms_update($where,$data){
	$this->db->update($this->table, $data, $where);
	return $this->db->affected_rows();
    }
          
    //delete about	
    public function delete_terms_by_id($id){
        $this->db->where('terms_ID', $id);
        $this->db->delete($this->table);
    }  

  
 //status change
public function change_staus_by_id($id, $data){
    $this->db->where('terms_ID',$id);
    $this->db->update($this->table, $data);
    return $this->db->affected_rows();
} 
	}