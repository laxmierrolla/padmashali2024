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
      	<h1> Request Question</h1>
      </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add Request Questions</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('questions');?>"><button type="button" class="btn btn-info">View Questions</button></a>
          </div>
          
        </div>
        <!-- /.box-header -->
       
        <form name="addques" id="addques" method="post" action="<?php echo base_url('questions/saveQues'); ?>">
        <div class="box-body">
          <div class="row">
           <div class="col-md-12">
              <div class="form-group">
                <label>Question<span style="color:red">*</span></label>
                <input type="text" class="form-control" name="quesname" id="quesname" placeholder="Enter questions" >
               
              </div>
              </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <input type="submit" class="btn btn-primary pull-right" name="add_ques" id="add_ques" value="Save">
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
	$("#addques").validate({
        // Specify the validation rules
        rules: {
            quesname: 
            {
                required: true,
            },
         
        },
        
        // Specify the validation error messages
        messages: {
            quesname: {
                required: "Please enter question",
				
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