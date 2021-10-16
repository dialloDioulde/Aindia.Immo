<?php
ob_start();
?>

<div class="container mt-5">
    <div class="d-flex align-items-center justify-content-center">
        <div class="col-md-5 shadow-lg ">
            <?= $contentView ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require "views/commons/template.php";

?>
