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
      	<h1>Faqs</h1>
     </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add Faqs</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('faqs');?>"><button type="button" class="btn btn-info">View Faqs</button></a>
          </div>
          
        </div>
        <!-- /.box-header -->
        <form name="addfaqs" id="addfaqs" method="post" action="<?php echo base_url('faqs/saveFaqs'); ?>">
        <div class="box-body">
            <div class="form-group">
                <label>Question <span style="color:red">*</span></label>
                <input type="text" name="question" id="question" class="form-control">
            </div>
            <div class="form-group">
                <label>Answer <span style="color:red">*</span></label>
                <textarea id="answer" name="answer" rows="50" cols="80"></textarea>
            </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" name="add_faqs" id="add_faqs">Submit</button>
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
        CKEDITOR.replace('answer');
        $("#addfaqs").submit( function(e) {
            var question = $('#question').val();
            if(question==""){
                alert( 'Please enter question' );
            }
            var messageLength = CKEDITOR.instances['answer'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'Please enter data' );
                e.preventDefault();
            }
        });
      });
</script>