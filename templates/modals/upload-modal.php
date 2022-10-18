<?php
require_once dirname(__DIR__, 2) . '/Models/OfficesModel.php';
$mediaTypesAllowed = "";
foreach (json_decode($_SESSION['allowed-media-types'], true) as $mediatype) {
    $mediaTypesAllowed .= $mediatype['ext'] . ',';
}
$mediaTypesAllowed = substr($mediaTypesAllowed, 0, strlen($mediaTypesAllowed) - 1);


$offices = new OfficesModel;

$officesOptions = "";

foreach ($offices->getAllOffices() as $office) {
    $officesOptions .= "<option value='" . $office['ID'] . "'>" . $office['Office'] . "</option>";
}

?>


<div class="modal fade" id="uploadModal" data-mdb-keyboard="false" data-mdb-backdrop="static" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalTitle">Upload File(s)</h5>
            </div>
            <div class="modal-body">
                <div class="row ps-2 pe-2">
                    <p class="title p-0 m-0 fw-bold">Share to:</p>
                    <div class="border mb-3">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="form-outline">
                                    <label class="form-label" for="roffice">Recepient's Office</label>
                                    <select type="text" id="roffice" multiple class="form-select" value="" style="width: 100%;">
                                        <?= $officesOptions ?>
                                    </select>
                                </div>
                            </div>
                            <div id="recipient" class="col-6 mb-3" style="display: none;">
                                <div class="form-outline">
                                    <label class="form-label" for="ruser">Recepient's Name(s)</label>
                                    <select type="text" id="ruser" multiple class="form-select" value="" style="width: 100%;" disabled>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <form id="frm-upload" action="<?= APP_URL ?>/api/file/upload" method="POST" enctype="multipart/form-data">
                            <input type="file" class="form-control" multiple id="u-file" accept="<?= $mediaTypesAllowed ?>" />
                        </form>
                        <small class="mb-2 text-danger files-err"></small>
                        <div id="items-container" class="d-flex flex-wrap border mb-3 mt-1 p-2" style="min-height: 50px; gap:5px">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="upload-files-btn" class="btn btn-success">Upload</button>
                <button id="cancel-upload-btn" class="btn btn-danger ripple" data-mdb-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>