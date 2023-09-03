<?php
error_reporting(E_ALL);
ini_set("display_errors", "on");

require "./ajax/User.php";

$test = new User("chocolate","isaque");

var_dump($test);

?>