<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=BASE_URL?>/home">
        <div class="sidebar-brand-icon">
            <img src="<?=BRAND_LOGO_PATH?>" alt="Brand Logo" width="50" height="50" class="d-inline-block align-top">
        </div>
        <div class="sidebar-brand-text mx-3">
            Student Portal
        </div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= ($activeLink == 'dashboard') ? 'active' : '' ?>">
        <a class="nav-link " href="<?=BASE_URL?>/student/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Attendance
    </div>
    <li class="nav-item <?= ($activeLink == 'todayClasses') ? 'active' : '' ?>">
        <a class="nav-link " href="<?=BASE_URL?>/student/attendance/classes_today">
            <i class="fas fa-fw fa-door-open"></i>
            <span>Today Classes</span>
        </a>
    </li>
    <li class="nav-item <?= ($activeLink == 'timeline') ? 'active' : '' ?>">
        <a class="nav-link " href="<?=BASE_URL?>/student/attendance/timeline">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Timeline</span>
        </a>
    </li>
    <li class="nav-item <?= ($activeLink == 'leaveForm') ? 'active' : '' ?>">
        <a class="nav-link " href="<?=BASE_URL?>/student/leaveform">
            <i class="fas fa-fw fa-envelope-open-text"></i>
            <span>Leave form</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item <?= ($activeLink == 'profileSettings') ? 'active' : '' ?>">
        <a class="nav-link " href="<?=BASE_URL?>/student/profile_settings">
            <i class="fas fa-user-circle"></i>
            <span>Profile Settings</span>
        </a>
    </li>

    <li class="nav-item <?= ($activeLink == 'subjects') ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="<?=BASE_URL?>/student/subjects" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-book"></i>
            <span>Subjects</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">A.Y 2025-2026</h6>
                <a class="collapse-item <?= ($activeLink == 'subjects_1') ? 'active' : '' ?>" href="<?=BASE_URL?>/student/subjects/1">ADET</a>
                <a class="collapse-item <?= ($activeLink == 'subjects_2') ? 'active' : '' ?>" href="<?=BASE_URL?>/student/subjects/2">Hybrid</a>

        </div>
    </li>
    <!-- Nav Item - Profile -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>