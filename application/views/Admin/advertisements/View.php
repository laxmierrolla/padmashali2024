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
 <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/datatables/dataTables.bootstrap.css">
 
  <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <section class="content-header">
       <h1> Advertisement Details</h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">View Advertisements</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('advertisement/addAdvertisemts');?>"><button type="button" class="btn btn-info">Add Advertisements</button></a>
          </div>
        </div>
         <?php if(!empty($this->session->flashdata('adds_error'))){ ?>
            <div class="alert alert-danger fade in">
    		<a href="" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong> A problem has been occurred while adding Advertisements.
		</div>
        <?php } ?>
        
         <?php if(!empty($this->session->flashdata('adds_sucess'))){ ?>
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
          <a class="btn btn-danger" style="display:none;" id="searchreset" href="<?php echo base_url('advertisement'); ?>"><li class="fa fa-search-minus"></li></a>   
            
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
        <h3 class="modal-title">Edit Advertisements</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="edit_form" class="form-horizontal">
          <input type="hidden" value="" name="add_id" id="add_id"/>
          <div class="form-body">
             <div class="form-group">
               <label class="control-label col-md-3">Select Page</label>
               <div class="col-md-9">
                   <select  id="selectpage" name="selectpage" class="form-control" required>
                       <option value="">Choose page</option>
                       <option value="aboutus">About</option>
                       <option value="services">Services</option>
                        <option value="success">Success Stories</option>
                   </select>
               </div>
              </div>
               <div class="form-group">
              <label class="control-label col-md-3">Advertisement Image*</label>
              <div class="col-md-9">
                <img id="my_image" src="" style="height:150px;width:150px"/>
                <input type="file"  name="image" id="image" onchange="imagevalidate(this.value);">
                <input type="hidden" name="oldimage" id="oldimage" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label ">Web link</label>
                <input type="text"  name="link" id="link">
              </div>
            </div>
         
        </form>
          </div>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave"  class="btn btn-primary" onclick="update()">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
   <!-- /.modal -->
  <!-- End Bootstrap modal -->
 

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
        "emptyTable": "No Advertisements found!",
         },
       "sDom": "lptr<'clearfix'>p",
        //"order": [[ 4, "desc" ]],
        "PaginationType": "two_button",
        "PaginationType": "bootstrap",
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "destroy": true,
	"ajax":{
            "url": "<?php echo base_url('advertisement/allData'); ?>",
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
                {"title": "Page", "name": "Page", "data": "Page", "width": "15%"},
                {"title": "Image", "name": "Image", "orderable": false, "data": "Image", "width": "10%"},
                {"title": "Link", "name": "Link", "data": "Link", "width": "15%"},
                {"title": "Status", "name": "Status", "orderable": false,"data": "Status", "width": "5%"},
                {"title": "Actions", "name": "actions", "orderable": false, "defaultContent": "", "width": "10%"},
            ],
	    "fnCreatedRow": function( nRow, aData, iDataIndex) {
                 $(nRow).find('td:eq(0)').attr('data-title',"S.No");
                 $(nRow).find('td:eq(1)').attr('data-title',"Page");
                 $(nRow).find('td:eq(2)').attr('data-title',"Image");
                 $(nRow).find('td:eq(3)').attr('data-title',"Link");
                 $(nRow).find('td:eq(4)').attr('data-title',"Status");
                 $(nRow).find('td:eq(5)').attr('data-title',"Actions");
             var action ='<button class="btn btn-primary btn-xs" onclick="edit_adds('+aData['AddId']+')"><span class="glyphicon glyphicon-pencil"></span></button> <button class="btn btn-danger btn-xs" onclick="delete_adds('+aData['AddId']+')"><span class="glyphicon glyphicon-trash"></span></button> <button class="btn btn-info btn-xs" onclick="status_adds('+aData['AddId']+','+aData['AddStatus']+')" ><span class="glyphicon glyphicon-lock"></span></button>';
            if(aData['AddStatus']==1){
            	 status_text = '<span class="label label-success">Active</span>';
            }
            else
            {
                status_text = '<span class="label label-danger">Inactive</span>';
				 
            }
            var image = '<img src="<?php echo base_url();?>uploads/advertaisement/'+aData['Image']+'" style="width:100px;height:100px">';
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
function edit_adds(id){
      $('#edit_form')[0].reset(); // reset form on modals
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('advertisement/addEdit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
	    $('[name="add_id"]').val(data.AddId);
             $('#selectpage option[value="'+data.AddPage+'"]').prop('selected', true);
            var pic = "<?php echo base_url();?>uploads/advertaisement/"+data.AddImage;
	    $("#my_image").attr("src",pic);
	    $('[name="oldimage"]').val(data.AddImage);
            $('[name="link"]').val(data.AddWebLink);
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
var form = $('#edit_form')[0];
var formData = new FormData(form);

    // ajax adding data to database
    $.ajax({
        url : "<?php echo site_url('advertisement/updateAdds')?>",
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
function delete_adds(id){
    if(confirm('Are you sure delete this Advertisement?')){
        // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('advertisement/deleteAdd')?>/"+id,
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

function status_adds(id,status){
    var add_id = id;
    var add_status= status;
    if(confirm('Are you sure change the status?')){
       // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('advertisement/stausChangeAdds')?>/",
            type: "POST",
	    data:{id:add_id,status:add_status},
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
function imagevalidate(file) {
    var ext = file.split(".");
    ext = ext[ext.length-1].toLowerCase();      
    var arrayExtensions = ["jpg" , "jpeg", "png"];
    if (arrayExtensions.lastIndexOf(ext) == -1) {
        alert("allows Only jpeg png jpg");
        
    }
}
</script>
