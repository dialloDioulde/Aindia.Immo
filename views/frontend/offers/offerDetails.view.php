<?php
ob_start();
echo styleTitleLevel_1("Détails De l'Offre N° " . $offer['id_offer'] . "", COLOR_TITLE_LEVEL_A_INTERIM);
?>

<!-- Début : Affichage Des Détails De l'Offre -->
<div class="mt-2 bg-white text-dark p-2" id="offerDetails">
    <div class="container">
        <div class="row">
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
                <div id="infos" class="">
                    <?php echo styleTitleLevel_2("Caractéristiques", COLOR_TITLE_LEVEL_A_INTERIM_TEAM); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="shadow text-center">
                                <strong>Type de Logement </strong>
                            </p>
                            <p class="shadow text-center">
                                <strong>Locataire Souhaité </strong>
                            </p>
                            <p class="shadow text-center">
                                <strong>Disponibilité </strong>
                            </p>
                            <p class="shadow text-center">
                                <strong>Loyé / Mois </strong>
                            </p>
                            <p class="shadow text-center">
                                <strong>Nombre de Pièces </strong>
                            </p>
                            <p class="shadow text-center">
                                <strong>Surface (m2) </strong>
                            </p>
                            <p class="shadow text-center">
                                <strong>Contrat </strong>
                            </p>
                            <p class="shadow text-center">
                                <strong>Pays </strong>
                            </p>
                            <p class="shadow text-center">
                                <strong>Ville </strong>
                            </p>
                            <p class="shadow text-center">
                                <strong>Adresse </strong>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="shadow text-center">
                                <?php echo $categoryOffer['name_category'] ?>
                            </p>
                            <p class="shadow text-center">
                                <?php echo $publicOffer['name_public'] ?>
                            </p>
                            <p class="shadow text-center">
                                <?php echo $offer['availablity_offer'] ?>
                            </p>
                            <p class="shadow text-center">
                                <?php echo $offer['price_offer'] ?>
                            </p>
                            <p class="shadow text-center">
                                <?php echo $offer['pieces_offer'] ?>
                            </p>
                            <p class="shadow text-center">
                                <?php echo $offer['availablity_offer'] ?>
                                <?php echo $offer['contract_offer'] ?>
                                <?php echo $offer['area_offer'] ?>
                            </p>
                            <p class="shadow text-center">
                                <?php echo $offer['contract_offer'] ?>
                            </p>
                            <p class="shadow text-center">
                                <?php echo $offer['country_offer'] ?>
                            </p>
                            <p class="shadow text-center">
                                <?php echo $offer['city_offer'] ?>
                            </p>
                            <p class="shadow text-center">
                                <?php echo $offer['location_offer'] ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" id="description">
                <?php echo styleTitleLevel_2("Description", COLOR_TITLE_LEVEL_A_INTERIM_TEAM); ?>
                <p>
                    <?php echo $offer['description_offer'] ?>
                </p>
            </div>
            <div class="col-md-6">
                <?php echo styleTitleLevel_2("Auteur", COLOR_TITLE_LEVEL_A_INTERIM_TEAM); ?>
                <div class="row">
                    <div class="col-md-6" id="ownerInfosLeft">
                        <p class="">
                            <strong>Nom </strong>
                        </p>
                        <p class="">
                            <strong>Email </strong>
                        </p>
                    </div>
                    <div class="col-md-6" id="ownerInfosRight">
                        <p class="">
                            <?php echo $offer_owner['name_user'] ?>
                        </p>
                        <p class="">
                            <?php echo $offer_owner['email_user'] ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Fin : Affichage Des Détails De l'Offre -->


<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>

