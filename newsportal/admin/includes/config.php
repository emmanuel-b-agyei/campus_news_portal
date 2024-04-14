<?php
// Check if constants are not defined before defining them
if (!defined('DB_SERVER')) {
    define('DB_SERVER','aucampusne-d590d19f01f6c14a97913087-dbserver.mysql.database.azure.com');
}
if (!defined('DB_USER')) {
    define('DB_USER','rjhssdtnxn');
}
if (!defined('DB_PASS')) {
    define('DB_PASS','8PbYf0ZkBBw$oxhK');
}
if (!defined('DB_NAME')) {
    define('DB_NAME','aucampusne_d590d19f01f6c14a97913087_database');
}

// Create database connection
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
