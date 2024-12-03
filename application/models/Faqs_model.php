<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
  Module: Faqs Model
  Author: Laxmi
  Created Date: 25/January/2018
 * */
class Faqs_model extends CI_Model
{
  private $table = "faq";
  public function __construct(){
    parent::__construct();
    
  }

		
    //Save Faqs
    public function saveFaqs($data){
	return $this->db->insert($this->table,$data);
	}
	
    //get all Faqs
    public function getAllFaqs($pdata, $getcount=NULL){
    
        $tabelcolumns = array(
            0 =>'FaqId',
            1 =>'FaqQuestion',
            2 =>'FaqAnswer',
        );

        //count of records
        if($getcount){ 
            $this->db->select('*')->from($this->table);
           }
	else{
            $this->db->select('*')->from($this->table);
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
        $allfaqs = $query->get()->result_array();
        
        foreach($allfaqs as $key=>$values){
            $allfaqs[$key]['sno'] = $generatesno++;
            $allfaqs[$key]['FaqQuestion'] = $allfaqs[$key]['FaqQuestion'];
            $allfaqs[$key]['FaqAnswer'] = $allfaqs[$key]['FaqAnswer'];
	    $allfaqs[$key]['Status'] = $allfaqs[$key]['FaqStatus'];
        }
        return $allfaqs;
    }
	//edit data
    public function get_faq_by_id($id){
	$this->db->from($this->table);
	$this->db->where('FaqId',$id);
	$query = $this->db->get();
	return $query->row();
    }	
		  
  //update faqs
    public function faq_update($where,$data){
      
	$this->db->update($this->table, $data, $where);
	return $this->db->affected_rows();
    }
          
    //delete about	
    public function delete_faq_by_id($id){
        $this->db->where('FaqId', $id);
        $this->db->delete($this->table);
    }  

  
 //status change
public function change_staus_by_id($id, $data){
    $this->db->where('FaqId',$id);
    $this->db->update($this->table, $data);
    return $this->db->affected_rows();
} 
	}