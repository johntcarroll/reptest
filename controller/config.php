<?php
//File for connecting to Database
require_once __DIR__ . "/../php-activerecord/ActiveRecord.php";

ActiveRecord\Config::initialize(function($cfg)
 {
    $modelDir = substr(__FILE__, 0, -21) . "model";
     $cfg->set_model_directory($modelDir);
     $cfg->set_connections(array(
         'read' => 'mysql://johnc:fcbarcelona@localhost/wholesale',
         'write' => 'mysql://johnc:fcbarcelona@52.25.200.66/imardb_test'
         ));
 });
