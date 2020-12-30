<?php

// $db_host = 'localhost';
// $db_user = 'root';
// $db_pass = '';
// $db_name = 'todo-list';

$db_host = 'us-cdbr-east-02.cleardb.com';
$db_user = 'be54de530cabb2';
$db_pass = 'a2170668';
$db_name = 'heroku_befb7e2cd27cbb2';

$db = 
mysqli_connect(
  $db_host, 
  $db_user, 
  $db_pass, 
  $db_name);

if (!$db) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

// echo "conectado!" . PHP_EOL;

// mysqli_close($db);
?>