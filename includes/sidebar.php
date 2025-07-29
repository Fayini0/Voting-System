<?php
// File: sidebar.php

function echoSidebarMenu($currentPage) {
?>
<style>
  .main-sidebar {
    background-color: #333333;
    color: #ffffff;
    width: 200px;
  }
  .sidebar-menu {
    list-style-type: none;
    padding: 0;
    margin: 0;
  }
  .sidebar-menu li {
    padding: 10px 15px;
  }
  .sidebar-menu li.header {
    background-color: #1e1e1e;
    color: #7a7a7a;
    padding: 10px 15px;
    font-size: 12px;
    text-transform: uppercase;
  }
  .sidebar-menu li a {
    color: #ffffff;
    text-decoration: none;
    display: flex;
    align-items: center;
  }
  .sidebar-menu li.active {
    background-color: #e26310;
  }
  .sidebar-menu li:hover:not(.header) {
    background-color: #4a4a4a;
  }
  .sidebar-menu li i {
    margin-right: 10px;
    width: 20px;
    text-align: center;
  }
</style>
<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li class="header">NAVIGATION</li>
      <li <?php echo ($currentPage == 'home') ? 'class="active"' : ''; ?>>
        <a href="user_home.php">
          <i class="fa fa-palette"></i> <span>Home</span>
        </a>
      </li>
      <li <?php echo ($currentPage == 'voting') ? 'class="active"' : ''; ?>>
        <a href="voting.php">
          <i class="fa fa-check-square"></i> <span>Voting</span>
        </a>
      </li>
      <li <?php echo ($currentPage == 'results') ? 'class="active"' : ''; ?>>
        <a href="results.php">
          <i class="fa fa-trophy"></i> <span>Results</span>
        </a>
      </li>
      <li>
        <a href="logout.php">
          <i class="fa fa-sign-out-alt"></i> <span>Logout</span>
        </a>
      </li>
    </ul>
  </section>
</aside>
<?php
}
?>