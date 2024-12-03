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
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script type="text/javascript">
   window.onload = function(){
        CKEDITOR.replace('newsticker');
      };
</script>
  <!-- =============================================== -->
 <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/datatables/dataTables.bootstrap.css">
 
  <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <section class="content-header">
       <h1> Newsticker Details</h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">View Newsticker</h3>
          
        </div>
	<div class="row">
        <div class="col-xs-12">
            <div class="box">
            <div class="box-body">
             <input type="hidden" id="atpagination" value="">
            <input type="hidden" id="paginationlength" value="">
              <table id="newslist" class="table table-bordered table-striped">
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
        <h3 class="modal-title">Edit Newsticker</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="edit_form" class="form-horizontal">
          <input type="hidden" value="" name="newsticker_id" id="newsticker_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label ">Newsticker</label>
             
               <textarea id="newsticker" name="newsticker" rows="50" cols="80"></textarea>
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
    var ispage;
    dtabel = $('#newslist').DataTable({
	"processing": true,
        "serverSide": true,
        "bStateSave": true,
        "language": {
        //"lengthMenu": "Display _MENU_ records per page",
        "emptyTable": "No News found!",
         },
       "sDom": "lptr<'clearfix'>p",
        //"order": [[ 4, "desc" ]],
        "PaginationType": "two_button",
        "PaginationType": "bootstrap",
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "destroy": true,
	"ajax":{
            
            "url": "<?php echo base_url('news/allNewstickerData'); ?>",
            "type": "POST",
            "data": function (d) {
                $("#paginationlength").val(d.length);
                },
            "dataSrc": function (jsondata) {
                 //$(".dataTables_paginate").addClass('pull-right');
                $("#newslist_length select").addClass('input-xs').removeClass('input-sm');
                   return jsondata['data'];
                }
			
		},
	"columns": [
                {"title": "S.NO", "name":"sno", "orderable": false, "data":"sno", "width":"5%" },
                {"title": "Description", "name": "Description", "data": "Description", "width": "50%"},
                {"title": "Status", "name": "status", "orderable": false,"data": "status", "width": "5%"},
                {"title": "Actions", "name": "actions", "orderable": false, "defaultContent": "", "width": "10%"},
            ],
	    "fnCreatedRow": function( nRow, aData, iDataIndex) {
                 $(nRow).find('td:eq(0)').attr('data-title',"S.No");
                 $(nRow).find('td:eq(1)').attr('data-title',"Description");
                 $(nRow).find('td:eq(2)').attr('data-title',"Status");
                 $(nRow).find('td:eq(3)').attr('data-title',"Actions");
             var action ='<button class="btn btn-primary btn-xs" onclick="edit_newsticker('+aData['UpdateId']+')"><span class="glyphicon glyphicon-pencil"></span></button> <button class="btn btn-info btn-xs" onclick="status_news('+aData['UpdateId']+','+aData['UpdateStatus']+')" ><span class="glyphicon glyphicon-lock"></span></button>';
                    
            if(aData['UpdateStatus']==1){
            	 status_text = '<span class="label label-success">Active</span>';
				 
            }
            else
            {
                status_text = '<span class="label label-danger">Inactive</span>';
				 
            }
            $(nRow).find('td:eq(3)').html(action);
            $(nRow).find('td:eq(2)').html(status_text);
            },
	});
		
	   
        
    function setallvalues(){
        var table = $('#newslist').DataTable();
        var info = table.page.info();
        $("#atpagination").val((info.page+1));
}

function getpagenumber(){
    return $("#atpagination").val() / $("#paginationlength").val();
}
	});
	
//edit events	
function edit_newsticker(id){
      $('#edit_form')[0].reset(); // reset form on modals
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('news/newstickerEdit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
	    $('[name="newsticker_id"]').val(data.UpdateId);
            CKEDITOR.instances['newsticker'].setData(data.UpdateDesc);
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
var news_id = $('#newsticker_id').val();
 var news = CKEDITOR.instances['newsticker'].getData();


    // ajax adding data to database
    $.ajax({
        url : "<?php echo site_url('news/updateNewsticker')?>",
        type: "POST",
        data: {news_id:news_id,news:news},
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
	

function status_news(id,status){
    var news_id = id;
    var news_status = status;
    if(confirm('Are you sure change the status?')){
       // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('news/stausChangeNewsticker')?>/",
            type: "POST",
	    data:{id:news_id,status:news_status},
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
 <!-- CK Editor -->
