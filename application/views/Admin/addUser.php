 <?php
$this->load->view('Admin/common_header');
$this->load->view('Admin/sidenav');

?> 
<style>
.box-title{
	color:green;
	font-size:16px;
	font-weight:bold;
	}
        .form-control{
            margin-top:5px;
        }
</style>
  <!-- =============================================== -->

<link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css"> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add User Profiles
      </h1>
    </section>

    <section class="content"><!-- Main content start -->
     <?php if($this->session->flashdata('useradd_error')){ ?>
            <div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong> A problem has been occurred while adding userData.
	    </div>
        <?php } ?>
        
         <?php if($this->session->flashdata('useradd_sucess')){ ?>
           <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
               <strong>Success!</strong> User added successfully.
          </div>
        <?php } ?>
         <?php if($this->session->set_flashdata('photos_error')){ ?>
            <div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong><?php $this->session->set_flashdata('photos_error')?>.
	    </div>
        <?php } ?>
        
      <div class="box box-default">
        <form name="userform" method="post" id="userform" enctype="multipart/form-data" action="<?php echo base_url('admin/addUser');?>">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
               	<label class="col-sm-3 control-label">Receiptnumber:</label>
                <div class="col-sm-9">
                 <input type="text" class="form-control" name="receiptnumber" id="receiptnumber" required >
                </div>
              </div>
              <!-- /.form-group -->
              </div>
              <!-- /.col-md-6 -->
            </div>
             <!-- /.row -->
             <div class="box-header with-border">
          		<h3 class="box-title">Personal Details/Basic Information</h3>
             </div>
            <div class="row">
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-3 control-label">Profile By</label>
                <div class="col-sm-9">
                 <select name="profile_by"  id="profile_by" class="form-control input-sm" required>
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
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label class="col-sm-3 control-label">Surname</label>
                <div class="col-sm-9">
                 <input type="text" class="form-control" name="surname" id="surname" required="required" >
                 </div>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-3 control-label">Reference By</label>
                <div class="col-sm-9">
                 <select name="ref_by"  id="ref_by" class="form-control input-sm" required>
                    <option value="">Select</option> 
                    <option value="Advertisements">Advertisements</option>
                    <option value="Friends">Friends</option>
                    <option value="Sanghams">Sanghams</option>
                    <option value="SearchEngine"> Search Engine</option>
                    <option value="Others">Others</option>                                        
                 </select>
                 </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label class="col-sm-3 control-label">FirstName</label>
                <div class="col-sm-9">
                 <input type="text" class="form-control" name="firstname" id="firstname" required="required" >
                 </div>
              </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-3 control-label">LastName</label>
                <div class="col-sm-9">
                 <input type="text" class="form-control" name="lastname" id="lastname" >
                 </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label class="col-sm-3 control-label">Gender</label>
              <div class="col-sm-9">
               <label>
                  <input type="radio" name="gender" class="flat-red" value="Female" required="required"> Female
                </label>
                <label>
                  <input type="radio" name="gender" class="flat-red" value="Male">Male
                </label>
              </div>
              <!-- /.form-group -->
            </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
               <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-9">
                 <input type="email" class="form-control" name="email" id="email" onChange="checkemail();"  required>
                 <span id="email_error" style="display:none;color:red">email already exists</span>
                 </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
               <label class="col-sm-3 control-label">Date Of Birth</label>
                <div class="col-sm-9">
                  <input type="text" id="dob" name="dob" class="form-control" required/>
                 </div>
                </div>
              </div>
              <!-- /.form-group -->
            
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-3 control-label">Birth place</label>
                <div class="col-sm-9">
                 <input type="text" class="form-control" name="birthplace" id="birthplace" required >
                 </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
              <label class="col-sm-3 control-label">Martial Status</label>
              <div class="col-sm-9">
               <label><input type="radio" name="maritalstatus" class="flat-red " value="Never Married" required> Never Married</label>
               <label><input type="radio" name="maritalstatus" class="flat-red" value="Widow/Widower">Widow/Widower</label>
               <label><input type="radio" name="maritalstatus" class="flat-red" value="Divorced">Divorced</label>
               <label><input type="radio" name="maritalstatus" class="flat-red" value="Separated">Separated</label>
              </div>
                
              </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-6">
              <div class="form-group">
                 <label class="col-sm-3 control-label">Birth Time</label>
               <div class="col-sm-2">
                 <select name="hrs" id="hrs" class="form-control input-sm" required>
                   <option value="">Hrs</option>
                   <option value="Dont Know">Dont Know</option>
                     <?php for($i=1;$i<=12;$i++){
                           if($i<=9){ ?>
                   <option value="<?php echo "0".$i;?>"><?php echo "0".$i;?></option>
                    <?php }else{?>
                   <option value="<?php echo $i;?>"><?php echo $i;?></option>
                   <?php }}?>
                 </select> 
                 </div>
                 
                 <div class="col-sm-3">
                 <select name="minutes" id="minutes"  class="form-control input-sm" required>
                            <option value="">Minutes</option>
                             <option value="Dont Know">Dont Know</option>
                             <?php for($i=0;$i<=59;$i++){
                                 if($i<=9){ ?>
                                     <option value="<?php echo "0".$i;?>"><?php echo "0".$i;?></option>
                                 <?php }else{?>
                                   <option value="<?php echo $i;?>"><?php echo $i;?></option>
                             <?php }}?>
                        </select>  
                 </div>
                 <div class="col-sm-2">
                 <select name="secs" id="secs" class="form-control input-sm" required>
                            <option value="">sec</option>
                             <option value="Dont Know">Dont Know</option>
                             <?php for($i=0;$i<=59;$i++){
                                 if($i<=9){ ?>
                                     <option value="<?php echo "0".$i;?>"><?php echo "0".$i;?></option>
                                 <?php }else{?>
                                   <option value="<?php echo $i;?>"><?php echo $i;?></option>
                             <?php }}?>
                        </select>  
                 </div>
                 <div class="col-md-2">
                          <select name="period" id="period" tabindex="1" class="form-control input-sm" required>
                            <option value="">at</option>
                             <option value="Dont Know">Dont Know</option>
                             <option value="AM">AM</option>
                             <option value="PM">PM</option>
                        </select>   
                    </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                  <label class="col-sm-3 control-label">Height</label>
                 <div class="col-sm-9">
                 <select name="feet" id="feet" class="form-control input-sm" required >
                    <option value="">--select--</option> 
                       <?php if(isset($height)){
                              foreach($height as $value){?>
                              <option value="<?php echo $value->feet;?>"><?php echo $value->feet ;?></option>   
                              <?php }}?>                               
                        </select>  
                 </div>
              </div>
              <!-- /.form-group -->
            </div>
            <div class ="childern">
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-3 control-label">No.of Children</label>
                <div class="col-sm-9">
                     <select name="nofchild" id="nofchild" class="form-control input-sm">
                         <option value="">--select--</option>                                 
                         <option value="None">None</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                    </select>
                 </div>
              </div>
              </div>
               <div class="col-md-6 child">
               <div class="form-group">
                <label class="col-sm-3 control-label">Children Living Status</label>
              <div class="col-sm-9">
               <label>
                  <input type="radio" name="Living" class="flat-red" value="ChildrenLiving"> ChildrenLiving
                </label>
                <label>
                  <input type="radio" name="Living" class="flat-red" value="ChildrenNotLiving">ChildrenNotLiving
                </label>
              </div>
              <!-- /.form-group -->
              </div>
              </div>
              </div>
             </div>
             <!-- /.row -->
             
             <div class="box-header with-border">
          		<h3 class="box-title">Horoscope Information</h3>
             </div>
             <div class="row">
            <div class="col-md-6">
              <div class="form-group">
               	<label class="col-sm-3 control-label">Birth Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="birthname" id="birthname" >
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label class="col-sm-3 control-label">Gowthram</label>
               <div class="col-sm-9">
                       <input type="text" name="gowthram" class="form-control input-sm"  placeholder="gowthram" required/>
               </div>
             </div>
              <div class="form-group">
               	 <label class="col-sm-3 control-label">Rasi</label>
                 <div class="col-sm-9">
                 <select name="rasi" id="rasi" class="form-control input-sm" required >
                    <option value="">--select--</option> 
                       <?php if(isset($rasi)){
                             foreach($rasi as $rasi){?>
                             <option value="<?php echo $rasi-> rasi_id;?>"><?php echo $rasi->rasi;?></option>   
                             <?php }}?>                              
                        </select>  
                 </div>
              </div>
              <!-- /.form-group -->
              
              
              </div>
              <!-- /.col-md-6 -->
              
              <div class="col-md-6">
              <div class="form-group">
               	<label class="col-sm-3 control-label">Nakshathram</label>
                <div class="col-sm-9">
                 <select name="star" id="star" class="form-control input-sm" required>
                           <option value="">--select--</option>
                            <?php if(isset($star)){
                                   foreach($star as $star){?>
                                         <option value="<?php echo $star-> star_id;?>"><?php echo $star->star ;?></option>   
                                        <?php }
                                    }?> 
                        </select>
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
               	 <label class="col-sm-3 control-label">Paadam</label>
                 <div class="col-sm-9">
                <select name="paadam" id="paadam" class="form-control input-sm" required>
                            <option value="">--Choose paadam--</option>
                             <option value="Dont Know">Dont Know</option>
                             <option value="1">1</option>
                             <option value="2">2</option>
                             <option value="3">3</option>
                             <option value="4">4</option>
                        </select> 
                 </div>
              </div>
              <!-- /.form-group -->
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Horoscope Match</label>
                    <div class="col-sm-9">
                   <label>
                      <input type="radio" name="horoscope" class="flat-red" value="Yes" required="required"> Yes
                    </label>
                    <label>
                      <input type="radio" name="horoscope" class="flat-red" value="No">No
                    </label>
                    <label>
                      <input type="radio" name="horoscope" class="flat-red" value="Doesn't Matter">Don'tKnow
                    </label>
                  </div>
                  </div>
              </div>
               <div class="col-md-6">
              <!-- /.form-group -->
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Manglik Status</label>
                    <div class="col-sm-9">
                       <label>
                          <input type="radio" name="manglik" class="flat-red" value="Yes" required="required"> Yes
                        </label>
                        <label>
                          <input type="radio" name="manglik" class="flat-red" value="No">No
                        </label>
                        <label>
                          <input type="radio" name="manglik" class="flat-red" value="Doesn't Matter">Don'tKnow
                        </label>
                   </div>
                 </div>
              <!-- /.form-group -->
              </div>
            </div>
            
            <div class="box-header with-border">
          		<h3 class="box-title">Contact Details/Residence Information</h3>
            </div>
            <div class="row">
            	<div class="col-md-6">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Country</label>
                        <div class="col-sm-9">
                         <select name="country" id="country" class="form-control input-sm" required>
                                    <option value="">--Select Country--</option>  
                                    <?php if(isset($country)){
                                    foreach($country as $coun){?>
                                    <option value="<?php echo $coun->id;?>"><?php echo $coun->name ;?></option>   
                                    <?php }
                                    }?>                                           
                                </select>  
                        </div>
                    </div>
              <!-- /.form-group -->
                      <div class="form-group">
                         <label class="col-sm-3 control-label">City</label>
                         <div class="col-sm-9">
                        <select name="city" id="city" class="form-control input-sm" required >
                          <option value="">--Select City--</option>
                        </select>
                         </div>
                       </div>
              <!-- /.form-group -->
                 </div>
              <!-- /.col-md-6 -->
              
                  <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">State</label>
                        <div class="col-sm-9">
                          <select name="state"  id="state" class="form-control input-sm" required >
                                    <option value="">--Select State--</option>
                                </select>
                        </div>
                      </div>
                       <div class="form-group">
                        <label class="col-sm-3 control-label">Resident Status</label>
                        <div class="col-sm-9">
                         <select name="res_status" class="form-control input-sm" required>
                                    <option value="">--select--</option>
                                    <option value="Dont Want To Specify">Dont Want To Specify</option>
                                    <option value="Rental">Rental</option>
                                    <option value="Own">Own</option>
                                </select>   
                        </div>
                      </div>
                </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Present Address</label>
                        <div class="col-sm-9">
                          <textarea name="address" id="address" class="form-control input-sm" rows="3" placeholder="Address" required></textarea>
                          <input type="checkbox" value="sameadd" name="sameadadd" id="sameadadd"><label>Same As Address</label>                        </div>
                      </div>
              <!-- /.form-group -->
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Permanent Address</label>
                     <div class="col-sm-9">
                     <textarea name="paddress" id="paddress" class="form-control input-sm" rows="3" placeholder="Permanent Address" required="required"></textarea>     
                     </div>
              </div>
              <!-- /.form-group -->
          
              </div>
              <!-- /.col-md-6 -->
                  <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Nationality</label>
                        <div class="col-sm-9">
                         <select name="nationality"  id="nationality" class="form-control input-sm" required>
                            <option value="">Please select</option>
                               <?php 
                                    if(isset($country)){
                                     foreach($country as $nationalities){?>
                                      <option value="<?php echo $nationalities->id;?>"><?php echo $nationalities->name;?></option>   
                                     <?php }}?>
                          </select>
                        </div>
                      </div>
              <!-- /.form-group -->
                      <div class="form-group">
                         <label class="col-sm-3 control-label">Mobile Number</label>
                         <div class="col-sm-4">
                        <select name="phcode"  id="phcode" class="form-control input-sm" required>
                           <option value="">Please select</option>
                              <?php  if(isset($country)){
                                      foreach($country as $nationalities){?>
                                     <option value="<?php echo $nationalities->id."_+".$nationalities->phonecode;?>">
                                     <?php echo $nationalities->name ."(+".$nationalities->phonecode.")";?></option>   
                                      <?php }}?>
                           </select>
                         </div>
                         <div class="col-sm-5">
                             <input type="text" name="mobile" id="mobile"  onchange="checkmobile();" class="form-control input-sm" required>                   <span id="mobile_error" style="display:none;color:red">Mobile Number already exists</span>
                         </div>
                     </div>
              </div>
              <!-- /.form-group -->
                  <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Land Line</label>
                        <div class="col-sm-9">
                       <input type="text" name="LandLine" class="form-control input-sm"  placeholder="Land Line"/>
                      </div>
                      </div>
                       <div class="form-group">
                         <label class="col-sm-3 control-label">Alternate Mobile</label>
                        <div class="col-sm-9">
                       <input type="text" name="AlternateMobile" class="form-control input-sm"  placeholder="Alternate Mobile" required/>
                      </div>
                      </div>
              </div>
                  <div class="col-md-6">
              <!-- /.form-group -->
                  <div class="form-group">
                    <label class="col-sm-3 control-label">About me</label>
                    <div class="col-sm-9">
                   <textarea name="Aboutme" class="form-control input-sm" rows="1" placeholder="Describe About you" required="required"></textarea>    
                  </div>
                  </div>
                   <div class="form-group">
                     <label class="col-sm-3 control-label">Family Origin</label>
                    <div class="col-sm-9">
                   <input type="text" name="family_origin" class="form-control input-sm"  placeholder="Family Origin" required/>
                  </div>
                  </div>
              </div>
              <!-- /.form-group -->
              
              
              </div>
              
               <div class="box-header with-border">
          		<h3 class="box-title">Physical Attributes</h3>
             </div>
              <div class="row">
            <div class="col-md-6">
              <div class="form-group">
               	<label class="col-sm-3 control-label">Weight:</label>
                <div class="col-sm-9">
                 <select name="weight" id="weight" class="form-control input-sm" required>
                    <option value="NONE">--select--</option> 
                      <option value="Dont Know">Don't Know</option>
                         <?Php  for ($we = 30; $we <= 300; $we++) {  ?>
                         <option value="<?php echo $we; ?>"><?php echo $we; ?> Kgs</option> 
                        <?php } ?>                                 
                 </select>
                </div>
              </div>
              <div class="form-group">
               	<label class="col-sm-3 control-label">Complexion:</label>
                <div class="col-sm-9">
                  <select name="complexion" id="complexion" class="form-control input-sm"  required>
                            <option value="">--select--</option> 
                                 <?php if(isset($complexion)){
                                        foreach($complexion as $comp){?>
                                         <option value="<?php echo $comp->cmplex;?>"><?php echo $comp->cmplex ;?></option>   
                                        <?php }
                                    }?>                               
                        </select>     
                </div>
              </div>
              <!-- /.form-group -->
              </div>
              <!-- /.col-md-6 -->
              
              <div class="col-md-6">
              <div class="form-group">
               	<label class="col-sm-3 control-label">Body Type:</label>
                <div class="col-sm-9">
                  <label><input type="radio" name="bodytype" class="flat-red" value="Slim" required> Slim</label>
                <label><input type="radio" name="bodytype" class="flat-red" value="Average">Average</label>
                <label><input type="radio" name="bodytype" class="flat-red" value="Athletic"> Athletic</label>
                <label><input type="radio" name="bodytype" class="flat-red" value="Heavy">Heavy</label>
                </div>
              </div>
              <div class="form-group">
               	<label class="col-sm-3 control-label">Blood Group :</label>
                <div class="col-sm-9">
                  <select name="bloodgroup" id="bloodgroup" class="form-control input-sm" required>
                           <option value="">--select--</option>
                                 <?php if(isset($bloodgroup)){
                                        foreach($bloodgroup as $blood){?>
                                         <option value="<?php echo $blood->bldgroup;?>"><?php echo $blood->bldgroup ;?></option>   
                                        <?php }
                                    }?> 
                                    <option value="Don'tKnow">Dontknow</option>
                        </select>   
                </div>
              </div>
              <!-- /.form-group -->
              </div>
              <div class="col-md-6">
              <div class="form-group">
               	<label class="col-sm-3 control-label">Special Cases:</label>
                <div class="col-sm-9">
                 <select name="specilcase" id="specilcase" class="form-control input-sm" required>
                  <option value="">--select--</option>
                    <?php if(isset($specilcase)){
                          foreach($specilcase as $spl){?>
                          <option value="<?php echo $spl->spacial;?>"><?php echo $spl->spacial  ;?></option>   
                        <?php }}?> 
                 </select>
                </div>
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
               	<label class="col-sm-3 control-label">Dite :</label>
                <div class="col-sm-9">
                 <select name="dite" id="dite" tabindex="15" class="form-control input-sm" required>
                             <option value="">--select--</option>
                             <option value="Veg">Veg</option>
                             <option value="Non-Veg">Non-Veg</option>
                             <option value="Both">Both</option>
                        </select>
                </div>
              </div>
              <!-- /.form-group -->
              </div>
              
              
            </div>
              <div class="box-header with-border">
          		<h3 class="box-title">Hobbies</h3>
             </div>
              <div class="row">
            <div class="col-md-6">
              <div class="form-group">
               	<label class="col-sm-3 control-label">Smoke:</label>
                <div class="col-sm-9">
                  <label><input type="radio" name="Smoke" class="flat-red" value="Yes" required> Yes</label>
                <label><input type="radio" name="Smoke" class="flat-red" value="No">No</label>
                <label><input type="radio" name="Smoke" class="flat-red" value="Occasionally"> Occasionally</label>
                </div>
              </div>
              <!-- /.form-group -->
              </div>
              <!-- /.col-md-6 -->
              
              <div class="col-md-6">
              <div class="form-group">
               	<label class="col-sm-3 control-label">Drink:</label>
                <div class="col-sm-9">
                  <label><input type="radio" name="Drink" class="flat-red" value="Yes" required> Yes</label>
                <label><input type="radio" name="Drink" class="flat-red" value="No">No</label>
                <label><input type="radio" name="Drink" class="flat-red" value="Occasionally"> Occasionally</label>
                </div>
              </div>
              <!-- /.form-group -->
              </div>
              </div>
              
              <div class="box-header with-border">
          	<h3 class="box-title">Education Details</h3>
             </div>
              <div class="row">
              <div class="col-md-6">
              <div class="form-group">
               	<label class="col-sm-3 control-label">Education:</label>
                <div class="col-sm-9">
                 <select name="education" id="education" tabindex="1" class="form-control input-sm" required> 
                    <option value="">-- Choose Education--</option>
                        <?php if(isset($education)){
                                        foreach($education as $edu){?>
                                         <option value="<?php echo $edu->edu_id;?>"><?php echo $edu->education ;?></option>   
                                        <?php }
                                    }?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
               	<label class="col-sm-3 control-label">EducationDetails:</label>
                <div class="col-sm-9">
                 <input type="text" class="form-control input-sm"  name="edudetails" id="edudetails" placeholder="(ex:Electronics,computers,Management,etc..)">
                </div>
              </div>
              
              </div>
              <div class="col-md-6">
              <div class="form-group">
               	<label class="col-sm-3 control-label">MotherTongue:</label>
                <div class="col-sm-9">
                 <select name="mothertongue"  id="mothertongue" class="wdth197 form-control input-sm" tabindex="1" required>
                                        <option value="">Please Select Mothertongue</option>
                                        <?php if(isset($mothertongues)){
                                            foreach($mothertongues  as  $value){?>
                                        <option value="<?php echo $value->L_Id;?>"><?php echo $value->Language_Name;?></option>     
                                        <?php }}?>
                                    </select>
                </div>
              </div>
              <!-- /.form-group -->
               <div class="form-group">
               	<label class="col-sm-3 control-label">Occupation:</label>
                <div class="col-sm-9">
                  <select name="occupation" id="occupation" tabindex="1" class="form-control input-sm" required> 
                                <option value="">-- Choose Occupation--</option>
                                 <?php if(isset($occupation)){
                                        foreach($occupation as $ocu){?>
                                         <option value="<?php echo $ocu->Occ_Id;?>"><?php echo $ocu->occupation ;?></option>   
                                        <?php }
                                    }?>
                            </select>
                </div>
              </div>
              
              </div>
              <div class ="ocbox">
              <div class="col-md-6">
              <div class="form-group">
               	<label class="col-sm-3 control-label">OccupationDetails:</label>
                <div class="col-sm-9">
                 <input type="text" class="form-control input-sm" name="occdetails" id="occdetails" placeholder="(ex:S/W,H/W,Marketing,CEO,Military etc..)">
                </div>
              </div>
              <!-- /.form-group -->
               <div class="form-group">
               	<label class="col-sm-3 control-label">Income:</label>
                <div class="col-sm-9">
                  <select name="income" class="form-control input-sm" >
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
                            <option value="INR 1 Crore &amp; above" label="INR 1 Crore &amp; above">INR 1 Crore &amp; above</option>                            <option value="Not applicable" label="Not applicable">Not applicable</option>
                            <option value="Dont want to specify" label="Dont want to specify">Dont want to specify</option>
                        </select>
                </div>
              </div>
              
              </div>
              
              <div class="col-md-6">
              <div class="form-group">
               	<label class="col-sm-3 control-label">EmployedIn:</label>
                <div class="col-sm-9">
                 <select name="empin" id="empin" tabindex="1" class="form-control input-sm"> 
                   <option value="">-- Choose Employeed In--</option>
                     <?php if(isset($employee)){
                            foreach($employee as $emp){?>
                           <option value="<?php echo $emp->emp_id;?>"><?php echo $emp->employee ;?></option>   
                                        <?php }
                                    }?>
                </select>
                </div>
              </div>
              <!-- /.form-group -->
               <div class="form-group">
               	<label class="col-sm-3 control-label">EmploymentDetails:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control input-sm"  name="empdetails" id="empdetails" placeholder="Enter Employement Details">
                </div>
              </div>
              
              </div>
              
              </div>
              
            </div>
            
            <div class="box-header with-border">
          		<h3 class="box-title">Family Details</h3>
             </div>
             <div class="row">
             <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-3 control-label">FatherStatus:</label>
                <div class="col-sm-9">
                <label><input type="radio" name="Mr" class="flat-red" value="Mr" required> Mr</label>
                <label><input type="radio" name="Mr" class="flat-red" value="Late">Late</label>
                </div>
              </div>
              <div class="form-group">
               	<label class="col-sm-3 control-label">FatherName:</label>
                <div class="col-sm-9">
                 <input type="text" name="fathername" class="form-control input-sm"  placeholder="Enter Father Name" required/>
                </div>
              </div>
              
              </div>
             <div class="col-md-6 father_occupations">
              <div class="form-group">
               	<label class="col-sm-3 control-label">FatherOccupation:</label>
                <div class="col-sm-9">
                 <input type="text" name="father_occupation" id="father_occupation" class="form-control input-sm"  placeholder="Occupation"/>   
                </div>
              </div>
              
              </div>
              
              <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-3 control-label">Mother Status:</label>
                <div class="col-sm-9">
                <label><input type="radio" name="Mrs" class="flat-red" value="Mrs" required> Mrs</label>
                <label><input type="radio" name="Mrs" class="flat-red" value="Late">Late</label>
                </div>
              </div>
              <div class="form-group">
               	<label class="col-sm-3 control-label">MotherName:</label>
                <div class="col-sm-9">
                 <input type="text" name="mothername" class="form-control input-sm" id="mothername" placeholder="Enter mother Name" required/>
                </div>
              </div>
              
              </div>
              
              <div class="col-md-6 ">
              <div class="form-group mother_occupations">
               	<label class="col-sm-3 control-label">MotherOccupation:</label>
                <div class="col-sm-9">
                 <input type="text" name="mother_occupation" id="mother_occupation" class="form-control input-sm"  placeholder="Occupation"/>   
                </div>
              </div>
               <div class="form-group">
               	<label class="col-sm-3 control-label">ElderBrother:</label>
                <div class="col-sm-9">
                <select name="elderbro" id="elderbro" class="form-control input-sm" required>
                            <option value="">select</option>
                            <option value="None">None</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>                                               
                        </select>    
                </div>
              </div>
              
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
               	<label class="col-sm-3 control-label">ElderBrorMarried:</label>
                <div class="col-sm-9">
               <select name="elmaried" id="elmaried" class="form-control input-sm">
                 <option value="">select</option>
               </select>    
                </div>
              </div>
              
              <div class="form-group">
               	<label class="col-sm-3 control-label">YoungerBrother:</label>
                <div class="col-sm-9">
                <select name="youngerbro" id="youngerbro" class="form-control input-sm" required>
                            <option value="">select</option>
                            <option value="None">None</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>                                               
                        </select>    
                </div>
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
               	<label class="col-sm-3 control-label">YoungerBrorMarried:</label>
                <div class="col-sm-9">
               <select name="yumaried" id="yumaried" class="form-control input-sm">
                 <option value="">select</option>
               </select>    
                </div>
              </div>
              
              <div class="form-group">
               	<label class="col-sm-3 control-label">Eldersister:</label>
                <div class="col-sm-9">
                <select name="eldersis" id="eldersis" class="form-control input-sm" required>
                            <option value="">select</option>
                            <option value="None">None</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>                                               
                        </select>    
                </div>
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
               	<label class="col-sm-3 control-label">EldersisMarried:</label>
                <div class="col-sm-9">
               <select name="elsismarried" id="elsismarried" class="form-control input-sm">
                 <option value="">select</option>
               </select>    
                </div>
              </div>
              
              <div class="form-group">
               	<label class="col-sm-3 control-label">Youngersister:</label>
                <div class="col-sm-9">
                <select name="youngersis" id="youngersis" class="form-control input-sm" required>
                            <option value="">select</option>
                            <option value="None">None</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>                                               
                        </select>    
                </div>
              </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
               	<label class="col-sm-3 control-label">youngersisMarried:</label>
                <div class="col-sm-9">
               <select name="ysmarried" id="ysmarried" class="form-control input-sm">
                 <option value="">select</option>
               </select>    
                </div>
              </div>
             </div>
             <div class="col-md-6">
             <div class="form-group">
               	<label class="col-sm-3 control-label">AboutFamily:</label>
                <div class="col-sm-9">
              <textarea name="aboutfamily" id="aboutfamily" class="form-control input-sm" rows="1" placeholder="Description About Family" required></textarea>  
                </div>
              </div>
              </div>
             </div>
             
             
             <div class="box-header with-border">
          		<h3 class="box-title">Required Match</h3>
             </div>
             <div class="row">
               <div class="col-md-6">
               	<div class="form-group">
                	<label class="col-sm-3 control-label">Lookingfor:</label>
                <div class="col-sm-9">
                  <label><input type="checkbox" name="looking[]" class="flat-red" value="Never Married" required>NeverMarried</label>
                <label><input type="checkbox" name="looking[]" class="flat-red" value="Divorced">Divorced</label>
                <label><input type="checkbox" name="looking[]" class="flat-red" value="Widow/Widower">Widow/Widower</label>
                <label><input type="checkbox" name="looking[]" class="flat-red" value="Separated">Separated</label>
                </div>
                </div>
                <div class="form-group">
                	<label class="col-sm-3 control-label">CountryResident:</label>
                <div class="col-sm-9">
                  <select name="countryfor" id="countryfor" class="form-control input-sm input-sm1" required>
                       <option value="">--Select Country--</option>  
                            <?php if(isset($country)){
                            foreach($country as $coun){?>
                            <option value="<?php echo $coun->id;?>"><?php echo $coun->name ;?></option>   
                            <?php }
                            }?>     
                    </select>      
                </div>
                </div>
               </div>
               
               <div class="col-md-6">
               	<div class="form-group">
                	<label class="col-sm-3 control-label">Age From:</label>
                <div class="col-sm-9">
                  <select name="agefrom" id="agefrom" class="form-control input-sm input-sm1" required>
                       <option value="">-- Age from--</option> 
                            <?php for($i=18;$i<=100;$i++)
                            {?>
                             <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                             <?php }  ?> 
                    </select>      
                </div>
                </div>
                <div class="form-group">
                	<label class="col-sm-3 control-label">Age to:</label>
                <div class="col-sm-9">
                  <select name="ageto" id="ageto" class="form-control input-sm input-sm1" required>
                       <option value="">-- Age from--</option> 
                            <?php for($i=18;$i<=100;$i++)
                            {?>
                             <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                             <?php }  ?> 
                    </select>      
                </div>
                </div>
               </div>
               <div class="col-md-6">
               	<div class="form-group">
                	<label class="col-sm-3 control-label">HeightFrom:</label>
                <div class="col-sm-9">
                  <select name="feetfor" id="feetfor" class="form-control input-sm input-sm1" required>
                        <?php if(isset($height)){
                                        foreach($height as $value){?>
                                         <option value="<?php echo $value->feet;?>"><?php echo $value->feet ;?></option>   
                                        <?php }
                                    }?>  
                    </select>    
                </div>
                </div>
                <div class="form-group">
                	<label class="col-sm-3 control-label">HeightTo:</label>
                <div class="col-sm-9">
                  <select name="feetto" id="feetto" class="form-control input-sm input-sm1" required>
                       <?php if(isset($height)){
                                        foreach($height as $value){?>
                                         <option value="<?php echo $value->feet;?>"><?php echo $value->feet ;?></option>   
                                        <?php }
                                    }?>  
                    </select>      
                </div>
                </div>
               </div>
               <div class="col-md-6">
               	<div class="form-group">
                <label class="col-sm-3 control-label">Education:</label>
                <div class="col-sm-9">
                 <label><input type="radio" name="educationtype" class="flat-red" value="DoesNotMatter" required>Doesn't Matter</label>
                <label><input type="radio" name="educationtype" class="flat-red" value="Educated">Educated</label>
                </div>
                </div>
                <div class="form-group chooseeducation" style="display:none">
                	<label class="col-sm-3 control-label">Education:</label>
                <div class="col-sm-9">
                 <select name="educations[]" id="educations" tabindex="1" class="form-control input-sm col-md-10" multiple > 
                                <option value="">-- Choose Education--</option>
                                 <?php if(isset($education)){
                                        foreach($education as $edu){?>
                                         <option value="<?php echo $edu->edu_id;?>"><?php echo $edu->education ;?></option>   
                                        <?php }
                                    }?>
                            </select>     
                </div>
                </div>
               </div>
               <div class="col-md-6">
               	<div class="form-group">
                	<label class="col-sm-3 control-label">Occupation:</label>
                <div class="col-sm-9">
                 <label><input type="radio" name="occupationtype" class="flat-red" value="DoesNotMatter" required>Doesn't Matter</label>
                <label><input type="radio" name="occupationtype" class="flat-red" value="Working">Working</label>
                 <label><input type="radio" name="occupationtype" class="flat-red" value="NotWorking">NotWorking</label>
                </div>
                </div>
                <div class="form-group chooseoccupation" style="display:none">
                	<label class="col-sm-3 control-label">Occupation:</label>
                <div class="col-sm-9">
                <select name="occupations[]" id="occupations" tabindex="1" class="form-control input-sm" multiple> 
                                <option value="">-- Choose Occupation--</option>
                                 <?php if(isset($occupation)){
                                        foreach($occupation as $ocu){?>
                                         <option value="<?php echo $ocu->Occ_Id;?>"><?php echo $ocu->occupation ;?></option>   
                                        <?php }
                                    }?>
                            </select>     
                </div>
                </div>
               </div>
               
               <div class="col-md-6">
               	<div class="form-group anualincomee">
                <label class="col-sm-3 control-label">AnnualIncome:</label>
                <div class="col-sm-9">
                  <select name="anualincome" id="anualincome" class="form-control input-sm input-sm1 required">
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
                </div>
                <div class="form-group">
                	<label class="col-sm-3 control-label">Complexion:</label>
                <div class="col-sm-9">
                <select name="cmplxionfor" id="cmplxionfor" tabindex="1" class="form-control input-sm" required> 
                                <option value="">-- Choose Complexion-</option>
                                 <?php if(isset($complexion)){
                                        foreach($complexion as $comp){?>
                                         <option value="<?php echo $comp->cmplex;?>"><?php echo $comp->cmplex ;?></option>   
                                        <?php }
                                    }?>  
                            </select>     
                </div>
                </div>
               </div>
               
             </div>
             
             <div class="box-header with-border">
          		<h3 class="box-title">Package</h3>
             </div>
             <div class="row">
             <div class="col-md-6">
              <div class="form-group">
               <label class="col-sm-6 control-label">ChoosePaymentType:</label>
                <div class="col-sm-6">
                 <label><input type="radio" name="payment" class="flat-red" value="Free" required> Free</label>
                <label><input type="radio" name="payment" class="flat-red" value="Paid">Paid</label>
                </div>
              </div>
              <div class="form-group">
               <label class="col-sm-3 control-label">Image1:</label>
                <div class="col-sm-9">
                 <input type="file" id="image1" name="image1" onchange="imagevalidate(this.value);">
                </div>
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
               <label class="col-sm-3 control-label">ChoosePackage:</label>
                <div class="col-sm-9">
                 <select name="package" id="package" tabindex="1" class="form-control input-sm"> 
                   <option value="">-- Choose Paackage--</option>
                     <?php if(isset($packages)){
                            foreach($packages as $value){?>
                           <option value="<?php echo $value->id;?>"><?php echo $value->name."(Price:".$value->price." Period:",$value->valid.")" ;?></option>   
                                        <?php }
                                    }?>
                </select>
                </div>
              </div>
              <div class="form-group">
               <label class="col-sm-3 control-label">Image2:</label>
                <div class="col-sm-9">
                 <input type="file" id="image2" name="image2" onchange="imagevalidate(this.value);">
                </div>
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
               <label class="col-sm-3 control-label">Image3:</label>
                <div class="col-sm-9">
                 <input type="file" id="image3" name="image3" onchange="imagevalidate(this.value);">
                </div>
              </div>
              <div class="form-group">
               <label class="col-sm-3 control-label">Image5:</label>
                <div class="col-sm-9">
                 <input type="file" id="image5" name="image5" onchange="imagevalidate(this.value);">
                </div>
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
               <label class="col-sm-3 control-label">Image4:</label>
                <div class="col-sm-9">
                 <input type="file" id="image4" name="image4" onchange="imagevalidate(this.value);">
                </div>
              </div>
            
              </div>
             </div>
            </div>
            
        <div class="box-footer">
           <button type="submit" class="btn btn-primary pull-right" name="addform" id="addform">Submit</button>
        </div>
            </form>    
           </div>
           <!-- /.box-body -->
          </div>
       
          </form>
        
       
      </div>
        
     </section>   <!-- Main content end -->
     
  </div>
  <!-- /.content-wrapper -->

   <?php
