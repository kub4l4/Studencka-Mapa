<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'MapController');
Router::get('news', 'NewsController');
Router::get('map', 'MapController');
Router::get('log_out', 'SecurityController');
Router::get('error', 'DefaultController');

Router::post('log_out', 'SecurityController');
Router::post('register', 'SecurityController');
Router::post('login', 'SecurityController');
Router::post('addNews', 'NewsController');
Router::post('search', 'NewsController');

Router::run($path);