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
       <h1> Faqs Details</h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">View Faqs</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('faqs/addFaqs');?>"><button type="button" class="btn btn-info">Add Faqs</button></a>
          </div>
        </div>
         <?php if(!empty($this->session->flashdata('faq_error'))){ ?>
            <div class="alert alert-danger fade in">
    		<a href="" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong> A problem has been occurred while adding Faqs.
		</div>
        <?php } ?>
        
         <?php if(!empty($this->session->flashdata('faq_sucess'))){ ?>
           <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
               <strong>Success!</strong> Faq added successfully.
          </div>
        <?php } ?>
	<div class="row">
        <div class="col-xs-12">
            <div class="box">
            <div class="box-body">
             <input type="hidden" id="atpagination" value="">
            <input type="hidden" id="paginationlength" value="">
              <table id="faqlist" class="table table-bordered table-striped">
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
        <h3 class="modal-title">Edit Faqs</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="edit_form" class="form-horizontal">
          <input type="hidden" value="" name="faq_id" id="faq_id"/>
          <div class="form-body">
             <div class="form-group">
               <label class="control-label col-md-3">Question</label>
               <div class="col-md-9">
               <input type="text" id="question" name="question" class="form-control">
               </div>
              </div>
            <div class="form-group">
              <label class="control-label ">Answer</label>
               <textarea id="answer" name="answer" rows="50" cols="80"></textarea>
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
    var dtabel;
$(document).ready(function(){
    var ispage;
    dtabel = $('#faqlist').DataTable({
	"processing": true,
        "serverSide": true,
        "bStateSave": true,
        "language": {
        //"lengthMenu": "Display _MENU_ records per page",
        "emptyTable": "No Faqs found!",
         },
       "sDom": "lptr<'clearfix'>p",
        //"order": [[ 4, "desc" ]],
        "PaginationType": "two_button",
        "PaginationType": "bootstrap",
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "destroy": true,
	"ajax":{
            "url": "<?php echo base_url('faqs/allFaqData'); ?>",
            "type": "POST",
            "data": function (d) {
                $("#paginationlength").val(d.length);
                },
            "dataSrc": function (jsondata) {
                 //$(".dataTables_paginate").addClass('pull-right');
                $("#faqlist_length select").addClass('input-xs').removeClass('input-sm');
                   return jsondata['data'];
                }
			
		},
	"columns": [
                {"title": "S.NO", "name":"sno", "orderable": false, "data":"sno", "width":"5%" },
                {"title": "FaqQuestion", "name": "FaqQuestion", "data": "FaqQuestion", "width": "15%"},
                {"title": "FaqAnswer", "name": "FaqAnswer", "data": "FaqAnswer", "width": "15%"},
                {"title": "Status", "name": "status", "orderable": false,"data": "Status", "width": "5%"},
                {"title": "Actions", "name": "actions", "orderable": false, "defaultContent": "", "width": "10%"},
            ],
	    "fnCreatedRow": function( nRow, aData, iDataIndex) {
                 $(nRow).find('td:eq(0)').attr('data-title',"S.No");
                 $(nRow).find('td:eq(1)').attr('data-title',"FaqQuestion");
                 $(nRow).find('td:eq(2)').attr('data-title',"FaqAnswer");
                 $(nRow).find('td:eq(3)').attr('data-title',"Status");
                 $(nRow).find('td:eq(4)').attr('data-title',"Actions");
             var action ='<button class="btn btn-primary btn-xs" onclick="edit_faq('+aData['FaqId']+')"><span class="glyphicon glyphicon-pencil"></span></button> <button class="btn btn-danger btn-xs" onclick="delete_faq('+aData['FaqId']+')"><span class="glyphicon glyphicon-trash"></span></button> <button class="btn btn-info btn-xs" onclick="status_faq('+aData['FaqId']+','+aData['FaqStatus']+')" ><span class="glyphicon glyphicon-lock"></span></button>';
            if(aData['FaqStatus']==1){
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
		
	   
        
    function setallvalues(){
        var table = $('#faqlist').DataTable();
        var info = table.page.info();
        $("#atpagination").val((info.page+1));
}

function getpagenumber(){
    return $("#atpagination").val() / $("#paginationlength").val();
}
	});
	
//edit faq	
function edit_faq(id){
      $('#edit_form')[0].reset(); // reset form on modals
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('faqs/faqEdit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
	    $('[name="faq_id"]').val(data.FaqId);
            $('[name="question"]').val(data.FaqQuestion	);
            CKEDITOR.instances['answer'].setData(data.FaqAnswer);
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
var faq_id = $('#faq_id').val();
var question = $('#question').val();
var answer = CKEDITOR.instances['answer'].getData();


    // ajax adding data to database
    $.ajax({
        url : "<?php echo site_url('faqs/updateFaq')?>",
        type: "POST",
        data: {faq_id:faq_id,question:question,answer:answer},
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
function delete_faq(id){
    if(confirm('Are you sure delete this Terms?')){
        // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('faqs/deleteFaq')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                alert("Dleted successfully");
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

      }
    }	

function status_faq(id,status){

    var faq_id = id;
    var faq_status= status;
    if(confirm('Are you sure change the status?')){
       // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('faqs/stausChangeFaq')?>/",
            type: "POST",
	    data:{id:faq_id,status:faq_status},
            dataType: "JSON",
            success: function(data){
                alert("status cahnged successfully");
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
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
        CKEDITOR.replace('answer');
        
      });
</script>