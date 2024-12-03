 <?php
$this->load->view('Admin/common_header');
$this->load->view('Admin/sidenav');

?> 
  <!-- =============================================== -->
<style>
.box-title{
	color:green;
	font-size:16px;
	font-weight:bold;
	}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <section class="content-header">
      		<h1> PhotoGallery</h1>
            
            
       </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add Photogallery</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('gallery/photogallery');?>"><button type="button" class="btn btn-info">View Photo Gallery</button></a>
          </div>
          
        </div>
        <!-- /.box-header -->
       <?php if(!empty($this->session->flashdata('photos_error'))){ ?>
            <div class="alert alert-danger fade in">
    			<a href="" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong> <?php echo $this->session->flashdata('photos_error'); ?>
		</div>
        <?php } ?>
        
        <form name="addphotogal" id="addphotogal" method="post" enctype="multipart/form-data" action="<?php echo base_url('gallery/savePhotoGallery'); ?>">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Gallery Name<span style="color:red">*</span></label>
                <select name="galname" id="galname" class="form-control">
                	<option value="">slect gallery name</option>
                    <?php if(isset($gallery)){
						foreach($gallery as $value){?>
                        <option value="<?php echo $value->Gid;?>"><?php echo $value->GName;?></option>
                        <?php }}?>
                </select>
               
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Image<span style="color:red">*</span></label>
                <input type="file"  name="image" id="image" >
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" id="name"   placeholder="Enter Name">
                <span id="name_error" style="color:red"></span>
               
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Description</label>
               <textarea class="form-control" name="desc" id="desc" placeholder="Enter Description" ></textarea>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" name="addpgallery" id="addpgallery">Submit</button>
        </div>
        </form>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
$this->load->view('Admin/common_fotter');
?> 
<script type="text/javascript" src="<?php echo base_url();?>assets/jqueryvalidations/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> 
<script>
$(document).on('change','#name',function(){
	var name = $('#name').val();
		if(name!=""){
			$.ajax({
				method:"POST",
				url:"<?php echo base_url('gallery/nameCheck');?>",
				data:{name:name},
				success: function(data){
					 var status = $.trim(data);
                    if(status == 'success') {  
                    $('#name_error').text("name alredy exists").fadeOut(5000);
                    $('#name').val('');
                  }
					},
			
				});
			}
	});
	
$(document).ready(function(){
	
	$("#addphotogal").validate({
        // Specify the validation rules
        rules: {
            galname: 
            {
                required: true,
            },
            name:{
                 required: true, 
				 },
            image:{
              required: true,
               extension: "jpg|jpeg|png"
            },
            desc:{
              required: true,
            },
        
        },
        
        // Specify the validation error messages
        messages: {
            galname: {
                required: "Please select gallery name",
				
            },
            name:{
                 required: "Please enter Name",
				 
            },
            image:{
               required: "please upload image",
               extension:"Please upload jpeg, jpg, png images"
              
            },
            desc:{
               required: "Please enter description",
                
            },
            
        },
        errorElement: "div",
                    wrapper: "div",
                    errorPlacement: function(error, element) {
                        offset = element.offset();
                        error.insertAfter(element)
                        error.css('color','red');
                    },
        submitHandler: function(form) {
           
            form.submit();
        }
    });
	
	
	
	
	});	
</script>