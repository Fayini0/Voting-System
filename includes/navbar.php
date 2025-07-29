<header class="main-header">
  <nav class="navbar navbar-static-top navbar-red" style="background-color: #E26310 !important; border-color: #990000 !important;">
    <div class="container">
      <div class="navbar-header">
        <a href="#" class="navbar-brand" style="color: #ffffff !important;"><b>SPUEVOTEHUB</b></a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars" style="color: #ffffff !important;"></i>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <?php
            if(isset($_SESSION['student'])){
              echo "
                <li><a href='index.php' style='color: #ffffff !important;'>HOME</a></li>
                <li><a href='transaction.php' style='color: #ffffff !important;'>TRANSACTION</a></li>
              ";
            } 
          ?>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="user user-menu">
            <a href="" style="color: #ffffff !important;">
              <img src="<?php echo (!empty($voter['photo'])) ? 'images/'.$voter['photo'] : 'images/profile.jpg' ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $voter['email']; ?></span>
            </a>
          </li>
          <li><a href="logout.php" style="color: #ffffff !important;"><i class="fa fa-sign-out"></i> LOGOUT</a></li>  
        </ul>
      </div>
      <!-- /.navbar-custom-menu -->
    </div>
    <!-- /.container-fluid -->
  </nav>
</header>

<style>
  .navbar-red {
    background-color: #cc0000 !important;
    border-color: #990000 !important;
  }
  .navbar-red .navbar-brand,
  .navbar-red .navbar-nav > li > a {
    color: #ffffff !important;
  }
  .navbar-red .navbar-nav > li > a:hover,
  .navbar-red .navbar-nav > li > a:focus {
    background-color: #990000 !important;
  }
  .navbar-red .navbar-toggle {
    border-color: #ffffff !important;
  }
  .navbar-red .navbar-toggle .icon-bar {
    background-color: #ffffff !important;
  }
</style>