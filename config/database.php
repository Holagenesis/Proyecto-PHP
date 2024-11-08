<?php
require 'config/constants.php';

$host = 'localhost';
$user= 'root';
$password = '12345678';
$db = 'blogg';

$conn = mysqli_connect($host, $user, $password, $db) or die('coonnection failed');


?>