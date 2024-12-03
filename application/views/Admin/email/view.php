 <?php
$this->load->view('Admin/common_header');
$this->load->view('Admin/sidenav');

?>
<style>
.box-title{
	color:green;
	font-size:16px;
	font-weight:bold;
	}
</style> 
  <!-- =============================================== -->
 <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/datatables/dataTables.bootstrap.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <section class="content-header">
       <h1>Emails</h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">View Emails</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('admin/Addemails');?>"><button type="button" class="btn btn-info">Add Emails</button></a>
          </div>
          
        </div>
          <?php if(!empty($this->session->flashdata('email_error'))){ ?>
            <div class="alert alert-danger fade in">
    			<a href="" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong> A problem has been occurred while adding email
		</div>
        <?php } ?>
        
         <?php if(!empty($this->session->flashdata('email_sucess'))){ ?>
           <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
               <strong>Success!</strong> Email added successfully.
          </div>
        <?php } ?>
		<div class="row">
        <div class="col-xs-12">
        	<div class="box">
            <div class="box-body">
            <form id="search_accounts" name="search_accounts" method="post">
            <div class="col-lg-2">
                <input type="text" name="search_text1" id="search_text1" class="input-sm form-control" placeholder="Enter email">
            </div>
             <button type="button" id="search_submit" class="btn btn-info margin_search" style=""><i class="fa fa-search"></i></button>
          <a class="btn btn-danger" style="display:none;" id="searchreset" href="<?php echo base_url('admin/emails'); ?>"><li class="fa fa-search-minus"></li></a>   
            
          </form>  
             <input type="hidden" id="atpagination" value="">
            <input type="hidden" id="paginationlength" value="">
              <table id="emaillist" class="table table-bordered table-striped">
             
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
             <button type="button" class="btn btn-primary pull-right" name="delete_email" id="delete_email">DeleteEmails</button>
           </div>
          </div>
        </div>
        </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

   <?php
$this->load->view('Admin/common_fotter');

?> 
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/admin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/datatables/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	var dtabel;
        var search_text1;
        var ispage;
	dtabel = $('#emaillist').DataTable({
		 "processing": true,
        "serverSide": true,
        "bStateSave": true,
        "language": {
        //"lengthMenu": "Display _MENU_ records per page",
        "emptyTable": "No Emails found!",
         },
       "sDom": "lptr<'clearfix'>p",
        //"order": [[ 4, "desc" ]],
        "PaginationType": "two_button",
        "PaginationType": "bootstrap",
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "destroy": true,
		"ajax":{
			
			"url": "<?php echo base_url('admin/allEmails'); ?>",
            "type": "POST",
            "data": function (d) {
            $("#paginationlength").val(d.length);
			d.search_text1 = search_text1;
			
                },
                "dataSrc": function (jsondata) {
                    //$(".dataTables_paginate").addClass('pull-right');
                    $("#emaillist_length select").addClass('input-xs').removeClass('input-sm');
                    return jsondata['data'];
                }
			
			},
			 "columns": [
			    { "title": "<div class='checkbox'><label><input type='checkbox' name='select_all' value='all' id='email-select-all' class='colored-success'/> <span class='text'> </span></label></div>",
                    "orderable": false, "deafultContent": "", "data": null, "width":"5%"},                
				{"title": "S.NO", "name":"sno", "orderable": false, "data":"sno", "width":"5%" },
                {"title": "Email", "name": "email", "data": "Email", "width": "10%"},
            ],
			"fnCreatedRow": function( nRow, aData, iDataIndex) {
                 $(nRow).find('td:eq(1)').attr('data-title',"S.No");
                 $(nRow).find('td:eq(2)').attr('data-title',"Email");
				 
				  var checkBoxes = '<div class="checkbox"><label><input type="checkbox"  class="checkall" id="checkId" name="emails[]" value="'+aData['Id']+'"><span class="text"></span></label></div>';
				  $(nRow).find('td:eq(0)').html(checkBoxes);
                 
            },
		});
		
	    $("#search_submit").click(function(){
		if($("#search_text1").val()!=""){
            $("#search_text1").css('background', '#ffffff');
                setallvalues();
                dtabel.draw();
        }else{
            $("#search_text1").css('background', '#ffb3b3');
            $("#search_text1").focus();
            return false;
            }
        });
        
        
    function setallvalues(){
        search_text1 = $("#search_text1").val();
		
        var table = $('#emaillist').DataTable();
        var info = table.page.info();
        $("#atpagination").val((info.page+1));
        if(search_text1!=""){
            $("#searchreset").show();  
        }
    searchAstr = '';
}

function getpagenumber(){
    return $("#atpagination").val() / $("#paginationlength").val();
}


$("#email-select-all").click(function(){  //"select all" change
    var status = this.checked; // "select all" checked status
    $('.checkall').each(function(){ //iterate all listed checkbox items
        this.checked = status; //change ".checkbox" checked status
    });
});

 $('#delete_email').on('click', function(){
	 var checkedboxes = $('input:checkbox[name="emails[]"]:checked').length;
	 if(checkedboxes == 0){
		 alert("please select email");
		 }
	 else{
		 var mails=Array();
		  mails = $('input:checkbox[name="emails[]"]:checked').map(function() {
                   return $(this).val();
                }).get();

		 $.ajax({
			 type:"POST",
			 url:"<?php echo base_url('admin/deleteEmail');?>",
			 data:{mails:mails},
			 success: function(data){
				 var status = $.trim(data);
				 if(status == 'success') {  
                   alert("data delted successfully");
				   location.reload();
                  }
				  else{
					  alert("emails not deleted");
					  location.reload();
					  }
				 
				 },
			 });
		 }	 
	 
	 });

	});



	
</script>