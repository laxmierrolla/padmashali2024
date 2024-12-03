<?php
$gender_pic = ($gender == 'Male') ? 'male.png' : 'female.png';
$dummy_profile_pic = base_url() . 'assets/images/' . $gender_pic;
?>
<?php $this->load->view('template/head'); ?>
 <style type="text/css">
     .error{color:#f30;font-size:13px;font-style:italic;}
 </style> 
 <body class="rg-body">

<div class="overlay">
    <!--Header section module code start-->
    <div id="sticky-anchor"></div>
    <!-- ============================  Navigation Start =========================== -->
    <div id="tf-menu" class="navbar">
        <div class="container">
           <div class="col-md-2 col-sm-2 col-xs-12">
           <a class="brand" href="index.html"><img src="<?php echo base_url();?>assets/images/logo.png" alt="logo"></a>
           </div> <!-- end pull-right -->
            <div class="col-md-10 col-sm-12 col-xs-12 no-padding nav-hdng">
                  <p>Welcome to Padmashali India Matrymony!</p>                                
            </div>
          <div class="clearfix"> </div>
        </div> <!-- end container -->
    </div> <!-- end navbar-inverse-blue -->
</div>
    <!--Header section module code end -->
    <?php for($ns=1;$ns<6;$ns++){?>
    <div class="clearfix">&nbsp;</div>
    <?php } ?>
    <?php
    $sidefilter_req = json_decode($filter_statistics);
    ?>
    <div class="main-container no-mar">
        <div class="container">
            <div class="col-md-12">


                <div class="col-md-9">
                    <div class="col-md-12 no-pad">
                        <div class="col-md-12 no-pad">
<?php $request = json_decode($search_data); ?>
                            <div id="container">
                                <div class="view-controls-list col-md-12" id="viewcontrols">

                                    <div class="col-md-7 text-left"><h4>Search result count&nbsp;(&nbsp;<?php echo $request->search_count; ?>&nbsp;)</h4></div>
                                    <div class="col-md-5 text-right">
                                        <a class="gridview"><i class="fa fa-th fa-2x"></i></a>
                                        <a class="listview"><i class="fa fa-list fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <ul class="list">
                                    <!--Loop code start -->
                                    <?php
                                    if ($request->code == 200) {
                                        foreach ($request->search_result as $response) {
                                            // print_r($response);
                                            $profile_image = '';
                                            
                                                $profile_image = $dummy_profile_pic;
                                            
                                            $age = (date('Y') - date('Y', strtotime($response->dob)));

                                            $profilename = $response->sname . ' ' . $response->fname . ' ' . $response->lname;
                                            //$profile_link = base_url() . 'partnerdetails/' . $response->profilecode;
                                            $profile_link = base_url();
                                            ?>
                                            <li>
                                                <img  src="<?php echo $profile_image; ?>" alt="<?php echo $profilename; ?>" title="<?php echo $profilename; ?>" />
                                                <section class="list-left">
                                                    <span class="title"><a onclick="return confirm('To view profile.Please register/Login')" href="<?php echo $profile_link; ?>"><?php echo $profilename; ?></a></span
                                                    <p style="color:#222;text-transform:capitalize;font-size:11px;"><?php echo $response->profilecode; ?>&nbsp;|&nbsp;Profile Created <?php echo $response->profile_by; ?></p>

                                                    <h5><?php echo $age; ?> years,<?php echo $response->height; ?>,<?php echo $response->edu_details; ?>, <?php echo $response->occ_details; ?>, <?php echo $response->city; ?>,  <?php echo $response->country; ?>.
                                                        <div class="clearfix"></div>
                                                        <a onclick="return confirm('To view profile.Please register/Login')"  href="<?php echo $profile_link; ?>">View Profile</a>
                                                    </h5>
                                                        
                                                </section>
                                                <section class="list-right">
                                                    <h4><i class="fa fa-quote-left" aria-hidden="true"></i>&nbsp;
        <?php echo substr($response->aboutme, 0, 50); ?> <a href="<?php echo $profile_link; ?>"> Read more</a>&nbsp;
                                                        <i class="fa fa-quote-right" aria-hidden="true"></i>
                                                    </h4>

                                                </section>
                                            </li>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="col-md-12 text-center">
                                            <img src="<?php echo IMAGES_PATH; ?>noresult.jpg" />
                                        </div>
<?php } ?>
                                    <!--Loop code end -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
<?php $this->load->view('template/userdashboard/footer') ?>
        <script type="text/javascript">
            $(document).ready(function () {

                $(".tip-bottom").tooltip({placement: 'bottom'});

            });
        </script>
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script> 

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/search-list.js"></script>


</body>
</html>
