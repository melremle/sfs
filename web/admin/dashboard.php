<?php
$data['title'] = 'Dashboard';
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
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2 pb-4">
                            <div class="icon icon-lg icon-shape bg-primary position-absolute top-0 mt-3 text-center">
                                <i class="fa-solid fa-file fa-fw text-white opacity-100"></i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Files</p>
                                <h4 class="mb-0">0</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+0% </span>than last week</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2 pb-4">
                            <div class="icon icon-lg icon-shape bg-warning position-absolute top-0 mt-3 text-center">
                                <i class="fa-solid fa-users fa-fw text-white opacity-100"></i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Users</p>
                                <h4 class="mb-0">0</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+0% </span>than last month</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2 pb-4">
                            <div class="icon icon-lg icon-shape bg-success position-absolute top-0 mt-3 text-center">
                                <i class="fa-solid fa-download fa-fw text-white opacity-100"></i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Downloads</p>
                                <h4 class="mb-0">0</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">+0%</span> than yesterday</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2 pb-4">
                            <div class="icon icon-lg icon-shape bg-danger position-absolute top-0 mt-3 text-center">
                                <i class="fa-solid fa-upload fa-fw text-white opacity-100"></i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Uploads Today</p>
                                <h4 class="mb-0">0</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+0% </span>than yesterday</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-9 col-md-7 mb-md-0 mb-4">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-6 col-7">
                                    <h6>Recent Uploads</h6>
                                    <p class="text-sm mb-0">
                                        <i class="fa fa-check text-info" aria-hidden="true"></i>
                                        <span class="font-weight-bold ms-1">0 </span> this month
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File Name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">File Size</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Uploader</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Upload Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">File Name 1.xlsx</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">15.06 MB</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold">User 1</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"><?= date('M d, Y', strtotime('07/25/2022')) ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">File Name 2.xlsx</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">15.06 MB</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold">Admin</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"><?= date('M d, Y', strtotime('07/25/2022')) ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">File Name 3.xlsx</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">15.06 MB</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-xs font-weight-bold">User 1</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"><?= date('M d, Y', strtotime('07/25/2022')) ?></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h6>My Activity</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="timeline timeline-one-side">
                                <div class="timeline-block mb-3">
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0"><i class="fa-solid fa-download fa-fw text-success"></i> You downloaded a file</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 AUG 7:20 AM</p>
                                    </div>
                                </div>
                                <div class="timeline-block mb-3">
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0"><i class="fa-solid fa-upload fa-fw text-warning"></i> You uploaded a file</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 AUG 1 PM</p>
                                    </div>
                                </div>
                                <div class="timeline-block mb-3">
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0"><i class="fa-solid fa-share-nodes fa-fw text-primary"></i> You shared a file</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 AUG 9:34 AM</p>
                                    </div>
                                </div>
                                <div class="timeline-block mb-3">
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0"><i class="fa-solid fa-share-nodes fa-fw text-primary"></i> You shared a file</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">15 AUG 9:34 AM</p>
                                    </div>
                                </div>
                                <div class="timeline-block mb-3">
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0"><i class="fa-solid fa-box-archive fa-fw text-dark"></i> You archived a file</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">01 AUG 8:34 AM</p>
                                    </div>
                                </div>
                                <div class="timeline-block">
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0"><i class="fa-solid fa-trash-can fa-fw text-danger"></i> You permanently deleted a file</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">2 months ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php

            require_once dirname(__DIR__, 2) . '/templates/modals/upload-modal.php';
            require_once dirname(__DIR__, 2) . '/templates/components/upload-progress.php';
            require_once dirname(__DIR__, 2) . '/templates/footer.php';
            ?>