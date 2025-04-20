<?php
Controller_Main::render('includes/header');
Controller_Main::render('includes/homeNav', ["activeLink" => "project"]);
?>

<h1>About the Project</h1>
<p>Details about the project...</p>

<?php
Controller_Main::render('includes/footer');
?>