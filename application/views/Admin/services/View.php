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
       <h1> Service Details</h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">View Services</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('service/addService');?>"><button type="button" class="btn btn-info">Add Services</button></a>
          </div>
        </div>
         <?php if(!empty($this->session->flashdata('service_error'))){ ?>
            <div class="alert alert-danger fade in">
    		<a href="" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong> A problem has been occurred while adding Services.
		</div>
        <?php } ?>
        
         <?php if(!empty($this->session->flashdata('service_sucess'))){ ?>
           <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
               <strong>Success!</strong> service added successfully.
          </div>
        <?php } ?>
         <?php if(!empty($this->session->set_flashdata('photo_insert'))){ ?>
            <div class="alert alert-danger fade in">
    		<a href="" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong> A problem has been occurred while adding  photo.
		</div>
        <?php } ?>
        
        <?php if(!empty($this->session->set_flashdata('photos_error'))){ ?>
            <div class="alert alert-danger fade in">
    		<a href="" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong> A problem has been occurred while upadting photoin  Services.
	    </div>
        <?php } ?>
        
	<div class="row">
        <div class="col-xs-12">
            <div class="box">
            <div class="box-body">
          <form id="search_branch" name="search_branch" method="post">
            <div class="col-lg-2">
                <input type="text" name="search_text1" id="search_text1" class="input-sm form-control" placeholder="Enter Name">
            </div>
             <button type="button" id="search_submit" class="btn btn-info margin_search" style=""><i class="fa fa-search"></i></button>
          <a class="btn btn-danger" style="display:none;" id="searchreset" href="<?php echo base_url('service'); ?>"><li class="fa fa-search-minus"></li></a>   
            
          </form>  
             <input type="hidden" id="atpagination" value="">
            <input type="hidden" id="paginationlength" value="">
              <table id="servicelist" class="table table-bordered table-striped">
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
        <h3 class="modal-title">Edit service</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="edit_form" class="form-horizontal">
          <input type="hidden" value="" name="service_id" id="service_id"/>
          <div class="form-body">
             <div class="form-group">
               <label class="control-label col-md-3">Name</label>
               <div class="col-md-9">
               <input type="text" id="name" name="name" class="form-control">
               </div>
              </div>
               <div class="form-group">
              <label class="control-label col-md-3">image</label>
              <div class="col-md-9">
                <img id="my_image" src="" style="height:150px;width:150px"/>
                <input type="file"  name="image" id="image" >
                <input type="hidden" name="oldimage" id="oldimage" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label ">Description</label>
               <textarea id="desc" name="desc" rows="50" cols="80"></textarea>
              </div>
            </div>
        </form>
          </div>
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
     var search_text1;
    dtabel = $('#servicelist').DataTable({
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
            "url": "<?php echo base_url('service/allServicesData'); ?>",
            "type": "POST",
            "data": function (d) {
                $("#paginationlength").val(d.length);
                d.search_text1 = search_text1;
                },
            "dataSrc": function (jsondata) {
                 //$(".dataTables_paginate").addClass('pull-right');
                $("#servicelist_length select").addClass('input-xs').removeClass('input-sm');
                   return jsondata['data'];
                }
			
		},
	"columns": [
                {"title": "S.NO", "name":"sno", "orderable": false, "data":"sno", "width":"5%" },
                {"title": "Name", "name": "Name", "data": "Name", "width": "15%"},
                {"title": "Image", "name": "Image", "orderable": false, "data": "Image", "width": "10%"},
                {"title": "Description", "name": "Description", "data": "Description", "width": "15%"},
                {"title": "Status", "name": "Status", "orderable": false,"data": "Status", "width": "5%"},
                {"title": "Actions", "name": "actions", "orderable": false, "defaultContent": "", "width": "10%"},
            ],
	    "fnCreatedRow": function( nRow, aData, iDataIndex) {
                 $(nRow).find('td:eq(0)').attr('data-title',"S.No");
                 $(nRow).find('td:eq(1)').attr('data-title',"Name");
                 $(nRow).find('td:eq(2)').attr('data-title',"Image");
                 $(nRow).find('td:eq(3)').attr('data-title',"Description");
                 $(nRow).find('td:eq(4)').attr('data-title',"Status");
                 $(nRow).find('td:eq(5)').attr('data-title',"Actions");
             var action ='<button class="btn btn-primary btn-xs" onclick="edit_service('+aData['ServiceID']+')"><span class="glyphicon glyphicon-pencil"></span></button> <button class="btn btn-danger btn-xs" onclick="delete_service('+aData['ServiceID']+')"><span class="glyphicon glyphicon-trash"></span></button> <button class="btn btn-info btn-xs" onclick="status_service('+aData['ServiceID']+','+aData['PromotionStatus']+')" ><span class="glyphicon glyphicon-lock"></span></button>';
            if(aData['PromotionStatus']==1){
            	 status_text = '<span class="label label-success">Active</span>';
            }
            else
            {
                status_text = '<span class="label label-danger">Inactive</span>';
				 
            }
            var image = '<img src="<?php echo base_url();?>uploads/services/'+aData['Image']+'" style="width:100px;height:100px">';
            $(nRow).find('td:eq(2)').html(image);
            $(nRow).find('td:eq(5)').html(action);
            $(nRow).find('td:eq(4)').html(status_text);
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
        var table = $('#servicelist').DataTable();
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
	
//edit faq	
function edit_service(id){
      $('#edit_form')[0].reset(); // reset form on modals
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('service/serviceEdit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
	    $('[name="service_id"]').val(data.ServiceID);
            $('[name="name"]').val(data.Name);
            var pic = "<?php echo base_url();?>uploads/services/"+data.Image;
	    $("#my_image").attr("src",pic);
	    $('[name="oldimage"]').val(data.Image);
            CKEDITOR.instances['desc'].setData(data.Description);
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
 for (instance in CKEDITOR.instances) {
        CKEDITOR.instances['desc'].updateElement();
    }
var form = $('#edit_form')[0];
var formData = new FormData(form);

    // ajax adding data to database
    $.ajax({
        url : "<?php echo site_url('service/updateServices')?>",
        type: "POST",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
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
function delete_service(id){
    if(confirm('Are you sure delete this Terms?')){
        // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('service/deleteServices')?>/"+id,
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

function status_service(id,status){
    var service_id = id;
    var service_status= status;
    if(confirm('Are you sure change the status?')){
       // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('service/stausChangeServices')?>/",
            type: "POST",
	    data:{id:service_id,status:service_status},
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
        CKEDITOR.replace('desc');
        
      });
</script>