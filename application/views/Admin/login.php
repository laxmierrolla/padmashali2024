<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin| Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Admin</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
 <?php 
               if($this->session->flashdata('loginfail')){ ?>
                <span style="color:red;font-size:14px;text-align:center;margin-bottom:5px;margin-left:90px;;">Please enter valid username/password</span>
               <?php }?>
               
    <form action="<?php echo base_url('admin/login');?>" method="post" name="admin_login">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Email" name="email" id="email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <div class="image col-md-6 col-sm-8 col-xs-8 no-padding "><?php echo $image;?></div>
        <img id ='ref_symbol' src ="<?php echo base_url();?>assets/images/refresh.png"> </div>
        <input type="text" name="captcha" id="captcha" class="form-control input-sm" placeholder="" required>
      
      <div class="form-group">
        <!-- /.col -->
        <div class="col-xs-5 pull-right">
          <input type="submit" name="login" id="login" class="btn btn-primary btn-block">
        </div>
        <!-- /.col -->
      </div>
    </form>
</div>
  </div>
  <!-- /.login-box-body -->

<!-- /.login-box -->

<!-- jQuery 3.1.1 -->
<script src="<?php echo base_url();?>assets/userdashboard/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/userdashboard/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>assets/admin/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  
  $(document).ready(function(){
	   $("#ref_symbol").click(function() {
                    jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "admin/captcha_refresh",
                        success: function(res) {
                            if (res)
                            {
                                  jQuery("div.image").html(res);
                            }
                        }
                    });
                });
	  })
  
  
</script>
</body>
</html>
