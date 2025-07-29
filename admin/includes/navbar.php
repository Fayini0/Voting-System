<header class="main-header" style="background-color: #c30010;">
  <!-- Logo -->
  <a href="#" class="logo" style="background-color: #000; color: #FF0000;">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b style="color: #FF0000;">V</b><span style="color: #FFF;">TS</span></span>
    <!-- logo for regular state and mobile devices -->
     <span class="logo-lg"><b>SPUEVOTEHUB System</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" style="background-color: #c30010;">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="color: black">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #FFF;">
            <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $user['firstname'].' '.$user['lastname']; ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header" style="background-color: #c30010; color: #FFF;">
              <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">

              <p>
                <?php echo $user['firstname'].' '.$user['lastname']; ?>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#profile" data-toggle="modal" class="btn btn-default btn-flat" id="admin_profile" style="background-color: #c30010; color: #FFF; border-color: #c30010">Update</a>
              </div>
              <div class="pull-right">
                <a href="logout.php" class="btn btn-default btn-flat" style="background-color: #c30010; color: #FFF; border-color: #c30010;">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
<?php include 'includes/profile_modal.php'; ?>
