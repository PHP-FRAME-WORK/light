<?php

namespace App\Middeware;

class Auth
{
    public function __construct()
    {
        //echo "<br>";
        //echo "__Auth_middleware__";
    }

    public function handle()
    {
        //echo "__HANDLE__";
        return true;
    }
}

