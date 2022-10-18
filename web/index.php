<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['access'] == 1) {
        header('Location: /admin/dashboard');
    } else {
        header('Location: /my-drive');
    }
} else {
    header('Location: /auth/login');
}
