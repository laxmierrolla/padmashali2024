 <?php $this->load->view('template/userdashboard/head');?>
 <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css"> 
<script type="text/javascript">
   $(document).ready(function(){
           $('#dob').datepicker( {
            showOn: "button",
                buttonImage: "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
                buttonImageOnly: true,
                maxDate: '-18Y',
        });
      });
</script>
<style type="text/css">
.multiselect-container input[type='checkbox']{position: initial !important;}
  .btn-default{background: linear-gradient(to bottom, #feffe8 0%,#d6dbbf 100%);}
  .multiselect-selected-text{color:#000 !important;font-size: 12px;	}
   .multiselect-container{position: inherit !important;
    overflow-y: scroll !important;
    height: 201px!important;}
    .ui-datepicker-trigger{position: absolute !important;
    top: 31px !important;
    right: 1.1em !important;
    padding: 9px 10px;
    background: #d9534f;
   }
	
	
</style>
<body >
<?php $this->load->view('template/userdashboard/header');
$profile_code = (isset($this->session->userdata['user']['username']))?$this->session->userdata['user']['username']:'';
$gender=(isset($this->session->userdata['user']['gender']))?$this->session->userdata['user']['gender']:''; 
$gender_pic = ($gender == 'Female') ? 'female.jpg' : 'male.png';
$dummy_profile_pic = base_url() . 'assets/images/' . $gender_pic;

$dateOfBirth = (isset($result->dob))?$result->dob:'';
$today = date("Y-m-d");
$diff = date_diff(date_create($dateOfBirth), date_create($today));
$age = $diff->format('%y');
?>

<div class="container">
  <div class="col-md-12 details"><!--details start-->
    <div class="col-md-9">
       <div class="panel panel-default no-brd">
        <div class="panel-body col-md-12">
          <div class="col-md-2 no-pad">
         <?php if($result->thumbimage!==""){ if($result->Profile_photo_Status == 1){ $img = $result->thumbimage;?>
            <a href="#"><img src="<?php echo base_url().'uploads/profilepics/'.$profile_code.'/'.$img;?>" alt="#" class="img-responsive" width="100%" /></a>
          <?php } else{?>
             <a href="#"><img src="<?php echo $dummy_profile_pic;?>" alt="#" class="img-responsive" width="100%" /></a>
           <?php }} else{?>
            <a href="#"><img src="<?php echo $dummy_profile_pic;?>" alt="#" class="img-responsive" width="100%" /></a>
            <?php }?>
          </div>
          <div class="col-md-9 details-right">
            <div class="col-md-8">
            <h4><?php if(isset($result->sname)&&(isset($result->fname))&&(isset($result->lname))){ $name = $result->sname.' '.$result->fname.' '.$result->lname; echo strtoupper($name);}?>
            <div class="clearfix"></div>
            <small>(<i>Created by&nbsp;:&nbsp;<?php if(isset($result->profile_by)){ echo $result->profile_by;}?></i>)</small></h4>
          </div>
          <div class="col-md-4 no-pad text-right"><h5>Profile Id&nbsp;:&nbsp;<span class="btn btn-xs btn-success"><?php if(isset($result->profile_code)){echo $result->profile_code;} ?></span></h5></div>
         
          <div class="clearfix"></div>
          <div class="col-md-12">
          <ul class="list-inline">
            <li><img src="<?php echo base_url();?>assets/userdashboard/images/age.png" alt="age" /><?php echo $age."Years";?></li>
            <li><img src="<?php echo base_url();?>assets/userdashboard/images/height.png" alt="height" /><?php if(isset($result->feet)){ echo $result->feet;}?></li>
            <li><img src="<?php echo base_url();?>assets/userdashboard/images/education.png" alt="education" /><?php if(isset($result->education)){ echo $result->education;}?></li>
            <li><img src="<?php echo base_url();?>assets/userdashboard/images/location.png" alt="location" /><?php if(isset($result->cit)){ echo $result->cit.", ";}if(isset($result->stat)){ echo $result->stat.", ";} if(isset($result->county)){ echo $result->county;}?></li>
            <div class="clearfix"></div>
            <li><img src="<?php echo base_url();?>assets/userdashboard/images/mobile.png" alt="age" /><?php if(isset($result->mobile)){echo $result->mobile;}?></li>
            <li><img src="<?php echo base_url();?>assets/userdashboard/images/email.png" alt="age" /><?php if(isset($result->email)){echo $result->email;}?></li>
          </ul>
        <div class="clearfix"></div>
        </div>
          <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
        </div> 
        <div class="clearfix"></div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 latest-left">
        <!-- Accordion begin -->
    <div class="accordion_example1">
    
      <!-- Section 1 -->
      <div class="accordion_in acc_active panel panel-default no-brd">
        <div class="acc_head panel-heading no-brd"><h2><img src="<?php echo base_url();?>assets/images/abt.png" alt="user" />AboutMe</h2></div>
        <div class="acc_content panel-body col-md-12 latest-content">
        <div>
        <button class ="btn btn-info col-md-1 btn-sm pull-right edits" id="about">Edit</button>
        <div id="about_data">
         <p><?php if(isset($result->aboutme) && !empty($result->aboutme)){ echo $result->aboutme; }else{echo "N.A" ;}?> </p>
         </div>
        </div>
        <div class="col-md-12 edit" id="about_form" class="collapse" style="display:none">
          <form name="aboutform" id="aboutform" method="post">
          <input type="hidden" name="profile_id" id="profile_id" value="<?php if(isset($result->profile_code)){ echo $result->profile_code;}?>">
          <label>About Me</label>
          <textarea class="form-control" id="aboutme" name="aboutme"></textarea>
          <input class="btn btn-info btn-sm pull-right" type="button" id="ab_update" name="ab_update"  value="Save">
          </form>
        </div>
        </div>
      </div>
      <div class="accordion_in panel panel-default no-brd"><!--second panel start-->
            <div class="acc_head panel-heading no-brd">
              <h2><img src="<?php echo base_url();?>assets/userdashboard/images/basic.png" alt="user" />Basic Details</h2>
              <div class="clearfix"></div>
            </div>
            <div class="acc_content panel-body col-md-12 latest-content">
            <button class ="btn btn-info btn-sm col-md-1 pull-right edits" id="basic">Edit</button> 
             <div class="col-md-12 no-pad" id="basic_data">
                <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Profile created by</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->profile_by)){ echo $result->profile_by;}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Reference by</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->ref_by)){ echo $result->ref_by;}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Name</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->sname)&&(isset($result->fname))&&(isset($result->lname))){ $name = $result->sname.' '.$result->fname.' '.$result->lname; echo strtoupper($name);}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Age</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo $age."Years"?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Gender
                      </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->gender)){ echo $result->gender;}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Marital Status</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->marital_status)){ echo $result->marital_status;}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Date of Birth </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->dob)){ echo $result->dob;}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Mother Tongue</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->language)){ echo $result->language;}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Nationality </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->living)){ echo $result->living;}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Mobile Number</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->mobile)){ echo $result->mobile;}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Email</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->email)){ echo $result->email;}?></div>
                    </div>
                  </li>
                  </ul>
              </div>
              <div class="col-md-12 edit" id="basic_form" style="display:none">
                <form id="basicform" name="basicform" method="post">
                <input type="hidden" name="profile_id" id="profile_id" value="<?php if(isset($result->profile_code)){ echo $result->profile_code;}?>"> 
                     <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Profile created by</label>
                      <select class="form-control" id="profile_by" name="profile_by">
                         <option value="">Select</option> 
                         <option value="Self">Self</option>
                         <option value="Parents">Parents</option>
                         <option value="Guardian">Guardian</option>
                         <option value="Son">Son</option>
                         <option value="Daughter">Daughter</option>
                         <option value="Brother">Brother</option>
                         <option value="Sister">Sister</option>
                         <option value="Friends">Friends</option>
                         <option value="Relatives">Relatives</option>
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Reference by</label>
                      <select class="form-control" id="reference" name="reference">
                          <option value="">Select</option> 
                          <option value="Advertisements">Advertisements</option>
                          <option value="Friends">Friends</option>
                          <option value="Sanghams">Sanghams</option>
                          <option value="SearchEngine"> Search Engine</option>
                          <option value="Others">Others</option>
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>SurName</label>
                      <input type="text" name="surname" id="surname" class="form-control" />
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>First Name</label>
                      <input type="text" name="firstname" id="firstname" class="form-control" />
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>LastName</label>
                      <input type="text" name="lastname" id="lastname" class="form-control" />
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 sky-form">
                      <label>Gender</label>
                      <div class="clearfix"></div>
                      <ul class="list-inline">
                      <li>
                      <label class="radio">
                      <input type="radio" name="gender" id="gender" class="form-control" value="Female"  disabled/><i></i>Female
                      </label></li><li>
                      <label class="radio">
                      <input type="radio" name="gender" id="gender" class="form-control" value="Male" disabled/><i></i>Male
                    </label></li>
                  </ul>
                    </div>
                  </li>
                  <div class="clearfix"></div>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 sky-form">
                      <label>MaritualStatus</label>
                      <ul class="list-inline">
                      <li>
                      <label class="radio"><input type="radio" name="maritalstatus" value="Never Married"><i></i>Never Married</label></li><li>
                      <label class="radio"><input type="radio" name="maritalstatus" value="Widow/Widower"><i></i>Widow</label></li><li>
                      <label class="radio"><input type="radio" name="maritalstatus" value="Divorced"><i></i>Divorced</label></li><li>
                      <label class="radio"><input type="radio" name="maritalstatus" value="Separated"><i></i>orange</label></li>
                    </ul>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad childern">
                    <div class="col-md-12 sky-form">
                      <div class="col-md-5">
                        <label>No.of Children </label>
                        <div class="clearfix"></div>
                        <select class="form-control" name="nofchild" id="nofchild">
                            <option value="">--select--</option>                                 
                                <option value="None">None</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                        </select>
                      </div>
                      <div class="col-md-7 child">
                        <label>Children Living Status</label>
                        <div class="clearfix"></div>
                        <ul class="list-inline">
                          <li> 
                      <label class="radio"><input type="radio" name="Living" value="ChildrenLiving"><i></i>Children Living</label></li><li>
                      <label class="radio"><input type="radio" name="Living" value="ChildrenNotLiving"><i></i>Not Living with me</label></li>
                    </ul>
                      </div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Date of Birth</label>
                      <div class="clearfix"></div>
                      <input type="text" name="dob" id="dob" class="form-control" disabled />
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Mother Tongue</label>
                         <select class="form-control" id="mothertongue" name="mothertongue">
                          <option value="">Select</option> 
                           <?php if(isset($mothertongues)){
                           foreach($mothertongues  as  $value){?>
                           <option value="<?php echo $value->L_Id;?>"><?php echo $value->Language_Name;?></option>     
                           <?php }}?>
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Nationality</label>
                      <select class="form-control" id="nationality" name="nationality">
                          <option value="">Select</option> 
                      <?php 
                      if(isset($nationality)){
                      foreach($nationality as $nationalities){?>
                      <option value="<?php echo $nationalities->id;?>"><?php echo $nationalities->name;?></option>   
                      <?php }
                      }?>
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Mobile Number</label>
                      <select name="phcode"  id="phcode" class="form-control input-sm" disabled>
                      <option value="">Please select</option>
                      <?php  if(isset($nationality)){
                      foreach($nationality as $nationalities){?>
                      <option value="<?php echo $nationalities->id."_+".$nationalities->phonecode;?>"><?php echo $nationalities->name ."(+".$nationalities->phonecode.")";?></option>   
                      <?php }
                                    }?>
                      </select>
                      <input type="text" name="umobile" id="umobile" class="form-control" value="" disabled />
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Email</label>
                      <input type="text" name="email" id="email" class="form-control"  disabled/>
                    </div>
                  </li>
                  <li class="col-md-6">
                    <input type="button" name="basic_update" id="basic_update" class="btn btn-info col-md-5" value="Submit" style="margin:30px 0px 0px 18px;" /> 
                  </li>
                  </ul>
                </form>
               </div>
            </div>
            <div class="clearfix"></div>
          </div><!--second panel end-->
          <div class="accordion_in panel panel-default no-brd"><!--second panel start-->
            <div class="acc_head panel-heading no-brd">
              <h2><img src="<?php echo base_url();?>assets/userdashboard/images/book.png" alt="user" />Professional Information</h2>
              <div class="clearfix"></div>
            </div>
            <div class="acc_content panel-body col-md-12 latest-content">
             <button class ="btn btn-info btn-sm col-md-1 pull-right edits" id="professional">Edit</button> 
             <div class="col-md-12 no-pad" id="professional_data">
                <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Education </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->education)&& !empty($result->education)){ echo $result->education;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Education in Details</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->edu_details)&& !empty($result->edu_details)){ echo $result->edu_details;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Employed in </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->employee)&& !empty($result->employee)){ echo $result->employee;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Occupation</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->occupation)&& !empty($result->occupation)){ echo $result->occupation;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Occupation in Detail</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->occ_details)&& !empty($result->occ_details)){ echo $result->occ_details;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Annual Income</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->income)&& !empty($result->income)){ echo $result->income;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  
                  
                  </ul>
              </div>
              <div class="col-md-12 edit" id="professional_form" style="display:none">
                <form name="professionalform" id="professionalform" method="post">
                <input type="hidden" name="profile_id" id="profile_id" value="<?php if(isset($result->profile_code)){ echo $result->profile_code;}?>">
                     <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Education </label>
                      <select class="form-control" id="education" name="education"> 
                      <option value="">-- Choose Education--</option>
                                 <?php if(isset($education)){
                                        foreach($education as $edu){?>
                                         <option value="<?php echo $edu->edu_id;?>"><?php echo $edu->education ;?></option>   
                                        <?php }
                                    }?>
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Education in Detail</label>
                      <input type="text" name="edudetails" id="edudetails" class="form-control" />
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Occupation</label>
                     <select class="form-control" id="occupation" name="occupation"> 
                      <option value="">-- Choose Education--</option>
                            <?php if(isset($occupation)){
                                  foreach($occupation as $ocu){?>
                                  <option value="<?php echo $ocu->Occ_Id;?>"><?php echo $ocu->occupation ;?></option>   
                            <?php }}?>
                      </select>             
                     </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Occupation Details</label> 
                      <input type="text" name="occdetails" id="occdetails" class="form-control" /> 
                    </div>
                  </li>
                  <div class="occbox" id="occbox">
                   <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Annual Income</label>
                     <select class="form-control" id="income" name="income"> 
                      <option value="">--Choose Income--</option>
                            <option value="Upto INR 1 Lakh" label="Upto INR 1 Lakh">Upto INR 1 Lakh</option>
                            <option value="INR 1 Lakh to 2 Lakh" label="INR 1 Lakh to 2 Lakh">INR 1 Lakh to 2 Lakh</option>
                            <option value="INR 2 Lakh to 4 Lakh" label="INR 2 Lakh to 4 Lakh">INR 2 Lakh to 4 Lakh</option>
                            <option value="INR 4 Lakh to 7 Lakh" label="INR 4 Lakh to 7 Lakh">INR 4 Lakh to 7 Lakh</option>
                            <option value="INR 7 Lakh to 10 Lakh" label="INR 7 Lakh to 10 Lakh">INR 7 Lakh to 10 Lakh</option>
                            <option value="INR 10 Lakh to 15 Lakh" label="INR 10 Lakh to 15 Lakh">INR 10 Lakh to 15 Lakh</option>
                            <option value="INR 15 Lakh to 20 Lakh" label="INR 15 Lakh to 20 Lakh">INR 15 Lakh to 20 Lakh</option>
                            <option value="INR 20 Lakh to 30 Lakh" label="INR 20 Lakh to 30 Lakh">INR 20 Lakh to 30 Lakh</option>
                            <option value="INR 30 Lakh to 50 Lakh" label="INR 30 Lakh to 50 Lakh">INR 30 Lakh to 50 Lakh</option>
                            <option value="INR 50 Lakh to 75 Lakh" label="INR 50 Lakh to 75 Lakh">INR 50 Lakh to 75 Lakh</option>
                            <option value="INR 75 Lakh to 1 Crore" label="INR 75 Lakh to 1 Crore">INR 75 Lakh to 1 Crore</option>
                            <option value="INR 1 Crore &amp; above" label="INR 1 Crore &amp; above">INR 1 Crore &amp; above</option>
                            <option value="Not applicable" label="Not applicable">Not applicable</option>
                            <option value="Dont want to specify" label="Dont want to specify">Dont want to specify</option>                                            
                        </select>             
                      </div>
                  </li>
                   <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Employed In</label> 
                      <div class="clearfix"></div>
                      <select name="empin" id="empin" tabindex="1" class="form-control input-sm"> 
                        <option value="">-- Choose Employeed In--</option>
                        <?php if(isset($employee)){
                               foreach($employee as $emp){?>
                               <option value="<?php echo $emp->emp_id;?>"><?php echo $emp->employee ;?></option>   
                               <?php }}?>
                      </select> 
                    </div>
                  </li> 
                  <div class="clearfix"></div>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Employeement Details</label> 
                       <input type="text" id="empdetails" name="empdetails" tabindex="1" class="form-control">
                    </div>
                  </li> 
                  </div>  
                  <li class="col-md-12">
                    <input type="button" name="prf_update" id="prf_update" class="btn btn-info col-md-3 pull-right" value="Submit" style="margin: 30px 0px 0px 18px;" /> 
                  </li>
                  </ul>
                </form>
               </div>
            </div>
            <div class="clearfix"></div>
          </div><!--second panel end-->
      <div class="accordion_in panel panel-default no-brd"><!--second panel start-->
            <div class="acc_head panel-heading no-brd">
              <h2><img src="<?php echo base_url();?>assets/userdashboard/images/physical.png" alt="user" />Physical Status&nbsp;&amp;&nbsp;Hobbies</h2>
              <div class="clearfix"></div>
            </div>
            <div class="acc_content panel-body col-md-12 latest-content">
              <button class ="btn btn-info btn-sm col-md-1 pull-right edits" id="physical">Edit</button>
             <div class="col-md-12 no-pad" id="physical_data">
             
                <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Height</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->feet)&& !empty($result->feet)){ echo $result->feet;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Weight&nbsp;( In Kgs ) </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->weight)&& !empty($result->weight)){ echo $result->weight;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Complexion </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->cmplxion)&& !empty($result->cmplxion)){ echo $result->cmplxion;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Blood group </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->bldgroup)&& !empty($result->bldgroup)){ echo $result->bldgroup;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Special Cases </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->spacial)&& !empty($result->spacial)){ echo $result->spacial;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Dite</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->dite)&& !empty($result->dite)){ echo $result->dite;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Body Type </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad" style="margin-left:10px;"><?php if(isset($result->body_type)&& !empty($result->body_type)){ echo $result->body_type;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Smoke</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->smoke)&& !empty($result->smoke)){ echo $result->smoke;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Drink</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->drink)&& !empty($result->drink)){ echo $result->drink;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  </ul>
              </div>
              <div class="col-md-12 edit" id="physical_form" style="display:none">
                <form id="physicalform" name="physicalform" method="post">
                <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Height  </label>
                      <select class="form-control" id="height" name="height">
                         
                            <option value="">--select--</option> 
                                 <?php if(isset($height)){
                                        foreach($height as $value){?>
                                         <option value="<?php echo $value->feet;?>"><?php echo $value->feet ;?></option>   
                                        <?php }
                                    }?>    
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Weight ( In Kgs )</label>
                      <select class="form-control" id="weight" name="weight"> 
                            <option value="Dont Know">Don't Know</option>
                                 <?Php  for ($we = 30; $we <= 300; $we++) {  ?>
                                 <option value="<?php echo $we; ?>"><?php echo $we; ?> Kgs</option> 
                                 <?php } ?>                                 
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Complexion </label>
                      <select class="form-control" id="complexion" name="complexion"> 
                            <option value=" ">Select</option>
                                <?php if(isset($complexion)){
                                        foreach($complexion as $comp){?>
                                         <option value="<?php echo $comp->cmplex;?>"><?php echo $comp->cmplex ;?></option>   
                                        <?php }
                                    }?> 
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Blood group </label>
                      <select class="form-control" id="bloodgroup" name="bloodgroup"> 
                             <option value="">--select--</option>
                                 <?php if(isset($bloodgroup)){
                                        foreach($bloodgroup as $blood){?>
                                         <option value="<?php echo $blood->bldgroup;?>"><?php echo $blood->bldgroup ;?></option>   
                                        <?php }
                                    }?> 
                                    <option value="Don'tKnow">Dontknow</option>
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Special Cases </label>
                      <select class="form-control" id="splcase" name="splcase"> 
                             <option value="">--select--</option>
                            <?php if(isset($specilcase)){
                                        foreach($specilcase as $spl){?>
                                         <option value="<?php echo $spl->spacial;?>"><?php echo $spl->spacial  ;?></option>   
                                        <?php }
                                    }?>                                  
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Dite </label>
                      <select class="form-control" id="dite" name="dite"> 
                             <option value="">--select--</option>
                             <option value="Veg">Veg</option>
                             <option value="Non-Veg">Non-Veg</option>
                             <option value="Both">Both</option>
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 sky-form">
                      <label>Body Type </label>
                      <div class="clearfix"></div>
                      <ul class="list-inline">
                      <li>
                      <label class="radio"><input type="radio" name="bodytype" value="Slim"><i></i>Slim</label></li>
                      <li>
                      <label class="radio"><input type="radio" name="bodytype" value="Average"><i></i>Average</label>
                      </li><li>
                      <label class="radio"><input type="radio" name="bodytype" value="Athletic"><i></i>Athletic</label>
                    </li><li>
                      <label class="radio"><input type="radio" name="bodytype" value="Heavy"><i></i>Heavy</label></li>
                    </ul>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 sky-form">
                      <div class="col-md-6">
                      <label>Smoke</label>
                      <div class="clearfix"></div>
                      <ul class="list-inline">
                      <li>
                      <label class="radio"><input type="radio" name="Smoke" value="Yes"><i></i>Yes</label></li><li>
                      <label class="radio"><input type="radio" name="Smoke" value="No"><i></i>No</label></li>
                    </ul>
                      </div>
                      <div class="col-md-6">
                      <label>Drink</label>
                      <div class="clearfix"></div>
                      <ul class="list-inline">
                      <li>
                      <label class="radio"><input type="radio" name="Drink" value="Yes"><i></i>Yes</label></li><li>
                      <label class="radio"><input type="radio" name="Drink" value="No"><i></i>No</label></li>
                    </ul>
                    </div>
                    </div>
                  </li>
                  
                  <li class="col-md-6">
                    <input type="button" name="physical_update" id="physical_update" class="btn btn-info col-md-3  col-md-pull-1 pull-right" value="Submit" /> 
                  </li>
                  </ul>
                </form>
               </div>
            </div>
            <div class="clearfix"></div>
          </div><!--second panel end-->
          <div class="accordion_in panel panel-default no-brd"><!--second panel start-->
            <div class="acc_head panel-heading no-brd">
              <h2><img src="<?php echo base_url();?>assets/userdashboard/images/horoscope.png" alt="user" />Horoscope Information</h2>
              <div class="clearfix"></div>
            </div>
            <div class="acc_content panel-body col-md-12 latest-content">
            <button class ="btn btn-info btn-sm col-md-1 pull-right edits" id="horo">Edit</button>
             <div class="col-md-12 no-pad" id="horo_data">
                <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Birth Place</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->birth_place)&& !empty($result->birth_place)){ echo $result->birth_place;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Birth Time </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->hrs)){ echo $result->hrs." :";}if(isset($result->mins)){ echo $result->mins." :";}if(isset($result->secs)){ echo $result->secs." :";}if(isset($result->period)){ echo $result->period;}?></div>
                    </div>
                  </li>
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad" style="line-height:15px;">Birth Name\Janma Nammamu</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->birth_name)&& !empty($result->birth_name)){ echo $result->birth_name;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Gowthram </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->gowthram)&& !empty($result->gowthram)){ echo $result->gowthram;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Zodiac or Rasi</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->rasis)&& !empty($result->rasis)){ echo $result->rasis;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Nakshatram</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->stars)&& !empty($result->stars)){ echo $result->stars;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Paadam </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->paadam)&& !empty($result->paadam)){ echo $result->paadam;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Horoscope Match</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->horoscope)&& !empty($result->horoscope)){ echo $result->horoscope;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Manglik Status</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->manglik)&& !empty($result->manglik)){ echo $result->manglik;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  </ul>
              </div>
              <div class="col-md-12 edit" id="horo_form" style="display:none">
                <form name="horoform" id="horoform" method="post">
                     <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Birth Place</label>
                        <input type="text" name="birthplace" id="birthplace" class="form-control" />
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Birth Time </label>
                      <ul class="list-inline">
                      <li class="col-md-3 no-pad">
                      <select class="form-control" id="hrs" name="hrs" disabled> 
                              <option value="">Hrs</option>
                             <option value="Dont Know">Dont Know</option>
                             <?php for($i=1;$i<=12;$i++){
                                 if($i<=9){ ?>
                                     <option value="<?php echo "0".$i;?>"><?php echo "0".$i;?></option>
                                 <?php }else{?>
                                   <option value="<?php echo $i;?>"><?php echo $i;?></option>
                             <?php }}?>
                      </select>
                    </li>
                    <li class="col-md-3 no-pad">
                      <select class="form-control" id="minutes" name="minutes" disabled> 
                                          <option value="Dont Know">Dont Know</option>
                             <?php for($i=1;$i<=59;$i++){
                                 if($i<=9){ ?>
                                     <option value="<?php echo "0".$i;?>"><?php echo "0".$i;?></option>
                                 <?php }else{?>
                                   <option value="<?php echo $i;?>"><?php echo $i;?></option>
                             <?php }}?>
                      </select>
                    </li>
                    <li class="col-md-3 no-pad">
                      <select class="form-control" id="secs" name="secs" disabled> 
                                        <option value="">seconds</option>
                             <option value="Dont Know">Dont Know</option>
                             <?php for($i=1;$i<=59;$i++){
                                 if($i<=9){ ?>
                                     <option value="<?php echo "0".$i;?>"><?php echo "0".$i;?></option>
                                 <?php }else{?>
                                   <option value="<?php echo $i;?>"><?php echo $i;?></option>
                             <?php }}?>
                      </select>
                    </li>
                    <li class="col-md-3 no-pad">
                      <select class="form-control" id="period" name="period" disabled> 
                                    <option value="">at</option>
                             <option value="Dont Know">Dont Know</option>
                             <option value="AM">AM</option>
                             <option value="PM">PM</option>
                      </select>
                    </li>
                  </ul>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Birth Name\Janma Nammamu</label>
                      <input type="text" name="birthname" id="birthname"class="form-control" />
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Gowthram </label>
                      <input type="text" name="gowthram" id="gowthram" class="form-control" />
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Zodiac or Rasi</label>
                      <select class="form-control" id="rasi" name="rasi" disabled> 
                                                 <option value="">--select--</option>
                            <?php if(isset($rasi)){
                                        foreach($rasi as $rasi){?>
                                         <option value="<?php echo $rasi-> rasi_id;?>"><?php echo $rasi->rasi;?></option>   
                                        <?php }
                                    }?> 
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                    <label>Paadam </label>
                      <select class="form-control" id="padam" name="padam"> 
                      <option value="">--Choose paadam--</option>
                             <option value="Dont Know">Dont Know</option>
                             <option value="1">1</option>
                             <option value="2">2</option>
                             <option value="3">3</option>
                             <option value="4">4</option>
                      </select>

                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                    <label>Nakshatram</label>
                      <select class="form-control" id="star" name="star" disabled> 
                         <option value="">--select--</option>
                            <?php if(isset($star)){
                                        foreach($star as $star){?>
                                         <option value="<?php echo $star-> star_id;?>"><?php echo $star->star ;?></option>   
                                        <?php }
                                    }?> 
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 sky-form">
                      <label>Horoscope Match</label>
                      <div class="clearfix"></div>
                      <ul class="list-inline">
                      <li>
                      <label class="radio"><input type="radio" name="horoscope" value="Yes"><i></i>Yes</label></li>
                      <li><label class="radio"><input type="radio" name="horoscope" value="No"><i></i>No</label></li>
                      <li><label class="radio"><input type="radio" value="Doesn't Matter" name="horoscope"><i></i>Don'tKnow</label></li>
                    </ul>
                    </div>
                  </li>
                  <div class="clearfix"></div>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 sky-form">
                      <label>Manglik Status</label>
                      <div class="clearfix"></div>
                      <ul class="list-inline">
                      <li>
                      <label class="radio"><input type="radio" name="manglik" value="Yes"><i></i>Yes</label></li><li>
                      <label class="radio"><input type="radio" name="manglik" value="No"><i></i>No</label></li><li>
                      <label class="radio"><input type="radio" value="Doesn't Matter" name="manglik"><i></i>Don'tKnow</label></li>
                    </ul>
                    </div>
                  </li>
                  <li class="col-md-6">
                    <input type="button" name="horo_update" id="horo_update" class="btn btn-info col-md-3  col-md-pull-1 pull-right" value="Submit" /> 
                  </li>
                  </ul>
                </form>
               </div>
            </div>
            <div class="clearfix"></div>
          </div><!--second panel end-->
          <div class="accordion_in panel panel-default no-brd"><!--second panel start-->
            <div class="acc_head panel-heading no-brd">
              <h2><img src="<?php echo base_url();?>assets/userdashboard/images/mobile.png" alt="user" />Contact Details</h2>
              <div class="clearfix"></div>
            </div>
            <div class="acc_content panel-body col-md-12 latest-content">
            <button class ="btn btn-info btn-sm col-md-1 pull-right edits" id="contact">Edit</button>
             <div class="col-md-12 no-pad" id="contact_data">
                <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Address </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad" style="line-height:16px;text-align:justify;"><?php if(isset($result->address)&& !empty($result->address)){ echo $result->address;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Permanent  Address </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad" style="line-height:16px;text-align:justify;"><?php if(isset($result->perminantaddress)&& !empty($result->perminantaddress)){ echo $result->perminantaddress;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Country</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->county)&& !empty($result->county)){ echo $result->county;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">State </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->stat)&& !empty($result->stat)){ echo $result->stat;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">City</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->cit)&& !empty($result->cit)){ echo $result->cit;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Alternate Mobile</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->fmobile)&& !empty($result->fmobile)){ echo $result->fmobile;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Land Line </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->phone)&& !empty($result->phone)){ echo $result->phone;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Residence Status</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->res_status)&& !empty($result->res_status)){ echo $result->res_status;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Family Origin</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->family_origin)&& !empty($result->family_origin)){ echo $result->family_origin;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  </ul>
              </div>
              <div class="col-md-12 edit" id="contact_form" style="display:none">
                <form id="contactform" name="contactform">
                     <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Address</label>
                      <textarea class="form-control" id="address" name="address" ></textarea>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                       <label>Parment Address</label>
                      <textarea class="form-control" id="permanentaddress" name="permanentaddress"></textarea>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Country </label>
                      <select class="form-control" id="country" name="country">
                           <option value="">--Select Country--</option>  
                            <?php if(isset($country)){
                            foreach($country as $coun){?>
                            <option value="<?php echo $coun->id;?>"><?php echo $coun->name ;?></option>   
                            <?php }
                            }?>                                           
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>State </label>
                      <select class="form-control" id="state" name="state">
                         <option value="">--Select State--</option>
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>City</label>
                        <select class="form-control" id="city" name="city">
                         <option value="">--Select City--</option>
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Alternate Mobile</label>
                      <input type="text" name="mobile" id="mobile" class="form-control" />
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Land Line </label>
                      <input type="text" name="landline" id="landline" class="form-control"  />
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Residence Status</label>
                      <select class="form-control" id="res_statue" name="res_statue">
                        <option value="">--select--</option>
                            <option value="Dont Want To Specify">Dont Want To Specify</option>
                            <option value="Rental">Rental</option>
                            <option value="Own">Own</option>
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Family Origin</label>
                      <input type="text" name="familyorigin" id="familyorigin" class="form-control" />
                    </div>
                  </li>
                  <li class="col-md-6">
                    <input type="button" name="contact_update"  id="contact_update" class="btn btn-sm btn-info col-md-4  col-md-pull-1 pull-right" value="Submit" 
                    style="margin:30px 0px 0px 10px;" /> 
                  </li>
                  </ul>
                </form>
               </div>
            </div>
            <div class="clearfix"></div>
          </div><!--second panel end-->
          <div class="accordion_in panel panel-default no-brd"><!--second panel start-->
            <div class="acc_head panel-heading no-brd">
              <h2><img src="<?php echo base_url();?>assets/userdashboard/images/family.png" alt="user" />Family Details</h2>
              <div class="clearfix"></div>
            </div>
            <div class="acc_content panel-body col-md-12 latest-content">
            <button class ="btn btn-info btn-sm col-md-1 pull-right edits" id="family">Edit</button>
             <div class="col-md-12 no-pad" id="family_data">
                <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Father Name </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad">
                      <?php if(isset($result->father_name)&& !empty($result->father_name)){ $father = $result->father_name; }else{ $father = N.A; }
                            if(isset($result->fa_alive)){$alive =$result->fa_alive;}echo $alive." . ".$father;?>
                      </div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Father Occupation</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->father_occupation)&& !empty($result->father_occupation)){ echo $result->father_occupation;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Mother</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->mother_name)&& !empty($result->mother_name)){ $mother = $result->mother_name; }else{ $mother = N.A; }
                            if(isset($result->ma_alive)){$alives =$result->ma_alive;}
                            echo $alives." . ".$mother;?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Mother Occupation </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->mother_occupation)&& !empty($result->mother_occupation)){ echo $result->mother_occupation;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Elder Brothers</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad" style="line-height:15px;">
                      <?php 
                      if(isset($result->elder_bro)&& !empty($result->elder_bro)){
                       $elderbrothers = $result->elder_bro;
                       if($elderbrothers == "None"){$elderbrothers = "None";}else{$elderbrothers = "Brothers  " .$elderbrothers." , "; }
                      } else{$elderbrothers = "N.A";}
                        if(isset($result->elder_bro1)&& !empty($result->elder_bro1)){$elderbrotherm = $result->elder_bro1;
                       if($elderbrotherm == 0){$elderbrotherm = "None Married";}else{$elderbrotherm = $elderbrotherm."Married" ; }}else{$elderbrotherm = "";}
                    echo $elderbrothers . $elderbrotherm;
                     ?>
                     </div>
                    </div>
                  </li>
                   <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">younger Brothers</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad" style="line-height:15px;">
                      <?php 
                      if(isset($result->young_bro)&& !empty($result->young_bro)){
                       $youngerbrothers = $result->young_bro;
                       if($youngerbrothers == "None"){$youngerbrothers = "None";}else{$youngerbrothers = "Brothers  " .$youngerbrothers.","; }
                      } else{$youngerbrothers = "N.A";}
                        if(isset($result->young_bro1)&& !empty($result->young_bro1)){$youngerbrotherm = $result->young_bro1;
                       if($youngerbrotherm == 0){$youngerbrotherm = "None Married";}else{$youngerbrotherm = $youngerbrotherm."Married" ; }}else{$youngerbrotherm = "";}
                         echo $youngerbrothers . $youngerbrotherm;
                     ?>
                      </div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Elder Sister</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad" style="line-height:15px;">
                      <?php 
                          if(isset($result->elder_sis)&& !empty($result->elder_sis)){
                           $eldersisters = $result->elder_sis;
                           if($eldersisters == "None"){$eldersisters = "None";}else{$eldersisters = "Sisters  ".$eldersisters.",  " ; }
                          } else{$eldersisters = "N.A";}
                            if(isset($result->elder_sis1)&& !empty($result->elder_sis1)){$eldersistersm = $result->elder_sis1;
                           if($eldersistersm == 0){$eldersistersm = "None Married";}else{$eldersistersm = $eldersistersm."Married" ; }}else{$eldersistersm = "";}
                          echo $eldersisters . $eldersistersm;
                     ?>
                      </div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Younger Sister</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad" style="line-height:15px;">
                      <?php 
                      if(isset($result->young_sis)&& !empty($result->young_sis)){
                       $youngersisters = $result->young_sis;
                       if($youngersisters == "None"){$youngersisters = "None";}else{$youngersisters = "Sisters  " .$youngersisters.",  "; }
                      } else{$youngersisters = "N.A";}
                        if(isset($result->young_sis1)&& !empty($result->young_sis1)){$youngersistersm = $result->young_sis1;
                       if($youngersistersm == 0){$youngersistersm = "None Married";}else{$youngersistersm = $youngersistersm."Married" ; }}else{$youngersistersm = "";}
                      echo $youngersisters . $youngersistersm;
                     ?>
                      </div>
                    </div>
                  </li>
                  <div class="clearfix"></div>
                  <li class="col-md-12 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-2 no-pad">About Family</div>
                      <div class="col-md-1 text-right no-pad">:</div>
                      <div class="col-md-9 no-pad"><?php if(isset($result->desc_family)&& !empty($result->desc_family)){ echo $result->desc_family;}else{echo"N.A";}?>.</div>
                    </div>
                  </li>
                  
                  </ul>
              </div>
              <div class="col-md-12 edit" id="family_form" style="display:none">
                <form name="familyform" id="familyform">
                <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Father Name</label>
                      <input type="text" name="fathername" id="fathername" class="form-control" />
                      <div class="clearfix"></div>
                      <div class="col-md-12 sky-form">
                        <ul class="list-inline">
                        <li>
                        <label class="radio"><input type="radio" name="Mr" id="Mr" value="Mr"><i></i>Mr</label></li>
                        <li>
                        <label class="radio"><input type="radio" name="Mr" id="Mr" value="Late"><i></i>Late</label></li>
                        <div class="clearfix"></div>
                      </ul>
                      </div>
                    </div>
                  </li>
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>MotherName </label>
                      <input type="text" name="mothername" id="mothername" class="form-control" />
                      <div class="clearfix"></div>
                       <div class="col-md-12 sky-form">
                        <ul class="list-inline">
                        <li>
                        <label class="radio"><input type="radio" name="Mrs" id="Mrs" value="Mrs"><i></i>Mrs</label></li>
                        <li>
                        <label class="radio"><input type="radio" name="Mrs" id="Mrs" value="Late"><i></i>Late</label></li>
                        <div class="clearfix"></div>
                      </ul>
                      </div>
                    </div>
                  </li>
                      
                   <li class="col-md-6 no-pad" id="father_occupations">
                    <div class="col-md-12">
                      <label>Father Occupation </label>
                      <input type="text" name="fatheroccupation" id="fatheroccupation" class="form-control" />
                    </div>
                  </li>
                   <li class="col-md-6 no-pad" id="mother_occupations">
                    <div class="col-md-12">
                      <label>Mother occupation</label>
                       <input type="text" name="motheroccupatin" id="motheroccupatin" class="form-control" />
                    </div>
                  </li>
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Elder Brothers</label>
                      <select class="form-control" id="elderbrother" name="elderbrother">
                           <option value="">select</option>
                            <option value="None">None</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>                                               
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad" id="emarried">
                    <div class="col-md-12">
                    <label>ELder Brother married</label>
                    <select class="form-control"  name="eldermarried" id="eldermarried">
                           <option value="">select</option>
                    </select>
                      </div>
                  </li>
                  <li class="col-md-6 no-pad" >
                    <div class="col-md-12">
                      <label>Younger Brothers</label>
                      <select class="form-control" id="youngerbrother" name="youngerbrother">
                           <option value="">select</option>
                            <option value="None">None</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>                                               
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6" id="yumarried">
                    <div class="col-md-12">
                    <label>Younger Brother married</label>
                    <select class="form-control"  name="yungermarried" id="yungermarried">
                           <option value="">select</option>
                     </select>
                      </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Elder Sisters</label>
                      <select class="form-control" id="eldersister" name="eldersister">
                           <option value="">select</option>
                            <option value="None">None</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>                                               
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad" id="esmarried">
                    <div class="col-md-12">
                    <label>Elder Sister married</label>
                    <select class="form-control"  name="eldsismarried" id="eldsismarried">
                           <option value="">select</option>
                   </select>
                      </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Younger Sisters</label>
                      <select class="form-control" id="youngsister" name="youngsister">
                           <option value="">select</option>
                            <option value="None">None</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>                                               
                      </select>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad" id="ysmarried">
                    <div class="col-md-12">
                    <label>Younger sister married</label>
                    <select class="form-control"  name="yousismarried" id="yousismarried">
                           <option value="">select</option>
                                           
                  </select>
                      </div>
                  </li>
                  <li class="col-md-12 no-pad">
                    <div class="col-md-12">
                      <label>About Family</label>
                      <textarea class="form-control" id="abtfamily" name="abtfamily"></textarea>
                    </div>
                  </li>
                  <li class="col-md-12">
                    <input type="button" name="family_update" id="family_update" class="btn btn-info col-md-3  col-md-pull-1 pull-right" value="Submit"/> 
                  </li>
                  </ul>
                </form>
               </div>
            </div>
            <div class="clearfix"></div>
          </div><!--second panel end-->
          
          <div class="accordion_in panel panel-default no-brd"><!--second panel start-->
            <div class="panel-heading acc_head no-brd">
               <h2><img src="<?php echo base_url();?>assets/userdashboard/images/partnership.png" alt="user" />Partner Preference</h2>
              <div class="clearfix"></div>
            </div>
           <div class="acc_content panel-body col-md-12 latest-content">
           <button class ="btn btn-info btn-sm col-md-1 pull-right edits" id="partner">Edit</button>
             <div class="col-md-12 no-pad" id="partner_data">
                <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Looking for</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->look_for)&& !empty($result->look_for)){ echo $result->look_for;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Country Resident In</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->countryresidant_from)&& !empty($result->countryresidant_from)){echo $result->countryresidant_from;}else{echo"N.A";}?></div>
                    </div>
                  </li>
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Age </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->age_from)&& isset($result-> age_to)){echo $result->age_from." - ".$result->age_to."  Years" ;}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Height</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->feet_from)&& isset($result->inch_from)){echo $result->feet_from." / ".$result->inch_from;}?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Complexion</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->Complexion_from)){echo $result->Complexion_from ;}else{echo"N.A";} ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Education Type</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->Education_fromType)){echo $result->Education_fromType ;}else{echo"N.A";} ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Education</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad">
                      <?php
                          if(isset($result->Education_from)&& !empty($result->Education_from)){
                             $edcation = $result->Education_from;
                             $edu = explode(',',$edcation);
                          }
                          foreach($edunames as $eduname){
                              $ename[$eduname->edu_id] = $eduname->education;
                          }
                           foreach($edu as $key)
                           {
                            if(array_key_exists($key, $ename)) {
                               $array_new[$key] = $ename[$key];
                            }
                          }
                          foreach($array_new as $value){
                              echo $value.",";
                          }
                            ?>
                      </div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Occupation Type</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->Occuaption_FromType)){echo $result->Occuaption_FromType ;}else{echo"N.A";} ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Occupation </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad">  <?php
                      
                         if(isset($result->Occuaption_From)&& !empty($result->Occuaption_From)){
                             $ocupation= $result->Occuaption_From;
                             $occ = explode(',',$ocupation);
                             foreach($occupationname as $occname){
                              $oname[$occname->Occ_Id] = $occname->occupation;
                          }
                           foreach($occ as $key)
                           {
                            if(array_key_exists($key, $oname)) {
                               $array_new[$key] = $oname[$key];
                            }
                          }
                          foreach($array_new as $value){
                              echo $value.",";
                          }
                          }
                          else{ echo"N.A";}
                           ?>
                      </div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Annual Income </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php if(isset($result->AnnualIncome_from)){echo $result->AnnualIncome_from ;}else{echo"N.A";} ?></div>
                    </div>
                  </li>
                  </ul>
              </div>
              <div class="col-md-12 edit" id="partner_form" style="display:none">
                <form id="partnerform" name="partnerform">
                 <ul class="list-inline">
                 <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <div class="col-md-12 sky-form no-pad">
                        <ul class="list-inline">
                        <li class="col-md-12 no-pad">
                        <label>Looking For</label>
                        <div class="clearfix"></div>
                       <ul class="list-inline">
                        <li>
                        <label class="checkbox"><input type="checkbox" name="looking[]" id="NeverMarried" value="NeverMarried"><i></i>NeverMarried</label>
                        </li>
                        <li>
                        <label class="checkbox"><input type="checkbox" name="looking[]" id="Separated" value="Separated"><i></i>Separated</label>
                        </li>
                        <li>
                        <label class="checkbox"><input type="checkbox" name="looking[]" id="Divorced" value="Divorced"><i></i>Divorced</label>
                        </li>
                        <li>
                        <label class="checkbox"><input type="checkbox" name="looking[]" id="Widow-Widower" value="Widow/Widower"><i></i>Widow/Widower</label></li>
                        <div class="clearfix"></div>
                      </ul>
                      </li>
                      </ul>
                      </div>
                    </div>
                  </li>
                 <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                       <label>Country Resident In</label>
                      <select class="form-control" id="countryfrom" name="countryfrom">
                           <option value="">--Select Country--</option>  
                            <?php if(isset($country)){
                            foreach($country as $coun){?>
                            <option value="<?php echo $coun->id;?>"><?php echo $coun->name ;?></option>   
                            <?php }
                            }?>                                           
                      </select>
                    </div>
                  </li>
                   <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Age </label>
                      <ul class="list-inline">
                      <li class="col-md-2 text-center">From</li>
                      <li class="col-md-4">
                      <select class="form-control" id="fromage" name="fromage">
                           <option value="">-- Age from--</option> 
                            <?php for($i=18;$i<=100;$i++)
                            {?>
                             <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                             <?php }  ?>  
                      </select>
                    </li>
                    <li class="col-md-2 text-center">To</li>
                    <li class="col-md-4"><select class="form-control" id="toage" name="toage">
                           <option value="">-- Age To-</option>
                        <?php for($i=18;$i<=100;$i++)
                        {?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php  } ?>    
                            
                      </select></li>
                    </ul>

                    </div>
                  </li>
                   
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Height</label>
                      <div class="clearfix"></div>
                      <ul class="list-inline">
                      <li class="col-md-2 text-center">From</li>
                      <li class="col-md-6">
                      <select class="form-control" id="heightfrom" name="heightfrom">
                            <option value="">--Select--</option>
                         <option value="4ft1in(121cm)">4ft 1in( 121cm )</option>
                            <option value="4ft2in(124cm)">4ft 2in( 124cm )</option>
                            <option value="4ft3in(127cm)">4ft 3in( 127cm )</option>
                            <option value="4ft4in(129cm)">4ft 4in( 129cm )</option>
                            <option value="4ft5in(132cm)">4ft 5in( 132cm )</option>
                            <option value="4ft6in(134cm)">4ft 6in( 134cm )</option>
                            <option value="4ft7in(137cm)">4ft 7in( 137cm )</option>
                            <option value="4ft8in(139cm)">4ft 8in( 139cm )</option>
                            <option value="4ft9in(142cm)">4ft 9in( 142cm )</option>
                            <option value="4ft10in(144cm)">4ft 10in( 144cm )</option>
                            <option value="4ft11in(147cm)">4ft 11in( 147cm )</option>
                            <option value="5ft(149cm)">5ft( 149cm )</option>
                            <option value="5ft1in(152cm)">5ft 1in( 152cm )</option>
                            <option value="5ft2in(154cm)">5ft 2in( 154cm )</option>
                            <option value="5ft3in(157cm)">5ft 3in( 157cm )</option>
                            <option value="5ft4in(160cm)">5ft 4in( 160cm )</option>
                            <option value="5ft5in(162cm)">5ft 5in( 162cm )</option>
                            <option value="5ft6in(165cm)">5ft 6in( 165cm )</option>
                            <option value="5ft7in(167cm)">5ft 7in( 167cm )</option>
                            <option value="5ft8in(170cm )">5ft 8in( 170cm )</option>
                            <option value="5ft9in(172cm )">5ft 9in( 172cm )</option>
                            <option value="5ft10in(175cm )">5ft 10in( 175cm )</option>
                            <option value="5ft11in(177cm )">5ft 11in( 177cm )</option>
                            <option value="6ft(180cm)">6ft ( 180cm )</option>
                            <option value="6ft1in(182cm)">6ft 1in( 182cm )</option>
                            <option value="6ft2in(185cm)">6ft 2in( 185cm )</option>
                            <option value="6ft3in(187cm)">6ft 3in( 187cm )</option>
                            <option value="6ft4in(190cm)">6ft 4in( 190cm )</option>
                            <option value="6ft5in(193cm)">6ft 5in( 193cm )</option>
                            <option value="6ft6in(195cm)">6ft 6in( 195cm )</option>
                            <option value="6ft7in(198cm)">6ft 7in( 198cm )</option>
                            <option value="6ft8in(200cm)">6ft 8in( 200cm )</option>
                            <option value="6ft9in(203cm)">6ft 9in( 203cm )</option>
                            <option value="6ft10in(205cm)">6ft 10in( 205cm )</option>
                            <option value="6ft11in(208cm)">6ft 11in( 208cm )</option>
                            <option value="7ft(210cm)">7ft ( 210cm )</option> 
                            
                      </select>
                    </li>
                    <div class="clearfix"></div>
                    <li class="col-md-2 text-center">To</li>
                    <li class="col-md-6">
                      <select class="form-control" id="heightto" name="heightto">
                       <option value="">--Select--</option>
                         <option value="4ft1in(121cm)">4ft 1in( 121cm )</option>
                            <option value="4ft2in(124cm)">4ft 2in( 124cm )</option>
                            <option value="4ft3in(127cm)">4ft 3in( 127cm )</option>
                            <option value="4ft4in(129cm)">4ft 4in( 129cm )</option>
                            <option value="4ft5in(132cm)">4ft 5in( 132cm )</option>
                            <option value="4ft6in(134cm)">4ft 6in( 134cm )</option>
                            <option value="4ft7in(137cm)">4ft 7in( 137cm )</option>
                            <option value="4ft8in(139cm)">4ft 8in( 139cm )</option>
                            <option value="4ft9in(142cm)">4ft 9in( 142cm )</option>
                            <option value="4ft10in(144cm)">4ft 10in( 144cm )</option>
                            <option value="4ft11in(147cm)">4ft 11in( 147cm )</option>
                            <option value="5ft(149cm)">5ft( 149cm )</option>
                            <option value="5ft1in(152cm)">5ft 1in( 152cm )</option>
                            <option value="5ft2in(154cm)">5ft 2in( 154cm )</option>
                            <option value="5ft3in(157cm)">5ft 3in( 157cm )</option>
                            <option value="5ft4in(160cm)">5ft 4in( 160cm )</option>
                            <option value="5ft5in(162cm)">5ft 5in( 162cm )</option>
                            <option value="5ft6in(165cm)">5ft 6in( 165cm )</option>
                            <option value="5ft7in(167cm)">5ft 7in( 167cm )</option>
                            <option value="5ft8in(170cm)">5ft 8in( 170cm )</option>
                            <option value="5ft9in(172cm)">5ft 9in( 172cm )</option>
                            <option value="5ft10in(175cm)">5ft 10in( 175cm )</option>
                            <option value="5ft11in(177cm)">5ft 11in( 177cm )</option>
                            <option value="6ft(180cm)">6ft ( 180cm )</option>
                            <option value="6ft1in(182cm)">6ft 1in( 182cm )</option>
                            <option value="6ft2in(185cm)">6ft 2in( 185cm )</option>
                            <option value="6ft3in(187cm)">6ft 3in( 187cm )</option>
                            <option value="6ft4in(190cm)">6ft 4in( 190cm )</option>
                            <option value="6ft5in(193cm)">6ft 5in( 193cm )</option>
                            <option value="6ft6in(195cm)">6ft 6in( 195cm )</option>
                            <option value="6ft7in(198cm)">6ft 7in( 198cm )</option>
                            <option value="6ft8in(200cm)">6ft 8in( 200cm )</option>
                            <option value="6ft9in(203cm)">6ft 9in( 203cm )</option>
                            <option value="6ft10in(205cm)">6ft 10in( 205cm )</option>
                            <option value="6ft11in(208cm)">6ft 11in( 208cm )</option>
                            <option value="7ft(210cm)">7ft ( 210cm )</option> 
                      </select>
                    </li>
                    </ul>
                       
                    </div>
                  </li>

                  <li class="col-md-6 no-pad">
                    <div class="col-md-12">
                      <label>Complexion</label>
                      <select class="form-control" id="complexionfor" name="complexionfor">
                       <option value="">--select--</option> 
                          <?php if(isset($complexion)){
                                        foreach($complexion as $comp){?>
                                         <option value="<?php echo $comp->cmplex;?>"><?php echo $comp->cmplex ;?></option>   
                                        <?php }
                                    }?> 
                       </select>                                                              
                    </div>
                  </li>
                  <div class="clearfix"></div>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 sky-form">
                      <label>Education</label>
                      <div class="clearfix"></div>
                      <ul class="list-inline">
                      <li>
                      <label class="radio"><input type="radio" name="educationtype" id="educationtype" value="DoesNotMatter"><i></i>DoesNotMatter</label></li>
                      <li><label class="radio"><input type="radio" name="educationtype" id="educationtype" value="Educated"><i></i>Educated</label></li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="col-md-12 no-pad" style="display:none" id="chooseeducation">
                    <div class="col-md-12">
                    <select class="form-control col-md-12" id="educations" name="educations[]" multiple>
                       
                          
                                    <?php if(isset($education)){
                                        foreach($education as $edu){?>
                                         <option value="<?php echo $edu->edu_id;?>"><?php echo $edu->education ;?></option>   
                                        <?php }
                                    }?>
                       </select>                                                              
                    </div> 
                   
                  </div>
                    <div class="clearfix"></div>
                    </div>
                  </li>
                  
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 sky-form">
                      <label>Occupation </label>
                      <div class="clearfix"></div>
                      <ul class="list-inline">
                      <li><label class="radio"><input type="radio" name="occupationtype" id="occupationtype" value="DoesNotMatter"><i></i>DoesNotMatter</label></li>
                      <li><label class="radio"><input type="radio" name="occupationtype" id="occupationtype" value="Working"><i></i>Working</label></li>
                      <li><label class="radio"><input type="radio" name="occupationtype" id="occupationtype" value="Not Working"><i></i>Not Working</label></li>
                    </ul>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 no-pad" style="display:none" id="chooseoccupation">
                   
                     <div class="col-md-12">
                    <select class="form-control" id="occupations" name="occupations[]" multiple>
                       
                                    <?php if(isset($occupation)){
                                        foreach($occupation as $value){?>
                                         <option value="<?php echo $value->Occ_Id;?>"><?php echo $value->occupation ;?></option>   
                                        <?php }
                                    }?>
                       </select>                                                              
                    </div> 
                  </div>
                    <div class="clearfix"></div>
                  </li>
                  
                  <div class="clearfix"></div>
                  <li class="col-md-6 no-pad" id="anualincomee">
                    <div class="col-md-12">
                      <label>Annual Income </label>
                     <select class="form-control" id="incomefor" name="incomefor">
                            
                            <option value="Upto INR 1 Lakh" label="Upto INR 1 Lakh">Upto INR 1 Lakh</option>
                            <option value="INR 1 Lakh to 2 Lakh" label="INR 1 Lakh to 2 Lakh">INR 1 Lakh to 2 Lakh</option>
                            <option value="INR 2 Lakh to 4 Lakh" label="INR 2 Lakh to 4 Lakh">INR 2 Lakh to 4 Lakh</option>
                            <option value="INR 4 Lakh to 7 Lakh" label="INR 4 Lakh to 7 Lakh">INR 4 Lakh to 7 Lakh</option>
                            <option value="INR 7 Lakh to 10 Lakh" label="INR 7 Lakh to 10 Lakh">INR 7 Lakh to 10 Lakh</option>
                            <option value="INR 10 Lakh to 15 Lakh" label="INR 10 Lakh to 15 Lakh">INR 10 Lakh to 15 Lakh</option>
                            <option value="INR 15 Lakh to 20 Lakh" label="INR 15 Lakh to 20 Lakh">INR 15 Lakh to 20 Lakh</option>
                            <option value="INR 20 Lakh to 30 Lakh" label="INR 20 Lakh to 30 Lakh">INR 20 Lakh to 30 Lakh</option>
                            <option value="INR 30 Lakh to 50 Lakh" label="INR 30 Lakh to 50 Lakh">INR 30 Lakh to 50 Lakh</option>
                            <option value="INR 50 Lakh to 75 Lakh" label="INR 50 Lakh to 75 Lakh">INR 50 Lakh to 75 Lakh</option>
                            <option value="INR 75 Lakh to 1 Crore" label="INR 75 Lakh to 1 Crore">INR 75 Lakh to 1 Crore</option>
                            <option value="INR 1 Crore &amp; above" label="INR 1 Crore &amp; above">INR 1 Crore &amp; above</option>
                            <option value="Not applicable" label="Not applicable">Not applicable</option>
                            <option value="Dont want to specify" label="Dont want to specify">Dont want to specify</option>                        
                       </select>   
                    </div>
                  </li>
                 
                
                  <li class="col-md-6">
                    <input type="button" name="partner_update" id="partner_update" class="btn btn-info col-md-4  col-md-pull-1 pull-right" value="Submit" style="margin:30px 0px 0px 0px" /> 
                  </li>
                  </ul>
                </form>
               </div>
            </div>
            <div class="clearfix"></div>
          </div><!--second panel end-->
    
    </div>
    <!-- Accordion end -->
    </div>
     
    <div class="clearfix"></div>
    </div>
    <div class="col-md-3 no-pad"><!--right side start-->
   
      </div><!--right side end-->
    <div class="clearfix"></div>
    <div class="col-md-12">
      <div class="col-md-8 no-pad"><!--left side start-->
        
        <div class="clearfix"></div>
      </div><!--left side end-->
      
    </div>
    <div class="clearfix"></div>
  </div><!--details start-->
