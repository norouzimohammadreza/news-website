<?php
require_once(BASE_PATH . '/template/auth/layout/header.php');
?>
<form method="post" action="<?= url('new-password'.'/'.$user['forget_token']) ?>" class="login100-form validate-form">
    <span class="login100-form-title">
        Reset Password
    </span>

    <?php
    $error = flash('error_reset');
    if (!empty(flash('error_reset'))) {
    ?>
        <div class="mb-2 alert alert-danger">
            <small class="form-text text-danger"><?= $error; ?></small>
        </div>
    <?php } ?>


    <div class="wrap-input100 validate-input" data-validate="Password is required">
        <input class="input100" type="password" name="password" placeholder="Password">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
        </span>
    </div>
    <div class="wrap-input100 validate-input" data-validate="Password is required">
        <input class="input100" type="password" name="repassword" placeholder="Repassword">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
        </span>
    </div>

    <div class="container-login100-form-btn">
        <button type="submit" class="login100-form-btn">
            Send
        </button>
    </div>

    <div class="text-center p-t-12">
        <span class="txt1">
            Forgot
        </span>
        <a class="txt2" href="<?= url('forgot-password'); ?>">
            Username / Password?
        </a>
    </div>

    <div class="text-center p-t-136">
        <a class="txt2" href="<?= url('login'); ?>">
            Login your Account
            <?php
            require_once(BASE_PATH . '/template/auth/layout/footer.php');
            ?>