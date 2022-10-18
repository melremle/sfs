<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand" href="#">
            <img src="/assets/android-chrome-512x512.png" height="25" alt="" loading="lazy" />
            <strong class="text-muted">SeFiSha</strong>
        </a>
        <form class="d-none d-md-flex input-group w-auto my-auto">
            <input autocomplete="off" type="search" class="form-control rounded" placeholder='Search' style="min-width: 225px" />
            <a href=""><span class="input-group-text border-0"><i class="fas fa-search"></i></span></a>
        </form>
        <ul class="navbar-nav ms-auto d-flex flex-row">
            <li class="nav-item dropdown">
                <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <span class="badge rounded-pill badge-notification bg-danger">1</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Some news</a></li>
                    <li><a class="dropdown-item" href="#">Another news</a></li>
                    <li>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a data-id="<?= 1 ?>" class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center user-link-button" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                    <p class="m-0 pe-2"><?= $fullname ?> |</p><?= $finalAvatar ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="<?= APP_URL ?>/auth/logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
</header>