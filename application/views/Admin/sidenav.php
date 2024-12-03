<!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
  
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li >
            <a href="<?php echo base_url('admin/adminDashboard');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
             </a> 
        </li>
      
        <li class="treeview">
          <a href="#">
            <i class="fa  fa-file-o"></i> <span>Mange Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('package')?>"><i class="fa fa-gift"></i>Packages</a></li>
            <li><a href="<?php echo base_url('occupation')?>"><i class="fa fa-suitcase"></i>Occupation</a></li>
            <li><a href="<?php echo base_url('employeed')?>"><i class="fa fa-black-tie"></i>EmployeedIn</a></li>
            <li><a href="<?php echo base_url('specialcases')?>"><i class="fa fa-circle-o"></i>Special Cases</a></li>
	    <li><a href="<?php echo base_url('questions')?>"><i class="fa fa-question-circle"></i>Request Questions</a></li>
            <li><a href="<?php echo base_url('countries')?>"><i class="fa fa-globe"></i>Countries</a></li>
            <li><a href="<?php echo base_url('state')?>"><i class="fa fa-circle-o"></i>State</a></li>
            <li><a href="<?php echo base_url('cities')?>"><i class="fa fa-circle-o"></i>Cities</a></li>
            <li><a href="<?php echo base_url('admin/cancelledAccounts')?>"><i class="fa fa-user-times"></i>CancelAccounts</a></li>
            <li><a href="<?php echo base_url('admin/emails')?>"><i class="fa fa-envelope"></i>Email</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i> <span>GroupMangement</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('group')?>"><i class="fa fa-circle-o"></i>Groups</a></li>
            <li><a href="<?php echo base_url('staff')?>"><i class="fa fa-circle-o"></i>Staff</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>UserMangement</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="<?php echo base_url('admin/addUserProfile')?>"><i class="ion ion-person-add"></i>Add New User</a></li>
           <li><a href="<?php echo base_url('viewProfiles')?>"><i class="fa fa-users"></i>View All Users</a></li>
          <li><a href="<?php echo base_url('admin/packageRenewal')?>"><i class="fa fa-money-bill"></i>Renwel Account</a></li>
         <li><a href="<?php echo base_url('package/updateViewsPage')?>"><i class="fa fa-eye"></i>Update Views</a></li>
         <li><a href="<?php echo base_url('admin/deleteProfiles')?>"><i class="fa fa-trash"></i>Delete Profile</a></li>
         <li><a href="<?php echo base_url('admin/marriedAccounts')?>"><i class="fa fa-react"></i>Married profiles</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-picture-o"></i> <span>Gallery</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('gallery')?>"><i class="fa fa-circle-o"></i>Gallery</a></li>
            <li><a href="<?php echo base_url('gallery/photogallery')?>"><i class="fa fa-circle-o"></i>PhotoGallery</a></li>
            <li><a href="<?php echo base_url('news')?>"><i class="fa fa-newspaper"></i>News</a></li>
            <li><a href="<?php echo base_url()?>Newsticker"><i class="fa fa-circle-o"></i>Newsticker</a></li>
          </ul>
        </li>
	<li class="treeview">
          <a href="#">
            <i class="fa fa-codepen"></i> <span>CMS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('events')?>"><i class="fa fa-circle-o"></i>Events</a></li>
            <li><a href="<?php echo base_url('aboutUs')?>"><i class="fa fa-circle-o"></i>AboutUs</a></li>
            <li><a href="<?php echo base_url('contactUs')?>"><i class="fa fa-circle-o"></i>ContactUs</a></li>
            <li><a href="<?php echo base_url('terms')?>"><i class="fa fa-circle-o"></i>Terms</a></li>
            <li><a href="<?php echo base_url('privacy')?>"><i class="fa fa-circle-o"></i>Privacy</a></li>
            <li><a href="<?php echo base_url('faqs')?>"><i class="fa fa-circle-o"></i>FAQ's</a></li>
            <li><a href="<?php echo base_url('success_stories')?>"><i class="fa fa-circle-o"></i>SuccessStories</a></li>
            <li><a href="<?php echo base_url('service')?>"><i class="fa fa-circle-o"></i>Services</a></li>
            <li><a href="<?php echo base_url('advertisement')?>"><i class="fa fa-circle-o"></i>Advertisements</a></li>
          </ul>
        </li>
	 <li class="treeview <?php if($this->uri->segment(1)=="reports"){echo "active open";}?>">
          <a href="#">
            <i class="fa fa-bars"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('reports')?>"><i class="fa fa-bars"></i>All User Reports</a></li>
            <li><a href="<?php echo base_url('reports/contacts')?>"><i class="fa fa-bars"></i>Contact Reports</a></li>
          </ul>
        </li>	
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
