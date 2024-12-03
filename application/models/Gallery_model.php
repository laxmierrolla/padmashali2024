 <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
  Module: Gallery Model
   Author: Laxmi
  Created Date: 03/January/2018
 * */
class Gallery_model extends CI_Model
{
  private $gallery = 'gallery';
  public function __construct(){
    parent::__construct();
    
  }
 
		
	//Save Gallery
	public function saveGallery($data){
		return $this->db->insert($this->gallery,$data);
		
	}
	
	//get all Gallery
   public function getAllGallery($pdata, $getcount=NULL)
    {

        $tabelcolumns = array(
            0 => 'Gid',
            1 => 'GName',
           
        );

       $search_1 = array(
            1 => 'GName',
        );
        
        //count of records
        if($getcount){ 
            $this->db->select('*')->from($this->gallery);
           }
		else{
            $this->db->select('*')->from($this->gallery);
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
        $allgallery = $query->get()->result_array();
        
        foreach($allgallery as $key=>$values){
            $allgallery[$key]['sno'] = $generatesno++;
            $allgallery[$key]['Name'] = $allgallery[$key]['GName'];
			$allgallery[$key]['Status'] = $allgallery[$key]['GStatus'];
        }
        return $allgallery;
    }
	//edit data
	public function get_gallery_by_id($id)
	{
		$this->db->from($this->gallery);
		$this->db->where('Gid',$id);
		$query = $this->db->get();
		return $query->row();
	}	
		  
  //update galllery
  
  public function gallery_update($where,$data){
	  $this->db->update($this->gallery, $data, $where);
		return $this->db->affected_rows();
	  
	  }
//delete gallery	
public function delete_gallery_by_id($id)
	{
		$this->db->where('Gid', $id);
		$this->db->delete($this->gallery);
	}  

  
 //status change
 
 public function change_staus_by_id($id, $data){
	 $this->db->where('Gid',$id);
	 $this->db->update($this->gallery, $data);
	 return $this->db->affected_rows();
	 } 
	 
	 
// get galleries

public function get_gallery(){
	return $this->db->select('*')->from($this->gallery)->where('GStatus',1)->get()->result();
	}
	
	
	
	
 public function getAllPhotoGallery($pdata, $getcount=NULL)
    {

        $tabelcolumns = array(
            0 => 'a.id',
            1 => 'b.GName',
			2=>  'a.name',
           
        );

       $search_1 = array(
            1 => 'a.name',
        );
        
        //count of records
        if($getcount){ 
            $this->db->select('a.*,b.GName')->from('photo_gallery as a')->join('gallery as b','a.gnameid = b.Gid','left');
           }
		else{
             $this->db->select('a.*,b.GName')->from('photo_gallery as a')->join('gallery as b','a.gnameid = b.Gid','left');
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
        $allphotogallery = $query->get()->result_array();
        
        foreach($allphotogallery as $key=>$values){
            $allphotogallery[$key]['sno'] = $generatesno++;
            $allphotogallery[$key]['groupname'] = $allphotogallery[$key]['GName'];
			$allphotogallery[$key]['name'] = $allphotogallery[$key]['name'];
			$allphotogallery[$key]['image'] = $allphotogallery[$key]['image'];
			$allphotogallery[$key]['description'] = $allphotogallery[$key]['description'];
			$allphotogallery[$key]['Status'] = $allphotogallery[$key]['status'];
        }
        return $allphotogallery;
    }
	
	
	//delete photogallery	
public function delete_pgallery_by_id($id)
	{
		$imagename = $this->db->select('image')->from('photo_gallery')->where('id',$id)->get()->row();
		$image = $imagename->image;
		$this->db->where('id', $id);
		$this->db->delete('photo_gallery');
		unlink('uploads/gallery/'.$image);
		
	}  

  
 //status change photogallery
 
 public function change_pstaus_by_id($id, $data){
	 $this->db->where('id',$id);
	 $this->db->update('photo_gallery', $data);
	 return $this->db->affected_rows();
	 } 		 
//check name	 
public function check_name($name){
		$query = $this->db->select('name')->from('photo_gallery')->where(array('name'=>$name))->get();   
        if($query->num_rows() > 0) {
          return 'success';
        }else{
           return 'fail';
        }
		}
		
//save photogallery
public function  save_photo_gallery($data){
	return $this->db->insert('photo_gallery',$data);
	
	}
	
	
	//edit data
public function get_pgallery_by_id($id)
	{
		$this->db->from('photo_gallery');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
 //update specialcases
  
  public function pgallery_update($where,$data){
	  $this->db->update('photo_gallery', $data, $where);
         return $this->db->affected_rows();
	  
	  }		
				 	 
	  }