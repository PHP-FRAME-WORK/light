<?php

namespace App\Controllers\Admin;

class OrderController
{

    public function __construct()
    {
    }

    public function list()
    {
        echo "<br>";
        return "__OrderController LIST__";
    }

    public function insert()
    {
        echo "<br>";
        echo "__OrderController INSERT__";
    }

}