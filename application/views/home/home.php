<?php $this->load->view('template/head'); ?> 
<style>
.fgeror{
	color:red;
}
</style>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/formvalidate.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css"> 
<script type="text/javascript">
   $(document).ready(function(){
           $('#dob').datepicker( {
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
      });
</script>
<style type="text/css">
    .ui-datepicker-trigger{
	position: absolute !important;
    top: 3px !important;
    right: 1em !important;
    padding: 7px 10px;
    border-radius: 0px 3px 3px 0px;}
	.ui-datepicker-month {
		color:#000;
	}
	.ui-datepicker-year{
		color:#000;
	}
	
</style>
<body>

    <?php $this->load->view('template/header'); ?> 
<!-- ============================  Navigation End ============================ -->
    <!-- <div id="tf-home" class="snow-container">
        <div class="snow foreground"></div>
        <div class="snow foreground layered"></div>
        <div class="snow middleground"></div>
        <div class="snow middleground layered"></div>
        <div class="snow background"></div>
        <div class="snow background layered"></div>
    </div> -->
   
        <div class="well" style="background-image:url(<?php echo base_url();?>assets/images/PM_HEADER.png);height:650px;background-repeat:round;margin-bottom:0px;margin-top: 80px;">
                                                                        <?php if($this->session->flashdata('del_sucess')){ ?>
                                                                        <div class="alert alert-success fade in">
                                                                            <a href="" class="close" data-dismiss="alert">&times;</a>
                                                                        <strong>Success!</strong> Your account deleted successfully.
                                                                    </div>
                                                                    <?php } ?>
                                                                    <br/><br/>
        <div class="container">                                                            
        <div class="main-right-reg col-md-6" style="padding-top:190px;color:#fff;"><h1><i>padmashali matrimony </i></h1><h6>Your journey to love supported by your community.</h6></div>
                <div class="main-left-reg col-md-6" style="border: 2px solid #e7796d;background-color: #ca6b5cc4; ">
                    <!--main-left-reg start-->
                    <h2>Register Free</h2>
                    <div class="clear"></div>
                    <div class="col-md-12">
                         <form name="register" id="register" method="post"  onsubmit="return validate();" action="<?php echo base_url('matrimony/add')?>">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                                <div class="col-md-4 col-sm-4 col-xs-6 no-padding">
                                    <label for="profile">Profile created by <span>*</span>    </label>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-8">
                                    <select name="profile"  id="profile" class="form-control input-sm">
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
                                    <font color="#FF0000"><?php echo form_error('profile');?></font>
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                                <div class="col-md-4 col-sm-4 col-xs-6 no-padding">
                                    <label for="reference">Reference by<span>*</span>    </label>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-6">
                                    <select name="reference" id="reference" class="form-control input-sm"> 
                                        <option value="">Select</option> 
                                        <option value="Advertisements">Advertisements</option>
                                        <option value="Friends">Friends</option>
                                        <option value="Sanghams">Sanghams</option>
                                        <option value="SearchEngine"> Search Engine</option>
                                        <option value="Others">Others</option>                                      
                                    </select>
                                    <font color="#FF0000"><?php echo form_error('reference');?></font>
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                                <div class="col-md-4 col-sm-4 col-xs-6 no-padding">
                                    <label for="name">SurName <span>*</span></label>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-6">
                                    <input type="text" name="surname" id="surname" class="form-control input-sm" placeholder="Ex:Padmashali">
                                      <font color="#FF0000"><?php echo form_error('surname');?></font>
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                                <div class="col-md-4 col-sm-4 col-xs-6 no-padding">
                                    <label for="firstname">First Name <span>*</span></label>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-6">
                                    <input type="text" name="firstname" id="firstname" class="form-control input-sm" placeholder="Ex:Laxmi">
                                    <font color="#FF0000"><?php echo form_error('firstname');?></font>
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                                <div class="col-md-4 col-sm-4 col-xs-6 no-padding">
                                    <label for="Last name">Last Name </label>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-6">
                                    <input type="text" name="lastname" id="lastname" class="form-control input-sm" placeholder="">
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                                <div class="col-md-4 col-sm-4 col-xs-6 no-padding">
                                    <label for="gender">Gender<span>*</span></label>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-6">
                                    <div class="col-md-12 sky-form">
                                    <ul class="list-inline">
                                    <li>
                                    <label class="radio">
                                    <input type="radio" value="Male" name="gender" /><i></i>Male
                                    </label></ll>
                                    <li>
                                    <label class="radio">
                                    <input type="radio" value="Female" name="gender"><i></i>Female
                                    </label></ll>
                                </ul>
                                    <font color="#FF0000"><?php echo form_error('gender');?></font>  
                                </div>                          
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                            <div class="col-md-4 col-sm-4 col-xs-6 no-padding">
                                <label for="maritalstatus">Marital Status</label>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12 no-padding1">
                            <div class="col-md-12 sky-form">
                                <label class="radio"><input type="radio" name="maritalstatus" value="NeverMarried"><i></i>Never Married</label>
                                <label class="radio"><input type="radio" name="maritalstatus" value="Widow"><i></i>Widow</label>
                                <label class="radio"><input type="radio" name="maritalstatus" value="Divorced"><i></i>Divorced</label>

                                </div>                                        
                            </div>
                            </div>    
                            
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 box no-padding  childern "style="display:none">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                            <div class="col-md-4 col-sm-4 col-xs-6 no-padding">
                                <label for="nofchild">No.of Children <span>*</span></label>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-6">
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
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding child">
                            <div class="col-md-4 col-sm-4 col-xs-6 no-padding">
                                <label for="LivingStatus">Children Living Status </label>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12 no-padding">
                                <div class="col-md-12 sky-form">
                                <label class="radio"><input type="radio" name="Living" value="ChildrenLiving"><i></i>Children Living </label>
                                <label class="radio">
                                <input type="radio" name="Living" value="ChildrenNotLiving"><i></i>Not Living with me</label>
                            </div>
                            </div>
                            </div>
                            </div>
                            
                            
                                    
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                                <div class="col-md-4 col-sm-4 col-xs-6 no-padding">
                                    <label for="name">Date of Birth <span>*</span></label>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-6 datepick">
                                   <input type="text" id="dob" name="dob" class="form-control input-sm" data-required="true" />
                                     <font color="#FF0000"><?php echo form_error('dob');?></font>
                                </div>
                            </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                                <div class="col-md-4 col-sm-4 col-xs-6 no-padding"><!--change made in colms-->
                                    <label for="mothertongue">Mother Tongue <span>*</span></label>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-6">
                                    <select name="mothertongue"  id="mothertongue" class="wdth197 form-control input-sm" tabindex="23">
                                        <option value="">Please Select Mothertongue</option>
                                        <?php if(isset($mothertongues)){
                                            foreach($mothertongues  as  $value){?>
                                        <option value="<?php echo $value->L_Id;?>"><?php echo $value->Language_Name;?></option>     
                                        <?php }}?>
                                    </select>
                                     <font color="#FF0000"><?php echo form_error('mothertongue');?></font>
                                </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                                <div class="col-md-4 col-sm-4 col-xs-6 no-padding"><!--change made in colms-->
                                    <label for="nationality">Nationality <span>*</span></label>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-6">
                                    <select name="nationality"  id="nationality" class="form-control input-sm">
                                     <option value="">Please select</option>
                                    <?php 
                                    if(isset($nationality)){
                                        foreach($nationality as $nationalities){?>
                                         <option value="<?php echo $nationalities->id;?>"><?php echo $nationalities->name;?></option>   
                                        <?php }
                                    }?>
                                </select>
                                    <font color="#FF0000"><?php echo form_error('nationality');?></font>
                                </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                                <div class="col-md-4 col-sm-4 col-xs-6 no-padding"><!--change made in colms and alignment side by side-->
                                    <label for="name">Mobile Number<span>*</span></label>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-6">
                                <div class="col-md-12 no-pad">
                                <div class="col-md-6 no-pad">
                                <select name="phcode"  id="phcode" class="form-control input-sm">
                                    <option value="">Please select</option>
                                    <?php  if(isset($nationality)){
                                        foreach($nationality as $nationalities){?>
                                         <option value="<?php echo $nationalities->id."_+".$nationalities->phonecode;?>"><?php echo $nationalities->name ."(+".$nationalities->phonecode.")";?></option>   
                                        <?php }
                                    }?>
                                </select>
                            </div>
                               <div class="col-md-6 no-pad">
                                    <input type="text" name="mobile" id="mobile"  onchange="checkmobile();" class="form-control input-sm" placeholder="Ex:9999999999"></div>
                                    <div class="clearfix"></div>
                                    <span id="mobile_error" style="display:none;color:red">Mobile Number already exists</span>
                                    <font color="#FF0000"><?php echo form_error('mobile');?></font>
                                </div>
                                </div>
                                </div>
                               
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                                <div class="col-md-4 col-sm-4 col-xs-6 no-padding">
                                    <label for="name">Email Id <span>*</span></label>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-6">
                                    <input type="email" name="email" id="email" onChange="checkemail();" class="form-control input-sm" placeholder="Ex:abcd@gmail.com">
                                    <span id="email_error" style="display:none;color:red">email already exists</span>
                                    <font color="#FF0000"><?php echo form_error('email');?></font>
                                </div>
                                </div>
                                
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding" style="margin-top:20px">
                                <div id = "mobileshow" style="display:none">
                                    <div class="col-md-4 col-sm-4 col-xs-6 no-padding">
                                    <input type="checkbox" name="mobileverification" id="mobileverification" value="1" tabindex="63">
                                    
                                    <label>Mobile Verification</label>
                                    </div>
                                     <div class="col-md-8 col-sm-8 col-xs-6">
                                    <input type="text" name="otp" id="otp" style="display:none" class="form-control input-sm" placeholder="otp">
                                    <span id="otp_error" style="display:none;color:red">Please enter valid otp</span>
                                    <font color="#FF0000"><?php echo form_error('otp');?></font>
                                    <input type="hidden" name="otphidden" id="otphidden" value="" style="" class="form-control input-sm" placeholder="otp">
                                </div>
                                    </div>
                                    <div class="clearfix"></div>
                                <div class="col-md-8"><!--change made in colms-->
                                    <div class="col-md-12 sky-form no-pad">
                                    <label class="checkbox"><input type="checkbox" name="terms" id="terms" value="1" tabindex="63"><i></i></label>
                                    <a href="3" style="color:#060;font-size:13px;" target="_new">I Accept The Terms &amp; Conditions</a>
                                    </div>
                                    </div>
                                <div class="col-md-4">
                                <button class="btn btn-md btn-danger pull-right" type="submit" name="submit" id="submit">Register Free</button>
                                </div>
                                </div>
                        </form>
                        </div>
                        <div class="clear"></div>
                                            
                        <br/>
                    </div>
               
                </div>
            
        
        </div>   
    <div class="clear"> </div>   
    <div class="well" style="background-color: #a70303;margin:0px"></div> 
        <div class="pm-main">
        <div class="profile_search">
            <div class="container wrap_1">
            <h2>Find your Perfect Match</h2>
            <div class="heart-divider">
                <span class="grey-line"></span>
                <i class="fa fa-heart pink-heart"></i>
                <i class="fa fa-heart grey-heart"></i>
                <span class="grey-line"></span>
            </div>
              <form method="post" action="<?php echo base_url('basicsearch');?>" name="searchdata" id="searchdata">
                <div class="search_top">
                <div class="col-md-12 no-padding">                
                <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12 pd-right">
                    <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12 pd-left rd-top">                        
                    <input type="radio" name="search-gender" id="search-gender-male" value="Male" checked>&nbsp; Male &nbsp;
                    <input type="radio" name="search-gender" id="search-gender-female" value="Female">&nbsp; Female
                    </div>

                    <div class="col-md-7 col-sm-11 col-xs-11 no-padding">                        
                        <div class="col-md-6 col-sm-6 col-xs-6 no-padding">                        
                            <label class="label-left">Age </label>
                            <select class="select-text label-left2 " name="age_from" id="age_from">
                                <option value="">--select--</option> 
                                <?php for($i=21;$i<=100;$i++)
                                {?>
                                 <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                 <?php }  ?>   
                                
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 pd-left">                        
                            <label class="label-left3">To </label>
                            <select class="select-text label-left2" name="age_to" id="age_to">
                                <option value="">--select--</option>
                                <?php for($i=21;$i<=100;$i++)
                                {?>
                                 <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                 <?php }  ?>   
                                
                            </select>
                        </div>
                    </div>
                </div>    
                <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12 no-padding tpd-left">
                    <div class="col-md-7 col-sm-11 col-xs-11 no-padding">                        
                        <div class="col-md-6 col-sm-6 col-xs-6 no-padding">                        
                            <label class="label-left">&nbsp;&nbsp; From </label>
                            <select class="select-text label-left2" name="height_from" id="height_from">
                            <option value="0">Choose Feet</option> 
                            <?php
                        if (isset($height) && (count($height) > 0)) {
                          foreach ($height as $h_res) {
                         ?>
                         <option value="<?php echo $h_res->feet_length; ?>"><?php echo $h_res->feet; ?></option>
                         <?php  } } ?>
                           
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 pd-left">                        
                            <label class="label-left3">To </label>
                            <select class="select-text label-left2" name="height_to" id="height_to">
                            <option value="0">Choose Feet</option> 
                            <?php
                        if (isset($height) && (count($height) > 0)) {
                          foreach ($height as $h_res) {
                         ?>
                         <option value="<?php echo $h_res->feet_length; ?>"><?php echo $h_res->feet; ?></option>
                         <?php  } } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-4 col-sm-12 col-xs-12">                        
                    <div class="submit">
                    <input type="submit" name="search" id="search" class="hvr-shutter-out-horizontal" value="Find Matches">
                    </div>
                    </div>
                    </form>
                </div>            
                </div>
                <div class="form-group col-md-12 srch-prflid1">
                    <ul>
                        <li><a class="dropbtn" onClick="myFunction()" >Search by ID </a>
                          <div id="myDropdown" class="dropdown-content">
                            <P>Enter the Matrimony ID of the member whose profile you would like to see.</P>
                            <div class="form-group col-md-12 no-padding">
                            <div class="col-md-6 no-padding">
                                <input type="email" class="form-control input-sm" placeholder="Enter Profile ID">
                            </div>
                            <div class="col-md-6">
                                <div class="submit">
                                <a href="#" class="hvr-shutter-out-horizontal">VIEW PROFILE</a>
                                </div>
                            </div>
                            </div>
                        </div>
                        </li>
                        <li><a>| </a></li>
                        <li><a href="#">More Search Options</a></li>
                    </ul>
                </div>
                
                </div>                                
            </div>
  </div>
  </div>

    <div class="grid_1 success-storys">
        <div class="container">
            <h1>Success Stories</h1>
            <div class="heart-divider">
                <span class="grey-line"></span>
                <i class="fa fa-heart pink-heart"></i>
                <i class="fa fa-heart grey-heart"></i>
                <span class="grey-line"></span>
            </div>
            <div class="row">
                <div class="col-md-4 padding-space">
                    <article class="mini-post nomargin">
                        <a href="#" class="featured-img"><img class="img-responsive" src="<?php echo base_url();?>assets/images/img1.jpg" alt="Featured Image"></a>
                        <div class="article-body">
                            <a href="wedding_pics_sumanthsonal.html" title="Future Web Development"><h3>Krishna   +  Radha</h3></a>
                            <center><a href="wedding_pics_sumanthsonal.html" class="btn danger ">Explore</a></center>
                        </div>
                    </article>
                </div>
                <div class="col-md-4 padding-space">
                    <article class="mini-post nomargin">
                        <a href="#" class="featured-img"><img class="img-responsive" src="<?php echo base_url();?>assets/images/img2.jpg" alt="Featured Image"></a>
                        <div class="article-body">
                            <a href="#" title="The Mean Stack Era"><h3>Ravi Kumar  +  Haritha</h3></a>
                            <center><a class="btn danger ">Explore</a></center>
                        </div>
                    </article>
                </div>
                <div class="col-md-4 padding-space">
                    <article class="mini-post nomargin">
                        <a href="#" class="featured-img"><img class="img-responsive" src="<?php echo base_url();?>assets/images/img3.jpg" alt="Featured Image"></a>
                        <div class="article-body">            
                            <a href="#" title="The Mean Stack Era"><h3>Karteek  +  Meenakshi</h3></a>
                            <center><a class="btn danger ">Explore</a></center>
                        </div>
                    </article>
                </div>                                                            
            </div>
        </div>
    </div>
    <div class="fatured-profiles">
        <div class="container">
            <h1>Featured Profiles</h1>
            <div class="heart-divider">
                <span class="grey-line"></span>
                <i class="fa fa-heart pink-heart"></i>
                <i class="fa fa-heart grey-heart"></i>
                <span class="grey-line"></span>
            </div>
            <div class="nbs-flexisel-container"><div class="nbs-flexisel-inner"><ul id="flexiselDemo3" class="nbs-flexisel-ul" style="left: -171px;">
                <li class="nbs-flexisel-item" style="width: 171px;"><div class="col_1"><a href="#">
                <img src="<?php echo base_url();?>assets/images/6.jpg" alt="" class="hover-animation image-zoom-in img-responsive">
                <div class="layer m_1 hidden-link hover-animation delay1 fade-in">
                    <div class="center-middle">About Her</div>
                </div>
                <h3><span class="m_3">Profile ID : MI-387412</span><br>28, Padhmashali, India<br>Corporate</h3></a></div>
                </li><li class="nbs-flexisel-item" style="width: 171px;"><div class="col_1"><a href="#">
                <img src="<?php echo base_url();?>assets/images/1.jpg" alt="" class="hover-animation image-zoom-in img-responsive">
                    <div class="layer m_1 hidden-link hover-animation delay1 fade-in">
                        <div class="center-middle">About Him</div>
                    </div>
                 <h3><span class="m_3">Profile ID : MI-387412</span><br>28, Padhmashali, India<br>Corporate</h3></a></div>
                </li>
                <li class="nbs-flexisel-item" style="width: 171px;"><div class="col_1"><a href="#">
                    <img src="<?php echo base_url();?>assets/images/2.jpg" alt="" class="hover-animation image-zoom-in img-responsive">
                    <div class="layer m_1 hidden-link hover-animation delay1 fade-in">
                        <div class="center-middle">About Her</div>
                    </div>
                 <h3><span class="m_3">Profile ID : MI-387412</span><br>28, Padhmashali, India<br>Corporate</h3></a></div>
                </li>
                <li class="nbs-flexisel-item" style="width: 171px;"><div class="col_1"><a href="#">
                    <img src="<?php echo base_url();?>assets/images/3.jpg" alt="" class="hover-animation image-zoom-in img-responsive">
                    <div class="layer m_1 hidden-link hover-animation delay1 fade-in">
                        <div class="center-middle">About Him</div>
                    </div>
                 <h3><span class="m_3">Profile ID : MI-387412</span><br>28, Padhmashali, India<br>Corporate</h3></a></div>
                </li>
                <li class="nbs-flexisel-item" style="width: 171px;"><div class="col_1"><a href="#">
                <img src="<?php echo base_url();?>assets/images/4.jpg" alt="" class="hover-animation image-zoom-in img-responsive">
                    <div class="layer m_1 hidden-link hover-animation delay1 fade-in">
                        <div class="center-middle">About Her</div>
                    </div>
                 <h3><span class="m_3">Profile ID : MI-387412</span><br>28, Padhmashali, India<br>Corporate</h3></a></div>
                </li>
                <li class="nbs-flexisel-item" style="width: 171px;"><div class="col_1"><a href="#">
                    <img src="<?php echo base_url();?>assets/images/5.jpg" alt="" class="hover-animation image-zoom-in img-responsive">
                    <div class="layer m_1 hidden-link hover-animation delay1 fade-in">
                        <div class="center-middle">About Him</div>
                    </div>
                    <h3><span class="m_3">Profile ID : MI-387412</span><br>28, Padhmashali, India<br>Corporate</h3></a></div>
                 </li>
                <li class="nbs-flexisel-item" style="width: 171px;"><div class="col_1"><a href="#">
                <img src="<?php echo base_url();?>assets/images/6.jpg" alt="" class="hover-animation image-zoom-in img-responsive">
                <div class="layer m_1 hidden-link hover-animation delay1 fade-in">
                    <div class="center-middle">About Her</div>
                </div>
                <h3><span class="m_3">Profile ID : MI-387412</span><br>28, Padhmashali, India<br>Corporate</h3></a></div>
                </li>
            <li class="nbs-flexisel-item" style="width: 171px;"><div class="col_1"><a href="#">
                <img src="<?php echo base_url();?>assets/images/1.jpg" alt="" class="hover-animation image-zoom-in img-responsive">
                    <div class="layer m_1 hidden-link hover-animation delay1 fade-in">
                        <div class="center-middle">About Him</div>
                    </div>
                 <h3><span class="m_3">Profile ID : MI-387412</span><br>28, Padhmashali, India<br>Corporate</h3></a></div>
                </li><li class="nbs-flexisel-item" style="width: 171px;"><div class="col_1"><a href="#">
                    <img src="<?php echo base_url();?>assets/images/2.jpg" alt="" class="hover-animation image-zoom-in img-responsive">
                    <div class="layer m_1 hidden-link hover-animation delay1 fade-in">
                        <div class="center-middle">About Her</div>
                    </div>
                 <h3><span class="m_3">Profile ID : MI-387412</span><br>28, Padhmashali, India<br>Corporate</h3></a></div>
                </li><li class="nbs-flexisel-item" style="width: 171px;"><div class="col_1"><a href="#">
                    <img src="<?php echo base_url();?>assets/images/3.jpg" alt="" class="hover-animation image-zoom-in img-responsive">
                    <div class="layer m_1 hidden-link hover-animation delay1 fade-in">
                        <div class="center-middle">About Him</div>
                    </div>
                 <h3><span class="m_3">Profile ID : MI-387412</span><br>28, Padhmashali, India<br>Corporate</h3></a></div>
                </li><li class="nbs-flexisel-item" style="width: 171px;"><div class="col_1"><a href="#">
                <img src="<?php echo base_url();?>assets/images/4.jpg" alt="" class="hover-animation image-zoom-in img-responsive">
                    <div class="layer m_1 hidden-link hover-animation delay1 fade-in">
                        <div class="center-middle">About Her</div>
                    </div>
                 <h3><span class="m_3">Profile ID : MI-387412</span><br>28, Padhmashali, India<br>Corporate</h3></a></div>
                </li><li class="nbs-flexisel-item" style="width: 171px;"><div class="col_1"><a href="#">
                    <img src="<?php echo base_url();?>assets/images/5.jpg" alt="" class="hover-animation image-zoom-in img-responsive">
                    <div class="layer m_1 hidden-link hover-animation delay1 fade-in">
                        <div class="center-middle">About Him</div>
                    </div>
                    <h3><span class="m_3">Profile ID : MI-387412</span><br>28, Padhmashali, India<br>Corporate</h3></a></div>
                 </li></ul></div></div>
        </div>
    </div>
    <div class="agileinfo_bottom_section">

        <div class="snow-container two">
            <div class="snow foreground"></div>
            <div class="snow foreground layered"></div>
            <div class="snow middleground"></div>
            <div class="snow middleground layered"></div>
            <div class="snow background"></div>
            <div class="snow background layered"></div>
        </div>
        <div class="home-page-banner-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-md-12 col-sm-12 col-xs-12 text-center">
                        <h1>We Make Your Dream Come Ture</h1>
                    </div>
                </div>
            </div>
        </div>
        
    </div>   
    <div class="clearfix"> </div>

    <?php $this->load->view('template/footer.php')?>
    
         <!-- Javascripts
    ================================================== -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <!-- slider Javascripts -->
    <script type="text/javascript">
         $(window).load(function() {
            $("#flexiselDemo3").flexisel({
                visibleItems: 6,
                animationSpeed: 1000,
                autoPlay:false,
                autoPlaySpeed: 3000,            
                pauseOnHover: true,
                enableResponsiveBreakpoints: true,
                responsiveBreakpoints: { 
                    portrait: { 
                        changePoint:480,
                        visibleItems: 1
                    }, 
                    landscape: { 
                        changePoint:640,
                        visibleItems: 2
                    },
                    tablet: { 
                        changePoint:768,
                        visibleItems: 3
                    }
                }
            });
            
        });
    </script>

    <!-- header Javascripts -->
    <script>
        var TxtType = function(el, toRotate, period) {
            this.toRotate = toRotate;
            this.el = el;
            this.loopNum = 0;
            this.period = parseInt(period, 10) || 2000;
            this.txt = '';
            this.tick();
            this.isDeleting = false;
        };
    </script>
    <!-- register  radio jQuery -->
  <script type="text/javascript">
        $(document).ready(function(){
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
            
        });
        </script>
    <!-- search profile dropdown jQuery -->
        <script>
        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }
        
        
        //check email for duplicate
        
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
                    alert("Email alredy exist")
                    $('#email').val('');
                  }
                }
            });
        }
        
        function checkmobile()
           {
                $('#mobileverification').prop('checked',false);
                $('#mobileverification').attr('disabled',false);
                var phcode = $('#phcode').val();
                var mobil = $('#mobile').val();
                var pcode =  phcode.split('+')[1];
                var mobile = "+"+pcode+"-"+mobil;
		
               
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
                    alert("Mobilenumber alredy exist");
                    $('#mobile').val('');
                  }
				  else{
					   if(mobile!=null && mobile!==""){
                    		$('#mobileshow').show();
							$('#submit').attr("disabled","disabled"); 
                		}
                	else{
                    
                   			$('#mobileshow').hide();
                		}
					  }
                }
            });
        }

        $(document).on('click','#mobileverification',function(e){
        if(this.checked==true){
            var mobile = $('#mobile').val();
            if(mobile != null && mobile != ""){
                $.ajax({
                    url:"<?php echo base_url('matrimony/otpGenaration')?>",
                    type:"POST",
                    data:{mobile:mobile},
                    success:function(data){
                       if($.trim(data) != "fail"){
                        $('#otp').show();
                        $('#otphidden').val(data)
                        $('#mobileverification').attr("disabled","disabled");
                    }
                    }
                });
            }
            else{
                alert("Please enter mobilenumber");
            }
        }
    });
       $(document).on('change','#otp',function(){
            var mobile = $('#mobile').val();
            var otp = $('#otp').val();
            var otphidden = $('#otphidden').val();
			if(otp !== ""){
              if($.trim(otp) === $.trim(otphidden) || otp.length === 0){
                  $('#otp_error').hide();  
                  $('#submit').attr("disabled",false);
              }
              else{
                  $('#otp_error').show();  
              }
			}
			else{
				alert("please enter otp");
				
				}
              
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
    
    $(document).on('change','#search-gender',function(){  
         var gender = $('input[name="search-gender"]:checked').val();
        
         if(gender=="Female"){ 
             var age = 18;
             $("#age_from_search").empty();
            
            for (i = age; i<=100; i++)
                  { 
                   $('#age_from_search').append($('<option>',
                  {
                  value: i,
                  text : i, 
                  }));}
                  
          $("#age_to_search").empty();
            
            for (i = age; i<=100; i++)
                  { 
                   $('#age_to_search').append($('<option>',
                  {
                  value: i,
                  text : i, 
                  }));}          
         }
         else{
              var age = 21;
             $("#age_from_search").empty();
            
            for (i = age; i<=100; i++)
                  { 
                   $('#age_from_search').append($('<option>',
                  {
                  value: i,
                  text : i, 
                  }));}
                  
          $("#age_to_search").empty();
            
            for (i = age; i<=100; i++)
                  { 
                   $('#age_to_search').append($('<option>',
                  {
                  value: i,
                  text : i, 
                  }));}          
         }
         
    
    });
	
                
</script>

    </body></html>
