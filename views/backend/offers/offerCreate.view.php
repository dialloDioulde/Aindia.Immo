<?php
ob_start();
?>

<div class="row mt-2 p-2 justify-content-center" id="createOfferError">
    <?php if ($ALERT_OFFER_CREATE != "") {?>
        <div class="alert alert-success" id="alert" role="alert">
            <?= $ALERT_OFFER_CREATE; ?>
        </div>
    <?php } elseif ($ALERT_OFFER_CREATE_ERROR != "") { ?>
    <div class="alert alert-danger" id="alert" role="alert">
        <?= $ALERT_OFFER_CREATE_ERROR; ?>
    </div>
    <?php }?>
</div>

<div class="container p-1">
    <div class="row">
        <div class="col-md-8 border-right border-top border-left border-bottom mt-1">
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
                    <label for="offerDescription">Description : </label>
                    <textarea class="form-control" id="offerDescription" name="offerDescription"
                              rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="numberOfImage">Photo(s): </label>
                    <input type="file" class='form-control-file mt-1' name="offerImage[]" multiple="multiple"
                           id="offerImage"/>
                </div>
                <div class="row no-guters p-1">
                    <input type="submit" value="CRÉER L'OFFRE" class="btn btn-primary col-3">
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <p>Le meilleur site d'annonce !</p>
            <div class="notificationMessage"></div>
        </div>
    </div>
</div>

<script src="<?= URL ?>public/js/offerCreate.js"></script>



<?php
$content = ob_get_clean();
require "views/commons/template.php";

?>
