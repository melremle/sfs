<?php
require_once dirname(__DIR__, 3) . '/Models/PositionsModel.php';
require_once dirname(__DIR__, 3) . '/Models/OfficesModel.php';

$offices = new OfficesModel;
$positions = new PositionsModel;

$officesOptions = "";
$positionsOptions = "";

foreach ($offices->getAllOffices() as $office) {
    $officesOptions .= "<option value='" . $office['ID'] . "'>" . $office['Office'] . "</option>";
}
foreach ($positions->getAllPositions() as $position) {
    $positionsOptions .= "<option value='" . $position['ID'] . "'>" . $position['Position'] . "</option>";
}
?>

<div class="modal fade" id="userModal" data-mdb-keyboard="false" data-mdb-backdrop="static" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalTitle">Add User Account</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="form-outline">
                            <input type="text" id="firstname" class="form-control" value="" />
                            <label class="form-label" for="username">First Name</label>
                        </div>
                        <small class="mb-2 text-danger firstname-err"></small>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="form-outline">
                            <input type="text" id="lastname" class="form-control" value="" />
                            <label class="form-label" for="username">Last Name</label>
                        </div>
                        <small class="mb-2 text-danger lastname-err"></small>
                    </div>
                    <div class="col-5 mb-3">
                        <div class="form-outline">
                            <input type="text" id="username" class="form-control" value="" />
                            <label class="form-label" for="username">Username</label>
                        </div>
                        <small class="mb-2 text-danger username-err"></small>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="form-outline">
                            <input type="email" id="email" class="form-control" value="" />
                            <label class="form-label" for="username">Email</label>
                        </div>
                        <small class="mb-2 text-danger email-err"></small>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="input-group form-outline">
                            <span title="Show Password" class="input-group-text">+63</span>
                            <input type="number" id="mobile" step="1" name="mobile" class="form-control" max="9999999999" maxlength="10" />
                            <label class="form-label" for="mobile">Mobile No</label>
                        </div>
                        <small class="mb-2 text-danger mobile-err"></small>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="form-outline">
                            <select id="position" class="form-select" value="">
                                <option value="" selected disabled>Select Position</option>
                                <?= $positionsOptions ?>
                            </select>
                        </div>
                        <small class="mb-2 text-danger position-err"></small>
                    </div>
                    <div class="col-5 mb-3">
                        <div class="form-outline">
                            <select id="office" class="form-select" value="">
                                <option value="" selected disabled>Select Office</option>
                                <?= $officesOptions ?>
                            </select>
                        </div>
                        <small class="mb-2 text-danger office-err"></small>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="form-outline">
                            <select id="access" class="form-select" value="">
                                <option value="" selected disabled>Select User Access</option>
                                <option value="2">Access 1</option>
                                <option value="3">Access 2</option>
                                <option value="4">Access 3</option>
                            </select>
                        </div>
                        <small class="mb-2 text-danger access-err"></small>
                    </div>
                    <div class="d-flex flex-column align-items-center justify-content-center col-1 mb-3 ps-0">
                        <button id="show-info" class="btn btn-outline-info btn-sm btn-floating"><i class="fa-solid fa-info"></i></button>
                        <small class="mb-4"></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="save-user-btn" class="btn btn-success">Save</button>
                <button id="cancel-user-btn" class="btn btn-danger ripple" data-mdb-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>