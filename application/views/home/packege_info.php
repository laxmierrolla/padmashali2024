 <?php $this->load->view('template/head'); ?>
 <style type="text/css">
     .error{color:#f30;font-size:13px;font-style:italic;}
 </style> 
<body class="rg-body">
<div class="overlay">
   <div id="sticky-anchor"></div>
    <!-- ============================  Navigation Start =========================== -->
    <div id="tf-menu" class="navbar">
        <div class="container">
           <div class="col-md-2 col-sm-2 col-xs-12">
           <a class="brand" href="index.html"><img src="<?php echo base_url();?>assets/images/logo.png" alt="logo"></a>
           </div> <!-- end pull-right -->
            <div class="col-md-10 col-sm-12 col-xs-12 no-padding nav-hdng">
                <p>Welcome to Padmashali India Matrimony!</p>                                
            </div>
          <div class="clearfix"> </div>
        </div> <!-- end container -->
    </div> <!-- end navbar-inverse-blue -->
    <div class="main-container no-mar">
        <div class="card">
            <br/><br/><br/>
            <div class="container" style="margin-top:120px">
                <?php if(!empty($this->session->flashdata('register_success'))){ ?>
                <div class="alert alert-success fade in">
                    <a href="" class="close" data-dismiss="alert">&times;</a>
                    <strong>Success!</strong> Partner preferences  Completed  successfully.
               </div>
                <?php } ?>
            <form name="package-form" method="post" action="<?php echo base_url('matrimony/savePackages');?>">
                <input type="hidden" name="pfcode" id="pfcode" value="<?php echo $this->session->userdata('profilecode');?>" >
		<div class="col-md-12"style="background-color:#ffffff !important;">
		<div class="col-md-4">
		    <div class="panel panel-success text-center silver" style="background-color:#07592f;color:#fff; ">
		        <div class="panel-heading silver" style="background-color:#07592f;color:#fff; font-size: 20px;"><b>Silver Package</b></div>
		            <div class="panel-body">
				<h3 class="text-center"><i class="fa fa-1x fa-inr"></i>  1000/365days</h3><br/>
				<div class="col-md-12 l-height">
				  <i class="fa fa-1x fa-envelope-o"></i>  Unlimited Messages
				</div><br/>
				<div class="col-md-12 l-height">
				  <i class="fa fa-1x fa-mobile"></i>   30  contact Numbers
				</div><br/>
				<div class="col-md-12 l-height">
				  <i class="fa fa-1x fa-comments"></i>  Chat with Prospects Directly
				</div>
			    </div>
			    <div class="panel-footer silver" style="background-color:#07592f;color:#fff; ">
				  <input type="radio" 	name="package"	id="package1" value="1">Make payment
                            </div>
		    </div>
		</div>
		<div class="col-md-4 " >
		    <div class="panel panel-success text-center gold" style="background-color:#07592f;color:#fff; ">
			<div class="panel-heading gold" style="background-color:#07592f;color:#fff; font-size: 20px;"><b>Gold Package</b></div>
			    <div class="panel-body">
				<h3 class="text-center"><i class="fa fa-1x fa-inr"></i>  1500/365days</h3>
				 <br/>
				<div class="col-md-12 l-height">
				  <i class="fa fa-1x fa-envelope-o"></i>Unlimited Messages
				</div>
				<div class="col-md-12 l-height">
				  <i class="fa fa-1x fa-mobile"></i>50 contact Numbers
				</div>
				<div class="col-md-12 l-height">
				  <i class="fa fa-1x fa-comments"></i> Chat with Prospects Directly
				</div>
				<div class="col-md-12 l-height">
				  <i class="fa fa-user-circle-o"></i>  Priority  in search result
				</div>
			    </div>
			    <div class="panel-footer gold" style="background-color:#07592f;color:#fff; ">
				<input type="radio"	name="package"	id="package2" value="2" checked>Make payment
                            </div>
		    </div>
		</div>
		<div class="col-md-4" >
		    <div class="panel panel-success text-center platinum" style="background-color:#07592f;color:#fff; ">
			<div class="panel-heading text-center platinum" style="background-color:#07592f;color:#fff; font-size: 20px;"><b>Platinum Package</b></div>
			    <div class="panel-body">
				<h3 ><i class="fa fa-1x fa-inr"></i>  2000/365days</h3>
				<br/>
				<div class="col-md-12 l-height">
				  <i class="fa fa-1x fa-envelope-o"></i>  Unlimited Messages
				</div>
				<div class="col-md-12 l-height">
				  <i class="fa fa-1x fa-mobile"></i>   100  contact Numbers
				</div>
				<div class="col-md-12 l-height">
				  <i class="fa fa-1x fa-comments"></i>  Chat with Prospects Directly
				</div>
				<div class="col-md-12 l-height">
				  <i class="fa fa-1x fa-picture-o"></i>  Exclusive album feature 
				</div>
				<div class="col-md-12 l-height">
				  <i class="fa fa-1x fa-file-video-o"></i> shelf video profile feature 
				</div>
				<div class="col-md-12 l-height">
				  <i class="fa fa-1x fa-user-secret"></i>  High Priority  in search result
				</div>
			    </div>
			    <div class="panel-footer platinum" style="background-color:#07592f;color:#fff; ">
				<input type="radio"	name="package"	id="package3" value="3">Make payment
                            </div>
		    </div>
		</div>
                <div id = "dolater"><button type="submit" class="btn btn-info pull-right btn-md col-sm-2" name="skip" id="skip">Skip</button></div>
		<br/><br/>
		<div class="col-md-12" style="text-align: -webkit-center;border: 1px solid #c1c1c1; background-color:#ec7935; padding: 4px;margin-top:4px;    color: #ffffff;">
		<h3><i class="fa fa-2x fa-phone"></i> Call us for more details about package and purchase options </h3>
		<br/>
		</div>
		
	
</div>
            </form>
<br/><br/>
</div>
      <br/>     
        <div class="clearfix"></div>
		</div>
        </div>
       
        <div class="clearfix"> </div>
    
    <?php $this->load->view('template/footer.php')?>
    <!-- Javascripts
    ================================================== -->

    <!-- Include jQuery -->
</div>
</body>
<script>
    $(document).ready(function(){
        if ($("#package2").is(":checked")) {
                $('.gold').css('background-color', '#8a0b0b');
                $('.silver').css('background-color', '#07592f');
                 $('.platinum').css('background-color', '#07592f');
            }
            
        $('input[name="package"]').click(function(){
             var inputvalue =$(this).attr("value");
             if(inputvalue == 1){
                 $('.silver').css('background-color', '#8a0b0b'); 
                $('.gold').css('background-color', '#07592f');
                $('.platinum').css('background-color', '#07592f');
             }
             else if(inputvalue == 2){
                $('.gold').css('background-color', '#8a0b0b');
                $('.silver').css('background-color', '#07592f');
                $('.platinum').css('background-color', '#07592f');
             }
             else if(inputvalue == 3){
                $('.platinum').css('background-color', '#8a0b0b');
                $('.gold').css('background-color', '#07592f');
                $('.silver').css('background-color', '#07592f');
             }
        });
      
    });
    
</script>
</html>