<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
  Module: Events Model
  Author: Laxmi
  Created Date: 25/January/2018
 * */
class Events_model extends CI_Model
{
  
  public function __construct(){
    parent::__construct();
    
  }

		
    //Save events
    public function saveEvents($data){
	return $this->db->insert('events_tbl',$data);
		
	}
	
    //get all Events
    public function getAllEvents($pdata, $getcount=NULL){
    
        $tabelcolumns = array(
            0 => 'EventID',
            1 => 'Name',
            2 => 'Description',
            3 => 'EventDate',
            4 => 'CreatedOn'
			
        );

       $search_1 = array(
            1 => 'Name',
        );
        
        //count of records
        if($getcount){ 
            $this->db->select('*')->from('events_tbl');
           }
	else{
            $this->db->select('*')->from('events_tbl');
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
        $allevents = $query->get()->result_array();
        
        foreach($allevents as $key=>$values){
            $allevents[$key]['sno'] = $generatesno++;
            $allevents[$key]['Name'] = $allevents[$key]['Name'];
            $allevents[$key]['Description'] = $allevents[$key]['Description'];
            $allevents[$key]['EventDate'] = $allevents[$key]['EventDate'];
	    $allevents[$key]['CreatedOn'] = $allevents[$key]['CreatedOn'];
	    $allevents[$key]['status'] = $allevents[$key]['status'];
        }
        return $allevents;
    }
	//edit data
    public function get_events_by_id($id){
	$this->db->from('events_tbl');
	$this->db->where('EventID',$id);
	$query = $this->db->get();
	return $query->row();
    }	
		  
  //update Events
    public function events_update($where,$data){
	$this->db->update('events_tbl', $data, $where);
	return $this->db->affected_rows();
    }
          
    //delete Events	
    public function delete_events_by_id($id){
        $this->db->where('EventID', $id);
        $this->db->delete('events_tbl');
    }  

  
 //status change
public function change_staus_by_id($id, $data){
    $this->db->where('EventID',$id);
    $this->db->update('events_tbl', $data);
    return $this->db->affected_rows();
} 
	
	  }