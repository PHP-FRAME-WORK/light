<?php

namespace Light\Http;

class Request
{
    private static $url;

    private static $base_path;

    private static $protocol;

    private static $domain;

    private static $path;

    private static $question_mark;

    private static $query_string;

    private static $query_strings;

    private static $method;

    /*=======================================================
    =
    = 1. set
    =
    =======================================================*/
    public static function handle()
    {
        static::setinit();
        static::setUrl();
        static::setBasePath();
    }

    public static function setinit()
    {
        static::$protocol = "http://";
        static::$domain = $_SERVER['HTTP_HOST'];
        static::$path =  $_SERVER['PHP_SELF'];
        static::$question_mark = "?";
        static::$query_string = $_SERVER['QUERY_STRING'];
        static::$method =  $_SERVER['REQUEST_METHOD'];
    }

    public static function setUrl()
    {
        static::$url = static::$protocol . static::$domain . static::$path . static::$question_mark . static::$query_string;
    }

    public static function setBasePath()
    {
        static::$base_path = static::$path . static::$question_mark . static::$query_string;
    }

    /*=======================================================
    =
    = 2. get
    =
    =======================================================*/
    public static function getUrl()
    {
        return static::$url;
    }

    public static function getBasePath()
    {
        return static::$base_path;
    }

    public static function getDomain()
    {
        return static::$domain;
    }

    public static function getPath()
    {
        return static::$path;
    }


    public static function get_query_string()
    {
        return static::$query_string;
    }

    public static function get_method()
    {
        return static::$query_string;
    }
    /*================================================
    =
    =
    =
    =================================================*/
    public static function get_firstSection_path()
    {
        $arr = static::get_array_from_path();
        array_pop($arr);
        $str = implode('/', $arr);

        return $str;
    }

    public static function get_lastSection_path()
    {
        $arr = static::get_array_from_path();
        $last_element = end($arr);

        return $last_element;
    }

    public static function get_array_from_path()
    {
        $arr = explode('/', static::getPath());
        array_shift($arr);
        array_pop($arr);

        return $arr;
    }


}