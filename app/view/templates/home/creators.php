<?php
Controller_Main::render('includes/header');
Controller_Main::render('includes/homeNav', ["activeLink" => "creators"]);
?>
<h1>The creators</h1>
<p>Details about the creators...</p>
<?php
Controller_Main::render('includes/footer');
?>