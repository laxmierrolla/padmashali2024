<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
  Module: Cms Model
  Author: Laxmi
  Created Date: 25/January/2018
 * */
class Cms_model extends CI_Model
{
  
  public function __construct(){
    parent::__construct();
    
  }

		
    //Save events
    public function aboutus(){
	return $this->db->select('*')->from('aboutus_tbl')->where('Career_Status','1')->order_by('Career_ID','desc')->limit(1)->get()->result();
		
	}
      public function sucess_story(){
	return $this->db->select('*')->from('stories_tbl')->where('Story_Status','1')->order_by('Story_ID','desc')->get()->result();
		
	}
       public function contct_us(){
	return $this->db->select('*')->from('contactus_tbl')->where('Contact_Status','1')->limit(3)->get()->result();
		
	}
        
          public function faqs(){
	return $this->db->select('*')->from('faq')->where('FaqStatus','1')->order_by('FaqId','asc')->get()->result();
		
	}
	
        
    }