 <?php
$this->load->view('Admin/common_header');
$this->load->view('Admin/sidenav');

?> 
  <!-- =============================================== -->
  <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
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
      	<h1>Success Stories</h1>
     </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add Success Stories</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('success_stories');?>"><button type="button" class="btn btn-info">View Service</button></a>
          </div>
          
        </div>
        <!-- /.box-header -->
        <form name="addstories" id="addstories" method="post" enctype="multipart/form-data" action="<?php echo base_url('success_stories/saveStories'); ?>">
        <div class="box-body">
            <div class="form-group">
                <label>Name <span style="color:red">*</span></label>
                <input type="text" name="couplename" id="couplename" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Image <span style="color:red">*</span></label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Description <span style="color:red">*</span></label>
                <textarea id="desc" name="desc" rows="50" cols="80" required></textarea>
            </div>
            <div class="form-group">
                <label>Married date <span style="color:red">*</span></label>
                <input type="text" name="marriedate" id="marriedate" class="form-control" required>
            </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" name="add_service" id="add_service">Submit</button>
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

<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
        CKEDITOR.replace('desc');
        $('#marriedate').datepicker( {
		showOn: "button",
                buttonImage: "https://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
                buttonImageOnly: true,
		changeMonth: true,
                changeYear: true,
                dateFormat: 'dd-mm-yy'
        });
        $("#addservice").submit( function(e) {
            var name = $('#name').val();
            if(name==""){
                alert( 'Please enter name' );
            }
            var messageLength = CKEDITOR.instances['desc'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'Please enter data' );
                e.preventDefault();
            }
        });
      });
</script>