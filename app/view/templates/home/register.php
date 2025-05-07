<?php
Controller_Main::render('includes/header', [], $pageTitle);  
Controller_Main::render('includes/homeNav', ["activeLink" => "register"]);

$emptyErrMsg = "<p class='text-danger'> Fill in blank field. </p>";
function errMsgOut($errMsg){
    if (is_array($errMsg)){
        $finalErrMsg = '';
        foreach ($errMsg as $err) {
            $finalErrMsg .= "<p class='text-danger'> $err </p>";
        }
        return $finalErrMsg;
    }
    return "<p class='text-danger'> $errMsg </p>";
}
?>

<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form method="POST" action="<?=BASE_URL?>/register">
                            <!-- Name Fields -->
                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="firstName" name="first_name" placeholder="First Name" required>
                                    <?=$errors['emptyData']['first_name'] ?? false ? $emptyErrMsg  : null ?>
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="middleName" name="middle_name" placeholder="Middle Name" required>
                                    <?=$errors['emptyData']['middle_name'] ?? false ? $emptyErrMsg  : null ?>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-user" id="lastName" name="last_name" placeholder="Last Name" required>
                                    <?=$errors['emptyData']['last_name'] ?? false ? $emptyErrMsg  : null ?>
                                </div>
                            </div>
                            <!-- User Key / ID number -->
                            <div class="form-group">
                                <input type="text" id="userKey" class="form-control form-control-user" name="user_key" id="userKey" placeholder="Username or Id number" required>
                                <?=$errors['emptyData']['user_key'] ?? false ? $emptyErrMsg  : null ?>
                                <?=$errors['userKeyErr']?? false ? errMsgOut($errors['userKeyErr'])  : null ?>
                            </div>
                            <!-- Gender and Role -->
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <select class="form-control " id="gender" name="gender" required>
                                        <option value="" disabled selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <?=$errors['emptyData']['gender'] ?? false ? $emptyErrMsg  : null ?>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="" disabled selected>Select Role</option>
                                        <option value="student">Student</option>
                                        <option value="teacher">Teacher</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    <?=$errors['emptyData']['role'] ?? false ? $emptyErrMsg  : null ?>
                                </div>
                            </div>
                            <!-- Birthday -->
                            <div class="form-group">
                                <input type="date" class="form-control form-control-user" id="birthday" name="birthday" placeholder="Birthday">
                            </div>
                            <!-- Bio -->
                            <div class="form-group">
                                <textarea class="form-control" id="bio" name="bio" placeholder="Bio (Optional)" rows="4"></textarea>
                            </div>
                            <!-- Password Fields -->
                            <div class="form-group row" id="passField">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" autocomplete="new-password" required>
                                    <p id="passErr" class="text-danger" style="display: none;"></p>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="repeatPassword" name="repeat_password" placeholder="Repeat Password" required>
                                    <?=$errors['emptyData']['password'] ?? false ? $emptyErrMsg  : null ?>
                                    <?=$errors['passErr']?? false ? errMsgOut($errors['passErr'])  : null ?>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                            <hr>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="#">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?=BASE_URL?>/login">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    $('#userKey, #password, #repeatPassword').on('blur', function () {
        $.ajax({
            url: 'register',
            method: 'POST',
            dataType: 'json',
            data: {
                user_key: $('#userKey').val(),
                password: $('#password').val(),
                repeat_password: $('#repeatPassword').val()
            },
            success: function (response) {
                // Remove previous AJAX-generated error messages
                $('.ajax-error').remove();

                // Handle userKey errors
                if ($('#userKey').val().trim() !== '') {
                    if (response.userKeyErr) {
                        $('<p class="ajax-error text-danger small">' + response.userKeyErr + '</p>').insertAfter('#userKey');
                    }
                }

                // Handle password errors
                if ($('#password').val().trim() !== '' || $('#repeatPassword').val().trim() !== '') {
                    if (response.passErr) {
                        let messages = '';
                        $.each(response.passErr, function (key, msg) {
                            messages += '<p class="p-0 mt-2 mb-0 text-danger small">' + msg + '</p>';
                        });
                        $('<div class="col-sm-12 mb-2 ajax-error text-danger small">' + messages + '</div>').insertAfter('#passField');
                    }
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    });
});
</script>

<?php
Controller_Main::render('includes/footer');
?>