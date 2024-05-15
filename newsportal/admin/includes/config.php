<?php
// Check if constants are not defined before defining them
if (!defined('DB_SERVER')) {
    define('DB_SERVER','localhost');
}
if (!defined('DB_USER')) {
    define('DB_USER','root');
}
if (!defined('DB_PASS')) {
    define('DB_PASS','');
}
if (!defined('DB_NAME')) {
    define('DB_NAME','newsportal');
}

// Create database connection
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Establish database connection.
try
{
    $dbh = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
    exit("Error: " . $e->getMessage());
}
?>
