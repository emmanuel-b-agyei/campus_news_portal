<?php 
session_start();
include('settiings/connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>News Portal | Home Page</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <?php include('includes/header.php');?>

    <!-- Page Content -->
    <div class="container">
        <div class="row" style="margin-top: 4%">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                $pid = intval($_GET['nid']);
                $currenturl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                $query = mysqli_query($con, "SELECT tblposts.PostTitle as posttitle, tblposts.PostImage, tblcategory.CategoryName as category, tblcategory.id as cid, tblsubcategory.Subcategory as subcategory, tblposts.PostDetails as postdetails, tblposts.PostingDate as postingdate, tblposts.PostUrl as url, tblposts.postedBy, tblposts.lastUpdatedBy, tblposts.UpdationDate FROM tblposts LEFT JOIN tblcategory ON tblcategory.id = tblposts.CategoryId LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblposts.SubCategoryId WHERE tblposts.id = '$pid'");

                while ($row = mysqli_fetch_array($query)) {
                ?>

                <!-- Blog Post -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
                        <!-- Category -->
                        <a class="badge bg-secondary text-decoration-none link-light" href="category.php?catid=<?php echo htmlentities($row['cid'])?>" style="color:#fff"><?php echo htmlentities($row['category']);?></a>
                        <!-- Subcategory -->
                        <a class="badge bg-secondary text-decoration-none link-light" style="color:#fff"><?php echo htmlentities($row['subcategory']);?></a>
                        <p>
                            <b>Posted by </b> <?php echo htmlentities($row['postedBy']);?> on <?php echo htmlentities($row['postingdate']);?> |
                            <?php if ($row['lastUpdatedBy'] != ''): ?>
                                <b>Last Updated by </b> <?php echo htmlentities($row['lastUpdatedBy']);?> on <?php echo htmlentities($row['UpdationDate']);?>
                            <?php endif; ?>
                        </p>
                        <p><strong>Share:</strong>
                            <a href="http://www.facebook.com/" target="_blank">Facebook</a> | 
                            <a href="https://twitter.com/" target="_blank">Twitter</a> |
                            <a href="https://web.whatsapp.com" target="_blank">Whatsapp</a> | 
                            <a href="http://www.linkedin.com/" target="_blank">Linkedin</a>
                        </p>
                        <hr />
                        <img class="img-fluid rounded" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>">
                        <p class="card-text"><?php echo nl2br(htmlentities($row['postdetails'])); ?></p>
                    </div>
                    <div class="card-footer text-muted"></div>
                </div>
                <?php } ?>
            </div>

            <!-- Sidebar Widgets Column -->
            <?php include('includes/sidebar.php');?>
        </div>
        <!-- /.row -->

        <!-- Comment Section -->
        <div class="row" style="margin-top: -8%">
            <div class="col-md-8">
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form name="Comment" method="post">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Enter your fullname" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Enter your valid email" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="phone" class="form-control" placeholder="Enter Phone" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="comment" rows="3" placeholder="Comment" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
