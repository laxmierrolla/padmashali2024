 <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
  Module: City Model
   Author: Laxmi
  Created Date: 19/Jan/2018
 * */
class  City_model extends CI_Model
{
  
  public function __construct(){
    parent::__construct();
    
  }
 
  //City check
	public function check_city($city,$state){
		$query = $this->db->select('name')->from('cities')->where(array('name'=>$city,'state_id=>$state'))->get(); 
		
        if($query->num_rows() > 0) {
          return 'success';
        }else{
           return 'fail';
        }
		} 
		
	//Save city
	public function saveCity($data){
		return $this->db->insert('cities',$data);
		
	}
	
	//get all states
   public function getAllCities($pdata, $getcount=NULL)
    {

        $tabelcolumns = array(
            0 => 'a.id',
            1 => 'a.name',
			2 => 'b.name',
			3=>  'c.name'
           
        );
       $search_1 = array(
            1 => 'c.name',
			2 => 'b.name',
			3=>  'a.name',
        );
        
        //count of records
        if($getcount){ 
            $this->db->select('a.*,b.name as state,c.name as country')->from('cities as a')->Join('states as b','a.state_id = b.id','left')->Join('countries as c','b.country_id = c.id','left');
           }
		else{
            $this->db->select('a.*,b.name as state,c.name as country')->from('cities as a')->Join('states as b','a.state_id = b.id','left')->Join('countries as c','b.country_id = c.id','left');
        }
         if(isset($pdata['search_text1'])&& $pdata['search_text1']!=""){
           $this->db->like($search_1[$pdata['search_on_1']], $pdata['search_text1'] );
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
        $allcities = $query->get()->result_array();
        
        foreach($allcities as $key=>$values){
            $allcities[$key]['sno'] = $generatesno++;
			$allcities[$key]['cid'] = $allcities[$key]['id'];
			$allcities[$key]['CityName'] = $allcities[$key]['name'];
			$allcities[$key]['CountryName'] = $allcities[$key]['country'];
            $allcities[$key]['StateName'] = $allcities[$key]['state'];
		
        }
        return $allcities;
    }
	//edit data
	public function get_city_by_id($id)
	{
		$this->db->select('a.*,b.country_id')->from('cities as a')->join('states as b','a.state_id = b.id');
		$this->db->where('a.id',$id);
		$query = $this->db->get();
		return $query->row();
	}	
		  
  //update city
  
  public function city_update($where,$data){
	  $this->db->update('cities', $data, $where);
		return $this->db->affected_rows();
	  
	  }
//delete city	
public function delete_city_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('cities');
	}  

  
	     
	  }