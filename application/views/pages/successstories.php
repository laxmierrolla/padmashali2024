
<?php 
//print_r($about);
//exit;
$this->load->view('template/head'); ?> 
<body>
     <?php $this->load->view('template/header'); ?> 
     <div class="main-container no-mar">
        <div class="card">
            <br/><br/><br/><br/>
            <h3 class="main-heading">Sucess Stories</h3>
            <div class="container" style="margin-top:120px">
                <?php if($success){foreach($success as $value){?>
                <div class="success"><!--success start starts-->
                    <img class="success-left" src="uploads/stories/<?php echo $value->Image;?>" alt=".."/>
                    <h4 class="couple-name"><?php echo ucfirst($value->Couple_Name);?></h4>
                    <h5 class="date-m"><?php echo ucfirst($value->Couple_Name);?>, getting married on <?php echo date('d-M-Y',strtotime($value->MarriedOn));?>.</h5>
                    <p><?php echo ucwords($value->Description);?></p>                           
                    <div class="clear"></div>
                </div><!--success start ends-->
                <?php }}?>
            </div>
        </div>
     </div>
</body>

<?php $this->load->view('template/footer.php')?>
