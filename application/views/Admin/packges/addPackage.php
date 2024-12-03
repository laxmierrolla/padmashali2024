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
      		<h1> Packages</h1>
            
            
       </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add Package</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('package');?>"><button type="button" class="btn btn-info">View Packages</button></a>
          </div>
          
        </div>
        <!-- /.box-header -->
       
        <form name="addpackage" id="addpackage" method="post" action="<?php echo base_url('package/savePackage'); ?>">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Package Name<span style="color:red">*</span></label>
                <input type="text" class="form-control" name="packagename" id="packagename" placeholder="Enter package name" >
                <span id="package_error" style="color:red"></span>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>No.of Views<span style="color:red">*</span></label>
                <input type="text" class="form-control" name="noofviews" id="noofviews" placeholder="Enter no.of views" >
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>ValidityPeriod</label>
                <input type="text" class="form-control" name="validity" id="validity"  maxlength="2" placeholder="Enter validity period" >
               <select class="form-control" id="period" name="period">
                  <option value="">Select</option>
                  <option value="years">Year</option>
                  <option value="months">Month</option>
                  <option value="week">Week</option>
                  
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Price</label>
               <input type="text" class="form-control" name="price" id="price" placeholder="Enter Price" >
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" name="addpackage" id="addpackage">Submit</button>
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
<script>
$(document).on('change','#packagename',function(){
	var packagename = $('#packagename').val();
		if(packagename!=""){
			$.ajax({
				method:"POST",
				url:"<?php echo base_url('package/packageCheck');?>",
				data:{packagename:packagename},
				success: function(data){
					 var status = $.trim(data);
                    if(status == 'success') {  
                    $('#package_error').text("packagename alredy exists").fadeOut(5000);
                    $('#packagename').val('');
                  }
					},
			
				});
			}
	});
	
$(document).ready(function(){
	
	$("#addpackage").validate({
        // Specify the validation rules
        rules: {
            packagename: 
            {
                required: true,
            },
            noofviews:{
                 required: true, 
				 digits:true
            },
            validity:{
               required: true,
			   digits:true
               
            },
            period:{
              required: true,
            },
            price:{
                required:true,
				digits:true
            },
            
        },
        
        // Specify the validation error messages
        messages: {
            packagename: {
                required: "Please enter package name",
				
            },
            noofviews:{
                 required: "Please enter Numbder of views",
				 digits:"Please enter numbers only"
            },
            validity:{
               required: "Please enter validity",
			   digits:"Please enter numbers only",
              
            },
            period:{
               required: "Please select period",
                
            },
            price:{
                required:"Please enter  price ",
				digits:"Please enter digits only",
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