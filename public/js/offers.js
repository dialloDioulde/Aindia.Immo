$(document).ready(function () {
    // Affichage des informations d'une offre à partir de son ID
    // Ouverture du modal présentant les informations d'une offre
    $(".offer-display-btn").click(function () {
        editImage = false;
        let idOfferParam = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: 'getAllDataOfOfferWithAJAX',
            data: "offerId=" + idOfferParam,
            success: function (data) {
                let resData = JSON.parse(data);
                let offerOwner = resData.offerOwner;
                let offerImages = resData.offerImages;
                let offerData = resData.offerData;
                let idOffer = offerData['id_offer'];
                let offerPublic = resData.offerPublic['name_public'];
                let offerCategory = resData.offerCategory['name_category'];

                document.getElementById("d_offerCategory").innerHTML = "Type de Logement : " + offerCategory;
                document.getElementById("d_offerPrice").innerHTML = "Loyé : " + offerData['price_offer'];
                document.getElementById("d_offerPieces").innerHTML = "Nb Pièces :" + offerData['pieces_offer'];
                document.getElementById("d_offerArea").innerHTML = "Surface (m2) : " + offerData['area_offer'];
                document.getElementById("d_offerTime").innerHTML = "Contrat : " + offerData['contract_offer'];
                document.getElementById("d_offerAvailable").innerHTML = "Disponibilité : " + offerData['availablity_offer'];
                document.getElementById("d_offerPeople").innerHTML = "Locataire Souhaité : " + offerPublic;
                document.getElementById("d_offerCity").innerHTML = offerData['city_offer'];
                document.getElementById("d_offerPostalCode").innerHTML = offerData['postal_code_offer'];
                document.getElementById("d_offerAddress").innerHTML = offerData['location_offer'];
                document.getElementById("d_offerDescription").innerHTML = offerData['description_offer'];
                document.getElementById("d_offerOwnerName").innerHTML = "Nom : " + offerOwner['name_user'];
                document.getElementById("d_offerOwnerEmail").innerHTML = "Email : " + offerOwner['email_user'];

                let offer_display_image = "offer-display-image-" + idOffer;
                let displayImageTagClassName = document.getElementsByClassName(offer_display_image);
                let offer_image_display_div_content_id = "offer-image-display-div-content-id-" + idOffer;
                // On vérifie qu'aucune image de l'offre séléctionnée n'est déjà affichée
                // Pour éviter d'afficher une nouvelle fois les images déjà affichées lors du premier clic
                displayImagesOfOfferById(offer_display_image, displayImageTagClassName, offer_image_display_div_content_id,
                    idOfferParam, offerImages, idOffer, displayOfferImagesDivContentId);
            }
        });
        $("#offerDisplayModal").appendTo("body").modal('show');
    });

    /**
     * Open edit offer modal
     */
    $(".offer-edit-btn").click(function () {
        imagesToDelete = [];
        let id_offer = $(this).data('id');
        document.getElementById("offerId").value = id_offer;
        getEditOfferDataById(id_offer);
        editImage = true;
        $("#offerEditModal").appendTo("body").modal('show');
    });

    /**
     * Get offer data by Id
     * @param idOfferParam
     */
    function getEditOfferDataById(idOfferParam) {
        $.ajax({
            type: 'POST',
            url: 'getAllDataOfOfferWithAJAX',
            data: "offerId=" + idOfferParam,
            success: function (data) {
                let resData = JSON.parse(data);
                let offerImages = resData.offerImages;
                let offerData = resData.offerData;
                let idOffer = offerData['id_offer'];
                let offerPublic = resData.offerPublic['name_public'];
                let offerCategory = resData.offerCategory['name_category'];

                let edit_offer_image = "edit-offer-image-" + idOffer;
                let editOfferImageTagClassName = document.getElementsByClassName(edit_offer_image);
                let edit_offer_image_div_content_id = "edit-offer-image-div-content-id-" + idOffer;
                // On vérifie qu'aucune image de l'offre séléctionnée n'est déjà affichée
                // Pour éviter d'afficher une nouvelle fois les images déjà affichées lors du premier clic
                // On appelle la fonction permettant de récupérer l'ID de l'image à supprimer
                displayImagesOfOfferById(edit_offer_image, editOfferImageTagClassName, edit_offer_image_div_content_id,
                    idOfferParam, offerImages, idOffer, editOfferImagesDivContentId);

                document.getElementById("offerTime").value = offerData['contract_offer'];
                $("#offerCategory").val(offerCategory);
                document.getElementById("offerPrice").value = offerData['price_offer'];
                document.getElementById("offerPieces").value = offerData['pieces_offer'];
                document.getElementById("offerArea").value = offerData['area_offer'];
                $("#offerAvailable").val(offerData['availablity_offer']);
                $("#offerPeople").val(offerPublic);
                document.getElementById("offerCountry").value = offerData['country_offer'];
                document.getElementById("offerCity").value = offerData['city_offer'];
                document.getElementById("offerPostalCode").value = offerData['postal_code_offer'];
                document.getElementById("offerAddress").value = offerData['location_offer'];
                document.getElementById("offerDescription").value = offerData['description_offer'];

                document.getElementById("numberTotalOfImagesFromDatabase").value = offerImages.length;
                //numberTotalOfImages = offerImages.length
            }
        });
    }

    /**
     * Hide edit offer Modal
     */
    $(".editOfferCancelBtn").click(function () {
        // On supprime toutes les images déjà ajoutées dans la DIV (editOfferImagesDivContentId, affichant les images)
        while(editOfferImagesDivContentId.firstChild) {
            editOfferImagesDivContentId.removeChild( editOfferImagesDivContentId.firstChild);
        }
        imagesToDelete = [];
        $(".offerEditModal").modal('hide');
    });


    /**
     * Édition du statut d'une Offre par son ID
     */
    $(".editOfferForm").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'updateDataOfOfferWithAJAX',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                $('.editNotificationMessage').html('');
                if (response.status === 1) {
                    $('.editNotificationMessage').html('<p class="alert alert-success">'+response.message+'</p>');
                    //$("#offerModal").modal('hide');
                } else {
                    $('.editNotificationMessage').html('<p class="alert alert-danger">'+response.message+'</p>');
                }
            }
        });
    });

    /**
     * Initialisation des variables
     * @type {*[]}
     */
    let imagesToDelete = [];
    let displayOfferImagesDivContentId = document.getElementById("offerImagesDisplay");
    let editOfferImagesDivContentId = document.getElementById("editOfferImages");
    let editImage = false;

    /**
     * Gestion des images de l'offre
     */
    function getIdOfImageToEdit() {
        imagesToDelete = [];
        $(".image-to-edit").click(function () {
            let image_id_from_database = $(this).data('id');
            if ($(this).hasClass("border-danger")) {
                $(this).removeClass("border-danger");
                $(this).css("border", "");
                let id_image = imagesToDelete.indexOf(image_id_from_database);
                imagesToDelete.splice(id_image, 1);
            } else {
                $(this).addClass("border-danger");
                $(this).css("border", "3px solid");
                imagesToDelete.push(image_id_from_database);
            }
            document.getElementById("imagesToDelete").value = imagesToDelete;
            document.getElementById("numberOfImagesToDelete").value = imagesToDelete.length;
        });
    }

    /**
     * Affichage des images d'une offre par son ID
     * @param imgTagClassName
     * @param countImgTagClassName
     * @param imageDivContentId
     * @param idOfferParam
     * @param imageData
     * @param idOffer
     * @param divId
     */
    function displayImagesOfOfferById(imgTagClassName, countImgTagClassName, imageDivContentId, idOfferParam, imageData, idOffer, divId)
    {
        if (countImgTagClassName.length === 0) {
            // On supprime toutes les images déjà ajoutées dans la DIV (displayEditOfferImagesDivContentId, affichant les images)
            while(divId.firstChild) {
                divId.removeChild(divId.firstChild);
            }
            // On réaffiche les images de l'offre dont l'ID est passé en paramétre
            if (idOfferParam === parseInt(idOffer)) {
                let imageDivContent = '<div id="'+imageDivContentId+'">';
                for (let i = 0; i < imageData.length; i++) {
                    //let image = '<img style="height: 100px; width: 100px;" src="'+ imageData[i]['url_image'] +'" class="m-1 image-to-edit '+ imgTagClassName +'" alt="'+ imageData[i]['name_image'] +'" data-id="'+ imageData[i]['id_image'] +'"/>';
                    let image = '<img src="'+ imageData[i]['url_image'] +'" class="m-1 image-to-edit '+ imgTagClassName +'" alt="'+ imageData[i]['name_image'] +'" data-id="'+ imageData[i]['id_image'] +'"/>';
                    imageDivContent += image;
                }
                imageDivContent += '</div>';
                $(divId).html();
                $(divId).append(imageDivContent);
                // On appelle la fonction permettant de récupérer l'ID de l'image à supprimer
                if (editImage)
                    getIdOfImageToEdit();
            }
        }
    }

    let idOfferToDelete;
    // Bouton de suppresion d'une image
    // Ouverture du modal permettant de supprimer une offre
    $(".offerDeleteBtn").click(function () {
        idOfferToDelete = parseInt($(this).data('id'));
        document.getElementById("deleteOfferMessage").innerHTML = "Êtes vous sûr de vouloir supprimer l'offre numéro" + " " + idOfferToDelete + " " + " ?";
        $("#offerDeleteModal").appendTo("body").modal('show');
    });

    // Suppression de l'offre selectionnée par son Id
    $("#deleteOfferForm").submit(function (e) {
        e.preventDefault();
        deleteOfById(idOfferToDelete);
    });

    // Fermeture du modal permettant de supprimer une offre
    $(".deleteOfferCancelBtn").click(function () {
        $("#offerDeleteModal").modal('hide');
    });

    /**
     * Suppression d'une offre par son Id
     * @param idOfferParam
     */
    function deleteOfById(idOfferParam) {
        $.ajax({
            type: 'POST',
            url: 'deleteOfferByIdWithAJAX',
            data: "offerId=" + idOfferParam,
            dataType: 'json',
            success: function (response) {
                let offerId = parseInt(response.offerId);
                document.getElementById(offerId).remove();
                $("#offerDeleteModal").modal('hide');
            }
        });
    }
});

