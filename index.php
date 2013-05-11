<?php
define('IN_SAESPOT', 1);

include(dirname(__FILE__) . '/config.php');
include(dirname(__FILE__) . '/common.php');

# This would be the router of the system.

$path = $_SERVER['REQUEST_URI'];
$pagefile = 'indexpage';
$pageopt = [];
$viewopt = [];
if(preg_match('~^/(?:page/(\d+))?~', $path, $m))
{
    $pageopt['page'] = isset($m[1]) ? intval($m[1]) : 0;
    $pagefile = 'indexpage';
}

if(empty($pagefile))
    $pagefile = 'indexpage';

if(file_exists($pagefile . '.php'))
{
    include $pagefile . '.php';
    die;
}

header('HTTP/1.1 405 Module not found');

die('Module not found');

