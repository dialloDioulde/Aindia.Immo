<?php
ob_start();
?>

<div class="container">
    <div class="">
        <div class="row mt-2 p-2 justify-content-center" id="registerError">
            <?php if ($ALERT_USER_LOGIN_ERROR != "") {?>
                <div class="alert alert-danger col-md-6" id="alert" role="alert">
                    <?= $ALERT_USER_LOGIN_ERROR; ?>
                </div>
            <?php } ?>
        </div>
        <div class="row justify-content-center p-2">
            <form class="p-2 mt-2 col-md-6 shadow" id="loginForm" action="" method="POST">
                <div class="mb-3 mt-2">
                    <input type="text" class="form-control" id="username" name="username" onkeyup="loginInputUsernameValidation(this)" placeholder="pseudo">
                    <span class="error mb-1" id="usernameError"></span>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" onkeyup="loginInputPasswordValidation(this)" placeholder="mot de passe">
                    <span class="error mb-1" id="passwordError"></span>
                </div>
                <div class="mb-3">
                    <button type="submit" id="btnSubmit" class="btn btn-primary mt-2">Se Connecter</button>
                </div>
                <div class="mb-1">
                    <p class="mt-1">Mot de passe oublier ?
                        <a href="<?= URL ?>userResetPasswordSendLink" class="text-decoration-none">cliquer ICI</a>
                    </p>
                </div>
                <div class="mb-1">
                    <p class="mt-1">Pour créer un compte
                        <a href="<?= URL ?>userRegister" class="text-decoration-none">cliquer ICI</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>




<script src="<?= URL ?>public/js/loginFormValidation.js"></script>



<?php
$content = ob_get_clean();
require "views/commons/template.php";
