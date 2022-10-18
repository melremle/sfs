<?php

require_once dirname(__DIR__, 3) . '/functions/Admin/Offices.php';

$offices = new Offices;
$offices->updateOffice();
