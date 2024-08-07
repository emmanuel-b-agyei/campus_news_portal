<?php
session_start();
include('../settings/connection.php');

// Redirect to login if not logged in
if(strlen($_SESSION['login'])==0) { 
    header('location:index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <title>News Portal | Dashboard</title>

    <!-- App CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../plugins/morris/morris.css">
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">

    <script src="assets/js/modernizr.min.js"></script>
</head>

<body class="fixed-left">
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Top Bar Start -->
        <div class="topbar">
            <!-- LOGO -->
            <div class="topbar-left">
                <a href="#" class="logo"><span>NP<span>Admin</span></span><i class="mdi mdi-layers"></i></a>
            </div>
            <?php include('includes/topheader.php'); ?>
        </div>
        <!-- Top Bar End -->

        <!-- Left Sidebar Start -->
        <?php include('includes/leftsidebar.php'); ?>
        <!-- Left Sidebar End -->

        <!-- Start content -->
        <div class="content-page">
            <div class="content">
                <div class="container">
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Dashboard</h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li><a href="../index.php">NewsPortal</a></li>
                                    <li><a href="#">Admin</a></li>
                                    <li class="active">Dashboard</li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End Page Title -->

                    <!-- Dashboard Widgets -->
                    <div class="row">
                        <!-- Live News -->
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="manage-posts.php">
                                <div class="card-box widget-box-one">
                                    <i class="mdi mdi-layers widget-one-icon"></i>
                                    <div class="wigdet-one-content">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User This Month">Live News</p>
                                        <?php 
                                        $query = mysqli_query($con, "SELECT * FROM tblposts WHERE Is_Approved=1");
                                        $countposts = mysqli_num_rows($query);
                                        ?>
                                        <h2><?php echo htmlentities($countposts); ?></h2>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Unapproved News -->
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="manage-posts.php">
                                <div class="card-box widget-box-one">
                                    <i class="mdi mdi-layers widget-one-icon"></i>
                                    <div class="wigdet-one-content">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User This Month">Unapproved News</p>
                                        <?php 
                                        $query = mysqli_query($con, "SELECT * FROM tblposts WHERE Is_Approved=0");
                                        $countposts = mysqli_num_rows($query);
                                        ?>
                                        <h2><?php echo htmlentities($countposts); ?></h2>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Trash News -->
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="trash-posts.php">
                                <div class="card-box widget-box-one">
                                    <i class="mdi mdi-layers widget-one-icon"></i>
                                    <div class="wigdet-one-content">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User This Month">Trash News</p>
                                        <?php 
                                        $query = mysqli_query($con, "SELECT * FROM tblposts WHERE Is_Active=0 and Is_Approved = 1");
                                        $countposts = mysqli_num_rows($query);
                                        ?>
                                        <h2><?php echo htmlentities($countposts); ?></h2>
                                    </div>
                                </div>
                            </a>
                        </div>

                         <!-- Categories Listed -->
                         <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="manage-categories.php">
                                <div class="card-box widget-box-one">
                                    <i class="mdi mdi-chart-areaspline widget-one-icon"></i>
                                    <div class="wigdet-one-content">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">Categories Listed</p>
                                        <?php 
                                        $query = mysqli_query($con, "SELECT * FROM tblcategory WHERE Is_Active=1");
                                        $countcat = mysqli_num_rows($query);
                                        ?>
                                        <h2><?php echo htmlentities($countcat); ?></h2>
                                    </div>
                                </div>
                            </a>
                        </div>

                         <!-- Categories Listed -->
                         <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="manage-categories.php">
                                <div class="card-box widget-box-one">
                                    <i class="mdi mdi-chart-areaspline widget-one-icon"></i>
                                    <div class="wigdet-one-content">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">Number of Editors</p>
                                        <?php 
                                        $query = mysqli_query($con, "SELECT * FROM tbladmin WHERE userType=0");
                                        $countcat = mysqli_num_rows($query);
                                        ?>
                                        <h2><?php echo htmlentities($countcat); ?></h2>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                    <!-- End Dashboard Widgets -->
                </div> <!-- Container -->
            </div> <!-- Content -->
        </div> <!-- Content Page -->
    </div> <!-- Wrapper -->

    <!-- Scripts -->
    <script>
        var resizefunc = [];
    </script>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="../plugins/switchery/switchery.min.js"></script>
    <script src="../plugins/waypoints/jquery.waypoints.min.js"></script>
    <script src="../plugins/counterup/jquery.counterup.min.js"></script>
    <script src="../plugins/morris/morris.min.js"></script>
    <script src="../plugins/raphael/raphael-min.js"></script>
    <script src="assets/pages/jquery.dashboard.js"></script>
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>
</body>
</html>
