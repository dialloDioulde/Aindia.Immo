<?php
ob_start();
?>

<div class="mb-1 border-top border-bottom" id="dashboard">
    <div class="container-fluid dashboard_HeightSizeMin">
        <div class="row">
            <div class="col-md-2 bg-dark p-2" id="dashboard-left">
                <ul>
                    <li><a href="dashboard&actionType=editProfil" class="mt-2 text-decoration-none">Éditer Mon Profil</a></li>
                    <li><a href="dashboard&actionType=ManageUsers" class="mt-2 text-decoration-none">Utilisateurs</a></li>
                    <li><a href="dashboard&actionType=ManageOffers" class="mt-2 text-decoration-none">Offres</a></li>
                    <li><a href="<?= URL ?>dashboard&actionType=deleteAccount" class="mt-2 text-decoration-none">Fermer Mon Compte</a></li>
                    <li><a href="<?= URL ?>dashboard&actionType=logout" class="mt-2 text-decoration-none">Déconnexion</a></li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12 p-2">
                        <?= $contentDashboard ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require "views/commons/template.php";

?>
