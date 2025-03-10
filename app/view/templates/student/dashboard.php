<?php echo View_Render::render('includes/header',[],$pageTitle); ?>
<?php echo View_Render::render('includes/navbar/includes/sidebarNav_header'); ?>

<?php echo View_Render::render('includes/navbar/studentNav',["activeLink" => "dashboard"]); ?>
<div class="container-fluid">
    <p>This is student dashboard content.</p>
</div>

<?php echo View_Render::render('includes/navbar/includes/sidebarNav_footer'); ?>
<?php echo View_Render::render('includes/footer'); ?>
