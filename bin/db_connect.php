<?php
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "homew");
define("DATABASE", "oats");

//$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
$conn = mysql_connect(HOST , USER, PASSWORD);
mysql_select_db(DATABASE, $conn);
?>
