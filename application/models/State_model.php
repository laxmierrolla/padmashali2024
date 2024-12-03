 <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
  Module: States Model
   Author: Laxmi
  Created Date: 19/Jan/2018
 * */
class  State_model extends CI_Model
{
  
  public function __construct(){
    parent::__construct();
    
  }
  

  
  
  //package check
	public function check_state($country,$state){
		$query = $this->db->select('name')->from('states')->where(array('name'=>$state,'country_id=>$country'))->get(); 
		
        if($query->num_rows() > 0) {
          return 'success';
        }else{
           return 'fail';
        }
		} 
		
	//Save country
	public function saveState($data){
		return $this->db->insert('states',$data);
		
	}
	
	//get all states
   public function getAllStates($pdata, $getcount=NULL)
    {

        $tabelcolumns = array(
            0 => 'a.id',
            1 => 'a.name',
			2 => 'b.name'
           
        );
       $search_1 = array(
            1 => 'b.name',
			2 => 'a.name',
        );
        
        //count of records
        if($getcount){ 
            $this->db->select('a.*,b.name as country')->from('states as a')->Join('countries as b','a.country_id = b.id','left');
           }
		else{
            $this->db->select('a.*,b.name as country')->from('states as a')->Join('countries as b','a.country_id = b.id','left');
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
        $allstates = $query->get()->result_array();
        
        foreach($allstates as $key=>$values){
            $allstates[$key]['sno'] = $generatesno++;
			$allstates[$key]['sid'] = $allstates[$key]['id'];
            $allstates[$key]['StateName'] = $allstates[$key]['name'];
			$allstates[$key]['CountryName'] = $allstates[$key]['country'];
			
        }
        return $allstates;
    }
	//edit data
	public function get_state_by_id($id)
	{
		$this->db->from('states');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}	
		  
  //update state
  
  public function state_update($where,$data){
	  $this->db->update('states', $data, $where);
		return $this->db->affected_rows();
	  
	  }
//delete state	
public function delete_state_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('states');
	}  

  
	     
	  }