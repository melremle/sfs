<?php
$data['title'] = 'Page not found';
require_once dirname(__DIR__, 2) . '/templates/head.php';
?>
<div class="d-flex flex-column align-items-center justify-content-center vh-100 vw-100">
    <lottie-player src="<?= APP_URL ?>/assets/json/404.json" background="transparent" speed="1" style="width: 300px; height: 200px;" loop autoplay></lottie-player>
    <div class="text-center">
        <p class="fs-3"> <span class="text-danger">Opps!</span> Page not found.</p>
        <p class="lead">
            The page you're looking for doesn't exist.
        </p>
        <a class="btn btn-primary c-pointer back-btn">Go Back</a>
    </div>
</div>

<script src="<?= APP_URL ?>/assets/vendor/lottie-player.js"></script>
<?php
require_once dirname(__DIR__, 2) . '/templates/error-footer.php';
?>