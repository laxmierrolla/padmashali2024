<?php $this->load->view('template/head'); ?>
  <style type="text/css">
    .thankyou-bg{background:#f7f7f5;width:100%;height:auto;min-height:300px;margin:7em 0em 6em 0em;}
  </style> 
<body class="rg-body">
    <div class="overlay">
        <div id="sticky-anchor"></div> 
            <div id="tf-menu" class="navbar">
                <div class="container">
                <div class="col-md-2 col-sm-2 col-xs-12">
                <a class="brand" href="index.html"><img src="<?php echo base_url();?>assets/images/logo.png" alt="logo"></a>
                </div> <!-- end pull-right -->
                <div class="col-md-10 col-sm-12 col-xs-12 no-padding nav-hdng">
                  <p>Welcome to Padmashali India Matrymony!</p>                                
                </div>
            <div class="clearfix"> </div>
        </div> <!-- end container -->
    </div>
  
<div class="container">
  <div class="col-md-8 col-md-push-2">
  <div class="col-md-12 thankyou-bg text-center"> 
  <form name="forgotpass" id="forgotpass" action="#" method="post"> 
  <label>Email</label>
  <input type="email" name="mail" id="mali" value="" required ></br>
  <!--<span class="email_error" style="display:none; color:red"></span>-->
  <input type="submit" name="save" id="save" value="submit">
</form>
</div>
</div>
 </div>
 </div>
    <div class="clearfix"> </div>
    <?php $this->load->view('template/footer.php')?> 
      
 <script>

     
  $(document).on('change','#email',function(){
      alert("helo");    
        var email = $('#email').val();
      
        if(email!=""){
            $.ajax({
                method:"POST",
                url:"<?php echo base_url();?>matrimony/check_email",  
                data:{email:email}, 
                success:function(data) 
                { 
                    alert(data);
                 var status = $.trim(data);
                 console.log(status);
                    if(status == 'success') {  
                       $('.email_error').hide();
                  }
                  else{
                      $('.email_error').show();
                  }   
                }
            });
        }
    });        
    
</script> 
</body>
</html>

