 <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
  Module: Countries Model
   Author: Laxmi
  Created Date: 15/Jan/2018
 * */
class Countries_model extends CI_Model
{
  
  public function __construct(){
    parent::__construct();
    
  }
  
  //country check
	public function check_country($country){
		$query = $this->db->select('name')->from('countries')->where('name',$country.'')->get(); 
		
        if($query->num_rows() > 0) {
          return 'success';
        }else{
           return 'fail';
        }
		} 
		
	//Save country
	public function saveCountry($data){
		return $this->db->insert('countries',$data);
		
	}
	
	//get all packages
   public function getAllCountries($pdata, $getcount=NULL)
    {

        $tabelcolumns = array(
            0 => 'id',
            1 => 'name',
			2 => 'phonecode'
           
        );
       $search_1 = array(
            1 => 'name',
        );
        
        //count of records
        if($getcount){ 
            $this->db->select('*')->from('countries');
           }
		else{
            $this->db->select('*')->from('countries');
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
        $allcountries = $query->get()->result_array();
        
        foreach($allcountries as $key=>$values){
            $allcountries[$key]['sno'] = $generatesno++;
			$allcountries[$key]['cid'] = $allcountries[$key]['id'];
            $allcountries[$key]['Name'] = $allcountries[$key]['name'];
			$allcountries[$key]['phonecode'] = $allcountries[$key]['phonecode'];
        }
        return $allcountries;
    }
	//edit data
	public function get_country_by_id($id)
	{
		$this->db->from('countries');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}	
		  
  //update country
  
  public function country_update($where,$data){
	  $this->db->update('countries', $data, $where);
		return $this->db->affected_rows();
	  
	  }
//delete country	
public function delete_country_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('countries');
	}  

  
	     
	  }