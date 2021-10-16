<?php
ob_start();
echo styleTitleLevel_2("Validation Du Compte Utilisateur", COLOR_TITLE_LEVEL_A_INTERIM);
?>


<div class="row mt-2 p-2 justify-content-center" id="registerError">
    <?php if ($ALERT_USER_REGISTER_EMAIL_VALIDATION_MESSAGE != "") {?>
        <div class="alert alert-success" role="alert">
            <?= $ALERT_USER_REGISTER_EMAIL_VALIDATION_MESSAGE; ?>
        </div>
    <?php } ?>
</div>

<div class="row mt-2 p-2 justify-content-center" id="registerError">
    <?php if ($ALERT_USER_REGISTER_EMAIL_VALIDATION_ERROR != "") {?>
        <div class="alert alert-danger" role="alert">
            <?= $ALERT_USER_REGISTER_EMAIL_VALIDATION_ERROR; ?>
        </div>
    <?php } ?>
</div>

<div class="row mt-2 p-2 justify-content-center" id="registerError">
    <?php if ($ALERT_USER_REGISTER_EMAIL_VALIDATION_LINK_ERROR != "") {?>
        <div class="alert alert-danger" role="alert">
            <?= $ALERT_USER_REGISTER_EMAIL_VALIDATION_LINK_ERROR; ?>
        </div>
    <?php } ?>
</div>




<?php
$content = ob_get_clean();
require "views/commons/template.php";

?>
