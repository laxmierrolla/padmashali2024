<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
  Module: Advertisement Model
  Author: Laxmi
  Created Date: 28/January/2018
 * */
class Advertisement_model extends CI_Model
{
  private $table = "advertaisement_tbl";
  public function __construct(){
    parent::__construct();
    
  }

		
    //Save adds
    public function saveAdds($data){
	return $this->db->insert($this->table,$data);
	}
	
    //get all data
    public function getAllData($pdata, $getcount=NULL){
    
        $tabelcolumns = array(
            0 =>'AddId',
            1 =>'AddPage',
            2 =>'AddWebLink',
        );
        
        $search_1 = array(
            1 => 'AddPage',
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
        $alldata= $query->get()->result_array();
        
        foreach($alldata as $key=>$values){
            $alldata[$key]['sno'] = $generatesno++;
            $alldata[$key]['Page'] = $alldata[$key]['AddPage'];
            $alldata[$key]['Image'] = $alldata[$key]['AddImage'];
            $alldata[$key]['Link'] = $alldata[$key]['AddWebLink'];
	    $alldata[$key]['Status'] = $alldata[$key]['AddStatus'];
           
        }
        return $alldata;
    }
	//edit data
    public function get_add_by_id($id){
	$this->db->from($this->table);
	$this->db->where('AddId',$id);
	$query = $this->db->get();
	return $query->row();
    }	
		  
  //update Adds
    public function add_update($where,$data){

	$this->db->update($this->table, $data, $where);
	return $this->db->affected_rows();
    }
          
    //delete adds	
    public function delete_adds_by_id($id){
        $imagename = $this->db->select('AddImage')->from($this->table)->where('AddId',$id)->get()->row();
	$image = $imagename->AddImage;

	$this->db->where('AddId', $id);
	$this->db->delete($this->table);
        if (file_exists('uploads/advertaisement/'.$image)){
            unlink('uploads/advertaisement/'.$image);
        }
    }  
  
 //status change
public function change_staus_by_id($id, $data){
    $this->db->where('AddId',$id);
    $this->db->update($this->table, $data);
    return $this->db->affected_rows();
} 
	}