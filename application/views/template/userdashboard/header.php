<!-- code added by laxmi(18-11-2017) started here  --->
 <?php if(isset($this->session->userdata['user']['username'])){
     $pfcode = $this->session->userdata['user']['username']; }
	 $gender=(isset($this->session->userdata['user']['gender']))?$this->session->userdata['user']['gender']:''; 
	 $gender_pic = ($gender == 'Female') ? 'female.jpg' : 'male.png';
	 $dummy_profile_pic = base_url() . 'assets/images/' . $gender_pic;
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
<!-- code added by laxmi(18-11-2017) ended here  --->      
<div id="navbar">
  <nav class="navbar navbar-default navbar-static-top main-menu" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <div class="container">
        <div class="col-md-12">
        <div class="col-md-2 pull-left logoCls">
          <a href="<?php echo base_url("userdashboard");?>"><img src="<?php echo base_url();?>assets/userdashboard/images/logo.png" class="logoUser" alt="Padmashali Matrimony Logo" /> </a>
        </div>
        <div class="account-menu col-md-2 pull-right col-md-pull-1">
         <ul class="nav navbar-nav pull-right account-menu">
         <?php if($this->session->userdata['user']['thumbimage']!==""){if($this->session->userdata['user']['Profile_photo_Status']==1){
           $img = $this->session->userdata['user']['thumbimage'];?>
            <li class="dropdown"> <a href="#" class="dropdown-toggle user-name no-pad" data-toggle="dropdown"><img src="<?php echo base_url().'uploads/profilepics/'.$pfcode.'/'.$img;?>" alt="" />  <i class="fa fa-angle-down pull-right" aria-hidden="true"></i></a>
            <?php }else{ ?>
               <li class="dropdown"> <a href="#" class="dropdown-toggle user-name no-pad" data-toggle="dropdown"><img src="<?php echo $dummy_profile_pic;?>" alt="" />  <i class="fa fa-angle-down pull-right" aria-hidden="true"></i></a>
            <?php }} else{ ?>
                  <li class="dropdown"> <a href="#" class="dropdown-toggle user-name no-pad" data-toggle="dropdown"><img src="<?php echo $dummy_profile_pic;?>" alt="" />  <i class="fa fa-angle-down pull-right" aria-hidden="true"></i></a>
           <?php }?>
              <ul class="dropdown-menu">
                <li>
                  <div class="col-md-12 myprofile">
                    <h4><a href=""><?php if(isset($this->session->userdata['user']['name'])){ $name = $this->session->userdata['user']['name'];  echo strtoupper($name);}?></a>&nbsp;<small>(Pro.Id&nbsp;:&nbsp;<?php echo $pfcode;?>)</small></h4>
                    <h5>Account Created by&nbsp;:&nbsp;<?php if(isset($this->session->userdata['user']['profile_by'])){ echo $this->session->userdata['user']['profile_by']; ;}?>, Account Type&nbsp;:&nbsp;<?php echo $paidstaus;?></h5>
                    <div class="divider"></div>
                      <ul class="list-inline">
                        <li class="col-md-2 no-pad no-brd1"><div class="c100 p12 small">
                    <span>12%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div></li>
                <li class="col-md-10 no-pad no-brd1" style="margin-top:10px;"><h5>Profile Completeness | <a href="#"> Complete Your Profile</a></h5></li>
                      </ul>
                      <div class="clearfix"></div>
                    <div class="divider"></div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 myprofile-list">
                      <ul class="list-inline">
                        <li class="col-md-6 no-pad">
                          <a href="<?php echo base_url('userdashboard/viewProfile');?>"><i class="fa fa-street-view" aria-hidden="true"></i> View my profile</a>
                          <div class="clearfix"></div>
                          <a href="<?php echo base_url('userdashboard/viewProfile');?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit my profile</a>
                          <div class="clearfix"></div>
                          <a href="<?php echo base_url('userdashboard/myalbum'); ?>"><i class="fa fa-camera-retro" aria-hidden="true"></i> Upload photos</a>
                        </li>
                        <li class="col-md-6">
                          <a href="<?php echo base_url('userdashboard/changepassword');?>"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Change Password</a>
                          <div class="clearfix"></div>
                          <a href="<?php echo base_url('userdashboard/deleleteAccount');?>"><i class="fa fa-trash" aria-hidden="true"></i>Delete Account</a>
                          <div class="clearfix"></div>
                          <a href="<?php echo base_url('matrimony/logout');?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out </a>
                        </li>
                      </ul>
                    <div class="clearfix"></div>
                  </div>
                   
              <div class="clearfix"></div>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="col-md-8 pull-right userMenu">
        <ul class="nav navbar-nav">
        <!-- input filed added by laxmi(18-11-2017) started here  --->
        <input type="hidden" name="pfcode" id="pfcode" value="<?php echo $pfcode; ?>">
        <!-- input filed added by laxmi(18-11-2017) ended here  --->
        
            <li class="dropdown" id="home-menu"> <a href="<?php echo base_url('userdashboard');?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-home" aria-hidden="true"></i> My Home <b class="caret"></b></a>
                <ul class="dropdown-menu main">
                <li><a href="<?php echo base_url('userdashboard');?>"><i class="fa fa-home" aria-hidden="true"></i> Dashboard<span id="dashboard"></span></a></li>
                  <li><a href="<?php echo base_url('userdashboard/viewdMyProfile');?>"><i class="fa fa-users" aria-hidden="true"></i> Who viewed my profile<span id="viewed_myprofile"></span></a></li>
                  <li><a href="<?php echo base_url('userdashboard/shortlistedMe');?>"><i class="fa fa-users" aria-hidden="true"></i> Who shortlisted Me<span id="shortlisted_me"></span></a></li>
                  <li><a href="<?php echo base_url('userdashboard/viewedMYNumber'); ?>"><i class="fa fa-users" aria-hidden="true"></i> Who viewed my mobile No<span id="viewd_mynumber"></span></a></li>
                </ul>
          </li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search" aria-hidden="true"></i> Search <b class="caret"></b></a>
            <ul class="dropdown-menu main">
              <li><a href="<?php echo base_url();?>search"><i class="fa fa-search-plus" aria-hidden="true"></i> Advance Search</a></li>
            </ul>
          </li>
            <li class="dropdown" id="matches-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa  fa-meetup" aria-hidden="true"></i> Matches <b class="caret"></b></a>
                <ul class="dropdown-menu main">
