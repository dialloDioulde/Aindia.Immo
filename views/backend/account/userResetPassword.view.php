<?php
ob_start();
?>

<div class="container">
    <div class="">
        <div class="row justify-content-center p-2">
            <h3 class="col-md-6">Réinitialisation de mot de passe</h3>
        </div>

        <div class="row mt-2 p-2 justify-content-center" id="resetPasswordError">
            <?php if ($ALERT_USER_RESET_PASSWORD_IS_OK != "") {?>
                <div class="alert alert-success col-md-6" role="alert">
                    <?= $ALERT_USER_RESET_PASSWORD_IS_OK; ?>
                </div>
            <?php } ?>

            <?php if ($ALERT_USER_EMAIL_NOT_EXIST_ERROR != "") {?>
                <div class="alert alert-danger col-md-6" role="alert">
                    <?= $ALERT_USER_EMAIL_NOT_EXIST_ERROR; ?>
                </div>
            <?php } ?>
        </div>

        <?php if ($ALERT_USER_EMAIL_NOT_EXIST_ERROR == "") { ?>
            <div class="row justify-content-center p-2">
            <form class="p-2 mt-2 col-md-6 shadow" id="" action="" method="POST">
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nouveau mot de passe">
                    <span class="error mb-1" id="passwordError"></span>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="passwordConfirmation" name="passwordConfirmation" placeholder="Confirmation du mot de passe">
                    <span class="error mb-1" id="passwordError"></span>
                </div>
                <div class="mb-3 d-flex">
                    <button type="submit" id="btnSubmit" class="btn btn-primary mt-2">VALIDER</button>
                    <a href="<?= URL ?>userLogin" class="btn btn-primary ml-2 mt-2 text-decoration-none">RETOUR</a>
                </div>
            </form>
        </div>
        <?php } ?>

    </div>
</div>



<?php
$content = ob_get_clean();
require "views/commons/template.php";

?>
