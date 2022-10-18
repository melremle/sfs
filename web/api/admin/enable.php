<?php

require_once dirname(__DIR__, 3) . '/functions/Admin/Users.php';

$user = new Users;
$user->enableAccount();
