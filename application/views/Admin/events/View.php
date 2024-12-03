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
        #ui-datepicker-div{
            width:420px;
            height:180px;
        }        
</style> 
  <!-- =============================================== -->
 <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/datatables/dataTables.bootstrap.css">
 
  <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <section class="content-header">
       <h1> Events Details</h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">View Events</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('events/addEvents');?>"><button type="button" class="btn btn-info">Add Events</button></a>
          </div>
        </div>
         <?php if(!empty($this->session->flashdata('events_error'))){ ?>
            <div class="alert alert-danger fade in">
    		<a href="" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong> A problem has been occurred while adding events.
		</div>
        <?php } ?>
        
         <?php if(!empty($this->session->flashdata('events_sucess'))){ ?>
           <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
               <strong>Success!</strong> events added successfully.
          </div>
        <?php } ?>
	<div class="row">
        <div class="col-xs-12">
            <div class="box">
            <div class="box-body">
            <form id="search_branch" name="search_branch" method="post">
            <div class="col-lg-2">
                <input type="text" name="search_text1" id="search_text1" placeholder="Eventname" class="input-sm form-control">
            </div>
             <button type="button" id="search_submit" class="btn btn-info margin_search" style=""><i class="fa fa-search"></i></button>
          <a class="btn btn-danger" style="display:none;" id="searchreset" href="<?php echo base_url('events'); ?>"><li class="fa fa-search-minus"></li></a>   
            
          </form>  
             <input type="hidden" id="atpagination" value="">
            <input type="hidden" id="paginationlength" value="">
              <table id="eventslist" class="table table-bordered table-striped">
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
        <h3 class="modal-title">Edit events</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="edit_form" class="form-horizontal">
          <input type="hidden" value="" name="event_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Eventname</label>
              <div class="col-md-9">
               <input type="text" class="form-control" name="eventname" id="eventname" placeholder="Enter Event name" >
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Event Date</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="eventdate" id="eventdate"  >
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Description</label>
              <div class="col-md-9">
                  <textarea  class="form-control" name="desc" id="desc" rows="5"></textarea>
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
    dtabel = $('#eventslist').DataTable({
	"processing": true,
        "serverSide": true,
        "bStateSave": true,
        "language": {
        //"lengthMenu": "Display _MENU_ records per page",
        "emptyTable": "No Events found!",
         },
       "sDom": "lptr<'clearfix'>p",
        //"order": [[ 4, "desc" ]],
        "PaginationType": "two_button",
        "PaginationType": "bootstrap",
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "destroy": true,
	"ajax":{
            
            "url": "<?php echo base_url('events/allEventsData'); ?>",
            "type": "POST",
            "data": function (d) {
                $("#paginationlength").val(d.length);
                    d.search_text1 = search_text1;
                },
            "dataSrc": function (jsondata) {
                 //$(".dataTables_paginate").addClass('pull-right');
                $("#eventslist_length select").addClass('input-xs').removeClass('input-sm');
                   return jsondata['data'];
                }
			
		},
	"columns": [
                {"title": "S.NO", "name":"sno", "orderable": false, "data":"sno", "width":"5%" },
                {"title": "Name", "name": "Name", "data": "Name", "width": "10%"},
                {"title": "Description", "name": "Description", "data": "Description", "width": "50%"},
                {"title": "EventDate", "name": "EventDate", "data": "EventDate", "width": "5%"},
                {"title": "Addedon", "name": "CreatedOn", "data": "CreatedOn", "width": "5%"},
                {"title": "Status", "name": "status", "orderable": false,"data": "status", "width": "5%"},
                {"title": "Actions", "name": "actions", "orderable": false, "defaultContent": "", "width": "10%"},
            ],
	    "fnCreatedRow": function( nRow, aData, iDataIndex) {
                 $(nRow).find('td:eq(0)').attr('data-title',"S.No");
                 $(nRow).find('td:eq(1)').attr('data-title',"Name");
                 $(nRow).find('td:eq(2)').attr('data-title',"Description");
                 $(nRow).find('td:eq(3)').attr('data-title',"EventDate");
                 $(nRow).find('td:eq(4)').attr('data-title',"Addedon");
		 $(nRow).find('td:eq(5)').attr('data-title',"Status");
                 $(nRow).find('td:eq(6)').attr('data-title',"Actions");
				
             var action ='<button class="btn btn-primary btn-xs" onclick="edit_events('+aData['EventID']+')"><span class="glyphicon glyphicon-pencil"></span></button> <button class="btn btn-danger btn-xs" onclick="delete_events('+aData['EventID']+')"><span class="glyphicon glyphicon-trash"></span></button> <button class="btn btn-info btn-xs" onclick="status_events('+aData['EventID']+','+aData['status']+')" ><span class="glyphicon glyphicon-lock"></span></button>';
                    
            if(aData['status']==1){
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
        var table = $('#eventslist').DataTable();
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
	
//edit events	
function edit_events(id){
      $('#edit_form')[0].reset(); // reset form on modals
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('events/eventEdit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
	    $('[name="event_id"]').val(data.EventID);
            $('[name="eventname"]').val(data.Name);
            $('[name="eventdate"]').val(data.EventDate);
            $('[name="desc"]').val(data.Description);
            $('#modal_edit_form').modal('show'); // show bootstrap modal when complete loaded
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }
 	
//update Events
 function update() {
    // ajax adding data to database
    $.ajax({
        url : "<?php echo site_url('events/updateEvents')?>",
        type: "POST",
        data: $('#edit_form').serialize(),
        dataType: "JSON",
        success: function(data){
           //if success close modal and reload ajax table
            $('#modal_edit_form').modal('hide');
	    $('#update_success').show();
            location.reload();// for reload a page
        },
        error: function (jqXHR, textStatus, errorThrown){
             $('#update_error').show();
        }
        });
    }
function delete_events(id){
    if(confirm('Are you sure delete this events?')){
        // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('events/deleteEvents')?>/"+id,
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

function status_events(id,status){
    var event_id = id;
    var event_status = status;
    if(confirm('Are you sure change the status?')){
       // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('events/stausChangeEvent')?>/",
            type: "POST",
	    data:{id:event_id,status:event_status},
            dataType: "JSON",
            success: function(data){
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown){
              alert('Error changing status');
            }
        });
      }
    }	

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