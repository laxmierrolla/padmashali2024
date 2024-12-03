 <?php
$this->load->view('Admin/common_header');
$this->load->view('Admin/sidenav');

?> 
  <!-- =============================================== -->
<style>
.box-title{
	color:green;
	font-size:16px;
	font-weight:bold;
	}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <section class="content-header">
      		<h1> Cities</h1>
       
       </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add City</h3>
          <div class="box-tools pull-right">
            <a href="<?php echo base_url('cities');?>"><button type="button" class="btn btn-info">View Cities</button></a>
          </div>
          
        </div>
        <!-- /.box-header -->
       
        <form name="addcity" id="addcity" method="post" action="<?php echo base_url('cities/saveCities'); ?>">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Country Name<span style="color:red">*</span></label>
                <select name="countryname" id="countryname" class="form-control">
                <option value=""> Select Country</option>
                <?php if($countries){
					foreach($countries as $value){?>
                    <option value="<?php  echo $value->id?>"><?php echo $value->name;?></option>
                    <?php }
					}?>
                </select>
              </div>
              <!-- /.form-group -->
              
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>State Name</label>
               <select name="statename" id="statename" class="form-control">
                <option value=""> Select Sate</option>
                </select>
                 <span id="state_error" style="color:red"></span>
              </div>
              <!-- /.form-group -->
              
              <!-- /.form-group -->
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>City Name</label>
                <input type="text" class="form-control" name="cityname" id="cityname"  placeholder="Enter cityname" >
                 <span id="city_error" style="color:red"></span>
              </div>
              <!-- /.form-group -->
              
              <!-- /.form-group -->
            </div>
            
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" name="add_city" id="add_city">Submit</button>
        </div>
        </form>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
$this->load->view('Admin/common_fotter');
?> 
<script type="text/javascript" src="<?php echo base_url();?>assets/jqueryvalidations/jquery.validate.min.js"></script> 
<script>
$(document).on('mouseout','#cityname',function(){

	var state = $('#statename').val();
	var city = $('#cityname').val();
	
		if(state!="" && city!=""){
			$.ajax({
				method:"POST",
				url:"<?php echo base_url('cities/cityCheck');?>",
				data:{state:state,city:city},
				success: function(data){
					 var status = $.trim(data);
                    if(status == 'success') {  
                    $('#city_error').text("city alredy exists").fadeOut(5000);
                    $('#cityname').val('');
                  }
					},
			
				});
			}
	});
	
$(document).ready(function(){
	
	$("#addcity").validate({
        // Specify the validation rules
        rules: {
            countryname: 
            {
                required: true,
            },
            statename:{
                 required: true, 
				 
            },
			 cityname:{
                 required: true, 
				 
            },
           
        },
        
        // Specify the validation error messages
        messages: {
            countryname: {
                required: "Please select country name",
				
            },
            statename:{
                 required: "Please select statename",
				 
            },
			cityname:{
                 required: "Please enter cityname",
				 
            },
           
           
        },
        errorElement: "div",
                    wrapper: "div",
                    errorPlacement: function(error, element) {
                        offset = element.offset();
                        error.insertAfter(element)
                        error.css('color','red');
                    },
        submitHandler: function(form) {
            form.submit();
        }
    });
	
	});	
	
	
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