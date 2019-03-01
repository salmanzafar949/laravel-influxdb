<?php
/**
 * Created by PhpStorm.
 * User: salman
 * Date: 3/1/19
 * Time: 3:24 PM
 */

return [

    "dbname"   => env('influx_dbname'),
    "username" => env('influx_username',''),
    "password" => env('influx_password',''),
    "host"     => env('influx_host','localhost'),
    "port"     => env('influx_port','8086'),
    "protocol" => env('influx_protocol','http')

];
