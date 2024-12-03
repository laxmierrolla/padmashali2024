<style>
#PhotoModal .modal-dialog{
  height:100%;
  top: 0;
  left:0;
  padding: 0;
  margin-left:100px ;
}
#PhotoModal .modal-content{
 border-radius: 0;
 background: #fff;
}
#PhotoModal .modal-footer{
  position: absolute;
  bottom: 0;
  left: 0;
  bottom: 0;
  width: 100%;
}
.carousel{
    height:80%;
}

</style>
<?php 
  $this->load->view('template/userdashboard/head');
  /*echo"<pre>";
  print_r($this->session->all_userdata());*/
  $paid = (isset($this->session->userdata['user']['payment_status']))?$this->session->userdata['user']['payment_status']:'';
 if($paid==0){ $paidstaus = "Free"; }
 else if($paid==1){	$paidstaus = "Expired";}
 else{ $paidstaus = "Paid"; }
 $gender_pic=($gender=='Female')?'male.png':'female.jpg';
 $dummy_profile_pic=IMAGES_PATH.$gender_pic;
 $protect = base_url() . 'assets/images/protect.png';
 

$protect = base_url() . 'assets/images/protect.png';
 if($intrcodes){
	 foreach($intrcodes as $values){
		 $intrcodes[] = $values->partnerids;
		 }
	 }

 if($partnercodes){
	 foreach($partnercodes as $values){
		 $codes[] = $values->partnercode;
		 }
	 }
 
 $profile_req =json_decode($profile_data);
 if($profile_req->code!=200){     redirect(base_url());}
 if($profile_req->code==200)
 {
     $profile_res=$profile_req->profile_result;
?>
<body>
<?php
    $this->load->view('template/userdashboard/header');
    /* print_r($this->session->all_userdata()); */
    ?>
<div class="container">
  <div class="col-md-12 details"><!--details start-->
    <div class="col-md-9">
       <div class="panel panel-default no-brd">
        <div class="panel-body col-md-12">
          <div class="col-md-3 no-pad">
            
			   <?php $profile_image = '';
			   if($profile_res->thumbimage!==""){ if($profile_res->Photoprotect == 1){?>
				   <span title="Photo is protected" data-toggle="modal" data-target="#notification"style="cursor:pointer"><img src="<?php echo $protect; ?>" alt="image" class="img-responsive" width="100%" /></span>
			    
			  <?php  }else if($profile_res->Profile_photo_Status == 1){ 
			      $img = $profile_res->thumbimage;
			     $profile_image  = base_url().'uploads/profilepics/'.$profile_res->profile_code.'/'.$img;?>
				 <a href="javascript:void(0);"><img src="<?php echo $profile_image; ?>" alt="#" class="img-responsive" width="100%" /></a>
			<?php }else{?>
			<a href="javascript:void(0);"><img src="<?php echo $dummy_profile_pic; ?>" alt="#" class="img-responsive" width="100%" /></a>
			 
			<?php }}else{?>
				<a href="javascript:void(0);"><img src="<?php echo $dummy_profile_pic; ?>" alt="#" class="img-responsive" width="100%" /></a>
			<?php } ?>
		
            
			<div data-toggle="modal" title="click here for more images" data-target="#PhotoModal" style="margin-top:-33px; margin-left:5px; color:#ffffff !important" ><i class="fa fa-2x fa-image"></i></div>
          </div>
          <div class="col-md-9 details-right">
            <div class="col-md-8"><?php echo ucfirst($profile_res->sname); ?>
            <div class="clearfix"></div>
            <small>(<i>Created by&nbsp;:&nbsp;<?php echo ucfirst($profile_res->profile_by); ?></i>)</small></h4>
          </div>
          <div class="col-md-4 no-pad text-right"><h5>Profile Id&nbsp;:&nbsp;<span class="btn btn-xs btn-success"> <?php echo ucfirst($profile_res->profile_code); ?></span></h5></div>
         
          <div class="clearfix"></div>
          <div class="col-md-12">
          <div class="col-md-7 no-pad">
          <ul class="list-inline">
              <?php
			  $dateOfBirth = (isset($profile_res->dob))?$profile_res->dob:'';$today = date("Y-m-d");
              $diff = date_diff(date_create($dateOfBirth), date_create($today));
              $age = $diff->format('%y');
              
              ?>
            <li><img src="<?php echo IMAGES_PATH; ?>age.png" alt="age" /><?php echo $age; ?> years</li>
            <li><img src="<?php echo IMAGES_PATH; ?>height.png" alt="height" /><?php echo $profile_res->feet; ?></li>
            <li><img src="<?php echo IMAGES_PATH; ?>working.png" alt="education" /><?php echo ucfirst($profile_res->edu_details); ?></li>
            <li><img src="<?php echo IMAGES_PATH; ?>education.png" alt="education" /><?php echo ucfirst($profile_res->occ_details); ?></li>
            <li><img src="<?php echo IMAGES_PATH; ?>location.png" alt="location" /><?php echo ucfirst($profile_res->city); ?>,  <?php echo ucfirst($profile_res->state); ?>,<?php echo ucfirst($profile_res->country); ?>.</li>
            
            <div class="clearfix"></div>
            <!--  -->
          </ul>
        </div>
         
	  
        <div class="col-md-5">
        <ul class="list-inline">
            <?php
            $mailreq=$profile_res->email;
            $maildetails=explode('@',$mailreq);
            ?>
           <li><img src="<?php echo IMAGES_PATH; ?>mobile.png" alt="age" />+91-xxxxxxxxxx</li>
            <li><img src="<?php echo IMAGES_PATH; ?>email.png" alt="age" /><?php echo substr($maildetails[0],0,1); ?>xxxxxxx@<?php echo $maildetails[1]; ?></li>
            <li>
			<?php if($paidstaus =="Free"){?>
            <a href="<?php echo base_url('userdashboard/package_info');?>"><button type="button" class="btn btn-warning btn-md" data-toggle="modal">Send Message</button></a><?php }
			else{  ?>
            <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#intrstModal">Send Message</button><?php }?>
            </li>
        </ul>
      </div>
        <div class="clearfix"></div>
        </div>
          <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
        </div> 
        <div class="clearfix"></div>
        <!--bootstrap modal for SendIntrest start here-->
        
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="intrstModal">
  <div class="modal-dialog modal-mi">
    <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Send Intrest Message</h4>
        </div>
        <div class="modal-body">
        <input type="hidden" name="intrstedid" id="intrstedid" value="<?php echo $profile_res->profile_code;?>" >
         <div class="form-group">
         <textarea class="form-control" rows="5" id="intrestmessage" name="intrestmessage">Hi<?php echo " ".$profile_res->fname;?>, I am interested in your profile. Would you like to communicate further?</textarea>
         <span id="msgerr" style="display:none;color:red">Message shouldnot be empty</span>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="modal-btn-send">Send</button>
        <button type="button" class="btn btn-primary" id="modal-btn-no" data-dismiss="modal" aria-hidden="true">Cancel</button>
      </div>
    </div>
  </div>
</div>
        
        <!--bootstrap modal for SendIntrest end here-->
        <!--bootstrap modal for shortlist profile start here-->
        
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="saveModal">
  <div class="modal-dialog modal-mi">
    <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Are you sure to shortlist profile</h4>
        <input type="hidden" name="spfcode" id="spfcode" value="<?php echo $profile_res->profile_code;?>" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="modal-btn-confirm">Confirm</button>
        <button type="button" class="btn btn-primary" id="modal-btn-no" data-dismiss="modal" aria-hidden="true">Cancel</button>
      </div>
    </div>
  </div>
</div>
        
        <!--bootstrap modal for shortlist profile end here-->
         <!--bootstrap modal for ViewContacts start here-->
         
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="contactsModal">
  <div class="modal-dialog modal-mi">
    <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Are you sure to see the contacts</h4>
        <input type="hidden" name="contactcode" id="contactcode" value="<?php echo $profile_res->profile_code;?>" >
      </div>
      <div class="modal-body" id="contactdetails" style="display:none">
          <label>email:</label><span id="emailId"></span><br>
          <label>contactnumber:</label><span id="phoneNum"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="modal-btn-yes">Yes</button>
        <button type="button" class="btn btn-default" id="modal-btn-ok" style="display:none;" data-dismiss="modal" aria-hidden="true">OK</button>
        <button type="button" class="btn btn-primary" id="modal-btn-no" data-dismiss="modal" aria-hidden="true">No</button>
      </div>
    </div>
  </div>
</div>




<div id="PhotoModal" class="modal fade" >
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Modal title</h4>
   </div>
   <div class="modal-body row">
     <div class="col-md-6 col-sm-6 col-xs-6">
	   <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner">
          <?php $i=0; if($images && $images!=""){ foreach($images as $value){?>
            <div class="item   <?php if($i==0){?> active <?php } ?>">
              <img src="<?php echo base_url().'/uploads/profilepics/'.$profile_res->profile_code.'/'.$value['img_src'];?>" >
            </div><!-- End Item -->
 <?php  $i++; }}?>
          </div><!-- End Carousel Inner -->
          <!-- Controls -->
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div><!-- End Carousel -->
    
     </div>
     <div class="col-md-6 col-sm-6 col-xs-6">
	 <div class="col-md-6">
             <h3><?php echo $profile_res->sname.$profile_res->fname.$profile_res->lname?></h3>
			<p><strong>Matrimony ID :</strong>	T4389683</p>
			<p><strong>Age :</strong><?php echo " ".$age." Years";?></p>
			<p><strong>Height :</strong><?php echo $profile_res->feet; ?></p>
			<p><strong>Star :</strong><?php echo $profile_res->starname; ?><p>
			<p><strong>Location :</strong><?php echo ucfirst($profile_res->edu_details);?></p>
			<p><strong>Education :</strong>	<?php echo ucfirst($profile_res->occ_details);?><p>

     </div>
    </div>
    
  </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

  </div>       
  <div id="notification" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <h5><div id="msgbox"></div></h5>
      <div class="modal-body">
        <p>Send request to see photos of the User.</p>
		<input type="hidden" id="to_request" value="<?php echo $profile_res->profile_code; ?>">
      </div>
      <div class="modal-footer">
	  <button type="button btn-success" id="send_request" class="btn btn-success" >Send</button>
        <button type="button btn-danger" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
  </div>
          <!--bootstrap modal for View Contacts End here-->
        
     <div class="panel-footer clearfix details-footer no-brd">
       <div class="col-md-12">
       
   <?php 
	  if($paidstaus =="Free"){?>
       <a href="<?php echo base_url('userdashboard/package_info');?>" class="btn btn-default btn-sm pull-right"><img src="<?php echo IMAGES_PATH; ?>eye.png" alt=""/>View Contacts</a><?php }else {
		   if($contactscount['numbersviewed']){
			    $count = $this->session->userdata['user']['noofviews'] - $contactscount['numbersviewed'];
				 if($count == 0){?>
                 <a href="<?php echo base_url('userdashboard/package_info');?>" class="btn btn-default btn-sm pull-right"><img src="<?php echo IMAGES_PATH; ?>eye.png" alt=""/>View Contacts</a>
			<?php } else{?>
			<a href="#" class="btn btn-default btn-sm pull-right" data-toggle="modal" data-target="#contactsModal"><img src="<?php echo IMAGES_PATH; ?>eye.png" alt=""/>View Contacts</a>       
				<?php }}}?>
	
      <?php 
	  if(isset($codes)&&!empty($codes)){
	   if(in_array($profile_res->profile_code,$codes)){?>
		<a disabled class="btn btn-sm btn-default pull-right"><img src="<?php echo IMAGES_PATH; ?>save.png" alt=""/>Shorlisted        </a><?php }
		else{ ?>
     <a href="#" data-toggle="modal" data-target="#saveModal" class="btn btn-sm btn-default pull-right"><img src="<?php echo IMAGES_PATH; ?>save.png" alt=""/>Shorlist Profile</a>
     <?php }}else{ ?>
		 <a href="#" data-toggle="modal" data-target="#saveModal" class="btn btn-sm btn-default pull-right"><img src="<?php echo IMAGES_PATH; ?>save.png" alt=""/>Shorlist Profile</a>
		<?php } ?>
	
   <a href="<?php echo base_url().'userdashboard/printpartnerdetails/'.$profile_res->profile_code;?>" target="_blank" class="btn btn-sm btn-default pull-right"><img src="<?php echo IMAGES_PATH; ?>printer.png" alt=""/>Print</a>
     </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 latest-left">
        <!-- Accordion begin -->
    <div class="accordion_example1">
    
      <!-- Section 1 -->
      <div class="accordion_in acc_active panel panel-default no-brd">
        <div class="acc_head panel-heading no-brd"><h2><img src="<?php echo IMAGES_PATH; ?>abt.png" alt="user" />About <?php echo ucfirst($profile_res->fname); ?></h2></div>
        <div class="acc_content panel-body col-md-12 latest-content">
        <div>
         <p><?php echo ucfirst($profile_res->aboutme); ?></p>
        </div>
        
             
        </div>
      </div>
      <div class="accordion_in panel panel-default no-brd"><!--second panel start-->
            <div class="acc_head panel-heading no-brd">
              <h2><img src="<?php echo IMAGES_PATH; ?>basic.png" alt="user" />Basic Details</h2>
              <div class="clearfix"></div>
            </div>
            <div class="acc_content panel-body col-md-12 latest-content">
             <div class="col-md-12 no-pad">
                <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Profile created by</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->profile_by); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Reference by</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->ref_by); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Name</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->fname); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Age</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo $age; ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Gender</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->gender); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Marital Status</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->marital_status); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Date of Birth </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo date('d-m-Y',strtotime($profile_res->dob)); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Mother Tongue</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->mother_tounge); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Nationality </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad">Hindu, Indian</div>
                    </div>
                  </li>
                  
                  </ul>
              </div>
             
            </div>
            <div class="clearfix"></div>
          </div><!--second panel end-->
          <div class="accordion_in panel panel-default no-brd"><!--second panel start-->
            <div class="acc_head panel-heading no-brd">
              <h2><img src="<?php echo IMAGES_PATH; ?>book.png" alt="user" />Professional Information</h2>
              <div class="clearfix"></div>
            </div>
            <div class="acc_content panel-body col-md-12 latest-content">
             <div class="col-md-12 no-pad">
                <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Education </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->education); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Education in Details</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->edu_details); ?></div>
                    </div>
                  </li>
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Employed in </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->employmentdetails); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Occupation</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->occupation); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Occupation in Detail</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->occ_details); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Annual Income</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->income); ?></div>
                    </div>
                  </li>
                  
                  
                  </ul>
              </div>
             
            </div>
            <div class="clearfix"></div>
          </div><!--second panel end-->
      <div class="accordion_in panel panel-default no-brd"><!--second panel start-->
            <div class="acc_head panel-heading no-brd">
              <h2><img src="<?php echo IMAGES_PATH; ?>physical.png" alt="user" />Physical Status&nbsp;&amp;&nbsp;Hobbies</h2>
              <div class="clearfix"></div>
            </div>
            <div class="acc_content panel-body col-md-12 latest-content">
             <div class="col-md-12 no-pad">
                <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Height</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo $profile_res->feet;  ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Weight&nbsp;( In Kgs ) </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo $profile_res->weight;  ?></div>
                    </div>
                  </li>
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Complexion </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo $profile_res->cmplxion;  ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Blood group </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo $profile_res->bldgrp;  ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Special Cases </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->splcases); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Dite</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->dite); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Body Type </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->body_type); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Smoke</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->smoke); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Drink</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->drink); ?></div>
                    </div>
                  </li>
                  </ul>
              </div>
          
            </div>
            <div class="clearfix"></div>
          </div><!--second panel end-->
          <div class="accordion_in panel panel-default no-brd"><!--second panel start-->
            <div class="acc_head panel-heading no-brd">
              <h2><img src="<?php echo IMAGES_PATH; ?>horoscope.png" alt="user" />Horoscope Information</h2>
              <div class="clearfix"></div>
            </div>
            <div class="acc_content panel-body col-md-12 latest-content">
             <div class="col-md-12 no-pad">
                <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Birth Place</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->splcases); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Birth Time </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->birth_place); ?></div>
                    </div>
                  </li>
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad" style="line-height:15px;">Birth Name/Janma Namamu</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->birth_name); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Gowthram </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->gowthram); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Zodiac or Raasi</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->rasi); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Nakshathram</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->starname); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Paadam </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->paadam); ?></div>
                    </div>
                  </li>
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Horoscope Match</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->horoscope); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Manglik Status</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->manglik); ?></div>
                    </div>
                  </li>
                  </ul>
              </div>
              
            </div>
            <div class="clearfix"></div>
          </div><!--second panel end-->
          <div class="accordion_in panel panel-default no-brd"><!--second panel start-->
            <div class="acc_head panel-heading no-brd">
              <h2><img src="<?php echo IMAGES_PATH; ?>mobile.png" alt="user" />Contact Details</h2>
              <div class="clearfix"></div>
            </div>
            <div class="acc_content panel-body col-md-12 latest-content">
             <div class="col-md-12 no-pad">
                <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Address </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad" style="line-height:16px;text-align:justify;"><?php echo ucfirst($profile_res->address); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Permanent  Address </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad" style="line-height:16px;text-align:justify;"><?php echo ucfirst($profile_res->perminantaddress); ?></div>
                    </div>
                  </li>
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Country</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->country); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">State </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->state); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">City</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->city); ?></div>
                    </div>
                  </li>
              
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Residence Status</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->res_status); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Family Origin</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->family_origin); ?></div>
                    </div>
                  </li>
                  </ul>
              </div>
             
            </div>
            <div class="clearfix"></div>
          </div><!--second panel end-->
          <div class="accordion_in panel panel-default no-brd"><!--second panel start-->
            <div class="acc_head panel-heading no-brd">
              <h2><img src="<?php echo IMAGES_PATH; ?>family.png" alt="user" />Family Details</h2>
              <div class="clearfix"></div>
            </div>
            <div class="acc_content panel-body col-md-12 latest-content">
             <div class="col-md-12 no-pad">
                <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Father Name </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->fa_alive); ?>.<?php echo ucfirst($profile_res->father_name); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Father Occupation</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->father_occupation); ?></div>
                    </div>
                  </li>
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Mother</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->ma_alive); ?>.<?php echo ucfirst($profile_res->mother_name); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Mother Occupation </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->mother_occupation); ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Brothers</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad" style="line-height:15px;"><?php echo $profile_res->elder_bro; ?> Not Married, <?php echo $profile_res->elder_bro; ?> Married</div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Sister</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad" style="line-height:15px;"><?php echo $profile_res->young_sis; ?> Not Married, <?php echo (!empty($profile_res->young_sis1))?$profile_res->young_sis1.'Married':'_ _'; ?> </div>
                    </div>
                  </li>
                  <li class="col-md-12 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-2 no-pad">About Family</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-9 no-pad" style="line-height:15px;"><?php echo (!empty($profile_res->desc_family))?ucfirst($profile_res->desc_family):'_ _'; ?>.</div>
                    </div>
                  </li>
                  
                  </ul>
              </div>
             
            </div>
            <div class="clearfix"></div>
          </div><!--second panel end-->
          
          <div class="accordion_in panel panel-default no-brd"><!--second panel start-->
            <div class="panel-heading acc_head no-brd">
               <h2><img src="<?php echo IMAGES_PATH; ?>partnership.png" alt="user" />Partner Preference</h2>
              <div class="clearfix"></div>
            </div>
           <div class="acc_content panel-body col-md-12 latest-content">
             <div class="col-md-12 no-pad">
                <ul class="list-inline">
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Looking for</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->look_for); ?></div>
                    </div>
                  </li>
