<?php
ob_start();
echo styleTitleLevel_1("Détails De l'Offre N° " . $offer['id_offer'] . "", COLOR_TITLE_LEVEL_A_INTERIM);
?>

<!-- Début : Affichage Des Détails De l'Offre -->
<div class="mt-1 bg-white text-dark p-2" id="offerDetails">
    <div class="container">
        <div class="row p-2 border-right border-top border-left border-bottom mb-1">
            <div class="col-md-6">
                <div id="images">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php foreach ($images as $key => $image) : ?>
                                <li data-target="#carouselExampleIndicators" data-slide-to="<?= $key ?>"
                                    class="<?php echo ($key === 0) ? "active" : "" ?> bg-dark"></li>
                            <?php endforeach; ?>
                        </ol>
                        <div class="carousel-inner text-center">
                            <?php foreach ($images as $key => $image) : ?>
                                <div class="carousel-item <?php echo ($key === 0) ? "active" : "" ?>">
                                    <img class="" src="<?= URL ?><?= $image['url_image'] ?>"
                                         style="width: 550px; height: 450px;" data-src="<?= $image["name_image"] ?>"
                                         alt="<?= $image["name_image"] ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h3 class="text-center">Informations</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" id="">Type de Logement : <?php echo $categoryOffer['name_category'] ?></li>
                    <li class="list-group-item" id="">Profil Recherché : <?php echo $publicOffer['name_public'] ?></li>
                    <li class="list-group-item" id="">Disponibilité : <?php echo $offer['availablity_offer'] ?></li>
                    <li class="list-group-item" id="">Loyé Mensuel : <?php echo $offer['price_offer'] ?></li>
                    <li class="list-group-item" id="">Nombre de Pièces : <?php echo $offer['pieces_offer'] ?></li>
                    <li class="list-group-item" id="">Disponibilité : <?php echo $offer['availablity_offer'] ?></li>
                    <li class="list-group-item" id="">Surface (m2) : <?php echo $offer['area_offer'] ?></li>
                    <li class="list-group-item" id="">Durée du Contrat : <?php echo $offer['contract_offer'] ?></li>
                </ul>
            </div>
            <div class="col-md-6 mt-3">
                <h3 class="text-center">Localisation</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" id="">Pays : <?php echo $offer['country_offer'] ?></li>
                    <li class="list-group-item" id="">Ville : <?php echo $offer['city_offer'] ?></li>
                    <li class="list-group-item" id="">Quartier : <?php echo $offer['location_offer'] ?></li>
                </ul>
            </div>
            <div class="col-md-6 mt-3">
                <h3 class="text-center">Contact</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" id="">Nom : <?php echo $offer_owner['name_user'] ?></li>
                    <li class="list-group-item" id="">Email : <?php echo $offer_owner['email_user'] ?></li>
                    <li class="list-group-item" id="">Tel : 06 26 58 57 13</li>
                </ul>
            </div>
            <div class="col-md-6 mt-3">
                <h3 class="text-center">Description</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" id=""><?php echo $offer['description_offer'] ?></li>
                </ul>
            </div>
            <div class="col-md-6 mt-3">
                <h3 class="text-center">Pièces</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" id=""><?php echo $offer['offer_peculiarity'] ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Fin : Affichage Des Détails De l'Offre -->


<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>

