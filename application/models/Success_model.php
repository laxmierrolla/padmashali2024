<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
  Module: success Model
  Author: Laxmi
  Created Date: 28/January/2018
 * */
class Success_model extends CI_Model
{
  private $table = "stories_tbl";
  public function __construct(){
    parent::__construct();
    
  }

		
    //Save stories
    public function saveStories($data){
	return $this->db->insert($this->table,$data);
	}
	
    //get all stories
    public function getAllStories($pdata, $getcount=NULL){
    
        $tabelcolumns = array(
            0 =>'Story_ID',
            1 =>'Couple_Name',
            2 =>'Description',
            3=>'MarriedOn'
        );
        
        $search_1 = array(
            1 => 'Couple_Name',
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
        $allstories = $query->get()->result_array();
        
        foreach($allstories as $key=>$values){
            $allstories[$key]['sno'] = $generatesno++;
            $allstories[$key]['CoupleName'] = $allstories[$key]['Couple_Name'];
            $allstories[$key]['Image'] = $allstories[$key]['Image'];
            $allstories[$key]['Description'] = $allstories[$key]['Description'];
	    $allstories[$key]['Status'] = $allstories[$key]['Story_Status'];
            $allstories[$key]['MarriedDate'] =@date('d-m-Y',strtotime($allstories[$key]['MarriedOn']));
        }
        return $allstories;
    }
	//edit data
    public function get_storie_by_id($id){
	$this->db->from($this->table);
	$this->db->where('Story_ID',$id);
	$query = $this->db->get();
	return $query->row();
    }	
		  
  //update stories
    public function stories_update($where,$data){

	$this->db->update($this->table, $data, $where);
	return $this->db->affected_rows();
    }
          
    //delete stories	
    public function delete_story_by_id($id){
        $imagename = $this->db->select('Image')->from($this->table)->where('Story_ID',$id)->get()->row();
	$image = $imagename->Image;

	$this->db->where('Story_ID', $id);
	$this->db->delete($this->table);
        if (file_exists('uploads/stories/'.$image)){
            unlink('uploads/stories/'.$image);
        }
    }  
  
 //status change
public function change_staus_by_id($id, $data){
    $this->db->where('Story_ID',$id);
    $this->db->update($this->table, $data);
    return $this->db->affected_rows();
} 
	}