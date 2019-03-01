<?php
/**
 * Created by PhpStorm.
 * User: salman
 * Date: 3/1/19
 * Time: 3:52 PM
 */
namespace Salman\Influx\influxDb;

use Ixudra\Curl\Facades\Curl;

class InfluxQuery
{

    public function Postquery($url, array $data)
    {
        $output = Curl::to($url)
            ->withData($data)
            ->withContentType('application/x-www-form-urlencoded')
            ->returnResponseObject()
            ->post();

        return $output;
    }

    public function GetQuery($url)
    {
        $output = Curl::to($url)
            ->returnResponseObject()
            ->get();

        return $output;
    }
}