$this->load->view('Admin/common_fotter');

?> 
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
 <script type="text/javascript">
        $(document).ready(function(){
			
	    $('input[name="educationtype"]').click(function(){
          var inputvalue =$(this).attr("value");
          if(inputvalue =="Educated"){
              $('.chooseeducation').show();
          }
          else{
              $('.chooseeducation').hide();
          }
          
      }); 
	   $('input[name="payment"]').click(function(){
          var inputvalue =$(this).attr("value");
          if(inputvalue =="Free"){
               $('#package').prop('disabled', 'disabled');
          }
          else{
              $('#package').prop('disabled', false);
          }
          
      }); 
	  
	  
	  
	  $('input[name="occupationtype"]').click(function(){
          var inputvalue =$(this).attr("value");
          if(inputvalue =="Working"){
              $('.chooseoccupation').show();
               $('.anualincomee').show();
              
          }
          else{
              $('.chooseoccupation').hide();
              $('.anualincomee').hide();
          }
          
      }); 
           $('input[name="maritalstatus"]').click(function(){
			  
                var inputValue = $(this).attr("value");
                
                if(inputValue=="Widow"||inputValue=="Divorced"||inputValue=="Separated"){
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
		   
		   
		    $('#country').on('change', function() {     
    var contry_id = $("#country").val();
    var jqxhr = $.ajax({
        type: "POST",
        url: "<?php echo base_url('matrimony/getStates')?>",
        data: {contry_id:contry_id},
        beforeSend : function(){
        }
        }).done(function(data){
           // alert(data);
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
            
   //select city based on state   
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
	
	// jquery for permanent and current address
    $('#sameadadd').click(function() {
        var address=$('#address').val();
        if (this.checked==true){
          $("#paddress").val(address);  
        }
        else{
          $("#paddress").val("");    
        }
        });
       
	    $('#occupation').change(function(){
       var value = $(this).val();
       if((value ==1) ||(value==88)){
           $('.ocbox').hide();
       }
       else{
           $('.ocbox').show();
       }
       
   });  
	$('input[name="Mr"]').click(function(){
      var inpval = $(this).attr("value");
      if(inpval == "Late"){
          $('.father_occupations').hide();
      }
      else{
          $('.father_occupations').show(); 
      }
  }); 
  
    $('input[name="Mrs"]').click(function(){
      var inpval = $(this).attr("value");
      if(inpval == "Late"){
          $('.mother_occupations').hide();
      }
      else{
          $('.mother_occupations').show(); 
      }
  }); 
  
  
    $('#elderbro').change(function(){
        var broval = $(this).val();
        if(broval!='None'){
	$('#elmaried').children('option').remove();
        $('#elmaried').prop('disabled', false);
        for (i = 0; i <=broval; i++)
          { 
          $('#elmaried').append($('<option>',
          {
            value: i,
            text : i, 
          }));
          }
        }
        else{
          $('#elmaried').prop('disabled', 'disabled');
        }
  })
  $('#youngerbro').change(function(){
        var brovals = $(this).val();
		if(brovals!='None'){
		$('#yumaried').children('option').remove();
          $('#yumaried').prop('disabled', false);
          
          for (i = 0; i <=brovals; i++)
          { 
          $('#yumaried').append($('<option>',
          {
            value: i,
            text : i, 
          }));
          }
        }
        else{
           $('#yumaried').prop('disabled', 'disabled');  
        }
  })                                                                                    
  $('#eldersis').change(function(){
        var sisvals = $(this).val();
        if(sisvals!='None'){
          $('#elsismarried').prop('disabled', false);
          $('#elsismarried').children('option').remove()
          for (i = 0; i <=sisvals; i++)
          { 
          $('#elsismarried').append($('<option>',
          {
            value: i,
            text : i, 
          }));
          }
        }
        else{
          $('#elsismarried').prop('disabled', 'disabled');  
        }
  })
  $('#youngersis').change(function(){
        var sisval = $(this).val();
        if(sisval!='None'){
          $('#ysmarried').prop('disabled', false);
          $('#ysmarried').children('option').remove()
          for (i = 0; i<=sisval; i++)
          { 
          $('#ysmarried').append($('<option>',
          {
            value: i,
            text : i, 
          }));
          }
        }
        else{
           $('#ysmarried').prop('disabled', 'disabled');   
        }
  })
      
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
	function checkmobile()
           {
                $('#mobileverification').prop('checked',false);
                $('#mobileverification').attr('disabled',false);
                var phcode = $('#phcode').val();
                var mobil = $('#mobile').val();
                var pcode =  phcode.split('+')[1];
                var mobile = "+"+pcode+"-"+mobil;
                if(mobile!=null && mobile!==""){
                    $('#mobileshow').show();
                }
                else{
                    
                    $('#mobileshow').hide();
                }
                url = "<?php echo base_url('matrimony/check_mobile')?>";   
            // ajax checking data in database
            $.ajax({
                url : url,
                type: "POST",
                data: {mobile:mobile},
                success: function(data)
                {   
                    var status = $.trim(data);
                    if(status == 'success') {  
                    $('#mobile_error').show();
                    $('#mobile').val('');
                  }
				  else{
					  
					   $('#mobile_error').hide();
					  }
                }
            });
        }
		
		function checkemail()
            {
				
				//edi work avutunnda  ya aovk thundi ok form degariki vellu
                var email = $('#email').val();
                url = "<?php echo base_url('matrimony/check_email')?>";   
            // ajax checking data in database
            $.ajax({
                url : url,
                type: "POST",
                data: {email:email},
                success: function(data)
                {   
                    var status = $.trim(data);
                    if(status == 'success') {  
                    //$('#email_error').show().fadeOut(5000);
                    $('#email_error').show();
                    $('#email').val('');
                  }
				  else{
					  $('#email_error').hide();
					  }
                }
            });
        }


function imagevalidate(file) {
    var ext = file.split(".");
    ext = ext[ext.length-1].toLowerCase();      
    var arrayExtensions = ["jpg" , "jpeg", "png"];
    if (arrayExtensions.lastIndexOf(ext) == -1) {
        alert("allows Only jpeg png jpg");
        
    }
}

 $('#dob').datepicker({
	showOn: "button",
        buttonImage: "https://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
        buttonImageOnly: true,
	altField: '.dateNew', 
	dateFormat: 'dd-mm-yy',
	minDate: new Date(1940,1-1,1),         
	maxDate: '-18Y -1D',
	yearRange: '-110:-18',
	changeMonth:true, 
	changeYear:true	
 });
</script>
