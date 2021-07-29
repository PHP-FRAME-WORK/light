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
        $result = DB::table('users')->where(["name", "=", "윤승호"])->get();

        dd($result);

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
        $last_id = DB::table('users')->insert(["name" => "박명수"]);

        echo $last_id;

    }
    /*===========================================
    =
    =  update()
    =
    ============================================*/
    public function update()
    {
        echo "__UPDATE__";
        $count = DB::table('users')->where(['name','=','윤승호'])->update(["password" => 4321]);
        echo $count;
    }



}