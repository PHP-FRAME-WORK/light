<?php

namespace Light\Session;

class Session
{


    private function __construct(){}

    public static function start()
    {
        if( !session_id() )
        {
            session_start();
        }
    }

    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;

        return $val;
    }

    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    public static function get($key)
    {
        return static::has($key) ? $_SESSION[$key] : null;
    }


}

