<div class="modal fade offerEditModal mt-2 p-2" id="offerEditModal"
     role="dialog">
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
                        <input type="hidden" id="numberTotalOfImagesFromDatabase" name="numberTotalOfImagesFromDatabase"/>
                        <input type="hidden" id="imagesToDelete" name="imagesToDelete"/>
                        <input type="hidden" id="numberOfImagesToDelete" value="0" name="numberOfImagesToDelete"/>
                        <input type="hidden" id="newImages" name="newImages"/>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="e_offerCategory">Type de logement : </label>
                            <select name="offerCategory" id="e_offerCategory"
                                    class="form-control">
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
                        <label for="offerImage">Photo(s): </label>
                        <input type="file" class='form-control-file mt-1' name="offerImage[]" multiple="multiple"
                               id="offerImage"/>
                        <span class="error mb-1" id="offerImageError"></span>
                    </div>

                    <!-- Affichage des images de l'Offre via AJAX -->
                    <div class="row p-2" id="editOfferImages">
                    </div>
                    <!-- Fin : Affichage des images de l'Offre via AJAX -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary editOfferCancelBtn"
                                data-bs-dismiss="modal">Fermer
                        </button>
                        <button type="submit" class="btn btn-primary"
                                name="editOfferFormSubmitBtn"
                                id="btnSubmit">
                            Mettre À Jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
