<?php

namespace Light\Url;

class Url
{


    public static function redirect($path)
    {
        header('location: '. $path);
        exit();
    }

}