 <?php
$this->load->view('Admin/common_header');
$this->load->view('Admin/sidenav');

?> 
  <!-- =============================================== -->
  <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
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
      	<h1>Advertisements</h1>
     </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add Advertisements</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('advertisement');?>"><button type="button" class="btn btn-info">View Adevertisements</button></a>
          </div>
          
        </div>
        <!-- /.box-header -->
        <form name="addadv" id="addadv" method="post" enctype="multipart/form-data" action="<?php echo base_url('advertisement/saveAdds'); ?>">
        <div class="box-body">
            <div class="form-group">
                <label>Select Page <span style="color:red">*</span></label>
                <select  id="selectpage" name="selectpage" class="form-control" required>
                   <option value="">Choose page</option>
                    <option value="aboutus">About</option>
                    <option value="services">Services</option>
                    <option value="success">Success Stories</option>
                </select>
            </div>
            <div class="form-group">
                <label>Image <span style="color:red">*</span></label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>
            <div class="form-group">
                <label>WebLink <span style="color:red">*</span></label>
                <input type="text" name="weblink" id="weblink" class="form-control" required>
            </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" name="add_adv" id="add_adv">Submit</button>
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

<!-- CK Editor -->
<script type="text/javascript" src="<?php echo base_url();?>assets/jqueryvalidations/jquery.validate.min.js"></script> 
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="text/javascript">
     $(document).ready(function(){
	$("#addadv").validate({
        // Specify the validation rules
        rules: {
            selectpage: 
            {
                required: true,
            },
            image:{
                 required: true,
                 extension: "png|jpg|jpeg"
             },
            weblink:{
               required: true,
			   
               
            },
            
            
        },
        
        // Specify the validation error messages
        messages: {
            selectpage: {
                required: "Please select page name",
				
            },
            image:{
                 required: "Please upload image",
                 extension:"please upload jpg png jpeg files only"
				 
            },
            weblink:{
               required: "Please enter weblink",
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