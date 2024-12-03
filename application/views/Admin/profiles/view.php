 <?php
 //echo"<pre>";
 //print_r($view);
 //exit;
$this->load->view('Admin/common_header');
$this->load->view('Admin/sidenav');

$profile_code = (isset($view->ProfileCode))?$view->ProfileCode:'';
$gender=(isset($view->gender))?$view->gender:''; 
$gender_pic = ($gender == 'Female') ? 'female.jpg' : 'male.png';
$dummy_profile_pic = base_url() . 'assets/images/' . $gender_pic;

$profileimage = "";
if($view->thumbimage!==""){
	if($view->Profile_photo_Status == 1){ 
	$profileimage = 'uploads/profilepics/'.$profile_code.'/'.$view->thumbimage;
}else{
	$profileimage = $dummy_profile_pic;
}
}
else{
	$profileimage = $dummy_profile_pic;
}


$dateOfBirth = (isset($view->DateOfBirth))?$view->DateOfBirth:'';
$today = date("Y-m-d");
$diff = date_diff(date_create($dateOfBirth), date_create($today));
$age = $diff->format('%y');

?> 
  <!-- =============================================== -->

  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
       <div class="row">
          <table class="table table-striped">
    
    <tbody>
      <tr>
        <td colspan='2'><img style="width:130px;height:130px;" src="<?php echo base_url(). $profileimage;?>" class="img-responsive"></td>
        <td><div class="col-md-9 details-right">
            <div class="col-md-8">
            <h4><?php if(isset($view->SurName)&&(isset($view->FirstName))&&(isset($view->LastName))){ $name = $view->SurName.' '.$view->FirstName.' '.$view->LastName; echo strtoupper($name);}?>
            <div class="clearfix"></div>
            <small>(<i>Created by&nbsp;:&nbsp;<?php if(isset($view->profile_by)){ echo $view->profile_by;}?></i>)</small></h4>
          </div>
          <div class="col-md-4 no-pad text-right"><h5>Profile Id&nbsp;:&nbsp;<span class="btn btn-xs btn-success"><?php if(isset($view->ProfileCode)){echo $view->ProfileCode;} ?></span></h5>
		  <h5>Profile Protect&nbsp;:&nbsp;<span class="btn btn-xs btn-success"><?php if($view->Photoprotect && $view->Photoprotect==1){echo "Protected";}else{ echo"No Protection";} ?></span></h5>
		  <h5>Last Login&nbsp;:&nbsp;<span class="btn btn-xs btn-warning"><?php if($view->Lastlogin){echo date('d-M-Y h:i:s a',strtotime($view->Lastlogin));}else{ echo"No At LoggedIn";} ?></span></h5>
		  <h5>Registration On;:&nbsp;<span class="btn btn-xs btn-warning"><?php if($view->RegisteredOn){echo date('d-M-Y',strtotime($view->RegisteredOn));} ?></span></h5>
		  <h5>ValidityUpTO;:&nbsp;<span class="btn btn-xs btn-warning"><?php if($view->Validity){echo date('d-M-Y',strtotime($view->Validity));} ?></span></h5>
		  </div>
		  
         
          <div class="clearfix"></div>
          <div class="col-md-12">
          <ul class="list-inline">
            <li><img src="<?php echo base_url();?>assets/userdashboard/images/age.png" alt="age" /><?php echo $age." Years";?></li>
            <li><img src="<?php echo base_url();?>assets/userdashboard/images/height.png" alt="height" /><?php if(isset($view->Height)){ echo $view->Height;}?></li>
            <li><img src="<?php echo base_url();?>assets/userdashboard/images/education.png" alt="education" /><?php if(isset($view->Education)){ echo $view->Education;}?></li>
            <li><img src="<?php echo base_url();?>assets/userdashboard/images/location.png" alt="location" /><?php if(isset($view->City)){ echo $view->City.", ";}if(isset($view->State)){ echo $view->State.", ";} if(isset($view->County)){ echo $view->County;}?></li>
            <div class="clearfix"></div>
            <li><img src="<?php echo base_url();?>assets/userdashboard/images/mobile.png" alt="age" /><?php if(isset($view->MobileNumber)){echo $view->MobileNumber;}?></li>
            <li><img src="<?php echo base_url();?>assets/userdashboard/images/email.png" alt="age" /><?php if(isset($view->EmailId)){echo $view->EmailId;}?></li>
			
          </ul>
        <div class="clearfix"></div>
        </div>
          <div class="clearfix"></div>
          </div></td>
        
      </tr>
      
      
    </tbody>
  </table>
   <table class="table table-striped">
    <thead>
      <tr>
        <th colspan="4">ABOUT<?php if(isset($view->SurName)&&(isset($view->FirstName))&&(isset($view->LastName))){ $name = $view->SurName.' '.$view->FirstName.' '.$view->LastName; echo strtoupper($name);} ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php if(isset($view->aboutme) && !empty($view->aboutme)){ echo $view->aboutme; }else{echo "N.A" ;}?></td>
        
      </tr>
 
    </tbody>
  </table>

   <table class="table table-striped">
    <thead>
      <tr>
        <th colspan="4">BASIC DETAILS</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Profile created by:</td>
        <td><?php if(isset($view->profile_by)&& !empty($view->profile_by)){ echo $view->profile_by;}else{echo "N.A";}?></td>
        <td>Reference by</td>
        <td><?php if(isset($view->ref_by)&& !empty($view->ref_by)){ echo $view->ref_by;}else{echo "N.A";}?></td>
      </tr>
      <tr>
        <td>Name</td>
		<td><?php if(isset($view->SurName)&&(isset($view->FirstName))&&(isset($view->LastName))){ $name = $view->SurName.' '.$view->FirstName.' '.$view->LastName; echo strtoupper($name);}?></td>
		 <td>Age</td>
        <td><?php echo $age." Years";?><td>
      </tr>
      <tr>
        <td>Gender</td>
		<td><?php if(isset($view->Gender)&& !empty($view->Gender)){ echo $view->Gender;}else{echo "N.A";}?></td>
		<td>Marital Status</td>
        <td><?php if(isset($view->MartialStatus)&& !empty($view->MartialStatus)){ echo $view->MartialStatus;}else{echo "N.A";}?></td>
      </tr>
	  <tr>
        <td>Date of Birth</td>
		<td><?php if(isset($view->DateOfBirth)&& !empty($view->DateOfBirth)){ echo $view->DateOfBirth;}else{echo "N.A";}?></td>
		<td>Mother Tongue</td>
        <td><?php if(isset($view->Language_Name)&& !empty($view->Language_Name)){ echo $view->Language_Name;}else{echo "N.A";}?></td>
      </tr>
	  <tr>
        <td>Nationality</td>
		<td><?php if(isset($view->living)&& !empty($view->living)){ echo $view->living;}else{echo "N.A";}?></td>
		<td>Mobile Number</td>
        <td><?php if(isset($view->MobileNumber)&& !empty($view->MobileNumber)){ echo $view->MobileNumber;}else{echo "N.A";}?></td>
      </tr>
	  <tr>
        <td>Email</td>
		<td><?php if(isset($view->EmailId)&& !empty($view->EmailId)){ echo $view->EmailId;}else{echo "N.A";}?></td>
      </tr>
    </tbody>
  </table>
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th colspan="4">PROFESSIONAL INFORMATION</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Education:</td>
        <td><?php if(isset($view->Education)&& !empty($view->Education)){ echo $view->Education;}else{echo "N.A";}?></td>
        <td>Education in Details</td>
        <td><?php if(isset($view->EducationDetails)&& !empty($view->EducationDetails)){ echo $view->EducationDetails;}else{echo "N.A";}?></td>
      </tr>
      <tr>
        <td>Employed in</td>
		<td><?php if(isset($view->EmployeeIn)&& !empty($view->EmployeeIn)){ echo $view->EmployeeIn;}else{echo "N.A";}?></td>
		 <td>Occupation</td>
        <td><?php if(isset($view->Occupation)&& !empty($view->Occupation)){ echo $view->Occupation;}else{echo "N.A";}?><td>
      </tr>
      <tr>
        <td>Occupation in Detail</td>
		<td><?php if(isset($view->OccupationDetails)&& !empty($view->OccupationDetails)){ echo $view->OccupationDetails;}else{echo "N.A";}?></td>
		<td>Annual Income</td>
        <td><?php if(isset($view->Income)&& !empty($view->Income)){ echo $view->Income;}else{echo "N.A";}?></td>
      </tr>
	 
    </tbody>
  </table>
  
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th colspan="4">PHYSICAL STATUS & HOBBIES</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Height:</td>
        <td><?php if(isset($view->Height)&& !empty($view->Height)){ echo $view->Height;}else{echo "N.A";}?></td>
        <td>Weight ( In Kgs ):</td>
        <td><?php if(isset($view->Weight)&& !empty($view->Weight)){ echo $view->Weight." Kgs";}else{echo "N.A";}?></td>
      </tr>
      <tr>
        <td>Complexion:</td>
		<td><?php if(isset($view->Complexion)&& !empty($view->Complexion)){ echo $view->Complexion;}else{echo "N.A";}?></td>
		 <td>Blood group:</td>
        <td><?php if(isset($view->Bloodgroup)&& !empty($view->Bloodgroup)){ echo $view->Bloodgroup;}else{echo "N.A";}?><td>
      </tr>
      <tr>
        <td>Special Cases:</td>
		<td><?php if(isset($view->SpecialCases)&& !empty($view->SpecialCases)){ echo $view->SpecialCases;}else{echo "N.A";}?></td>
		<td>Dite</td>
        <td><?php if(isset($view->Dite)&& !empty($view->Dite)){ echo $view->Dite;}else{echo "N.A";}?></td>
      </tr>
	   <tr>
        <td>Body Type:</td>
		<td><?php if(isset($view->BodyType)&& !empty($view->BodyType)){ echo $view->BodyType;}else{echo "N.A";}?></td>
		<td>Smoke:</td>
        <td><?php if(isset($view->Smoke)&& !empty($view->Smoke)){ echo $view->Smoke;}else{echo "N.A";}?></td>
      </tr>
	   <tr>
        <td>Drink</td>
		<td><?php if(isset($view->Drink)&& !empty($view->Drink)){ echo $view->Drink;}else{echo "N.A";}?></td>
      </tr>
    </tbody>
  </table>
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th colspan="4">HOROSCOPE INFORMATION</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Birth Place:</td>
        <td><?php if(isset($view->BirthPlace)&& !empty($view->BirthPlace)){ echo $view->BirthPlace;}else{echo "N.A";}?></td>
        <td>Birth Time:</td>
        <td><?php if(isset($view->BirthTimeInHours)){ echo $view->BirthTimeInHours." :";}if(isset($view->BirthTimeInMin)){ echo $view->BirthTimeInMin." :";}if(isset($view->secs)){ echo $view->secs." :";}if(isset($view->BirthTimeperiod)){ echo $view->BirthTimeperiod;}?></td>
      </tr>
      <tr>
        <td>Birth Name\Janma Nammamu:</td>
		<td><?php if(isset($view->BirthName)&& !empty($view->BirthName)){ echo $view->BirthName;}else{echo "N.A";}?></td>
		 <td>Gowthram:</td>
        <td><?php if(isset($view->Gowthram)&& !empty($view->Gowthram)){ echo $view->Gowthram;}else{echo "N.A";}?><td>
      </tr>
      <tr>
        <td>Zodiac or Rasi:</td>
		<td><?php if(isset($view->Rasi)&& !empty($view->Rasi)){ echo $view->Rasi;}else{echo "N.A";}?></td>
		<td>Nakshatram:</td>
        <td><?php if(isset($view->StarORNakashtram)&& !empty($view->StarORNakashtram)){ echo $view->StarORNakashtram;}else{echo "N.A";}?></td>
      </tr>
	   <tr>
        <td>Paadam:</td>
		<td><?php if(isset($view->Paadam)&& !empty($view->Paadam)){ echo $view->Paadam;}else{echo "N.A";}?></td>
		<td>Horoscope Match:</td>
        <td><?php if(isset($view->HoroscopeStatus)&& !empty($view->HoroscopeStatus)){ echo $view->HoroscopeStatus;}else{echo "N.A";}?></td>
      </tr>
	   <tr>
        <td>Manglik Status</td>
		<td><?php if(isset($view->ManglinkStatus)&& !empty($view->ManglinkStatus)){ echo $view->ManglinkStatus;}else{echo "N.A";}?></td>
      </tr>
    </tbody>
  </table>
  
   <table class="table table-striped">
    <thead>
      <tr>
        <th colspan="4">CONTACT DETAILS</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Present Address:</td>
        <td><?php if(isset($view->PresentAddress)&& !empty($view->PresentAddress)){ echo $view->PresentAddress;}else{echo "N.A";}?></td>
        <td>Permanent Address:</td>
        <td><?php if(isset($view->PerminantAddress)&& !empty($view->PerminantAddress)){ echo $view->PerminantAddress;}else{echo "N.A";}?></td>
      </tr>
      <tr>
        <td>Country:</td>
		<td><?php if(isset($view->Country)&& !empty($view->Country)){ echo $view->Country;}else{echo "N.A";}?></td>
		 <td>State:</td>
        <td><?php if(isset($view->State)&& !empty($view->State)){ echo $view->State;}else{echo "N.A";}?><td>
      </tr>
      <tr>
        <td>City:</td>
		<td><?php if(isset($view->City)&& !empty($view->City)){ echo $view->City;}else{echo "N.A";}?></td>
		<td>Alternate Mobile:</td>
        <td><?php if(isset($view->AlternateMobileNumber)&& !empty($view->AlternateMobileNumber)){ echo $view->AlternateMobileNumber;}else{echo "N.A";}?></td>
      </tr>
	   <tr>
        <td>Land Line:</td>
		<td><?php if(isset($view->PhoneNumber)&& !empty($view->PhoneNumber)){ echo $view->PhoneNumber;}else{echo "N.A";}?></td>
		<td>Residence Status:</td>
        <td><?php if(isset($view->ResidantType)&& !empty($view->ResidantType)){ echo $view->ResidantType;}else{echo "N.A";}?></td>
      </tr>
	   <tr>
        <td>Family Origin:</td>
		<td><?php if(isset($view->FamilyOrigin)&& !empty($view->FamilyOrigin)){ echo $view->FamilyOrigin;}else{echo "N.A";}?></td>
      </tr>
    </tbody>
  </table>
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th colspan="4">FAMILY DETAILS</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Father Name:</td>
        <td><?php if(isset($view->FatherName)&& !empty($view->FatherName)){ echo $view->FatherName;}else{echo "N.A";}?></td>
        <td>Father Occupation:</td>
        <td><?php if(isset($view->FatherOccupation)&& !empty($view->FatherOccupation)){ echo $view->FatherOccupation;}else{echo "N.A";}?></td>
      </tr>
      <tr>
        <td>Mother:</td>
		<td><?php if(isset($view->MotherName)&& !empty($view->MotherName)){ echo $view->MotherAliveStatus.$view->MotherName;}else{echo "N.A";}?></td>
		 <td>Mother Occupation:</td>
        <td><?php if(isset($view->MotherIOccupation)&& !empty($view->MotherIOccupation)){ echo $view->MotherIOccupation;}else{echo "N.A";}?><td>
      </tr>
      <tr>
	    <td>Elder Brothers:</td>
        <td><?php if(isset($view->NoOfElderNBrothers)&& !empty($view->NoOfElderNBrothers)){
                       $elderbrothers = $view->NoOfElderNBrothers;
                       if($elderbrothers == "None"){$elderbrothers = "None";}else{$elderbrothers = "Brothers  " .$elderbrothers." , "; }
                      } else{$elderbrothers = "N.A";}
                        if(isset($view->NoOfElderNBrothersMarried)&& !empty($view->NoOfElderNBrothersMarried)){$elderbrotherm = $view->NoOfElderNBrothersMarried;
                       if($elderbrotherm == 0){$elderbrotherm = "None Married";}else{$elderbrotherm = $elderbrotherm."Married" ; }}else{$elderbrotherm = "";}
                    echo $elderbrothers ." ". $elderbrotherm;?>
		</td>
        <td>younger Brothers:</td>
		<td>
		<?php if(isset($view->NoOfYoungerBrothers)&& !empty($view->NoOfYoungerBrothers)){
                       $youngerbrothers = $view->NoOfYoungerBrothers;
                       if($youngerbrothers == "None"){$youngerbrothers = "None";}else{$youngerbrothers = "Brothers  " .$youngerbrothers.","; }
                      } else{$youngerbrothers = "N.A";}
                        if(isset($view->NoOfYoungerBrothersMarried)&& !empty($view->NoOfYoungerBrothersMarried)){$youngerbrotherm = $view->NoOfYoungerBrothersMarried;
                       if($youngerbrotherm == 0){$youngerbrotherm = "None Married";}else{$youngerbrotherm = $youngerbrotherm."Married" ; }}else{$youngerbrotherm = "";}
                         echo $youngerbrothers ." ". $youngerbrotherm;
						 ?>
		</td>
		
      </tr>
	   <tr>
        <td>Elder Sister:</td>
		<td>
		 <?php 
            if(isset($view->NoOfElderSisters)&& !empty($view->NoOfElderSisters)){
            $eldersisters = $view->NoOfElderSisters;
            if($eldersisters == "None"){$eldersisters = "None";}else{$eldersisters = "Sisters  ".$eldersisters.",  " ; }
            } else{$eldersisters = "N.A";}
            if(isset($view->NoOfElderSistersMarried)&& !empty($view->NoOfElderSistersMarried)){$eldersistersm = $view->NoOfElderSistersMarried;
            if($eldersistersm == 0){$eldersistersm = "None Married";}else{$eldersistersm = $eldersistersm."Married" ; }}else{$eldersistersm = "";}
            echo $eldersisters ." ". $eldersistersm;
         ?>
		</td>
		<td>Younger Sister:</td>
        <td>
		<?php 
                      if(isset($view->NoOfYoungerSisters)&& !empty($view->NoOfYoungerSisters)){
                       $youngersisters = $view->NoOfYoungerSisters;
                       if($youngersisters == "None"){$youngersisters = "None";}else{$youngersisters = "Sisters  " .$youngersisters.",  "; }
                      } else{$youngersisters = "N.A";}
                        if(isset($view->NoOfYoungerSistersMarried)&& !empty($view->NoOfYoungerSistersMarried)){$youngersistersm = $view->NoOfYoungerSistersMarried;
                       if($youngersistersm == 0){$youngersistersm = "None Married";}else{$youngersistersm = $youngersistersm."Married" ; }}else{$youngersistersm = "";}
                      echo $youngersisters ." ". $youngersistersm;
                     ?>
		</td>
      </tr>
	   <tr>
        <td>About Family:</td>
		<td><?php if(isset($view->AbouUs)&& !empty($view->AbouUs)){ echo $view->AbouUs;}else{echo "N.A";}?></td>
      </tr>
    </tbody>
  </table>
  
  
   <table class="table table-striped">
    <thead>
      <tr>
        <th colspan="4">PARTNER PREFERENCE</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Looking for:</td>
        <td><?php if(isset($view->look_for)&& !empty($view->look_for)){ echo $view->look_for;}else{echo"N.A";}?></td>
        <td>Country Resident In:</td>
        <td><?php if(isset($view->countryresidant_from)&& !empty($view->countryresidant_from)){echo $view->countryresidant_from;}else{echo"N.A";}?></td>
      </tr>
      <tr>
        <td>Age:</td>
		<td><?php if(isset($view->PartnerAgeFrom)&& isset($view->partnerAgeTo)){echo $view->PartnerAgeFrom." - ".$view->partnerAgeTo."  Years" ;}?></td>
		 <td>Height:</td>
        <td><?php if(isset($view->feet_from)&& isset($view->inch_from)){echo $view->feet_from." / ".$view->inch_from;}?><td>
      </tr>
      <tr>
        <td>Complexion:</td>
		<td><?php if(isset($view->PartnerComplexion)){echo $view->PartnerComplexion ;}else{echo"N.A";} ?></td>
		<td>Education Type:</td>
        <td><?php if(isset($view->partnerEducation)){echo $view->partnerEducation ;}else{echo"N.A";} ?></td>
      </tr>
	   <tr>
        <td>Education:</td>
		<td><?php  if(isset($view->Education_from)&& !empty($view->Education_from)){
                             $edcation = $view->Education_from;
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
                          }?>
		</td>
		<td>Occupation Type:</td>
        <td><?php if(isset($view->PartnerEducationFrom)){echo $view->PartnerEducationFrom ;}else{echo"N.A";} ?></td>
      </tr>
	   <tr>
        <td>Occupation:</td>
		<td><?php
                      
                         if(isset($view->Occuaption_From)&& !empty($view->Occuaption_From)){
                             $ocupation= $view->Occuaption_From;
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
                           ?></td>
						   <td>Annual Income:</td>
		<td><?php if(isset($view->PartnerIncome)){echo $view->PartnerIncome ;}else{echo"N.A";} ?></td>
      </tr>
	 
    </tbody>
  </table>
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th colspan="4">PACKAGE DETAILS</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>MemberShip:</td>
        <td><?php if(isset($view->payment_status)&& !empty($view->payment_status)){
			if($view->payment_status == 0){ echo"Free"; }
		    else if($view->payment_status == 1){ echo"Expired"; }else{ echo"Paid"; }
					}else{echo "N.A";}?></td>
        <td>Subscribed On:</td>
        <td><?php if(isset($view->AddedOn)&& !empty($view->AddedOn)){ echo date('d-M-Y',strtotime($view->AddedOn));}else{echo "N.A";}?></td>
      </tr>
      <tr>
        <td>Valid Upto:</td>
		<td><?php if(isset($view->Validity)&& !empty($view->Validity)){ echo date('d-M-Y',strtotime($view->Validity));}else{echo "N.A";}?></td>
		 <td>Package Name:</td>
        <td><?php if(isset($view->Package)&& !empty($view->Package)){ echo $view->Package;}else{echo "N.A";}?><td>
      </tr>
      <tr>
        <td>Price:</td>
		<td><?php if(isset($view->price)&& !empty($view->price)){ echo $view->price;}else{echo "N.A";}?></td>
		<td>Package Validity:</td>
        <td><?php if(isset($view->PackageValidity)&& !empty($view->PackageValidity)){ echo $view->PackageValidity;}else{echo "N.A";}?></td>
      </tr>
	   <tr>
        <td>No Of Views:</td>
		<td><?php if(isset($view->NoOfViews)&& !empty($view->NoOfViews)){ echo $view->NoOfViews;}else{echo "N.A";}?></td>
      </tr>
	   
    </tbody>
  </table>
  


      </div>
        
       
        
        
        
       
        
    </section>
  </div>
<?php
  $this->load->view('Admin/common_fotter');
?> 