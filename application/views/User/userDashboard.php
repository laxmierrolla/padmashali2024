<?php $this->load->view('template/userdashboard/head');?>
<body>
<?php $this->load->view('template/userdashboard/header');

$profile_code = (isset($this->session->userdata['user']['username']))?$this->session->userdata['user']['username']:'';
$gender=(isset($this->session->userdata['user']['gender']))?$this->session->userdata['user']['gender']:''; 
$gender_pic = ($gender == 'Female') ? 'female.jpg' : 'male.png';
$dummy_profile_pic = base_url() . 'assets/images/' . $gender_pic;
$gender_pic1 = ($gender == 'Female') ? 'male.png' : 'female.jpg';
$genderdummy = base_url() . 'assets/images/' . $gender_pic1;
$protect = base_url() . 'assets/images/protect.png';
$paid = (isset($this->session->userdata['user']['payment_status']))?$this->session->userdata['user']['payment_status']:'';
 if($paid==0){
		 $paidstaus = "Free";
		 }
	 else if($paid==1){
		$paidstaus = "Expired";
		}
		else{
			$paidstaus = "Paid";
			}
?>

 <div class="main-container no-mar">
  <div class="container">
    <div class="col-md-3 col-xs-12">
      <div id="accordion" role="tablist" aria-multiselectable="true">
        <div class="card">
          <div id="collapseOne" class="collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="card-block">
              <div class="row">
              <?php if($data->thumbimage!==""){ if($data->Profile_photo_Status == 1){ $img = $data->thumbimage;?>
				<div class="col-md-12"> <img src="<?php echo base_url().'uploads/profilepics/'.$profile_code.'/'.$img;?>" class="img-responsive img-circle text-center" alt="User profile photo here" style="width:50%;margin-left:20% "/> </div>
			<?php } else{?>
				<div class="col-md-12"> <img src="<?php echo $dummy_profile_pic;?>" class="img-responsive img-circle text-center" alt="User profile photo here" style="width:50%;margin-left:20% "/> </div>
			<?php }} else{?>
				<div class="col-md-12"> <img src="<?php echo $dummy_profile_pic;?>" class="img-responsive img-circle text-center" alt="User profile photo here" style="width:50%;margin-left:20% "/> </div>
			<?php }?>
      <div class="col-md-12">
      <div class="card-header">
           <p class="text-center"> <?php if(isset($data->sname)&&(isset($data->fname))&&(isset($data->lname))){ $name = $data->sname.' '.$data->fname.' '.$data->lname; echo strtoupper($name);}?></p>
          </div>
      </div>
                <div class="col-md-12">

                <?php if(isset($data->age)){?>
                  <p class="text-center"> Age : <?php echo $data->age."  Years";}?> <br />
                     Location : <?php echo $data->location;?> <br /></br>
                  <a href="<?php echo base_url('userdashboard/viewProfile'); ?>" class="btn btn-warning btn-xs">View Profile</a> </div>
              </div>
            </div>
          </div>
        </div>
     <div class="panel panel-default no-brd">
        <div class="panel-heading no-brd1 no-brd no-bag">
            <h4 class="panel-title panel-title-adjust col-md-12 no-pad">
               <a data-toggle="collapse" data-parent="#accordion4" href="#collapseOne4" class="col-md-12 no-pad hd">
                   <span class="fa fa-ticket" aria-hidden="true"></span> &nbsp; Membership Details
               </a>
              <div class="clearfix"></div>
            </h4>
            <div class="clearfix"></div>
          </div>
          <div id="collapseOne4" class="panel-collapse collapse in">
             <div class="panel-body no-pad">
              <?php if($paidstaus=="Paid"){?>
               <div class="membership">
                  <p style="color:#fff;font-size:16px;font-family: 'BrandonGrotesque-Bold'"> Membership Type :&nbsp;<button class="btn btn-warning btn-xs">
                               <?php if(isset($data->package) && !empty($data->package)){ echo $data->package;                            
                               }?></button><br />
                    Valid upto:  <?php if(isset($data->subscribe_validity) && !empty($data->subscribe_validity)){ echo date('d-m-Y',strtotime($data->subscribe_validity));                            
                               }?> <br />
                    <?php $ProfilesViewed="";
					$Remaining=""; 
                    if(isset($contactscount['numbersviewed'])){ $ProfilesViewed =$contactscount['numbersviewed']; }?>
                     Profiles Viewed :<?php echo $ProfilesViewed;?><br />
                    <?php if(isset($data->noofviews)&&!empty($data->noofviews)){ $Remaining =$data->noofviews -$ProfilesViewed;}?>
                    Remaining Profiles :<?php echo $Remaining;?></p>
                            </div>
                            <?php } else{?>
                             <div class="panel-footer text-center">
                              <a href="<?php echo base_url('userdashboard/package_info');?>">Upgrade Now</a>
                            </div>
                            <?php } ?>
                          </div>
                           
                        </div>
                    </div>
        
        <div class="card">
          <div class="card-header" role="tab" id="headingTwo">
            <h5 class="mb-0"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> <i class="fa fa-search" aria-hidden="true"></i> Quick Search </a> </h5>
          </div>
          <div id="collapseTwo" class="collapse in" role="tabpanel" aria-labelledby="headingTwo">
            <div class="card-block">
             <form action="<?php echo base_url(); ?>matched-result" method="post"> 
                <!-- Form start -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Profession</label>
                      <select name="occupation[]" id="occupation" class="form-control input-md">
                          <option value="0">Choose Profession</option>
                        <?php
                    if (isset($occupation) && count($occupation) > 0) {
                        foreach ($occupation as $ocu) {
                            ?>
                          <option value="<?php echo $ocu->Occ_Id; ?>"><?php echo ucfirst($ocu->occupation); ?></option>
                    <?php } } ?>
                      </select>
                    </div>
                  </div>
                  <!-- Text input-->
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Qualification</label>
                      <select name="education[]" id="education" class="form-control input-md">
                          <option value="0">Choose Qualification</option>
                       <?php
                        if (isset($education) && count($education) > 0) {
                        foreach ($education as $edu) {
                            ?>
                          <option value="<?php echo $edu->edu_id; ?>"><?php echo ucfirst($edu->education); ?></option>
                     <?php  } } ?>
                      </select>
                    </div>
                  </div>
                  <!-- Text input-->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label" for="date">From</label>
                      <select id="age_from" name="age_from" class="form-control">
                        <option value="0">Age From</option>
                          <?php for($af=18;$af<100;$af++){ ?>
                          <option value="<?php echo $af; ?>"><?php echo $af; ?></option>
                        <?php }  ?>
                      </select>
                    </div>
                  </div>
                  <!-- Select Basic -->
                  <div class="col-md-6">
                    <div class="form-group">
                       <label class="control-label" for="time">To</label>
                           <select id="age_to" name="age_to" class="form-control">
                          <option value="0">Age To</option>
                        <?php for($at=18;$at<100;$at++){ ?>
                          <option  value="<?php echo $at; ?>"><?php echo $at; ?></option>
                        <?php }  ?>
                      </select>
                    </div>
                  </div>
                  <!-- Button -->
                  <div class="col-md-12">
                    <div class="form-group">
                      <button name="singlebutton" class="btn btn-default">Search</button>
                      <button name="singlebutton" class="btn btn-default">Clear</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 no-pad">
    
      <div class="col-md-12 midd-ribb">
      <?php if($paidstaus =="Free") {?>
        <div id="ribbon-container" class="text-center">
        <a href="<?php echo base_url("userdashboard/package_info");?>" id="ribbon" target="_blank">Why should you wait when you can Contact <br>
              your matches directly ? <button class="btn btn-warning btn-xs text-uppercase">Upgrade Now </button></a>
              <div class="clearfix"></div>
        </div>
        <?php } ?>
         <?php if($this->session->flashdata('pass_sucess')){ ?>
            <div class="alert alert-success fade in">
    			<a href="" class="close" data-dismiss="alert">&times;</a>
    		<strong>Success!</strong> Your Password changed successfully.
		</div>
        <?php } ?>
        
        <div class="clearfix">&nbsp;</div>
     <div class="clearfix">&nbsp;</div>
     <div class="clearfix">&nbsp;</div>
     <div class="clearfix">&nbsp;</div>
      <div class="row">
        <div class="col-md-12 some-profiles">
         <?php $prefered_matches =  $prefered_matches->result();
		  if(isset($prefered_matches)&&!empty($prefered_matches)){ ?>
          <h5><span>Preferred Matches</span></h5>
          <div class="owl-carousel owl-theme">
		  <?php   
		  	 foreach($prefered_matches->result() as $row){?>
            <div class="col-sm-12 item">
             <?php if($row->thumbimage!==""){ if($row->Photoprotect == 1){?>
			  <div class="card"> <img class="card-img-top" src="<?php echo $protect;?>" alt="user pic">
			 <?php }else if($row->Profile_photo_Status == 1){ $img = $row->thumbimage;?>
			  <div class="card"> <img src="<?php echo base_url().'uploads/profilepics/'.$row->profile_code.'/'.$img;?>" alt="user pic">
			 <?php }else{?>
			 <div class="card"> <img src="<?php echo $genderdummy;?>" alt="user pic">
			 <?php }}else{?>
				<div class="card"> <img src="<?php echo $genderdummy;?>" alt="user pic"> 
			 <?php } ?>
			 
                 
  <div class="card-body">
                  <p>ID: <?php echo $row->profile_code; ?><br />
                    <?php echo $row->age; ?> Years</p>
                </div>
                <div class="card-footer"> <a href="<?php echo base_url('partnerdetails/').$row->profile_code;?>" target="_blank" class="btn btn-danger btn-xs">Full Profile</a> </div>
              </div>
            </div>
			 <?php } ?>
          </div>
         <?php if($prefered_matches->num_rows() == 5){?> 
          <div class="row text-center viewall">
            <div class="col-md-6 col-md-push-3">
           <a href="<?php echo base_url('userdashboard/getall_prefermatches');?>" class="btn btn-default btn-xs text-center">View All Profiles&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
         </div>
          </div>
          <?php }} ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 some-profiles">
          <h5><span>People Joined Recently</span></h5>
          <div class="owl-carousel owl-theme">
		  <?php if($recent_profile){foreach($recent_profile->result() as $row){ ?>
            <div class="col-sm-12 item">
                <?php if($row->thumbimage!==""){ if($row->Photoprotect == 1){?>
			  <div class="card"> <img class="card-img-top" src="<?php echo $protect;?>" alt="user pic">
			 <?php }else if($row->Profile_photo_Status == 1){ $img = $row->thumbimage;?>
			  <div class="card"> <img src="<?php echo base_url().'uploads/profilepics/'.$row->profile_code.'/'.$img;?>" alt="user pic">
			 <?php }else{?>
			 <div class="card"> <img src="<?php echo $genderdummy;?>" alt="user pic">
			 <?php }}else{?>
				<div class="card"> <img src="<?php echo $genderdummy;?>" alt="user pic"> 
			 <?php } ?>      
   
                <div class="card-body">
                  <p>ID:<?php echo $row->profile_code; ?><br />
                    <?php echo $row->age; ?> Years</p>
                </div>
                <div class="card-footer"> <a href="<?php echo base_url('partnerdetails/').$row->profile_code;?>" target="_blank" class="btn btn-danger btn-xs">Full Profile</a> </div>
              </div>
            </div>
		  <?php  }}?>
          </div>
          <div class="row text-center viewall">
            <div class="col-md-6 col-md-push-3">
           <a href="<?php echo base_url('userdashboard/getall_recently')?>" class="btn btn-default btn-xs text-center">View All Profiles&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
         </div>
          </div>

        </div>
      </div>
      <div class="row">
        <div class="col-md-12 some-profiles">
		<?php $viewdme_list =  $viewdme_list->result();
		  if(isset($viewdme_list)&&!empty($viewdme_list)){ ?>
          <h5><span>Who viewed your profile</span></h5>
           <div class="owl-carousel owl-theme">
		    <?php foreach($viewdme_list->result() as $row){ ?>
            <div class="col-sm-12 item">
                  <?php if($row->thumbimage!==""){ if($row->Photoprotect == 1){?>
			  <div class="card"> <img class="card-img-top" src="<?php echo $protect;?>" alt="user pic">
			 <?php }else if($row->Profile_photo_Status == 1){ $img = $row->thumbimage;?>
			  <div class="card"> <img src="<?php echo base_url().'uploads/profilepics/'.$row->profile_code.'/'.$img;?>" alt="user pic">
			 <?php }else{?>
			 <div class="card"> <img src="<?php echo $genderdummy;?>" alt="user pic">
			 <?php }}else{?>
				<div class="card"> <img src="<?php echo $genderdummy;?>" alt="user pic"> 
			 <?php } ?>
                <div class="card-body">
                  <p>ID: <?php echo $row->profile_code; ?><br />
                    <?php echo $row->age; ?> Years</p>
                </div>
                <div class="card-footer"> <a href="<?php echo base_url('partnerdetails/').$row->profile_code;?>" target="_blank" class="btn btn-danger btn-xs">Full Profile</a> </div>
              </div>
            </div>
			<?php } ?>
			</div>
			 <?php if($viewdme_list->num_rows() == 5){?> 
          <div class="row text-center viewall">
            <div class="col-md-6 col-md-push-3">
           <a href="<?php echo base_url('userdashboard/viewdMyProfile')?>" class="btn btn-default btn-xs text-center">View All Profiles&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
         </div>
          </div>
		   <?php }} ?>
        </div>
      </div>
      <div class="clearfix"></div>
       </div>
       <div class="clearfix"></div>
    </div>
  </div>
</div>
 <?php $this->load->view('template/userdashboard/footer')?>

<script>
            $(document).ready(function() {
              $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: true
                  },
                  600: {
                    items: 3,
                    nav: false
                  },
                  1000: {
                    items: 4,
                    nav: true,
                    loop: false,
                    margin: 10
                  }
                }
              })
            })
          </script>
</body>
</html>

