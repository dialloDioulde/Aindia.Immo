<?php
ob_start();
echo styleTitleLevel_2("Connexion", COLOR_TITLE_LEVEL_A_INTERIM);
?>

<div class="container mt-5">
    <div class="d-flex align-items-center justify-content-center">
        <div class=" col-12 col-md-6 shadow-lg bg-white">
            <div class="row mt-2 p-2 justify-content-center" id="loginError">
                <?php if ($ALERT_USER_LOGIN_ERROR != "") {?>
                    <div class="alert alert-danger" id="alert" role="alert">
                        <?= $ALERT_USER_LOGIN_ERROR; ?>
                    </div>
                <?php } ?>
            </div>

            <form class="p-2" id="loginForm" action="" method="POST">
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
                <a href="<?= URL ?>userRegister" class="mt-2 text-decoration-none">Cliquer ici pour s'inscrire</a>
            </form>
        </div>
    </div>
</div>


<script src="<?= URL ?>public/js/loginFormValidation.js"></script>


<?php
$content = ob_get_clean();
require "views/commons/template.php";

?>
