<?php
// Start session
session_start();

// Include configuration file for database connection
include('includes/connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="AU Campus News Portal">
    <meta name="author" content="">

    <title>AU Campus News Portal | Home Page</title>

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

                <!-- Pagination Logic -->
                <?php
                $pageno = isset($_GET['pageno']) ? (int)$_GET['pageno'] : 1;
                $no_of_records_per_page = 8;
                $offset = ($pageno - 1) * $no_of_records_per_page;

                $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
                $result = mysqli_query($con, $total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);

                // Fetch approved posts
                $query = mysqli_query($con, "SELECT tblposts.id AS pid, tblposts.PostTitle AS posttitle, tblposts.PostImage, 
                        tblcategory.CategoryName AS category, tblcategory.id AS cid, tblsubcategory.Subcategory AS subcategory, 
                        tblposts.PostDetails AS postdetails, tblposts.PostingDate AS postingdate, tblposts.PostUrl AS url 
                        FROM tblposts 
                        LEFT JOIN tblcategory ON tblcategory.id = tblposts.CategoryId 
                        LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblposts.SubCategoryId 
                        WHERE tblposts.IS_Approved = 1 
                        ORDER BY tblposts.id DESC 
                        LIMIT $offset, $no_of_records_per_page");

                // Display posts
                while ($row = mysqli_fetch_array($query)) {
                ?>
                    <div class="card mb-4">
                        <img class="card-img-top" src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['posttitle']); ?>">
                        <div class="card-body">
                            <h2 class="card-title"><?php echo htmlentities($row['posttitle']); ?></h2>
                            <p>
                                <a class="badge bg-secondary text-decoration-none link-light" href="category.php?catid=<?php echo htmlentities($row['cid']); ?>" style="color:#fff">
                                    <?php echo htmlentities($row['category']); ?>
                                </a>
                                <a class="badge bg-secondary text-decoration-none link-light" style="color:#fff">
                                    <?php echo htmlentities($row['subcategory']); ?>
                                </a>
                            </p>
                            <a href="news-details.php?nid=<?php echo htmlentities($row['pid']); ?>" class="btn btn-primary">Read More &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                            Posted on <?php echo htmlentities($row['postingdate']); ?>
                        </div>
                    </div>
                <?php } ?>

                <!-- Pagination Links -->
                <ul class="pagination justify-content-center mb-4">
                    <li class="page-item <?php if ($pageno <= 1) { echo 'disabled'; } ?>">
                        <a href="?pageno=1" class="page-link">First</a>
                    </li>
                    <li class="page-item <?php if ($pageno <= 1) { echo 'disabled'; } ?>">
                        <a href="<?php if ($pageno <= 1) { echo '#'; } else { echo "?pageno=" . ($pageno - 1); } ?>" class="page-link">Prev</a>
                    </li>
                    <li class="page-item <?php if ($pageno >= $total_pages) { echo 'disabled'; } ?>">
                        <a href="<?php if ($pageno >= $total_pages) { echo '#'; } else { echo "?pageno=" . ($pageno + 1); } ?>" class="page-link">Next</a>
                    </li>
                    <li class="page-item <?php if ($pageno >= $total_pages) { echo 'disabled'; } ?>">
                        <a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a>
                    </li>
                </ul>

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
