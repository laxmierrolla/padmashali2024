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
      		<h1> Emails</h1>
            
            
       </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add Emails</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('admin/emails');?>"><button type="button" class="btn btn-info">View Emails</button></a>
          </div>
          
        </div>
        <!-- /.box-header -->
       
        <form name="addemail" id="addemail" method="post" action="<?php echo base_url('admin/saveEmail'); ?>">
        <div class="box-body">
          <div class="row">
           <div class="col-md-12">
              <div class="form-group">
                <label>Email<span style="color:red">*</span></label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" >
                <span id="email_error" style="color:red"></span>
              </div>
              </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <input type="submit" class="btn btn-primary pull-right" name="add_email" id="add_email" value="Save">
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
$(document).on('mouseleave','#email',function(){
	var email = $('#email').val();
	//alert(email);
		if(email!=""){
			$.ajax({
				method:"POST",
				url:"<?php echo base_url('admin/emailCheck');?>",
				data:{email:email},
				success: function(data){
					 var status = $.trim(data);
                    if(status == 'success') {  
                    $('#email_error').text("emils alredy exists");
                    $('#email').val('');
					$(':input[type="submit"]').prop('disabled',true);
                  }
				  else{
					  $('#email_error').text("");
					  $(':input[type="submit"]').prop('disabled',false);
					  }
				 
					},
			
				});
			}
	});
	
$(document).ready(function(){
	
	$("#addemail").validate({
        // Specify the validation rules
        rules: {
            email: 
            {
                required: true,
				email:true,
            },
         
        },
        
        // Specify the validation error messages
        messages: {
            email: {
                required: "Please enter email",
				email:"please enter valid email"
				
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