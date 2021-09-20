<?php
ob_start();
?>








<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>
