<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Set Voting Deadline</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<!-- Button to open the modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deadlineModal">Set Voting Deadline</button>

<!-- Modal -->
<div class="modal fade" id="deadlineModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Set Voting Deadline</h4>
            </div>
            <div class="modal-body">
                <form id="deadlineForm">
                    <div class="form-group">
                        <label for="deadline">Deadline:</label>
                        <input type="datetime-local" id="deadline" name="deadline" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Set Deadline</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    // Handle form submission with AJAX
    $('#deadlineForm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: 'set_deadline.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
                $('#deadlineModal').modal('hide');
                $('#deadlineForm')[0].reset();
            },
            error: function() {
                alert('Error setting deadline.');
            }
        });
    });
</script>

</body>
</html>
