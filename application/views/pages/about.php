
<?php 
//print_r($about);
//exit;
$this->load->view('template/head'); ?> 
<body>
     <?php $this->load->view('template/header'); ?> 
     <div class="main-container no-mar">
        <div class="card">
            <br/><br/><br/><br/>
            <h3 class="main-heading" style="margin:40px 65px"><b>About Us</b></h3>
            <div class="container" style="margin:20px 50px">
                <p><?php if($about){foreach($about as $value){
                   echo $value->Career_Desc;
               }}; ?></p>
            </div>
        </div>
     </div>
</body>

<?php $this->load->view('template/footer.php')?>
