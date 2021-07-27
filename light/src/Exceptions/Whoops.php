<?php

namespace Light\Exceptions;

use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

class Whoops
{

    public static function handle()
    {
        $whoops = new Run();
        $whoops->prependHandler(new PrettyPageHandler());
        $whoops->register();
    }


}