<div id="upload-progress-container" style="display: none;">
    <div class="d-flex">
        <div class="accordion w-100" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header d-flex" id="headingUploads">
                    <button id="collapseUploadsParent" class="accordion-button" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseUploads" aria-expanded="true" aria-controls="collapseUploads">
                        <div class="fs-6">Uploads</div>
                    </button>
                    <button class="btn btn-default text-primary shadow-0 border-bottom cancelUploads" type="button">
                        <i class="fa fa-times fs-6"></i>
                    </button>
                </h2>
                <div id="collapseUploads" class="accordion-collapse collapse show" aria-labelledby="headingUploads" data-mdb-parent="#collapseUploadsParent">
                    <div class="accordion-body">
                        <div id="file-uploads">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cancelUploadModal" tabindex="-1" aria-labelledby="cancelUploadModal" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelUploadModalTitle">Cancel pending process</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to cancel all pending uploads</p>
            </div>
            <div class="modal-footer">
                <button id="btn-cancel-upload" class="btn btn-primary">Yes</button>
                <button class="btn btn-danger" data-mdb-dismiss="modal" aria-label="Close">No</button>
            </div>
        </div>
    </div>
</div>