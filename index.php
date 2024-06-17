<?php

use App\Services\LanguageService;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once 'vendor/autoload.php';



$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$langService = new LanguageService();
$langService->language();


require_once 'config/langs.php';
require_once 'config/app.php';


require_once 'config/database.php';
require_once 'config/router.php';




