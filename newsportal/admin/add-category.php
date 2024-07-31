<?php 
session_start();
include('../settings/connection.php');
error_reporting(0);

if(strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    // Handle category submission
    if(isset($_POST['submit'])) {
        $category = $_POST['category'];
        $description = $_POST['description'];
        $status = 1;
        
        $query = mysqli_query($con, "INSERT INTO tblcategory(CategoryName, Description, Is_Active) VALUES('$category', '$description', '$status')");
        
        if($query) {
            $msg = "Category created successfully.";
        } else {
            $error = "Something went wrong. Please try again.";    
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Newsportal | Add Category</title>
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
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Top Bar Start -->
            <?php include('includes/topheader.php');?>
            <!-- Top Bar End -->

            <!-- Left Sidebar Start -->
            <?php include('includes/leftsidebar.php');?>
            <!-- Left Sidebar End -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <!-- Page Title and Breadcrumbs -->
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Add Category</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li><a href="#">Admin</a></li>
                                        <li><a href="#">Category</a></li>
                                        <li class="active">Add Category</li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Alerts for Success or Error Messages -->
                        <div class="row">
                            <div class="col-sm-6">   
                                <?php if($msg){ ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                                    </div>
                                <?php } ?>

                                <?php if($error){ ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> <?php echo htmlentities($error);?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Category Form -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>Add Category</b></h4>
                                    <hr />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form class="form-horizontal" name="category" method="post">
                                                <!-- Category Name -->
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Category</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="category" placeholder="Enter category name" required>
                                                    </div>
                                                </div>

                                                <!-- Category Description -->
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Category Description</label>
                                                    <div class="col-md-10">
                                                        <textarea class="form-control" rows="5" name="description" placeholder="Enter category description" required></textarea>
                                                    </div>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="form-group">
                                                    <div class="col-md-10 col-md-offset-2">
                                                        <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submit">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row -->
                    </div> <!-- container -->
                </div> <!-- content -->

                <?php include('includes/footer.php');?>
            </div>
        </div>

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
        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
    </body>
</html>
<?php } ?>
