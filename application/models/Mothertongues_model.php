<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
  Module: MotherTongue Model
  Author: Laxmi
  Created Date: 7/July/2017
 * */
class Mothertongues_model extends CI_Model
{
  private $tablename = "language_tbl";
 
  public function __construct(){
    parent::__construct();
    
  }
 
    public function getmothertongues()
    {
       return  $this->db->select('L_Id,Language_Name')->from($this->tablename)->order_by('Language_Name','asc')->get()->result();
        
    }
    
    public function getcountries()
    {
       return  $this->db->select('country_id,country')->from('countrylist')->get()->result();
        
    }


}
