<?php
/**
 * Created by PhpStorm.
 * User: salman
 * Date: 3/1/19
 * Time: 3:33 PM
 */

namespace Salman\Influx\influxDb;

class InfluxDbConnector
{
    public    $debug = false; // for debugging
    protected $port;
    protected $host;
    protected $dbname;
    protected $username;
    protected $password;
    protected $protocol;
    protected $url;
    protected $query;
    protected $conn = false;

    public function __construct()
    {
        $this->port     = config('influx.port');
        $this->host     = config('influx.host');
        $this->username = config('influx.username');
        $this->password = config('influx.password');
        $this->dbname   = config('influx.dbname');
        $this->protocol = config('influx.protocol');
        $this->url      = $this->protocol.'://'.$this->host.':'.$this->port;
        $this->query    = new InfluxQuery();
        $this->conn     = $this->CheckInfluxConnection();
    }


    public function CheckInfluxConnection()
    {
        $final_url = $this->url.'/ping?u='.$this->username.'&p='.$this->password;

        $output = $this->query->GetQuery($final_url);

        if ($output->status === 204)
        {
            return true;
        }

        if($output->status === 401)
        {
            return "Invalid authentication credentials";
        }

    }

    public function CreateDb($dbname)
    {
        if ($this->conn === false)
        {
            return false;
        }

        $final_url = $this->url.'/query?u='.$this->username.'&p='.$this->password;
        $q = "CREATE DATABASE \"$dbname\"";

        $data = array(
            'q' => $q
        );

       $res = $this->query->Postquery($final_url,$data);

       if ($res->status === 200)
       {
           return $res->content;
       }

       return $res->content.' - '.$res->status;

    }

    public function GetAllMeasurements()
    {
        if ($this->conn === false)
        {
            return false;
        }

        $final_url = $this->url.'/query?db='.$this->dbname.'&u='.$this->username.'&p='.$this->password;
        $q = "show measurements";

        $data = array(
            'q' => $q
        );

        $res = $this->query->Postquery($final_url,$data);

        if ($res->status === 200)
        {
            return $res->content;
        }

        return $res->content.' - '.$res->status;
    }
}
