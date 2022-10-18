<?php

require_once dirname(__DIR__, 3) . '/functions/Admin/Offices.php';

$positions = new Offices;
$positions->getOneOffice();
