<?php
$this->load->view('template/userdashboard/head');

?>
 <link href="<?php echo base_url();?>assets/albumfiles/dropzone.css" rel="stylesheet" type="text/css">
  
<body>
    <?php
    $this->load->view('template/userdashboard/header');
    /* print_r($this->session->all_userdata()); */
    //print_r($sidefilter_req->employee_in);
    ?>
    <div class="main-container no-mar">
	<?php // print_r($userinfo); ?>
        <div class=" card container" style="min-height:500px;padding">
		
           <div class="col-md-12" style="padding:2%;">   
				
		   
		</div>
		   
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
		
<?php $this->load->view('template/userdashboard/footer') ?>


</body>
</html>
