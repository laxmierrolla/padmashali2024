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
      		<h1> countries</h1>
            
            
       </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add Country</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('countries');?>"><button type="button" class="btn btn-info">View Countries</button></a>
          </div>
          
        </div>
        <!-- /.box-header -->
       
        <form name="addcountry" id="addcountry" method="post" action="<?php echo base_url('countries/saveCountry'); ?>">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Country Name<span style="color:red">*</span></label>
                <input type="text" class="form-control" name="countryname" id="countryname" placeholder="Enter country name" >
                <span id="country_error" style="color:red"></span>
              </div>
              <!-- /.form-group -->
              
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Phone code</label>
                <input type="text" class="form-control" name="phonecode" id="phonecode"  placeholder="Enter phonecode" >
              </div>
              <!-- /.form-group -->
              
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" name="add_country" id="add_country">Submit</button>
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
$(document).on('change','#countryname',function(){
	
	var country = $('#countryname').val();
	
		if(country!=""){
			$.ajax({
				method:"POST",
				url:"<?php echo base_url('countries/countryCheck');?>",
				data:{countryname:country},
				success: function(data){
					 var status = $.trim(data);
                    if(status == 'success') {  
                    $('#country_error').text("country alredy exists").fadeOut(5000);
                    $('#countryname').val('');
                  }
					},
			
				});
			}
	});
	
$(document).ready(function(){
	
	$("#addcountry").validate({
        // Specify the validation rules
        rules: {
            countryname: 
            {
                required: true,
            },
            phonecode:{
                 required: true, 
				 digits:true
            },
           
        },
        
        // Specify the validation error messages
        messages: {
            countryname: {
                required: "Please enter country name",
				
            },
            phonecode:{
                 required: "Please enter phonecode",
				 digits:"Please enter digits only"
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