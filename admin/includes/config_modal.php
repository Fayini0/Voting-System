<!-- Config -->
<div class="modal fade" id="config">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Configure</b></h4>
            </div>
            <div class="modal-body">
              <div class="text-center">
                <?php
                  $parse = parse_ini_file('config.ini', FALSE, INI_SCANNER_RAW);
                  $title = $parse['election_title'];
                ?>
                <form class="form-horizontal" method="POST" action="config_save.php?return=<?php echo basename($_SERVER['PHP_SELF']); ?>">
                  <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">Title</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>">
                    </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="save"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>
<!-- Time Deadline Modal -->
<div class="modal fade" id="timeDeadlineModal" tabindex="-1" role="dialog" aria-labelledby="timeDeadlineModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="timeDeadlineModalLabel">Set Voting Time Deadline</h4>
            </div>
            <div class="modal-body">
                <form id="timeDeadlineForm">
                    <div class="form-group">
                        <label for="deadline">Deadline:</label>
                        <input type="datetime-local" id="deadline" name="deadline" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Set Deadline</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery (necessary for AJAX) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- AJAX Script to Handle Form Submission -->
<script>
    $(document).ready(function() {
        // Handle the form submission
        $('#timeDeadlineForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: 'includes/set_deadline.php', // The PHP file handling the request
                type: 'POST',
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    console.log(response); // Debug the response in the console
                    alert(response); // Display the response in an alert
                    $('#config_modal').modal('hide'); // Hide the modal after successful submission
                    $('#timeDeadlineForm')[0].reset(); // Reset the form
                },
                error: function(xhr, status, error) {
                  alert('Error setting the deadline: ' + xhr.responseText);
                }
            });
        });
    });
</script>