<?php

namespace App\Repository;


class Functions
{
    public static function dateToMysql($date)
    {
        return date("Y-m-d", strtotime(str_replace('/', '-', $date)));
    }
}
