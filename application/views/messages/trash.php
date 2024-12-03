<?php
$this->load->view('template/userdashboard/head');
$gender=$this->session->userdata['user']['gender'];
$gender_pic = ($gender == 'Female') ? 'female.png' : 'male.png';
$dummy_profile_pic = base_url() . 'assets/images/' . $gender_pic;
$gender_pic1 = ($gender == 'Female') ? 'male.png' : 'female.png';
$dummy_profile_pic1 = base_url() . 'assets/images/' . $gender_pic1;

?>
 
  
<body>
    <?php
    $this->load->view('template/userdashboard/header');
    /* print_r($this->session->all_userdata()); */
    //print_r($sidefilter_req->employee_in);
    ?>
    <div class="main-container no-mar">
	 <div class="container">
	<div class="mail-box">
     <?php
              $profile_image = '';
            if (isset($this->session->userdata['user']['thumbimage'])) {
                $img =$this->session->userdata['user']['thumbimage'];
                if (strpos($img, '/') !== false) {
                    $profile_image = base_url() . $img;
                } else {
                    $profile_image = base_url() . '/uploads/profilepics/thumb/' . $img;
                }
            } else {
                $profile_image = $dummy_profile_pic;
            }
              ?>
                  <aside class="sm-side">
                      <div class="user-head">
                          <a class="inbox-avatar" href="javascript:;">
                              <img  width="64" hieght="60" src="<?php echo $profile_image; ?>">
                          </a>
                          <div class="user-name">
                              <h5><a href="#"><?php if(isset($this->session->userdata['user']['name'])){ $name = $this->session->userdata['user']['name'];  echo strtoupper($name);}?></a></h5>
                             
                          </div>
                          
                      </div>
                     
                      <ul class="inbox-nav inbox-divider">
                          <li>
                              <a href="<?php echo base_url('userdashboard/inbox');?>"><i class="fa fa-inbox"></i> Inbox <span class="label label-danger pull-right" id="newcounter"></span></a>
                             </li>
							 <li>
                              <ul class="nav nav-pills nav-stacked labels-danger inbox-divider">
                               <li> <a href="<?php echo base_url('userdashboard/inbox_pending');?>">Pending<span class="label label-info pull-right" id="pendingcounter"></span> </a> </li>
                                <li> <a href="<?php echo base_url('userdashboard/inbox_accepted');?>">Accepted<span class="label label-success pull-right" id="acceptcounter"></span> </a> </li>
                                <li > <a href="<?php echo base_url('userdashboard/inbox_declined');?>">Decline<span class="label label-danger pull-right" id="declinedcounter"></span> </a> </li>
                              </ul>

                          </li>
                          <li>
                               <a href="<?php echo base_url('userdashboard/sent_message');?>"><i class="fa fa-envelope-o"></i> Sent Mail<span class="label label-info pull-right" id="sentcounter"></span></a>
                          </li>
                          
                          <li class="active">
                              <a href="<?php echo base_url('userdashboard/trash');?>"><i class=" fa fa-trash-o"></i> Trash<span class="label label-info pull-right" id="trashcounter"></span></a>
                          </li>
                      </ul>
                      
                      
                  </aside>
                  <aside class="lg-side">
                      <div class="inbox-head">
                          <h3>Inbox</h3>
                         
                      </div>
                      <div class="clearfix"></div>
					  <?php if($messages->num_rows()>0){ ?>
										<!--with data--->
					  <div class="inbox-body">
                         
                      <div class="clearfix"></div>

                <ul class="list-group">
                   <?php // print_r($messages);?>
                    <?php foreach($messages->result_array() as $row){ ?>
                    <li class="list-group-item no-brd1  box<?php echo $row['profile_code']; ?>" >
                        <div class="row">
                          
                            <div class="col-md-2">
                               <?php  if($row['image'] ==""){ ?>
								 <img src="<?php echo $dummy_profile_pic1;?>" class="img-responsive" 
                alt="User profile photo here"  />
								<?php  }else{	$img = $row['image'];
					    if (strpos($img, '/') !== false){?>
                 <img src="<?php echo base_url().$img;?>" class="img-responsive" 
                alt="User profile photo here"/> 
                <?php } else{ ?>
                  <img src="<?php echo base_url().'uploads/profilepics/thumb/'.$img;?>" class="img-responsive" alt="User profile photo here" /> 
								<?php  } } ?>
</div>				
                            <div class="col-md-9">
                                <div>
                                    <a title="Click to view profile" href="<?php echo base_url('partnerdetails/').$row['profile_code']; ?>"><?php echo ucfirst($row['fname']).$row['lname']; ?> (<?php echo $row['profile_code']; ?>)</a>
									<div class="mic-info">
                                       <b> Date:</b> <?php echo $row['Date']; ?>
                                    
									</div>
                                </div>
								
                                <div class="comment-text" id="msg<?php echo $row['profile_code']; ?>" style="overflow-y:auto;max-height:60px;">
                                  <?php echo $row['Message']; ?>
                                </div>
                               
      <button  disabled value="<?php echo $row['profile_code']; ?>" class="btn btn-xs btn-hover btn-default decline"><i class="fa fa-2x fa-thumbs-down" aria-hidden="true"></i> Message deleted</button>
      
                              
                            </div>
                        </div>
                    </li>
					
					<hr>
					<?php } ?>
                </ul>

                      </div>
					  
					  
					  <?php }else{ ?>
					  <div class="col-md-12">
							  <div class="col-md-8 text-center">
							  <img src="<?php echo base_url('assets/images/no_message.png')?>"  />
							  <h4 class="text-center">No deleted Messages. </h4>
							  
							  </div>
							 <div class="clearfix"></div>  
                      </div>
					  <?php } ?>
                      <div class="clearfix"></div>
                     
                  </aside>
              </div>
</div>
  </div><!--inbox search end-->
  <div class="clearfix"></div>
</div>
<div class="clearfix"></div>

<div id="myModal" class="modal hide fade">
    <div class="modal-header">
            <button class="close" data-dismiss="modal">×</button>
            <h3>Join the Beta</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
            <div class="span12">
                <div class="span6">
                <div class="logowrapper">
                    <img class="logoicon" src="http://placehold.it/300x300/bbb/&text=Your%20Logo" alt="App Logo"/>
                </div>
                </div>
                <div class="span6">
                    <form class="form-horizontal">
                        <p class="help-block">Name</p>
                        <div class="input-prepend">
                            <span class="add-on">*</span><input class="prependedInput" size="16" type="text">
                        </div>
                        <p class="help-block">Email</p>
                        <div class="input-prepend">
                            <span class="add-on">@</span><input class="prependedInput" size="16" type="email">
                        </div>
                          <hr>
                        <div class="help-block">
                            <button type="submit" class="btn btn-large btn-info">Request an Invite</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <p><i>Lastest Update on October 2nd, 2012</i></p>
    </div>
</div>
	
	</div>
	<?php $this->load->view('template/userdashboard/footer');?>
<script>
$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('userdashboard/getmsgscount')?>',
        dataType: "json",
        async:false,
        success: function(data) {
          $('#newcounter').text(data.newmsgscount+"/ New*("+data.pendingcount+")");
		  $('#pendingcounter').text(data.pendingcount);
		  $('#acceptcounter').text(data.acceptcount);
		  $('#declinedcounter').text(data.declinedcount);
		  $('#sentcounter').text(data.sentcount);
		  $('#trashcounter').text(data.trashcount);
        }

    });
});



</script>