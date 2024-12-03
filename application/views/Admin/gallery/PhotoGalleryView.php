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
       <h1> Photo Gallery Details</h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">View Photo gallery</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('gallery/addPhotoGallery');?>"><button type="button" class="btn btn-info">Add Photo gallery</button></a>
          </div>
          
        </div>
         <?php if(!empty($this->session->flashdata('photogallery_error'))){ ?>
            <div class="alert alert-danger fade in">
    			<a href="" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong> A problem has been occurred while adding Photo gallery.
		</div>
        <?php } ?>
        
         <?php if(!empty($this->session->flashdata('photogallery_sucess'))){ ?>
           <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
               <strong>Success!</strong> photo gallery  added successfully.
          </div>
        <?php } ?>
		<div class="row">
        <div class="col-xs-12">
        	<div class="box">
            <div class="box-body">
            <form id="search_branch" name="search_branch" method="post">
            <div class="col-lg-2">
                <input type="text" name="search_text1" id="search_text1" placeholder="PhotoGalleryName" class="input-sm form-control">
            </div>
             <button type="button" id="search_submit" class="btn btn-info margin_search" style=""><i class="fa fa-search"></i></button>
          <a class="btn btn-danger" style="display:none;" id="searchreset" href="<?php echo base_url('gallery'); ?>"><li class="fa fa-search-minus"></li></a>   
            
          </form>  
             <input type="hidden" id="atpagination" value="">
            <input type="hidden" id="paginationlength" value="">
              <table id="photogallerylist" class="table table-bordered table-striped">
             
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
        <h3 class="modal-title">Edit Gallery</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="edit_form" class="form-horizontal" >
          <input type="hidden" value="" name="pgal_id"/>
          <div class="form-body">
            
          <div class="form-group">
              <label class="control-label col-md-3">Gallery Name</label>
              <div class="col-md-9">
               <select name="galname" id="galname" class="form-control">
                	<option value="">slect gallery name</option>
                    <?php if(isset($gallery)){
						foreach($gallery as $value){?>
                        <option value="<?php echo $value->Gid;?>"><?php echo $value->GName;?></option>
                        <?php }}?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3"> Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="name" id="name"   placeholder="Enter Name">
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
              <label class="control-label col-md-3">Description</label>
              <div class="col-md-9">
               <textarea class="form-control" name="desc" id="desc" placeholder="Enter Description" ></textarea>
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
	dtabel = $('#photogallerylist').DataTable({
		 "processing": true,
        "serverSide": true,
        "bStateSave": true,
        "language": {
        //"lengthMenu": "Display _MENU_ records per page",
        "emptyTable": "No gallery found!",
         },
       "sDom": "lptr<'clearfix'>p",
        //"order": [[ 4, "desc" ]],
        "PaginationType": "two_button",
        "PaginationType": "bootstrap",
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "destroy": true,
		"ajax":{
			
			"url": "<?php echo base_url('gallery/allPhotoGalleryData'); ?>",
            "type": "POST",
            "data": function (d) {
            $("#paginationlength").val(d.length);
			d.search_text1 = search_text1;
                },
                "dataSrc": function (jsondata) {
                    //$(".dataTables_paginate").addClass('pull-right');
                    $("#photogallerylist_length select").addClass('input-xs').removeClass('input-sm');
                    return jsondata['data'];
                }
			
			},
			 "columns": [
                {"title": "S.NO", "name":"sno", "orderable": false, "data":"sno", "width":"5%" },
                {"title": "Gallery Name", "name": "groupname", "data": "groupname", "width": "15%"},
				{"title": "Name", "name": "name", "data": "name", "width": "15%"},
				{"title": "Image", "name": "image", "defaultContent": "", "orderable": false,"width": "15%"},
				{"title": "Description", "name": "description", "data": "description", "width": "15%"},
                {"title": "Status", "name": "status", "orderable": false,"data": "Status", "width": "10%"},
                {"title": "Actions", "name": "actions", "orderable": false, "defaultContent": "", "width": "10%"},
            ],
			"fnCreatedRow": function( nRow, aData, iDataIndex) {
                 $(nRow).find('td:eq(0)').attr('data-title',"S.No");
                 $(nRow).find('td:eq(1)').attr('data-title',"Gallery Name");
				 $(nRow).find('td:eq(2)').attr('data-title',"Name");
				 $(nRow).find('td:eq(4)').attr('data-title',"Description");
                
             var action ='<button class="btn btn-primary btn-xs" onclick="edit_pgallery('+aData['id']+')"><span class="glyphicon glyphicon-pencil"></span></button> <button class="btn btn-danger btn-xs" onclick="delete_pgallery('+aData['id']+')"><span class="glyphicon glyphicon-trash"></span></button> <button class="btn btn-info btn-xs" onclick="status_pgallery('+aData['id']+','+aData['status']+')" ><span class="glyphicon glyphicon-lock"></span></button>';
                    
            if(aData['Status']==1){
            	 status_text = '<span class="label label-success">Active</span>';
				 
            }
            else
            {
                status_text = '<span class="label label-danger">Inactive</span>';
				 
            }
			
			var image = '<img src="<?php echo base_url();?>uploads/gallery/'+aData['image']+'" style="width:200px;height:120px">';
            $(nRow).find('td:eq(3)').html(image);
            $(nRow).find('td:eq(5)').html(status_text);
			$(nRow).find('td:eq(6)').html(action);
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
        var table = $('#photogallerylist').DataTable();
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
function edit_pgallery(id)
    {
		
     
      $('#edit_form')[0].reset(); // reset form on modals
 
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('gallery/pgalleryEdit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="pgal_id"]').val(data.id);
             $('#galname option[value="'+data.gnameid+'"]').prop('selected', true);
			 $('[name="name"]').val(data.name);
			 var pic = "<?php echo base_url();?>uploads/gallery/"+data.image;
			 $("#my_image").attr("src",pic);
			 $('[name="oldimage"]').val(data.image);
			 $('[name="desc"]').val(data.description);
            $('#modal_edit_form').modal('show'); // show bootstrap modal when complete loaded
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }
 	
//update package
 function update(){
var form = $('#edit_form')[0];
 var formData = new FormData(form);

 
       // ajax adding data to database
          $.ajax({
            url : "<?php echo site_url('gallery/updatePGallery')?>",
            type: "POST",
	    enctype: 'multart/form-data',
            data: formData,
	    cache:false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_edit_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
               alert("photogallery not updated");
            }
        });
    }
	
	
function delete_pgallery(id)
    {
		
      if(confirm('Are you sure delete this image?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('gallery/deletePhotoGallery')?>/"+id,
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

function status_pgallery(id,status)
    {
		var pgal_id = id;
		var pgal_status = status;
	if(confirm('Are you sure change the status?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('gallery/stausChangePhotoGallery')?>/",
            type: "POST",
			data:{id:pgal_id,status:pgal_status},
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