<?php
//Точка входа SPA приложение
require('vendor/autoload.php');
$config = require __DIR__ . '/protected/config.php';

use Core\App;

(new App($config))->run();