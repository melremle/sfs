<div class="modal fade" id="positionModal" data-mdb-keyboard="false" data-mdb-backdrop="static" tabindex="-1" aria-labelledby="positionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="positionModalTitle">Add Position</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="form-outline">
                            <input type="text" id="position" class="form-control" value="" />
                            <label class="form-label" for="position">Position</label>
                        </div>
                        <small class="mb-2 text-danger position-err"></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="save-position-btn" class="btn btn-success">Save</button>
                <button id="cancel-position-btn" class="btn btn-danger ripple" data-mdb-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>