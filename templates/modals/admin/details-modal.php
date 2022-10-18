<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalTitle"></h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs nav-fill mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="btn-details-tab" data-mdb-toggle="tab" href="#details-tab" role="tab" aria-controls="ex2-tabs-1" aria-selected="true">Details</a>
                    </li>
                    <!-- <li class="nav-item" role="presentation">
                        <a class="nav-link" id="btn-activity-tab" data-mdb-toggle="tab" href="#activity-tab" role="tab" aria-controls="ex2-tabs-2" aria-selected="false">Activity</a>
                    </li> -->
                </ul>

                <div class="tab-content" id="ex2-content">
                    <div class="tab-pane fade show active" id="details-tab" role="tabpanel" aria-labelledby="details-tab">
                        <h5 class="mt-4">Who has access</h5>
                        <div id="shared-to-container" class="d-flex justify-content-start align-items-center">

                        </div>
                        <h5 class="mt-4">Properties</h5>
                        <div class="d-flex justify-content-start align-items-center mb-2">
                            <small>Type</small>
                            <small id="type" class="ms-auto"></small>
                        </div>
                        <div class="d-flex justify-content-start align-items-center mb-2">
                            <small>Size</small>
                            <small id="size" class="ms-auto"></small>
                        </div>
                        <div class="d-flex justify-content-start align-items-center mb-2">
                            <small>Owner</small>
                            <small id="owner" class="ms-auto"></small>
                        </div>
                        <div class="d-flex justify-content-start align-items-center mb-2">
                            <small>Modified</small>
                            <small id="modified" class="ms-auto"></small>
                        </div>
                        <div class="d-flex justify-content-start align-items-center mb-2">
                            <small>Uploaded</small>
                            <small id="uploaded" class="ms-auto"></small>
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="activity-tab" role="tabpanel" aria-labelledby="activity-tab">
                        <hr class="hr" />
                        <small><strong>This year</strong></small>
                        <hr class="hr" />
                        <small>Sep 5</small>
                        <div class="d-flex mt-2">
                            <img src="<?= APP_URL ?>/assets/android-chrome-192x192.png" class="rounded-circle" width="30" height="30" data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="You are the owner">
                            <div class="d-flex flex-column ms-4">
                                <small><strong>You</strong> uploaded an item</small>
                                <small>My Custom Filename 1.xlsx</small>
                            </div>
                        </div>
                        <hr class="hr hr-blurry" />
                        <small>No recorded activity before Sep 5 2022</small>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>