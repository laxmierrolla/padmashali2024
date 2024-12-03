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
      		<h1> States</h1>
            
            
       </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add State</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('state');?>"><button type="button" class="btn btn-info">View States</button></a>
          </div>
          
        </div>
        <!-- /.box-header -->
       
        <form name="addstate" id="addstate" method="post" action="<?php echo base_url('state/saveState'); ?>">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Country Name<span style="color:red">*</span></label>
                <select name="countryname" id="countryname" class="form-control">
                <option value=""> Select Country</option>
                <?php if($countries){
					foreach($countries as $value){?>
                    <option value="<?php  echo $value->id?>"><?php echo $value->name;?></option>
                    <?php }
					}?>
                </select>
              </div>
              <!-- /.form-group -->
              
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>State Name</label>
                <input type="text" class="form-control" name="statename" id="statename"  placeholder="Enter statename" >
                 <span id="state_error" style="color:red"></span>
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
          <button type="submit" class="btn btn-primary pull-right" name="add_state" id="add_state">Submit</button>
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
$(document).on('mouseout','#statename',function(){
	
	var country = $('#countryname').val();
	var state = $('#statename').val();
	
		if(country!="" && state!=""){
			$.ajax({
				method:"POST",
				url:"<?php echo base_url('state/stateCheck');?>",
				data:{country:country,state:state},
				success: function(data){
					 var status = $.trim(data);
                    if(status == 'success') {  
                    $('#state_error').text("state alredy exists").fadeOut(5000);
                    $('#statename').val('');
                  }
					},
			
				});
			}
	});
	
$(document).ready(function(){
	
	$("#addstate").validate({
        // Specify the validation rules
        rules: {
            countryname: 
            {
                required: true,
            },
            statename:{
                 required: true, 
				
            },
           
        },
        
        // Specify the validation error messages
        messages: {
            countryname: {
                required: "Please slect country name",
				
            },
            statename:{
                 required: "Please enter statename",
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