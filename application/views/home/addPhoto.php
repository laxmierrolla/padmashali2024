 <?php $this->load->view('template/head'); ?> 

<meta charset=utf-8 />
<title>JS Bin</title>
<body class="rg-body">
<div class="overlay">
    <div id="sticky-anchor"></div>
    <!-- ============================  Navigation Start =========================== -->
    <div id="tf-menu" class="navbar">
        <div class="container">
           <div class="col-md-2 col-sm-12 col-xs-12">
           <a class="brand" href="index.html"><img src="<?php echo base_url();?>assets/images/logo.png" alt="logo"></a>
           </div> <!-- end pull-right -->
            <div class="col-md-10 col-xs-12 col-sm-12 no-padding nav-hdng">
                  <p>Welcome to Padmashali India Matrymony!</p>                                
            </div>
          <div class="clearfix"> </div>
        </div> <!-- end container -->
    </div> <!-- end navbar-inverse-blue -->
    
    <div class="container">
        <div class="col-md-10 col-md-offset-1 add-photo">
        <div class="row register-form">
            
            <div class="row">
                <div class="col-md-12 col-sm-12 no-padding">
                    <div class="col-md-12">
                        <div class="rg-qts">
                        <h2>Your profile is ready to be shown to you are matches!</h2>
                        <p>We recommend that you add your photo to get better response</strong></p>
                        <hr/>
                        </div>
                         <?php if ($this->session->flashdata('photos_error')) { ?>
        <div class="row" style="margin:0px 0px 5px 0px;">
            <div class="col-xs-12">
                <div class="alert alert-danger fade in" style="margin:0">
                    <button class="close" data-dismiss="alert">
                    </button>
                    <i class="fa-fw fa fa-warning"></i>
                    <?php echo $this->session->flashdata('photos_error'); ?>
                </div>            
            </div>
        </div> 
    <?php } ?>
                        <div class="adpht-btn">
                        <button class="btn btn-warning" type="button">ADD PHOTOS NOW</button>
                        </div>
                        <div class="add-image">
                        <form name="photoupload" id="photoupload" method="POST" action="<?php echo base_url('matrimony/photoAdd')?>"  enctype="multipart/form-data">
                        <?php $profilecode = $this->session->userdata('profilecode'); ?>
                        <input type="hidden" class="form-control input-sm"  name="profilecode" id="profilecode" value="<?php echo $profilecode; ?>">
                        <input type="file" name="image" id="photo1" >
                         <img id="blah1" src="#" alt="your image" style="width: 100px; height: 100px;" />
                         <div class="wts-fb-app">
                        <button class="btn btn-success" type="submit" name="photoupload" id="photoupload1"value = "Upload" >Upload</button>
                        <a href="<?php echo base_url('matrimony/requiredMatch')?>"><button class="btn btn-danger" type="button">I'll do this later</button> </a>
                        </div>                        
                        </form>
                        </div>
                       
                    </div>
                    
                </div>
                    
                    <div class="form-group col-md-12 no-padding">
                    <div class="col-md-8">
                        
                    </div>
                    <div class="col-md-4">
                    
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        
       
        <div class="clearfix"> </div>
    
    <div class="footer">
        <div class="container">
            <div class="col-md-4 ">
                <h4>About Us</h4>
                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris."</p>
            </div>
            <div class="col-md-2 ">
                <h4>Help &amp; Support</h4>
                <ul class="footer_links">
                    <li><a href="#">24x7 Live help</a></li>
                    <li><a href="#">Contact us</a></li>
                    <li><a href="#">Feedback</a></li>
                    <li><a href="#">FAQs</a></li>
                </ul>
            </div>
            <div class="col-md-2 ">
                <h4>Quick Links</h4>
                <ul class="footer_links">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms and Conditions</a></li>
                    <li><a href="#">Services</a></li>
                </ul>
            </div>
            <div class="col-md-2 ">
                <h4>Social</h4>
                <ul class="footer_social">
                  <li><a href="#"><i class="fa fa-facebook fa1"> </i></a></li>
                  <li><a href="#"><i class="fa fa-twitter fa1"> </i></a></li>
                  <li><a href="#"><i class="fa fa-google-plus fa1"> </i></a></li>
                  <li><a href="#"><i class="fa fa-youtube fa1"> </i></a></li>
                </ul>
            </div>
            <div class="clearfix"> </div>
            
        </div>
        <div class="copy">
            <p>All rights reserved @ padmashaliindia.com </p>
        </div>
    </div>
</div>
    <!-- slider Javascripts -->
    <script type="text/javascript">
         $(window).load(function() {
            $("#flexiselDemo3").flexisel({
                visibleItems: 6,
                animationSpeed: 1000,
                autoPlay:false,
                autoPlaySpeed: 3000,            
                pauseOnHover: true,
                enableResponsiveBreakpoints: true,
                responsiveBreakpoints: { 
                    portrait: { 
                        changePoint:480,
                        visibleItems: 1
                    }, 
                    landscape: { 
                        changePoint:640,
                        visibleItems: 2
                    },
                    tablet: { 
                        changePoint:768,
                        visibleItems: 3
                    }
                }
            });
            
        });
    </script>
    <!-- header Javascripts -->
    <script>
        var TxtType = function(el, toRotate, period) {
            this.toRotate = toRotate;
            this.el = el;
            this.loopNum = 0;
            this.period = parseInt(period, 10) || 2000;
            this.txt = '';
            this.tick();
            this.isDeleting = false;
        };
    </script>

    <!-- register  radio jQuery -->
    <script type="text/javascript">
   function readURL(input) {
        if (input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#photo1").change(function(){
        readURL(this);
    });
     
        </script>

</body></html>
