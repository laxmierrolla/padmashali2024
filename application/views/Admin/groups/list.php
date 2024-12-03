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
       <h1> Groups Details</h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Groups List</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('group/addgroup');?>"><button type="button" class="btn btn-info">Add Groups</button></a>
          </div>
          
        </div>
         <?php if(!empty($this->session->flashdata('group_error'))){ ?>
            <div class="alert alert-danger fade in">
    			<a href="" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong> A problem has been occurred while adding group.
		</div>
        <?php } ?>
        
         <?php if(!empty($this->session->flashdata('group_sucess'))){ ?>
           <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
               <strong>Success!</strong> Group added successfully.
          </div>
        <?php } ?>
		<div class="row">
        <div class="col-xs-12">
        	<div class="box">
            <!--<div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>-->
            <!-- /.box-header -->
           
     
            <div class="box-body">
            <form id="search_branch" name="search_branch" method="post">
            <div class="col-lg-2">
                <input type="text" name="search_text1" id="search_text1" placeholder="GroupName" class="input-sm form-control">
            </div>
             <button type="button" id="search_submit" class="btn btn-info margin_search" style=""><i class="fa fa-search"></i></button>
          <a class="btn btn-danger" style="display:none;" id="searchreset" href="<?php echo base_url('group'); ?>"><li class="fa fa-search-minus"></li></a>   
            
          </form>  
             <input type="hidden" id="atpagination" value="">
            <input type="hidden" id="paginationlength" value="">
              <table id="grouplist" class="table table-bordered table-striped">
             
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
        <h3 class="modal-title">Edit Packages</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="edit_form" class="form-horizontal">
          <input type="hidden" value="" name="package_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">PackageName</label>
              <div class="col-md-9">
               <input type="text" class="form-control" name="packagename" id="packagename" placeholder="Enter package name" >
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Noof views</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="noofviews" id="noofviews" placeholder="Enter no.of views" >
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Validity</label>
              <div class="col-md-9">
			<input type="text" class="form-control" name="validity" id="validity"  maxlength="2" placeholder="Enter validity period" >
              </div>
            </div>
			<div class="form-group">
				<label class="control-label col-md-3">Period</label>
					<div class="col-md-9">
				  <select class="form-control" id="period" name="period">
                  <option value="">Select</option>
                  <option value="years">Year</option>
                  <option value="months">Month</option>
                  <option value="week">Week</option>
                  
                </select>
 
			</div>
			</div>
              <div class="form-group">
              <label class="control-label col-md-3">price</label>
              <div class="col-md-9">
			     <input type="text" class="form-control" name="price" id="price" placeholder="Enter Price" >
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
        var ispage;
	dtabel = $('#grouplist').DataTable({
		 "processing": true,
        "serverSide": true,
        "bStateSave": true,
        "language": {
        //"lengthMenu": "Display _MENU_ records per page",
        "emptyTable": "No Groups found!",
         },
       "sDom": "lptr<'clearfix'>p",
        //"order": [[ 4, "desc" ]],
        "PaginationType": "two_button",
        "PaginationType": "bootstrap",
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "destroy": true,
		"ajax":{
			
			"url": "<?php echo base_url('group/allGroupsData'); ?>",
            "type": "POST",
            "data": function (d) {
            $("#paginationlength").val(d.length);
			d.search_text1 = search_text1;
                },
                "dataSrc": function (jsondata) {
                    //$(".dataTables_paginate").addClass('pull-right');
                    $("#grouplist_length select").addClass('input-xs').removeClass('input-sm');
                    return jsondata['data'];
                }
			
			},
			 "columns": [
                {"title": "S.NO", "name":"sno", "orderable": false, "data":"sno", "width":"5%" },
                {"title": "Name", "name": "Name", "data": "Name", "width": "10%"},
                {"title": "CreatedOn", "name": "CreatedOn", "orderable": false,"data": "CreatedOn", "width": "10%"},
                {"title": "Status", "name": "Status", "orderable": false,"data": "Status", "width": "10%"},
                {"title": "Actions", "name": "actions", "orderable": false, "defaultContent": "", "width": "10%"},
            ],
			"fnCreatedRow": function( nRow, aData, iDataIndex) {
                 $(nRow).find('td:eq(0)').attr('data-title',"S.No");
                 $(nRow).find('td:eq(1)').attr('data-title',"Name");
                 $(nRow).find('td:eq(2)').attr('data-title',"CreatedOn");
               
             
				
             var action ='<button class="btn btn-primary btn-xs" onclick="edit_group('+aData['GroupID']+')"><span class="glyphicon glyphicon-pencil"></span></button> <button class="btn btn-danger btn-xs" onclick="delete_group('+aData['GroupID']+')"><span class="glyphicon glyphicon-trash"></span></button> <button class="btn btn-info btn-xs" onclick="status_group('+aData['GroupID']+','+aData['GroupStatus']+')" ><span class="glyphicon glyphicon-lock"></span></button>';
                    
            if(aData['Status']==1){
            	 status_text = '<span class="label label-success">Active</span>';
				 
            }
            else
            {
                status_text = '<span class="label label-danger">Inactive</span>';
				 
            }
            $(nRow).find('td:eq(4)').html(action);
            $(nRow).find('td:eq(3)').html(status_text);
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
        var table = $('#grouplist').DataTable();
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
function edit_package(id)
    {
		
     
      $('#edit_form')[0].reset(); // reset form on modals
 
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('package/packageEdit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="package_id"]').val(data.id);
            $('[name="packagename"]').val(data.name);
            $('[name="noofviews"]').val(data.views);
            $('[name="price"]').val(data.price);
            $('[name="validity"]').val(data.valid_int);
            $('#period option[value="'+data.valid_text+'"]').prop('selected', true);
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
            url : "<?php echo site_url('package/updatePackage')?>",
            type: "POST",
            data: $('#edit_form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_edit_form').modal('hide');
			   $('#update_success').show();
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
               $('#update_error').show();
            }
        });
    }
	
	
function delete_group(id)
    {
      if(confirm('Are you sure delete this group?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('group/deleteGroup')?>/"+id,
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

function status_group(id,status)
    {
		var group_id = id;
		var group_status = status;
	if(confirm('Are you sure change the status?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('group/stausChangeGroup')?>/",
            type: "POST",
			data:{id:group_id,status:group_status},
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