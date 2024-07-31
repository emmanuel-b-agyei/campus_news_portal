<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php" style="font-weight: bold; font-size: 30px;">CAMPUS NEWS PORTAL</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link btn btn-secondary mx-2" href="index.php">News</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-secondary mx-2" href="add-new-post.php">Add</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-secondary mx-2" href="about-us.php">About</a>
        </li>
        <li class="nav-item">
          <form name="search" action="search.php" method="post" class="form-inline my-2 my-lg-0">
            <div class="input-group">
              <input type="text" name="searchtitle" class="form-control" placeholder="Search for..." required>
              <div class="input-group-append">
                <button class="btn btn-secondary" type="submit">Go!</button>
              </div>
            </div>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>
