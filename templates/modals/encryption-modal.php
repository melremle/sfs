<div class="modal fade" id="encKeyModal" tabindex="-1" data-mdb-backdrop="static" data-mdb-keyboard="false" aria-labelledby="encKeyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="encKeyModalTitle">Key Verification</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <small class="text-mute">Input the Key below</small>
                <div id="key-container" class="input-group form-outline mt-2">
                    <input type="password" id="password" name="password" class="form-control" />
                    <span id="pass-toggle" title="Show Password" class="input-group-text border-0 c-pointer"><i class="fa fa-eye"></i></span>
                    <label class="form-label" for="password">Key</label>
                </div>
                <small class="text-mute"> The Key was included in the email that we've sent you regarding this item.</small>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="rowid">
                <button id="verify-key-btn" class="btn btn-primary" disabled>Verify</button>
            </div>
        </div>
    </div>
</div>