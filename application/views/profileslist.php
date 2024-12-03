<?php
$this->load->view('template/userdashboard/head');
$gender=$this->session->userdata('gender');
$gender_pic = ($gender == 'Female') ? 'male.png' : 'female.png';
$dummy_profile_pic = base_url() . 'assets/images/' . $gender_pic;
$protect = base_url() . 'assets/images/protect.png';
?>
//echo $profilelist->ttl_rows;
?>
<body>
    <?php
    $this->load->view('template/userdashboard/header');
    /* print_r($this->session->all_userdata()); */
    //print_r($sidefilter_req->employee_in);
    ?>
    <div class="main-container no-mar">
        <div class="container">
            <div class="col-md-12">
                    <div class="col-md-12 no-pad">
                        <div class="col-md-12 no-pad">
                            <div id="container">
                                <div class="view-controls-list col-md-12" id="viewcontrols">

                                    <div class="col-md-7 text-left"></div>
                                    <div class="col-md-5 text-right">
                                        <a class="gridview"><i class="fa fa-th fa-2x"></i></a>
                                        <a class="listview"><i class="fa fa-list fa-2x"></i></a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <ul class="list">
                                    <!--Loop code start -->
                                    <?php
                                    if ($profilelist) {
                                        foreach ($profilelist->result() as $response) {
                                            // print_r($response);
                                            $profile_image = '';
                                            
										 if($response->thumbimage!==""){ if($response->Photoprotect == 1){ $profile_image = $protect;
											 }else if($response->Profile_photo_Status == 1){
											     $profile_image = base_url().'/uploads/profilepics/'.$response->profile_code.'/'.$response->thumbimage;       
										    }else{
											     $profile_image = $dummy_profile_pic;
										   }}else{
										        $profile_image = $dummy_profile_pic;
										   }
											
                                            $dateOfBirth = (isset($response->dob))?$response->dob:'';
				                            $today = date("Y-m-d");
				                            $diff = date_diff(date_create($dateOfBirth), date_create($today));
				                            $age = $diff->format('%y'); 

                                            $profilename = $response->sname . ' ' . $response->fname . ' ' . $response->lname;
                                            $profile_link = base_url() . 'partnerdetails/' . $response->profile_code;
                                            ?>
                                            <li>
                                                <img src="<?php echo $profile_image; ?>" alt="<?php echo $profilename; ?>" title="<?php echo $profilename; ?>" />
                                                <section class="list-left">
                                                    <span class="title"><a href="<?php echo $profile_link; ?>"><?php echo $profilename; ?></a></span>
                                                    <p style="color:#222;text-transform:capitalize;font-size:11px;"><?php echo $response->profile_code; ?>&nbsp;|&nbsp;Profile Created <?php echo $response->profile_by; ?></p>

                                                    <h5><?php echo $age; ?> years,<?php echo $response->feet; ?>,<?php echo $response->edu_details; ?>, <?php echo $response->occ_details; ?>, <?php echo $response->city; ?>,  <?php echo $response->country; ?>.
                                                        <div class="clearfix"></div>
                                                        <a href="<?php echo $profile_link; ?>">View Profile</a>
                                                    </h5>
                                                    <div class="icon-group-btn">                                            
                                                        <a title="Add to Cart" href="javascript:void(0);" class="btn-cart" onClick="">  
                                                            <span class="icon-cart"></span>
                                                            <span class="icon-cart-text">
                                                                Send Mail                    
                                                            </span>
                                                        </a>

                                                        <a title="Add to wishlist" href="#" class="btn-wishlist">
                                                            <span class="icon-wishlist"></span>
                                                            <span class="icon-wishlist-text">
                                                                Contact Numer                  
                                                            </span>
                                                        </a>
                                                        <a title="View Profile" href="<?php echo $profile_link; ?>" class="btn-wishlist">
                                                            <span class="icon-edit"></span>
                                                            <span class="icon-wishlist-text">
                                                                View profile                 
                                                            </span>
                                                        </a>
                                                    </div>      
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
							 <div class="col-sm-12  text-center-xs pagination">                
          <?php echo $pagination; ?>
          
        </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
<?php $this->load->view('template/userdashboard/footer') ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/search-list.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                $(".tip-bottom").tooltip({placement: 'bottom'});

            });
        </script>
    


</body>
</html>
