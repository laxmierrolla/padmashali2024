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
      		<h1> EmployeedIn</h1>
            
       </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add EmpoyeedIn</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('employeed');?>"><button type="button" class="btn btn-info">View EmployeedIn</button></a>
          </div>
          
        </div>
        <!-- /.box-header -->
       
        <form name="addemp" id="addemp" method="post" action="<?php echo base_url('employeed/saveEmp'); ?>">
        <div class="box-body">
          <div class="row">
           <div class="col-md-12">
              <div class="form-group">
                <label>EmpoyeedIn name<span style="color:red">*</span></label>
                <input type="text" class="form-control" name="empname" id="empname" placeholder="Enter employeedIn name" >
                <span id="emp_error" style="color:red"></span>
              </div>
              </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <input type="submit" class="btn btn-primary pull-right" name="add_emp" id="add_emp" value="Save">
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
$(document).on('mouseleave','#empname',function(){
	var empname = $('#empname').val();
		if(empname!=""){
			$.ajax({
				method:"POST",
				url:"<?php echo base_url('employeed/empCheck');?>",
				data:{empname:empname},
				success: function(data){
					 var status = $.trim(data);
                    if(status == 'success') {  
                    $('#emp_error').text("EmployeedIn alredy exists");
                    $('#empname').val('');
					$(':input[type="submit"]').prop('disabled',true);
                  }
				 
					},
			
				});
			}
	});
	
$(document).ready(function(){
	
	$("#addemp").validate({
        // Specify the validation rules
        rules: {
            empname: 
            {
                required: true,
            },
         
        },
        
        // Specify the validation error messages
        messages: {
            empname: {
                required: "Please enter EmployeedIn name",
				
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