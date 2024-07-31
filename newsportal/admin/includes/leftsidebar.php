<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!-- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <!-- Menu Title -->
                <li class="menu-title">Navigation</li>
                
                <!-- Dashboard Link -->
                <li class="has_sub">
                    <a href="dashboard.php" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <!-- Posts Section -->
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="mdi mdi-format-list-bulleted"></i>
                        <span> Posts </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="add-post.php">Add Posts</a></li>
                        <li><a href="manage-posts.php">Manage Posts</a></li>
                    </ul>
                </li>  
                
                <!-- Sub-admin Section: Visible only for admin users -->
                <?php if($_SESSION['utype'] == '1'): ?>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="mdi mdi-format-list-bulleted"></i>
                        <span> Editors </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="add-subadmins.php">Add Editor</a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- Category Section -->
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="mdi mdi-format-list-bulleted"></i>
                        <span> Category </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="add-category.php">Add Category</a></li>
                    </ul>
                </li>

                <!-- About us Section -->
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="mdi mdi-format-list-bulleted"></i>
                        <span> About us </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="../../about-us.php">About us</a></li>
                </ul>
                </li>   
            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
