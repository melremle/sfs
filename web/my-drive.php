<?php

$data['title'] = 'My Drive';
$data['js'] = 'my-drive';
require_once dirname(__DIR__) . '/templates/head.php';
if (!isset($_SESSION['user']['id'])) {
    header('Location: /auth/login');
} else {
    if ($_SESSION['user']['access'] != 2) {
        header('HTTP/1.0 404');
        die(require_once dirname(__DIR__, 1) . '/errors/404.php');
    }
}
?>

<body class="g-sidenav-show bg-gray-200" style="height: calc(100% - 58px);">

    <?php require_once dirname(__DIR__) . '/templates/sidebar.php' ?>
    <?php require_once dirname(__DIR__) . '/templates/navbar.php' ?>

    <main style="margin-top: 58px">
        <div class="container-fluid">
            <div class="row">
                <div class="card-header">
                    <div class="pb-2 pt-2">
                        <h4 class="text-dark">My Drive</h4>
                        <small class="text-muted">You can view or modify your uploaded files here</small>
                        <br>
                        <em><small class="text-info">Left click an item to view details or right click an item to view more options</small></em>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card my-3" style="max-height: 100vh;">

                        <div class="card-body px-2 pb-2">
                            <div class="table-responsive pb-4 px-4">
                                <table id="tbl-drive" data-id="<?= $_SESSION['user']['id'] ?>" class="table align-items-center mb-0 table-hover">
                                    <thead>
                                        <tr>
                                            <th style="max-width: 100px" class="opacity-7">File Type</th>
                                            <th class="opacity-7">File Name</th>
                                            <th class="opacity-7">File Size</th>
                                            <th class="opacity-7">Uploaded On</th>
                                            <th class="opacity-7"></th>
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
                    <li id="link-rename" class="context-link"><a class="dropdown-item c-pointer"><i class="fa fa-edit"></i> Rename</a></li>
                    <li id="link-download" class="context-link"><a class="dropdown-item c-pointer"><i class="fa fa-download"></i> Download</a></li>
                    <li id="link-share" class="context-link"><a class="dropdown-item c-pointer"><i class="fa fa-share"></i> Share</a></li>
                    <li id="link-archive" class="context-link"><a class="dropdown-item c-pointer"><i class="fa fa-archive"></i> Move to Archive</a></li>
                    <li id="link-delete" class="context-link"><a class="dropdown-item c-pointer"><i class="fa fa-trash"></i> Move to Trash</a></li>
                </ul>
            </div>
        </div>
        <?php
        require_once dirname(__DIR__) . '/templates/modals/admin/details-modal.php';
        require_once dirname(__DIR__) . '/templates/modals/upload-modal.php';
        require_once dirname(__DIR__) . '/templates/modals/share-modal.php';
        require_once dirname(__DIR__) . '/templates/modals/rename-modal.php';
        require_once dirname(__DIR__) . '/templates/components/upload-progress.php';
        require_once dirname(__DIR__) . '/templates/footer.php';
        ?>