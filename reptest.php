<?php
include "controller/config.php";
$new = new Car();
$new->make = "saab";
$new->model = "95";
$new->save();
$query = Car::all();
print_r($query);

 ?>
