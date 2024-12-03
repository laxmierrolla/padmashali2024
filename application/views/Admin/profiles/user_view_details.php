<?php
//echo"<pre>";
// print_r($vieweddata);
// exit;
$this->load->view('Admin/common_header');
$this->load->view('Admin/sidenav');

?> 
  <!-- =============================================== -->
  <style>
  .info-box-text {
    text-transform: none;
}
.badge{
    min-width:80px;
}
.box-title {
  color:#0000ff;
font-weight: bold;  
}
.empty{
    text-align:center;
    color:red;
    font-size:15px;
    font-weight:bold
}
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
        <div class="row">
             <div class="box box-info">
            <div class="box-header with-border">
                
              <h3 class="box-title"><?php if($vieweddata){ echo"Contacts Viewd By".$vieweddata['FullName']."(".$vieweddata['viewdbymecount'].")";}?></h3>
             
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
                    <th>Sno</th>  
                    <th>Viewed ProfileID</th>
                    <th>Viewed Date</th>
                  </tr>
                  </thead>
                  <tbody>
                     
                  <?php  $i=1; if($vieweddata['viewedbyme']!=="NoDataFound"){foreach($vieweddata['viewedbyme'] as $value){?>
                  <tr>
                    <td><?php echo $i;$i++?></td>
                    <td><?php echo $value['VParnerId']; ?></td>
                    <td><?php echo $value['VDate'];?></td> 
                  </tr>
                 <?php }}else{
                   ?>
                  <tr><td colspan="3" class="empty">No Contacts Found</td></tr>
                  <?php }?>
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
             <h3 class="box-title"><?php if($vieweddata){ echo $vieweddata['FullName']." Contacts Viewd By Others"."(".$vieweddata['viewdbyotherscount'].")";}?></h3>
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
                    <th>Sno</th>  
                    <th>Viewed ProfileID</th>
                    <th>Viewed Date</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php  $i=1; if($vieweddata['viewdbyothers']!=="NoDataFound"){foreach($vieweddata['viewdbyothers'] as $value){?>
                    <tr>
                    <td><?php echo $i;$i++?></td>
                    <td><?php echo $value['VMyId']; ?></td>
                    <td><?php echo $value['VDate'];?></td> 
                  </tr>
                  <?php }}else{
                   ?>
                  <tr><td colspan="3" class="empty">No Contacts Found</td></tr>
                  <?php }?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
         
          </div> 
        </div>
    </section>
  </div>
<?php
  $this->load->view('Admin/common_fotter');
?> 