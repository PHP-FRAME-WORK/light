<?php
use Light\Bootstrap\App;

class Application
{

    public static function run()
    {

        define("ROOT", realpath(__DIR__ . '/..') );

        define("DS", DIRECTORY_SEPARATOR);






        App::run();

    }




}

