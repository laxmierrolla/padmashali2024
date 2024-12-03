<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  Module: Cms controller
  Author: Laxmi
  Created Date: 28/January/2018
 * */  
class Cms extends CI_Controller {
    function __construct() {
        parent::__construct(); 
	$this->load->model('Cms_model','cms');
    }

    public function index(){
	//$this->load->view('admin/aboutus/View');
	}
	
    //Add About page 
    public function AboutUs(){
    $about = $this->cms->aboutus();
    $data = array('about'=>$about);
    $this->load->view('pages/about',$data);
    }
    
    public function Sucess(){
        $success = $this->cms->sucess_story();
        $data = array('success'=>$success);
	$this->load->view('pages/successstories',$data);
    }
    
     public function ContactUs(){
        $contact = $this->cms->contct_us();
        $data = array('contact'=>$contact);
	$this->load->view('pages/contact',$data);
    }
    
     public function Faqs(){
        $faq = $this->cms->faqs();
        $data = array('faq'=>$faq);
	$this->load->view('pages/faqs',$data);
    }
	
    
}
