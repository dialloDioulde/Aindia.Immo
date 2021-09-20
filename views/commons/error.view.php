<?php
ob_start();
?>

<?php echo styleTitleLevel_1("Erreur", COLOR_TITLE_LEVEL_A_INTERIM); ?>

<div class="alert alert-danger" role="alert">
    <?= $errorMessage ?>
</div>

<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>
