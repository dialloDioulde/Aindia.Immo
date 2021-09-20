<?php
ob_start();
echo styleTitleLevel_2("Validation Du Compte Utilisateur", COLOR_TITLE_LEVEL_A_INTERIM);
?>



<div class="row mt-2 p-2 text-white bg-dark justify-content-center" id="createOfferError">

</div>




<?php
$content = ob_get_clean();
require "views/commons/template.php";

?>
