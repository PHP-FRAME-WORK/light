<?php

namespace  Light\Router;

use Light\Http\Request;
use ReflectionMethod;

class Route
{
    private static $routes = [];

    private static $prefix = null;

    private static $middleware = null;
    /*===============================================================
    =
    =  prefix
    =
    ================================================================*/
    public static function prefix($prefix, $callback)
    {
        static::$prefix = $prefix;

        if( is_callable($callback) )
        {
            call_user_func($callback);
            static::$prefix = null;
        }
        else
        {
            throw new \BadFunctionCallException("provide valid callbackk function");
        }
    }
    /*===============================================================
    =
    =  middleware
    =
    ================================================================*/
    public static function middleware($middleware, $callback)
    {
        static::$middleware = $middleware;

        if( is_callable($callback) )
        {
            call_user_func($callback);
            static::$middleware = null;
        }
        else
        {
            throw new \BadFunctionCallException("provide valid callbackk function");
        }
    }
    /*===============================================================
    =
    =  add
    =
    ================================================================*/
    public static function add($method, $uri, $callback)
    {
        static::$routes[] = [
            "prefix" => static::$prefix,
            "middleware" => static::$middleware,
            "uri" => $uri,
            "callback" => $callback,
            "method" => $method
        ];
    }
    /*===============================================================
    =
    =  get
    =
    ================================================================*/
    public static function get($uri, $callback)
    {
        static::add('GET', $uri, $callback);
    }

    public static function post($uri, $callback)
    {
        static::add('POST', $uri, $callback);
    }
    /*===============================================================
    =
    =  getRoutes()
    =
    ================================================================*/
    public static function getRoutes()
    {
        return static::$routes;
    }
    /*===============================================================
    =
    =  handle
    =
    ================================================================*/
    public static function handle()
    {
        $first = Request::get_firstSection_path();
        $last = Request::get_lastSection_path();

        foreach(static::$routes as $route)
        {
            IF( gettype($route['callback']) == "array" )
            {
                IF( isset($route['prefix']) )
                {
                    //echo "__111__";
                    if( $route['prefix'] . '/' . $route['uri'] == $first && $route['callback'][1] == $last )
                    {
                        $data = static::class_handler($route['middleware'], $route['uri'], $route['callback'][0], $route['callback'][1]);
                        return $data;
                    }
                    else
                    {
                        //echo "<br>";
                        //echo "_NOT_";
                    }
                }
                ELSE
                {
                    //echo "__222__";
                    if( $route['uri'] == $first && $route['callback'][1] == $last )
                    {
                        $data = static::class_handler($route['middleware'], $route['uri'], $route['callback'][0], $route['callback'][1]);
                        return $data;
                    }
                    else
                    {
                        //echo "<br>";
                        //echo "_NOT_";
                    }
                }

            }
            ELSE
            {
                //echo "__222__";
            }
        }


    }//_handle_end
    /*===============================================================
    =
    =  class_handler
    =
    ================================================================*/
    public static function class_handler($middleware, $uri, $controll, $function)
    {
        $flag = true;
        
        /*----------------------------
        - 미들웨어 있으면 실행
        ----------------------------*/
        if( $middleware )
        {
            $flag = static::execute_middle($middleware);
        }
        /*----------------------------
        - contoroller 실행
        ----------------------------*/
        if($flag)
        {
            $controller = new $controll();

            $data = $controller->${'function'}();

            return $data;
        }

    }
    /*===============================================================
    =
    =
    =
    ================================================================*/
    public static function execute_middle($middle_class)
    {
        $middleware_class = '\App\Middeware\\' .  ucfirst($middle_class);

        //echo $middleware_class ;

        if( class_exists($middleware_class ) )
        {
            $middleware = new $middleware_class();
            return $middleware->handle();
        }
        else
        {
            new \Exception('found not'. $middleware_class);
        }


    }


}
