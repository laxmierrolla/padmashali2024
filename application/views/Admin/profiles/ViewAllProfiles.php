<?php
$this->load->view('Admin/common_header');
$this->load->view('Admin/sidenav');
?>
<link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
  <!-- Content Wrapper. Contains page content -->
<style>


.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 4px 9px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #ddd}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}
.box-title{
    color:green;
    font-size:16px;
    font-weight:bold;
}

.dataTables_empty
{
    text-align: center;
    color:red;
}
.dataTable td
{
    font-size: 13px;
}
.input-sm{
margin-right:100px;
margin-top:px;
}   
.form-control input-sm{
color:#fff;
}

.btn{
  margin-top:11px;
}

</style> 
  <!-- =============================================== -->
 <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/datatables/dataTables.bootstrap.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <section class="content-header">
       <h1> View Profiles</h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="box box-default">
        <div class="box-header with-border" style="padding:15px;">
          <h3 class="box-title">View Profiles</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('admin/addUserProfile');?>"><button type="button" class="btn btn-info">Add Users</button></a>
          </div>
        </div>
        
         <?php if($this->session->flashdata('useradd_error')){ ?>
            <div class="alert alert-danger fade in">
    	     <a href="" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong> A problem has been occurred while adding User.
		</div>
        <?php } ?>
        
         <?php if($this->session->flashdata('useradd_sucess')){ ?>
           <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
               <strong>Success!</strong> User added successfully.
          </div>
        <?php } ?>
        
         <?php if($this->session->flashdata('userupdate_sucess')){ ?>
           <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
               <strong>Success!</strong> User updated successfully.
          </div>
        <?php } ?>
         <?php if($this->session->flashdata('userupdate_error')){ ?>
            <div class="alert alert-danger fade in">
    	     <a href="" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong> A problem has been occurred while update User.
		</div>
        <?php } ?>
        
	<div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <form id="search_branch" name="search_branch" method="post">
                            <div class="col-lg-2">
                                <input type="text" name="search_text1" id="search_text1" class="input-sm form-control" placeholder="Enter Keyword">
                            </div>
                            <div class="col-lg-2 col-sm-12 margin_select mar5 pd-right">
                              <select name="search_on1" id="search_on1" class="input-sm form-control custom-input">
                               <option value="1">ProfileCode</option>
                               <option value="2">First Name</option>
                               <option value="3">Last Name</option>
                               <option value="4">Sur Name</option>
                               <option value="5">Email</option>
                               <option value="6">Mobile</option>
                              </select>
                            </div>
                            <div class="col-lg-2">
                                <input type="text" name="from_date" id="from_date" class="input-sm form-control" placeholder="From date">
                            </div>
                            <div class="col-lg-2">
                                <input type="text" name="to_date" id="to_date" class="input-sm form-control" placeholder="To date">
                            </div>
                            <div class="col-lg-2 col-sm-12 margin_select mar5 pd-right">
                              <select name="bride_type" id="bride_type" class="input-sm form-control custom-input">
                               <option value="">--Bride/Groom--</option>
                               <option value="FeMale">Bride</option>
                               <option value="Male">Groom</option>
                              </select>
                            </div>
                            <div class="col-lg-2 col-sm-12 margin_select mar5 pd-right">
                              <select name="payment_type" id="payment_type" class="input-sm form-control custom-input">
                               <option value="">Select Payment Type</option>
                               <option value="0">Free</option>
                               <option value="2">Paid</option>
                               <option value="3">Admin Added</option>
                               <option value="1">Expired</option>
                              </select>
                            </div>
                            <div class="col-lg-2 col-sm-12 margin_select mar5 pd-right" style="margin-top:12px;">
                              <select name="package_type" id="package_type" class="input-sm form-control custom-input">
                              <option value="">Select Package</option>
                               <option value="1">Silver Package</option>
                               <option value="2">Gold package</option>
                              </select>
                            </div>
            <div class="col-lg-2 col-sm-12 margin_select mar5 pd-right" style="margin-top:12px;">
              <select name="reference_by" id="reference_by" class="input-sm form-control custom-input">
               <option value="">--Reference By</option>
               <option value="Advertisements">Advertisements</option>
                <option value="Friends">Friends</option>
                <option value="Sanghams">Sanghams</option>
                <option value=" SearchEngine"> Search Engine</option>
                <option value="Others">Others</option>
              </select>
            </div>
            <div class="col-lg-2 col-sm-12 margin_select mar5 pd-right" style="margin-top:12px;">
              <select name="marital_status" id="marital_status" class="input-sm form-control custom-input">
               <option value="">Marital Status</option>
               <option value="Never Married">Never Married</option>
               <option value="Widow/Widower">Widow/Widower</option>
               <option value="Divorced">Divorced</option>
               <option value="Seperated">Seperated</option>
              </select>
            </div>
            <div class="col-lg-2 col-sm-12 margin_select mar5 pd-right" style="margin-top:12px;">
              <select name="status_search" id="status_search" class="input-sm form-control custom-input">
               <option value="">User Activation</option>
               <option value="1">Active</option>
               <option value="0">De-Active</option>
              </select>
            </div>
            <div class="col-lg-2 col-sm-12 margin_select mar5 pd-right" style="margin-top:12px;">
              <select name="country_wise" id="country_wise" class="input-sm form-control custom-input">
               <option value="">--Country Wise--</option>
               <?php foreach($countries as $key=>$value){ ?>
               <option value="<?php echo $value['country_id'];?>"><?php echo $value['country'];?></option>
               <?php  } ?>
              </select>
            </div>
            <div class="col-lg-2 col-sm-12 margin_select mar5 pd-right" style="margin-top:12px;">
              <select name="state_wise" id="state_wise" class="input-sm form-control custom-input">
               <option value="">--State Wise--</option>
              </select>
            </div>
            <div class="col-lg-2 col-sm-12 margin_select mar5 pd-right" style="margin-top:12px;">
              <select name="city_wise" id="city_wise" class="input-sm form-control custom-input">
               <option value="">-- City Wise --</option>
              </select>
            </div>
             <button type="button" id="search_submit" class="btn btn-info margin_search" style=""><i class="fa fa-search" style=""></i></button>
          <a class="btn btn-danger" style="display:none;" id="searchreset" href="<?php echo base_url('viewProfiles'); ?>"><li class="fa fa-search-minus"></li></a>   
          </form> 
            <input type="hidden" id="atpagination" value="">
            <input type="hidden" id="paginationlength" value="">
            <table id="proflielist" class="table table-bordered table-striped">            
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        </div>
 <div class="modal fade" id="modal_edit_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Package Update</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="edit_form" class="form-horizontal">
          <input type="hidden" value="" name="profile_code" id="profile_code"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Package</label>
              <div class="col-md-9">
                <select class="form-control" id="package" name="package">
                  <option value="">Choosepackage</option>
                  <?php if(isset($packages)){
                        foreach($packages as $value){?>
                           <option value="<?php echo $value->id;?>"><?php echo $value->name."(Price:".$value->price." Period:",$value->valid.")" ;?></option>   
                        <?php }
                   }?>
                </select>
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
    </div>
 </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

   <?php
