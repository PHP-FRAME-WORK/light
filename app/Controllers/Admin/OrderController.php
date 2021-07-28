<?php

namespace App\Controllers\Admin;

use Light\Database\DB;
use Light\Http\Response;
use Light\Url\Url;
use Light\View\View;

class OrderController
{

    public function __construct()
    {
    }
    /*===========================================
    =
    =  list()
    =
    ============================================*/
    public function list()
    {
        $sql = DB::table('users')->get();

        //dd($sql);

        //return View::render("admin.order.list", $arr);
    }
    /*===========================================
    =
    =  insert()
    =
    ============================================*/
    public function insert()
    {
        echo "__INSERT__";
        //return Url::redirect("/admin/user");
    }

}