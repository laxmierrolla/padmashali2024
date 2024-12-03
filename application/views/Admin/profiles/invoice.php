<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Padmashali Matrimony</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
   <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- jQuery 3.1.1 -->
<script src="<?php echo base_url();?>assets/admin/jquery-3.1.1.min.js"></script>
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
           <img src="<?php echo base_url();?>assets/images/logo.png" alt="logo" style="width:120px;height:66px">Padmashali Matrimony.
          <small class="pull-right">Date:<?php echo date('d-M-Y');?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>Padmashali Marriage Bureau.</strong><br>
          3-5-80, Padmashali Bhavan<br>
          Rajmohalla, Narayanaguda,<br>
          Hyderabad-500029<br>
          040-24765557 / 24765558 / 24765559
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong><?php if($invoice->Fullname){echo $invoice->Fullname;}?></strong><br>
          <?php if($invoice->address){echo $invoice->address;}?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>ReceiptNumber:</b><?php if($invoice->receiptnumber && $invoice->receiptnumber!==""){echo $invoice->receiptnumber; }else{echo"N.A";}?><br>
        <br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>S.No</th>
            <th>Profilecode</th>
            <th>Package</th>
            <th>Price</th>
            <th>ValidDays</th>
			<th>ValidUpTo</th>
          </tr>
          </thead>
          <tbody>
		    <td>1</td>
			<td><?php if($invoice->profile_code){echo $invoice->profile_code; }?></td>
			<td><?php if($invoice->package && $invoice->package!==""){echo $invoice->package; }else{echo"N.A";}?></td>
			<td><?php if($invoice->price && $invoice->price!==""){echo $invoice->price; }else{echo"N.A";}?></td>
			<td><?php if($invoice->valid && $invoice->valid!==""){echo $invoice->valid."Days"; }else{echo"N.A";}?></td>
			<td><?php if($invoice->subscribe_validity && $invoice->subscribe_validity!==""){echo date('d-M-Y',strtotime($invoice->subscribe_validity)); }else{echo"N.A";}?></td>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

   
      <!-- accepted payments column -->
      
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
