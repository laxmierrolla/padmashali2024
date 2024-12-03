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
 <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <section class="content-header">
      	<h1> Events</h1>
     </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add Events</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('events');?>"><button type="button" class="btn btn-info">View Events</button></a>
          </div>
          
        </div>
        <!-- /.box-header -->
       
        <form name="addevents" id="addevents" method="post" action="<?php echo base_url('events/saveEvents'); ?>">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Event Name<span style="color:red">*</span></label>
                <input type="text" class="form-control" name="eventname" id="eventname" placeholder="Enter Event name" >
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Event Date<span style="color:red">*</span></label>
                <input type="text" class="form-control" name="eventdate" id="eventdate" >
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Description<span style="color:red">*</span></label>
                <textarea class="form-control" name="desc" id="desc"  ></textarea>
               
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
          <button type="submit" class="btn btn-primary pull-right" name="add_event" id="add_event">Submit</button>
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
	
	$("#addevents").validate({
        // Specify the validation rules
        rules: {
            eventname: 
            {
                required: true,
            },
            eventdate:{
                 required: true, 
				 
            },
            desc:{
               required: true,
			 
            },
        },
        
        // Specify the validation error messages
        messages: {
            eventname: {
                required: "Please enter event name",
				
            },
            eventdate:{
                 required: "Please enter event date",
				
            },
            desc:{
               required: "Please enter description",
              
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
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
           $('#eventdate').datepicker( {
		showOn: "button",
                buttonImage: "https://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
                buttonImageOnly: true,
		changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
        });
      });
</script>