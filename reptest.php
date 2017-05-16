<?php
include "controller/config.php";
$new = new Car();
$new->make = "dodge";
$new->model = "ram";
$new->save();
$query = Car::all();
print_r($query);

 ?>
