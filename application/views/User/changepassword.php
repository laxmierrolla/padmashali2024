<?php $this->load->view('template/userdashboard/head');?> 
  <style type="text/css">
    .thankyou-bg{background:#f7f7f5;width:100%;height:auto;min-height:300px;margin:7em 0em 6em 0em;}
  </style> 
<body class="rg-body">
                   <?php $this->load->view('template/userdashboard/header')?>
  
<div class="container">
  <div class="col-md-8 col-md-push-2">
  <div class="col-md-12 thankyou-bg text-center"> 
  <form name="changepassowrd" id="changepassowrd" action="<?php echo base_url('userdashboard/passwordchange')?>" method="post"> 
  <input type="hidden" name="prfid" id="prfid" value="<?php echo $this->session->userdata['user']['username'];?>">
     <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 separator social-login-box"> <br>
                           <img alt="" class="img-thumbnail" src="https://bootdey.com/img/Content/avatar/avatar1.png">                        
                        </div>
                        <div style="margin-top:80px;" class="col-xs-6 col-sm-6 col-md-6 login-box">
                         <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                              <input class="form-control" type="password" name="currentpass" id="currentpass" placeholder="Current Password" required>
                              <span class="pass_error" style="color:red ; display:none">please enter correct password</span>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></div>
                              <input class="form-control" type="password" placeholder="New Password" name="newpass" id="newpass" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></div>
                              <input class="form-control" type="password" placeholder="Confirm Password" name="cpass" id="cpass">
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
     <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6"></div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <input class="btn icon-btn-save btn-success" type="submit" name="submit">
                           
                        </div>
                    </div>
</div>
</form>
</div>
</div>
 </div>
 </div>
    <div class="clearfix"> </div>
     <?php $this->load->view('template/userdashboard/footer')?> 
      <script type="text/javascript" src="<?php echo base_url();?>assets/jqueryvalidations/jquery.validate.min.js"></script>
      <script>
 $(document).ready(function(){
    $("#changepassowrd").validate({
        rules: { 
            newpass: {
                required: true
            },
            cpass: {
                required: true,
                equalTo: "#newpass"
            }
        },
        messages: {
            newpass: "Please enter password",
            cpass: "Please enter valid confirm password"
        },      
        submitHandler: function() { $('#changepassowrd').submit(); }
    });
    
    $('#currentpass').change(function(){
        var prfid = $('#prfid').val();
        var cupass = $('#currentpass').val();
		alert(cupass);
        if(prfid!=""){
            $.ajax({
                method:"POST",
                url:"<?php echo base_url();?>userdashboard/checkpassword",  
                data:{prfid:prfid,pass:cupass}, 
                success:function(data) 
                { 
                 var status = $.trim(data);
                 console.log(status);
                    if(status == 'success') {  
                       $('.pass_error').hide();
                  }
                  else{
                      $('.pass_error').show();
                  }   
                }
            });
        }
        
    });
    
});
</script> 
</body>
</html>

