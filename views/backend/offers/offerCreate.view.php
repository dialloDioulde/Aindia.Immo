<?php
ob_start();
?>

<div class="row mt-2 p-2 justify-content-center" id="createOfferError">
    <?php if ($ALERT_OFFER_CREATE != "") { ?>
        <div class="alert alert-success" id="alert" role="alert">
            <?= $ALERT_OFFER_CREATE; ?>
        </div>
    <?php } elseif ($ALERT_OFFER_CREATE_ERROR != "") { ?>
        <div class="alert alert-danger" id="alert" role="alert">
            <?= $ALERT_OFFER_CREATE_ERROR; ?>
        </div>
    <?php } ?>
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
                        <input type="text" class="form-control" name="offerTime" id="offerTime"
                               placeholder="ex : 12 mois"
                               onkeyup="inputFieldValidation(this, 'offerTimeError', regexOnlyIntAndLetters, timeErrorMessage)">
                        <span class="error mb-1" id="offerTimeError"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="offerAvailable">Disponibile : </label>
                        <input type="date" class="form-control" name="offerAvailable" id="offerAvailable">
                        <span class="error mb-1" id="offerAvailableError"></span>
                    </div>
                    <div class="form-group col-4">
                        <label for="offerPieces">Nombre de pièce(s) : </label>
                        <input type="text" class="form-control" name="offerPieces" id="offerPieces" placeholder="ex : 2"
                               onkeyup="inputFieldValidation(this, 'offerPiecesError', regexOnlyInt, piecesErrorMessage)">
                        <span class="error mb-1" id="offerPiecesError"></span>
                    </div>
                    <div class="form-group col-4">
                        <label for="offerArea">Surface (m2) : </label>
                        <input type="text" class="form-control" name="offerArea" id="offerArea" placeholder="ex : 18,50"
                               onkeyup="inputFieldValidation(this, 'offerAreaError', regexIntAndFloat, areaErrorMessage)">
                        <span class="error mb-1" id="offerAreaError"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="offerPrice">Loyé Mensuel (f cfa) : </label>
                        <input type="text" class="form-control" name="offerPrice" id="offerPrice"
                               placeholder="ex : 50695,75"
                               onkeyup="inputFieldValidation(this, 'offerPriceError', regexIntAndFloat, priceErrorMessage)">
                        <span class="error mb-1" id="offerPriceError"></span>
                    </div>
                    <div class="form-group col-4">
                        <label for="offerCountry">Pays : </label>
                        <input type="text" class="form-control" name="offerCountry" id="offerCountry"
                               placeholder="ex : Sénégal"
                               onkeyup="inputFieldValidation(this, 'offerCountryError', regexOnlyLetters, countryErrorMessage)">
                        <span class="error mb-1" id="offerCountryError"></span>
                    </div>
                    <div class="form-group col-4">
                        <label for="offerCity">Ville : </label>
                        <input type="text" class="form-control" name="offerCity" id="offerCity"
                               placeholder="ex : Marsassoum"
                               onkeyup="inputFieldValidation(this, 'offerCityError', regexOnlyLetters, cityErrorMessage)">
                        <span class="error mb-1" id="offerCityError"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="offerPostalCode">Code Postal : </label>
                        <input type="text" class="form-control" name="offerPostalCode" id="offerPostalCode"
                               placeholder="ex : 31700 DK"
                               onkeyup="inputFieldValidation(this, 'offerPostalCodeError', regexOnlyIntAndLetters, postalCodeErrorMessage)">
                        <span class="error mb-1" id="offerPostalCodeError"></span>
                    </div>
                    <div class="form-group col-8">
                        <label for="offerAddress">Localisation : </label>
                        <input type="text" class="form-control" name="offerAddress" id="offerAddress"
                               placeholder="ex : 8 Rue de la Casamance"
                               onkeyup="inputFieldValidation(this, 'offerAddressError', regexOnlyIntAndLetters, addressErrorMessage)">
                        <span class="error mb-1" id="offerAddressError"></span>
                    </div>
                </div>
                <div class="row m-1 mt-1 mb-2">
                    <div class="form-check col-md-3">
                        <input class="form-check-input" name="checkBoxValue[]" type="checkbox"
                               value="Cuisine Individuelle" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Cuisine Individuelle
                        </label>
                    </div>
                    <div class="form-check col-md-3">
                        <input class="form-check-input" name="checkBoxValue[]" type="checkbox" value="Cuisine Commune"
                               id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Cuisine Commune
                        </label>
                    </div>
                    <div class="form-check col-md-3">
                        <input class="form-check-input" name="checkBoxValue[]" type="checkbox" value="Douche Publique"
                               id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Douche Commune
                        </label>
                    </div>
                    <div class="form-check col-md-3">
                        <input class="form-check-input" name="checkBoxValue[]" type="checkbox"
                               value="Douche Individuelle" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Douche Individuelle
                        </label>
                    </div>
                    <div class="form-check col-md-3">
                        <input class="form-check-input" name="checkBoxValue[]" type="checkbox" value="Parking Gratuit"
                               id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Parking Gratuit
                        </label>
                    </div>
                    <div class="form-check col-md-3">
                        <input class="form-check-input" name="checkBoxValue[]" type="checkbox" value="Parking Payant"
                               id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Parking Payant
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="offerDescription">Description : </label>
                    <textarea class="form-control" id="offerDescription" name="offerDescription" rows="4"
                              placeholder="ex : Nous mettons en location notre maison au bord de la mer..."
                              onkeyup="inputFieldValidation(this, 'offerDescriptionError', regexOnlyLettersDescription, descriptionMessage)"></textarea>
                    <span class="error mb-1" id="offerDescriptionError"></span>
                </div>
                <div class="form-group">
                    <label for="numberOfImage">Photo(s): </label>
                    <input type="file" class='form-control-file mt-1' name="offerImage[]" multiple="multiple"
                           id="offerImage"/>
                    <span class="error mb-1" id="offerImageError"></span>
                </div>
                <div class="row no-guters p-1">
                    <input type="submit" value="CRÉER L'OFFRE" class="btn btn-primary createOfferBtn col-3" id="btnSubmit">
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
