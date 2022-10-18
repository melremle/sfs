<?php

$data['title'] = 'Activate Account';
require_once dirname(__DIR__, 2) . '/templates/head.php';
if (isset($_SESSION['user']['id'])) {
    header('HTTP/1.0 400');
    die(require_once dirname(__DIR__) . '/errors/400.php');
} else {
    require_once dirname(__DIR__, 2) . '/functions/Both/Auth.php';
    $auth = new Auth;
    $token = $auth->verifyActivationToken();

    if ($token == false) {
        header('HTTP/1.0 404');
        die(require_once dirname(__DIR__) . '/errors/404.php');
    }
}
?>

<body class="g-sidenav-show bg-gray-200" style="height: calc(100% - 200px);">
    <section class="vh-100">
        <div class="container-fluid h-100">
            <div class="row d-flex justify-content-center h-100 pt-5">
                <div class="col-12">
                    <form id="frm-activation" action="/api/auth/activation" method="post" class="d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex flex-column align-items-center justify-content-center justify-content-lg-center mb-4">
                            <img src="<?= APP_URL ?>/assets/android-chrome-512x512.png" alt="Logo" height="100">
                            <div>
                                <h4 class="mb-0 text-center">Activate Account</h4>
                                <p class="text-center">
                                    <small class="text-center">1. Enter the temporary password you received</small>
                                    <br>
                                    <small class="text-center">2. Enter your preferred password</small>
                                </p>
                            </div>
                        </div>
                        <div class="col-2 d-flex flex-column align-items-center justify-content-center">
                            <div class="row justify-content-center">
                                <div class="col-12 mb-3">
                                    <div class="input-group form-outline">
                                        <input type="password" id="tpassword" name="tpassword" class="form-control" />
                                        <span id="tpass-toggle" title="Show Password" class="input-group-text border-0 c-pointer"><i class="fa fa-eye"></i></span>
                                        <label class="form-label" for="tpassword">Temporary Password</label>
                                    </div>
                                    <small class="mb-2 text-danger tpassword-err"></small>
                                </div>
                                <hr>
                                <div class="col-12 mb-3">
                                    <div class="input-group form-outline">
                                        <input type="password" id="password" name="password" class="form-control" />
                                        <span id="pass-toggle" title="Show Password" class="input-group-text border-0 c-pointer"><i class="fa fa-eye"></i></span>
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                    <small class="mb-2 text-danger password-err"></small>
                                    <p><small>Password must be 8-16 in length and must contain at least one lowercase, one uppercase, one special character and one number.</small></p>
                                    <p><small></small></p>
                                </div>
                            </div>
                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <input type="hidden" name="token" value="<?= $token['SessionToken'] ?>">
                            <button id="activate-btn" type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Activate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="fixed-bottom">
            <div class="d-flex flex-column flex-md-row text-center justify-content-center py-4 px-4 px-xl-5 bg-primary">
                <div class="text-white mb-3 mb-md-0 text-center">
                    Copyright © <?= date('Y') ?>. All rights reserved.
                </div>
            </div>
        </div>
    </section>
    <?php
    require_once dirname(__DIR__, 2) . '/templates/modals/account-activation.php';
    require_once dirname(__DIR__, 2) . '/templates/footer.php';
    ?>