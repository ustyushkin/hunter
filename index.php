<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/26/20
 * Time: 7:25 PM
 */

include __DIR__ . '/vendor/autoload.php';

use system\Router;
use system\Environment;

session_start();

$environment = new Environment();

$r = new Router();
$r->run();

session_unset();