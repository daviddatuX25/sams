<nav class="ps-5 pe-5 navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        Student Attendance Monitoring System
    </a>

    <!-- Corrected Navbar Toggler -->
    <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#collapsibleNavId"
        aria-controls="collapsibleNavId"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link <?=$index_isActive ?? '' ?>" href="<?=BASE_URL?>home/index">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$guides_isActive ?? '' ?>" href="<?=BASE_URL?>home/guides">Guides</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?=$about_isActive ?? '' ?>" href="<?=BASE_URL?>home/about">About</a>
            </li>
        </ul>
    </div>
</nav>