<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
  Module: Service Model
  Author: Laxmi
  Created Date: 28/January/2018
 * */
class Service_model extends CI_Model
{
  private $table = "services_tbl";
  public function __construct(){
    parent::__construct();
    
  }

		
    //Save service
    public function saveServices($data){
	return $this->db->insert($this->table,$data);
	}
	
    //get all services
    public function getAllServices($pdata, $getcount=NULL){
    
        $tabelcolumns = array(
            0 =>'ServiceID',
            1 =>'Name',
            2 =>'Description',
        );
        
        $search_1 = array(
            1 => 'Name',
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
        $allservices = $query->get()->result_array();
        
        foreach($allservices as $key=>$values){
            $allservices[$key]['sno'] = $generatesno++;
            $allservices[$key]['Name'] = $allservices[$key]['Name'];
            $allservices[$key]['Image'] = $allservices[$key]['Image'];
            $allservices[$key]['Description'] = $allservices[$key]['Description'];
	    $allservices[$key]['Status'] = $allservices[$key]['PromotionStatus'];
        }
        return $allservices;
    }
	//edit data
    public function get_service_by_id($id){
	$this->db->from($this->table);
	$this->db->where('ServiceID',$id);
	$query = $this->db->get();
	return $query->row();
    }	
		  
  //update service
    public function service_update($where,$data){
	$this->db->update($this->table, $data, $where);
	return $this->db->affected_rows();
    }
          
    //delete service	
    public function delete_service_by_id($id){
        $imagename = $this->db->select('Image')->from($this->table)->where('ServiceID',$id)->get()->row();
	$image = $imagename->Image;

	$this->db->where('ServiceID', $id);
	$this->db->delete($this->table);
	unlink('uploads/services/'.$image);
        
    }  

  
 //status change
public function change_staus_by_id($id, $data){
    $this->db->where('ServiceID',$id);
    $this->db->update($this->table, $data);
    return $this->db->affected_rows();
} 
	}