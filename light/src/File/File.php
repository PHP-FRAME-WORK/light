<?php

namespace Light\File;

class File
{

    public static function root()
    {
        return ROOT;
    }

    public static function ds()
    {
        return DS;
    }

    public static function path($path)
    {
        $path = static::root() . static::ds() . $path;

        return $path;
    }

    public static function exist($path)
    {
        return file_exists( static::path($path) );
    }

    public static function include_file($path)
    {
        if( static::exist($path) )
        {
            return include   static::path($path);
        }

        throw new \Exception("File not found !!!");
    }
}
