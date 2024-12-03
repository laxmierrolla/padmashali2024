<?php
defined('BASEPATH') or die('Some thing error occured');

class Search extends CI_Controller{
    public $data,$profileid,$paidstatus;
    public function __construct() {
        parent::__construct();
	    if(!isset($this->session->userdata['user']['username'])){
         redirect('matrimony');
         }
        $this->data=array();
        $this->profileid=(isset($this->session->userdata['user']['username']))?$this->session->userdata['user']['username']:'';
        $this->paidstatus=(isset($this->session->userdata['user']['paidstatus']))?$this->session->userdata['user']['paidstatus']:'';
        $this->gender=(isset($this->session->userdata['user']['gender']))?$this->session->userdata['user']['gender']:''; 
        $this->folderpath='search/';
         $this->load->model('Matrimony_model','matrimony');
         $this->load->model('Search_model','search');
		  $this->load->model('Userdashboard_model','udashboard');
		// }
    }
    public function index()
    {
        $this->data['employee']=$this->matrimony->getEmployeement();
        $this->data['education']=$this->matrimony->getEducation();
        $this->data['occupation']=$this->matrimony->getOccupation();
        $this->data['specilcase']=$this->matrimony->getSpecialcase();
        $this->data['rasi']=$this->matrimony->getRasi();
        $this->data['star']=$this->matrimony->getStar();
        $this->data['country']=$this->matrimony->getcountries();
        $this->data['height']=$this->matrimony->getHeightList();
        $this->load->view($this->folderpath.'filters',  $this->data);
        
    }
    
