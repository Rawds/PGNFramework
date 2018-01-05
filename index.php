<?php
$first_init = microtime(true);
error_reporting(E_ALL);
define("BASE_DIR",__DIR__);
define("TRANSACTION_CODE",crc32(microtime(true)));
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include_once BASE_DIR . "/systems/library/cache.php";
include_once BASE_DIR."/vendor/autoload.php";
cache::initAutoload(BASE_DIR."/systems/library/autoload.php");
cache::loadShare();
autoload::register();
config::define(BASE_DIR."/resource/config.json");
time::start("Start",$first_init);
time::phase("Config Register");
route::register(BASE_DIR."/resource/route.json");
//route::register(BASE_DIR."/systems/route.php");
time::phase("Route Register");
$route = route::getRoute($_SERVER["REQUEST_URI"]);
//route::show_index();
time::phase("Route Calculate");
view::getPageView($route);
//var_dump($route);
//route::show_index();
cache::saveShare();
time::phase("Stop");
time::showProcessTime();
//var_dump($_SERVER);