<li><a href="<?php echo base_url('userdashboard/viewdProfiles');?>"><i class="fa fa-users" aria-hidden="true"></i> Viewed Profiles
                  <span id="viewed_profile"></span></a></li>
                  <li><a href="<?php echo base_url('userdashboard/shortlistedProfiles');?>"><i class="fa fa-users" aria-hidden="true"></i> Shortlisted Profiles
                  <span id="shortlisted_profiles"></span></a></li>
                  <li><a href="<?php echo base_url('userdashboard/numbersViewed');?>"><i class="fa fa-users" aria-hidden="true"></i> Mobiles No.s viewed by Me
                  <span id="numbers_viewed"></span></a></li>
                </ul>
          </li>
          <li class="dropdown" id="inbox"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-comments-o" aria-hidden="true"></i> Messages <b class="caret"></b></a>
           <ul class="dropdown-menu main">
             <li><a href="<?php echo base_url('userdashboard/inbox');?>"><i class="fa fa-envelope" aria-hidden="true"></i> Inbox</a></li>
             <li><a href="<?php echo base_url('userdashboard/inbox');?>"><i class="fa fa-comments" aria-hidden="true"></i> Pending<span id="newmessages"></span></a></li>
             <li><a href="<?php echo base_url('userdashboard/inbox');?>"><i class="fa fa-cloud" aria-hidden="true"></i> Accepted</a></li>
             <li><a href="<?php echo base_url('userdashboard/inbox');?>"><i class="fa fa-commenting-o" aria-hidden="true"></i> Sent</a></li>
           </ul>
         </li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-diamond" aria-hidden="true"></i> Upgrade <b class="caret"></b></a>
            <ul class="dropdown-menu main">
              <li><a href="<?php echo base_url('userdashboard/package_info');?>"><i class="fa fa-search-plus" aria-hidden="true"></i>  Membership Details</a></li>
            </ul>
          </li>
		 <li  id="notfyget"><i class="fa fa-2x fa-bell" style="margin-top:18px; font-size:1.5em !important" aria-hidden="true"></i> <span class="notifybox"><b id="notibox"></b></span></a>
            <ul class="dropdown-menu main notifybox">
              <li style="color:#000 !important;">
			  <table class="table table-striped" id="notitab">
			  <tr>
			  <i class="fa fa-user-circle"></i> You got a photo Request from request_id</br/>
			  <button class="btn btn-sm btn-success">Accept</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger">Decline</button>
			  
			  </tr>
			  </table>
			  
			  
			  
			  </li>
            </ul>
          </li>
          </ul>
        </div>
        </div>
      </div>
    </div>
    <!-- /.navbar-collapse --> 
  </nav>
