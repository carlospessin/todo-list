<?php

// $db_host = 'localhost';
// $db_user = 'root';
// $db_pass = '';
// $db_name = 'todo-list';

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$db_host = $url["host"];
$db_user = $url["user"];
$db_pass = $url["pass"];
$db_name = substr($url["path"], 1);

$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
mysqli_set_charset($db, "utf8");

if (!$db) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>