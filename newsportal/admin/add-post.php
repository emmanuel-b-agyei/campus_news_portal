<?php 
session_start();
include('includes/config.php');
error_reporting(0);

// Check if the user is logged in
if(strlen($_SESSION['login'])==0) { 
    header('location:index.php');
} else {
    // For adding a post
    if(isset($_POST['submit'])) {
        $posttitle = $_POST['posttitle'];
        $catid = $_POST['category'];
        $subcatid = $_POST['subcategory'];
        $postdetails = addslashes($_POST['postdescription']);
        $postedby = $_SESSION['login'];
        $arr = explode(" ", $posttitle);
        $url = implode("-", $arr);
        $imgfile = $_FILES["postimage"]["name"];
        
        // Get the image extension
        $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
        // Allowed extensions
        $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
        if(!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            $imgnewfile = md5($imgfile).$extension;
            // Move image into directory
            move_uploaded_file($_FILES["postimage"]["tmp_name"], "postimages/".$imgnewfile);

            $status = 0; // Initially set status to 0 (not approved)
            $query = mysqli_query($con, "INSERT INTO tblposts(PostTitle, CategoryId, SubCategoryId, PostDetails, PostUrl, Is_Active, Is_Approved, PostImage, postedBy) VALUES ('$posttitle', '$catid', '$subcatid', '$postdetails', '$url', 1, '$status', '$imgnewfile', '$postedby')");
            if($query) {
                $msg = "Post submitted for approval. It will appear on the news page after admin approval.";
            } else {
                $error = "Something went wrong. Please try again.";    
            }
        }
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
    <title>Newsportal | Add Post</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Summernote css -->
    <link href="../plugins/summernote/summernote.css" rel="stylesheet" />
    <!-- Select2 -->
    <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- Jquery filer css -->
    <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
    <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
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
        <?php include('includes/leftsidebar.php');?>

        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Add Post</h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li><a href="#">Post</a></li>
                                    <li><a href="#">Add Post</a></li>
                                    <li class="active">Add Post</li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-6">  
                            <!-- Success Message -->  
                            <?php if($msg){ ?>
                            <div class="alert alert-success" role="alert">
                                <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                            </div>
                            <?php } ?>

                            <!-- Error Message -->
                            <?php if($error){ ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Oh snap!</strong> <?php echo htmlentities($error);?></div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="p-6">
                                <div class="">
                                    <form name="addpost" method="post" enctype="multipart/form-data">
                                        <div class="form-group m-b-20">
                                            <label for="posttitle">Post Title</label>
                                            <input type="text" class="form-control" id="posttitle" name="posttitle" placeholder="Enter title" required>
                                        </div>

                                        <div class="form-group m-b-20">
                                            <label for="category">Category</label>
                                            <select class="form-control" name="category" id="category" onChange="getSubCat(this.value);" required>
                                                <option value="">Select Category</option>
                                                <?php
                                                // Fetching active categories
                                                $ret = mysqli_query($con, "SELECT id, CategoryName FROM tblcategory WHERE Is_Active=1");
                                                while($result = mysqli_fetch_array($ret)) {
                                                ?>
                                                <option value="<?php echo htmlentities($result['id']);?>"><?php echo htmlentities($result['CategoryName']);?></option>
                                                <?php } ?>
                                            </select> 
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card-box">
                                                    <h4 class="m-b-30 m-t-0 header-title"><b>Post Details</b></h4>
                                                    <textarea style="height: 7vw; width: 100%;"
                                                    class="summernote" name="postdescription" required></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card-box">
                                                    <h4 class="m-b-30 m-t-0 header-title"><b>Feature Image</b></h4>
                                                    <input type="file" class="form-control" id="postimage" name="postimage" required>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Save and Post</button>
                                        <a href="index.php"><button type="button" class="btn btn-danger waves-effect waves-light">Discard</button></a>
                                    </form>
                                </div>
                            </div> 
                        </div> 
                    </div>
                </div> 
            </div> 
            <?php include('includes/footer.php');?>
        </div>
    </div>

    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="../plugins/switchery/switchery.min.js"></script>
    <!-- Summernote js -->
    <script src="../plugins/summernote/summernote.min.js"></script>
    <!-- Select2 -->
    <script src="../plugins/select2/js/select2.min.js"></script>
    <!-- jQuery filer js -->
    <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>
    <!-- Page specific js -->
    <script src="assets/pages/jquery.blog-add.init.js"></script>
    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

    <script>
        jQuery(document).ready(function() {
            $('.summernote').summernote({
                height: 240,
                minHeight: null,
                maxHeight: null,
                focus: false
            });
            $(".select2").select2();
            $(".select2-limiting").select2({
                maximumSelectionLength: 2
            });
        });
    </script>
</body>
</html>
