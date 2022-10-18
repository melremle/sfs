<?php
session_start();
require_once dirname(__DIR__) . '/config/app.php';
require_once dirname(__DIR__) . '/models/MediaTypesModel.php';
$mediaType = new MediaTypesModel;
$_SESSION['allowed-media-types'] = json_encode($mediaType->getAllowedMediaTypes());
if (isset($_SESSION['user']['id'])) {
    $fullname = $_SESSION['user']['fullname'] ?? $_SESSION['user']['username'];
    $avatar = $_SESSION['user']['avatar'] ?? NULL;
    $finalAvatar = '<img src="' . APP_URL . '/files/avatars/' . $avatar . '" class="rounded-circle" height="22" alt="" loading="lazy" />';

    if ($avatar == NULL) {
        $avatar = strtoupper(substr($fullname, 0, 1));
        $finalAvatar = '<div class="avatar-letter-' . strtolower($avatar) . '">' . $avatar . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="/assets/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/4e6c914472.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="/assets/vendor/mdb5/css/mdb.min.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/datatable.css">
    <link rel="stylesheet" href="/assets/vendor/toastr/css/toastr.min.css">
    <link rel="stylesheet" href="/assets/css/select2.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <title><?= isset($data['title']) ? $data['title'] . " | " . APP_NAME : APP_NAME ?></title>
</head>
<div id="loader-container">
    <div class="lds-dual-ring"></div>
</div>