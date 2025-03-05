<ul class="nav justify-content-center">
    <a class="nav-brand ">
        Student Attendance Monitoring System
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