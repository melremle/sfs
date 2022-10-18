<?php
session_start();
require_once dirname(__DIR__, 2) . '/functions/Both/Auth.php';
if (isset($_SESSION['user']['id'])) {
    $mydrive = new Auth;
    $mydrive->logout();
    session_destroy();
    header('Location: /');
} else {
    $loc = $_SERVER['HTTP_REFERER'] ?? '/';
    header('Location: ' . $loc);
}
