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
	<div class="mail-box">
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
                          <li >
                              <a href="<?php echo base_url('userdashboard/inbox');?>"><i class="fa fa-inbox"></i> Inbox <span class="label label-danger pull-right" id="newcounter"></span></a>
                             </li>
							 <li>
                              <ul class="nav nav-pills nav-stacked labels-danger inbox-divider">
                               <li class="active"> <a href="<?php echo base_url('userdashboard/inbox_pending');?>">Pending<span class="label label-info pull-right" id="pendingcounter"></span> </a> </li>
                                <li> <a href="<?php echo base_url('userdashboard/inbox_accepted');?>">Accepted<span class="label label-success pull-right" id="acceptcounter"></span> </a> </li>
                                <li> <a href="<?php echo base_url('userdashboard/inbox_declined');?>">Decline<span class="label label-danger pull-right" id="declinedcounter"></span> </a> </li>
                              </ul>

                          </li>
                          <li>
                              <a href="<?php echo base_url('userdashboard/sent_message');?>"><i class="fa fa-envelope-o"></i> Sent Mail<span class="label label-info pull-right" id="sentcounter"></span></a>
                          </li>
                          
                          <li>
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
                         <div class="mail-option">
                          <div class="sky-form">
                             <ul class="list-inline">
                               <li>
                                 <button class="btn btn-xs btn-default">
                                   <label class="checkbox"><input type="checkbox" id="checkall" name=""><i></i>All</label>
                                 </button>
                               </li>
                               <li>
                                 <button type="button" id="delete_checked" class="btn btn-sm btn-default">
                                   <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete
                                 </button>
                               </li>
                             </ul>
                           </div>
                      </div>
                      <div class="clearfix"></div>

                <ul class="list-group">
                   <?php // print_r($messages);?>
                    <?php foreach($messages->result_array() as $row){ ?>
                    <li class="list-group-item no-brd1  box<?php echo $row['profile_code']; ?>" <?php if($row['MessageReadStatus']==0){ ?>  style="background:#e5e8efc2;" <?php } ?>>
                        <div class="row">
                          <div class="col-md-1">
                            <div class="sky-form">
                              <label class="checkbox"><input type="checkbox" name="profile_codes[]" class="profilecheckbox" value="<?php echo $row['MessageId']; ?>"><i></i></label>
                            </div>
                          </div>
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
                                    <button class="btn btn-xs btn-warning pull-right read_messge" value="<?php echo $row['profile_code']; ?>"><i class="fa  fa-envelope-o"></i> Read Message </button>
									<div class="mic-info">
                                       <b> Date:</b> <?php echo $row['Date']; ?>
                                    
									</div>
                                </div>
								
                                <div class="comment-text" id="msg<?php echo $row['profile_code']; ?>" style="overflow-y:auto;max-height:60px;display:none;">
                                  <?php echo $row['Message']; ?>
                                </div>
                                <h5> <b>Are you interested in this profile?</b>

</h5>
<input type ="hidden" id="gender" value="<?php echo $gender?>">
<input type ="hidden" id="msgid" value="<?php echo $row['MessageId']?>">
                               <button   value="<?php echo $row['profile_code']; ?>" class="btn btn-sm btn-hover btn-success btn-xs send_intesrest"  ><i class="fa fa-2x fa-thumbs-up" aria-hidden="true"></i> Yes</button>&nbsp;&nbsp;
      <button  value="<?php echo $row['profile_code']; ?>" class="btn btn-xs btn-hover btn-default decline"><i class="fa fa-2x fa-thumbs-down" aria-hidden="true"></i> Not Interested</button>
      
                              
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
							  <h4 class="text-center">No Pending Invitations. </h4>
							  <h5 class="text-center">Dont worry <a href=""> View Recent Matches</a></h5>
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


$(".read_messge").click(function(){
	var profilecode=$(this).val();
	var msgid = $('#msgid').val();
	if(msgid!=""){
    $.ajax({
        type:"POST",
        url:"<?php echo base_url('userdashboard/updatemsgstatus')?>",
        data:{msgid:msgid},
        dataType:"json", 
        success:function(data){
            $("#msg"+profilecode).toggle();
            
        }
    });
}
});
$(".send_intesrest").click(function(){
	var profilecode=$(this).val();
	var msgid = $('#msgid').val();
	if(msgid!=""){
    $.ajax({
        type:"POST",
        url:"<?php echo base_url('userdashboard/update_interest')?>",
        data:{msgid:msgid,interest:1},
        dataType:"json", 
        success:function(data){
            $(".box"+profilecode).hide();
			location.reload();
        }
    });
}
});
$(".decline").click(function(){
	var profilecode=$(this).val();
	var msgid = $('#msgid').val();
	if(msgid!=""){
    $.ajax({
        type:"POST",
        url:"<?php echo base_url('userdashboard/update_interest')?>",
        data:{msgid:msgid,interest:2},
        dataType:"json", 
        success:function(data){
            $(".box"+profilecode).hide();
			location.reload();
            
        }
    });
}         
	
});

$("#checkall").click(function(){  //"select all" change
    var status = this.checked; // "select all" checked status
    $('.profilecheckbox').each(function(){ //iterate all listed checkbox items
        this.checked = status; //change ".checkbox" checked status
    });
});

$('#delete_checked').click(function(){
		var ans=confirm("Are ou sure want to delete seleted messages??");
		if(ans){
			var checkedboxes = $('input:checkbox[name="profile_codes[]"]:checked').length;
			if(checkedboxes == 0){
				 alert('Please select atlest one message to delete');
			 }	
		else{
			var msgids=Array();
		        msgids = $('input:checkbox[name="profile_codes[]"]:checked').map(function() {
                   return $(this).val();
                }).get();
				
			$.ajax({
			 type:"POST",
			 url:"<?php echo base_url('userdashboard/deleteMessage');?>",
			 data:{msgids:msgids},
			 success: function(data){
				 var status = $.trim(data);
				 if(status == 'success') {  
                   alert("data moved to trash  successfully");
				   location.reload();
                  }
				  else{
					  alert("messages  not deleted");
					  location.reload();
					  }
				 
				 },
			 });	
			}
		
		}
		
		
		
      });
</script>