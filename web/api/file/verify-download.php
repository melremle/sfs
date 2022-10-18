<?php

require_once dirname(__DIR__, 3) . '/functions/Both/MyDrive.php';

$mydrive = new MyDrive;
$mydrive->checkDownload();
