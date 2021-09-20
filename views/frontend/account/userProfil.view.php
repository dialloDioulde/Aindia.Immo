<?php
ob_start();
echo styleTitleLevel_2("Mon Tableau De Bord", COLOR_TITLE_LEVEL_A_INTERIM);
?>

<div class="mb-1" id="dashboard">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 bg-dark">
                <?php
                echo  $_SESSION['id'] . "<br/>";
                echo  $_SESSION['name_user'] . "<br/>";
                echo  $_SESSION['email_user'] . "<br/>";
                ?>
                <ul>
                    <li><a href="<?= URL ?>userLogin" class="mt-2 text-decoration-none">Éditer Mon Profil</a></li>
                    <li><a href="<?= URL ?>userLogin" class="mt-2 text-decoration-none">Mes Offres</a></li>
                    <li><a href="<?= URL ?>userLogin" class="mt-2 text-decoration-none">Supprimer Mon Compte</a></li>
                    <li><a href="<?= URL ?>userLogin" class="mt-2 text-decoration-none">Déconnexion</a></li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12 bg-info p-2">
                        <h3>Mes Offres</h3>
                        <?php
                        echo "ID : ". $_SESSION['id'] . "<br/>";
                        echo "NOM : ". $_SESSION['name_user'] . "<br/>";
                        echo "EMAIL : ". $_SESSION['email_user'] . "<br/>";
                        echo "ID : ". $_SESSION['id'] . "<br/>";
                        echo "NOM : ". $_SESSION['name_user'] . "<br/>";
                        echo "EMAIL : ". $_SESSION['email_user'] . "<br/>";
                        echo "ID : ". $_SESSION['id'] . "<br/>";
                        echo "NOM : ". $_SESSION['name_user'] . "<br/>";
                        echo "EMAIL : ". $_SESSION['email_user'] . "<br/>";
                        echo "ID : ". $_SESSION['id'] . "<br/>";
                        echo "NOM : ". $_SESSION['name_user'] . "<br/>";
                        echo "EMAIL : ". $_SESSION['email_user'] . "<br/>";
                        echo "ID : ". $_SESSION['id'] . "<br/>";
                        echo "NOM : ". $_SESSION['name_user'] . "<br/>";
                        echo "EMAIL : ". $_SESSION['email_user'] . "<br/>";
                        echo "ID : ". $_SESSION['id'] . "<br/>";
                        echo "NOM : ". $_SESSION['name_user'] . "<br/>";
                        echo "EMAIL : ". $_SESSION['email_user'] . "<br/>";
                        ?>
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
