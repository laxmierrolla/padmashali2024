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
      		<h1> Staff</h1>
            
            
       </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add Staff</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('staff');?>"><button type="button" class="btn btn-info">View Staff</button></a>
          </div>
          
        </div>
        <!-- /.box-header -->
       
        <form name="addstaff" id="addstaff" method="post" action="<?php echo base_url('staff/saveStaff'); ?>">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Group<span style="color:red">*</span></label>
                 <select class="form-control" id="group" name="group">
                  <option value="">SelectGroup</option>
                  <?php if(isset($groups)){foreach($groups as $value){?>
                  <option value="<?php echo $value->GroupID;?>"><?php echo $value->GroupName;?></option>
                <?php }} ?>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>UserName<span style="color:red">*</span></label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" >
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Email<span style="color:red">*</span></label>
                <input type="email" class="form-control" name="email" id="email"   placeholder="Enter Email" >
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Password<span style="color:red">*</span></label>
               <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" >
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Mobilenumber<span style="color:red">*</span></label>
                <input type="text" class="form-control" name="phone" id="phone"   placeholder="Enter mobile" >
              </div>
              <!-- /.form-group -->
              
              <!-- /.form-group -->
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" name="add_staff" id="add_staff">Submit</button>
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
$(document).ready(function(){
	  jQuery.validator.addMethod("lettersonly", function(value, element) {
         return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
    }, "Letters only please");
	
	 $.validator.addMethod("regex", function(value, element, regexpr) {          
     return regexpr.test(value);
   }, "Please enter a valid regx."); 
	
	$("#addstaff").validate({
        // Specify the validation rules
        rules: {
            group: 
            {
                required: true,
            },
            username:{
                 required: true, 
				 lettersonly:true
            },
            email:{
               required: true,
			   email:true
               
            },
            password:{
              required: true,
			  minlength:5,
            },
            phone:{
				 required:true,
                 minlength: 10,
				 regex: /^[7-9]{1}[0-9]{9}$/, 
            },
            
        },
        
        // Specify the validation error messages
        messages: {
            group: {
                required: "Please select name",
				
            },
            username:{
                 required: "Please enter username",
				 lettersonly:"Please enter alphabets only"
            },
            email:{
               required: "Please enter email",
			   email:"Please enter vallid email",
              
            },
            password:{
               required: "Please enter password",
			   minlength:"please enter minimum 5 characters"
                
            },
            phone:{
                required:"Please enter  phonenumber ",
				minlength:"please enter minimum 10 charcters",
				regex:"Please enter valid phone number",
				
				
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