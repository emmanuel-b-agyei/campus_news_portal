<?php
// Check if constants are not defined before defining them
if (!defined('DATABASE_HOST')) {
    define('DATABASE_HOST','aucampusne-d590d19f01f6c14a97913087-dbserver.mysql.database.azure.com');
}
if (!defined('DATABASE_USERNAME')) {
    define('DATABASE_USERNAME','rjhssdtnxn');
}
if (!defined('DATABASE_PASSWORD')) {
    define('DATABASE_PASSWORD','8PbYf0ZkBBw$oxhK');
}
if (!defined('DATABASE_NAME')) {
    define('DATABASE_NAME','newsportal');
}

// Create database connection
$con = mysqli_connect(DATABASE_HOST, DATABASE_NAME, DATABASE_PASSWORD, DATABASE_NAME);

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
