<?php
 controller_Main::render("includes/header", [], $pageTitle);
 controller_Main::render('includes/nav_portal/student_header', ['activeLink' => 'dashboard']);
?>

<h1>This is Dashboard View</h1>


<?php
 controller_Main::render("includes/nav_portal/all_footer");
?>
