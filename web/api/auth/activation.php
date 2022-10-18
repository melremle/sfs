<?php

require_once dirname(__DIR__, 3) . '/functions/Both/Auth.php';

$mydrive = new Auth;
$mydrive->verifyTemporaryPassword();
