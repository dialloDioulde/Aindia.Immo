<?php
ob_start();
?>

<div class="container">
    <div class="mt-3">
        <div class="row justify-content-center p-2">
            <h3 class="col-md-6">Réinitialiser mon mot de passe</h3>
        </div>

        <div class="row mt-2 p-2 justify-content-center" id="resetPasswordError">
            <?php if ($ALERT_USER_RESET_PASSWORD_LINK_SENT != "") {?>
                <div class="alert alert-success col-md-8" role="alert">
                    <?= $ALERT_USER_RESET_PASSWORD_LINK_SENT; ?>
                </div>
            <?php } ?>
            <?php if ($ALERT_USER_EMAIL_NOT_EXIST_ERROR != "") {?>
                <div class="alert alert-danger col-md-6" role="alert">
                    <?= $ALERT_USER_EMAIL_NOT_EXIST_ERROR; ?>
                </div>
            <?php } ?>
        </div>

        <div class="row justify-content-center p-2">
            <form class="p-2 mt-2 col-md-6 shadow" id="resetPasswordForm" action="" method="POST">
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="email">
                    <span class="error mb-1" id="emailError"></span>
                </div>
                <div class="mb-3 d-flex">
                    <button type="submit" id="btnSubmit" class="btn btn-primary mt-2">VALIDER</button>
                    <a href="<?= URL ?>userLogin" class="btn btn-primary ml-2 mt-2 text-decoration-none">RETOUR</a>
                </div>
            </form>
        </div>
    </div>
</div>



<?php
$content = ob_get_clean();
require "views/commons/template.php";

?>