/**
 *
 * @type {HTMLElement}
 */
let formBtnSubmitID = document.getElementById('btnSubmit');

/**
 * Regex
 * @type {RegExp}
 */
let regexIntAndFloat = /^(?![0,]+$)\d+(\,\d{1,2})?$/;
let regexOnlyIntAndLetters = /^[A-Za-z0-9\sàâçéèêëîïôûùüÿñæœ',]*$/;
let regexOnlyInt = /^[1-9]\d*$/;
let regexOnlyLetters = /^[A-Za-z\sàâçéèêëîïôûùüÿñæœ',]*$/;
let regexOnlyLettersDescription = /^[A-Za-z0-9\sàâçéèêëîïôûùüÿñæœ.',]*$/;

/**
 * Message of errors
 * @type {string}
 */
let timeErrorMessage = 'Saisir la durée du contrat';
let countryErrorMessage = 'Saisir le pays';
let cityErrorMessage = 'Indiquer la ville';
let postalCodeErrorMessage = 'Saisir le code postal';
let addressErrorMessage = 'Indiquer la localisation';
let piecesErrorMessage = 'Indiquer le nombre de pièces';
let areaErrorMessage = 'Indiquer la surface en m2';
let priceErrorMessage = 'Saisir le montant du loyé';
let descriptionMessage = 'Veuillez saisir une petite description de votre offre de location';

/**
 * This function is called in the php script for the input field validation
 * @param inputField
 * @param inputStatusNotificationFieldId
 * @param regexApply
 * @param errorMessage
 */
function inputFieldValidation(inputField, inputStatusNotificationFieldId, regexApply, errorMessage) {
    let inputStatusNotificationField = document.getElementById(inputStatusNotificationFieldId);
    if (inputField.value !== '' && !verifyIfFieldValueContainOnlySpaces(inputField.value)) {
        if (inputField.value.match(regexApply)) {
            displayInputFieldValidationStatus(inputField, inputStatusNotificationField, '', 'Saisie Correcte', 'green');
            formBtnSubmitID.disabled = false;
        } else {
            formBtnSubmitID.disabled = true;
            displayInputFieldValidationStatus(inputField, inputStatusNotificationField, '2px solid red', "Saisie incorrecte", 'red');
        }
    }
    if (inputField.value === '' || verifyIfFieldValueContainOnlySpaces(inputField.value)) {
        formBtnSubmitID.disabled = true;
        displayInputFieldValidationStatus(inputField, inputStatusNotificationField, '2px solid red', errorMessage, 'red');
    }
}


/**
 * Count number of spaces in input value
 * @param fieldValue
 * @returns {number}
 */
function calculateNumberOfSpaces(fieldValue) {
    let numberOfSpaces = 0;
    for (let i = 0; i < fieldValue.length; i++) {
        if (fieldValue[i] === " ") {
            numberOfSpaces += 1;
        }
    }
    return numberOfSpaces;
}

/**
 * Verify if input field value contain only spaces
 * @param fieldValue
 * @returns {boolean}
 */
function verifyIfFieldValueContainOnlySpaces(fieldValue) {
    return calculateNumberOfSpaces(fieldValue) === fieldValue.length;
}

/**
 * This function allows to display date input field validation status notification
 * @param inputField
 * @param inputNotification
 * @param border
 * @param textContent
 * @param color
 */
function displayInputFieldValidationStatus(inputField, inputNotification, border, textContent, color) {
    inputField.style.border = border;
    inputNotification.textContent = textContent;
    inputNotification.style.color = color;
}

/**
 * Date input field validation
 */
$('#offerAvailable').on('change', function(){
    let offerAvailableInputField = document.getElementById("offerAvailable");
    let inputStatusNotificationField = document.getElementById('offerAvailableError');
    let dateInput = new Date($('#offerAvailable').val());
    let dateValidator = new Date();
    if(dateInput.getMonth() < dateValidator.getMonth() && dateInput.getFullYear() === dateValidator.getFullYear()) {
        formBtnSubmitID.disabled = true;
        displayInputFieldValidationStatus(offerAvailableInputField, inputStatusNotificationField,'2px solid red', 'Mois invalide', 'red');
    } else if (dateInput.getFullYear() < dateValidator.getFullYear()) {
        formBtnSubmitID.disabled = true;
        displayInputFieldValidationStatus(offerAvailableInputField, inputStatusNotificationField,'2px solid red', 'Année invalide', 'red');
    } else if (dateInput.getDate() < dateValidator.getDate() && dateInput.getFullYear() === dateValidator.getFullYear() && dateInput.getMonth() === dateValidator.getMonth()) {
        formBtnSubmitID.disabled = true;
        displayInputFieldValidationStatus(offerAvailableInputField, inputStatusNotificationField,'2px solid red', 'Date invalide', 'red');
    } else {
        formBtnSubmitID.disabled = false;
        displayInputFieldValidationStatus(offerAvailableInputField, inputStatusNotificationField,'', 'Date Valide', 'green');
    }
});

/**
 *
 * @type {string[]}
 */
let imageExtensions = ['image/jpeg', 'image/jpg', 'image/png'];
/**
 * Image input field validation
 */
$('#offerImage').on('change', function(){
    let offerImage = document.getElementById("offerImage");
    let inputStatusNotificationField = document.getElementById("offerImageError");
    let count = 0;
    for (let i = 0; i < this.files.length; i++) {
        let image = this.files[i];
        let imageType = image.type;
        if (imageExtensions.includes(imageType))
            count = count + 1;
    }
    if (count !== this.files.length) {
        formBtnSubmitID.disabled = true;
        displayInputFieldValidationStatus(offerImage, inputStatusNotificationField, '2px solid red', 'Seules les extensions jpg, jpeg et png sont autorisées', 'red');
    } else {
        let numberTotalOfImagesFromDatabase = parseInt(document.getElementById("numberTotalOfImagesFromDatabase").value);
        let countNewImages = document.getElementById("newImages").value;
        countNewImages = count;
        let countImagesToDelete = parseInt(document.getElementById("numberOfImagesToDelete").value);
        let countImagesAccepted = (numberTotalOfImagesFromDatabase - countImagesToDelete) + parseInt(countNewImages);
        console.log("countImagesAccepted : ", countImagesAccepted);

       if (countImagesAccepted >= 4 && countImagesAccepted <= 10) {
            console.log("numberTotalOfImagesFromDatabase : ", numberTotalOfImagesFromDatabase);
            console.log("countNewImages : ", countNewImages);
            console.log("countImagesToDelete : ", countImagesToDelete);
            formBtnSubmitID.disabled = false;
            displayInputFieldValidationStatus(offerImage, inputStatusNotificationField, '', 'Images Valides', 'green');
        } else {
            formBtnSubmitID.disabled = true;
            displayInputFieldValidationStatus(offerImage, inputStatusNotificationField, '2px solid red', "Le nombre d'image est invalide", 'red');
        }

    }
});


