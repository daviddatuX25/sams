<?php
Controller_Main::render('includes/header', [], 'Pending Registration');
Controller_Main::render('includes/homeNav');
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Pending Registration</h1>
                            <p class="text-danger">Hi, <?=$fname?>. <?=$message?></p>
                            <a href="<?=BASE_URL?>/login" class="btn btn-light btn-icon-split">
                                <span class="icon text-gray-600">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                                <span class="text">Proceed to login</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
Controller_Main::render('includes/footer');
?>