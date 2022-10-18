<?php

$data['title'] = 'Users Management';
$data['js'] = 'users';
require_once dirname(__DIR__, 2) . '/templates/head.php';
if (!isset($_SESSION['user']['id'])) {
    header('Location: /auth/login');
} else {
    if ($_SESSION['user']['access'] != 1) {
        header('HTTP/1.0 404');
        die(require_once dirname(__DIR__, 1) . '/errors/404.php');
    }
}
?>

<body class="g-sidenav-show bg-gray-200" style="height: calc(100% - 58px);">

    <?php require_once dirname(__DIR__, 2) . '/templates/sidebar.php' ?>
    <?php require_once dirname(__DIR__, 2) . '/templates/navbar.php' ?>

    <main style="margin-top: 58px">
        <div class="container-fluid">
            <div class="row">
                <div class="card-header">
                    <div class="pb-2 pt-2">
                        <h4 class="text-dark">User Accounts</h4>
                        <small class="text-muted">You can view and manage your user's account here</small>
                        <br>
                        <em><small class="text-info">Right click an item to view more options</small></em>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card my-3" style="max-height: 100vh;">
                        <div class="card-body px-2 pb-2">
                            <button id="btn-add-user" class="btn btn-primary mb-4 ms-4" style="width: 200px;"><i class="fa fa-user-plus me-2"></i> Add User Account</button>
                            <div class="table-responsive pb-4 px-4">
                                <table id="tbl-users" class="table align-items-center mb-0 table-hover">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 150px;"></th>
                                            <th class="opacity-7">Name</th>
                                            <th class="opacity-7">Username</th>
                                            <th class="opacity-7">Temporary Password</th>
                                            <th class="opacity-7">Email</th>
                                            <th class="opacity-7">Mobile Number</th>
                                            <th class="opacity-7">Last Access</th>
                                            <th class="opacity-7">Last Login</th>
                                            <th class="opacity-7">Created</th>
                                            <th class="opacity-7">Updated</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="context-backdrop" id="contextbackdrop" style="display: none;">
            <div class="context-menu" id="contextmenu" style="display: none;">
                <ul class="menu">
                    <li id="link-edit-user" class="context-link"><a class="dropdown-item c-pointer"><i class="fa fa-user-edit"></i> <span>Edit Account</span></a></li>
                    <li id="link-enable-disable" class="context-link"><a class="dropdown-item c-pointer"><i class="fa fa-user-lock"></i> <span>Disable Account</span></a></li>
                </ul>
            </div>
        </div>

        <div class="modal" id="loadingModal" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="loadingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                            </div>
                            <div id="stat"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require_once dirname(__DIR__, 2) . '/templates/modals/admin/user-modal.php';
        require_once dirname(__DIR__, 2) . '/templates/modals/upload-modal.php';
        require_once dirname(__DIR__, 2) . '/templates/components/upload-progress.php';
        require_once dirname(__DIR__, 2) . '/templates/footer.php';
        ?>
        <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 600px;">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="d-flex flex-column">
                            <p>Access 1 = User has permission to <strong>Upload</strong>, <strong>Share</strong>, <strong>Update</strong>, <strong>Download</strong> and <strong>Archive</strong> a File</p>
                            <hr>
                            <p>Access 2 = User has permission to <strong>Upload</strong>, <strong>Share</strong>, <strong>Update</strong> and <strong>Download</strong> a File</p>
                            <hr>
                            <p>Access 3 = User has permission to <strong>Upload</strong>, <strong>Share</strong> and <strong>Download</strong> a File</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-mdb-dismiss="modal" class="btn btn-danger">OK</button>
                    </div>
                </div>
            </div>
        </div>