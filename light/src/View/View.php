<?php

namespace Light\View;

use Light\File\File;
use Exception;

class View
{

    public static function render($path, $data = [])
    {
        $path = "views" . File::ds() . str_replace(['/', '\\', '.'], File::ds(), $path) . '.php';

        if( !File::exist($path))
        {
            throw new Exception("viewFile NOT EXIST ");
        }

        extract($data);
        include File::path($path);
    }

}