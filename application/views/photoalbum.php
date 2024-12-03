<?php
$this->load->view('template/userdashboard/head');
$profile_code = (isset($this->session->userdata['user']['username']))?$this->session->userdata['user']['username']:'';
$gender=$this->session->userdata('gender');
$gender_pic = ($gender == 'Female') ? 'female.png' : 'male.png';
$dummy_profile_pic = base_url() . 'assets/images/' . $gender_pic;
?>
 <link href="<?php echo base_url();?>assets/albumfiles/dropzone.css" rel="stylesheet" type="text/css">
  
<body>
    <?php
    $this->load->view('template/userdashboard/header');
    /* print_r($this->session->all_userdata()); */
    //print_r($sidefilter_req->employee_in);
    ?>
    <div class="main-container no-mar">
	<?php // print_r($userinfo); ?>
        <div class=" card container" style="min-height:500px;padding">
		
           <div class="col-md-12" style="padding:2%;">   
				<div class="col-md-2" style=" border: 1px solid #c1c1c1;text-align:-webkit-center;padding: 6px;margin:3%">
						   <div class="col-md-12 text-center" style="padding: 0px;text-align: -webkit-center;">
								<?php  if($defaultimage['img_src'] ==""){ ?>
								<h3 style="color:#d4657a"><i class="fa  fa-5x fa-user-circle-o"></i></h3>
								<?php  }else{?>	
							<?php	$img = $defaultimage['img_src'];
					    ?>
                 <img src="<?php echo base_url('uploads/profilepics/').$profile_code.'/'.$img;?>" class="img-responsive" 
                alt="User profile photo here" style="height:150px;width: 80%;" /> 
                <?php }  ?>
                 
							  <br/>
							</div> 
						<a class="btn btn-success" title="Click to add images"href="<?php echo base_url('userdashboard/managephotos/personal'); ?>">General </a>
				  </div>
				  <div class="col-md-2" style=" border: 1px solid #c1c1c1;text-align:-webkit-center;padding: 6px;margin:3%">
				  
						   <div class="col-md-12 text-center" style="padding: 0px;text-align: -webkit-center;">
							  <h3 style="color:#d4657a"><i class="fa  fa-5x fa-camera"></i></h3>
							  <br/>
							</div> 
							<?php   if($this->session->userdata['user']['payment_status']==3 && $this->session->userdata['user']['package']==3){ ?>
						<a class="btn btn-success" href="<?php echo base_url('userdashboard/managephotos/selfy'); ?>">selfie </a>
				  <?php }else{ ?>
				  <a class="btn btn-success" href="<?php echo base_url('userdashboard/package_info'); ?>">Add selfie </a>
				  <?php } ?>
				  </div>
				  <div class="col-md-2" style=" border: 1px solid #c1c1c1;text-align:-webkit-center;padding: 6px;margin:3%">
						   <div class="col-md-12 text-center" style="padding: 0px;text-align: -webkit-center;">
							  <h3 style="color:#d4657a"><i class="fa  fa-5x fa-users"></i></h3>
							  <br/>
							</div> 
							<?php   if($this->session->userdata['user']['payment_status']==3 && $this->session->userdata['user']['package']==3){ ?>
						<a class="btn btn-success" href="<?php echo base_url('userdashboard/managephotos/family'); ?>">Add Family & Friends</a>
							<?php }else{ ?>
							<a class="btn btn-success" href="<?php echo base_url('userdashboard/package_info'); ?>">Add Family & Friends</a>
							<?php }?>
				  </div>
				  <div class="col-md-2" style=" border: 1px solid #c1c1c1;text-align:-webkit-center;padding: 6px;margin:3%">
						   <div class="col-md-12 text-center" style="padding: 0px;text-align: -webkit-center;">
							  <h3 style="color:#d4657a"><i class="fa  fa-5x fa-file-video-o"></i></h3>
							  <br/>
							</div> 
							<?php   if($this->session->userdata['user']['payment_status']==3 && $this->session->userdata['user']['package']==3){ ?>
						<button class="btn btn-success" id="upload_video">selfie Video</button>
							<?php }else{ ?>
							
							<a class="btn btn-success" href="<?php echo base_url('userdashboard/package_info'); ?>">selfie Video</a>
							<?php }?>
				  </div>
				  
			</div>
		   
		   
		</div>
		   <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 style="color:#0072BC;"><span class="glyphicon glyphicon-level-up"></span>   Video </h3>
                    </div>
                    <div class="modal-body" >
                        <form role="form" action="<?php echo base_url('userdashboard/uploadvideo');?>"method="post" enctype="multipart/form-data">
                            <div id="uploadimages">
                               
                                <div id="norimg" class="form-group" style="float:left; width:100%; border-bottom:1px solid #e5e5e5; padding-bottom:15px">
                                    <label class="control-label col-md-2 col-sm-12" style="margin-top:15px; float:left;">Video</label>
                                    <div class="input-group col-md-6 col-sm-12" style="float:left;">
                                        
                                        <input type="file" name="file" class="form-control" title="upload video" style="padding:10px; float:left; " accept="video/*"  />
                                    </div>
									<div class="col-md-4 col-sm-4" style="float:left;">
                                   							<button type="submit" class="btn btn-success text-center"><i class="fa fa-upload"></i>  Upload</button>
                                </div> </div>
								
                            </div>

                        </form>
						<div class="clearfix"></div>
						<div class="alert alert-warning">You can upload maximum of 250mb size video</div>
						<br/><br/><br/>
                    </div>
                    
                </div>

            </div>
        </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
		
<?php $this->load->view('template/userdashboard/footer') ?>
<script>
$("#upload_video").click(function(){
	
	
	 $("#myModal").modal();
	
	
});

</script>

</body>
</html>
