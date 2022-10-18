<?php

require_once dirname(__DIR__, 3) . '/functions/Admin/Positions.php';

$positions = new Positions;
$positions->getAllPositions();
