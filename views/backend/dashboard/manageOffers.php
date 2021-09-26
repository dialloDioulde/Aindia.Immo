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
                            <button type="button" class="btn btn-primary offer-display-btn"
                                    data-id="<?= $offer['id_offer'] ?>" data-toggle="modal">Voir
                            </button>
                            <button type="button" class="btn btn-primary offer-edit-btn"
                                    data-id="<?= $offer['id_offer'] ?>" data-toggle="modal">Éditer
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


<!-- Début : Affichage d'une Offre  -->
<div class="modal fade offerDisplayModal" id="offerDisplayModal" role="dialog">
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
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" id="d_offerCategory"></li>
                            <li class="list-group-item" id="d_offerPrice"></li>
                            <li class="list-group-item" id="d_offerPieces">Nb Pièces </li>
                            <li class="list-group-item" id="d_offerArea">Surface (m2) </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3 class="text-center">Conditions</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" id="d_offerTime">Contrat </li>
                            <li class="list-group-item" id="d_offerAvailable">Disponibilité</li>
                            <li class="list-group-item" id="d_offerPeople">Locataire Souhaité</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3 class="text-center">Localisation</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" id="d_offerCity"></li>
                            <li class="list-group-item" id="d_offerPostalCode"></li>
                            <li class="list-group-item" id="d_offerAddress"></li>
                        </ul>
                    </div>
                </div>
                <!-- FIN : Informations de l'Offre -->

                <!-- DÉBUT : Auteur de l'Offre -->
                <div class="row mt-2 border-top">
                    <div class="col-md-4">
                        <h3 class="text-center">Auteur</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Nom : </li>
                            <li class="list-group-item">Email: </li>
                        </ul>
                    </div>
                </div>
                <!-- FIN : Auteur de l'Offre -->

            </div>
        </div>
    </div>
</div>
<!-- Fin : Affichage d'une Offre  -->

<!-- Début : Édition d'une Offre -->
<div class="modal fade offerEditModal" id="offerEditModal" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="offerModalTitle">Édition d'une Offre</h5>
            </div>
            <div class="modal-body">
                <div class="editNotificationMessage"></div>
                <form id="editOfferForm" class="editOfferForm" enctype="multipart/form-data">
                    <div class="form-row">
                        <input type="hidden" id="offerId" name="offerId"/>
                        <input type="hidden" id="imagesToDelete" name="imagesToDelete"/>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="e_offerCategory">Type de logement : </label>
                            <select name="offerCategory" id="e_offerCategory" class="form-control">
                                <?php foreach ($offerCategory = getOfferCategories() as $category) { ?>
                                    <?php echo '<option value="' . $category["id_category"] . '">' . $category["name_category"] . '</option>'; ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label for="e_offerPeople">Locataire souhaité : </label>
                            <select name="offerPeople" id="e_offerPeople" class="form-control">
                                <?php foreach ($offerPublic = getOfferPublic() as $public) { ?>
                                    <?php echo '<option value="' . $public["id_public"] . '">' . $public["name_public"] . '</option>'; ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label for="e_offerTime">Durée du Contrat : </label>
                            <input type="text" class="form-control" name="offerTime" id="e_offerTime">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="e_offerAvailable">Disponibilité : </label>
                            <input type="text" class="form-control" name="offerAvailable" id="e_offerAvailable">
                        </div>
                        <div class="form-group col-4">
                            <label for="e_offerPieces">Nombre de pièce(s) : </label>
                            <input type="text" class="form-control" name="offerPieces" id="e_offerPieces">
                        </div>
                        <div class="form-group col-4">
                            <label for="e_offerArea">Surface (m2) : </label>
                            <input type="text" class="form-control" name="offerArea" id="e_offerArea">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="e_offerPrice">Loyé / Mois : </label>
                            <input type="text" class="form-control" name="offerPrice" id="e_offerPrice">
                        </div>
                        <div class="form-group col-4">
                            <label for="e_offerCountry">Pays : </label>
                            <input type="text" class="form-control" name="offerCountry" id="e_offerCountry">
                        </div>
                        <div class="form-group col-4">
                            <label for="e_offerCity">Ville : </label>
                            <input type="text" class="form-control" name="offerCity" id="e_offerCity">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="e_offerPostalCode">Code Postal : </label>
                            <input type="text" class="form-control" name="offerPostalCode" id="e_offerPostalCode">
                        </div>
                        <div class="form-group col-8">
                            <label for="e_offerAddress">Adresse : </label>
                            <input type="text" class="form-control" name="offerAddress" id="e_offerAddress">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="e_offerDescription">Description : </label>
                        <textarea class="form-control" id="e_offerDescription" name="offerDescription"
                                  rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="e_numberOfImage">Photo(s): </label>
                        <input type="file" class='form-control-file mt-2' name="offerImage[]" multiple="multiple"
                               id="e_offerImage"/>
                    </div>
                    <!-- Affichage des images de l'Offre via AJAX -->
                    <div class="row p-2" id="displayImages">
                    </div>
                    <!-- Fin : Affichage des images de l'Offre via AJAX -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary editOfferCancelBtn"
                                data-bs-dismiss="modal">Annuler
                        </button>
                        <button type="submit" class="btn btn-primary" name="editOfferFormSubmitBtn"
                                id="editOfferFormSubmitBtn">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin : Édition d'une Offre -->


<script src="<?= URL ?>public/js/manageOffers.js"></script>


<?php
$contentDashboard = ob_get_clean();
?>


