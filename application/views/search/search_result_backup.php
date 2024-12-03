<?php $this->load->view('template/userdashboard/head');
 $gender_pic=($gender=='Female')?'male.png':'female.png';
 $dummy_profile_pic=base_url().'assets/images/'.$gender_pic;
?>
<body>
    <?php
    $this->load->view('template/userdashboard/header');
    /* print_r($this->session->all_userdata()); */
    ?>
    <div class="main-container no-mar">
        <div class="container">
            <div class="well well-sm">
                <strong>Search Results (122)</strong>
                <!--  <div class="btn-group">
                     <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
                     </span></a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                         class="glyphicon glyphicon-th"></span></a>
                 </div> -->
            </div>
            <div id="products" class="row list-group">
               <!-- profiles listing start -->
               <?php
               $request=json_decode($search_data);
               if($request->code==200){
                   foreach($request->search_result as $response){
                       $profile_image='';
                       if(!empty($response->thumbimage))
                      {
                                @$profile_image=$request->profilepic_path.strtoupper($response->profilecode).'/thumbnail/'.$response->thumbimage;
                       }
                       
                       $profile_link=  base_url().'partnerdetails/'.$response->profilecode;               ?>
                <div class="item col-md-3">
                    <div class="col-md-12 search-list-type">
                        <div class="thumbnail">
                            <img class="group list-group-image"  src="<?php echo $profile_image; ?>" alt="" width="100%" />
                            <div class="caption">
                                <h4>
                                    <a href="<?php echo $profile_link; ?>"><?php echo $response->profilecode; ?></a></h4>
                                <h5>Profile created by&nbsp;:&nbsp;<?php echo $response->profile_by; ?></h5>
                                <p><?php echo ucfirst($response->age); ?> yrs, <?php echo ucfirst($response->feet); ?>,
                                    <span title="<?php echo $response->occ_details;?> "><?php echo ucfirst(substr($response->occ_details,0,15)); ?>
                                  <?php if(!empty($response->city)){ ?>  Lives in <?php echo ucfirst($response->city); ?>, <?php echo ucfirst($response->country); ?><?php } ?>
                                    </p>
                                <div class="clearfix"></div>
                                <div class="col-md-12 intrest">
                                    <ul class="list-inline">
                                        <li>Intrested</li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="contact via Mail" class="btn btn-default"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="contact via Phone" class="btn btn-default"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
                                        <li><a href="<?php echo $profile_link; ?>" data-toggle="tooltip" data-placement="bottom" title="Click here to view full profile" class="btn btn-warning btn-sm">Viewprofile</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
               
               <?php } } else { ?>
                <!--Results end here -->
                <div class="col-md-12 text-center">
                    <img src="images/noresult.jpg" />
                </div>
               <?php } ?>
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

    <script type="text/javascript">
     
        </script>
</body>
</html>
