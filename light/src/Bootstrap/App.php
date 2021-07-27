<?php

namespace Light\Bootstrap;

use Light\Database\DB;
use Light\Exceptions\Whoops;
use Light\File\File;
use Light\Http\Request;
use Light\Http\Response;
use Light\Http\Server;
use Light\Router\Route;
use Light\Session\Session;

class App
{

    public static function run()
    {
        Whoops::handle();

        Session::start();

        //echo "<pre>";
        //print_r($_SERVER);
        //echo "</pre>";

        Request::handle();

        //echo Request::getUrl();
        //echo "<br>";
        //echo Request::getBasePath();


        File::include_file("routes/web.php");

        echo "<pre>";
        print_r( Route::getRoutes() );


        $data = Route::handle();

        Response::output($data);



    }

}