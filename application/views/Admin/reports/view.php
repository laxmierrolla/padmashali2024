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
#stafflist_length{
  display:none;
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
       <h1> Reports</h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">All User Reports</h3>
        </div>
         <?php if(!empty($this->session->flashdata('staff_error'))){ ?>
            <div class="alert alert-danger fade in">
    			<a href="" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong> A problem has been occurred while adding staff .
		</div>
        <?php } ?>
        
         <?php if(!empty($this->session->flashdata('staff_sucess'))){ ?>
           <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
               <strong>Success!</strong> Staff  added successfully.
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
               <?php foreach($states as $key=>$value){ ?>
               <option value="<?php echo $value['StateID'];?>"><?php echo $value['StateName'];?></option>
               <?php  } ?>
              </select>
            </div>
            <div class="col-lg-2 col-sm-12 margin_select mar5 pd-right" style="margin-top:12px;">
              <select name="city_wise" id="city_wise" class="input-sm form-control custom-input">
               <option value="">-- City Wise --</option>
               <?php foreach($cities as $key=>$value){ ?>
               <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
               <?php  } ?>
              </select>
            </div>
             <button type="button" id="search_submit" class="btn btn-info margin_search" style=""><i class="fa fa-search" style=""></i></button>
          <a class="btn btn-danger" style="display:none;" id="searchreset" href="<?php echo base_url('staff'); ?>"><li class="fa fa-search-minus"></li></a>   
            <button type="button" id="download_user" data-id="exceldata" class="btn btn-info margin_search download" style=""><i class="fa fa-download"></i></button>
          </form>  
             <input type="hidden" id="atpagination" value="">
            <input type="hidden" id="paginationlength" value="">
              <table id="stafflist" class="table table-bordered table-striped">
             
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        </div>
        
   
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
<script src="<?php echo base_url();?>assets/js/base64.js"></script>
<script>
$(document).ready(function(){
	var dtabel;
    var search_text1;
		var search_on1;
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
    var ispage;
	dtabel = $('#stafflist').DataTable({
		 "processing": true,
        "serverSide": true,
        "bStateSave": true,
        "language": {
        //"lengthMenu": "Display _MENU_ records per page",
        "emptyTable": "No Users found!",
         },
       "sDom": "lptr<'clearfix'>p",
        //"order": [[ 4, "desc" ]],
        "PaginationType": "two_button",
        "PaginationType": "bootstrap",
        "iDisplayLength": 10,
        "aLengthMenu": [10, 20, 50, 100],
        "destroy": true,
		"ajax":{
			
			"url": "<?php echo base_url('reports/allUserReports'); ?>",
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
                    $("#stafflist_length select").addClass('input-xs').removeClass('input-sm');
                    return jsondata['data'];
                }
			
			   },
			 "columns": [
                {"title": "S.NO", "name":"sno", "orderable": false, "data":"sno", "width":"5%" },
                {"title": "ProfileCode", "name": "UserName", "data": "ProfileCode","orderable": false, "width": "15%"},
        	{"title": "Email", "name": "Email", "data": "EmailId", "orderable": false,"width": "15%"},
        	{"title": "Mobile", "name": "Mobile", "data": "MobileNumber","orderable": false, "width": "15%"},
        	{"title": "FullName", "name": "GroupName", "data": "FullName","orderable": false, "width": "15%"},
                {"title": "Gender", "name": "status", "orderable": false,"data": "Gender", "width": "10%"},
            ],
			"fnCreatedRow": function( nRow, aData, iDataIndex) {
             $(nRow).find('td:eq(0)').attr('data-title',"S.No");
             $(nRow).find('td:eq(1)').attr('data-title',"UserName");
    				 $(nRow).find('td:eq(2)').attr('data-title',"Email");
    				 $(nRow).find('td:eq(3)').attr('data-title',"Mobile");
    				 $(nRow).find('td:eq(4)').attr('data-title',"GroupName");
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
        
         $(".download").click(function(){
        if(search_text1!="" || country_wise!="" || state_wise!="" || city_wise!="" || from_date!="" || to_date!="" || bride_type!="" || payment_type !="" || package_type !="" || marital_status !="" || status_search !="" || reference_by !=""){
            var selcolumns = "";
            var Inputid = $(this).attr("data-id");
            setallvalues();
            $('.tagcls').find('a').each(function() {
                if($(this).hasClass("sel"))
                    if(selcolumns == "")
                        selcolumns += $(this).attr('data-columnindex');
                    else
                        selcolumns += ","+$(this).attr('data-columnindex');
            });
            var search = {
                        'search_text1': $("#search_text1").val(),
                        'search_on1':$("#search_on1").val(),
                        'country_wise':$("#country_wise").val(),
                        'state_wise':$("#state_wise").val(),
                        'city_wise':$("#city_wise").val(),
                        'bride_type' : $("#bride_type").val(),
                        'payment_type' : $("#payment_type").val(),
                        'from_date' : $("#from_date").val(),
                        'to_date' : $("#to_date").val(),
                        'reference_by' : $("#reference_by").val(),
                        'package_type' : $("#package_type").val(),
                        'status_search' : $("#status_search").val(),
                        'marital_status' : $("#marital_status").val(),
                        'selected' : selcolumns
                        }
            var url = "/"+Base64.encode(JSON.stringify(search));
            window.open("<?php echo base_url("reports/allUserReportsDownload"); ?>"+url+"/"+Inputid,"_blank");
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
        var table = $('#stafflist').DataTable();
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
</script>