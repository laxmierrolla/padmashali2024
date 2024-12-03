<?php $this->load->view('template/userdashboard/head'); ?>
<body>
    <?php
    $this->load->view('template/userdashboard/header');
    /* print_r($this->session->all_userdata()); */
    ?>
    <div class="main-container no-mar">
        <div class="col-md-12"><!--advance search start-->
            <div class="container">
                <div class="col-md-9 no-pad"><!--b=tabs start-->
                    <div id="parentHorizontalTab" class="col-md-12 no-pad">
                        <div class="col-md-12 no-pad">
                            <ul class="resp-tabs-list hor_1 col-md-12 no-pad">
                                <li><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Advanced Search</li>
                                <li><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search by Keyword</li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <form action="<?php echo base_url(); ?>matched-result" method="post">
                        <div class="resp-tabs-container hor_1 col-md-12">
                            <div class="col-md-12 filter">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad filter1">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 filter-list">

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="inputEmail">Age<sup>*</sup></label>
                                                    <div class="col-md-12 no-pad">
                                                        <ul class="list-inline">
                                                            <li><div class="cd-select cd-filters">
                                                                    <select class="filter" name="age_from" id="age_from">
                                                                        <option value="">From Age</option>
                                                                        <?php for ($age = 18; $age < 60; $age++) { ?>
                                                                            <option value="<?php echo $age; ?>"><?php echo $age; ?> Years</option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div></li>

                                                            <li>to</li>
                                                            <li>
                                                                <div class="cd-select cd-filters">
                                                                    <select class="filter" name="age_to" id="age_to">
                                                                        <option value="">To Age</option>
                                                                        <?php for ($age_to = 18; $age_to < 60; $age_to++) { ?>
                                                                            <option value="<?php echo $age_to; ?>"><?php echo $age_to; ?> Years</option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div></li><li>Years</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="inputEmail">Height<sup>*</sup></label>
                                                    <div class="col-md-12 no-pad">
                                                        <ul class="list-inline">
                                                            <li><div class="cd-select cd-filters">
                                                                    <select class="filter" name="height_from" id="height_from">
                                                                        <option value="">Choose Feet</option> 
                                                                          <?php
                                                                           if (isset($height) && (count($height) > 0)) {
                                                                        foreach ($height as $h_res) {
                                                                            ?>
                                                                            <option value="<?php echo $h_res->feet_length; ?>"><?php echo $h_res->feet; ?></option>
                                                                            <?php  } } ?>
                                                                    </select>
                                                                </div></li>

                                                            <li>to</li>
                                                            <li>
                                                                <div class="cd-select cd-filters">
                                                                    <select class="filter" name="height_to" id="height_to">
                                                                    <option value="">Choose Feet</option>    
                                                                          <?php
                                                                           if (isset($height) && (count($height) > 0)) {
                                                                        foreach ($height as $h_res) {
                                                                            ?>
                                                                            <option value="<?php echo $h_res->feet_length; ?>"><?php echo $h_res->feet; ?></option>
                                                                            <?php  } } ?>
                                                                    </select>
                                                                </div></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="inputEmail">Marital status</label>
                                                    <div class="col-md-12 no-pad sky-form">
                                                        <ul class="list-inline">
                                                            <li><label class="checkbox"><input type="checkbox" name="maritalstatus[]" value="Never Married" /><i></i>&nbsp;NeverMarried</label></li>
                                                            <li><label class="checkbox"><input type="checkbox" name="maritalstatus[]" value="Widow" /><i></i>&nbsp;Widow</label></li>
                                                            <li><label class="checkbox"><input type="checkbox" name="maritalstatus[]" value="Divorced" /><i></i>&nbsp;Divorced</label></li>
                                                            <li><label class="checkbox"><input type="checkbox" name="maritalstatus[]" value="Separated" /><i></i>&nbsp;Separated</label></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 filter-list">
                                            <div class="row">

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="inputEmail">Education</label>
                                                        <div class="clearfix"></div>
                                                        <div class="col-md-7">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    Education Categories
                                                                </div>
                                                                <div class="panel-body no-pad">
                                                                    <div class="col-md-12 education">
                                                                        <div class="col-md-11 col-md-push-1">
                                                                            <input type="text" name="" class="form-control" />
                                                                            <div class="sky-form">
                                                                                <ul class="list-inline">
                                                                                    <?php
                                                                                    if (isset($education) && count($education) > 0) {
                                                                                        foreach ($education as $edu) {
                                                                                            ?>
                                                                                            <li><label class="checkbox"><input type="checkbox" name="education[]" value="<?php echo $edu->edu_id; ?>"><i></i>&nbsp;<?php echo ucfirst($edu->education); ?></label></li>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!--search by id ends-->
                                                        </div>
                                                        
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 filter-list">
                                            <div class="row">

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="inputEmail">Occupation</label>
                                                        <div class="clearfix"></div>
                                                        <div class="col-md-7">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    Occupation Categories
                                                                </div>
                                                                <div class="panel-body no-pad">
                                                                    <div class="col-md-12 education">
                                                                        <div class="col-md-11 col-md-push-1">
                                                                            <input type="text" name="" class="form-control" />
                                                                            <div class="sky-form">
                                                                                <ul class="list-inline">
                                                                                    <?php
                                                                                    if (isset($occupation) && count($occupation) > 0) {
                                                                                        foreach ($occupation as $ocu) {
                                                                                            ?>
                                                                                            <li><label class="checkbox"><input type="checkbox" name="occupation[]" value="<?php echo $ocu->Occ_Id; ?>"><i></i>&nbsp;<?php echo ucfirst($ocu->occupation); ?></label></li>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!--search by id ends-->
                                                        </div>
                                                        
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="inputEmail">Annual Income<sup>*</sup></label>
                                                <div class="cd-select cd-filters">
                                                    <select name="anual_income" id="anual_income" >
                                                        <option value="">--Choose Income--</option>
                                                        <option value="Upto INR 1 Lakh" label="Upto INR 1 Lakh">Upto INR 1 Lakh</option>
                                                        <option value="INR 1 Lakh to 2 Lakh" label="INR 1 Lakh to 2 Lakh">INR 1 Lakh to 2 Lakh</option>
                                                        <option value="INR 2 Lakh to 4 Lakh" label="INR 2 Lakh to 4 Lakh">INR 2 Lakh to 4 Lakh</option>
                                                        <option value="INR 4 Lakh to 7 Lakh" label="INR 4 Lakh to 7 Lakh">INR 4 Lakh to 7 Lakh</option>
                                                        <option value="INR 7 Lakh to 10 Lakh" label="INR 7 Lakh to 10 Lakh">INR 7 Lakh to 10 Lakh</option>
                                                        <option value="INR 10 Lakh to 15 Lakh" label="INR 10 Lakh to 15 Lakh">INR 10 Lakh to 15 Lakh</option>
                                                        <option value="INR 15 Lakh to 20 Lakh" label="INR 15 Lakh to 20 Lakh">INR 15 Lakh to 20 Lakh</option>
                                                        <option value="INR 20 Lakh to 30 Lakh" label="INR 20 Lakh to 30 Lakh">INR 20 Lakh to 30 Lakh</option>
                                                        <option value="INR 30 Lakh to 50 Lakh" label="INR 30 Lakh to 50 Lakh">INR 30 Lakh to 50 Lakh</option>
                                                        <option value="INR 50 Lakh to 75 Lakh" label="INR 50 Lakh to 75 Lakh">INR 50 Lakh to 75 Lakh</option>
                                                        <option value="INR 75 Lakh to 1 Crore" label="INR 75 Lakh to 1 Crore">INR 75 Lakh to 1 Crore</option>
                                                        <option value="INR 1 Crore &amp; above" label="INR 1 Crore &amp; above">INR 1 Crore &amp; above</option>
                                                        <option value="Not applicable" label="Not applicable">Not applicable</option>
                                                        <option value="Dont want to specify" label="Dont want to specify">Dont want to specify</option>                                            
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    Employee In
                                                </div>
                                                <div class="panel-body no-pad">
                                                    <div class="col-md-12 education">
                                                        <div class="col-md-11 col-md-push-1">

                                                            <div class="sky-form">
                                                                <ul class="list-inline">
                                                                    <?php
                                                                    if (isset($employee) && (count($employee) > 0)) {
                                                                        foreach ($employee as $emp) {
                                                                            ?>
                                                                            <label class="checkbox"><input type="checkbox" name="employee[]" value="<?php echo $emp->emp_id; ?>"><i></i><?php echo $emp->employee; ?></label>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!--search by id ends-->
                                        </div>

                                        <div class="col-md-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    Special cases
                                                </div>
                                                <div class="panel-body no-pad">
                                                    <div class="col-md-12 education">
                                                        <div class="col-md-11 col-md-push-1">

                                                            <div class="sky-form">
                                                                <ul class="list-inline">
                                                                    <?php
                                                                    if (isset($specilcase) && (count($specilcase) > 0)) {
                                                                        foreach ($specilcase as $spl) {
                                                                            ?>
                                                                            <label class="checkbox"><input type="checkbox" name="specialcase[]" value="<?php echo $spl->spl_id; ?>"><i></i><?php echo $spl->spacial; ?></label>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!--search by id ends-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="inputEmail">Raasi<sup>*</sup></label>
                                                <div class="cd-select cd-filters">
                                                    <select name="rasi" id="rasi">
                                                        <option value="">Choose Zodiac / Rasi</option>
                                                        <?php
                                                        if (isset($rasi)) {
                                                            foreach ($rasi as $rasi) {
                                                                ?>
                                                                <option value="<?php echo $rasi->rasi_id; ?>"><?php echo $rasi->rasi; ?></option>   
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="inputEmail">Star <sup></sup></label>
                                                <div class="cd-select cd-filters">
                                                    <select name="star" id="star">
                                                        <option value="" selected>Choose Star</option>
                                                        <?php
                                                        if (isset($star)) {
                                                            foreach ($star as $star) {
                                                                ?>
                                                                <option value="<?php echo $star->star_id; ?>"><?php echo $star->star; ?></option>   
                                                                <?php
                                                            }
                                                        }
                                                        ?> 
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="inputEmail">Manglik Status</label>
                                                <div class="cd-select cd-filters">
                                                    <div class="col-md-12 sky-form">
                                                        <label class="checkbox"><input type="checkbox" name="manglik[]" value="Yes"><i></i>Yes</label>
                                                        <label class="checkbox"><input type="checkbox" name="manglik[]" value="No"><i></i>No</label>
                                                        <label class="checkbox"><input type="checkbox" name="manglik[]" value="Doesn't Matter"><i></i>Doesn't Matter</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="inputEmail">Country<sup>*</sup></label>
                                                <div class="cd-select cd-filters">
                                                    <select name="country" id="country">
                                                        <option value="">Choose Country</option>  
                                                        <?php
                                                        if (isset($country)) {
                                                            foreach ($country as $coun) {
                                                                ?>
                                                                <option value="<?php echo $coun->id; ?>"><?php echo $coun->name; ?></option>   
                                                                <?php
                                                            }
                                                        }
                                                        ?>                                           
                                                    </select>     
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="inputEmail">State<sup>*</sup></label>
                                                <div class="cd-select cd-filters">
                                                    <select name="state"  id="state"  >
                                                        <option value="">Choose State</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="inputEmail">City</label>
                                                <div class="cd-select cd-filters">
                                                    <select name="city" id="city" >
                                                        <option value="">Choose City</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <div class="form-group sky-form">
                                                <label for="inputEmail">Resident status<sup>*</sup></label>
                                                <ul class="list-inline">
                                                    <li><label class="checkbox"><input type="checkbox" name="residantstatus[]" value="Dont Want be Specific"/><i></i>Don't Want be Specific</label></li>
                                                    <li><label class="checkbox"><input type="checkbox" name="residantstatus[]" value="Rental"/><i></i>Rental</label></li>
                                                    <li><label class="checkbox"><input type="checkbox" name="residantstatus[]" value="Own"/><i></i>Own</label></li>
                                                   
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group sky-form">
                                                <label for="inputEmail">Diet<sup></sup></label>
                                                <select name="dite" id="dite" tabindex="15">
                                                    <option value="">Choose diet</option>
                             <option value="Veg">Veg</option>
                             <option value="Non-Veg">Non-Veg</option>
                             <option value="Both">Both</option>
                        </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-2 col-md-push-6">
                                                <input type="submit" class="btn btn-warning btn-md" value="Submit" />
                                            </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 filter">
                                <h3 class="text-center">Enter keywords</h3>
                                <h5 class="text-center">Example: "Name,Profile code ,location, education,occupation"</h5>
                                <div class="clearfix">&nbsp;</div>
                                <div class="col-md-push-1 col-md-10">
                                    <form action="<?php echo base_url(); ?>matched-result" method="post" >
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input type="text" name="search_keyword" id="search_keyword" class="form-control" placeholder="Search&hellip;">
                                            <span class="input-group-btn">
                                                <button type="button" type="submit" class="btn btn-default">Go</button>
                                            </span>
                                        </div>
                                    </div>
                                    </form>
                                    <div class="clearfix">&nbsp;</div>
                                    <p>Help : _ _ </p>
                                </div>
                            </div>

                        </div>
                        </form>
                    </div>
                </div><!--tabs end-->
                <div class="col-md-3"><!--search by id start-->
                    <div class="panel panel-default no-brd1 no-brd">
                        <div class="panel-heading hd">
                            Search By Id
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="text" id="search_byid" name="search_byid" class="form-control" placeholder="Seach Profile ID&hellip;" maxlength="10" autocomplete="off"/>
                                    <span class="input-group-btn">
                                        <button type="button" onclick="searchProfile()" class="btn btn-warning">Go</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div><!--search by id ends-->
                </div>
                <div class="clearfix"></div>  
            </div><!--advance search end-->
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <?php $this->load->view('template/userdashboard/footer') ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script> 

        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/easyResponsiveTabs.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                //Vertical Tab
                $('#parentHorizontalTab').easyResponsiveTabs({
                    type: 'default', //Types: default, vertical, accordion
                    width: 'auto', //auto or any width like 600px
                    fit: true, // 100% fit in a container
                    tabidentify: 'hor_1', // The tab groups identifier
                    activate: function (event) { // Callback function if tab is switched
                        var $tab = $(this);
                        var $info = $('#nested-tabInfo');
                        var $name = $('span', $info);
                        $name.text($tab.text());
                        $info.show();
                    }
                });




                $('#country').on('change', function () {
                    var contry_id = $("#country").val();
                    var jqxhr = $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('matrimony/getStates') ?>",
                        data: {contry_id: contry_id},
                        beforeSend: function () {
                        }
                    }).done(function (data) {
                        // alert(data);
                        var jsonStatesData = JSON.parse(data);
                        if (jsonStatesData == '')
                        {
                            $('#state').html('<option value="">State Not Found</option>');
                        }
                        else {
                            var i = 1;
                            $('#state').children('option').remove()
                            $('#state' + i).html('<option value="">Select State</option>');
                            $.each(jsonStatesData, function (key, value) {
                                $('[name="state"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                                i++;
                            });
                        }
                    });
                });

                //select city based on state   
                $('#state').on('change', function () {
                    var state_id = $("#state").val();
                    var jqxhr = $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('matrimony/getCities') ?>",
                        data: {state_id: state_id},
                        beforeSend: function () {
                        }
                    }).done(function (data) {
                        var jsonCityData = JSON.parse(data);
                        if (jsonCityData == '')
                        {
                            $('#city').html('<option value="">City Not Found</option>');
                        }
                        else {
                            var i = 1;
                            $('#city').children('option').remove()
                            $('#city' + i).html('<option value="">Select City</option>');
                            $.each(jsonCityData, function (key, value) {
                                $('[name="city"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                                i++;
                            });
                        }
                    });
                });
            });
            
            function searchProfile()
            {
                $('#search_byid').css({'border':''});
                var profileid=$('#search_byid').val();
                if(profileid!='')
                {
                    window.location="<?php echo base_url(); ?>partnerdetails/"+profileid;
                }
                else
                {
                    $('#search_byid').css({'border':'1px solid red'});
                }
            }
        </script>

</body>
                                                                        
</html>
