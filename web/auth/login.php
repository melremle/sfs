<?php

$data['title'] = 'Login';
require_once dirname(__DIR__, 2) . '/templates/head.php';
if (isset($_SESSION['user']['id'])) {
    header('Location: /admin/dashboard');
}
?>

<body class="g-sidenav-show bg-gray-200" style="height: calc(100% - 200px);">
    <section class="vh-100">
        <div class="container-fluid h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="/api/auth/login" method="post" class="d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-center mb-4">
                            <img src="<?= APP_URL ?>/assets/android-chrome-512x512.png" alt="Logo" height="100">
                            <div>
                                <p class="lead fw-normal ms-4 mb-0 me-3">Login to your account</p>
                                <small class="ms-4">Enter your credentials below</small>
                            </div>
                        </div>
                        <?php
                        if (isset($_SESSION['error']['login'])) : ?>
                            <small class="mb-2 text-danger"><?= $_SESSION['error']['login'] ?></small>
                        <?php
                            unset($_SESSION['error']['login']);
                        endif ?>
                        <div class="form-outline w-50<?php echo !isset($_SESSION['error']['username']) ? " mb-4" : "" ?>">
                            <input type="text" id="username" name="username" class="form-control" value="<?= $_SESSION['val']['username'] ?? "" ?>" />
                            <label class="form-label" for="password">Username</label>
                        </div>
                        <?php
                        if (isset($_SESSION['error']['username'])) : ?>
                            <small class="mb-2 text-danger text-left"><?= $_SESSION['error']['username'] ?></small>
                        <?php
                            unset($_SESSION['error']['username']);
                        endif ?>
                        <div class="input-group form-outline w-50<?php echo !isset($_SESSION['error']['password']) ? " mb-4" : "" ?>">
                            <input type="password" id="password" name="password" class="form-control" value="<?= $_SESSION['val']['password'] ?? "" ?>" />
                            <span id="pass-toggle" title="Show Password" class="input-group-text border-0 c-pointer"><i class="fa fa-eye"></i></span>
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <?php
                        if (isset($_SESSION['error']['password'])) : ?>
                            <small class="mb-2 text-danger"><?= $_SESSION['error']['password'] ?></small>
                        <?php
                            unset($_SESSION['error']['password']);
                        endif ?>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="" class="text-info">Forgot password?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="fixed-bottom">
            <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
                <div class="text-white mb-3 mb-md-0">
                    Copyright © <?= date('Y') ?>. All rights reserved.
                </div>
            </div>
        </div>
    </section>
    <?php
    if (isset($_SESSION['val']['username'])) {
        unset($_SESSION['val']['username']);
    }
    if (isset($_SESSION['val']['password'])) {
        unset($_SESSION['val']['password']);
    }
    require_once dirname(__DIR__, 2) . '/templates/footer.php';
    ?>