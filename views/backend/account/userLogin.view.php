<?php
ob_start();
?>

<?php if ($ALERT_USER_LOGIN_ERROR != "") {?>
    <div class="alert alert-danger" id="alert" role="alert">
        <?= $ALERT_USER_LOGIN_ERROR; ?>
    </div>
<?php } ?>

<form class="p-2 mt-2" id="loginForm" action="" method="POST">
    <div class="mb-3 mt-2">
        <input type="text" class="form-control" id="username" name="username" onkeyup="loginInputUsernameValidation(this)" placeholder="pseudo">
        <span class="error mb-1" id="usernameError"></span>
    </div>
    <div class="mb-3">
        <input type="password" class="form-control" id="password" name="password" onkeyup="loginInputPasswordValidation(this)" placeholder="mot de passe">
        <span class="error mb-1" id="passwordError"></span>
    </div>
    <div class="mb-3">
        <button type="submit" id="btnSubmit" class="btn btn-block btn-primary mt-2">Se Connecter</button>
    </div>
</form>

<p class="p-2">Mot de passe oublier ?
    <a href="<?= URL ?>registerOrView&actionType=registerView" class="text-decoration-none">cliquer ICI</a>
</p>

<p class="p-2">Pour s'inscrire cliquer
    <a href="<?= URL ?>registerOrView&actionType=registerView" class="text-decoration-none">ICI</a>
</p>


<script src="<?= URL ?>public/js/loginFormValidation.js"></script>



<?php
$contentView = ob_get_clean();
?>