<!--                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Country Resident In</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo ucfirst($profile_res->look_for); ?></div>
                    </div>
                  </li>-->
                  
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Age</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad">From : <?php echo $profile_res->age_from; ?> - To : <?php echo $profile_res->age_to; ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Height</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo $profile_res->feet_from; ?> To <?php echo $profile_res->inch_from; ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Complexion</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo $profile_res->Complexion_from; ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Education</div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad">--</div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Occupation </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo $profile_res->Occuaption_FromType; ?></div>
                    </div>
                  </li>
                  <li class="col-md-6 no-pad">
                    <div class="col-md-12 no-pad">
                      <div class="col-md-5 no-pad">Annual Income </div>
                      <div class="col-md-1 text-center no-pad">:</div>
                      <div class="col-md-5 no-pad"><?php echo (!empty($profile_res->AnnualIncome_from))?$profile_res->AnnualIncome_from:'_ _'; ?></div>
                    </div>
                  </li>
                  </ul>
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
        <div class="col-md-12 latest-left">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="col-md-12 no-pad">
                <h2>Viewed Similar Profile</h2>
                 <div class="clearfix"></div>
              </div>
              <div class="clearfix"></div>
            </div>
      <div class="panel-body col-md-12" style="padding:5px;">
          <!--Start Here -->
          <?php
          $similar_req=json_decode($related_profiles);
          //echo $related_profiles;
          if($similar_req->code==200){
              foreach($similar_req->related_profile as $similar_res){
                  $profile_link=  base_url().'partnerdetails/'.$similar_res->profilecode;
                  $partner_image = '';
				  
				
			   if($similar_res->thumbimage!==""){ if($similar_res->Photoprotect == 1){
			     $partner_image =  $protect;
			   }else if($similar_res->Profile_photo_Status == 1){ 
			      $img = $similar_res->thumbimage;
			     $partner_image  = base_url().'uploads/profilepics/'.$similar_res->profilecode.'/'.$img;
			 }else{
			 $partner_image = $dummy_profile_pic;
			}}else{
				 $partner_image = $dummy_profile_pic;
			 } ?>
		
        <div class="col-md-12 viewpro">
          <div class="col-md-3 no-pad">
            <a href="<?php echo $profile_link; ?>"><img src="<?php echo $partner_image; ?>" alt="<?php echo $similar_res->profilecode; ?>" class="img-responsive" width="100%" /></a>
          </div>
          <div class="col-md-9 details-right1">
           <div class="col-md-12">
            <h4><a href="<?php echo $profile_link; ?>"> <?php echo $similar_res->profilecode; ?></a></h4>
          <div class="clearfix"></div>
            <ul class="list-inline">
			<?php $dateOfBirth = (isset($similar_res->dob))?$similar_res->dob:'';
				 $today = date("Y-m-d");
				$diff = date_diff(date_create($dateOfBirth), date_create($today));
				$sage = $diff->format('%y'); ?>
			
              <li><img src="<?php echo IMAGES_PATH; ?>age.png" alt="age" width="16" height="16" />&nbsp;<?php echo $sage; ?> years, <?php echo $similar_res->feet; ?></li>
              <li><img src="<?php echo IMAGES_PATH; ?>location.png" alt="age" width="16" height="16" />&nbsp;<?php echo $similar_res->city; ?>, <?php echo $similar_res->country; ?></li>
              
            </ul>
        <div class="clearfix"></div>
        </div>
          <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
          </div>
          <?php } } ?>
          <!--End Here -->
          <div class="clearfix"></div>
        </div> 
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
        </div>
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
<?php $this->load->view('template/userdashboard/footer') ?>

  <script type="text/javascript">
    jQuery(document).ready(function($){
		 //ashok photo request
	  $('#send_request').click(function(){
		  var to_id =$('#to_request').val(); 
		  
			  $.ajax({
				  type:"POST",
				  url:"<?php echo base_url('userdashboard/send_photo_request');?>",
				  data:{to_id:to_id},
				  success:function(data){
					 
					 if($.trim(data) == "waiting for approve"){
						 $('#msgbox').html('<p class="alert alert-danger">You already sent a request,We will notify you once user accepted</p>');
						 
						  }
						  else{
							  
							  $('#msgbox').html('<p class="alert alert-success">Successfully sent a request,We will notify you once user accepted</p>'); 
						  }
				  
					  }
				  });
			  
		  });
		
    $(".accordion_example1").smk_Accordion();
    $(".accordion_example2").smk_Accordion({
        closeAble: true, //boolean
      });
	  
	  //code for shortlisting the profile
	  $('#modal-btn-confirm').click(function(){
		  var shorstlistId =$('#spfcode').val(); 
		  if(shorstlistId!=""){
			  $.ajax({
				  type:"POST",
				  url:"<?php echo base_url('userdashboard/saveShortlistProfile');?>",
				  data:{shorstlistId:shorstlistId},
				  success:function(data){
					 
					 if($.trim(data) == "success"){
						 $('#saveModal').hide();
						  location.reload();
						  }
				  
					  }
				  });
			  }
		  });
		  
		//function for view contact details  
	$('#modal-btn-yes').click(function(){
		var contactcode = $('#contactcode').val();
		if(contactcode!=""){
			 $.ajax({
				  type:"POST",
				  url:"<?php echo base_url('userdashboard/viewContactDetails');?>",
				  data:{contactcode:contactcode},
				  success:function(data){
					 var jsoncontactsData = JSON.parse(data);
					 if (jsoncontactsData !== ''){
						 
						 $('#contactdetails').show();
						 $('#emailId').text(jsoncontactsData.email);
						 $('#phoneNum').text(jsoncontactsData.mobile);
						 $('#modal-btn-ok').show();
						 $('#modal-btn-yes').hide();
						 }
					else{
						alert("contactdetils not found");
						}	 
				  
					  }
				  });
			}
		})
		//function for send intrest
		$('#modal-btn-send').click(function(){
			var partnetId = $('#intrstedid').val();
			var message = $('#intrestmessage').val();
			if(message == ""){
				$('#msgerr').show();
				}
			else{
				var re = /^[a-z,A-Z,? ]+$/i;
				 if (!re.test(message)) {
    				alert('Please enter only letters from a to z');
   					 return false;
  					}
				if(partnetId!=""){
					$.ajax({
						method:"POST",
						url:"<?php echo base_url('userdashboard/sendIntrest')?>",
						data:{partnetId:partnetId,message:message},
						success: function(data){
							if($.trim(data) == "success"){
								 $('#intrstModal').hide();
								  location.reload();
						    }
							}
						
						});
				
				}
					}
			
			
			});	  
		  
	  
    });
  </script>
</body>
 <?php } ?>
</html>