    public function profileresult()
    {
        //ini_set('session.cache_limiter','public');
        //session_cache_limiter(false);
        //print_r($this->session->all_userdata());exit;
        $search=array();
        $keyword_search='';
        $keyword_search=($this->input->post('search_keyword')!='')?$this->input->post('search_keyword'):'';
        $search['keyword_search']=$keyword_search; 
           
        /*Age code */
        $age_from='';
        $age_from=($this->input->post('age_from')!='')?$this->input->post('age_from'):'';     
        $search['age_from']=$age_from; 
             
         /*Age code */      
        
         /*Age To start */
        $age_to='';
        $age_to=($this->input->post('age_to')!='')?$this->input->post('age_to'):'';     
        $search['age_to']=$age_to; 
         /*Age code */ 
        
        /*Height To start */
         $height_from='';
        $height_from=($this->input->post('height_from')!='')?$this->input->post('height_from'):'';
        $search['height_from']=$height_from; 
            
         /*Height code */ 
         
         /*Height start */
        $height_to='';
        $height_to=($this->input->post('height_to')!='')?$this->input->post('height_to'):'';
        $search['height_to']=$height_to; 
              
         /*Height code */ 
         
         /*maritalstatus=  start */
         $maritalstatus='';
        $maritalstatus=  ($this->input->post('maritalstatus')!='')?implode(',',$this->input->post('maritalstatus')):''; 
        $search['maritalstatus']=$maritalstatus; 
             
         /*maritalstatus code */ 
         
          /*education=  start */
        $education='';
        $education= ($this->input->post('education')!='')?implode(',',$this->input->post('education')):'';  
       $search['education']=$education; 
         /*education code */ 
         
        /*education=  start */
         $occupation ='';
         $occupation =($this->input->post('occupation')!='')?implode(',',$this->input->post('occupation')):''; 
        $search['occupation']=$occupation;
             
         /*education code */ 
        /*anual_income  start */
         $anual_income ='';
         $anual_income =($this->input->post('anual_income')!='')?$this->input->post('anual_income'):'';
         $search['anual_income']=$anual_income; 
               
         /*anual_income code */ 
         /*Employee IN  start */
         $employee_in  ='';
         $employee_in  =($this->input->post('employee')!='')?implode(',',$this->input->post('employee')):'';
         $search['employee_in']=$employee_in; 
             
          /*Employee IN  start */  
         /*specialcase IN  start */
        $specialcase ='';
        $specialcase = ($this->input->post('specialcase')!='')?implode(',',$this->input->post('specialcase')):'';
        $search['specialcase']=$specialcase; 
               
          /*specialcase IN  start */  
          
           /*Rasi IN  start */
         $rasi ='';
       $rasi = ($this->input->post('rasi')!='')?$this->input->post('rasi'):'';
       $search['rasi']=$rasi; 
             
          /*Rasi IN  start */  
          
        /*Start IN  start */
         $star ='';
         $star = ($this->input->post('star')!='')?$this->input->post('star'):'';
         $search['star']=$star; 
              
        /*Star IN  start */  
         /*manglikstart */
         $manglik ='';
         $manglik = ($this->input->post('manglik')!='')?implode(',',$this->input->post('manglik')):'';
       $search['manglik']=$manglik;
               
        /*manglik  start */  
        
        /*country */
         $country ='';
        $country = ($this->input->post('country')!='')?$this->input->post('country'):'';
        $search['country']=$country;
               
        /*country  end */  
        
                /*$state  */
         $state  ='';
       $state = ($this->input->post('state')!='')?$this->input->post('state'):'';
        $search['state']=$state;
              
        /*$state  end */  
        /*city  */
         $city   ='';
       $city = ($this->input->post('city')!='')?$this->input->post('city'):''; 
                 $search['city']= $city;
               
        /*city  end */  
        
         /*Residant status  */
         $residantstatus   ='';
         $residantstatus = ($this->input->post('residantstatus')!='')?implode(',',$this->input->post('residantstatus')):'';
                 $search['residantstatus']= $residantstatus;
                $this->session->set_userdata('residantstatus',$residantstatus);
        
        /*Residant status  end */
             /*Diet status  */
         $dite    ='';
        //echo $this->input->post('dite');exit;
        $dite =  ($this->input->post('dite')!='')?$this->input->post('dite'):''; 
                $search['dite']=  $dite;
             
        /*Diet status  end */
        $search['login_gender']=$this->gender;
        $this->session->set_userdata($search);
        $this->data['gender']=$this->gender;
        $this->data['searched_params']=$search;
        $this->data['search_data']=  $this->search->advancedSearch($search);
        
       // $this->data['search_statistics']=  $this->search->searchStatistics($search); 
        $search_gender=($this->gender=='Male')?'Female':'Male';
        $this->data['filter_statistics']=$this->search->displayStatistics($search);
        $this->load->view($this->folderpath.'search_result',  $this->data);
        
    }
    public function partnerDetails(){
		$profileId = $this->session->userdata['user']['username'];
        $profilecode=$this->uri->segment(2);
        $this->data['gender']=$this->gender;
        $search=array();
        $search['profilecode']=$profilecode;
        $search['gender']=  $this->gender;
        $this->data['searched_params']=$search;
		$this->data['contactscount']=$this->udashboard->home_menu_count($profileId);
        $this->data['profile_data']=  $this->search->profiledetails($search);
		$this->data['partnercodes']=$this->udashboard->shorlisted_profilescodes($profileId);
		$this->data['intrcodes']=$this->udashboard->sent_intrst_profilescodes($profileId);
        $this->data['related_profiles']=  $this->search->similarProfileList($search);
		$this->data['images'] = $this->search->get_images($search);
        $this->load->view($this->folderpath.'partner_details',$this->data);
        
    }
    
    
    public function basicsearch()
    {
	
        //print_r($this->session->all_userdata());exit;
        
        $search=array();
        $age_from=($this->input->post('age_from')!='')?$this->input->post('age_from'):'';
        $search['age_from']=!(empty($age_from))?$age_from:0; 
        /*>> */
         $age_to=($this->input->post('age_to')!='')?$this->input->post('age_to'):'';
        $search['age_to']=!(empty($age_to))?$age_to:0; 
        /*>> */
        $height_from=($this->input->post('height_from')!='')?$this->input->post('height_from'):'';
        $search['height_from']=!(empty($height_from))?$height_from:0; 
         /*>> */     
         $height_to= ($this->input->post('height_to')!='')?$this->input->post('height_to'):'';
        $search['height_to']=!(empty($height_to))?$height_to:0;        
        /*>> */  
        $gender= ($this->input->post('search-gender')!='')?$this->input->post('search-gender'):'';
        $search['gender']=$gender;   
        $this->data['gender']=$gender;
        $this->data['searched_params']=$search;
       //print_r($search);exit;
        $this->data['search_data']=  $this->search->basicSearch($search);
        $this->data['filter_statistics']=$this->search->basicSearchStatistics($search);
        $this->load->view($this->folderpath.'basic_search_result',  $this->data);
        
    }
    
}
