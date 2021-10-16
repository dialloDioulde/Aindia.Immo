<?php
ob_start();
?>


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
<?php if ($ALERT_USER_REGISTER_EMAIL_VALIDATION_MESSAGE_SENT != "") {?>
    <div class="alert alert-success" role="alert">
        <?= $ALERT_USER_REGISTER_EMAIL_VALIDATION_MESSAGE_SENT; ?>
    </div>
<?php } ?>

<form class="p-2 mt-2 form" id="form"  action="" method="POST">
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
        <button type="submit" id="btnSubmit" class="btn btn-block btn-primary">S'inscrire</button>
    </div>
</form>

<p class="p-2"> Pour se connecter cliquer
    <a href="<?= URL ?>registerOrView&actionType=loginView" class="text-decoration-none">ICI</a>
</p>

<script src="<?= URL ?>public/js/registerFormValidation.js"></script>



<?php
$contentView = ob_get_clean();
?>
