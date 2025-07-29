<aside class="main-sidebar" style="background-color: #2c2c2c;">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel" style="padding: 20px; text-align: center; background-color: #444444;">
      <div class="image" style="margin-bottom: 10px;">
        <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image" style="border: 3px solid white; width: 40px; height: 40px;">
      </div>
      <div class="info" style="color: white;">
        <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
        <a style="color: lightgreen;"><i class="fa fa-circle"></i> Online</a>
      </div>
    </div>

    <!-- Sidebar menu with modern hover effects -->
    <ul class="sidebar-menu" data-widget="tree" style="padding: 0;">
      <li class="header" style="color: #c30010; font-size: 16px; padding: 10px 20px;">REPORTS</li>
      <li class="">
        <a href="home.php" style="color: white; padding: 15px 20px; display: block; text-transform: uppercase; font-size: 14px;">
          <i class="fa fa-dashboard" style="color: #c30010;"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="">
        <a href="votes.php" style="color: white; padding: 15px 20px; display: block; text-transform: uppercase; font-size: 14px;">
          <i class="glyphicon glyphicon-lock" style="color: #c30010;"></i> <span>Votes</span>
        </a>
      </li>
      
      <li class="header" style="color: #c30010; font-size: 16px; padding: 10px 20px;">MANAGE</li>
      <li class="">
        <a href="voters.php" style="color: white; padding: 15px 20px; display: block; text-transform: uppercase; font-size: 14px;">
          <i class="fa fa-users" style="color: #c30010;"></i> <span>Voters</span>
        </a>
      </li>
      <li class="">
        <a href="positions.php" style="color: white; padding: 15px 20px; display: block; text-transform: uppercase; font-size: 14px;">
          <i class="fa fa-tasks" style="color: #c30010;"></i> <span>Positions</span>
        </a>
      </li>
      <li class="">
        <a href="candidates.php" style="color: white; padding: 15px 20px; display: block; text-transform: uppercase; font-size: 14px;">
          <i class="fa fa-black-tie" style="color: #c30010;"></i> <span>Candidates</span>
        </a>
      </li>
      <li class="">
    <a href="#" data-toggle="modal" data-target="#timeDeadlineModal" style="color: white; padding: 15px 20px; display: block; text-transform: uppercase; font-size: 14px;">
        <i class="fa fa-cog" style="color: #c30010;"></i> <span>Time Deadline</span>
    </a>
    </li>
    <li class="">
    <a href="javascript:void(0);" class="dropdown-toggle" style="color: white; padding: 15px 20px; display: block; text-transform: uppercase; font-size: 14px;" onclick="toggleDropdown();">
        <i class="fa fa-tasks" style="color: #c30010;"></i> <span>Applications</span>
    </a>
    <ul id="dropdownMenu" style="display: none; padding-left: 0; list-style-type: none;">
        <li>
            <a href="applications.php" style="color: white; padding: 10px 20px; display: block;">SRC Applications</a>
        </li>
        <li>
            <a href="hc_application.php" style="color: white; padding: 10px 20px; display: block;">HC Applications</a>
        </li>
    </ul>
</li>

<!-- Optional CSS for better dropdown appearance -->
<style>
    #dropdownMenu {
        background-color: #333; /* Change this to your desired background color */
        position: absolute; /* Makes the dropdown overlay */
        z-index: 1000; /* Ensures it appears above other elements */
    }
    #dropdownMenu li a {
        text-transform: none; /* Keeps the text as is, you can change it to uppercase if needed */
    }
</style>

<!-- JavaScript to toggle dropdown -->
<script>
    function toggleDropdown() {
        var dropdown = document.getElementById("dropdownMenu");
        dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
    }

    // Optional: Close dropdown if clicking outside
    window.onclick = function(event) {
        if (!event.target.matches('.dropdown-toggle')) {
            var dropdowns = document.getElementById("dropdownMenu");
            if (dropdowns.style.display === "block") {
                dropdowns.style.display = "none";
            }
        }
    }
</script>

      <li class="header" style="color: #c30010; font-size: 16px; padding: 10px 20px;">SETTINGS</li>
      <li class="">
        <a href="ballot.php" style="color: white; padding: 15px 20px; display: block; text-transform: uppercase; font-size: 14px;">
          <i class="fa fa-file-text" style="color: #c30010;"></i> <span>Ballot Position</span>
        </a>
      </li>

      <li class="">
        <a href="#config" data-toggle="modal" style="color: white; padding: 15px 20px; display: block; text-transform: uppercase; font-size: 14px;">
          <i class="fa fa-cog" style="color: #c30010;"></i> <span>Election Title</span>
        </a>
      </li>
      <li class="">
        <a href="../candidates/manage_votes.php" style="color: white; padding: 15px 20px; display: block; text-transform: uppercase; font-size: 14px;">
          <i class="fa fa-cog" style="color: #c30010;"></i> <span>Manage Portals</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<?php include 'config_modal.php'; ?>

