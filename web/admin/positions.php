<?php

$data['title'] = 'Positions';
$data['js'] = 'positions';
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
                        <h4 class="text-dark">Positions</h4>
                        <small class="text-muted">You can manage positions here</small>
                        <br>
                        <em><small class="text-info">Right click an item to view more options</small></em>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card my-3" style="max-height: 100vh;">
                        <div class="card-body px-2 pb-2">
                            <button id="btn-add-position" class="btn btn-primary mb-4 ms-4" style="width: 160px;"><i class="fa fa-add me-2"></i> Add Position</button>
                            <div class="table-responsive pb-4 px-4">
                                <table id="tbl-positions" class="table align-items-center mb-0 table-hover">
                                    <thead>
                                        <tr>
                                            <th class="opacity-7">Position</th>
                                            <th class="opacity-7" style="max-width: 250px;">Created</th>
                                            <th class="opacity-7" style="max-width: 250px;">Updated</th>
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
                    <li id="link-update" class="context-link"><a class="dropdown-item c-pointer"><i class="fa fa-edit"></i> <span>Update</span></a></li>
                    <li id="link-delete" class="context-link"><a class="dropdown-item c-pointer"><i class="fa fa-trash"></i> <span>Delete</span></a></li>
                </ul>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" data-mdb-keyboard="false" data-mdb-backdrop="static" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        Are you sure you want to delete "<span id="span-position"></span>" position?
                    </div>
                    <div class="modal-footer">
                        <button id="yes-delete-btn" class="btn btn-primary">Yes</button>
                        <button id="no-delete-btn" class="btn btn-danger" data-mdb-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require_once dirname(__DIR__, 2) . '/templates/modals/admin/position-modal.php';
        require_once dirname(__DIR__, 2) . '/templates/modals/upload-modal.php';
        require_once dirname(__DIR__, 2) . '/templates/components/upload-progress.php';
        require_once dirname(__DIR__, 2) . '/templates/footer.php';
        ?>