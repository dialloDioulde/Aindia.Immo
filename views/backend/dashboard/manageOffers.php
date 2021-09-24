<?php
ob_start();
?>

<?php
// On récupère les données grâce à la fonction que nous avons créée dans le offerDao.php
$offers = getOffers();
?>


<div class="" id="manageOffers">
    <div class="container">
        <h3 class="text-center">GESTION DES OFFRES</h3>
        <button type="button" id="offerModalBtn" class="btn btn-primary ml-1">Publier une Offre</button>
        <div class="row" id="offer-row">
            <?php foreach ($offers as $offer) : ?>
                <div class="col-md-4" id="offer-card">
                    <div class="card m-1">
                        <div class="card-header text-center">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#offerDisplayModal<?= $offer['id_offer'] ?>">Voir
                            </button>
                            <button type="button" class="btn btn-primary offer-edit-btn"
                                    data-target="#offerEditModal<?= $offer['id_offer'] ?>" data-id="<?= $offer['id_offer'] ?>" data-toggle="modal">Éditer
                            </button>
                        </div>
                        <ul class="list-group list-group-flush" id="displayOffer">
                            <li class="list-group-item">Loyé : <?= $offer['price_offer'] ?></li>
                            <li class="list-group-item">Nb Pièces : <?= $offer['pieces_offer'] ?></li>
                            <li class="list-group-item">Pays : <?= $offer['country_offer'] ?></li>
                            <li class="list-group-item">Ville : <?= $offer['city_offer'] ?></li>
                        </ul>
                    </div>
                </div>

                <!-- Début : Modal présentant les informations d'une offre  -->
                <div class="modal fade offerDisplayModal" id="offerDisplayModal<?= $offer['id_offer'] ?>" role="dialog">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="offerDisplayModalTitle">Informations de
                                    l'Offre</h5>
                            </div>
                            <div class="modal-body">
                                <!-- DÉBUT : Les Images de l'Offre -->
                                <div class="row p-1">
                                    <?php $images = getImagesOfOffer($offer['id_offer']); ?>
                                    <?php foreach ($images as $image) { ?>
                                        <img class="m-1 offer-display-image" src="<?= URL ?><?= $image['url_image'] ?>"
                                             style="width: 350px; height: 280px;"
                                             data-src="<?= $image["name_image"] ?>"
                                             data-id="<?= $image['id_image'] ?>"
                                             alt="<?= $image["name_image"] ?>">
                                        <?php
                                    }
                                    ?>
                                </div>
                                <!-- FIN : Les Images de l'Offre  -->

                                <!-- DÉBUT : Informations de l'Offre -->
                                <div class="row mt-2 border-top">
                                    <div class="col-md-4">
                                        <h3 class="text-center">Caractéristiques</h3>
                                        <?php $categoryOffer = getCategoryOfOffer($offer['category_offer']); ?>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Type de Logement
                                                : <?= $categoryOffer['name_category'] ?></li>
                                            <li class="list-group-item">Loyé : <?= $offer['price_offer'] ?></li>
                                            <li class="list-group-item">Nb Pièces : <?= $offer['pieces_offer'] ?></li>
                                            <li class="list-group-item">Surface (m2) : <?= $offer['area_offer'] ?></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h3 class="text-center">Conditions</h3>
                                        <?php $publicOffer = getPublicOfOffer($offer['public_offer']); ?>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Contrat : <?= $offer['contract_offer'] ?></li>
                                            <li class="list-group-item">Disponibilité
                                                : <?= $offer['availablity_offer'] ?></li>
                                            <li class="list-group-item">Locataire Souhaité
                                                : <?= $publicOffer['name_public'] ?></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h3 class="text-center">Localisation</h3>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><?= $offer['country_offer'] ?></li>
                                            <li class="list-group-item"><?= $offer['city_offer'] ?></li>
                                            <li class="list-group-item"><?= $offer['location_offer'] ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- FIN : Informations de l'Offre -->

                                <!-- DÉBUT : Auteur de l'Offre -->
                                <div class="row mt-2 border-top">
                                    <?php $offer_owner = getUserById($offer['offer_owner']); ?>
                                    <div class="col-md-4">
                                        <h3 class="text-center">Auteur</h3>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Nom : <?= $offer_owner['name_user'] ?></li>
                                            <li class="list-group-item">Email: <?= $offer_owner['email_user'] ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- FIN : Auteur de l'Offre -->

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin : Modal présentant les informations d'une offre  -->

                <!-- Début : Édition d'une offre -->
                <div class="modal fade offerEditModal" id="offerEditModal<?= $offer['id_offer'] ?>" role="dialog">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="offerModalTitle">Édition d'une Offre</h5>
                            </div>
                            <div class="modal-body">
                                <div class="editNotificationMessage"></div>
                                <form id="editOfferForm" class="editOfferForm" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <input type="hidden" id="offerId<?= $offer['id_offer'] ?>" name="offerId" value="<?= $offer['id_offer'] ?>">
                                        <input type="hidden" id="imagesToDelete<?= $offer['id_offer'] ?>" name="imagesToDelete">
                                        <div class="form-group col-4">
                                            <label for="offerCategory<?= $offer['id_offer'] ?>">Type de logement : </label>
                                            <select name="offerCategory" id="offerCategory<?= $offer['id_offer'] ?>" class="form-control">
                                                <?php foreach ($offerCategory = getOfferCategories() as $category) {?>
                                                    <?php echo  '<option value="'.$category["id_category"].'">' . $category["name_category"] . '</option>'; ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="offerPeople<?= $offer['id_offer'] ?>">Locataire Souhaité : </label>
                                            <select name="offerPeople" id="offerPeople<?= $offer['id_offer'] ?>" class="form-control">
                                                <?php foreach ($offerPublic = getOfferPublic() as $public) { ?>
                                                    <?php echo '<option value="' . $public["id_public"] . '">' . $public["name_public"] . '</option>'; ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="offerTime<?= $offer['id_offer'] ?>">Durée du Contrat : </label>
                                            <input type="text" class="form-control" name="offerTime" id="offerTime<?= $offer['id_offer'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-4">
                                            <label for="offerAvailable<?= $offer['id_offer'] ?>">Disponibilité : </label>
                                            <input type="text" class="form-control" name="offerAvailable"
                                                   id="offerAvailable<?= $offer['id_offer'] ?>">
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="offerPieces<?= $offer['id_offer'] ?>">Nombre de pièce(s) : </label>
                                            <input type="text" class="form-control" name="offerPieces"
                                                   id="offerPieces<?= $offer['id_offer'] ?>">
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="offerArea<?= $offer['id_offer'] ?>">Surface (m2) : </label>
                                            <input type="text" class="form-control" name="offerArea" id="offerArea<?= $offer['id_offer'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-4">
                                            <label for="offerPrice<?= $offer['id_offer'] ?>">Loyé / Mois : </label>
                                            <input type="text" class="form-control" name="offerPrice" id="offerPrice<?= $offer['id_offer'] ?>">
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="offerCountry<?= $offer['id_offer'] ?>">Pays : </label>
                                            <input type="text" class="form-control" name="offerCountry"
                                                   id="offerCountry<?= $offer['id_offer'] ?>">
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="offerCity<?= $offer['id_offer'] ?>">Ville : </label>
                                            <input type="text" class="form-control" name="offerCity" id="offerCity<?= $offer['id_offer'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-4">
                                            <label for="offerPostalCode<?= $offer['id_offer'] ?>">Code Postal : </label>
                                            <input type="text" class="form-control" name="offerPostalCode"
                                                   id="offerPostalCode<?= $offer['id_offer'] ?>">
                                        </div>
                                        <div class="form-group col-8">
                                            <label for="offerAddress<?= $offer['id_offer'] ?>">Localisation : </label>
                                            <input type="text" class="form-control" name="offerAddress"
                                                   id="offerAddress<?= $offer['id_offer'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="offerDescription<?= $offer['id_offer'] ?>">Description : </label>
                                        <textarea class="form-control" id="offerDescription<?= $offer['id_offer'] ?>" name="offerDescription"
                                                  rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="numberOfImage">Photo(s): </label>
                                        <input type="file" class='form-control-file mt-2' name="offerImage[]"
                                               multiple="multiple"
                                               id="offerImage"/>
                                    </div>
                                    <!-- Affichage des images de l'Offre -->
                                    <div class="row p-2">
                                        <?php $images = getImagesOfOffer($offer['id_offer']); ?>
                                        <?php foreach ($images as $image) { ?>
                                            <img class="m-1 offer-edit-image" src="<?= URL ?><?= $image['url_image'] ?>"
                                                 style="width: 130px; height: 100px;"
                                                 data-src="<?= $image["name_image"] ?>"
                                                 data-id="<?= $image['id_image'] ?>"
                                                 alt="<?= $image["name_image"] ?>">
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <!-- Fin : Affichage des images de l'Offre -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary editOfferCancelBtn"
                                                data-bs-dismiss="modal">Annuler
                                        </button>
                                        <button type="submit" class="btn btn-primary" name="offerFormSubmitBtn"
                                                id="offerFormSubmitBtn">
                                            Enregistrer
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin : Édition d'une offre -->

            <?php endforeach; ?>
        </div>
    </div>
</div>


<!-- Début : Création d'une Offre -->
<div class="modal fade createOfferModal" id="createOfferModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="offerModalTitle">Création d'une Offre</h5>
            </div>
            <div class="modal-body">
                <div class="notificationMessage"></div>
                <form id="createOfferForm" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="offerCategory">Type de logement : </label>
                            <select name="offerCategory" id="offerCategory" class="form-control">
                                <?php foreach ($offerCategory = getOfferCategories() as $category) { ?>
                                    <?php echo '<option value="' . $category["id_category"] . '">' . $category["name_category"] . '</option>'; ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label for="offerPeople">Locataire souhaité : </label>
                            <select name="offerPeople" id="offerPeople" class="form-control">
                                <?php foreach ($offerPublic = getOfferPublic() as $public) { ?>
                                    <?php echo '<option value="' . $public["id_public"] . '">' . $public["name_public"] . '</option>'; ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label for="offerTime">Durée du Contrat : </label>
                            <input type="text" class="form-control" name="offerTime" id="offerTime">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="offerAvailable">Disponibilité : </label>
                            <input type="text" class="form-control" name="offerAvailable" id="offerAvailable">
                        </div>
                        <div class="form-group col-4">
                            <label for="offerPieces">Nombre de pièce(s) : </label>
                            <input type="text" class="form-control" name="offerPieces" id="offerPieces">
                        </div>
                        <div class="form-group col-4">
                            <label for="offerArea">Surface (m2) : </label>
                            <input type="text" class="form-control" name="offerArea" id="offerArea">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="offerPrice">Loyé / Mois : </label>
                            <input type="text" class="form-control" name="offerPrice" id="offerPrice">
                        </div>
                        <div class="form-group col-4">
                            <label for="offerCountry">Pays : </label>
                            <input type="text" class="form-control" name="offerCountry" id="offerCountry">
                        </div>
                        <div class="form-group col-4">
                            <label for="offerCity">Ville : </label>
                            <input type="text" class="form-control" name="offerCity" id="offerCity">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="offerPostalCode">Code Postal : </label>
                            <input type="text" class="form-control" name="offerPostalCode" id="offerPostalCode">
                        </div>
                        <div class="form-group col-8">
                            <label for="offerAddress">Adresse : </label>
                            <input type="text" class="form-control" name="offerAddress" id="offerAddress">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="offerDescription">Description : </label>
                        <textarea class="form-control" id="offerDescription" name="offerDescription"
                                  rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="numberOfImage">Photo(s): </label>
                        <input type="file" class='form-control-file mt-2' name="offerImage[]" multiple="multiple"
                               id="offerImage"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="cancelBtn" class="btn btn-secondary" data-bs-dismiss="modal">Annuler
                        </button>
                        <button type="submit" class="btn btn-primary" name="offerFormSubmitBtn" id="offerFormSubmitBtn">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin : Création d'une Offre -->


<script src="<?= URL ?>public/js/manageOffers.js"></script>

<?php
$contentDashboard = ob_get_clean();
?>


