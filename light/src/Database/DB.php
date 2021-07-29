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

    protected static $sql;

    protected static $select;

    protected static $table;

    protected static $where = [];

    protected static $where_array_cnt = 0;

    protected static $where_column = [];

    protected static $where_operator = [];

    protected static $where_binding = [];

    protected static $setter;

    protected static $join;

    protected static $binding = [];

    private function __construct(){}

    /*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    =
    =  connect()
    =
    @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
    private static function connect()
    {
        if( !static::$connection )
        {
            $arr = File::include_file("config/database.php");

            $dsn = "mysql:dbname=" . $arr['dbname'] . ";host=" . $arr['host'] . "";

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
    /*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    =
    =  instance()
    =
    @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
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
    =  1. table()
    =
    ===================================================*/
    public static function table($table)
    {
        static::$table = $table;

        return static::instance();
    }
    /*===================================================
    =
    =  2. where()
    =
    ===================================================*/
    public static function where(array $arr)
    {
        static::$where = $arr;

        static::$where_array_cnt = static::$where_array_cnt + 1;

        static::$where_column[] = $arr[0];
        static::$where_operator[] = $arr[1];
        static::$where_binding[] = $arr[2];

        return static::instance();
    }

    public static function assembleWhere()
    {
        $sql = " WHERE ";

        for ($i = 0; $i < static::$where_array_cnt; $i++) {
            $sql .= static::$where_column[$i];
            $sql .= static::$where_operator[$i];
            $sql .= " ? ";

            if ($i == 0 && static::$where_array_cnt > 1) {
                $sql .= " AND ";
            }
        }

        return $sql;
    }
    /*===================================================
    =
    =  3. sql 문장 합치기
    =
    ===================================================*/
    public static function assembleSelectStatement($sql= null)
    {

        IF($sql == null)
        {
            if( !static::$table )
            {
                throw new Exception("Unknown table ");
            }

            $sql = " SELECT ";  $sql.= static::$select ? : '*';
            $sql.= " FROM " . static::$table . " ";

            if( count(static::$where) > 0 )
            {
                $sql .= static::assembleWhere();
            }

            static::$sql = $sql;

            return static::instance();
        }

    }

    /*===================================================
    =
    =  4. before_fetching()
    =
    ===================================================*/
    public static function before_fetching()
    {
        static::assembleSelectStatement();

        $sql = static::$sql;

        $stmt = static::$connection->prepare($sql);

        $stmt->execute(static::$where_binding);

        return $stmt;
    }

    /*===================================================
    =
    =  5. 최종 실행 get()
    =
    ===================================================*/
    public static function get()
    {
        $stmt = static::before_fetching();

        $rows = $stmt->fetchAll();

        return $rows;
    }
    /*===================================================
    =
    =  5. 최종 실행 first()
    =
    ===================================================*/
    public static function first()
    {
        $stmt = static::before_fetching();

        $row = $stmt->fetch();

        return $row;
    }
    /*===================================================
    =
    =  101. execute()
    =
    ===================================================*/
    public static function execute($arr, $sql, $where_flag = null)
    {
        foreach ($arr as $key => $val)
        {
            static::$setter .= $key . ' = ? ';
            static::$binding[] = $val;
        }

        //dd( static::$binding );

        $sql.= static::$setter;

        static::$sql = $sql;

        if( $where_flag )
        {
            $sql .= static::assembleWhere();
        }

        static::$binding = array_merge(static::$binding, static::$where_binding);

        //dd( static::$binding );

        $stmt = static::$connection->prepare($sql);
        $stmt->execute( static::$binding );

        $count = $stmt->rowCount();

        return $count;
    }
    /*===================================================
    =
    =  101. insert()
    =
    ===================================================*/
    public static function insert(array $arr)
    {
        $table = static::$table;

        $sql = " INSERT INTO " . $table . " SET ";

        static::execute($arr, $sql);

        $last_id = static::$connection->lastInsertId();

        return $last_id;
    }
    /*===================================================
    =
    =  102. update()
    =
    ===================================================*/
    public static function update($arr)
    {
        $table = static::$table;

        $sql = " UPDATE " . $table . " SET ";

        $count = static::execute($arr, $sql, true);

        return $count;
    }

    public static function getSql()
    {
        static::assembleSelectStatement();
        return static::$sql;
    }































}