</div>
<div class="clearfix"></div>
 <?php $this->load->view('template/userdashboard/footer');?>
  <script type="text/javascript">
    jQuery(document).ready(function($){
    $(".accordion_example1").smk_Accordion();
    $(".accordion_example2").smk_Accordion({
        closeAble: true, //boolean
      });
      
    $('.edits').click(function(){
         var id = this.id;
         var value= $(this).text();
         if(value == 'Edit'){
           $(this).text('Cancel');  
           $('#'+id+"_form").show();
            formName = $('#'+id+"_form").find('form').attr('name');
           $('#'+id+"_data").hide();
           var prfid = $('#profile_id').val();
           
         if(formName == 'aboutform'){ 
          var prfid = $('#profile_id').val(); 
          $.ajax({
                url:"<?php echo base_url(); ?>userdashboard/aboutdata",  
                method:"POST",  
                data:{prfid:prfid},  
                dataType:"json", 
                success:function(data)  
                {  
                    $('#aboutme').val(data.aboutme);  
                }   
          }); }
         
         //basci details edit  
          if(formName == 'basicform'){ 
          var prfid = $('#profile_id').val(); 
          $.ajax({
                url:"<?php echo base_url(); ?>userdashboard/basicdata",  
                method:"POST",  
                data:{prfid:prfid},  
                dataType:"json", 
                success:function(data)  
                {
					//console.log(data);
                  $('#profile_by option[value="'+data.profile_by+'"]').prop('selected', true);
                  $('#reference option[value="'+data.ref_by+'"]').prop('selected', true);
                  $('#surname').val(data.sname);
                  $('#firstname').val(data.fname);
                  $('#lastname').val(data.lname);
                  $('input:radio[name=gender][value='+data.gender+']')[0].checked = true;
                  $('input:radio[name=maritalstatus][value='+data.marital_status+']')[0].checked = true; 
                   var maritualstatus = $('input[name="maritalstatus"]:checked').val(); 
                   if(maritualstatus =="Widow/Widower"||maritualstatus=="Divorced"||maritualstatus=="Separated"){$('.childern').show();}else{$('.childern').hide();}
                   $('#nofchild option[value="'+data.nochild+'"]').prop('selected', true);
                   var nchild = $('#nofchild').val();
                   if(nchild=='None'){$('.child').hide();} else{$('.child').show();}
				   if(data.livig_status && data.livig_status !="None"){
                     $('input:radio[name=Living][value='+data.livig_status+']')[0].checked = true;
				   }
                  $('#dob').val(data.dob);
				  $('#mothertongue option[value="'+data.mothertounge+'"]').prop('selected', true);
                  $('#nationality option[value="'+data.living_in+'"]').prop('selected', true);
                  var phonenum = data.mobile;
                  var num = phonenum.split('-');
                  var countrycode = $('#nationality').val(); 
                  var pcode = num[0];
                  var phcod =countrycode + "_" + pcode;
                  $('#phcode option[value="'+phcod+'"]').prop('selected', true);
                 $('#umobile').val(num[1]) 
                  $('#email').val(data.email);
                }   
          }); }
          
          //physical details edit
          if(formName == 'physicalform'){ 
           var prfid = $('#profile_id').val(); 
          $.ajax({
                url:"<?php echo base_url(); ?>userdashboard/physicaldata",  
                method:"POST",  
                data:{prfid:prfid},  
                dataType:"json", 
                success:function(data)  
                {  
                    
                  $('#height option[value="'+data.feet+'"]').prop('selected', true);
                  $('#weight option[value="'+data.weight+'"]').prop('selected', true);
                  $('#complexion option[value="'+data.cmplxion+'"]').prop('selected', true);
                  $('#bloodgroup option[value="'+data.bldgrp+'"]').prop('selected', true);
                  $('#splcase option[value="'+data.splcases+'"]').prop('selected', true);
                  $('#dite option[value="'+data.dite+'"]').prop('selected', true);
                  $('input:radio[name=bodytype][value='+data.body_type+']')[0].checked = true;
                  $('input:radio[name=Smoke][value='+data.smoke+']')[0].checked = true;
                  $('input:radio[name=Drink][value='+data.drink+']')[0].checked = true;
                }   
          }); }
          
          //horoscope details edit
          if(formName == 'horoform'){ 
           var prfid = $('#profile_id').val(); 
          $.ajax({
                url:"<?php echo base_url(); ?>userdashboard/horodata",  
                method:"POST",  
                data:{prfid:prfid},  
                dataType:"json", 
                success:function(data)  
                {  
				
                  $('#birthplace').val(data.birth_place);
                  $('#hrs option[value="'+data.hrs+'"]').prop('selected', true);
                  $('#minutes option[value="'+data.mins+'"]').prop('selected', true);
                  $('#secs option[value="'+data.secs+'"]').prop('selected', true);
                  $('#period option[value="'+data.period+'"]').prop('selected', true);
                  $('#birthname').val(data.birth_name);
                  $('#gowthram').val(data.gowthram);
                  $('#rasi option[value="'+data.rasi+'"]').prop('selected', true);
                  $('#padam option[value="'+data.paadam+'"]').prop('selected', true);
                  $('#star option[value="'+data.star+'"]').prop('selected', true);
                  $('input:radio[name=horoscope][value="'+data.horoscope+'"]')[0].checked = true; 
                  $('input:radio[name=manglik][value="'+data.manglik+'"]')[0].checked = true;
                }   
          }); }
          
          //  edit professional details
          if(formName == 'professionalform'){ 
           var prfid = $('#profile_id').val(); 
          $.ajax({
                url:"<?php echo base_url(); ?>userdashboard/professionaldata",  
                method:"POST",  
                data:{prfid:prfid},  
                dataType:"json", 
                success:function(data)  
                {  
				
                  $('#education option[value="'+data.edu+'"]').prop('selected', true);
                  $('#edudetails').val(data.edu_details);
                  $('#occupation option[value="'+data.occu+'"]').prop('selected', true);
                  $('#occdetails').val(data.occ_details);
                  $('#income option[value="'+data.income+'"]').prop('selected', true);
                  $('#empin option[value="'+data.empin+'"]').prop('selected', true);
                  $('#empdetails').val(data.employmentdetails);
                  
                  var value = $('#occupation').val();
                 if((value == 1)||(value == 88)){
                     $('.occbox').hide();
                 }
                 else{
                     $('.occbox').show();
                 }
                }   
          }); }
          
          
           //edit contactdetails details
          if(formName == 'contactform'){ 
           var prfid = $('#profile_id').val(); 
          $.ajax({
                url:"<?php echo base_url(); ?>userdashboard/contactsdata",  
                method:"POST",  
                data:{prfid:prfid},  
                dataType:"json", 
                success:function(data)  
                { 
                  $('#address').val(data.address);
                  $('#permanentaddress').val(data.perminantaddress); 
                  $('#country option[value="'+data.country+'"]').prop('selected', true);
                  $('#mobile').val(data.fmobile);
                  $('#landline').val(data.phone);
                  $('#familyorigin').val(data.family_origin);
                  $('#res_statue option[value="'+data.res_status+'"]').prop('selected', true);
                   var contry_id = $('#country').val();
                   if(contry_id!==""){
                          $.ajax({
                               url:"<?php echo base_url(); ?>matrimony/getStates",  
                               method:"POST",  
                               data:{contry_id:contry_id},  
                               success:function(response){
                               var jsonStatesData = JSON.parse(response);
                               if (jsonStatesData == ''){ 
                                    $('#state').html('<option value="">State Not Found</option>');
                               }
                               else{
                                    var i = 1;
                                    $('#state').children('option').remove()
                                    $('#state'+i).html('<option value="">Select State</option>');
                                    $.each(jsonStatesData, function (key, value){
                                    $('[name="state"]').append('<option value="'+value.id+'">' +value.name+ '</option>');
                                    i++;
                                    });
                                    $('#state option[value="'+data.state+'"]').prop('selected', true);
                                     var state_id = $('#state').val();
                                      if(state_id!==""){
                                              var jqxhr = $.ajax({
                                                  type: "POST",
                                                  url: "<?php echo base_url('matrimony/getCities')?>",
                                                  data: {state_id:state_id},
                                                  success:function(res){
                                                       var jsonCityData = JSON.parse(res);
                                                       if (jsonCityData == ''){
                                                            $('#city').html('<option value="">City Not Found</option>');
                                                        }
                                                       else{
                                                            var i = 1;
                                                            $('#city').children('option').remove()
                                                            $('#city'+i).html('<option value="">Select City</option>');
                                                            $.each(jsonCityData, function (key, value){
                                                            $('[name="city"]').append('<option value="'+value.id+'">' +value.name + '</option>');
                                                            i++;
                                                            });
                                                            }
                                                            $('#city option[value="'+data.city+'"]').prop('selected', true);
                                                       }
                                                }); 
                                      } 
                                    }
                                   
                               }
                              
                          });
                   }
                }   
          }); }
          
          //  edit family details
          if(formName == 'familyform'){ 
           var prfid = $('#profile_id').val(); 
          $.ajax({
                url:"<?php echo base_url(); ?>userdashboard/familydata",  
                method:"POST",  
                data:{prfid:prfid},  
                dataType:"json", 
                success:function(data)  
                {
                  $('#fathername').val(data.father_name);
                  $('#mothername').val(data.mother_name);
                  $('input:radio[name = Mr][value="'+data.fa_alive+'"]')[0].checked = true;
                  var fastatus = $('input[name="Mr"]:checked').val();
                  if(fastatus == "Late"){$('#father_occupations').hide(); }else{$('#father_occupations').show();}

                  $('input:radio[name = Mrs][value="'+data.ma_alive+'"]')[0].checked = true;
                   var mostatus = $('input[name="Mrs"]:checked').val();
                  if(mostatus == "Late"){$('#mother_occupations').hide();}else{$('#mother_occupations').show();}
                  
                  $('#fatheroccupation').val(data.father_occupation);
                  $('#motheroccupatin').val(data.mother_occupation);
                  $('#elderbrother option[value="'+data.elder_bro+'"]').prop('selected', true);
                  var elbroval = $('#elderbrother').val();
                  if(elbroval!='None'){ $('#emarried').show(); 
                  $('#eldermarried').children('option').remove()
                  for (i = 0; i<=elbroval; i++)
                  { 
                  $('#eldermarried').append($('<option>',
                  {
                  value: i,
                  text : i, 
                  }));}}else{ $('#emarried').hide(); }
                  $('#eldermarried option[value="'+data.elder_bro1+'"]').prop('selected', true);
                  
                  $('#youngerbrother option[value="'+data.young_bro+'"]').prop('selected', true);
                  var yubroval = $('#youngerbrother').val();
                  if(yubroval!='None'){$('#yumarried').show();$('#yungermarried').children('option').remove()
                    for (i = 0; i<=yubroval; i++){$('#yungermarried').append($('<option>',{value: i,text : i,}));}}else{$('#yumarried').hide();}
                  $('#yungermarried option[value="'+data.young_bro1+'"]').prop('selected', true);
                    
                  $('#eldersister option[value="'+data.elder_sis+'"]').prop('selected', true);
                  var esisval = $('#eldersister').val();
                  if(esisval!='None'){$('#esmarried').show();$('#eldsismarried').children('option').remove()
                    for (i = 0; i<=esisval; i++){$('#eldsismarried').append($('<option>',{value: i,text : i,}));}}else{$('#esmarried').hide();}
                  $('#eldsismarried option[value="'+data.elder_sis1+'"]').prop('selected', true);
                  
                  
                  $('#youngsister option[value="'+data.young_sis+'"]').prop('selected', true);
                  var yusisval = $('#youngsister').val();
                  if(yusisval!='None'){$('#ysmarried').show();$('#yousismarried').children('option').remove()
                    for (i = 0; i<=yusisval; i++){$('#yousismarried').append($('<option>',{value: i,text : i,}));}}else{$('#ysmarried').hide();}
                  $('#yousismarried option[value="'+data.young_sis1+'"]').prop('selected', true);
                  $('#abtfamily').val(data.desc_family);
                  
                  var falive = $("input[name='Mr']:checked").val();
                  if(falive =='Late'){
                      $('#father_occupations').hide();
                      $('#fatheroccupation').val("");
                  }
                  else{
                     $('#father_occupations').show(); 
                  }
                  var malive = $("input[name='Mrs']:checked").val();
                  if(malive =='Late'){
                      $('#mother_occupations').hide();
                      $('#motheroccupatin').val("");
                  }
                  else{
                     $('#mother_occupations').show(); 
                  }
                }   
          }) }
          
          //  edit partner details
          if(formName == 'partnerform'){ 
           var prfid = $('#profile_id').val(); 
          $.ajax({
                url:"<?php echo base_url(); ?>userdashboard/partnerdata",  
                method:"POST",  
                data:{prfid:prfid},  
                dataType:"json", 
                success:function(data)  
                {
               
                  var arrayValues = data.look_for.split(',');
                   $.each(arrayValues,function(i,val){
					   if(val=="Widow/Widower"){
						   
						   val="Widow-Widower";
					   }
					   if(val !=""){
					   $('#'+val).prop('checked', true);
					   }
                   }); 
				    $('#countryfrom option[value="'+data.countryresidant_from+'"]').prop('selected', true);
                  $('#fromage option[value="'+data.age_from+'"]').prop('selected', true);
                  $('#toage option[value="'+data.age_to+'"]').prop('selected', true);
                  $('#heightfrom option[value="'+data.feet_from+'"]').prop('selected', true);
                  $('#heightto option[value="'+data.inch_from+'"]').prop('selected', true);
                  $('#complexionfor option[value="'+data.Complexion_from+'"]').prop('selected', true); 
                  $('input:radio[name = educationtype][value="'+data.Education_fromType+'"]')[0].checked = true; 
                  
                   var education_type = $('input[name="educationtype"]:checked').val(); 
                   if(education_type =="Educated"){ $('#chooseeducation').show();}else{$('#chooseeducation').hide();}
				   
	         $('input:radio[name = occupationtype][value="'+data.Occuaption_FromType+'"]')[0].checked = true; 
                  var organisation_type = $('input[name="occupationtype"]:checked').val();
                  if(organisation_type =="Working"){ 
                      $('#chooseoccupation').show();
                      $('#anualincomee').show();}
                  else{$('#chooseoccupation').hide();
                        $('#anualincomee').hide();}
			var arrayEdu = data.Education_from.split(','); 
                   $.each(arrayEdu,function(i,val){
                     $("#educations").find(":checkbox[value='"+ val+ "']").attr("checked","checked");
                     $("#educations option[value='" + val + "']").prop("selected",true);
                     $("#educations").multiselect("refresh");
                  }); 
					 var arrayEdu = data.Occuaption_From.split(','); 
                   $.each(arrayEdu,function(i,val){
                     $("#occupations").find(":checkbox[value='"+ val+ "']").attr("checked","checked");
                     $("#occupations option[value='" + val + "']").prop("selected",true);
                     $("#occupations").multiselect("refresh");
                  }); 
              
                }    
                   
          }) }
         }
         else if(value == 'Cancel'){
           $(this).text('Edit')  
           $('#'+id+"_form").hide();
           $('#'+id+"_data").show();
         }
      });
    });
    
    
    //update aboutme
     $(document).on('click','#ab_update',function(){
              var profile_id = $('#profile_id').val();
              var aboutme = $('#aboutme').val();
              $.ajax({
               method:"POST",
                url:"<?php echo base_url();?>userdashboard/aboutupdate",  
                data:{profile_id:profile_id,aboutme:aboutme}, 
                success:function(data)  
                { 
					$('#about').before('button').text('Edit');
					$('#about').text('Edit');
                    $('#about_data').show();
                    $('#about_data').load(document.URL +  ' #about_data');
                    $('#about_form').hide();
		
                }   
          });       
      });
      
      //update basicdata  
       $(document).on('click','#basic_update',function(){
              $.ajax({
               method:"POST",
                url:"<?php echo base_url();?>userdashboard/basicupdate",  
                data:$("form").serialize(), 
                success:function(data)  
                { 
                   $('#basic').before('button').text('Edit');
					$('#basic').text('Edit');
					$('#basic_data').show();
                    $('#basic_data').load(document.URL +  ' #basic_data');
                    $('#basic_form').hide();
                   
                }   
          });       
      });
      
       //update physicaldata  
       $(document).on('click','#physical_update',function(){
              $.ajax({
               method:"POST",
                url:"<?php echo base_url();?>userdashboard/physicalupdate",  
                data:$("form").serialize(), 
                success:function(data)  
                { 
					$('#physical').before('button').text('Edit');
					$('#physical').text('Edit');
                    $('#physical_data').show();
                    $('#physical_data').load(document.URL +  ' #physical_data');
                    $('#physical_form').hide();
					  
                }   
          });       
      });
      
      // update horoscope
      $(document).on('click','#horo_update',function(){
              $.ajax({
               method:"POST",
                url:"<?php echo base_url();?>userdashboard/horoupdate",  
                data:$("form").serialize(), 
                success:function(data)  
                { 
				    $('#horo').before('button').text('Edit');
					$('#horo').text('Edit');
				    $('#horo_data').before('button').text('Edit');
                    $('#horo_data').show();
                    $('#horo_data').load(document.URL +  ' #horo_data');
                    $('#horo_form').hide();
                }   
          });       
      });
      
      //update professional data
      $(document).on('click','#prf_update',function(){
              $.ajax({
               method:"POST",
                url:"<?php echo base_url();?>userdashboard/professionalupdate",  
                data:$("form").serialize(), 
                success:function(data)  
                { 
				    $('#professional').before('button').text('Edit');
					$('#professional').text('Edit');
                    $('#professional_data').show();
                    $('#professional_data').load(document.URL +  ' #professional_data');
                    $('#professional_form').hide();
                }   
          });       
      });
      
     //update contact details data  
      $(document).on('click','#contact_update',function(){
              $.ajax({
               method:"POST",
                url:"<?php echo base_url();?>userdashboard/contactsupdate",  
                data:$("form").serialize(), 
                success:function(data)  
                { 
				    $('#contact').before('button').text('Edit');
					$('#contact').text('Edit');
                    $('#contact_data').show();
                    $('#contact_data').load(document.URL +  ' #contact_data');
                    $('#contact_form').hide();
                }   
          });       
      });
       
    //update family details data  
      $(document).on('click','#family_update',function(){
              $.ajax({
               method:"POST",
                url:"<?php echo base_url();?>userdashboard/familyupdate",  
                data:$("form").serialize(), 
                success:function(data)  
                { 
				    $('#family').before('button').text('Edit');
					$('#family').text('Edit');
                    $('#family_data').show();
                    $('#family_data').load(document.URL +  ' #family_data');
                    $('#family_form').hide();
                }   
          });       
      });  
   
  $(document).ready(function(){
      $('#occupation').change(function(){
       var value = $(this).val();
       if((value ==1) ||(value==88)){
           $('.occbox').hide();
       }
       else{
           $('.occbox').show();
       }
       
   });
   
    $('#country').on('change', function() {     
    var contry_id = $("#country").val();
    var jqxhr = $.ajax({
        type: "POST",
        url: "<?php echo base_url('matrimony/getStates')?>",
        data: {contry_id:contry_id},
        beforeSend : function(){
        }
        }).done(function(data){
            var jsonStatesData = JSON.parse(data);
            if (jsonStatesData == '') 
        {
            $('#state').html('<option value="">State Not Found</option>');
        }
        else{
            var i = 1;
            $('#state').children('option').remove()
            $('#state'+i).html('<option value="">Select State</option>');
            $.each(jsonStatesData, function (key, value){
            $('[name="state"]').append('<option value="'+value.id+'">' +value.name+ '</option>');
                i++;
                });
        }
          }); 
    });
    $('#state').on('change', function() {     
    var state_id = $("#state").val();
    var jqxhr = $.ajax({
        type: "POST",
        url: "<?php echo base_url('matrimony/getCities')?>",
        data: {state_id:state_id},
        beforeSend : function(){
        }
        }).done(function(data){
            var jsonCityData = JSON.parse(data);
            if (jsonCityData == '') 
        {
            $('#city').html('<option value="">City Not Found</option>');
        }
        else{
            var i = 1;
            $('#city').children('option').remove()
            $('#city'+i).html('<option value="">Select City</option>');
            $.each(jsonCityData, function (key, value){
            $('[name="city"]').append('<option value="'+value.id+'">' +value.name + '</option>');
                i++;
                });
        }
          }); 
    }); 
    
    
      $('input[name="Mr"]').click(function(){
      var inpval = $(this).attr("value");
      if(inpval == "Late"){
          $('#father_occupations').hide();
      }
      else{
          $('#father_occupations').show(); 
      }
  }); 
  
    $('input[name="Mrs"]').click(function(){
      var inpval = $(this).attr("value");
      if(inpval == "Late"){
          $('#mother_occupations').hide();
      }
      else{
          $('#mother_occupations').show(); 
      }
  });
  
   $('#occupation').change(function(){
       var value = $(this).val();
       if((value ==1) ||(value==88)){
           $('.occbox').hide();
       }
       else{
           $('.occbox').show();
       }
   }); 
  
 $('#educations').multiselect({
          nonSelectedText: 'Select Education'
      });
      
$('#occupations').multiselect({
     nonSelectedText: 'Select Occupation'
})  

 $('input[name="educationtype"]').click(function(){
          var inputvalue =$(this).attr("value");
          if(inputvalue =="Educated"){
              $('#chooseeducation').show();
          }
          else{
              $('#chooseeducation').hide();
          }
          
      }); 
      
      $('input[name="occupationtype"]').click(function(){
          var inputvalue =$(this).attr("value");
          if(inputvalue =="Working"){
              $('#chooseoccupation').show();
               $('#anualincomee').show();
              
          }
          else{
              $('#chooseoccupation').hide();
              $('#anualincomee').hide();
          }
          
      });
      
       $('input[name="maritalstatus"]').click(function(){
                var inputValue = $(this).attr("value");
                
                if(inputValue=="Widow/Widower"||inputValue=="Divorced"||inputValue=="Separated"){
                    $('.childern').show();
                    
                }
                else{
                    $('.childern').hide();
                }
            });
            
             $('#nofchild').change(function(){
               var option = $(this).val();
               if(option=='None'){
                   $('.child').hide();
               }
               else{
                   $('.child').show();
               }
              
           }); 
  
  });
      $(document).on('change','#nationality',function(){
        var value = $('#nationality').val();
        $('#phcode option').each(function(){
          var text =  $(this).text();
          var option = $(this).val();
          var data = option.split('_');
           if(value === data[0]){
               $(this).prop('selected',true);
           }
        });
        
    });
      
     $(document).on('change','#elderbrother',function(){
          var elbroval = $(this).val();
          if(elbroval!='None'){
          $('#emarried').show();
          $('#eldermarried').children('option').remove()
          for (i = 0; i<=elbroval; i++)
          { 
          $('#eldermarried').append($('<option>',
          {
            value: i,
            text : i, 
          }));
          }
        }
        else{
          $('#emarried').hide();
          $('#eldermarried').children('option').remove()   
        }
         
     })    
    $(document).on('change','#youngerbrother',function(){
          var ybroval = $(this).val();
          if(ybroval!='None'){
          $('#yumarried').show();
          $('#yungermarried').children('option').remove()
          for (i = 0; i<=ybroval; i++)
          { 
          $('#yungermarried').append($('<option>',
          {
            value: i,
            text : i, 
          }));
          }
        }
        else{
          $('#yumarried').hide();
          $('#yungermarried').children('option').remove()   
        }
         
     })      
   
   
   $(document).on('change','#eldersister',function(){
          var esisval = $(this).val();
          if(esisval!='None'){
          $('#esmarried').show();
          $('#eldsismarried').children('option').remove()
          
          for (i = 0; i<=esisval; i++)
          { 
          $('#eldsismarried').append($('<option>',
          {
            value: i,
            text : i, 
          }));
          }
        }
        else{
          $('#esmarried').hide(); 
           $('#eldsismarried').children('option').remove()   
        }
         
     })
     
  $(document).on('change','#youngsister',function(){
          var ysisval = $(this).val();
          if(ysisval!='None'){
          $('#ysmarried').show();
          $('#yousismarried').children('option').remove()
          for (i = 0; i<=ysisval; i++)
          { 
          $('#yousismarried').append($('<option>',
          {
            value: i,
            text : i, 
          }));
          }
        }
        else{
          $('#ysmarried').hide(); 
           $('#yousismarried').children('option').remove()  
        }
         
     })  
	 
	 
	 // //update patner details data  
      $(document).on('click','#partner_update',function(){
              $.ajax({
               method:"POST",
                url:"<?php echo base_url();?>userdashboard/partnerupdate",  
                data:$("form").serialize(), 
                success:function(data)  
                { 
                    $('#partner').before('button').text('Edit');
					$('#partner').text('Edit');
					$('#partner_data').show();
                    $('#partner_data').load(document.URL +  ' #partner_data');
                    $('#partner_form').hide();
                }   
          });       
      });         
     
                  
  </script>
</body>
</html>

