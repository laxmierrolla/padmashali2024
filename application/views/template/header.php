<div id="sticky-anchor"></div>
<!-- ============================  Navigation Start =========================== -->
<div id="tf-menu" class="navbar">
    <div class="container-fluid">
        <div class="col-md-12 no-pad">
            <div class="col-md-1 col-sm-1"></div>
            <div class="col-md-2 col-sm-2 logoCls">
                <a class="brand" href="<?php echo base_url();?>"><img
                        src="<?php echo base_url();?>assets/images/logo.png" alt="logo"></a>
            </div> <!-- end pull-right -->
            <div class="col-md-8 no-padding">
                <nav class="navbar nav_bottom" role="navigation">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header nav_2">
                        <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse"
                            data-target="#bs-megadropdown-tabs">Menu
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"></a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                        <ul class="nav navbar-nav nav_1">
                            <li><a href="<?php echo base_url(); ?>">HOME</a></li>
                            <li><a href="<?php echo base_url();?>AboutUs">ABOUT US</a></li>
                            <li><a href="<?php echo base_url();?>SuccessStories">SUCCESS STORIES</a></li>
                            <li><a href="<?php echo base_url();?>FAQS">FAQ'S</a></li>
                            <li class="last"><a href="<?php echo base_url();?>ContctUs">CONTACTS</a></li>
                        </ul>
                        <!-- <div class="nav-search col-lg-5 col-md-12 no-padding pull-right">
                        <ul class="nav navbar-nav nav_1 rightNav">
                            <li><a href="<?php echo base_url(); ?>">Login</a></li>
                            <li class="regBtn"><a class="regBtnLink" href="<?php echo base_url();?>">Register</a></li>
                        </ul>
                            <div class="clearfix"></div>
                            
                        </div> -->
                        <div class="nav-search col-lg-5 col-md-12 no-padding pull-right">
                            <form action="<?php echo base_url('matrimony/login') ?>" method="post">
                                <div class="div-left">
                                    <input type="text" class="m_1 form-control  input-sm" name="userid" required=""
                                        placeholder="Enter Profile ID">
                                </div>
                                <div class="div-left">
                                    <input type="password" class="form-control input-sm" name="password"
                                        placeholder="Password" id="psw" maxlength="40" value="">
                                    <a href="#" data-toggle="modal" data-target="#pwdModal">
                                        <p> Forgot Password ?</p>
                                    </a>
                                </div>
                                <div class="div-left">
                                    <input type="submit" class="btn btn-sm" name="go" value="Go" />
                                </div>
                            </form>
                            <div class="clearfix"></div>
                            <?php 
                              if($this->session->flashdata('loginfail')){ ?>
                              <span style="color:white;font-size:14px;text-align:center;margin-bottom:5px;margin-left:90px;;"><?php echo $this->session->flashdata('loginfail');?></span>
                            <?php }
                              if($this->session->flashdata('fail')){ ?>
                            <span style="color:white"><?php echo $this->session->flashdata('fail');?></span>
                            <?php }?>
                        </div>
                    </div>

                </nav>
            </div>
            <div class="col-md-1 col-sm-1"></div>
            <div class="modal-content col-md-6 pull-right" id="pwdModal" style="display:none">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><span class="glyphicon glyphicon-lock"></span> Recover Password!</h4>
                </div>

                <div class="modal-body">
                    <form id="Forgot-Password-Form" role="form">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                                <input name="forgot_email" id="forgot_email" type="forgot_email"
                                    class="form-control input-lg" placeholder="Enter Email" required
                                    data-parsley-type="email">
                            </div>
                            <span class="fgeror" style="color:red"></span>
                        </div>
                        <button type="button" id="fgpass" class="btn btn-success btn-block btn-lg">
                            <span class="glyphicon glyphicon-send"></span> SUBMIT
                        </button>
                    </form>
                </div>

            </div>
            <div class="clearfix"> </div>
        </div> <!-- end container -->
    </div>
</div> <!-- end navbar-inverse-blue -->
<script>
$(document).ready(function() {
    $('#fgpass').click(function() {
        var email = $('#forgot_email').val();
        if (email == "") {
            $('.fgeror').text("Please enter email");
        }
        // ajax checking data in database
        else {
            var mail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if (!email.match(mail)) {
                $('.fgeror').text("");
                $('.fgeror').text("Please enter valid email");
                return false;
            } else {
                $.ajax({
                    url: "<?php echo base_url('matrimony/check_email')?>",
                    type: "POST",
                    data: {
                        email: email
                    },
                    success: function(data) {
                        var status = $.trim(data);
                        if (status == 'success') {
                            $.ajax({
                                url: "<?php echo base_url('matrimony/forgotPassword')?>",
                                type: "POST",
                                data: {
                                    email: email
                                },
                                success: function(data) {
                                    alert(
                                        "password haas been sent to your registerd Email");
                                }
                                error: function(jqXHR, textStatus, errorThrown) {
                                    alert("Email not sent");
                                }
                            });
                        } else {
                            $('.fgeror').text("Email Not Exists");
                        }
                    }
                });
            }
        }
    });
});
</script>