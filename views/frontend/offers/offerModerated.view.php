<?php
ob_start();
?>

<div class="" id="">
    <div class="container">
        <h3 class="text-center">Offres Modérées</h3>
        <div class="row">
            <?php if (count($offers) > 0) {?>
                <?php foreach ($offers as $offer) : ?>
                    <?php
                    $offer = getOfferById($offer['id_offer']);
                    $images = getImagesOfOffer($offer['id_offer']);
                    $publicOffer = getPublicOfOffer($offer['public_offer']);
                    $categoryOffer = getCategoryOfOffer($offer['category_offer']);
                    $offer_owner = getUserById($offer['offer_owner']);
                    ?>
                    <div class="card m-1 mb-2" id="<?= $offer['id_offer'] ?>">
                        <div class="m-2 d-inline-block">
                            <button type="button" class="btn btn-primary offer-display-btn"
                                    data-id="<?= $offer['id_offer'] ?>" data-toggle="modal">Voir
                            </button>
                            <button type="button" class="btn btn-primary offer-edit-btn"
                                    data-id="<?= $offer['id_offer'] ?>" data-toggle="modal">Éditer
                            </button>
                            <button type="button" class="btn btn-primary offerDeleteBtn"
                                    data-id="<?= $offer['id_offer'] ?>" data-toggle="modal">Supprimer
                            </button>
                        </div>
                        <div class="card-body p-2">
                            <p class="card-text text-center"><?php echo $categoryOffer['name_category'] ?></p>
                            <p class="card-text">Public : <?php echo $publicOffer['name_public']   ?></p>
                            <p class="card-text">Loyé Mensuel : <?php echo $offer['price_offer'] ?></p>
                            <p class="card-text">Pièces : <?php echo $offer['pieces_offer']  ?></p>
                            <p class="card-text">Ville : <?php echo $offer['city_offer'] ?></p>
                        </div>
                    </div>
                    <!-- Début : Édition d'une Offre -->
                    <div class="modal fade offerEditModal" id="offerEditModal<?= $offer['id_offer'] ?>" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-center" id="offerModalTitle">Édition d'une Offre</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="editNotificationMessage"></div>
                                    <form id="editOfferForm" class="editOfferForm" enctype="multipart/form-data">
                                        <div class="form-row">
                                            <input type="hidden" id="offerId" name="offerId" value="<?= $offer['id_offer'] ?>"/>
                                            <input type="hidden" id="imagesToDelete<?= $offer['id_offer'] ?>" name="imagesToDelete"/>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-4">
                                                <label for="e_offerCategory">Type de logement : </label>
                                                <select name="offerCategory" id="e_offerCategory" class="form-control">
                                                    <?php foreach ($offerCategory = getOfferCategories() as $category) {
                                                        if ($category["id_category"] === $offer['category_offer']) {
                                                            echo '<option value="' . $category["id_category"] . '" selected="selected">' . $category["name_category"] . '</option>';
                                                        } else {
                                                            echo '<option value="' . $category["id_category"] . '">' . $category["name_category"] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="e_offerPeople">Locataire souhaité : </label>
                                                <select name="offerPeople" id="e_offerPeople" class="form-control">
                                                    <?php foreach ($offerPublic = getOfferPublic() as $public) {
                                                        if ($public["id_public"] === $offer['public_offer']) {
                                                            echo '<option value="' . $public["id_public"] . '" selected="selected">' . $public["name_public"] . '</option>';
                                                        } else {
                                                            echo '<option value="' . $public["id_public"] . '">' . $public["name_public"] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="e_offerTime">Durée du Contrat : </label>
                                                <input type="text" class="form-control" name="offerTime" id="e_offerTime" value="<?= $offer['contract_offer'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-4">
                                                <label for="e_offerAvailable">Disponibilité : </label>
                                                <input type="text" class="form-control" name="offerAvailable" id="e_offerAvailable" value="<?= $offer['availablity_offer'] ?>">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="e_offerPieces">Nombre de pièce(s) : </label>
                                                <input type="text" class="form-control" name="offerPieces" id="e_offerPieces" value="<?= $offer['pieces_offer'] ?>">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="e_offerArea">Surface (m2) : </label>
                                                <input type="text" class="form-control" name="offerArea" id="e_offerArea" value="<?= $offer['area_offer'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-4">
                                                <label for="e_offerPrice">Loyé / Mois : </label>
                                                <input type="text" class="form-control" name="offerPrice" id="e_offerPrice" value="<?= $offer['price_offer'] ?>">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="e_offerCountry">Pays : </label>
                                                <input type="text" class="form-control" name="offerCountry" id="e_offerCountry" value="<?= $offer['country_offer'] ?>">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="e_offerCity">Ville : </label>
                                                <input type="text" class="form-control" name="offerCity" id="e_offerCity" value="<?= $offer['city_offer'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-4">
                                                <label for="e_offerPostalCode">Code Postal : </label>
                                                <input type="text" class="form-control" name="offerPostalCode" id="e_offerPostalCode" value="<?= $offer['postal_code_offer'] ?>">
                                            </div>
                                            <div class="form-group col-8">
                                                <label for="e_offerAddress">Adresse : </label>
                                                <input type="text" class="form-control" name="offerAddress" id="e_offerAddress" value="<?= $offer['location_offer'] ?>">
                                            </div>
                                        </div>
                                        <div class="row m-1 mt-1 mb-2">
                                            <div class="form-check col-md-3">
                                                <input class="form-check-input" name="checkBoxValue[]" type="checkbox" value="Cuisine Individuelle" id="flexCheckChecked" checked>
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    Cuisine Individuelle
                                                </label>
                                            </div>
                                            <div class="form-check col-md-3">
                                                <input class="form-check-input" name="checkBoxValue[]"  type="checkbox" value="Cuisine Commune" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Cuisine Commune
                                                </label>
                                            </div>
                                            <div class="form-check col-md-3">
                                                <input class="form-check-input" name="checkBoxValue[]"  type="checkbox" value="Douche Publique" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Douche Commune
                                                </label>
                                            </div>
                                            <div class="form-check col-md-3">
                                                <input class="form-check-input" name="checkBoxValue[]"  type="checkbox" value="Douche Individuelle" id="flexCheckChecked" checked>
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    Douche Individuelle
                                                </label>
                                            </div>
                                            <div class="form-check col-md-3">
                                                <input class="form-check-input" name="checkBoxValue[]"  type="checkbox" value="Parking Gratuit" id="flexCheckChecked">
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    Parking Gratuit
                                                </label>
                                            </div>
                                            <div class="form-check col-md-3">
                                                <input class="form-check-input" name="checkBoxValue[]"  type="checkbox" value="Parking Payant" id="flexCheckChecked">
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    Parking Payant
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="e_offerDescription">Description : </label>
                                            <textarea class="form-control" id="e_offerDescription" name="offerDescription"
                                                      rows="4"><?= $offer['description_offer'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="numberOfImage">Photo(s): </label>
                                            <input type="file" class='form-control-file mt-1' name="offerImage[]" multiple="multiple"
                                                   id="offerImage"/>
                                        </div>

                                        <!-- Affichage des images de l'Offre via AJAX -->
                                        <div class="row p-2" id="displayImages">
                                            <?php $images = getImagesOfOffer($offer['id_offer']); ?>
                                            <?php foreach ($images as $image) { ?>
                                                <img class="edit-image m-1" src="<?= URL ?><?= $image['url_image'] ?>"
                                                     data-src="<?= $image["name_image"] ?>"
                                                     data-id="<?= $image['id_image'] ?>"
                                                     alt="<?= $image["name_image"] ?>">
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <!-- Fin : Affichage des images de l'Offre via AJAX -->

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary editOfferCancelBtn"
                                                    data-bs-dismiss="modal">Fermer
                                            </button>
                                            <button type="submit" class="btn btn-primary" name="editOfferFormSubmitBtn"
                                                    id="editOfferFormSubmitBtn">
                                                Mettre À Jour
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin : Édition d'une Offre -->
                <?php endforeach; ?>
            <?php } ?>
        </div>
    </div>
</div>


<!-- Début : Affichage d'une Offre  -->
<?php require_once "public/utils/offersTemplates/displayOfferFormModal.php"; ?>
<!-- Fin : Affichage d'une Offre  -->

<!-- Début : Suppression d'une Offre -->
<?php require_once "public/utils/offersTemplates/deleteOfferFormModal.php"; ?>
<!-- Fin : Suppression d'une Offre -->

<script src="<?= URL ?>public/js/offers.js"></script>


<?php
$contentView = ob_get_clean();
?>
