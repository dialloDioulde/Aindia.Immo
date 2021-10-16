<?php
ob_start();
//echo styleTitleLevel_2("Mon Tableau De Bord", COLOR_TITLE_LEVEL_A_INTERIM);
// echo ($_SESSION['name_user']. " ". $_SESSION['email_user']. " ". "773908675". " ". "Sénégal". " ". "Dakar")
?>

<div class="mt-3 mb-1" id="">
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-2 mt-5">
                <ul class="list-unstyled">
                    <li><a href="userProfil&actionType=pending" class="btn btn-primary mb-2 text-white">En Attentes</a></li>
                    <li><a href="userProfil&actionType=approved" class="btn btn-primary  mb-2 text-white">Approuvées</a></li>
                    <li><a href="userProfil&actionType=moderated" class="btn btn-primary mb-2 text-white">Modérées</a></li>
                    <li><a href="userProfil&actionType=hided" class="btn btn-primary mb-2 text-white">Retirer</a></li>
                    <li><a href="userProfil&actionType=blocked" class="btn btn-primary  mb-2 text-white">Bloquées</a></li>
                </ul>
            </div>
            <div class="col-md-10">
                <?= $contentView ?>
            </div>
        </div>
    </div>
</div>




<?php
$content = ob_get_clean();
require "views/commons/template.php";

?>
