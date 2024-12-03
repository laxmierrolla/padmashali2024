<?php
$this->load->view('template/userdashboard/head');
$gender_pic = ($gender == 'Female') ? 'male.png' : 'female.png';
$dummy_profile_pic = base_url() . 'assets/images/' . $gender_pic;
$protect = base_url() . 'assets/images/protect.png';
?>
<body>
    <?php
    $this->load->view('template/userdashboard/header');
    /* print_r($this->session->all_userdata()); */
    $sidefilter_req = json_decode($filter_statistics);
    //print_r($sidefilter_req->employee_in);
    ?>
    <div class="main-container no-mar">
        <div class="container">
            <div class="col-md-12">
                <div class="col-md-3">
                    <div class="col-md-12 no-pad">
                        <div class="panel-group" id="accordion1">
                            <!--Section oen end -->
                            <div class="panel panel-default no-brd hide">
                                <div class="panel-heading no-brd1 no-brd no-bag">
                                    <h4 class="panel-title panel-title-adjust col-md-12 no-pad">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1" class="col-md-12 no-pad hd">
                                            <span class="fa fa-map-marker" aria-hidden="true"></span> &nbsp;Age&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus text-right pull-right"></i>
                                        </a>
                                        <div class="clearfix"></div>
                                    </h4>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="collapseOne1" class="panel-collapse collapse in">
                                    <div class="panel-body" style="padding:8px;">
                                        <div class="col-md-6 side-right">
                                            <select class="filter" name="age_from" id="age_from">
                                                <option value="">From Age</option>
                                                <?php for ($age = 18; $age < 60; $age++) { ?>
                                                    <option value="<?php echo $age; ?>"><?php echo $age; ?> Years</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 side-right">
                                            <select class="filter" name="age_to" id="age_to">
                                                <option value="">To Age</option>
                                                <?php for ($age = 18; $age < 60; $age++) { ?>
                                                    <option value="<?php echo $age; ?>"><?php echo $age; ?> Years</option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>
                                    <!--  <div class="panel-footer text-center">
                                       <a href="#">View All Profile&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                     </div> -->
                                </div>
                            </div>
                            <!--Section oen end -->
                            <!--height section code start -->
                            <div class="panel panel-default no-brd">
                                <div class="panel-heading no-brd1 no-brd no-bag">
                                    <h4 class="panel-title panel-title-adjust col-md-12 no-pad">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne2" class="col-md-12 no-pad hd">
                                            <span class="fa fa-map-marker" aria-hidden="true"></span> &nbsp;Height&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus text-right pull-right"></i>
                                        </a>
                                        <div class="clearfix"></div>
                                    </h4>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="collapseOne2" class="panel-collapse collapse in">
                                    <div class="panel-body" style="padding:8px;">
                                        <div class="col-md-6 side-right">
                                            <select class="filter" name="height_from" id="height_from">
                                                <option value="">Choose Feet</option> 
                                                <?php
                                                if (isset($sidefilter_req->height) && (count($sidefilter_req->height) > 0)) {
                                                    foreach ($sidefilter_req->height as $h_res) {
                                                        ?>
                                                        <option value="<?php echo $h_res->feet_length; ?>"><?php echo $h_res->feet; ?>&nbsp;&nbsp;(<?php echo $h_res->total_count; ?>)</option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 side-right hide">
                                            <select class="filter" name="height_to" id="height_to">
                                                <option value="">Choose Feet</option>    
                                                <?php
                                                $filter_height=isset($filter_height)?$filter_height:array();
                                                if (is_array($filter_height) && (count($height) > 0)) {
                                                    foreach ($height as $h_res) {
                                                        ?>
                                                        <option value="<?php echo $h_res->feet_length; ?>"><?php echo $h_res->feet; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                    <!--  <div class="panel-footer text-center">
                                       <a href="#">View All Profile&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                     </div> -->
                                </div>
                            </div>
                            <!--Height section code end -->
                            <!--Martial status -->
                            <div class="panel panel-default no-brd">
                                <div class="panel-heading no-brd1 no-brd no-bag">
                                    <h4 class="panel-title panel-title-adjust col-md-12 no-pad">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne3" class="col-md-12 no-pad hd">
                                            <span class="fa fa-map-marker" aria-hidden="true"></span> &nbsp;Marital status&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus text-right pull-right"></i>
                                        </a>
                                        <div class="clearfix"></div>
                                    </h4>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="collapseOne3" class="panel-collapse collapse in">
                                    <div class="panel-body" style="padding:8px;">
                                        <div class="col-md-12 side-right">
                                            <div class="sky-form">
<!--                                                <label class="checkbox"><input type="checkbox" name="maritalstatus[]" value="NeverMarried" /><i></i>-->Never Married&nbsp;&nbsp;(<?php echo $sidefilter_req->martial->NeverMarried; ?>)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 side-right">
                                            <div class="sky-form">
                                                <label class="checkbox"><!--<input type="checkbox" name="maritalstatus[]" value="Widow" /><i></i>-->Widow&nbsp;&nbsp;(<?php echo $sidefilter_req->martial->Widow; ?>)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 side-right">
                                            <div class="sky-form">
                                                                        <label class="checkbox"><!--<input type="checkbox" name="maritalstatus[]" value="Divorced" /><i></i>-->Divorced&nbsp;&nbsp;(<?php echo $sidefilter_req->martial->Divorced; ?>)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 side-right">
                                            <div class="sky-form">
                                                <label class="checkbox"><!--<input type="checkbox" name="maritalstatus[]" value="Separated" /><i></i>-->Separated&nbsp;&nbsp;(<?php echo $sidefilter_req->martial->Separated; ?>)</label>
                                            </div>
                                        </div>

                                    </div>
                                    <!--  <div class="panel-footer text-center">
                                       <a href="#">View All Profile&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                     </div> -->
                                </div>
                            </div>
                            <!--Matrial status end -->
                            <!--Education section -->

                            <div class="panel panel-default no-brd">
                                <div class="panel-heading no-brd1 no-brd no-bag">
                                    <h4 class="panel-title panel-title-adjust col-md-12 no-pad">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne4" class="col-md-12 no-pad">
                                            <span class="fa fa-map-marker" aria-hidden="true"></span> &nbsp;Education&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus text-right pull-right"></i>
                                        </a>
                                        <div class="clearfix"></div>
                                    </h4>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="collapseOne4" class="panel-collapse collapse in">
                                    <div class="panel-body" style="padding:8px;">
                                        <?php
                                       $filter_education=isset($sidefilter_req->education)?$sidefilter_req->education:array();
                                        if (is_array($filter_education) &&   count($sidefilter_req->education) > 0) {
                                            foreach ($sidefilter_req->education as $edu) {
                                                ?>
                                                <div class="col-md-12 side-right">
                                                    <div class="sky-form">
                                                        <label class="checkbox"><!--<input type="checkbox" name="education[]" value="<?php echo $edu->edu_id; ?>"><i></i>--><?php echo ucfirst($edu->education); ?>&nbsp;&nbsp;(<?php echo ucfirst($edu->total_count); ?>)</label>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                        }
                                        ?>



                                    </div>
                                    <!--  <div class="panel-footer text-center">
                                       <a href="#">View All Profile&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                     </div> -->
                                </div>
                            </div>
                            <!--Education section end -->

                            <!--Education section -->

                            <div class="panel panel-default no-brd">
                                <div class="panel-heading no-brd1 no-brd no-bag">
                                    <h4 class="panel-title panel-title-adjust col-md-12 no-pad">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne5" class="col-md-12 no-pad">
                                            <span class="fa fa-map-marker" aria-hidden="true"></span> &nbsp;Occupation&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus text-right pull-right"></i>
                                        </a>
                                        <div class="clearfix"></div>
                                    </h4>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="collapseOne5" class="panel-collapse collapse in">
                                    <div class="panel-body" style="padding:8px;">
                                        <?php
                                        $filter_occupation=isset($sidefilter_req->occupation)?$sidefilter_req->occupation:array();
                                        if (is_array($filter_occupation) && count($sidefilter_req->occupation) > 0) {
                                            foreach ($sidefilter_req->occupation as $ocu) {
                                                ?>
                                                <div class="col-md-12 side-right">
                                                    <div class="sky-form">
                                                        <label class="checkbox"><!--<input type="checkbox" name="occupation[]" value="<?php echo $ocu->Occ_Id; ?>"><i></i>--><?php echo ucfirst($ocu->occupation); ?>&nbsp;&nbsp;
                                                            ( <?php echo ucfirst($ocu->total_count); ?> )</label>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>



                                    </div>
                                    <!--  <div class="panel-footer text-center">
                                       <a href="#">View All Profile&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                     </div> -->
                                </div>
                            </div>
                            <!--Education section end -->
                            
                            <!--Employee In Module section-->
                            <div class="panel panel-default no-brd">
                                <div class="panel-heading no-brd1 no-brd no-bag">
                                    <h4 class="panel-title panel-title-adjust col-md-12 no-pad">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne7" class="col-md-12 no-pad">
                                            <span class="fa fa-map-marker" aria-hidden="true"></span> &nbsp;Employee In&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus text-right pull-right"></i>
                                        </a>
                                        <div class="clearfix"></div>
                                    </h4>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="collapseOne7" class="panel-collapse collapse in">
                                    <div class="panel-body" style="padding:8px;">
                                        <?php
                                        $filter_employee_in=isset($sidefilter_req->employee_in)?$sidefilter_req->employee_in:array();
                                        if (is_array($filter_employee_in) && (count($sidefilter_req->employee_in) > 0)) {
                                            foreach ($sidefilter_req->employee_in as $emp) {
                                                ?>
                                                <div class="col-md-12 side-right">
                                                    <div class="sky-form">
        <!--                                                        <label class="checkbox"><input  type="checkbox" name="employee[]" value="<?php echo $emp->emp_id; ?>"><i></i>--><?php echo $emp->employee; ?> &nbsp;(<?php echo $emp->total_count; ?>)</label>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>



                                    </div>
                                    <!--  <div class="panel-footer text-center">
                                       <a href="#">View All Profile&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                     </div> -->
                                </div>
                            </div>
                            <!-- Employee in module section end -->
                            <!-- Special Cases module code start -->
                            <div class="panel panel-default no-brd">
                                <div class="panel-heading no-brd1 no-brd no-bag">
                                    <h4 class="panel-title panel-title-adjust col-md-12 no-pad">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne8" class="col-md-12 no-pad">
                                            <span class="fa fa-map-marker" aria-hidden="true"></span> &nbsp;Special cases&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus text-right pull-right"></i>
                                        </a>
                                        <div class="clearfix"></div>
                                    </h4>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="collapseOne8" class="panel-collapse collapse in">
                                    <div class="panel-body" style="padding:8px;">
                                        <?php
                                        $filter_specialcases=isset($sidefilter_req->specialcases)?$sidefilter_req->specialcases:array();
                                        if (is_array($filter_specialcases) && (count($sidefilter_req->specialcases) > 0)) {
                                            foreach ($sidefilter_req->specialcases as $spl) {
                                                ?>
                                                <div class="col-md-12 side-right">
                                                    <div class="sky-form">
                                                                                                                                <label class="checkbox"><!--<input type="checkbox" name="specialcase[]" value="<?php echo $spl->spl_id; ?>"><i></i>--><?php echo $spl->spacial; ?>&nbsp;&nbsp;(<?php echo $spl->total_count; ?>)</label>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Sepcial cases module code end -->
                            <!--rassi module code start-->
                            <div class="panel panel-default no-brd">
                                <div class="panel-heading no-brd1 no-brd no-bag">
                                    <h4 class="panel-title panel-title-adjust col-md-12 no-pad">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne9" class="col-md-12 no-pad">
                                            <span class="fa fa-map-marker" aria-hidden="true"></span> &nbsp;Raasi&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus text-right pull-right"></i>
                                        </a>
                                        <div class="clearfix"></div>
                                    </h4>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="collapseOne9" class="panel-collapse collapse in">
                                    <div class="panel-body" style="padding:8px;">
                                        <?php
                                        $filter_rasi=isset($sidefilter_req->rasi)?$sidefilter_req->rasi:array();
                                        if (is_array($filter_rasi) && (count($sidefilter_req->rasi) > 0)) {
                                            foreach ($sidefilter_req->rasi as $rasi) {
                                                ?>
                                                <div class="col-md-12 side-right">
                                                    <div class="sky-form">
        <!--                                                        <label class="checkbox"><input  type="checkbox" name="employee[]" value=""><i></i>--><?php echo $rasi->rasi; ?> &nbsp;(<?php echo $rasi->total_count; ?>)</label>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>



                                    </div>
                                    <!--  <div class="panel-footer text-center">
                                       <a href="#">View All Profile&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                     </div> -->
                                </div>
                            </div>
                            <!--rassi module code end-->
                            <!--Star module code start-->
                            <div class="panel panel-default no-brd">
                                <div class="panel-heading no-brd1 no-brd no-bag">
                                    <h4 class="panel-title panel-title-adjust col-md-12 no-pad">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne10" class="col-md-12 no-pad">
                                            <span class="fa fa-map-marker" aria-hidden="true"></span> &nbsp;Star&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus text-right pull-right"></i>
                                        </a>
                                        <div class="clearfix"></div>
                                    </h4>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="collapseOne7" class="panel-collapse collapse in">
                                    <div class="panel-body" style="padding:8px;">
                                        <?php
                                        $filter_star=isset($sidefilter_req->star)?$sidefilter_req->star:array();
                                        if (is_array($filter_star) && (count($sidefilter_req->star) > 0)) {
                                            foreach ($sidefilter_req->star as $star) {
                                                ?>
                                                <div class="col-md-12 side-right">
                                                    <div class="sky-form">
        <!--                                                        <label class="checkbox"><input  type="checkbox" name="employee[]" value=""><i></i>--><?php echo $star->star; ?> &nbsp;(<?php echo $star->total_count; ?>)</label>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>



                                    </div>
                                    <!--  <div class="panel-footer text-center">
                                       <a href="#">View All Profile&nbsp;<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                     </div> -->
                                </div>
                            </div>
                            <!--star module code end-->
                            <!--manglink module code start -->
                            <div class="panel panel-default no-brd">
                                <div class="panel-heading no-brd1 no-brd no-bag">
                                    <h4 class="panel-title panel-title-adjust col-md-12 no-pad">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne11" class="col-md-12 no-pad">
                                            <span class="fa fa-map-marker" aria-hidden="true"></span> &nbsp;Manglik Status&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus text-right pull-right"></i>
                                        </a>
                                        <div class="clearfix"></div>
                                    </h4>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="collapseOne11" class="panel-collapse collapse in">
                                    <div class="panel-body" style="padding:8px;">

                                        <div class="col-md-12 side-right">
                                            <div class="sky-form">
                                                <label class="checkbox"><!--<input type="checkbox" name="manglik[]" value="Yes"><i></i>-->Yes&nbsp;&nbsp;(<?php echo $sidefilter_req->manglink->yes; ?>)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 side-right">
                                            <div class="sky-form">
                                                <label class="checkbox"><!--<input type="checkbox" name="manglik[]" value="No"><i></i>-->No&nbsp;&nbsp;(<?php echo $sidefilter_req->manglink->no; ?>)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 side-right">
                                            <div class="sky-form">
                                                <label class="checkbox"><!--<input type="checkbox" name="manglik[]" value="Doesn't Matter"><i></i>-->Doesn't Matter &nbsp;&nbsp;(<?php echo $sidefilter_req->manglink->dontknow; ?>)</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--Residant status module code start -->
                            <div class="panel panel-default no-brd">
                                <div class="panel-heading no-brd1 no-brd no-bag">
                                    <h4 class="panel-title panel-title-adjust col-md-12 no-pad">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne12" class="col-md-12 no-pad">
                                            <span class="fa fa-map-marker" aria-hidden="true"></span> &nbsp;Resident status&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus text-right pull-right"></i>
                                        </a>
                                        <div class="clearfix"></div>
                                    </h4>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="collapseOne11" class="panel-collapse collapse in">
                                    <div class="panel-body" style="padding:8px;">

                                        <div class="col-md-12 side-right">
                                            <div class="sky-form">
                                                <label class="checkbox"><!--<input type="checkbox" name="residantstatus[]" value="Dont Want be Specific"/><i></i>-->Don't Want be Specific &nbsp;&nbsp;(<?php echo $sidefilter_req->residantstatus->dontwant; ?>)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 side-right">
                                            <div class="sky-form">
                                                <label class="checkbox"><!--<input type="checkbox" name="residantstatus[]" value="Rental"/><i></i>-->Rental&nbsp;&nbsp;(<?php echo $sidefilter_req->residantstatus->rental; ?>)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 side-right">
                                            <div class="sky-form">
                                                                        <label class="checkbox"><!--<input type="checkbox" name="residantstatus[]" value="Own"/><i></i>-->Own&nbsp;&nbsp;(<?php echo $sidefilter_req->residantstatus->own; ?>)</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--Resindant modu;le sction modle code end -->
                            <div class="panel panel-default no-brd">
                                <div class="panel-heading no-brd1 no-brd no-bag">
                                    <h4 class="panel-title panel-title-adjust col-md-12 no-pad">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne12" class="col-md-12 no-pad hd">
                                            <span class="fa fa-map-marker" aria-hidden="true"></span> &nbsp;Diet&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus text-right pull-right"></i>
                                        </a>
                                        <div class="clearfix"></div>
                                    </h4>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="collapseOne9" class="panel-collapse collapse in">
                                    <div class="panel-body" style="padding:8px;">
                                        <div class="col-md-8 side-right">
                                            <select name="dite" id="dite" tabindex="15" class="form-control">
                                                <option value="">Choose diet</option>
                                                <option value="Veg">Veg (<?php echo $sidefilter_req->dite->veg; ?>)</option>
                                                <option value="Non-Veg">Non-Veg (<?php echo $sidefilter_req->dite->nonveg; ?>)</option>
                                                <option value="Both">Both (<?php echo $sidefilter_req->dite->both; ?>)</option>
                                            </select>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-9">
                    <div class="col-md-12 no-pad">
                        <div class="col-md-12 no-pad">
<?php $request = json_decode($search_data); ?>
                            <div id="container">
                                <div class="view-controls-list col-md-12" id="viewcontrols">

                                    <div class="col-md-7 text-left"><h4>Search result count&nbsp;(&nbsp;<?php echo $request->search_result_count; ?>&nbsp;)</h4></div>
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
                                            $profile_image = '';
										 if($response->thumbimage!==""){ if($response->Photoprotect == 1){ $profile_image = $protect;
											 }else if($response->Profile_photo_Status == 1){
											     $profile_image = base_url().'/uploads/profilepics/'.$response->profilecode.'/'.$response->thumbimage;       
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
                                            $profile_link = base_url() . 'partnerdetails/' . $response->profilecode;
                                            ?>
                                            <li>
                                                <img src="<?php echo $profile_image; ?>" alt="<?php echo $profilename; ?>" title="<?php echo $profilename; ?>" />
                                                <section class="list-left">
                                                    <span class="title"><a  target="_new" href="<?php echo $profile_link; ?>"><?php echo $profilename; ?></a></span>
                                                    <p style="color:#222;text-transform:capitalize;font-size:11px;"><?php echo $response->profilecode; ?>&nbsp;|&nbsp;Profile Created <?php echo $response->profile_by; ?></p>

                                                    <h5><?php echo $age; ?> years,<?php echo $response->height; ?>,<?php echo $response->edu_details; ?>, <?php echo $response->occ_details; ?>, <?php echo $response->city; ?>,  <?php echo $response->country; ?>.
                                                        <div class="clearfix"></div>
                                                        <a target="_new" href="<?php echo $profile_link; ?>">View Profile</a>
                                                    </h5>
                                                    <div class="icon-group-btn">                                            
                                                        <a title="Add to Cart" href="javascript:void(0);" class="btn-cart" onclick="">  
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
                                                        <a target="_new" title="View Profile" href="<?php echo $profile_link; ?>" class="btn-wishlist">
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
                                            <div class="clearfix">&nbsp;</div>
                                            <div class="alert alert-danger text-center">
                                                No profiles found...!
                                            </div>
                                        <div class="col-md-12 text-center">
                                            <img src="<?php echo IMAGES_PATH; ?>noresult.jpg" title="" />
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
