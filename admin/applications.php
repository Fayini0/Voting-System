<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SRC Candidates Application List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Applications</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
            <button id="approve_all" class="btn btn-success btn-sm btn-flat"><i class="fa fa-check"></i> Approve All</button>
            <button id="decline_all" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-times"></i> Decline All</button>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Position</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Year</th>
                  <th>Percentage</th>
                  <th>Contest History</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                   $sql = "
                   SELECT ca.*, p.description AS position_name 
                   FROM candidateapplication ca 
                   LEFT JOIN positions p ON ca.position_id = p.id 
                   ORDER BY ca.id ASC
               ";
               $query = $conn->query($sql);
               while($row = $query->fetch_assoc()){
                   echo "
                       <tr>
                           <td class='hidden'></td>
                           <td>".(isset($row['position_name']) ? $row['position_name'] : 'N/A')."</td>
                           <td>".(isset($row['firstname']) ? $row['firstname'] : 'N/A')."</td>
                           <td>".(isset($row['lastname']) ? $row['lastname'] : 'N/A')."</td>
                           <td>".(isset($row['year']) ? $row['year'] : 'N/A')."</td>
                           <td>".(isset($row['average']) ? $row['average'] : 'N/A')."</td>
                           <td>".(isset($row['contest_history']) ? $row['contest_history'] : 'N/A')."</td>
                           <td>
                               <button class='btn btn-success btn-sm approve btn-flat' data-id='".$row['id']."'><i class='fa fa-check'></i> Approve</button>
                               <button class='btn btn-danger btn-sm decline btn-flat' data-id='".$row['id']."'><i class='fa fa-times'></i> Decline</button>
                           </td>
                       </tr>
                   ";
               }
               
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.approve', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    
    if(confirm("Are you sure you want to approve this application?")){
        $.ajax({
            type: 'POST',
            url: 'approve_application.php',
            data: {id: id},
            success: function(response){
                alert('Application approved successfully.');
                location.reload(); // Refresh the page to see changes
            },
            error: function(){
                alert('An error occurred while approving the application.');
            }
        });
    }
});


// Decline an individual application
$(document).on('click', '.decline', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    if(confirm('Are you sure you want to decline this application?')){
      $.ajax({
        type: 'POST',
        url: 'decline_application.php',
        data: {id: id},
        success: function(response){
          try {
            var res = JSON.parse(response);
            if(res.success){
              alert('Application declined successfully!');
              location.reload();
            } else {
              alert('Error: ' + res.message);
            }
          } catch (e) {
            alert('Error parsing JSON response: ' + e.message);
          }
        },
        error: function(xhr, status, error){
          alert('An error occurred: ' + status + ' - ' + error + '\n' + xhr.responseText);
        }
      });
    }
  });


  // Show the "Delete All" modal
  $('#delete_all').click(function(e){
    e.preventDefault();
    $('#deleteAllModal').modal('show');
  });

  // Confirm "Delete All" action
  $('#confirmDeleteAll').click(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'delete_all_applications.php',
      data: {action: 'delete_all'},
      success: function(response){
        $('#deleteAllModal').modal('hide');
        window.location.reload();
      },
      error: function(){
        alert('An error occurred while trying to delete all applications.');
      }
    });
  });

  // Approve all applications
  $(document).ready(function(){
    $('#approve_all').click(function(e){
        e.preventDefault();
        
        if(confirm("Are you sure you want to approve all applications?")) {
            $.ajax({
                type: 'POST',
                url: 'approve_all_applications.php', // Change this to your PHP file
                data: {action: 'approve_all'},
                success: function(response){
                    alert('All applications approved successfully.');
                    location.reload(); // Refresh the page to see changes
                },
                error: function(xhr, status, error){
                    alert('An error occurred while trying to approve all applications: ' + error);
                }
            });
        }
    });
});

// Decline all applications
$('#decline_all').click(function(e) {
    e.preventDefault();

    if (confirm("Are you sure you want to decline all applications?")) {
        $.ajax({
            type: 'POST',
            url: 'decline_all_application.php', // Your PHP file to handle the action
            data: { action: 'decline_all' },
            success: function(response) {
                try {
                    var res = JSON.parse(response);
                    if (res.success) {
                        alert(res.message || 'All applications declined successfully.');
                        location.reload(); // Refresh the page to see changes
                    } else {
                        alert('Error: ' + (res.message || 'Failed to decline all applications.'));
                    }
                } catch (e) {
                    alert('Error: Invalid response from server.');
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred while trying to decline all applications: ' + error);
            }
        });
    }
});

  });
</script>
</body>
</html>
