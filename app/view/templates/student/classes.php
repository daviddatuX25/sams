<?php
    controller_Main::render("includes/header", [], $pageTitle);
    controller_Main::render('includes/nav_portal/student/header', ['activeLink' => 'classes']);
?>

<h1>This is Classes View</h1>

<?php
    controller_Main::render("includes/nav_portal/student/footer");
?>