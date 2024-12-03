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
      		<h1> Occupation</h1>
            
            
       </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add Occupation</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('occupation');?>"><button type="button" class="btn btn-info">View Occupation</button></a>
          </div>
          
        </div>
        <!-- /.box-header -->
       
        <form name="addocc" id="addocc" method="post" action="<?php echo base_url('occupation/saveOccupation'); ?>">
        <div class="box-body">
          <div class="row">
           <div class="col-md-12">
              <div class="form-group">
                <label>Occupation name<span style="color:red">*</span></label>
                <input type="text" class="form-control" name="occname" id="occname" placeholder="Enter occupation name" >
                <span id="occ_error" style="color:red"></span>
              </div>
              </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <input type="submit" class="btn btn-primary pull-right" name="addocc" id="addocc" value="Save">
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
$(document).on('mouseleave','#occname',function(){
	var occname = $('#occname').val();
		if(occname!=""){
			$.ajax({
				method:"POST",
				url:"<?php echo base_url('occupation/occupationCheck');?>",
				data:{occname:occname},
				success: function(data){
					 var status = $.trim(data);
                    if(status == 'success') {  
                    $('#occ_error').text("occuptionname alredy exists");
                    $('#occname').val('');
					$(':input[type="submit"]').prop('disabled',true);
                  }
				 
					},
			
				});
			}
	});
	
$(document).ready(function(){
	
	$("#addocc").validate({
        // Specify the validation rules
        rules: {
            occname: 
            {
                required: true,
            },
         
        },
        
        // Specify the validation error messages
        messages: {
            occname: {
                required: "Please enter occupation name",
				
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