$this->load->view('Admin/common_fotter');

?> 
  >
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/admin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/datatables/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    var dtabel;
    var search_text1;
    var search_on1;
    var ispage;
    var country_wise;
    var state_wise;
    var city_wise;
    var from_date;
    var to_date;
    var bride_type;
    var payment_type;
    var reference_by;
    var package_type;
    var status_search;
    var marital_status;
    var url = "viewProfiles";
	dtabel = $('#proflielist').DataTable({
	"processing": true,
        "serverSide": true,
        "bStateSave": true,
        "language": {
        //"lengthMenu": "Display _MENU_ records per page",
        "emptyTable": "No Profiles found!",
         },
       "sDom": "lptr<'clearfix'>p",
        //"order": [[ 4, "desc" ]],
        "PaginationType": "two_button",
        "PaginationType": "bootstrap",
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "destroy": true,
	"ajax":{
	    "url": "<?php echo base_url('viewProfiles/allProfilesData'); ?>",
            "type": "POST",
            "data": function (d) {
            $("#paginationlength").val(d.length);
		d.search_text1 = search_text1;
            	d.search_on1=search_on1;
                d.country_wise = country_wise;
                d.state_wise = state_wise;
                d.city_wise = city_wise;
                d.bride_type = bride_type;
                d.payment_type = payment_type;
                d.from_date = from_date;
                d.to_date = to_date;
                d.reference_by = reference_by;
                d.package_type = package_type;
                d.status_search = status_search;
                d.marital_status = marital_status;
        },
                "dataSrc": function (jsondata) {
                    //$(".dataTables_paginate").addClass('pull-right');
                    $("#proflielist_length select").addClass('input-xs').removeClass('input-sm');
                    return jsondata['data'];
                }
			},
		"columns": [
                {"title": "S.NO", "name":"sno", "orderable": false, "data":"sno", "width":"2%" },
                {"title": "ProfileCode", "name":"ProfileCode", "data":"ProfileCode", "width":"2%" },
                {"title": "FullName", "name": "FullName", "data": "FullName", "width": "10%"},
                {"title": "Email", "name": "Email", "data": "EmailId", "width": "10%"},
        	{"title": "Mobile", "name": "Mobile", "data": "MobileNumber", "width": "10%"},
                {"title": "Gender", "name": "status", "data": "Gender", "width": "10%"},
                {"title": "Lastlogin", "name": "Lastlogin", "data": "Lastlogin", "orderable": false, "width": "10%"},
                {"title": "Validity", "name": "Validity", "data": "Validity", "width": "10%"},
                {"title": "ProfileStatus", "name": "ProfileStatus", "data": "ProfileStatus","orderable": false,"width": "5%"},
                {"title": "Actions", "name": "actions", "orderable": false, "defaultContent": "", "width": "10%"},
            ],
		"fnCreatedRow": function( nRow, aData, iDataIndex) {
                 $(nRow).find('td:eq(0)').attr('data-title',"S.No");
                 $(nRow).find('td:eq(1)').attr('data-title',"ProfileCode");
                 $(nRow).find('td:eq(2)').attr('data-title',"FullName");
                 $(nRow).find('td:eq(3)').attr('data-title',"Email");
                 $(nRow).find('td:eq(4)').attr('data-title',"Mobile");
		 $(nRow).find('td:eq(5)').attr('data-title',"Gender");
                 $(nRow).find('td:eq(6)').attr('data-title',"Lastlogin");
                 $(nRow).find('td:eq(7)').attr('data-title',"Validity");
                 $(nRow).find('td:eq(8)').attr('data-title',"ProfileStatus");
                 $(nRow).find('td:eq(9)').attr('data-title',"Actions");
		//alert(aData['Lastlogin']);		
             //var action ='<button class="btn btn-primary btn-xs" onclick="edit_package('+aData['ProfileCode']+')"><span class="glyphicon glyphicon-pencil"></span></button> <button class="btn btn-danger btn-xs" onclick="delete_package('+aData['ProfileCode']+')"><span class="glyphicon glyphicon-trash"></span></button> <button class="btn btn-info btn-xs" onclick="status_package('+aData['ProfileCode']+','+aData['ProfileStatus']+')" ><span class="glyphicon glyphicon-lock"></span></button>';
               var action ='<div class="dropdown"><a class="dropbtn">Actions<i class="fa fa-angle-down"></i></a>';
               action+='<div class="dropdown-content">'; 
               action+='<a id="view" href="<?php echo base_url();?>'+url+'/UserView/'+aData['ProfileCode']+'" ><i class="fa  fa-eye"></i>&nbsp;View</a>';
               action+='<a id="edit" href="<?php echo base_url();?>'+url+'/editUser/'+aData['ProfileCode']+'"><i class="fa fa-edit"></i>&nbsp;Edit</a>';
               if(aData['ProfileStatus']== 1){
                    action+='<a id="status-inactive" href="javascript:;" onclick="user_status('+aData['id']+','+aData['ProfileStatus']+','+aData['EmailId']+');"><i class="fa fa-lock"></i>&nbsp;BlockUser</a>';
                }
               else{
                action+='<a id="status-active" href="javascript:;" onclick="user_status('+aData['id']+','+aData['ProfileStatus']+','+aData['EmailId']+');"><i class="fa fa-lock"></i>&nbsp;ActivateUser</a>';
               }
               if(aData['Profile_photo_Status']== 1){
                    action+='<a id="photo-inactive" href="javascript:;" onclick="photo_status('+aData['id']+','+aData['Profile_photo_Status']+','+aData['EmailId']+');"><i class="fa fa-camera"></i>&nbsp;InactivateImage</a>';
                }
              else{
                action+='<a id="photo-active" href="javascript:;" onclick="photo_status('+aData['id']+','+aData['Profile_photo_Status']+','+aData['EmailId']+');"><i class="fa fa-camera"></i>&nbsp;ActivateImage</a>';
             }
             if(aData['payment_status'] < 2){
                    action+='<a id="update-payment" href="javascript:;" onclick="update_payment('+aData['id']+');"><i class="fa fa-money"></i>&nbsp;UpdatePayment</a>';
                }
			else{
				action+='<a id="invoice"  href="<?php echo base_url();?>'+url+'/invoice/'+aData['ProfileCode']+'" target="_blank"><i class="fa fa-money"></i>&nbsp;invoice</a>';
			}	
                action+='<a id="viewalldetails" href="<?php echo base_url();?>'+url+'/UserContactsViewDetails/'+aData['ProfileCode']+'" ><i class="fa  fa-mobile-phone"></i>&nbsp;UserContacts</a>';
                action+='<a id="photo-active" href="javascript:;" onclick="delete_profile('+aData['id']+');"><i class="fa fa-remove"></i>&nbsp;Delete</a>';
                action+='<input type="hidden" name="profilecode" id="prfcode_'+aData['id']+'" value="'+aData['ProfileCode']+'">';
            if(aData['ProfileStatus']==1){
            	 status_text = '<span class="label label-success">Active</span>';
				 
            }
            else
            {
                status_text = '<span class="label label-danger">Inactive</span>';
				 
            }
            if(aData['Lastlogin']==null){
            	 login_text = '<span class="label label-warning">Not At LoggedIn</span>';
            }
            else{
                login_text = aData['Lastlogin'];
            }
            $(nRow).find('td:eq(9)').html(action);
            $(nRow).find('td:eq(8)').html(status_text);
            $(nRow).find('td:eq(6)').html(login_text);
            },
	});
		
	   $("#search_submit").click(function(){
	    if($("#search_text1").val()!="" || $("#country_wise").val()!="" || $("#state_wise").val()!="" || $("#city_wise").val()!="" || $("#from_date").val()!="" || $("#to_date").val()!="" || $("#bride_type").val()!="" || $("#marital_status").val()!="" || $("#reference_by").val()!="" || $("#payment_type").val()!="" || $("#status_search").val()!="" || $("#package_type").val()!=""){
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
        search_on1 = $("#search_on1").val();
        country_wise = $("#country_wise").val();
        state_wise = $("#state_wise").val();
        city_wise = $("#city_wise").val();
        bride_type = $("#bride_type").val();
        payment_type = $("#payment_type").val();
        from_date = $("#from_date").val();
        to_date = $("#to_date").val();
        marital_status = $("#marital_status").val();
        reference_by = $("#reference_by").val();
        status_search = $("#status_search").val();
        package_type = $("#package_type").val();
        var table = $('#proflielist').DataTable();
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
function update_payment(id){
     var profilecode = $('#prfcode_'+id).val();
     $('#profile_code').val(profilecode);
     $('#modal_edit_form').modal('show'); 
    
    }
 	
//update package
 function update(){
       // ajax adding data to database
          $.ajax({
            url : "<?php echo site_url('viewProfiles/updatePackage')?>",
            type: "POST",
            data: $('#edit_form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
             $('#modal_edit_form').modal('hide');
	     alert("package updated successfully");
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
               $('#update_error').show();
            }
        });
    }
	
	
function delete_profile(id){
	if(confirm('Areyou sure to delete ?')){
	var profilecode = $('#prfcode_'+id).val();
	var id=id;
	
	if(profilecode && id!==""){
	$.ajax({
	   url : "<?php echo site_url('admin/deleteProfile')?>",
            type: "POST",
            data: {id:id,profilecode:profilecode},
            dataType: "JSON",
	    success: function(data){
	       alert("Profile  deleted successfully");
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
               alert("Profile not deleted successfully");
            }
		});
	}
	}
}	

function user_status(id,status,email){

var profilecode = $('#prfcode_'+id).val();
var status = status;
var email = email;
	
if(confirm('Are you sure change the status?')){
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('viewProfiles/stausChangeUser')?>/",
            type: "POST",
			data:{profilecode:profilecode,status:status,email:email},
            dataType: "JSON",
            success: function(data)
            {
               alert("profile status changed sucessfully");
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error changing status');
            }
        });

      }
    }	
 function photo_status(id,status,email){
 
var profilecode = $('#prfcode_'+id).val();
var status = status;
var email = email;
if(confirm('Are you sure change the photostatus?')){
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('viewProfiles/stausChangePhoto')?>/",
            type: "POST",
	    data:{profilecode:profilecode,status:status,email:email},
            dataType: "JSON",
            success: function(data)
            {
                alert("photo status changed sucessfully");
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
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
           $('#from_date').datepicker({
		showOn: "button",
                buttonImage: "https://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
                buttonImageOnly: true,
		changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
        });
        $('#to_date').datepicker({
		showOn: "button",
                buttonImage: "https://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
                buttonImageOnly: true,
		changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
        });
        
    $('#country_wise').on('change', function() {     
    var contry_id = $("#country_wise").val();
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
            $('#state_wise').html('<option value="">State Not Found</option>');
        }
        else{
            //var i = 1;
            $('#state_wise').children('option').remove()
            $('#state_wise').append('<option value="">Select State</option>');
            $.each(jsonStatesData, function (key, value){
            $('[name="state_wise"]').append('<option value="'+value.id+'">' +value.name+ '</option>');
               // i++;
                });
        }
          }); 
    });
            
   //select city based on state   
    $('#state_wise').on('change', function() {     
    var state_id = $("#state_wise").val();
    var jqxhr = $.ajax({
        type: "POST",
        url: "<?php echo base_url('matrimony/getCities')?>",
        data: {state_id:state_id},
        beforeSend : function(){
        }
        }).done(function(data){
            var jsonCityData = JSON.parse(data);
            if (jsonCityData == '') 
        {
            $('#city_wise').html('<option value="">City Not Found</option>');
        }
        else{
            var i = 1;
            $('#city_wise').children('option').remove()
            $('#city_wise'+i).append('<option value="">Select City</option>');
            $.each(jsonCityData, function (key, value){
            $('[name="city_wise"]').append('<option value="'+value.id+'">' +value.name + '</option>');
                i++;
                });
        }
          }); 
    }); 
    
        
      });
</script>