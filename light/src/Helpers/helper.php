<?php

if( !function_exists('view') )
{
    function view($path, $arr = [])
    {
        return \Light\View\View::render($path, $arr);
    }
}


if( !function_exists('redirect') )
{
    function redirect($path)
    {
        return \Light\Url\Url::redirect($path);
    }
}