</div>
<div class="clearfix"></div>
<div class="gap"></div>
<div class="clearfix"></div>

<!-- script added by laxmi(18-11-2017) started here  --->
<script>
$("#home-menu").hover(function(){
var profilecode = $('#pfcode').val();
if(profilecode!=""){
    $.ajax({
        type:"POST",
        url:"<?php echo base_url('userdashboard/homeMenuCount')?>",
        data:{profilecode:profilecode},
        dataType:"json", 
        success:function(data){
            $('#viewed_myprofile').text('('+data.viewed_myprofile+')');
            $('#shortlisted_me').text('('+data.shortlisted_me+')');
            $('#viewd_mynumber').text('('+data.viewd_mynumber+')');
           
            
        }
    });
}         

       
 });
 
 $("#matches-menu").hover(function(){
var profilecode = $('#pfcode').val();
if(profilecode!=""){
    $.ajax({
        type:"POST",
        url:"<?php echo base_url('userdashboard/homeMenuCount')?>",
        data:{profilecode:profilecode},
        dataType:"json", 
        success:function(data){
            $('#viewed_profile').text('('+data.viewedprofies+')');
            $('#shortlisted_profiles').text('('+data.shortlisted+')');
            $('#numbers_viewed').text('('+data.numbersviewed+')');
           
            
        }
    });
}         

       
 });
 
 
 $("#inbox").hover(function(){

   $.ajax({
       type:"POST",
       url:"<?php echo base_url('userdashboard/newmessages')?>",
       dataType:"json", 
       success:function(data){
           $('#newmessages').text('('+data+')');
      
       }
   });
      
      
});
 
  $("#notfyget").hover(function(){

   $.ajax({
        type:"POST",
        url:"<?php echo base_url('userdashboard/getnotifylist')?>",
        success:function(data){
			if(data==0){
				
				$('.notifybox').hide();
			}else{
			
			$.each(jsonStatesData, function (key, value){
            $('#notitab').append('<tr><i class="fa fa-user-circle"></i> You got a photo Request from'+value+'</br/><button class="btn btn-sm btn-success acceptnoti" value="'+value+'">Accept</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger">Decline</button></tr>');
                i++;
                }); 
			}
        }   
   });   
      
});

$(".acceptnoti").click(function(){
	var id=$(this).val();
   $.ajax({
        type:"POST",
		value:{id:id},
        url:"<?php echo base_url('userdashboard/accept_request')?>",
        success:function(data){
			alert("Suceessfully changed");
        }   
   });   
      
});















 function get_notify_count()
   {
		$.ajax({
        type:"POST",
        url:"<?php echo base_url('userdashboard/getnotifycount')?>",
        success:function(data){
			if(data==0){
				
				$('.notifybox').hide();
			}else{
			
            $('#notibox').text(data);
			}
        }   
   });
   }




$(document ).ready(function() {
   
   get_notify_count();
});
 
 
</script>
<!-- script added by laxmi (18-11-2017) started here ---> 