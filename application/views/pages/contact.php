
<?php 
//print_r($about);
//exit;
$this->load->view('template/head'); ?> 
<body>
     <?php $this->load->view('template/header'); ?> 
     <div class="main-container no-mar">
        <div class="card">
            <br/><br/><br/><br/>
            <h3 class="main-heading" style="margin:30px 80px">Contact Us</h3>
            <div class="container" style="margin:80px 65px">
                <p><?php if($contact){foreach($contact as $value){
                   echo $value->Contact_Desc;
               }}; ?></p>
            </div>
        </div>
     </div>
</body>

<?php $this->load->view('template/footer.php')?>
