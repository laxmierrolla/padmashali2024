 <?php
 
$this->load->view('Admin/common_header');
$this->load->view('Admin/sidenav');

?> 
  <!-- =============================================== -->
  <style>
  .info-box{
          min-height: 140px;
   }
  .info-box-text {
    text-transform: none;
}
.info-box-icon{
    height: 140px;
}
.badge{
    min-width:80px;
}
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
       <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-person"></i></span>

            <div class="info-box-content">
                <?php if($maleusers){?>
                    <span class="info-box-number">Male</span>
                    <span class="info-box-text">Total<small>:<span class="pull-right badge bg-light-blue"><?php echo $maleusers['total']; ?></span></small></span>
                    <span class="info-box-text">Active<small>:<span class="pull-right badge bg-light-blue"><?php echo $maleusers['active']; ?></span></small></span>
                    <span class="info-box-text">Inactive<small>:<span class="pull-right badge bg-light-blue"><?php echo $maleusers['inactive']; ?></span></small></span>
               <?php }?>
              
              
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-woman"></i></span>	

            <div class="info-box-content">
             <?php if($femaleusers){?>
                <span class="info-box-number">Female</span>
                <span class="info-box-text">Total<small>:<span class="pull-right badge bg-light-blue"><?php echo $femaleusers['total']; ?></span></small></span>
                <span class="info-box-text">Active<small>:<span class="pull-right badge bg-light-blue"><?php echo $femaleusers['active']; ?></span></small></span>
                <span class="info-box-text">Inactive<small>:<span class="pull-right badge bg-light-blue"><?php echo $femaleusers['inactive']; ?></span></small></span>
            <?php }?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
                <?php if($membership){?>
                    <span class="info-box-number">Membership</span>
                    <span class="info-box-text">Offline<small>:<span class="pull-right badge bg-light-blue"><?php echo $membership['offline']; ?></span></small></span>
                    <span class="info-box-text">Online<small>:<span class="pull-right badge bg-light-blue"><?php echo $membership['online']; ?></span></small></span>
                    <span class="info-box-text">Free<small>:<span class="pull-right badge bg-light-blue"><?php echo $membership['free']; ?></span></small></span>
                    <span class="info-box-text">Paid<small>:<span class="pull-right badge bg-light-blue"><?php echo $membership['offline'] +  $membership['online']; ?></span></small></span>
                    <span class="info-box-text">Expired<small>:<span class="pull-right badge bg-light-blue"><?php echo $membership['expired']; ?></span></small></span>
               <?php }?>
              
              
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       
        <!-- /.col -->
      </div>
        
        <div class="row">
             <div class="box box-info">
            <div class="box-header with-border">
                <?php if($todayusers){ ?>
              <h3 class="box-title">Today Registered Users (<?php echo $todayusers['count'] ?>)</h3>
                <?php } ?>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Profile ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Member</th>
                    <th>Valid UpTo</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php if($todayusers['count'] > 0){ foreach($todayusers[0] as $users){?>   
                  <tr>
                    <td><?php echo $users['profile_code']; ?></td>
                    <td><?php echo $users['sname'].$users['fname'].$users['lname']; ?></td>
                    <td><?php echo $users['email'];?></td>  
                    <td><?php echo $users['gender'];?></td>
                    <td><?php  
                    if ($users['payment_status'] == 0){echo'<span class="label label-warning">Free Member</span>';}
                    if ($users['payment_status'] == 2){echo '<span class="label label-info">Paid Member</span>';}
                    if ($users['payment_status'] == 1){echo '<span class="label label-danger">Expired Member</span>';}
                   if ($users['payment_status'] == 3){echo '<span class="label label-info">Paid Member</span>';}
                    ?></td>
                    <td><?php echo $users['subscribe_validity'];?></td>  
                    <td><a href="#"><span class="label label-success">View</span></a></td>
                  </tr>
                   <?php } }
                   else{?>
                  <td style="color:red;text-align: center; font-size:16px"  colspan="7"><?php echo$todayusers['message']; ?><td>
                  <?php }
                   ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
         
          </div> 
        </div>
        
         <div class="row">
            <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Recent Users</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Profile ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if($recentusers){
                        foreach($recentusers as $users){ ?>
                        <tr>
                            <td><?php echo $users->profile_code; ?></td>
                            <td><?php echo $users->sname.$users->fname.$users->lname; ?></td>
                            <td><?php echo $users->email ?></td>  
                            <td><?php echo $users->gender ?></td>
                            <td><a href="#"><span class="label label-success">View</span></a></td>
                        </tr>
                              
                     <?php  }} ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
         
          </div> 
        </div>
        
        <a href="<?php echo base_url('admin/createFolder');?>"><span>folder create</span></a><br>
        <a href="<?php echo base_url('admin/imageMove');?>"><span>imageMove</span></a><br>
		<a href="<?php echo base_url('admin/Movethumb');?>"><span>thumbmove</span></a><br>
		<a href="<?php echo base_url('admin/imagesquery');?>"><span>imagequery</span></a><br>
		<a href="<?php echo base_url('admin/imagesquery1');?>"><span>imagequery1</span></a>
		
        
    </section>
  </div>
<?php
  $this->load->view('Admin/common_fotter');
?> 