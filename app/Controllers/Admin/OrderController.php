<?php

namespace App\Controllers\Admin;

use Light\Http\Response;
use Light\Url\Url;
use Light\View\View;

class OrderController
{

    public function __construct()
    {
    }

    public function list()
    {
        $arr = [
            "db" => "mysql",
            "host" => "localhost"
        ];

        return View::render("admin.order.list", $arr);
    }

    public function insert()
    {
        echo "__INSERT__";
        //return Url::redirect("/admin/user");
    }

}