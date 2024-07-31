<?php 
session_start();
include('../settings/connection.php');
error_reporting(0);

// Check if the user is logged in
if(strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    // Handle post approval
    if($_GET['action'] == 'approve') {
        $postid = intval($_GET['pid']);
        $query = mysqli_query($con, "UPDATE tblposts SET Is_Approved = 1 WHERE id='$postid'");
        if($query) {
            $msg = "Post approved successfully";
        } else {
            $error = "Something went wrong. Please try again.";    
        } 
    }

    
    // Handle post deletion
    if(isset($_GET['action']) && $_GET['action'] == 'del') {
        $postid = intval($_GET['pid']);
        $query = mysqli_query($con, "UPDATE tblposts SET Is_Active = 0 WHERE id='$postid'");
        if($query) {
            $msg = "Post deleted";
        } else {
            $error = "Something went wrong. Please try again.";    
        } 
    }

    // Handle permanent post deletion (if needed)
    if (isset($_GET['action']) && $_GET['action'] == 'del') {
        $postid = intval($_GET['pid']);
        $query = mysqli_query($con, "DELETE FROM tblposts WHERE id='$postid'");
        if ($query) {
            $msg = "Post deleted";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <title>Newsportal | Manage Posts</title>
    <link href="../plugins/morris/morris.css" rel="stylesheet">
    <link href="../plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css">
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css">
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
    <script src="assets/js/modernizr.min.js"></script>
</head>

<body class="fixed-left">
    <div id="wrapper">
        <!-- Top Bar Start -->
        <?php include('includes/topheader.php'); ?>
        <!-- Left Sidebar Start -->
        <?php include('includes/leftsidebar.php'); ?>
        <!-- Left Sidebar End -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <!-- Page Title and Breadcrumbs -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Manage Posts</h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li><a href="#">Admin</a></li>
                                    <li><a href="#">Posts</a></li>
                                    <li class="active">Manage Post</li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Manage Posts Table -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="table-responsive">
                                    <table class="table table-colored table-centered table-inverse m-0">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = mysqli_query($con, "SELECT tblposts.id AS postid, tblposts.PostTitle AS title, tblcategory.CategoryName AS category, tblsubcategory.Subcategory AS subcategory, tblposts.Is_Approved FROM tblposts LEFT JOIN tblcategory ON tblcategory.id = tblposts.CategoryId LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblposts.SubCategoryId WHERE tblposts.Is_Active IN (0, 1) AND tblposts.Is_Approved IN (1, 0)");
                                            $rowcount = mysqli_num_rows($query);
                                            if($rowcount == 0) {
                                            ?>
                                                <tr>
                                                    <td colspan="4" align="center"><h3 style="color:red">No unapproved posts found</h3></td>
                                                </tr>
                                            <?php 
                                            } else {
                                                while($row = mysqli_fetch_array($query)) {
                                            ?>
                                                    <tr>
                                                        <td><b><?php echo htmlentities($row['title']); ?></b></td>
                                                        <td><?php echo htmlentities($row['category']); ?></td>
                                                        <td><?php echo ($row['Is_Approved'] == 1) ? 'Approved' : 'Not Approved'; ?></td>
                                                        <td>
                                                            <a href="edit-post.php?pid=<?php echo htmlentities($row['postid']); ?>"><i class="fa fa-pencil" style="color: green;"></i></a>
                                                            <?php 
                                                            if ($row['Is_Approved']==1) {
                                                                ?>
                                                                &nbsp;<a href="manage-posts.php?pid=<?php echo htmlentities($row['postid']); ?>&action=approve" onclick= <?php echo("Already Approved")?>>Approved</a>
                                                            <?php } 
                                                            else{ ?>
                                                                &nbsp;<a href="manage-posts.php?pid=<?php echo htmlentities($row['postid']); ?>&action=approve" onclick="return confirmApprove()">Approve</a>
                                                            <?php }?>
                                                            &nbsp;<a href="manage-posts.php?pid=<?php echo htmlentities($row['postid']); ?>&action=del" onclick="return confirmDelete()">Delete</a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <!-- Include JavaScript files -->
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
        <script src="../plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="../plugins/jvectormap/gdp-data.js"></script>
        <script src="../plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>
        <script src="assets/pages/jquery.blog-dashboard.js"></script>
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        <script>
            // Confirm deletion of a post
            function confirmDelete() {
                return confirm('Do you really want to delete?');
            }

            // Confirm approval of a post
            function confirmApprove() {
                return confirm('Approve this post?');
            }
        </script>
    </body>
</html>
<?php } ?>
