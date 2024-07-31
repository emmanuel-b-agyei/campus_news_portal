<?php
session_start();
include('../settings/connection.php');

// Redirecting to login if not logged in
if (empty($_SESSION['login'])) {
    header('location: index.php');
    exit;
}

// Adding new subadmin
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //htmlspecialchars for validat
    $username = htmlspecialchars($_POST['sadminusername']);
    $email = htmlspecialchars($_POST['emailid']);
    $password = (($_POST['pwd'])); 

    
    //Frontend validations
    $errors = [];
    if (!preg_match('/^[a-zA-Z][a-zA-Z0-9-_.]{5,12}$/', $username)) {
        $errors[] = "Username must be alphanumeric and 6 to 12 characters.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (!preg_match("/^(?=.*[!@#$%^&*()_+\-=\[\]{};':\\|,.<>\/?])(?=.*[a-zA-Z0-9]).{8,}$/", $password)) {
        $errors[] = "Password must be at least 8 characters long and must contain at least a special character.";
    } 
    
    if (empty($errors)) {
        // Backend checks for username and email availability
        $checkUsernameQuery = "SELECT * FROM tbladmin WHERE AdminUserName = '$username' LIMIT 1";
        $checkEmailQuery = "SELECT * FROM tbladmin WHERE AdminEmailId = '$email' LIMIT 1";
        $resultUsername = mysqli_query($con, $checkUsernameQuery);
        $resultEmail = mysqli_query($con, $checkEmailQuery);

        if (mysqli_num_rows($resultUsername) > 0) {
            $errors[] = "Username already exists.";
        }
        if (mysqli_num_rows($resultEmail) > 0) {
            $errors[] = "Email already exists.";
        }

        if (empty($errors)) {
            // Inserting subadmin details into database
            $password = md5($password); // Hash the password
            $query = mysqli_query($con, "INSERT INTO tbladmin(AdminUserName,AdminEmailId,AdminPassword,userType) VALUES('$username','$email','$password','0')");

            if ($query) {
                // Success message and redirect
                echo "<script>alert('Sub-admin added successfully.');</script>";
                echo "<script>window.location.href='add-subadmins.php';</script>";
                exit;
            } else {
                $errors[] = "Something went wrong. Please try again.";
            }
        }
    }

    // Display errors
    foreach ($errors as $error) {
        echo "<script>alert('$error');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">;
<head>
    <title>Newsportal | Add Editor</title>

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
    <script src="assets/js/modernizr.min.js"></script>


</head>

<body class="fixed-left">
    <div id="wrapper">
        <!-- Including top header and left sidebar -->
        <?php include('includes/topheader.php'); ?>
        <?php include('includes/leftsidebar.php'); ?>

        <div class="content-page">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Add Editor</h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li>
                                        <a href="#">Admin</a>
                                    </li>
                                    <li>
                                        <a href="#">Editor </a>
                                    </li>
                                    <li class="active">
                                        Add Editor
                                    </li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title"><b>Add Editor</b></h4>
                                <hr />

                                <div class="row">
                                    <div class="col-md-6">
                                        <form class="form-horizontal" name="addsuadmin" method="post">
                                            <div class="form-group">
                                                <label for="exampleInputusername">Username (used for login)</label>
                                                <input type="text" placeholder="Enter Sub-Admin Username" name="sadminusername" id="sadminusername" class="form-control"  required>
                                            </div>

                                            <div class="form-group">
                                                <label for="emailid">Email Id</label>
                                                <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Enter email" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter password" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Comfirm Password</label>
                                                <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Re-enter password" required>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" id="submit" name="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- container -->
            </div> <!-- content -->
        </div>
    </div>

    <!-- Including JavaScript files -->
    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="../plugins/switchery/switchery.min.js"></script>
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

</body>

</html>