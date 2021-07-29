<?php

namespace Light\View;

use Light\File\File;
use Jenssegers\Blade\Blade;
use Exception;

class View
{

    /*=======================================================
    =
    =  1. render()
    =
    ========================================================*/
    public static function render($path, $arr)
    {
        return static::bladeRender($path, $arr);
    }
    
    /*=======================================================
    =
    =  2. 블레이드 엔진
    =
    ========================================================*/
    public static function bladeRender($path, $arr)
    {


        $blade = new Blade(File::path('views'), File::path('storage/cache'));

        return $blade->make($path, $arr)->render();
    }
    /*=======================================================
    =
    =
    =
    ========================================================*/
    public static function viewRender($path, $data_name, $data = [])
    {
        $path = "views" . File::ds() . str_replace(['/', '\\', '.'], File::ds(), $path) . '.php';

        if( !File::exist($path))
        {
            throw new Exception("viewFile NOT EXIST ");
        }

        ${ $data_name } = $data;

        //dd( $orders );

        include File::path($path);
    }

}