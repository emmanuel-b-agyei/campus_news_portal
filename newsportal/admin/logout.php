<?php
session_start();
include("includes/config.php");

// Clear the session login information
$_SESSION['login'] = "";

// Unsetting all session variables
session_unset();

// Destroying the session to log the user out completely
session_destroy();
?>

<!-- Redirecting to the login page -->
<script language="javascript">
    document.location = "index.php";
</script>
