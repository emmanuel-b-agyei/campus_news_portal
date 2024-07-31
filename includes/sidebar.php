<div class="col-md-4">
    <!-- Categories Widget -->
    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">
                        <?php 
                        // Fetch categories from the database
                        $query = mysqli_query($con, "SELECT id, CategoryName FROM tblcategory");
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <li>
                                <a href="category.php?catid=<?php echo htmlentities($row['id']) ?>"><?php echo htmlentities($row['CategoryName']); ?></a>
                            </li>
                        <?php 
                        } 
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Side Widget -->
    <div class="card my-4">
        <h5 class="card-header">Recent News</h5>
        <div class="card-body">
            <ul class="mb-0">
                <?php
                // Fetch recent news posts from the database
                $query = mysqli_query($con, "SELECT tblposts.id AS pid, tblposts.PostTitle AS posttitle FROM tblposts LEFT JOIN tblcategory ON tblcategory.id = tblposts.CategoryId  LIMIT 8");
                while ($row = mysqli_fetch_array($query)) {
                ?>
                    <li>
                        <a href="news-details.php?nid=<?php echo htmlentities($row['pid']) ?>"><?php echo htmlentities($row['posttitle']); ?></a>
                    </li>
                <?php 
                } 
                ?>
            </ul>
        </div>
    </div>
</div>
