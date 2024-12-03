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
      	<h1>Privacy</h1>
     </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add Privacy</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('privaacy');?>"><button type="button" class="btn btn-info">View Privacy</button></a>
          </div>
          
        </div>
        <!-- /.box-header -->
        <form name="addprivacy" id="addprivacy" method="post" action="<?php echo base_url('privacy/savePrivacy'); ?>">
        <div class="box-body">
            <div class="form-group">
                <label>Title <span style="color:red">*</span></label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group">
                <label>Description <span style="color:red">*</span></label>
                <textarea id="desc" name="desc" rows="50" cols="80"></textarea>
            </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" name="add_privacy" id="add_privacy">Submit</button>
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
<script type="text/javascript">
   $(document).ready(function(){
        CKEDITOR.replace('desc');
        $("#addprivacy").submit( function(e) {
            var title = $('#title').val();
            if(title==""){
                alert( 'Please enter title' );
            }
            var messageLength = CKEDITOR.instances['desc'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'Please enter data' );
                e.preventDefault();
            }
        });
      });
</script>