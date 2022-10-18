<?php
require_once dirname(__DIR__) . '/head.php';
?>
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center">
        <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_6nmazhqu.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
        <p class="fs-3"> <span class="text-danger">Opps!</span> Page not found.</p>
        <p class="lead">
            The page you’re looking for doesn’t exist.
        </p>
        <a href="" class="btn btn-primary">Go Home</a>
    </div>
</div>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<?php
require_once dirname(__DIR__) . '/footer.php';
?>