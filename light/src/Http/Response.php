<?php

namespace Light\Http;

class Response
{

    public static function output($data)
    {
        if( !$data )
        {
            return false;
        }

        echo $data;

    }

}