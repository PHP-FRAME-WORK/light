<?php

namespace App\Controllers\Admin;

use Light\Http\Response;
use Light\Url\Url;

class OrderController
{

    public function __construct()
    {
    }

    public function list()
    {
        echo "__LIST__";
    }

    public function insert()
    {
        echo "__INSERT__";
        //return Url::redirect("/admin/user");
    }

}