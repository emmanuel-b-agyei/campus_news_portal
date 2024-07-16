<?php
session_start();
include('includes/config.php');

$errorMessage = "";

// Handle login form submission
if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = md5($_POST['password']);

    // Check if username exists
    $query = mysqli_prepare($con, "SELECT AdminUserName, AdminEmailId, AdminPassword, userType FROM tbladmin WHERE AdminUserName=?");
    mysqli_stmt_bind_param($query, "s", $username);
    mysqli_stmt_execute($query);
    mysqli_stmt_store_result($query);

    if (mysqli_stmt_num_rows($query) == 0) {
        $errorMessage = "Username does not exist.";
    } else {
        // Verify password
        mysqli_stmt_bind_result($query, $dbUsername, $dbEmail, $dbPassword, $userType);
        mysqli_stmt_fetch($query);
        
        if ($dbPassword !== $password) {
            $errorMessage = "Incorrect password.";
        } else {
            // Successful login
            $_SESSION['login'] = $username;
            $_SESSION['utype'] = $userType;
            echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="News Portal.">
    <meta name="author" content="PHPGurukul">

    <title>News Portal | Admin Panel</title>

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/modernizr.min.js"></script>
</head>
<body class="bg-transparent">
    <section>
        <div class="container-alt">
            <div class="row">
                <div class="col-sm-12">
                    <div class="wrapper-page">
                        <div class="m-t-40 account-pages">
                            <div class="text-center account-logo-box">
                                <h2 class="text-uppercase">
                                    <a href="index.html" class="text-success">
                                        <span><img src="assets/images/logo.png" alt="" height="56"></span>
                                    </a>
                                </h2>
                            </div>
                            <div class="account-content">
                                <form class="form-horizontal" method="post">
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <label for="username">Username or email</label>
                                            <input class="form-control" type="text" name="username" id="username" placeholder="Username or email" required>
                                            <?php if ($errorMessage == "Username does not exist.") { ?>
                                                <small class="text-danger"><?php echo $errorMessage; ?></small>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <label for="password">Password</label>
                                            <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                                            <?php if ($errorMessage == "Incorrect password.") { ?>
                                                <small class="text-danger"><?php echo $errorMessage; ?></small>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <a href=""><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                        </div>
                                    </div>
                                    <div class="form-group account-btn text-center m-t-10">
                                        <div class="col-xs-12">
                                            <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit" name="login">Log In</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="clearfix"></div>
                                <a href="../index.php"><i class="mdi mdi-home"></i> Back Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>

    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>
</body>
</html>