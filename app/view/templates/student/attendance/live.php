<?php echo View_Render::render('includes/header', [], $pageTitle); ?>
<?php echo View_Render::render('includes/navbar/studentNav', ['activeLink' => 'attendance', 'activeSubLink' => 'live']); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <p>This is student live class content.</p>
</div>
<?php echo View_Render::render('includes/footer'); ?>   