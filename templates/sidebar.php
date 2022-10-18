<header>
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                <div class="row justify-content-center mb-4">
                    <div class="col-10">
                        <a id="btn-upload-file" class="btn btn-success btn-lg btn-rounded mt-4 w-100 c-pointer" type="button">
                            <i class="fas fa-upload fa-fw me-3"></i><span>Upload</span>
                        </a>
                    </div>
                </div>
                <hr class="horizontal light mt-0 mb-2">
                <?php if ($_SESSION['user']['access'] == 1) : ?>
                    <a href="<?= APP_URL ?>/admin/dashboard" class="side-btn list-group-item list-group-item-action py-2 ripple<?= CUR_URL == '/admin/dashboard' ? '  active' : '' ?>" aria-current="true">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Dashboard</span>
                    </a>
                    <hr class="horizontal light my-2">
                    <a href="<?= APP_URL ?>/admin/my-drive" class="side-btn list-group-item list-group-item-action py-2 ripple<?= CUR_URL == '/admin/my-drive' ? '  active' : '' ?>" aria-current="false">
                        <i class="fa-brands fa-google-drive fa-fw me-3"></i><span>My Files</span>
                    </a>
                    <a href="<?= APP_URL ?>/admin/all-files" class="side-btn list-group-item list-group-item-action py-2 ripple<?= CUR_URL == '/admin/all-files' ? '  active' : '' ?>" aria-current="false">
                        <i class="fa-solid fa-file fa-fw me-3"></i><span>All Files</span>
                    </a>
                    <a href="<?= APP_URL ?>/admin/archive" class="side-btn list-group-item list-group-item-action py-2 ripple<?= CUR_URL == '/admin/archive' ? '  active' : '' ?>" aria-current="false">
                        <i class="fa-solid fa-box-archive fa-fw me-3"></i><span>Archive</span>
                    </a>
                    <small class="text-muted mt-3">Manage</small>
                    <hr class="horizontal light mt-0">
                    <a href="<?= APP_URL ?>/admin/users" class="side-btn list-group-item list-group-item-action py-2 ripple<?= CUR_URL == '/admin/users' ? '  active' : '' ?>" aria-current="false">
                        <i class="fa-solid fa-users fa-fw me-3"></i><span>User Accounts</span>
                    </a>
                    <a href="<?= APP_URL ?>/admin/positions" class="side-btn list-group-item list-group-item-action py-2 ripple<?= CUR_URL == '/admin/positions' ? '  active' : '' ?>" aria-current="false">
                        <i class="fa-solid fa-code-branch fa-fw me-3"></i><span>Positions</span>
                    </a>
                    <a href="<?= APP_URL ?>/admin/offices" class="side-btn list-group-item list-group-item-action py-2 ripple<?= CUR_URL == '/admin/offices' ? '  active' : '' ?>" aria-current="false">
                        <i class="fa-solid fa-building fa-fw me-3"></i><span>Offices</span>
                    </a>
                    <a href="<?= APP_URL ?>/admin/settings" class="side-btn list-group-item list-group-item-action py-2 ripple<?= CUR_URL == '/admin/settings' ? '  active' : '' ?>" aria-current="false">
                        <i class="fa-solid fa-gear fa-fw me-3"></i><span>Settings</span>
                    </a>
                <?php else : ?>
                    <hr class="horizontal light my-2">
                    <a href="<?= APP_URL ?>/my-drive" class="side-btn list-group-item list-group-item-action py-2 ripple<?= CUR_URL == '/my-drive' ? '  active' : '' ?>" aria-current="false">
                        <i class="fa-brands fa-google-drive fa-fw me-3"></i><span>My Drive</span>
                    </a>
                    <a href="<?= APP_URL ?>/shared-with-me" class="side-btn list-group-item list-group-item-action py-2 ripple<?= CUR_URL == '/shared-with-me' ? '  active' : '' ?>" aria-current="false">
                        <i class="fa-brands fa-slideshare fa-fw me-3"></i><span>Shared with me</span>
                    </a>
                    <a href="<?= APP_URL ?>/archive" class="side-btn list-group-item list-group-item-action py-2 ripple<?= CUR_URL == '/archive' ? '  active' : '' ?>" aria-current="false">
                        <i class="fa-solid fa-box-archive fa-fw me-3"></i><span>Archive</span>
                    </a>
                <?php endif ?>
            </div>
            <div class="d-flex justify-content-center align-items-center pt-5">
                <img src="<?= APP_URL ?>/files/logos/333cagayan-seal_600x600.png" alt="" width="100">
            </div>
        </div>
        <footer class="footer py-4 position-absolute bottom-0 w-100">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-center">
                    <div class="col-lg-12 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted">
                            © <?= date('Y', strtotime('now')) ?>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </nav>