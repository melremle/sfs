<div class="modal fade" id="renameModal" tabindex="-1" aria-labelledby="renameModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="renameModalTitle">Rename <span id="orig-filename"></span></h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-outline">
                    <input type="text" id="filename-txt" class="form-control" value=" " />
                    <label class="form-label" for="typeText">Filename</label>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="rowid">
                <button id="rename-btn" class="btn btn-primary" disabled>Save</button>
            </div>
        </div>
    </div>
</div>