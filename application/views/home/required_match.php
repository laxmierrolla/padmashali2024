 <?php $this->load->view('template/head'); ?> 
 <script type="text/javascript" src="<?php echo base_url();?>assets/js/formvalidate.js"></script>  
<body class="rg-body">
<div class="overlay">
    <div id="sticky-anchor"></div>
    <!-- ============================  Navigation Start =========================== -->
    <div id="tf-menu" class="navbar">
        <div class="container">
           <div class="col-md-2 col-sm-2 col-xs-12">
           <a class="brand" href="index.html"><img src="<?php echo base_url();?>assets/images/logo.png" alt="logo"></a>
           </div> <!-- end pull-right -->
            <div class="col-md-10 col-sm-12 col-xs-12 no-padding">
            <div class="col-md-10 col-sm-12 col-xs-12 no-padding nav-hdng">
                  <p>Welcome to Padmashali India Matrimony!</p>                                
            </div>                                            
           </div>
          <div class="clearfix"> </div>
        </div> <!-- end container -->
    </div> <!-- end navbar-inverse-blue -->
    
    <div class="container">
          
        <div class="col-lg-8 col-md-10 col-lg-offset-2 col-md-offset-2 add-photo">
        <div class="row register-form">
            <?php if(!empty($this->session->flashdata('photo_success'))){ ?>
           <div class="alert alert-success fade in">
                <a href="" class="close" data-dismiss="alert">&times;</a>
               <strong>Success!</strong> Photo Uploaded successfully.
          </div>
        <?php } ?>
            <form id="requiredform" name="requiredform" method="post" onSubmit="return requiredvalidate();" action="<?php echo base_url('matrimony/addPartner');?>">
            <div class="row">
                <div class="col-md-12 col-sm-12 no-padding requiedmatch">
                    <div class="col-md-12">
                        <div class="formh3">
                            <h2>Required Match </h2>
                        </div>                        
                    </div>
                    <div class="form-top col-md-10 no-padding">
                        <ul>
                            <li><a><span>*</span>All Felds are Mandatory</a></li>
                        </ul>
                    </div>                    
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                        <div class="col-md-12 rg-headng">
                            <h4> Patner Details </h4>
                        </div>  
                        <?php $profilecode = $this->session->userdata('profilecode'); ?>
                        <input type="hidden" class="form-control input-sm"  name="profilecode" id="profilecode" value="<?php echo $profilecode;?>">  
                        <div class="col-md-4 col-sm-4 col-xs-12">
                         <label> Looking for <span>*</span></label>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12"><!--chages made here-->
                            <div class="col-md-12 sky-form">
                            <label class="checkbox"> 
                            <input type="checkbox" name="looking[]" id="NeverMarried" value="NeverMarried"><i></i>Never Married</label>
                            <label class="checkbox">                
                            <input type="checkbox" name="looking[]" value="Separated" id="Separated"><i></i>Separated </label>
                             <label class="checkbox">                
                            <input type="checkbox" name="looking[]" value="Divorced" id="Divorced"><i></i>Divorced</label>      
                            <label class="checkbox">
                            <input type="checkbox" name="looking[]" value="Widow/Widower" id="Widow"><i></i>Widow/Widower </label>&nbsp                                        
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                    <label>Country Resident In <span>*</span></label>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="countryfor" id="countryfor" class="form-control input-sm input-sm1">
                       <option value="">--Select Country--</option>  
                            <?php if(isset($data1['country'])){
                            foreach($data1['country'] as $coun){?>
                            <option value="<?php echo $coun->id;?>"><?php echo $coun->name ;?></option>   
                            <?php }
                            }?>     
                    </select>                    
                    </div>
                    </div>   
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="col-md-12 no-padding">From Age <span>*</span></label>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12"><!--changes made here-->
                        <label class="col-md-1 col-sm-1 col-xs-1 no-padding mrg-r pdt-4"> From</label>
                        <select name="agefrom" id="agefrom" class="col-md-4 col-sm-4 col-xs-5 select-opt no-padding form-control input-sm">
                        <option value="">-- Age from--</option> 
                            <?php for($i=18;$i<=100;$i++)
                            {?>
                             <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                             <?php }  ?>   
                        </select>        
                        <label class="col-md-1 col-sm-1 col-xs-2 no-padding center pdt-4"> to</label>  
                        <select name="ageto" id="ageto" class="col-md-5 col-sm-4 col-xs-4 select-opt no-padding form-control input-sm">
                        <option value="">-- Age To-</option>
                        <?php for($i=18;$i<=100;$i++)
                        {?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php  } ?>    
                            
                        </select> 
                    </div>
                    </div> 
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding"><!--changes made here-->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="col-md-12 col-sm-12 col-xs-12 no-padding">Height <span>*</span></label>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <label class="col-md-1 col-sm-1 col-xs-1 no-padding mrg-r pdt-4"> From</label>
                        <select name="feetfor" class="col-md-4 col-sm-4 col-xs-4 form-control select-opt input-sm">
                        <option value="">--Height From--</option>
                           <?php if(isset($data1['height'])){
                                        foreach($data1['height'] as $value){?>
                                         <option value="<?php echo $value->feet;?>"><?php echo $value->feet ;?></option>   
                                        <?php }
                                    }?>   
                       </select>
                        <label class="col-md-1 col-sm-1 col-xs-1 no-padding center pdt-4"> to</label> 
                        <select name="feetto" class="col-md-5 col-sm-4 col-xs-4 select-opt no-padding form-control input-sm">
                        <option value="">--Height To--</option> 
                           <?php if(isset($data1['height'])){
                                        foreach($data1['height'] as $value){?>
                                         <option value="<?php echo $value->feet;?>"><?php echo $value->feet ;?></option>   
                                        <?php }
                                    }?>   
                       </select>    
                    </div>
                    </div>   <!--cahnges made end here-->
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding"><!--cahnges made here-->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <label>Complexion<span>*</span></label> 
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="cmplxionfor" id="cmplxionfor" class="form-control input-sm input-sm1">
                            <option value="">--select--</option> 
                                 <?php if(isset($data1['complexion'])){
                                        foreach($data1['complexion'] as $comp){?>
                                         <option value="<?php echo $comp->cmplex;?>"><?php echo $comp->cmplex ;?></option>   
                                        <?php }
                                    }?>                                                               
                        </select>
                    </div>
                    </div><!--cahnges made end here-->
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding"><!--cahnges made here-->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <label> Education <span>*</span></label>
                    </div>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                    <div class="col-md-12 sky-form">
                        <label class="radio">
                        <input class="mrgn-ll" type="radio" name="education" value="DoesNotMatter"><i></i>Doesn't Matter</label>   
                        <label class="radio">            
                        <input type="radio" name="education" value="Educated"><i></i>Education </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="display:none" id="chooseeducation">
                        <select name="educations[]" id="educations" tabindex="1" class="form-control input-sm col-md-10" multiple > 
                                 <?php if(isset($data1['education'])){
                                        foreach($data1['education'] as $edu){?>
                                         <option value="<?php echo $edu->edu_id;?>"><?php echo $edu->education ;?></option>   
                                        <?php }
                                    }?>
                            </select>
                    </div>
                    </div>
                    
                    </div><!--cahnges made end here-->

                    <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding"><!--cahnges made here-->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <label>Occupation <span>*</span></label>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="col-md-12 sky-form">
                         <label class="radio"> 
                        <input class="mrgn-ll" type="radio" name="occupation" value="DoesNotMatter"><i></i>Doesn't Matter</label>
                        <label class="radio">             
                        <input type="radio" name="occupation" value="Working"><i></i>Working </label>
                        <label class="radio">
                        <input type="radio" name="occupation" value="NotWorking"><i></i>Not Working</label>  
                    </div>  
                    <div class="col-md-6 col-sm-6 col-xs-12" style="display:none" id="chooseoccupation">
                       <select name="occupations[]" id="occupations" tabindex="1" class="form-control input-sm" multiple> 
                              
                                 <?php if(isset($data1['occupation'])){
                                        foreach($data1['occupation'] as $ocu){?>
                                         <option value="<?php echo $ocu->Occ_Id;?>"><?php echo $ocu->occupation ;?></option>   
                                        <?php }
                                    }?>
                            </select>
                    </div>                      
                    </div>
                    
                    </div><!--cahnges made end here-->
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding" id="anualincomee"><!--cahnges made here-->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <label>Annual Income <span>*</span></label>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12" >
                        <select name="anualincome" id="anualincome" class="form-control input-sm input-sm1">
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
                                        
               
                    
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                    <div class="col-md-4 col-sm-4 col-xs-4">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
					<br/>
                    <button class="btn btn-danger pull-right"  name="submit" type="submit">Submit</button>
                    </div>
                    </div>
                    </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
        
       
        <div class="clearfix"> </div>
    
<?php $this->load->view('template/footer.php')?>
    <!-- Javascripts
    ================================================== -->
    <!--<script type="text/javascript" src="<?php echo base_url();?>assets/jqueryvalidations/jquery.validate.min.js"></script> -->
   <script type="text/javascript">
   $(document).ready(function(){
      $('input[name="education"]').click(function(){
          var inputvalue =$(this).attr("value");
          if(inputvalue =="Educated"){
              $('#chooseeducation').show();
          }
          else{
              $('#chooseeducation').hide();
          }
          
      }); 
      
      $('input[name="occupation"]').click(function(){
          var inputvalue =$(this).attr("value");
          if(inputvalue =="Working"){
              $('#chooseoccupation').show();
               $('#anualincomee').show();
              
          }
          else{
              $('#chooseoccupation').hide();
              $('#anualincomee').hide();
          }
          
      }); 
      
      $('#educations').multiselect({
          nonSelectedText: 'Select Education',
         includeSelectAllOption: true,
         }, 'selectAll'
      );
      $('#occupations').multiselect({
          nonSelectedText: 'Select occupation',
         includeSelectAllOption: true,
         }, 'selectAll'
      );
   
   });
  


   </script>
</body></html>
