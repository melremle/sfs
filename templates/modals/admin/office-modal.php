<div class="modal fade" id="officeModal" data-mdb-keyboard="false" data-mdb-backdrop="static" tabindex="-1" aria-labelledby="officeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="officeModalTitle">Add Office</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="form-outline">
                            <input type="text" id="office" class="form-control" value="" />
                            <label class="form-label" for="office">Office</label>
                        </div>
                        <small class="mb-2 text-danger office-err"></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label" for="logo">Logo</label>
                        <div class="border d-flex flex-column justify-content-center align-items-center" style="height: 100px; width:100%">
                            <img src="" alt="" width="100" id="logo-preview">
                        </div>
                        <input type="file" accept="image/png" class="form-control" id="logo" />
                        <small class="mb-2 text-danger logo-err"></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="save-office-btn" class="btn btn-success">Save</button>
                <button id="cancel-office-btn" class="btn btn-danger ripple" data-mdb-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>