<?php
//File for connecting to Database
require_once __DIR__ . "/../php-activerecord/ActiveRecord.php";
require_once __DIR__ . "../../../../../home/ec2-user/location_config.php";

ActiveRecord\Config::initialize(function($cfg)
 {
    $modelDir = substr(__FILE__, 0, -21) . "model";
     $cfg->set_model_directory($modelDir);
     $cfg->set_connections($local_connections);
 });
