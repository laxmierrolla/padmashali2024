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
       <h1> Cancel Account</h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">View Cancel Accounts</h3>
        </div>
		<div class="row">
        <div class="col-xs-12">
        	<div class="box">
         
            <div class="box-body">
            <form id="search_accounts" name="search_accounts" method="post">
            <div class="col-lg-3 col-sm-12 margin_select mar5 pd-right">
              <select name="search_on_1" id="search_on_1" class="input-sm form-control custom-input">
               <option value="1">Profilecode</option>
               <option value="2">Email</option>
               <option value="3">Mobile</option>
              </select>
            </div>
            <div class="col-lg-2">
                <input type="text" name="search_text1" id="search_text1" class="input-sm form-control" placeholder="Enter Keyword">
            </div>
             <button type="button" id="search_submit" class="btn btn-info margin_search" style=""><i class="fa fa-search"></i></button>
          <a class="btn btn-danger" style="display:none;" id="searchreset" href="<?php echo base_url('admin/cancelledAccounts'); ?>"><li class="fa fa-search-minus"></li></a>   
            
          </form>  
             <input type="hidden" id="atpagination" value="">
            <input type="hidden" id="paginationlength" value="">
              <table id="cancelaccountlist" class="table table-bordered table-striped">
             
              </table>
            </div>
            <!-- /.box-body -->
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
		var search_on_1;
        var ispage;
	dtabel = $('#cancelaccountlist').DataTable({
		 "processing": true,
        "serverSide": true,
        "bStateSave": true,
        "language": {
        //"lengthMenu": "Display _MENU_ records per page",
        "emptyTable": "No Cancelled Records found!",
         },
       "sDom": "lptr<'clearfix'>p",
        //"order": [[ 4, "desc" ]],
        "PaginationType": "two_button",
        "PaginationType": "bootstrap",
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "destroy": true,
		"ajax":{
			
			"url": "<?php echo base_url('admin/allCancelAccounts'); ?>",
            "type": "POST",
            "data": function (d) {
            $("#paginationlength").val(d.length);
			d.search_text1 = search_text1;
			d.search_on_1 =search_on_1;
                },
                "dataSrc": function (jsondata) {
                    //$(".dataTables_paginate").addClass('pull-right');
                    $("#cancelaccountlist_length select").addClass('input-xs').removeClass('input-sm');
                    return jsondata['data'];
                }
			
			},
			 "columns": [
                {"title": "S.NO", "name":"sno", "orderable": false, "data":"sno", "width":"5%" },
                {"title": "Email", "name": "email", "data": "Email", "width": "10%"},
                {"title": "Reason", "name": "reason", "data": "Reason", "width": "20%"},
			    {"title": "Profilecode", "name": "profilecode", "data": "Profilecode", "width": "10%"},
				{"title": "Mobile", "name": "mobile","data": "Mobile", "width": "10%"},
				{"title": "Cancel Reason From", "name": "cancel", "data": "Cancelreason", "width": "10%"},
                
            ],
			"fnCreatedRow": function( nRow, aData, iDataIndex) {
                 $(nRow).find('td:eq(0)').attr('data-title',"S.No");
                 $(nRow).find('td:eq(1)').attr('data-title',"Email");
				 $(nRow).find('td:eq(2)').attr('data-title',"Reason");
				 $(nRow).find('td:eq(3)').attr('data-title',"Profilecode");
				 $(nRow).find('td:eq(4)').attr('data-title',"Mobile");
				 $(nRow).find('td:eq(5)').attr('data-title',"Cancel Reason From");
            
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
		search_on_1 = $("#search_on_1").val();
        var table = $('#cancelaccountlist').DataTable();
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
	});
	

	


	
</script>