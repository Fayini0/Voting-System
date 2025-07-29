<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Position</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="positions_add.php">
                <div class="form-group">
                    <label for="description" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="max_vote" class="col-sm-3 control-label">Maximum Vote</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="max_vote" name="max_vote" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Position</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="positions_edit.php">
                <input type="hidden" class="id" name="id">
                <div class="form-group">
                    <label for="edit_description" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_description" name="description">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_max_vote" class="col-sm-3 control-label">Maximum Vote</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="edit_max_vote" name="max_vote">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="positions_delete.php">
                <input type="hidden" class="id" name="id">
                <div class="text-center">
                    <p>DELETE POSITION</p>
                    <h2 class="bold description"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete All Modal -->
<div class="modal fade" id="deleteAllModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-trash"></i> Delete All</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete all data? This action cannot be undone.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteAll">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Redo All Modal -->
<div class="modal fade" id="redoAllModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Redo All Positions</b></h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to redo all positions? This action cannot be undone.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        <button type="button" class="btn btn-warning btn-flat" id="confirmRedoAll"><i class="fa fa-redo"></i> Redo All</button>
      </div>
    </div>
  </div>
</div>

     