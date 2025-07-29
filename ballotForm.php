<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/menubar.php'; ?>

<!-- Voting Form -->
<div class="container">
    <h2>Vote for Your Candidates</h2>
    <form id="votingForm">
        <?php
        // Fetch positions and candidates from the database
        $sql = "SELECT * FROM positions";
        $positions = $conn->query($sql);

        while ($position = $positions->fetch_assoc()) {
            echo "<h4>{$position['description']}</h4>";
            $pos_id = $position['id'];
            $sql_candidates = "SELECT * FROM candidates WHERE position_id = '$pos_id'";
            $candidates = $conn->query($sql_candidates);

            while ($candidate = $candidates->fetch_assoc()) {
                echo "<div>
                        <input type='radio' name='position_{$pos_id}' value='{$candidate['id']}'>
                        {$candidate['firstname']} {$candidate['lastname']}
                      </div>";
            }
        }
        ?>
        <button type="button" id="preview" class="btn btn-primary">Preview</button>
    </form>

    <!-- Alert Message -->
    <div id="alert" class="alert alert-danger" style="display:none;">
        <div class="message"></div>
    </div>

    <!-- Preview Modal -->
    <div class="modal fade" id="preview_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Vote Preview</h4>
                </div>
                <div class="modal-body">
                    <div id="preview_body"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">
                        <i class="fa fa-close"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/scripts.php'; ?>
