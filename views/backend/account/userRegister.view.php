<?php
ob_start();
?>

<div class="container">
    <div class="">
        <div class="row mt-2 p-2 justify-content-center" id="registerError">
            <?php if ($ALERT_USER_REGISTER_USERNAME_EXIST_ERROR != "") { ?>
                <div class="alert alert-danger col-md-6" role="alert">
                    <?= $ALERT_USER_REGISTER_USERNAME_EXIST_ERROR; ?>
                </div>
            <?php } ?>
            <?php if ($ALERT_USER_REGISTER_EMAIL_EXIST_ERROR != "") { ?>
                <div class="alert alert-danger col-md-6" id="alert" role="alert">
                    <?= $ALERT_USER_REGISTER_EMAIL_EXIST_ERROR; ?>
                </div>
            <?php } ?>
            <?php if ($ALERT_USER_REGISTER_EMAIL_VALIDATION_MESSAGE_SENT != "") { ?>
                <div class="alert alert-success col-md-6" id="alert" role="alert">
                    <?= $ALERT_USER_REGISTER_EMAIL_VALIDATION_MESSAGE_SENT; ?>
                </div>
            <?php } ?>
        </div>

        <div class="row justify-content-center p-2">
            <form class="p-2 mt-2 form col-md-6 shadow" id="form" action="" method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" id="username" name="username"
                           onkeyup="inputUsernameValidation(this)" placeholder="pseudo">
                    <span class="error mb-1" id="usernameError"></span>
                </div>

                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" onkeyup="inputEmailValidation(this)"
                           placeholder="email">
                    <span class="error mb-1" id="emailError"></span>
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password"
                           onkeyup="inputPasswordValidation(this)" placeholder="mot de passe">
                    <span class="error mb-1" id="passwordError"></span>
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" id="passwordConfirmation" name="passwordConfirmation"
                           onkeyup="inputPasswordConfirmationValidation(this)" placeholder="confirmation du mot de passe">
                    <span class="error mb-1" id="passwordConfirmationError"></span>
                </div>
                <div class="mb-3">
                    <button type="submit" id="btnSubmit" class="btn btn-primary">S'inscrire</button>
                    <p class="mt-3"> Pour se connecter cliquer
                        <a href="<?= URL ?>userLogin" class="text-decoration-none">ICI</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
    <script src="<?= URL ?>public/js/registerFormValidation.js"></script>


<?php
$content = ob_get_clean();
require "views/commons/template.php";
