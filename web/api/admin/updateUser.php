<?php

require_once dirname(__DIR__, 3) . '/functions/Admin/Users.php';

$mydrive = new Users;
$mydrive->updateUser();
