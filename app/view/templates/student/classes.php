<?php
 controller_Main::render("includes/header", [], $pageTitle);
 controller_Main::render('includes/nav_portal/student_header', ['activeLink' => 'classes']);
?>

<h1>This is Classes View</h1>


<?php
 controller_Main::render("includes/nav_portal/all_footer");
 controller_Main::render("includes/footer");

?>
