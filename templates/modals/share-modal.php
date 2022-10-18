<div class="modal fade" id="shareModal" data-mdb-keyboard="false" data-mdb-backdrop="static" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareModalTitle">Share <strong><span id="orig-filename"></span></strong></h5>
                <button id="close-share-btn" type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <select multiple="multiple" id="search-share-txt" class="form-control-lg" style="width: 100%">
                        </select>
                    </div>
                </div>
                <div id="shared-container" style="display: none;">
                    <h6 class="mt-3"><strong>Shared To</strong></h6>
                    <div id="s-cont" class="border p-2 pb-0 mt-1">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="rowid">
                <button id="share-btn" class="btn btn-primary" disabled>Share</button>
            </div>
        </div>
    </div>
</div>