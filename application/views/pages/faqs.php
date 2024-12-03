
<?php 
//print_r($about);
//exit;
$this->load->view('template/head'); ?> 
<body>
     <?php $this->load->view('template/header'); ?> 
     <div class="main-container no-mar">
        <div class="card">
            <br/><br/><br/><br/>
            <h3 class="main-heading" style="margin:40px 80px 0px 80px ">Faq's</h3>
            <div class="container" style="margin-top:20px">
                <ul>
                    <?php $i=1;
                    if($faq){ foreach($faq as $value){?>
                         <li style="margin:20px">
                            <a href="#"><?php echo $i; ?>. <?php echo $value->FaqQuestion; ?></a>
                            <div class="st-content">
                                <p><?php echo stripslashes($value->FaqAnswer); ?></p>
                                <div class="clear"></div>
                            </div>
                        </li>
                    <?php $i++; }}?>
           
              </ul>
            </div>
        </div>
     </div>
</body>

<?php $this->load->view('template/footer.php')?>
