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
      		<h1> specialcases</h1>
            
            
       </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add SpecialCases</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('specialcases');?>"><button type="button" class="btn btn-info">View Specialcases</button></a>
          </div>
          
        </div>
        <!-- /.box-header -->
       
        <form name="addspl" id="addspl" method="post" action="<?php echo base_url('specialcases/saveSpl'); ?>">
        <div class="box-body">
          <div class="row">
           <div class="col-md-12">
              <div class="form-group">
                <label>Special Cases name<span style="color:red">*</span></label>
                <input type="text" class="form-control" name="splname" id="splname" placeholder="Enter special cases name" >
                <span id="spl_error" style="color:red"></span>
              </div>
              </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <input type="submit" class="btn btn-primary pull-right" name="add_spl" id="add_spl" value="Save">
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
$(document).on('mouseleave','#splname',function(){
	var splname = $('#splname').val();
		if(splname!=""){
			$.ajax({
				method:"POST",
				url:"<?php echo base_url('specialcases/splCheck');?>",
				data:{splname:splname},
				success: function(data){
					 var status = $.trim(data);
                    if(status == 'success') {  
                    $('#spl_error').text("specialcase alredy exists");
                    $('#splname').val('');
					$(':input[type="submit"]').prop('disabled',true);
                  }
				  else{
					  $('#spl_error').text("");
					  $(':input[type="submit"]').prop('disabled',false);
					  }
				 
					},
			
				});
			}
	});
	
$(document).ready(function(){
	
	$("#addspl").validate({
        // Specify the validation rules
        rules: {
            splname: 
            {
                required: true,
            },
         
        },
        
        // Specify the validation error messages
        messages: {
            splname: {
                required: "Please enter specialcase name",
				
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