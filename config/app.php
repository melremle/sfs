<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(dirname(__DIR__) . '/.env');
date_default_timezone_set($_ENV['APP_TIMEZONE']);

define('APP_NAME', $_ENV['APP_NAME']);
define('APP_URL', getIPAddress() == '127.0.0.1' || getIPAddress() == '::1' ? $_ENV['APP_URL'] : 'http://' . getIPAddress() . ':' . $_SERVER['SERVER_PORT']);
define('CUR_URL', isset($_SERVER['REQUEST_URI']) ? trim($_SERVER['REQUEST_URI']) : "");

define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('DB_NAME', $_ENV['DB_NAME']);

define('EMAIL_HOST', $_ENV['EMAIL_HOST']);
define('EMAIL_USERNAME', $_ENV['EMAIL_USERNAME']);
define('EMAIL_PASSWORD', $_ENV['EMAIL_PASSWORD']);
define('EMAIL_PORT', $_ENV['EMAIL_PORT']);

define('JWT_SECRET', $_ENV['JWT_SECRET']);


function getIPAddress()
{
    $ip = $_SERVER['SERVER_ADDR'];
    return $ip;
}
