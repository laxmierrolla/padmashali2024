 <?php
//echo"<pre>";
//print_r($userdata);
//exit;
 
 //echo $userdata->profile_by;
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
        Edit User Profiles
      </h1>
    </section>

    <section class="content"><!-- Main content start -->
      <div class="box box-default">
        <form name="userform" method="post" id="userform"  action="<?php echo base_url('viewProfiles/updateUser');?>">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
               	<label class="col-sm-3 control-label">Receiptnumber:</label>
                <div class="col-sm-9">
                    <input type="hidden" name="profilecode" id="profilecode" value="<?php if($userdata->profile_code){echo $userdata->profile_code;}?>"
                 <input type="text" class="form-control" name="receiptnumber" id="receiptnumber"  value="<?php if($userdata->receiptnumber!==""){echo $userdata->receiptnumber;}?>" required >
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
                    <option <?php if($userdata->profile_by=="Self") echo 'selected' ; ?> value="Self">Self</option>
                    <option <?php if($userdata->profile_by=="Parents") echo 'selected' ; ?> value="Parents">Parents</option>
                    <option <?php if($userdata->profile_by=="Guardian") echo 'selected' ; ?> value="Guardian">Guardian</option>
                    <option <?php if($userdata->profile_by=="Son") echo 'selected' ; ?> value="Son">Son</option>
                    <option <?php if($userdata->profile_by=="Daughter") echo 'selected' ; ?> value="Daughter">Daughter</option>
                    <option <?php if($userdata->profile_by=="Brother") echo 'selected' ; ?> value="Brother">Brother</option>
                    <option <?php if($userdata->profile_by=="Sister") echo 'Selected' ; ?> value="Sister">Sister</option>
                    <option <?php if($userdata->profile_by=="Friends") echo 'selected' ; ?> value="Friends">Friends</option>
                    <option <?php if($userdata->profile_by=="Relatives") echo 'selected' ; ?> value="Relatives">Relatives</option>                                      
                 </select>
                 </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label class="col-sm-3 control-label">Surname</label>
                <div class="col-sm-9">
                 <input type="text" class="form-control" name="surname" id="surname" value="<?php if($userdata->sname!==""){echo $userdata->sname;}?>" required="required" >
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
                    <option <?php if($userdata->ref_by="Advertisements") echo 'selected';?> value="Advertisements">Advertisements</option>
                    <option <?php if($userdata->ref_by="Friends") echo 'selected';?> value="Friends">Friends</option>
                    <option <?php if($userdata->ref_by="Sanghams") echo 'selected';?> value="Sanghams">Sanghams</option>
                    <option <?php if($userdata->ref_by="SearchEngine") echo 'selected';?> value="SearchEngine"> Search Engine</option>
                    <option <?php if($userdata->ref_by="Others") echo 'selected';?> value="Others">Others</option>                                        
                 </select>
                 </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label class="col-sm-3 control-label">FirstName</label>
                <div class="col-sm-9">
                 <input type="text" class="form-control" name="firstname" id="firstname" value="<?php if($userdata->fname!==""){echo $userdata->fname;}?>" required="required" >
                 </div>
              </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-3 control-label">LastName</label>
                <div class="col-sm-9">
                 <input type="text" class="form-control" name="lastname" id="lastname" value="<?php if($userdata->lname!==""){echo $userdata->lname;}?>">
                 </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label class="col-sm-3 control-label">Gender</label>
              <div class="col-sm-9">
               <label>
                  <input type="radio" name="gender" class="flat-red"  <?php if($userdata->gender =="Female"){echo "checked='checked'";}?> value="Female" required="required"> Female
                </label>
                <label>
                  <input type="radio" name="gender" class="flat-red"  <?php if($userdata->gender =="Male"){echo "checked='checked'";}?> value="Male">Male
                </label>
              </div>
              <!-- /.form-group -->
            </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
               <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-9">
                 <input type="email" class="form-control" name="email" id="email" value="<?php if($userdata->email!==""){echo $userdata->email;}?>"   required>
                 <span id="email_error" style="display:none;color:red">email already exists</span>
                 </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
               <label class="col-sm-3 control-label">Date Of Birth</label>
                <div class="col-sm-9">
                  <input type="text" id="dob" name="dob" class="form-control" value="<?php if($userdata->dob!==""){echo $userdata->dob;}?>" disabled/>
                 </div>
                </div>
              </div>
              <!-- /.form-group -->
            
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-3 control-label">Birth place</label>
                <div class="col-sm-9">
                 <input type="text" class="form-control" name="birthplace" id="birthplace"  value="<?php if($userdata->birth_place!==""){echo $userdata->birth_place;}?>" required >
                 </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
              <label class="col-sm-3 control-label">Martial Status</label>
              <div class="col-sm-9">
               <label><input type="radio" name="maritalstatus" class="flat-red" <?php if($userdata->marital_status == "Never Married"){echo "checked";} ?> value="Never Married" required> Never Married</label>
               <label><input type="radio" name="maritalstatus" class="flat-red" <?php if($userdata->marital_status == "Widow/Widower"){echo "checked";} ?> value="Widow">Widow</label>
               <label><input type="radio" name="maritalstatus" class="flat-red" <?php if($userdata->marital_status == "Divorced"){echo "checked";} ?> value="Divorced">Divorced</label>
               <label><input type="radio" name="maritalstatus" class="flat-red" <?php if($userdata->marital_status == "Separated"){echo "checked";} ?>  value="Separated">Separated</label>
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
                   <option   <?php if($userdata->hrs=="0".$i){echo "selected='selected'";} ?>  value="<?php echo "0".$i;?>"><?php echo "0".$i;?></option>
                    <?php }else{?>
                   <option <?php if($userdata->hrs=="0".$i){echo "selected='selected'";} ?> value="<?php echo $i;?>"><?php echo $i;?></option>
                   <?php }}?>
                 </select> 
                 </div>
                 
                 <div class="col-sm-3">
                 <select name="minutes" id="minutes"  class="form-control input-sm" required>
                            <option value="">Minutes</option>
                             <option value="Dont Know">Dont Know</option>
                             <?php for($i=0;$i<=59;$i++){
                                 if($i<=9){ ?>
                                     <option  <?php if($userdata->mins=="0".$i){echo "selected='selected'";} ?> value="<?php echo "0".$i;?>"><?php echo "0".$i;?></option>
                                 <?php }else{?>
                                   <option <?php if($userdata->mins=="0".$i){echo "selected='selected'";} ?> value="<?php echo $i;?>"><?php echo $i;?></option>
                             <?php }}?>
                        </select>  
                 </div>
                 <div class="col-sm-2">
                 <select name="secs" id="secs" class="form-control input-sm" required>
                            <option value="">sec</option>
                             <option value="Dont Know">Dont Know</option>
                             <?php for($i=0;$i<=59;$i++){
                                 if($i<=9){ ?>
                                     <option <?php if($userdata->secs=="0".$i){echo "selected='selected'";} ?>  value="<?php echo "0".$i;?>"><?php echo "0".$i;?></option>
                                 <?php }else{?>
                                   <option <?php if($userdata->secs=="0".$i){echo "selected='selected'";} ?> value="<?php echo $i;?>"><?php echo $i;?></option>
                             <?php }}?>
                        </select>  
                 </div>
                 <div class="col-md-2">
                          <select name="period" id="period" tabindex="1" class="form-control input-sm" required>
                            <option value="">at</option>
                             <option <?php if($userdata->period=="Dont Know"){echo "selected='selected'";} ?> value="Dont Know">Dont Know</option>
                             <option <?php if($userdata->period=="AM"){echo "selected='selected'";} ?> value="AM">AM</option>
                             <option <?php if($userdata->period=="PM"){echo "selected='selected'";} ?> value="PM">PM</option>
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
                              <option <?php if($userdata->feet == $value->feet){echo "selected='selected'";}?> value="<?php echo $value->feet;?>"><?php echo $value->feet ;?></option>   
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
                         <option <?php if($userdata->nochild == "None"){echo "selected='selected'";}?> value="None">None</option>
                          <option <?php if($userdata->nochild == 1){echo "selected='selected'";}?> value="1">1</option>
                          <option <?php if($userdata->nochild == 2){echo "selected='selected'";}?> value="2">2</option>
                          <option <?php if($userdata->nochild == 3){echo "selected='selected'";}?> value="3">3</option>
                          <option <?php if($userdata->nochild == 4){echo "selected='selected'";}?> value="4">4</option>
                          <option <?php if($userdata->nochild == 5){echo "selected='selected'";}?>  value="5">5</option>
                    </select>
                 </div>
              </div>
              </div>
               <div class="col-md-6 child">
               <div class="form-group">
                <label class="col-sm-3 control-label">Children Living Status</label>
              <div class="col-sm-9">
               <label>
                  <input type="radio" name="Living" class="flat-red" <?php if($userdata->livig_status=='ChildrenLiving'){echo "checked='checked'";} ?> value="ChildrenLiving"> ChildrenLiving
                </label>
                <label>
                  <input type="radio" name="Living" class="flat-red" <?php if($userdata->livig_status=='ChildrenNotLiving'){echo "checked='checked'";} ?>  value="ChildrenNotLiving">ChildrenNotLiving
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
                    <input type="text" class="form-control" name="birthname" id="birthname" value="<?php if($userdata->birth_name!==""){echo $userdata->birth_name;}?>" >
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label class="col-sm-3 control-label">Gowthram</label>
               <div class="col-sm-9">
                       <input type="text" name="gowthram" class="form-control input-sm"  placeholder="gowthram"  value="<?php if($userdata->gowthram!==""){echo $userdata->gowthram;}?>" required/>
               </div>
             </div>
              <div class="form-group">
               	 <label class="col-sm-3 control-label">Rasi</label>
                 <div class="col-sm-9">
                 <select name="rasi" id="rasi" class="form-control input-sm" required >
                    <option value="">--select--</option> 
                       <?php if(isset($rasi)){
                             foreach($rasi as $rasi){?>
                             <option  <?php if($userdata->rasi == $rasi->rasi_id){echo "selected='selected'";}?> value="<?php echo $rasi-> rasi_id;?>"><?php echo $rasi->rasi;?></option>   
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
                                         <option <?php if($userdata->star == $star->star_id){echo "selected='selected'";}?> value="<?php echo $star-> star_id;?>"><?php echo $star->star ;?></option>   
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
                             <option <?php if($userdata->paadam == 1){echo "selected='selected'";}?> value="1">1</option>
                             <option <?php if($userdata->paadam == 2){echo "selected='selected'";}?> value="2">2</option>
                             <option <?php if($userdata->paadam == 3){echo "selected='selected'";}?> value="3">3</option>
                             <option <?php if($userdata->paadam == 4){echo "selected='selected'";}?> value="4">4</option>
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
                      <input type="radio" name="horoscope" class="flat-red" <?php if($userdata->horoscope =="Yes"){echo "checked='checked'";}?> value="Yes" required="required"> Yes
                    </label>
                    <label>
                      <input type="radio" name="horoscope" class="flat-red" <?php if($userdata->horoscope =="No"){echo "checked='checked'";}?> value="No">No
                    </label>
                    <label>
                      <input type="radio" name="horoscope" class="flat-red" <?php if($userdata->horoscope =="Doesn't Matter"){echo "checked='checked'";}?> value="Doesn't Matter">Don'tKnow
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
                          <input type="radio" name="manglik" class="flat-red" <?php if($userdata->manglik =="Yes"){echo "checked='checked'";}?> value="Yes" required="required"> Yes
                        </label>
                        <label>
                          <input type="radio" name="manglik" class="flat-red" <?php if($userdata->manglik =="No"){echo "checked='checked'";}?> value="No">No
                        </label>
                        <label>
                          <input type="radio" name="manglik" class="flat-red" <?php if($userdata->manglik =="Doesn't Matter"){echo "checked='checked'";}?> value="Doesn't Matter">Don'tKnow
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
                                    <option  <?php if($userdata->country == $coun->id){echo "selected='selected'";}?> value="<?php echo $coun->id;?>"><?php echo $coun->name ;?></option>   
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
                          <?php if($userdata->city){$ncity = $userdata->city;}?>
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
                             <?php if($userdata->state){$nstate = $userdata->state;}?>       
                         </select>
                        </div>
                      </div>
                       <div class="form-group">
                        <label class="col-sm-3 control-label">Resident Status</label>
                        <div class="col-sm-9">
                         <select name="res_status" class="form-control input-sm" required>
                                    <option value="">--select--</option>
                                    <option <?php if($userdata->res_status == "Dont Want To Specify"){echo "selected='selected'";}?> value="Dont Want To Specify">Dont Want To Specify</option>
                                    <option  <?php if($userdata->res_status == "Rental"){echo "selected='selected'";}?> value="Rental">Rental</option>
                                    <option <?php if($userdata->res_status == "Own"){echo "selected='selected'";}?> value="Own">Own</option>
                                </select>   
                        </div>
                      </div>
                </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Present Address</label>
                        <div class="col-sm-9">
                          <textarea name="address" id="address" class="form-control input-sm" rows="3" placeholder="Address" required><?php if($userdata->address!==""){echo $userdata->address;}?></textarea>
                          <input type="checkbox" value="sameadd" name="sameadadd" id="sameadadd"><label>Same As Address</label>                        </div>
                      </div>
              <!-- /.form-group -->
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Permanent Address</label>
                     <div class="col-sm-9">
                     <textarea name="paddress" id="paddress" class="form-control input-sm" rows="3" placeholder="Permanent Address" required="required"><?php if($userdata->perminantaddress!==""){echo $userdata->perminantaddress;}?></textarea>     
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
                            
                                      <option <?php if($userdata->living_in == $nationalities->id){echo "selected='selected'";}?> value="<?php echo $nationalities->id;?>"><?php echo $nationalities->name;?></option>   
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
                             <?php if($userdata->mobile){
                                 $pn = $userdata->mobile;
                                 $mobile = substr($pn, strpos($pn, "-") + 1);
                                 
                             }?>
                             <input type="text" name="mobile" id="mobile"  value="<?php echo $mobile;?>" onchange="checkmobile();" class="form-control input-sm" required><span id="mobile_error" style="display:none;color:red">Mobile Number already exists</span>
                         </div>
                     </div>
              </div>
              <!-- /.form-group -->
                  <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Land Line</label>
                        <div class="col-sm-9">
                       <input type="text" name="LandLine" class="form-control input-sm"  value="<?php if($userdata->phone !==""){echo $userdata->phone;}?>" placeholder="Land Line"/>
                      </div>
                      </div>
                       <div class="form-group">
                         <label class="col-sm-3 control-label">Alternate Mobile</label>
                        <div class="col-sm-9">
                       <input type="text" name="AlternateMobile" class="form-control input-sm" value="<?php if($userdata->fmobile !==""){echo $userdata->fmobile;}?>"  placeholder="Alternate Mobile" required/>
                      </div>
                      </div>
              </div>
                  <div class="col-md-6">
              <!-- /.form-group -->
                  <div class="form-group">
                    <label class="col-sm-3 control-label">About me</label>
                    <div class="col-sm-9">
                   <textarea name="Aboutme" class="form-control input-sm" rows="1" placeholder="Describe About you" required="required"><?php if($userdata->aboutme !==""){echo $userdata->aboutme;}?></textarea>    
                  </div>
                  </div>
                   <div class="form-group">
                     <label class="col-sm-3 control-label">Family Origin</label>
                    <div class="col-sm-9">
                   <input type="text" name="family_origin" class="form-control input-sm"  placeholder="Family Origin" value="<?php if($userdata->family_origin !==""){echo $userdata->family_origin;}?>" required/>
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
                         <option <?php if($userdata->weight == $we){echo "selected='selected'";}?> value="<?php echo $we; ?>"><?php echo $we; ?> Kgs</option> 
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
                                         <option <?php if($userdata->cmplxion == $comp->cmplex){echo "selected='selected'";}?> value="<?php echo $comp->cmplex;?>"><?php echo $comp->cmplex ;?></option>   
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
                  <label><input type="radio" name="bodytype" class="flat-red" <?php if($userdata->body_type == "Slim"){echo "checked='checked'";}?> value="Slim" required> Slim</label>
                <label><input type="radio" name="bodytype" class="flat-red" <?php if($userdata->body_type == "Average"){echo "checked='checked'";}?> value="Average">Average</label>
                <label><input type="radio" name="bodytype" class="flat-red" <?php if($userdata->body_type == "Athletic"){echo "checked='checked'";}?> value="Athletic"> Athletic</label>
                <label><input type="radio" name="bodytype" class="flat-red" <?php if($userdata->body_type == "Heavy"){echo "checked='checked'";}?> value="Heavy">Heavy</label>
                </div>
              </div>
              <div class="form-group">
               	<label class="col-sm-3 control-label">Blood Group :</label>
                <div class="col-sm-9">
                  <select name="bloodgroup" id="bloodgroup" class="form-control input-sm" required>
                           <option value="">--select--</option>
                                 <?php if(isset($bloodgroup)){
                                        foreach($bloodgroup as $blood){?>
                                         <option <?php if($userdata->bldgrp == $blood->bldgroup){echo "selected='selected'";}?> value="<?php echo $blood->bldgroup;?>"><?php echo $blood->bldgroup ;?></option>   
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
                          <option <?php if($userdata->splcases == $spl->spacial){echo "selected='selected'";}?> value="<?php echo $spl->spacial;?>"><?php echo $spl->spacial  ;?></option>   
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
                             <option <?php if($userdata->dite =="Veg"){echo "selected='selected'";}?> value="Veg">Veg</option>
                             <option <?php if($userdata->dite == "Non-Veg"){echo "selected='selected'";}?> value="Non-Veg">Non-Veg</option>
                             <option <?php if($userdata->dite == "Both"){echo "selected='selected'";}?> value="Both">Both</option>
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
                  <label><input type="radio" name="Smoke" class="flat-red" <?php if($userdata->smoke =="Yes"){echo "checked='checked'";}?> value="Yes" required> Yes</label>
                <label><input type="radio" name="Smoke" class="flat-red" <?php if($userdata->smoke =="No"){echo "checked='checked'";}?> value="No">No</label>
                <label><input type="radio" name="Smoke" class="flat-red" <?php if($userdata->smoke =="Occasionally"){echo "checked='checked'";}?> value="Occasionally"> Occasionally</label>
                </div>
              </div>
              <!-- /.form-group -->
              </div>
              <!-- /.col-md-6 -->
              
              <div class="col-md-6">
              <div class="form-group">
               	<label class="col-sm-3 control-label">Drink:</label>
                <div class="col-sm-9">
                  <label><input type="radio" name="Drink" class="flat-red" <?php if($userdata->drink =="Yes"){echo "checked='checked'";}?> value="Yes" required> Yes</label>
                <label><input type="radio" name="Drink" class="flat-red" <?php if($userdata->drink =="No"){echo "checked='checked'";}?> value="No">No</label>
                <label><input type="radio" name="Drink" class="flat-red" <?php if($userdata->drink =="Occasionally"){echo "checked='checked'";}?> value="Occasionally"> Occasionally</label>
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
                                         <option <?php if($userdata->edu ==$edu->edu_id){echo "selected='selected'";}?> value="<?php echo $edu->edu_id;?>"><?php echo $edu->education ;?></option>   
                                        <?php }
                                    }?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
               	<label class="col-sm-3 control-label">EducationDetails:</label>
                <div class="col-sm-9">
                 <input type="text" class="form-control input-sm"  name="edudetails" id="edudetails"  value="<?php if($userdata->edu_details !==""){echo $userdata->edu_details;}?>" placeholder="(ex:Electronics,computers,Management,etc..)">
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
                                        <option  <?php if($userdata->mothertounge ==$value->L_Id){echo "selected='selected'";}?> value="<?php echo $value->L_Id;?>"><?php echo $value->Language_Name;?></option>     
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
                                         <option <?php if($userdata->occu ==$ocu->Occ_Id){echo "selected='selected'";}?> value="<?php echo $ocu->Occ_Id;?>"><?php echo $ocu->occupation ;?></option>   
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
                 <input type="text" class="form-control input-sm" name="occdetails" id="occdetails"  value="<?php if($userdata->occ_details !==""){echo $userdata->occ_details;}?>" placeholder="(ex:S/W,H/W,Marketing,CEO,Military etc..)">
                </div>
              </div>
              <!-- /.form-group -->
               <div class="form-group">
               	<label class="col-sm-3 control-label">Income:</label>
                <div class="col-sm-9">
                  <select name="income" class="form-control input-sm" >
                            <option value="">--Choose Income--</option>
                            <option <?php if($userdata->income =="Upto INR 1 Lakh"){echo "selected='selected'";}?> value="Upto INR 1 Lakh" label="Upto INR 1 Lakh">Upto INR 1 Lakh</option>
                            <option <?php if($userdata->income =="INR 1 Lakh to 2 Lakh"){echo "selected='selected'";}?> value="INR 1 Lakh to 2 Lakh" label="INR 1 Lakh to 2 Lakh">INR 1 Lakh to 2 Lakh</option>
                            <option <?php if($userdata->income =="INR 2 Lakh to 4 Lakh"){echo "selected='selected'";}?> value="INR 2 Lakh to 4 Lakh" label="INR 2 Lakh to 4 Lakh">INR 2 Lakh to 4 Lakh</option>
                            <option <?php if($userdata->income =="INR 4 Lakh to 7 Lakh"){echo "selected='selected'";}?> value="INR 4 Lakh to 7 Lakh" label="INR 4 Lakh to 7 Lakh">INR 4 Lakh to 7 Lakh</option>
                            <option <?php if($userdata->income =="INR 7 Lakh to 10 Lakh"){echo "selected='selected'";}?> value="INR 7 Lakh to 10 Lakh" label="INR 7 Lakh to 10 Lakh">INR 7 Lakh to 10 Lakh</option>
                            <option <?php if($userdata->income =="INR 10 Lakh to 15 Lakh"){echo "selected='selected'";}?> value="INR 10 Lakh to 15 Lakh" label="INR 10 Lakh to 15 Lakh">INR 10 Lakh to 15 Lakh</option>
                            <option <?php if($userdata->income =="INR 15 Lakh to 20 Lakh"){echo "selected='selected'";}?> value="INR 15 Lakh to 20 Lakh" label="INR 15 Lakh to 20 Lakh">INR 15 Lakh to 20 Lakh</option>
                            <option <?php if($userdata->income =="INR 20 Lakh to 30 Lakh"){echo "selected='selected'";}?> value="INR 20 Lakh to 30 Lakh" label="INR 20 Lakh to 30 Lakh">INR 20 Lakh to 30 Lakh</option>
                            <option <?php if($userdata->income =="INR 30 Lakh to 50 Lakh"){echo "selected='selected'";}?> value="INR 30 Lakh to 50 Lakh" label="INR 30 Lakh to 50 Lakh">INR 30 Lakh to 50 Lakh</option>
                            <option <?php if($userdata->income =="INR 50 Lakh to 75 Lakh"){echo "selected='selected'";}?> value="INR 50 Lakh to 75 Lakh" label="INR 50 Lakh to 75 Lakh">INR 50 Lakh to 75 Lakh</option>
                            <option <?php if($userdata->income =="INR 75 Lakh to 1 Crore"){echo "selected='selected'";}?> value="INR 75 Lakh to 1 Crore" label="INR 75 Lakh to 1 Crore">INR 75 Lakh to 1 Crore</option>
                            <option <?php if($userdata->income =="INR 1 Crore &amp; above"){echo "selected='selected'";}?> value="INR 1 Crore &amp; above" label="INR 1 Crore &amp; above">INR 1 Crore &amp; above</option>                            <option value="Not applicable" label="Not applicable">Not applicable</option>
                            <option <?php if($userdata->income =="Dont want to specify"){echo "selected='selected'";}?> value="Dont want to specify" label="Dont want to specify">Dont want to specify</option>
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
                           <option <?php if($userdata->empin == $emp->emp_id){echo "selected='selected'";}?> value="<?php echo $emp->emp_id;?>"><?php echo $emp->employee ;?></option>   
                                        <?php }
                                    }?>
                </select>
                </div>
              </div>
              <!-- /.form-group -->
               <div class="form-group">
               	<label class="col-sm-3 control-label">EmploymentDetails:</label>
                <div class="col-sm-9">
                  <input type="text" value="<?php echo $userdata->employmentdetails; ?>" class="form-control input-sm"  name="empdetails" id="empdetails" placeholder="Enter Employement Details">
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
                <label><input type="radio" <?php if($userdata->fa_alive=="Mr"){ echo "checked";} ?> name="Mr" class="flat-red" value="Mr" required> Mr</label>
                <label><input type="radio" <?php if($userdata->fa_alive=="Late"){ echo "checked";} ?> name="Mr" class="flat-red" value="Late">Late</label>
                </div>
              </div>
              <div class="form-group">
               	<label class="col-sm-3 control-label">FatherName:</label>
                <div class="col-sm-9">
                 <input type="text" name="fathername"value="<?php if($userdata->father_name){ echo $userdata->father_name;} ?>" class="form-control input-sm"  placeholder="Enter Father Name" required/>
                </div>
              </div>
              
              </div>
             <div class="col-md-6 father_occupations">
              <div class="form-group">
               	<label class="col-sm-3 control-label">FatherOccupation:</label>
                <div class="col-sm-9">
                 <input type="text" name="father_occupation" value="<?php if($userdata->father_occupation){ echo $userdata->father_occupation;} ?>" id="father_occupation" class="form-control input-sm"  placeholder="Occupation"/>   
                </div>
              </div>
              
              </div>
              
              <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-3 control-label">Mother Status:</label>
                <div class="col-sm-9">
                <label><input type="radio" <?php if($userdata->ma_alive=="Mrs"){ echo "checked";} ?> name="Mrs" class="flat-red" value="Mrs" required> Mrs</label>
                <label><input type="radio" <?php if($userdata->ma_alive=="Late"){ echo "checked";} ?>  name="Mrs" class="flat-red" value="Late">Late</label>
                </div>
              </div>
              <div class="form-group">
               	<label class="col-sm-3 control-label">MotherName:</label>
                <div class="col-sm-9">
                 <input type="text" name="mothername" value="<?php if($userdata->mother_name){ echo $userdata->mother_name;} ?>" class="form-control input-sm" id="mothername" placeholder="Enter mother Name" required/>
                </div>
              </div>
              
              </div>
              
              <div class="col-md-6 ">
              <div class="form-group mother_occupations">
               	<label class="col-sm-3 control-label">MotherOccupation:</label>
                <div class="col-sm-9">
                 <input type="text" value="<?php if($userdata->mother_occupation){ echo $userdata->mother_occupation;} ?>" name="mother_occupation" id="mother_occupation" class="form-control input-sm"  placeholder="Occupation"/>   
                </div>
              </div>
               <div class="form-group">
               	<label class="col-sm-3 control-label">ElderBrother:</label>
                <div class="col-sm-9">
                <select name="elderbro" id="elderbro" class="form-control input-sm" required>
                            <option value="">select</option>
                            <option <?php if($userdata->elder_bro =="None"){echo "selected='selected'";}?> value="None">None</option>
                            <option <?php if($userdata->elder_bro =="1"){echo "selected='selected'";}?> value="1">1</option>
                            <option <?php if($userdata->elder_bro =="2"){echo "selected='selected'";}?> value="2">2</option>
                            <option <?php if($userdata->elder_bro =="3"){echo "selected='selected'";}?> value="3">3</option>
                            <option <?php if($userdata->elder_bro =="4"){echo "selected='selected'";}?> value="4">4</option>
                            <option <?php if($userdata->elder_bro =="5"){echo "selected='selected'";}?> value="5">5</option>                                               
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
                <option value="">select</option>
               </select>    
                </div>
              </div>
              
              <div class="form-group">
               	<label class="col-sm-3 control-label">YoungerBrother:</label>
                <div class="col-sm-9">
                <select name="youngerbro" id="youngerbro" class="form-control input-sm" required>
                            <option value="">select</option>
                            <option <?php if($userdata->young_bro =="None"){echo "selected='selected'";}?> value="None">None</option>
                            <option <?php if($userdata->young_bro =="1"){echo "selected='selected'";}?> value="1">1</option>
                            <option <?php if($userdata->young_bro =="2"){echo "selected='selected'";}?> value="2">2</option>
                            <option <?php if($userdata->young_bro =="3"){echo "selected='selected'";}?> value="3">3</option>
                            <option <?php if($userdata->young_bro =="4"){echo "selected='selected'";}?> value="4">4</option>
                            <option <?php if($userdata->young_bro =="5"){echo "selected='selected'";}?> value="5">5</option>                                               
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
                 <option value="">select</option>
               </select>    
                </div>
              </div>
              
              <div class="form-group">
               	<label class="col-sm-3 control-label">Eldersister:</label>
                <div class="col-sm-9">
                <select name="eldersis" id="eldersis" class="form-control input-sm" required>
                            <option value="">select</option>
                            <option <?php if($userdata->elder_sis =="None"){echo "selected='selected'";}?> value="None" value="None">None</option>
                            <option <?php if($userdata->elder_sis =="1"){echo "selected='selected'";}?> value="1">1</option>
                            <option <?php if($userdata->elder_sis =="2"){echo "selected='selected'";}?> value="2">2</option>
                            <option <?php if($userdata->elder_sis =="3"){echo "selected='selected'";}?> value="3">3</option>
                            <option <?php if($userdata->elder_sis =="4"){echo "selected='selected'";}?> value="4">4</option>
                            <option <?php if($userdata->elder_sis =="5"){echo "selected='selected'";}?> value="5">5</option>                                               
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
                            <option <?php if($userdata->young_sis ==""){echo "selected='selected'";}?> value="">select</option>
                            <option <?php if($userdata->young_sis =="None"){echo "selected='selected'";}?> value="None">None</option>
                            <option <?php if($userdata->young_sis =="1"){echo "selected='selected'";}?> value="1">1</option>
                            <option <?php if($userdata->young_sis =="2"){echo "selected='selected'";}?> value="2">2</option>
                            <option <?php if($userdata->young_sis =="3"){echo "selected='selected'";}?> value="3">3</option>
                            <option <?php if($userdata->young_sis =="4"){echo "selected='selected'";}?> value="4">4</option>
                            <option <?php if($userdata->young_sis =="5"){echo "selected='selected'";}?> value="5">5</option>                                               
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
              <textarea name="aboutfamily" id="aboutfamily" class="form-control input-sm" rows="1" placeholder="Description About Family" required><?php if($userdata->desc_family !=""){echo $userdata->desc_family ;}?></textarea>  
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
                    <?php  $lookfor = explode(',' ,$userdata->look_for);          
                    ?>
                  <label><input type="checkbox" name="looking[]" class="flat-red"  <?php  if(in_array('Never Married', $lookfor)): echo 'checked="checked"'; endif; ?> value="Never Married" required>NeverMarried</label>
                <label><input type="checkbox" name="looking[]" class="flat-red"  <?php if(in_array('Divorced', $lookfor)): echo 'checked="checked"'; endif;?> value="Divorced">Divorced</label>
                <label><input type="checkbox" name="looking[]" class="flat-red" <?php if(in_array('Widow/Widower', $lookfor)): echo 'checked="checked"'; endif;?> value="Widow/Widower">Widow/Widower</label>
                <label><input type="checkbox" name="looking[]" class="flat-red"  <?php if(in_array('Separated', $lookfor)): echo 'checked="checked"'; endif;?> value="Separated">Separated</label>
                </div>
                </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">CountryResident:</label>
                <div class="col-sm-9">
                  <select name="countryfor" id="countryfor" class="form-control input-sm input-sm1" required>
                       <option value="">--Select Country--</option>  
                            <?php if(isset($country)){
                            foreach($country as $coun){?>
                            <option <?php if($userdata->countryresidant_from ==$coun->id){echo "selected='selected'";}?> value="<?php echo $coun->id;?>"><?php echo $coun->name ;?></option>   
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
                             <option <?php if($userdata->age_from ==$i){echo "selected='selected'";}?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
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
                             <option <?php if($userdata->age_to ==$i){echo "selected='selected'";}?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
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
                                         <option <?php if($userdata->feet_from ==$value->feet){echo "selected='selected'";}?> value="<?php echo $value->feet;?>"><?php echo $value->feet ;?></option>   
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
                                         <option <?php if($userdata->inch_from ==$value->feet){echo "selected='selected'";}?> value="<?php echo $value->feet;?>"><?php echo $value->feet ;?></option>   
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
                 <label><input type="radio" name="educationtype" class="flat-red" <?php if($userdata->Education_fromType =="DoesNotMatter"){echo "checked='checked'";}?> value="DoesNotMatter" required>Doesn't Matter</label>
                <label><input type="radio" name="educationtype" class="flat-red" <?php if($userdata->Education_fromType =="Educated"){echo "checked='checked'";}?> value="Educated">Educated</label>
                </div>
                </div>
                <div class="form-group chooseeducation" style="display:none">
                <label class="col-sm-3 control-label">Education:</label>
                <div class="col-sm-9">
                 <select name="educations[]" id="educations" tabindex="1" class="form-control input-sm col-md-10" multiple > 
                                <option value="">-- Choose Education--</option>
                                 <?php if(isset($education)){
                                        foreach($education as $edu){?>
                                         <option <?php $education = explode(',' ,$userdata->Education_from); if(in_array($edu->edu_id, $education)): echo 'selected="selected"'; endif; ?> value="<?php echo $edu->edu_id;?>"><?php echo $edu->education ;?></option>   
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
                 <label><input type="radio" name="occupationtype" class="flat-red" <?php if($userdata->Occuaption_FromType =="DoesNotMatter"){echo "checked='checked'";}?> value="DoesNotMatter" required>Doesn't Matter</label>
                <label><input type="radio" name="occupationtype" class="flat-red" <?php if($userdata->Occuaption_FromType =="Working"){echo "checked='checked'";}?> value="Working">Working</label>
                 <label><input type="radio" name="occupationtype" class="flat-red" <?php if($userdata->Occuaption_FromType =="NotWorking"){echo "checked='checked'";}?> value="NotWorking">NotWorking</label>
                </div>
                </div>
                <div class="form-group chooseoccupation" style="display:none">
                	<label class="col-sm-3 control-label">Occupation:</label>
                <div class="col-sm-9">
                <select name="occupations[]"  id="occupations" tabindex="1" class="form-control input-sm" multiple> 
                                <option value="">-- Choose Occupation--</option>
                                 <?php if(isset($occupation)){
                                        foreach($occupation as $ocu){?>
                                         <option <?php $occupations = explode(',' ,$userdata->Occuaption_From); if(in_array($ocu->Occ_Id, $occupations)): echo ' selected="selected"'; endif; ?> value="<?php echo $ocu->Occ_Id;?>"><?php echo $ocu->occupation ;?></option>   
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
                            <option <?php if($userdata->AnnualIncome_from =="Upto INR 1 Lakh"){echo "selected='selected'";}?> value="Upto INR 1 Lakh" label="Upto INR 1 Lakh">Upto INR 1 Lakh</option>
                            <option <?php if($userdata->AnnualIncome_from =="INR 1 Lakh to 2 Lakh"){echo "selected='selected'";}?> value="INR 1 Lakh to 2 Lakh" label="INR 1 Lakh to 2 Lakh">INR 1 Lakh to 2 Lakh</option>
                            <option <?php if($userdata->AnnualIncome_from =="INR 2 Lakh to 4 Lakh"){echo "selected='selected'";}?> value="INR 2 Lakh to 4 Lakh" label="INR 2 Lakh to 4 Lakh">INR 2 Lakh to 4 Lakh</option>
                            <option <?php if($userdata->AnnualIncome_from =="INR 4 Lakh to 7 Lakh"){echo "selected='selected'";}?> value="INR 4 Lakh to 7 Lakh" label="INR 4 Lakh to 7 Lakh">INR 4 Lakh to 7 Lakh</option>
                            <option <?php if($userdata->AnnualIncome_from =="INR 7 Lakh to 10 Lakh"){echo "selected='selected'";}?> value="INR 7 Lakh to 10 Lakh" label="INR 7 Lakh to 10 Lakh">INR 7 Lakh to 10 Lakh</option>
                            <option <?php if($userdata->AnnualIncome_from =="INR 10 Lakh to 15 Lakh"){echo "selected='selected'";}?> value="INR 10 Lakh to 15 Lakh" label="INR 10 Lakh to 15 Lakh">INR 10 Lakh to 15 Lakh</option>
                            <option <?php if($userdata->AnnualIncome_from =="INR 15 Lakh to 20 Lakh"){echo "selected='selected'";}?> value="INR 15 Lakh to 20 Lakh" label="INR 15 Lakh to 20 Lakh">INR 15 Lakh to 20 Lakh</option>
                            <option <?php if($userdata->AnnualIncome_from =="INR 20 Lakh to 30 Lakh"){echo "selected='selected'";}?> value="INR 20 Lakh to 30 Lakh" label="INR 20 Lakh to 30 Lakh">INR 20 Lakh to 30 Lakh</option>
                            <option <?php if($userdata->AnnualIncome_from =="INR 30 Lakh to 50 Lakh"){echo "selected='selected'";}?> value="INR 30 Lakh to 50 Lakh" label="INR 30 Lakh to 50 Lakh">INR 30 Lakh to 50 Lakh</option>
                            <option <?php if($userdata->AnnualIncome_from =="INR 50 Lakh to 75 Lakh"){echo "selected='selected'";}?> value="INR 50 Lakh to 75 Lakh" label="INR 50 Lakh to 75 Lakh">INR 50 Lakh to 75 Lakh</option>
                            <option <?php if($userdata->AnnualIncome_from =="INR 75 Lakh to 1 Crore"){echo "selected='selected'";}?> value="INR 75 Lakh to 1 Crore" label="INR 75 Lakh to 1 Crore">INR 75 Lakh to 1 Crore</option>
                            <option <?php if($userdata->AnnualIncome_from =="INR 1 Crore &amp; above"){echo "selected='selected'";}?> value="INR 1 Crore &amp; above" label="INR 1 Crore &amp; above">INR 1 Crore &amp; above</option>
                            <option <?php if($userdata->AnnualIncome_from =="Not applicable"){echo "selected='selected'";}?> value="Not applicable" label="Not applicable">Not applicable</option>
                            <option <?php if($userdata->AnnualIncome_from =="Dont want to specify"){echo "selected='selected'";}?> value="Dont want to specify" label="Dont want to specify">Dont want to specify</option>                                                                               
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
                                         <option <?php if($userdata->Complexion_from ==$comp->cmplex){echo "selected='selected'";}?> value="<?php echo $comp->cmplex;?>"><?php echo $comp->cmplex ;?></option>   
                                        <?php }
                                    }?>  
                            </select>     
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
	var maritualstatus = $('input[name="maritalstatus"]:checked').val(); 
        if(maritualstatus =="Widow/Widower"||maritualstatus=="Divorced"||maritualstatus=="Separated"){$('.childern').show();}else{$('.childern').hide();}
        
        var nchild = $('#nofchild').val();
        if(nchild=='None'){$('.child').hide();} else{$('.child').show();}
				   
        
        
	 $('input[name="educationtype"]').click(function(){
          var inputvalue =$(this).attr("value");
          if(inputvalue =="Educated"){
              $('.chooseeducation').show();
          }
          else{
              $('.chooseeducation').hide();
          }
          
      }); 
      
      
       var education_type = $('input[name="educationtype"]:checked').val(); 
       if(education_type =="Educated"){ $('.chooseeducation').show();}else{$('.chooseeducation').hide();}
       
	  
	  
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
      
       var organisation_type = $('input[name="occupationtype"]:checked').val();
       if(organisation_type =="Working"){ 
           $('.chooseoccupation').show();
           $('.anualincomee').show();}
       else{$('.chooseoccupation').hide();
            $('.anualincomee').hide();}
      
      
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
   
   var value = $('#occupation').val();
    if((value == 1)||(value == 88)){
        $('.ocbox').hide();
     }
    else{
         $('.ocbox').show();
    }
	$('input[name="Mr"]').click(function(){
      var inpval = $(this).attr("value");
      if(inpval == "Late"){
          $('.father_occupations').hide();
      }
      else{
          $('.father_occupations').show(); 
      }
  }); 
  
  
   var fastatus = $('input[name="Mr"]:checked').val();
   if(fastatus == "Late"){$('#father_occupations').hide(); }else{$('#father_occupations').show();}

  
    $('input[name="Mrs"]').click(function(){
      var inpval = $(this).attr("value");
      if(inpval == "Late"){
          $('.mother_occupations').hide();
      }
      else{
          $('.mother_occupations').show(); 
      }
  }); 
  
   var mostatus = $('input[name="Mrs"]:checked').val();
   if(mostatus == "Late"){$('#mother_occupations').hide();}else{$('#mother_occupations').show();}
  
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
  
  var elbroval = $('#elderbro').val();
  alert(elbroval);
  if(elbroval!='None'){ 
        $('#elmaried').children('option').remove();
        $('#elmaried').prop('disabled', false);
        for (i = 0; i<=elbroval; i++){ 
        $('#elmaried').append($('<option>',
                  {
                  value: i,
                  text : i, 
           }));}}
   else{ 
       $('#elmaried').prop('disabled', 'disabled');
   }
      
      var elder_bro1 = "<?php echo $userdata->elder_bro1?>";
      $('#eldermarried option[value="'+elder_bro1+'"]').prop('selected', true);
  
  
  
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
  
  
   var yubroval = $('#youngerbro').val();
    if(yubroval!='None'){
        $('#yumaried').children('option').remove();
        $('#yumaried').prop('disabled', false);
        for (i = 0; i<=yubroval; i++){
            $('#yumaried').append($('<option>',{value: i,text : i,}));}
    }
    else{$('#yumaried').prop('disabled', 'disabled');
    }
   var young_bro1 = "<?php echo $userdata->young_bro1?>";
   $('#yumaried option[value="'+young_bro1+'"]').prop('selected', true);
  
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
  
   var esisval = $('#eldersis').val();
   if(esisval!='None'){$('#elsismarried').prop('disabled', false);
    $('#elsismarried').children('option').remove()
    for (i = 0; i<=esisval; i++){$('#elsismarried').append($('<option>',{value: i,text : i,}));}}else{$('#elsismarried').prop('disabled', 'disabled'); }
var elder_sis1 = "<?php echo $userdata->elder_sis1?>";
    $('#elsismarried option[value="'+elder_sis1+'"]').prop('selected', true);
  
  
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
  
  var yusisval = $('#youngersis').val();
        if(yusisval!='None'){
            $('#ysmarried').prop('disabled', false);
            $('#ysmarried').children('option').remove()
                for (i = 0; i<=yusisval; i++){
                    $('#ysmarried').append($('<option>',{value: i,text : i,}));
            }}
            else{$('#ysmarried').prop('disabled', 'disabled'); }
                var young_sis1 = "<?php echo $userdata->young_sis1?>";
                  $('#ysmarried option[value="'+young_sis1+'"]').prop('selected', true);
  
  
  
      
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
    
     var countrycode = $('#nationality').val(); 
     var phonenum  = "<?php echo $userdata->mobile;?>"
      var num = phonenum.split('-');
     var pcode = num[0];
     var phcod =countrycode + "_" + pcode;
     $('#phcode option[value="'+phcod+'"]').prop('selected', true);
    
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
		
function checkemail(){
				
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



var contry_id = $('#country').val();
var newstate = '<?php echo $nstate ;?>';
var newcity = '<?php echo $ncity ;?>';

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
            
           $('#state').children('option').remove()
           $('#state').append('<option value="">Select State</option>');
           $.each(jsonStatesData, function (key, value){
           $('[name="state"]').append('<option value="'+value.id+'">' +value.name+ '</option>');
      });
      $('#state option[value="'+newstate+'"]').prop('selected', true);
      
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
                $('#city').children('option').remove()
                $('#city').append('<option value="">Select City</option>');
                $.each(jsonCityData, function (key, value){
                $('[name="city"]').append('<option value="'+value.id+'">' +value.name + '</option>');
              
             });
            }
            $('#city option[value="'+newcity+'"]').prop('selected', true);
        }
    }); 
                                      } 
                                    }
                                   
                               }
                              
                          });
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
