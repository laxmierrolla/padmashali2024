<?php
$this->load->view('template/userdashboard/head');
$profile_code = (isset($this->session->userdata['user']['username']))?$this->session->userdata['user']['username']:'';
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
		<?php if(isset($image_info) && (!empty($image_info))){ ?>
		<div class="col-md-12">
                         <img id="cropbox"  src="<?php echo base_url().'uploads/profilepics/'.$image_info['profile_id'].'/'.$image_info['img_src'];?>">       
                </div>	
					<br/><br/>
					<input type="hidden" id="x" name="x" />
					<input type="hidden" id="y" name="y" />
					<input type="hidden" id="w" name="w" />
					<input type="hidden" id="h" name="h" />
					<input type="hidden" id="imgsrc" name="imgsrc" value="<?php echo $image_info['img_src']; ?>" />
					
					<button class="btn btn-sm btn-success pull-right" onclick="checkCoords();">Crop Image</button>
        </div>
		<?php } ?>
</div>	
</div>		
		
<?php $this->load->view('template/userdashboard/footer') ?>
<link href="<?php echo base_url(); ?>assets/jquery.Jcrop.min.css" rel="stylesheet"/>

<script src="<?php echo base_url(); ?>assets/jquery.Jcrop.min.js"></script>

<script type="text/javascript">

  $(function(){

    $('#cropbox').Jcrop({
     
      onSelect: updateCoords,
	   setSelect: [150, 92, 365, 258],// you have set proper proper x and y coordinates here
        minSize:[215,156],
        maxSize:[900,900],
        aspectRatio: 1
    });

  });

  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function checkCoords()
  {
    var yes=confirm("Are you sure want to create default pic with selected region??");
			if(!yes){
										
					return false;
					} 
				var x=$('#x').val();
				var y=$('#y').val();
				var w=$('#w').val();
				var h=$('#h').val();
				var imgsrc=$('#imgsrc').val();
				
			   $.ajax({
                        type: "POST",
						data:{x:x,y:y,w:w,h:h,imgsrc:imgsrc},
                        url: "<?php echo base_url('userdashboard/create_thumbnail'); ?>" ,
						success: function(res) {
                            if (res)
                            {
                               alert('thumbnail created!!');
							   window.location.href="<?php echo base_url('userdashboard/managephotos/personal'); ?>";
                            }
                        }
                    });
  };


$("#myBtn").click(function () {
                $("#cropModal").modal();
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
