<?php

/*
|--------------------------------------------
| Register the autoloader
|--------------------------------------------
*/

require __DIR__ . "/../vendor/autoload.php";


/*
|--------------------------------------------
| Bootstrap the application
|--------------------------------------------
*/
require __DIR__ . "/../bootstrap/application.php";

/*
|--------------------------------------------
| Run the application
|--------------------------------------------
*/
$app = Application::run();




