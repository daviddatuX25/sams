<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="<?=BRAND_LOGO_PATH?>" alt="Brand Logo"
           width="150" height="50"
           class="d-inline-block align-top">
    </a>
    <button class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#homeNav"
            aria-controls="homeNav"
            aria-expanded="false"
            aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="homeNav">
      <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= $activeLink=='index'?'active':'' ?>"
             href="<?=BASE_URL?>/home/index">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $activeLink=='project'?'active':'' ?>"
             href="<?=BASE_URL?>/home/project">The Project</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $activeLink=='creators'?'active':'' ?>"
             href="<?=BASE_URL?>/home/creators">Creators</a>
        </li>
      </ul>

      <ul class="navbar-nav my-1 ml-auto">
        <li class="nav-item">
          <a class="btn btn-outline-light m-1 <?= $activeLink=='login'?'bg-light text-dark':'' ?>"
             href="<?=BASE_URL?>/login">Login</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light m-1 <?= $activeLink=='register'?'bg-light text-dark':'' ?>"
             href="<?=BASE_URL?>/register">Register</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- at bottom of <body>, in this exact order: -->