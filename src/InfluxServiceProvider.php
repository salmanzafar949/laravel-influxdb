<?php
/**
 * Created by PhpStorm.
 * User: salman
 * Date: 3/1/19
 * Time: 3:12 PM
 */

namespace Salman\Influx;

use Illuminate\Support\ServiceProvider;

class InfluxServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/config/influx.php','influx');
        $this->publishes([

            __DIR__.'/config/influx.php' => config_path('influx.php')
        ]);
    }

    public function register()
    {

    }
}
