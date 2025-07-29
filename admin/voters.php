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
       <b>Voters List</b>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i><b>Home</b></a></li>
        <li class="active"><b>Voters</b></li>
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
    <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
    <button id="delete_all" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i> Delete All</button>
    <button id="redo_delete" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-undo"></i> Redo</button> <!-- Redo button -->
</div>

            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Lastname</th>
                  <th>Firstname</th>
                  <th>Email</th> <!-- Added Email Column -->
                  <th>Photo</th>
                  <th>Voters ID</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM voters";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
                      echo "
                        <tr>
                          <td>".$row['lastname']."</td>
                          <td>".$row['firstname']."</td>
                          <td>".$row['email']."</td> <!-- Display Email -->
                          <td>
                            <img src='".$image."' width='30px' height='30px'>
                            <a href='#edit_photo' data-toggle='modal' class='pull-right photo' data-id='".$row['id']."'><span class='fa fa-edit'></span></a>
                          </td>
                          <td>".$row['voters_id']."</td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button>
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
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/voters_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'voters_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_email').val(response.email); // Added to get the email
      $('#edit_password').val(response.password);
      $('.fullname').html(response.firstname+' '+response.lastname);
    }
  });
}

$(function(){
  // Show the Delete All Modal
  $(document).on('click', '#delete_all', function(e){
    e.preventDefault();
    $('#deleteAllModal').modal('show'); // Show the modal
  });

  // Handle Confirm Delete All
  $(document).on('click', '#confirmDeleteAll', function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'delete_all_voters.php', // PHP file to handle the deletion
      data: {action: 'delete_all'},
      success: function(response){
        if(response == 'success'){
          alert('All voters have been deleted successfully.');
          $('#deleteAllModal').modal('hide'); // Hide the modal
          window.location.reload(); // Refresh the page to update the table
        }
        else{
          alert('An error occurred while trying to delete all voters.');
        }
      },
      error: function(){
        alert('An error occurred while processing the request.');
      }
    });
  });
});

$(function(){
    let deletedVoters = []; // Array to temporarily store deleted voter data

    // Show the Delete All Modal
    $(document).on('click', '#delete_all', function(e){
        e.preventDefault();
        $('#deleteAllModal').modal('show'); // Show the modal
    });

    // Handle Confirm Delete All
    $(document).on('click', '#confirmDeleteAll', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'delete_all_voters.php', // PHP file to handle the deletion
            data: {action: 'delete_all'},
            success: function(response){
                if(response == 'success'){
                    alert('All voters have been deleted successfully.');
                    $('#deleteAllModal').modal('hide'); // Hide the modal
                    $('#redo_delete').css('display', 'block'); // Show the Redo button explicitly
                    window.location.reload(); // Refresh the page to update the table (optional)
                }
                else{
                    alert('An error occurred while trying to delete all voters.');
                }
            },
            error: function(){
                alert('An error occurred while processing the request.');
            }
        });
    });

    // Show the Redo Modal
    $(document).on('click', '#redo_delete', function(e){
        e.preventDefault();
        $('#redoModal').modal('show'); // Show the Redo confirmation modal
    });

    // Handle Confirm Redo
    $(document).on('click', '#confirmRedo', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'redo_delete_voters.php', // PHP file to handle the redo functionality
            data: {voters: deletedVoters},
            success: function(response){
                if(response == 'success'){
                    alert('Deletion has been undone successfully.');
                    $('#redoModal').modal('hide'); // Hide the Redo modal
                    $('#redo_delete').css('display', 'none'); // Hide the Redo button after undoing
                    window.location.reload(); // Refresh the page to update the table
                }
                else{
                    alert('An error occurred while trying to redo the deletion.');
                }
            },
            error: function(){
                alert('An error occurred while processing the request.');
            }
        });
    });

});

</script>
</body>
</html>
