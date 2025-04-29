<?php
Controller_Main::render('includes/header');
Controller_Main::render('includes/homeNav', ["activeLink" => "login"]);
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-flex bg-login-image justify-content-center align-items-center">
                            <img
                                src="<?=BASE_URL_PUBLIC?>/img/brand_logo/black_on_trans.png"
                                alt="SAM"
                                class="img-fluid"
                                style="max-height: 100%; max-width: 100%;"
                            >
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login Portal</h1>
                                </div>
                                <form class="user" method="POST" action="<?=BASE_URL?>/login">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="user_key"
                                            placeholder="Enter user key or ID-Number ex (E20-00123)" value="<?=$lastUserKey ?? null?>" autocomplete="off">
                                        <?= $userErrMsg ?? false  ? "<div class='text-danger'>$userErrMsg</p>" : null;?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                        <?= $passErrMsg ?? false ? "<p class='pl-2 text-danger'>$passErrMsg</p>" : null;?>
                                    </div>
                                    <p class="text-danger"><?=$errorMsg ?? NULL?></p>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                    <hr>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?=BASE_URL?>/register">Create an Account!</a>
                                </div>
                            </div>
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