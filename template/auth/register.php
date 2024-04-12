<?php
require_once(BASE_PATH . '/template/auth/layout/header.php');
?>

<form method="post" action="<?= url('register/store') ?>" class="login100-form validate-form">
    <span class="login100-form-title">
        Register
    </span>
    <?php
    $error = flash('error_register');
    if(!empty(flash('error_register'))){
    ?>
    <div class="mb-2 alert alert-danger">
        <small class="form-text text-danger"><?= $error; ?></small>
    </div>
<?php } ?>


    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
        <input class="input100" type="text" name="username" placeholder="Username">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-user" aria-hidden="true"></i>
        </span>
    </div>

    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
        <input class="input100" type="text" name="email" placeholder="Email">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-envelope" aria-hidden="true"></i>
        </span>
    </div>

    <div class="wrap-input100 validate-input" data-validate="Password is required">
        <input class="input100" type="password" name="password" placeholder="Password">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
        </span>
    </div>

    <div class="container-login100-form-btn">
        <button type="submit" class="login100-form-btn">
            Register
        </button>
    </div>

    <div class="text-center p-t-12">
        <span class="txt1">
            Forgot
        </span>
        <a class="txt2" href="#">
            Username / Password?
        </a>
    </div>

    <div class="text-center p-t-136">
        <a class="txt2" href="#">
            Login your Account
            <?php
            require_once(BASE_PATH . '/template/auth/layout/footer.php');
            ?>