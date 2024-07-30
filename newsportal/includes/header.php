 <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php" style="font-weight: bold;
                                                        font-size: 30px;"
        >CAMPUS NEWS PORTAL</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <button class="btn btn-secondary" style="margin: 5px;">
                <a class="nav-link" href="index.php">News</a>
              </button>
            </li>

             <li class="nav-item">
              <button class="btn btn-secondary" style="margin: 5px;">
                <a class="nav-link" href="add-new-post.php"> Add</a>
              </button>
             </i>
              
            </li>

            <li class="nav-item">
              <button class="btn btn-secondary" style="margin: 5px;">
                <a class="nav-link" href="about-us.php">About</a>
              </button>
            </li>
            <li>
              <form name="search" action="search.php" method="post">
                <div class="input-group" style="margin-top: 12px; margin-right: 0px">
                  <input type="text" name="searchtitle" class="form-control" placeholder="Search for..." required>
                  <span class="input-group-btn">
                    <button class="btn btn-secondary" type="submit">Go!</button>
                  </span>
                </div>
              </form>            
            </li>
          </ul>
        </div>
      </div>
    </nav>