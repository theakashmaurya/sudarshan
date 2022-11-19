<!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="dashboard.php" target="_blank"><img src="assets/images/logo-light.png" height="40px"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#Pages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Pages</span>
          </a>
          <ul class="sidenav-second-level collapse" id="Pages">

            <li>
              <a href="page_add.php">Add New</a>
            </li>

            <li>
              <a href="pages.php">All Pages</a>
            </li>

          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Posts">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#Posts" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-pencil"></i>
            <span class="nav-link-text">Posts</span>
          </a>
          <ul class="sidenav-second-level collapse" id="Posts">

            <li>
              <a href="post_add.php">Add New</a>
            </li>

            <li>
              <a href="posts.php">All Posts</a>
            </li>

          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Customize">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#Customize" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-paint-brush"></i>
            <span class="nav-link-text">Customize</span>
          </a>
          <ul class="sidenav-second-level collapse" id="Customize">

            <li>
              <a href="general_settings.php">General Settings</a>
            </li>

            <li>
              <a href="nav_settings.php">Navigation Settings</a>
            </li>

          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Widgets">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#Widgets" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-gift"></i>
            <span class="nav-link-text">Widgets</span>
          </a>
          <ul class="sidenav-second-level collapse" id="Widgets">

            <li>
              <a href="widgets.php">Manage</a>
            </li>

          </ul>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <a href="../index.php" target="_blank" class="nav-link">
            <i class="fa fa-fw fa-globe"></i>View Website</a>
        </li>
        <li class="nav-item">
          <a href="settings.php" class="nav-link">
            <i class="fa fa-fw fa-gear"></i>Settings</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">[
            <i class="fa fa-fw fa-user"></i><?= $_SESSION['fullname']; ?> ]</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
