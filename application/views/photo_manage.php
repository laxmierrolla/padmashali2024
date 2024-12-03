<?php
$this->load->view('template/userdashboard/head');
$gender=$this->session->userdata('gender');
$gender_pic = ($gender == 'Female') ? 'female.png' : 'male.png';
$dummy_profile_pic = base_url() . 'assets/images/' . $gender_pic;
?>
 <style>
 #img {
  max-width: 100%; /* This rule is very important, please do not ignore this! */
}
</style>
  
<body>
    <?php
    $this->load->view('template/userdashboard/header');
  
    ?>
    <div class="main-container no-mar">
	<?php // print_r($image_info); ?>
        <div class=" card container" style="min-height:500px;padding">
		<div class="col-md-12">
		<br/>
		<?php if(isset($image_info) && ($image_info->num_rows()>0)){ ?>
		<div class="col-md-12">
		
		
		
		<?php foreach($image_info->result_array() as $iamge_info){  ?>
				<div class="col-md-2" style=" border: 1px solid #c1c1c1;text-align:-webkit-center;padding: 6px;margin:1%">
						   <div class="col-md-12 text-center" style="padding: 0px;text-align: -webkit-center;">
                  <img src="<?php echo base_url().'uploads/profilepics/'.$iamge_info['profile_id'].'/'.$iamge_info['img_src'];?>" class="img-responsive" alt="User profile photo here" style="height:150px;width: 80%;"  /> 
													
							  <br/>
							</div> 
							<?php  if(($iamge_info['is_default_img']==0) && $iamge_info['is_approved']==1){ ?>
						<a class="btn btn-success set_default" title="Click to set as default images"  href="<?php echo base_url('userdashboard/crop_box').'/'.$iamge_info['image_id'] ; ?>"><i class="fa fa-user-circle"></i>  </a>	
							<?php } ?>
						<button class="btn btn-danger remove_img" title="Click to delete images"  value="<?php echo $iamge_info['image_id']; ?>"><i class="fa fa-trash"></i>  </button>
				  </div>
		<?php } ?>
		
		
		 
		
		
		<?php }?>	
       <?php if(isset($image_info) && ($image_info->num_rows()<5)){?>
				<div class="col-md-2" style=" border: 1px solid #c1c1c1;text-align:-webkit-center;padding: 6px;margin:1%">
						   <div class="col-md-12 text-center" style="padding: 0px;text-align: -webkit-center;">
								
								
							  <img src="<?php echo $dummy_profile_pic;?>" class="img-responsive" style="height:150px;width:150px;" alt="User profile photo here"> 
								
							  <br/>
							</div> 
						
						<button class="btn btn-success" title="Click to add images" id="myBtn"><i class="fa fa-user-circle"></i> Add  Photos </button>
				  </div>
		<?php } ?>
		</div>
		<div class="col-md-12" >
		<div >
		<?php if($image_info->num_rows()>0){ 	?>
		<button <?php  if($protect==1){?> style="display: none !important;"<?php  } ?> class="pull-right btn btn-warning change_photo_status"  id="protect"  value="<?php echo $protect; ?>"  title="Click to protect Your photos"><i class="fa fa-image"></i> Protect Photos</button>
		
		
		<button class="pull-right btn btn-danger change_photo_status" id="unprotect" value="<?php echo $protect; ?>" <?php  if($protect==0){?> style="display:none !important;"<?php  } ?>  title="Click to Un protect Your photos"><i class="fa fa-image"></i> Un Protect Photos</button>
		</div><br/><br/><br/>
		<?php } ?>
		</div>
		</div><div style="clear:both;"></div>
		<div class="panel panel-primary">
      <div class="panel-heading"><i class="	fa fa-2x fa-clipboard"></i> Note</div>
      <div class="panel-body">
	  
	  --You can upload maximum of 5 images
	  <br/>
	  --You can protect your photo by click on protect photo button on top right corner<br/>
	  
	  </div>
    </div>
		
         			
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 style="color:#0072BC;"><span class="glyphicon glyphicon-level-up"></span>  Image Upload </h3>
                    </div>
                    <div class="modal-body" >
                        <form role="form"  id="img_box" enctype="multipart/form-data">
                            
                               
                                <div id="norimg" class="form-group" style="float:left; width:100%; border-bottom:1px solid #e5e5e5; padding-bottom:15px">
                                    <label class="control-label col-md-2 col-sm-12" style="margin-top:15px; float:left;">Photo</label>
                                    <div class="input-group col-md-6 col-sm-12" style="float:left;">
                                        
                                        <input type="file" name="file" class="form-control" style="padding:10px; float:left; " accept="image/*"  />
										<input type="hidden" name="image_type" value="<?php  echo $image_type; ?>">
                                    </div>
									<div class="col-md-4 col-sm-4" style="float:left;">
                                   	<button type="button" id="upload_img" class="btn btn-success text-center"><i class="fa fa-upload"></i>  Upload</button>
                                </div> </div>
                           

                        </form>
						<br/><br/><br/>
                    </div>   
                </div>				
        </div>
</div>
		</div></div>
		<!--image crop mode-->

		
<?php $this->load->view('template/userdashboard/footer') ?>

<script type="text/javascript">




$("#myBtn").click(function () {
                $("#myModal").modal();
            });
  $(".change_photo_status").click(function () {
			var photo_status=$(this).val();
			var yes=confirm("Are you sure want to change  your photos  protected modes?? Your photod no longer available to other users with out your permission..");
			if(!yes){
										
					return false;
					} 
			   $.ajax({
                        type: "POST",
						data:{photo_status:photo_status},
                        url: "<?php echo base_url('userdashboard/change_protect'); ?>" ,
						success: function(res) {
                            if (res)
                            {
                               $('#protect').toggle();
							   $('#unprotect').toggle();
                            }
                        }
                    });
            });			
			$(".remove_img").click(function () {
				var yes=confirm("Are you sure want to delete image??");
				if(!yes){
					
					return false;
				}
               var img_id=$(this).val();
			   $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('userdashboard/remove_image'); ?>" ,
                        data:{img_id:img_id},
						success: function(res) {
                            if (res)
                            {
                               location.reload();
                            }
                        }
                    });
					});
                
				
				$(".set_default").click(function () {
				var yes=confirm("Are you sure want to set this as default image??");
				if(!yes){
					
					return false;
				}
               var img_id=$(this).val();
			   $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('userdashboard/set_default_image'); ?>" ,
                        data:{img_id:img_id},
						success: function(res) {
                            if (res)
                            {
                               location.reload();
                            }
                        }
                    });
					});
				
				
				
				
				
				
				$("#upload_img").click(function () {
				
								var form = $('#img_box')[0]; // You need to use standart javascript object here
								var formData = new FormData(form);
								 $.ajax({
											url: '<?php echo base_url('userdashboard/uploadimage');?>',
											type: "POST",
											data: formData,
											contentType: false,
											cache: false,
											processData: false,

											success: function (data) {
													
											if(data==1){
												location.reload();
											}
											else{
												alert('somthing went wrong Please Try again')
											}
											
											}
										});
				});
</script>
</body>
</html>
