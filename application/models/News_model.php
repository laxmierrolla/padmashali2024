<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
  Module: News Model
  Author: Laxmi
  Created Date: 25/January/2018
 * */
class News_model extends CI_Model
{
  
  public function __construct(){
    parent::__construct();
    
  }

		
    //Save events
    public function saveNews($data){
	return $this->db->insert('lattestnews',$data);
		
	}
	
    //get all News
    public function getAllNews($pdata, $getcount=NULL){
    
        $tabelcolumns = array(
            0 => 'News_Id',
            1 =>'News_Descrtiption',
			
        );

        //count of records
        if($getcount){ 
            $this->db->select('*')->from('lattestnews');
           }
	else{
            $this->db->select('*')->from('lattestnews');
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
        $allnews = $query->get()->result_array();
        
        foreach($allnews as $key=>$values){
            $allnews[$key]['sno'] = $generatesno++;
            $allnews[$key]['Description'] = $allnews[$key]['News_Descrtiption'];
	    $allnews[$key]['CreatedOn'] = $allnews[$key]['News_Date'];
	    $allnews[$key]['status'] = $allnews[$key]['News_Status'];
        }
        return $allnews;
    }
	//edit data
    public function get_news_by_id($id){
	$this->db->from('lattestnews');
	$this->db->where('News_Id',$id);
	$query = $this->db->get();
	return $query->row();
    }	
		  
  //update Events
    public function news_update($where,$data){
	$this->db->update('lattestnews', $data, $where);
	return $this->db->affected_rows();
    }
          
    //delete news	
    public function delete_news_by_id($id){
        $this->db->where('News_Id', $id);
        $this->db->delete('lattestnews');
    }  

  
 //status change
public function change_staus_by_id($id, $data){
    $this->db->where('News_Id',$id);
    $this->db->update('lattestnews', $data);
    return $this->db->affected_rows();
} 


 public function getAllNewsticker($pdata, $getcount=NULL){
    
        $tabelcolumns = array(
            0 => 'UpdateId',
            1 =>'UpdateDesc',
			
        );

        //count of records
        if($getcount){ 
            $this->db->select('*')->from('update_tbl');
           }
	else{
            $this->db->select('*')->from('update_tbl')->order_by('UpdateId','desc');
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
        $allnews = $query->get()->result_array();
        
        foreach($allnews as $key=>$values){
            $allnews[$key]['sno'] = $generatesno++;
            $allnews[$key]['Description'] = $allnews[$key]['UpdateDesc'];
	    $allnews[$key]['status'] = $allnews[$key]['UpdateStatus'];
        }
        return $allnews;
    }

    public function get_newsticker_by_id($id){
        $this->db->from('update_tbl');
	$this->db->where('UpdateId',$id);
	$query = $this->db->get();
	return $query->row();
        
    }
    
    public function newsticker_update($where,$data){
      $this->db->update('update_tbl', $data, $where);
	return $this->db->affected_rows();  
    }
    
    public function change_newsstaus_by_id($id,$data){
    $this->db->where('UpdateId',$id);
    $this->db->update('update_tbl', $data);
    return $this->db->affected_rows();
        
    }
	  }