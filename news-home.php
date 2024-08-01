<?php
// Start session
session_start();

// Include configuration file for database connection
include('settings/connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="AU Campus News Portal">
    <meta name="author" content="">

    <title> Campus News Portal | Home Page</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <?php include('includes/header.php'); ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row" style="margin-top: 4%">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php
                // Fetch approved posts
                $query = mysqli_query($con, "SELECT tblposts.id AS pid, tblposts.PostTitle AS posttitle, tblposts.PostImage, 
                        tblcategory.CategoryName AS category, tblcategory.id AS cid, tblposts.PostDetails AS postdetails, tblposts.PostingDate AS postingdate, tblposts.PostUrl AS url 
                        FROM tblposts 
                        LEFT JOIN tblcategory ON tblcategory.id = tblposts.CategoryId 
                        WHERE tblposts.IS_Approved = 1 
                        ORDER BY tblposts.id DESC 
                        LIMIT $offset, $no_of_records_per_page");

                // Display posts
                while ($row = mysqli_fetch_array($query)) {
                ?>
                    <div class="card mb-4">
                        <h2 class="card-title"><?php echo htmlentities($row['posttitle']); ?></h2>
                        <img class="card-img-top" src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>">
                        <div class="card-body">
                            <p>
                                <a class="badge bg-secondary text-decoration-none link-light" href="category.php?catid=<?php echo htmlentities($row['cid']); ?>" style="color:#fff">
                                    <?php echo htmlentities($row['category']); ?>
                                </a>
                            </p>
                            <a href="news-details.php?nid=<?php echo htmlentities($row['pid']); ?>" class="btn btn-primary">Read More &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                            Posted on <?php echo htmlentities($row['postingdate']); ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Sidebar -->
            <?php include('includes/sidebar.php'); ?>

        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
