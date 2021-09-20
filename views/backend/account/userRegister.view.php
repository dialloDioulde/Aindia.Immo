<?php
ob_start();
echo styleTitleLevel_2("Inscription", COLOR_TITLE_LEVEL_A_INTERIM);
?>

<div class="container mt-5">
    <div class="d-flex align-items-center justify-content-center">
        <div class=" col-12 col-md-6 shadow-lg">
            <div class="row mt-2 p-2 justify-content-center" id="registerError">
                <?php if ($ALERT_USER_REGISTER_USERNAME_ERROR != "") {?>
                    <div class="alert alert-danger" id="alert" role="alert">
                        <?= $ALERT_USER_REGISTER_USERNAME_ERROR; ?>
                    </div>
                <?php } ?>
                <?php if ($ALERT_USER_REGISTER_EMAIL_ERROR != "") {?>
                    <div class="alert alert-danger" id="alert" role="alert">
                        <?= $ALERT_USER_REGISTER_EMAIL_ERROR; ?>
                    </div>
                <?php } ?>

            </div>
            <form class="p-2 form" id="form"  action="" method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" id="username" name="username" onkeyup="inputUsernameValidation(this)" placeholder="pseudo">
                    <span class="error mb-1" id="usernameError"></span>
                </div>

                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" onkeyup="inputEmailValidation(this)" placeholder="email">
                    <span class="error mb-1" id="emailError"></span>
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" onkeyup="inputPasswordValidation(this)" placeholder="mot de passe">
                    <span class="error mb-1" id="passwordError"></span>
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" id="passwordConfirmation" name="passwordConfirmation" onkeyup="inputPasswordConfirmationValidation(this)" placeholder="confirmation du mot de passe">
                    <span class="error mb-1" id="passwordConfirmationError"></span>
                </div>
                <div class="mb-3">
                    <button type="submit" id="btnSubmit" class="btn btn-primary">S'inscrire</button>
                </div>
                <a href="<?= URL ?>userLogin" class="mt-2 text-decoration-none">Cliquer ici pour se connecter</a>
            </form>
        </div>
    </div>
</div>


<script src="<?= URL ?>public/js/registerFormValidation.js"></script>



<?php
$content = ob_get_clean();
require "views/commons/template.php";

?>
