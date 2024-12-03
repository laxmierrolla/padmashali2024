 <?php
$this->load->view('Admin/common_header');
$this->load->view('Admin/sidenav');

?> 
  <!-- =============================================== -->
<style>
.widget-user-2 .widget-user-header {
    padding: 5px;
	}
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!--  content header -->
  	<section class="content-header">
      <h1>
        Update Views
      </h1>
    </section>
    <!--  content header -->
  
    <!-- Main content -->
    <section class="content">
         <div class="row"><!--  row -->
           <div class="box box-info">
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(!empty($this->session->flashdata('views_error'))){ ?>
            <div class="alert alert-danger fade in">
    			<a href="#" class="close" data-dismiss="alert">&times;</a>
    		<strong>Error!</strong> A problem has been occurred while updating views.
		</div>
        <?php } ?>
        
         <?php if(!empty($this->session->flashdata('views_sucess'))){ ?>
           <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
               <strong>Success!</strong> Views Updated successfully.
          </div>
        <?php } ?>
            <form class="form-horizontal" name="renwelform" id="renwelform" method="post" action="<?php echo base_url('package/updateViews');?>">
              <div class="box-body">
                <div class="form-group">
                  <label  class="col-sm-2 control-label">Profilecode</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="profilecode" name="profilecode" placeholder="Enter email or profilecode"><span class="profie_error" style="color:red; display:none">Please enter profilecode</span>
                    
                  </div>
                  <div class="col-sm-3">
                     <i class="fa fa-eye fa-2x prfcode" style="color:#63C"></i>
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-2 control-label">Views</label>
                  <div class="col-sm-3">
                   <input type="text" class="form-control" id="addviews" name="addviews" placeholder="Enter no.of views">
                    <span class="noofviews_error" style="color:red; display:none">Please enter noofviews</span>
                
                <input type="hidden" name="prfscode" id="prfscode" value="" />
                 <input type="hidden" name="noofviews" id="noofviews" value="" />
                 <input type="hidden" name="oldvaliditydate" id="oldvaliditydate" value="" />
                  </div>
                   <div class="col-sm-3">
                    <input class="btn btn-primary" type="submit"  name="upadte" id="upadte" value="UpdateViews">
                  </div> 
                  <div class="col-sm-3">
                   <input class="btn btn-primary" type="reset" value="Reset">
                  </div> 
                </div>
              </div>
              <!-- /.box-body -->
           
            </form>
          </div>
         
         </div><!--  row -->
         
        
         <div class="row" id="userdiv" style="display:none">
          <h2 class="page-header">User Details</h2>
       	 <div class="col-md-6" id="userdetails" style="display:none">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <h3 class="widget-user-username" id="name"></h3>
              <h5 class="widget-user-desc" id="profilecode"></h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Email<span class="pull-right badge bg-blue" id="email"></span></a></li>
                <li><a href="#">No Of Views <span class="pull-right badge bg-aqua" id="nviews"></span></a></li>
                <li><a href="#">Viewed<span class="pull-right badge bg-green" id="viewed"></span></a></li>
                <li><a href="#">Pending<span class="pull-right badge bg-red" id="pending"></span></a></li>
                <li><a href="#">Subscription Valid Up To<span class="pull-right badge bg-green" id="subvaliddate"></span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
           <div class="col-md-6" id="usererror" style="display:none">
             <div class="bs-example">
    			<div class="alert alert-danger fade in">
        		<a href="#" class="close" aria-hidden="true"  data-dismiss="alert">&times;</a>
        		<strong>Error!</strong> <span id="user_error"> A problem has been occurred while submitting your data.</span>
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
<script>

$(document).ready(function(){
	$('.prfcode').click(function(){
		var profilecode = $('#profilecode').val();
		//alert(profilecode)
		if(profilecode ==""){
			$('.profie_error').show();
		}
		else{
			  $.ajax({
				  method:"POST",
				  url:"<?php echo base_url("admin/getUserDetails")?>",
				  data:{profilecode:profilecode},
				  success: function(response){
					   var jsonUserData = JSON.parse(response);
					    if (jsonUserData == ''){
							$('#userdiv').show();
							$('#usererror').show();
            				$('#user_error').text(profilecode+'  Not Found ');
        				}
						else{
							$('#usererror').hide();
							  $('#userdiv').show();
							  $('#userdetails').show();
							  $('#name').html(jsonUserData.name);
							  $('#profilecode').html(jsonUserData.profilecode);
							  $('#email').text(jsonUserData.email);
							  $('#nviews').text(jsonUserData.noOfviews);
							  $('#viewed').text(jsonUserData.viewed);
							  $('#pending').text(jsonUserData.pending);
							  $('#subvaliddate').text(jsonUserData.subscriptionValid);
							  $('#noofviews').val(jsonUserData.noOfviews);
							  $('#prfscode').val(jsonUserData.profilecode);
							  $('#oldvaliditydate').val(jsonUserData.subscriptionValid);
							}
            
					  }
				  });
			}
		
		
		});
		
		$('#upadte').click(function(){
			var profilecode = $('#profilecode').val();
			var views = $('#addviews').val();
			if(profilecode==""){
				$('.profie_error').fadeIn();
				setTimeout(function() {
					$('.profie_error').fadeOut("slow");
				}, 3000 );
				return false;
				 }
		    else if(views ==""){
				$('.noofviews_error').fadeIn();
				setTimeout(function() {
					$('.noofviews_error').fadeOut("slow");
				}, 3000 );
				return false;
				}
				else{
					return true;
					}
				
			});
		
	});
</script>