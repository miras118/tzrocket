<?php

$conn = new mysqli("localhost","root","","tzrocketpractice");
$conn->set_charset("utf8");
if($conn->connect_error){
  die("Could not connect to the database!".$conn->connect_error);
}

?>
