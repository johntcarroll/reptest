<?php
include "controller/config.php";
$new = new Car();
$new->make = "chevy";
$new->model = "impala";
$new->save();
$query = Car::all();
print_r($query);

 ?>
