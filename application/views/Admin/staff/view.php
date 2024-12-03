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
       <h1> Staff Details</h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">View Staff</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('staff/addStaff');?>"><button type="button" class="btn btn-info">Add Staff</button></a>
          </div>
          
        </div>
         <?php if(!empty($this->session->flashdata('staff_error'))){ ?>
            <div class="alert alert-danger fade in">
    			<a href="" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong> A problem has been occurred while adding staff .
		</div>
        <?php } ?>
        
         <?php if(!empty($this->session->flashdata('staff_sucess'))){ ?>
           <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
               <strong>Success!</strong> Staff  added successfully.
          </div>
        <?php } ?>
		<div class="row">
        <div class="col-xs-12">
        	<div class="box">
         
            <div class="box-body">
            <form id="search_branch" name="search_branch" method="post">
           <div class="col-lg-3 col-sm-12 margin_select mar5 pd-right">
              <select name="search_on_1" id="search_on_1" class="input-sm form-control custom-input">
               <option value="1">Username</option>
               <option value="2">Email</option>
               <option value="3">Mobile</option>
               <option value="4">GroupName</option>
              </select>
            </div>
            <div class="col-lg-2">
                <input type="text" name="search_text1" id="search_text1" class="input-sm form-control" placeholder="Enter Keyword">
            </div>
             <button type="button" id="search_submit" class="btn btn-info margin_search" style=""><i class="fa fa-search"></i></button>
          <a class="btn btn-danger" style="display:none;" id="searchreset" href="<?php echo base_url('staff'); ?>"><li class="fa fa-search-minus"></li></a>   
            
          </form>  
             <input type="hidden" id="atpagination" value="">
            <input type="hidden" id="paginationlength" value="">
              <table id="stafflist" class="table table-bordered table-striped">
             
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        </div>
        
        
        <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_edit_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Edit Staff</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="edit_form" class="form-horizontal">
          <input type="hidden" value="" name="admin_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">GroupName<span style="color:red">*</span></label>
              <div class="col-md-9">
                 <select class="form-control" id="group" name="group">
                  <option value="">SelectGroup</option>
                  <?php if(isset($groups)){foreach($groups as $value){?>
                  <option value="<?php echo $value->GroupID;?>"><?php echo $value->GroupName;?></option>
                <?php }} ?>
                </select>
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-md-3">UserName<span style="color:red">*</span></label>
              <div class="col-md-9">
                 <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" >
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-md-3">Email<span style="color:red">*</span></label>
              <div class="col-md-9">
                <input type="email" class="form-control" name="email" id="email"   placeholder="Enter Email" >
              </div>
            </div>
             
             <div class="form-group">
              <label class="control-label col-md-3">Mobilenumber<span style="color:red">*</span></label>
              <div class="col-md-9">
                 <input type="text" class="form-control" name="phone" id="phone"   placeholder="Enter mobile" >
              </div>
            </div>
          
          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave"  class="btn btn-primary" onclick="update()">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
 
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
		var search_on_1
        var ispage;
	dtabel = $('#stafflist').DataTable({
		 "processing": true,
        "serverSide": true,
        "bStateSave": true,
        "language": {
        //"lengthMenu": "Display _MENU_ records per page",
        "emptyTable": "No Staff found!",
         },
       "sDom": "lptr<'clearfix'>p",
        //"order": [[ 4, "desc" ]],
        "PaginationType": "two_button",
        "PaginationType": "bootstrap",
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "destroy": true,
		"ajax":{
			
			"url": "<?php echo base_url('staff/allStaffData'); ?>",
            "type": "POST",
            "data": function (d) {
            $("#paginationlength").val(d.length);
			d.search_text1 = search_text1;
			d.search_on_1=search_on_1;
                },
                "dataSrc": function (jsondata) {
                    //$(".dataTables_paginate").addClass('pull-right');
                    $("#stafflist_length select").addClass('input-xs').removeClass('input-sm');
                    return jsondata['data'];
                }
			
			},
			 "columns": [
                {"title": "S.NO", "name":"sno", "orderable": false, "data":"sno", "width":"5%" },
                {"title": "UserName", "name": "UserName", "data": "UserName", "width": "15%"},
				{"title": "Email", "name": "Email", "data": "Email", "width": "15%"},
				{"title": "Mobile", "name": "Mobile", "data": "Mobile", "width": "15%"},
				{"title": "GroupName", "name": "GroupName", "data": "GroupName", "width": "15%"},
                {"title": "Status", "name": "status", "orderable": false,"data": "Status", "width": "10%"},
                {"title": "Actions", "name": "actions", "orderable": false, "defaultContent": "", "width": "10%"},
            ],
			"fnCreatedRow": function( nRow, aData, iDataIndex) {
                 $(nRow).find('td:eq(0)').attr('data-title',"S.No");
                 $(nRow).find('td:eq(1)').attr('data-title',"UserName");
				 $(nRow).find('td:eq(2)').attr('data-title',"Email");
				 $(nRow).find('td:eq(3)').attr('data-title',"Mobile");
				 $(nRow).find('td:eq(4)').attr('data-title',"GroupName");
				
                
             var action ='<button class="btn btn-primary btn-xs" onclick="edit_staff('+aData['admin_id']+')"><span class="glyphicon glyphicon-pencil"></span></button> <button class="btn btn-danger btn-xs" onclick="delete_staff('+aData['admin_id']+')"><span class="glyphicon glyphicon-trash"></span></button> <button class="btn btn-info btn-xs" onclick="status_staff('+aData['admin_id']+','+aData['status']+')" ><span class="glyphicon glyphicon-lock"></span></button>';
                    
            if(aData['Status']==1){
            	 status_text = '<span class="label label-success">Active</span>';
				 
            }
            else
            {
                status_text = '<span class="label label-danger">Inactive</span>';
				 
            }
            $(nRow).find('td:eq(6)').html(action);
            $(nRow).find('td:eq(5)').html(status_text);
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
        var table = $('#stafflist').DataTable();
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
	
//edit book	
function edit_staff(id)
    {
		
     
      $('#edit_form')[0].reset(); // reset form on modals
 
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('staff/staffEdit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="admin_id"]').val(data.admin_id);
            $('#group option[value="'+data.admintype+'"]').prop('selected', true);
			$('[name="username"]').val(data.uname);
			$('[name="email"]').val(data.mail_id);
			$('[name="phone"]').val(data.mobile);
            $('#modal_edit_form').modal('show'); // show bootstrap modal when complete loaded
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }
 	
//update package
 function update()
    {

       // ajax adding data to database
          $.ajax({
            url : "<?php echo site_url('staff/updateStaff')?>",
            type: "POST",
            data: $('#edit_form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_edit_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
               alert("occupations not updated");
            }
        });
    }
	
	
function delete_staff(id)
    {
		
      if(confirm('Are you sure delete this staff?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('staff/deleteStaff')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

      }
    }	

function status_staff(id,status)
    {
		var staff_id = id;
		var staff_status = status;
	if(confirm('Are you sure change the status?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('staff/stausChangeStaff')?>/",
            type: "POST",
			data:{id:staff_id,status:staff_status},
            dataType: "JSON",
            success: function(data)
            {
               
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error changing status');
            }
        });

      }
    }	


	
</script>