<?php
include "controller/config.php";
$new = new Car();
$car->make = "saab";
$car->model = "95";
$car->save();
$query = Car::all();
print_r($query);

 ?>
