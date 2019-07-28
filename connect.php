<?php
$connection = mysqli_connect('localhost','root','');
$select_db = mysqli_select_db($connection, 'tzrocketpractice');
mysqli_query($connection, "SET NAMES 'utf8'");
?>
