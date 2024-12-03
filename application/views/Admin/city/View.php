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
       <h1> City Details</h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">View Cities</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('cities/addCity');?>"><button type="button" class="btn btn-info">Add City</button></a>
          </div>
          
        </div>
         <?php if(!empty($this->session->flashdata('city_error'))){ ?>
            <div class="alert alert-danger fade in">
    			<a href="" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong> A problem has been occurred while adding city.
		</div>
        <?php } ?>
        
         <?php if(!empty($this->session->flashdata('City_sucess'))){ ?>
           <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
               <strong>Success!</strong> City added successfully.
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
               <option value="3">Cityname</option>
              </select>
            </div>
            <div class="col-lg-2">
                <input type="text" name="search_text1" id="search_text1" class="input-sm form-control" placeholder="Enter Keyword">
            </div>
             <button type="button" id="search_submit" class="btn btn-info margin_search" style=""><i class="fa fa-search"></i></button>
          <a class="btn btn-danger" style="display:none;" id="searchreset" href="<?php echo base_url('cities'); ?>"><li class="fa fa-search-minus"></li></a>   
            
          </form>   
             <input type="hidden" id="atpagination" value="">
            <input type="hidden" id="paginationlength" value="">
              <table id="citylist" class="table table-bordered table-striped">
             
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
          <input type="hidden" value="" name="city_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Country Name</label>
              <div class="col-md-9">
              <select id="countryname" name="countryname" class="form-control">
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
              <label class="control-label col-md-3">Sate Name</label>
              <div class="col-md-9">
              <select id="statename" name="statename" class="form-control">
              <option value="">select state</option>
              </select>
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-md-3">City name</label>
              <div class="col-md-9">
               <input type="text" class="form-control" name="cityname" id="cityname" placeholder="Enter city name" >
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
	dtabel = $('#citylist').DataTable({
		 "processing": true,
        "serverSide": true,
        "bStateSave": true,
        "language": {
        //"lengthMenu": "Display _MENU_ records per page",
        "emptyTable": "No Cities found!",
         },
       "sDom": "lptr<'clearfix'>p",
        //"order": [[ 4, "desc" ]],
        "PaginationType": "two_button",
        "PaginationType": "bootstrap",
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "destroy": true,
		"ajax":{
			
			"url": "<?php echo base_url('cities/allCitiesData'); ?>",
            "type": "POST",
            "data": function (d) {
            $("#paginationlength").val(d.length);
			d.search_text1 = search_text1;
			d.search_on_1 = search_on_1;
                },
                "dataSrc": function (jsondata) {
                    //$(".dataTables_paginate").addClass('pull-right');
                    $("#citylist_length select").addClass('input-xs').removeClass('input-sm');
                    return jsondata['data'];
                }
			
			},
			 "columns": [
                {"title": "S.NO", "name":"sno", "orderable": false, "data":"sno", "width":"5%" },
				{"title": "City Id", "name":"cid",  "data":"cid", "width":"5%" },
				{"title": "City Name", "name": "CityName", "data": "CityName", "width": "15%"},
                {"title": "State Name", "name": "StateName", "data": "StateName", "width": "15%"},
				{"title": "Country Name", "name": "CountryName", "data": "CountryName", "width": "15%"},
                {"title": "Actions", "name": "actions", "orderable": false, "defaultContent": "", "width": "10%"},
            ],
			"fnCreatedRow": function( nRow, aData, iDataIndex) {
                 $(nRow).find('td:eq(0)').attr('data-title',"S.No");
                 $(nRow).find('td:eq(1)').attr('data-title',"City Id");
				 $(nRow).find('td:eq(2)').attr('data-title',"City Name");
				 $(nRow).find('td:eq(3)').attr('data-title',"State Name");
				 $(nRow).find('td:eq(4)').attr('data-title',"Country Name");
                
             var action ='<button class="btn btn-primary btn-xs" onclick="edit_city('+aData['id']+')"><span class="glyphicon glyphicon-pencil"></span></button> <button class="btn btn-danger btn-xs" onclick="delete_city('+aData['id']+')"><span class="glyphicon glyphicon-trash"></span></button>';
          
            $(nRow).find('td:eq(5)').html(action);
           
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
        var table = $('#citylist').DataTable();
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
function edit_city(id)
    {
		
     
      $('#edit_form')[0].reset(); // reset form on modals
 
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('cities/cityEdit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="city_id"]').val(data.id);
			$('#countryname option[value="'+data.country_id+'"]').prop('selected',true);
			$('#statename option[value="'+data.state_id+'"]').prop('selected',true);
            $('[name="cityname"]').val(data.name);
			
			 var contry_id = $("#countryname").val();
    var jqxhr = $.ajax({
        type: "POST",
        url: "<?php echo base_url('matrimony/getStates')?>",
        data: {contry_id:contry_id},
        beforeSend : function(){
        }
        }).done(function(data){
           // alert(data);
            var jsonStatesData = JSON.parse(data);
            if (jsonStatesData == '') 
        {
            $('#statename').html('<option value="">State Not Found</option>');
        }
        else{
            var i = 1;
            $('#statename').children('option').remove()
            $('#statename'+i).html('<option value="">Select State</option>');
            $.each(jsonStatesData, function (key, value){
            $('[name="statename"]').append('<option value="'+value.id+'">' +value.name+ '</option>');
                i++;
                });
        }
          }); 
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
            url : "<?php echo site_url('cities/updateCity')?>",
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
               alert("city not updated");
            }
        });
    }

function delete_city(id)
    {
		
      if(confirm('Are you sure delete this city?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('cities/deleteCities')?>/"+id,
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
	
$('#countryname').on('change', function() {     
    var contry_id = $("#countryname").val();
    var jqxhr = $.ajax({
        type: "POST",
        url: "<?php echo base_url('matrimony/getStates')?>",
        data: {contry_id:contry_id},
        beforeSend : function(){
        }
        }).done(function(data){
           // alert(data);
            var jsonStatesData = JSON.parse(data);
            if (jsonStatesData == '') 
        {
            $('#statename').html('<option value="">State Not Found</option>');
        }
        else{
            var i = 1;
            $('#statename').children('option').remove()
            $('#statename'+i).html('<option value="">Select State</option>');
            $.each(jsonStatesData, function (key, value){
            $('[name="statename"]').append('<option value="'+value.id+'">' +value.name+ '</option>');
                i++;
                });
        }
          }); 
    });
            	

</script>