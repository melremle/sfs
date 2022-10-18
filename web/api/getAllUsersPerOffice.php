<?php

require_once dirname(__DIR__, 2) . '/functions/Admin/Users.php';

$mydrive = new Users;
$mydrive->getAllUsersPerOffice();
