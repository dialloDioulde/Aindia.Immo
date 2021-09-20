<?php
ob_start();
echo styleTitleLevel_2("Le Numérique Au Service Du Quotidien !", COLOR_TITLE_LEVEL_A_INTERIM);
?>



<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>
