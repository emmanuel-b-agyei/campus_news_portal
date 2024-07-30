<?php 
session_start();
error_reporting(0);
include('includes/connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="News Portal Search Page">
    <meta name="author" content="">

    <title>News Portal | Search Page</title>

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
                // Retrieve the search title from the form or session
                if ($_POST['searchtitle'] != '') {
                    $st = $_SESSION['searchtitle'] = $_POST['searchtitle'];
                } else {
                    $st = $_SESSION['searchtitle'];
                }

                // Pagination logic
                $pageno = isset($_GET['pageno']) ? (int)$_GET['pageno'] : 1;
                $no_of_records_per_page = 8;
                $offset = ($pageno - 1) * $no_of_records_per_page;

                // Total pages calculation
                $total_pages_sql = "SELECT COUNT(*) FROM tblposts WHERE PostTitle LIKE '%$st%' AND Is_Active = 1";
                $result = mysqli_query($con, $total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);

                // Fetching posts based on search title
                $query = mysqli_query($con, "SELECT tblposts.id AS pid, tblposts.PostTitle AS posttitle, tblcategory.CategoryName AS category, tblsubcategory.Subcategory AS subcategory, tblposts.PostDetails AS postdetails, tblposts.PostingDate AS postingdate, tblposts.PostUrl AS url, tblposts.PostImage FROM tblposts LEFT JOIN tblcategory ON tblcategory.id = tblposts.CategoryId LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblposts.SubCategoryId WHERE tblposts.PostTitle LIKE '%$st%' AND tblposts.Is_Active = 1 LIMIT $offset, $no_of_records_per_page");

                $rowcount = mysqli_num_rows($query);
                if ($rowcount == 0) {
                    echo "<p>No record found</p>";
                } else {
                    while ($row = mysqli_fetch_array($query)) {
                ?>

                <!-- Blog Post -->
                <div class="card mb-4">
                    <img class="card-img-top" src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['posttitle']); ?>">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo htmlentities($row['posttitle']); ?></h2>
                        <a href="news-details.php?nid=<?php echo htmlentities($row['pid']); ?>" class="btn btn-primary">Read More &rarr;</a>
                    </div>
                    <div class="card-footer text-muted">
                        Posted on <?php echo htmlentities($row['postingdate']); ?>
                    </div>
                </div>
                <?php 
                    }
                ?>

                <!-- Pagination -->
                <ul class="pagination justify-content-center mb-4">
                    <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li>
                    <li class="page-item <?php if ($pageno <= 1) { echo 'disabled'; } ?>">
                        <a href="<?php if ($pageno > 1) { echo "?pageno=".($pageno - 1); } else { echo '#'; } ?>" class="page-link">Prev</a>
                    </li>
                    <li class="page-item <?php if ($pageno >= $total_pages) { echo 'disabled'; } ?>">
                        <a href="<?php if ($pageno < $total_pages) { echo "?pageno=".($pageno + 1); } else { echo '#'; } ?>" class="page-link">Next</a>
                    </li>
                    <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
                </ul>
                <?php } ?>
            </div>

            <!-- Sidebar Widgets Column -->
            <?php include('includes/sidebar.php'); ?>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
