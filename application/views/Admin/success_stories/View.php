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
       <h1> Success Stories Details</h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">View Success Stories</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('success_stories/addStories');?>"><button type="button" class="btn btn-info">Add Success Stories</button></a>
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
          <a class="btn btn-danger" style="display:none;" id="searchreset" href="<?php echo base_url('success_stories'); ?>"><li class="fa fa-search-minus"></li></a>   
            
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
        <h3 class="modal-title">Edit Success Stories</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="edit_form" class="form-horizontal">
          <input type="hidden" value="" name="storie_id" id="storie_id"/>
          <div class="form-body">
             <div class="form-group">
               <label class="control-label col-md-3">Couple Name</label>
               <div class="col-md-9">
               <input type="text" id="couplename" name="couplename" class="form-control">
               </div>
              </div>
               <div class="form-group">
              <label class="control-label col-md-3">image</label>
              <div class="col-md-9">
                <img id="my_image" src="" style="height:150px;width:150px"/>
                <input type="file"  name="image" id="image">
                <input type="hidden" name="oldimage" id="oldimage" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label ">Description</label>
               <textarea id="desc" name="desc" rows="50" cols="80"></textarea>
              </div>
            </div>
          <div class="form-group">
              <label class="control-label ">Married Date</label>
               <input type="text" id="marriedate" name="marriedate" class="form-control">
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
        "emptyTable": "No Success stories found!",
         },
       "sDom": "lptr<'clearfix'>p",
        //"order": [[ 4, "desc" ]],
        "PaginationType": "two_button",
        "PaginationType": "bootstrap",
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "destroy": true,
	"ajax":{
            "url": "<?php echo base_url('success_stories/allSuccessData'); ?>",
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
                {"title": "CoupleName", "name": "CoupleName", "data": "CoupleName", "width": "15%"},
                {"title": "Image", "name": "Image", "orderable": false, "data": "Image", "width": "10%"},
                {"title": "Description", "name": "Description", "data": "Description", "width": "15%"},
                {"title": "MarriedDate", "name": "MarriedDate", "data": "MarriedDate", "width": "15%"},
                {"title": "Status", "name": "Status", "orderable": false,"data": "Status", "width": "5%"},
                {"title": "Actions", "name": "actions", "orderable": false, "defaultContent": "", "width": "10%"},
            ],
	    "fnCreatedRow": function( nRow, aData, iDataIndex) {
                 $(nRow).find('td:eq(0)').attr('data-title',"S.No");
                 $(nRow).find('td:eq(1)').attr('data-title',"Name");
                 $(nRow).find('td:eq(2)').attr('data-title',"Image");
                 $(nRow).find('td:eq(3)').attr('data-title',"Description");
                 $(nRow).find('td:eq(4)').attr('data-title',"MarriedDate");
                 $(nRow).find('td:eq(5)').attr('data-title',"Status");
                 $(nRow).find('td:eq(6)').attr('data-title',"Actions");
             var action ='<button class="btn btn-primary btn-xs" onclick="edit_stories('+aData['Story_ID']+')"><span class="glyphicon glyphicon-pencil"></span></button> <button class="btn btn-danger btn-xs" onclick="delete_stories('+aData['Story_ID']+')"><span class="glyphicon glyphicon-trash"></span></button> <button class="btn btn-info btn-xs" onclick="status_stories('+aData['Story_ID']+','+aData['Story_Status']+')" ><span class="glyphicon glyphicon-lock"></span></button>';
            if(aData['Story_Status']==1){
            	 status_text = '<span class="label label-success">Active</span>';
            }
            else
            {
                status_text = '<span class="label label-danger">Inactive</span>';
				 
            }
            var image = '<img src="<?php echo base_url();?>uploads/stories/'+aData['Image']+'" style="width:100px;height:100px">';
            $(nRow).find('td:eq(2)').html(image);
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
function edit_stories(id){
      $('#edit_form')[0].reset(); // reset form on modals
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('success_stories/storieEdit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
	    $('[name="storie_id"]').val(data.Story_ID);
            $('[name="couplename"]').val(data.Couple_Name);
            var pic = "<?php echo base_url();?>uploads/stories/"+data.Image;
	    $("#my_image").attr("src",pic);
	    $('[name="oldimage"]').val(data.Image);
            CKEDITOR.instances['desc'].setData(data.Description);
            var MarriedOn = data.MarriedOn;
            var mdate =$.datepicker.formatDate( "d-mm-yy", new Date(MarriedOn));
             $('[name="marriedate"]').val(mdate);
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
        url : "<?php echo site_url('success_stories/updateStories')?>",
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
function delete_stories(id){
    if(confirm('Are you sure delete this Stories?')){
        // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('success_stories/deleteStories')?>/"+id,
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

function status_stories(id,status){
    var storie_id = id;
    var storie_status= status;
    if(confirm('Are you sure change the status?')){
       // ajax delete data from database
        $.ajax({
            url : "<?php echo site_url('success_stories/stausChangeStories')?>/",
            type: "POST",
	    data:{id:storie_id,status:storie_status},
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
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
        CKEDITOR.replace('desc');
        $('#marriedate').datepicker( {
		showOn: "button",
                buttonImage: "https://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
                buttonImageOnly: true,
		changeMonth: true,
                changeYear: true,
                dateFormat: 'dd-mm-yy'
        });
      });
</script>