<?php

namespace Light\Database;

use Light\File\File;
use PDO;
use PDOException;
use Exception;

class DB
{

    protected static $instance;

    protected static $connection;

    protected static $select;

    protected static $table;

    private function __construct(){}

    /*===================================================
    =
    =  connect()
    =
    ===================================================*/
    private static function connect()
    {
        if( !static::$connection )
        {
            $arr = File::include_file("config/database.php");

            $dsn = "mysql:dbname" . $arr['dbname'] . ";host=" . $arr['host'] . "";

            $username = $arr['username'];
            $password = $arr['password'];

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ];

            try
            {

                static::$connection = new PDO($dsn, $username, $password, $options);

            }
            catch(PDOException $e)
            {
                throw new Exception( $e->getMessage() );
            }
        }
    }
    /*===================================================
    =
    =  instance()
    =
    ===================================================*/
    public static function instance()
    {
        static::connect();

        if( !static::$instance )
        {
            static::$instance = new DB();
        }

        return static::$instance;
    }
    /*===================================================
    =
    =  쿼리 빌더
    =
    ===================================================*/
    public static function query($sql = null)
    {
        static::instance();

        if($sql == null)
        {
            if( !static::$table )
            {
                throw new Exception("Unknown table ");
            }

            $sql = " SELECT     ";
            $sql.= static::$select ? : '*';
            $sql.=" FROM " . static::$table . " ";

        }
    }

    public static function table($table)
    {
        static::$table = $table;

        return static::instance();
    }

    public static function get()
    {
        //
        
    }
}