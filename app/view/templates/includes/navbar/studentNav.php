<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=BASE_URL?>/home">
        <div class="sidebar-brand-icon">
            <img src="<?=BRAND_LOGO_PATH?>" alt="Brand Logo" width="50" height="50" class="d-inline-block align-top">
        </div>
        <div class="sidebar-brand-text mx-3">
            Student
        </div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= ($activeLink == 'dashboard') ? 'active' : '' ?>">
        <a class="nav-link " href="<?=BASE_URL?>/student/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Management
    </div>
    <li class="nav-item <?= ($activeLink == 'attendance') ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-cog"></i>
            <span>Attendance</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Timeline</h6>
                <a class="collapse-item <?= ($activeSubLink == 'live') ? 'active' : '' ?>" href="<?=BASE_URL?>/student/attendance/live">Live</a>
                <a class="collapse-item <?= ($activeSubLink == 'records') ? 'active' : '' ?>" href="<?=BASE_URL?>/student/attenance/records">Records</a>
            </div>
        </div>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Subjects</h6>
                <a class="collapse-item" href="">ADET</a>

        </div>
    </li>
    <!-- Nav Item - Profile -->
    <li class="nav-item <?= ($activeLink == 'profileSettings') ? 'active' : '' ?>">
        <a class="nav-link" href="<?=BASE_URL?>/student/profile">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile Settings</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>