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
       <h1> State Details</h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">View Sates</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('state/addState');?>"><button type="button" class="btn btn-info">Add States</button></a>
          </div>
          
        </div>
         <?php if(!empty($this->session->flashdata('state_error'))){ ?>
            <div class="alert alert-danger fade in">
    			<a href="" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong> A problem has been occurred while adding state.
		</div>
        <?php } ?>
        
         <?php if(!empty($this->session->flashdata('state_sucess'))){ ?>
           <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
               <strong>Success!</strong> State added successfully.
          </div>
        <?php } ?>
		<div class="row">
        <div class="col-xs-12">
        	<div class="box">
            <div class="box-body">
            <form id="search_accounts" name="search_accounts" method="post">
            <div class="col-lg-3 col-sm-12 margin_select mar5 pd-right">
              <select name="search_on_1" id="search_on_1" class="input-sm form-control custom-input">
               <option value="1">Countryname</option>
               <option value="2">Statename</option>
              </select>
            </div>
            <div class="col-lg-2">
                <input type="text" name="search_text1" id="search_text1" class="input-sm form-control" placeholder="Enter Keyword">
            </div>
             <button type="button" id="search_submit" class="btn btn-info margin_search" style=""><i class="fa fa-search"></i></button>
          <a class="btn btn-danger" style="display:none;" id="searchreset" href="<?php echo base_url('admin/state'); ?>"><li class="fa fa-search-minus"></li></a>   
            
          </form>   
             <input type="hidden" id="atpagination" value="">
            <input type="hidden" id="paginationlength" value="">
              <table id="statelist" class="table table-bordered table-striped">
             
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
        <h3 class="modal-title">Edit State</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="edit_form" class="form-horizontal">
          <input type="hidden" value="" name="state_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Country Name</label>
              <div class="col-md-9">
              <select id="countryname" name="countryname">
              <option value="">select country</option>
              <?php if($countries){
				  foreach($countries as $value){?>
					  <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
					<?php }
				  }?>
              </select>
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-md-3">State name</label>
              <div class="col-md-9">
               <input type="text" class="form-control" name="statename" id="statename" placeholder="Enter state name" >
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
	    var search_on_1;
        var search_text1;
        var ispage;
	dtabel = $('#statelist').DataTable({
		 "processing": true,
        "serverSide": true,
        "bStateSave": true,
        "language": {
        //"lengthMenu": "Display _MENU_ records per page",
        "emptyTable": "No States found!",
         },
       "sDom": "lptr<'clearfix'>p",
        //"order": [[ 4, "desc" ]],
        "PaginationType": "two_button",
        "PaginationType": "bootstrap",
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "destroy": true,
		"ajax":{
			
			"url": "<?php echo base_url('state/allStatesData'); ?>",
            "type": "POST",
            "data": function (d) {
            $("#paginationlength").val(d.length);
			d.search_text1 = search_text1;
			d.search_on_1 = search_on_1;
                },
                "dataSrc": function (jsondata) {
                    //$(".dataTables_paginate").addClass('pull-right');
                    $("#statelist_length select").addClass('input-xs').removeClass('input-sm');
                    return jsondata['data'];
                }
			
			},
			 "columns": [
                {"title": "S.NO", "name":"sno", "orderable": false, "data":"sno", "width":"5%" },
				{"title": "State Id", "name":"sid",  "data":"sid", "width":"5%" },
                {"title": "state Name", "name": "StateName", "data": "StateName", "width": "15%"},
				{"title": "Country Name", "name": "CountryName", "data": "CountryName", "width": "15%"},
                {"title": "Actions", "name": "actions", "orderable": false, "defaultContent": "", "width": "10%"},
            ],
			"fnCreatedRow": function( nRow, aData, iDataIndex) {
                 $(nRow).find('td:eq(0)').attr('data-title',"S.No");
                 $(nRow).find('td:eq(1)').attr('data-title',"State Id");
				 $(nRow).find('td:eq(2)').attr('data-title',"State Name");
				 $(nRow).find('td:eq(3)').attr('data-title',"Country Name");
                
             var action ='<button class="btn btn-primary btn-xs" onclick="edit_state('+aData['id']+')"><span class="glyphicon glyphicon-pencil"></span></button> <button class="btn btn-danger btn-xs" onclick="delete_state('+aData['id']+')"><span class="glyphicon glyphicon-trash"></span></button>';
          
            $(nRow).find('td:eq(4)').html(action);
           
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
        var table = $('#statelist').DataTable();
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
function edit_state(id)
    {
		
     
      $('#edit_form')[0].reset(); // reset form on modals
 
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('state/stateEdit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="state_id"]').val(data.id);
			$('#countryname option[value="'+data.country_id+'"]').prop('selected',true);
            $('[name="statename"]').val(data.name);
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
            url : "<?php echo site_url('state/updateState')?>",
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
               alert("country not updated");
            }
        });
    }

function delete_state(id)
    {
		
      if(confirm('Are you sure delete this package?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('state/deleteStates')?>/"+id,
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

</script>