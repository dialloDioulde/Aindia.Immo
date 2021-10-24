// Offer creation
$("#createOfferForm").submit( function (e) {
    e.preventDefault();
    console.log($("#offerAvailable").val());
    $.ajax({
        type: 'POST',
        url: 'createOfferWithAJAX',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (response) {
            $('.notificationMessage').html('');
            if (response.status === 1) {
                $('.notificationMessage').html('<p class="alert alert-success">'+response.message+'</p>');
                $("#createOfferForm")[0].reset();
            } else {
                $('.notificationMessage').html('<p class="alert alert-danger">'+response.message+'</p>');
            }
        }
    });
});

// Input fields validation
let offerTimeIsValid = false;
let offerPiecesIsValid = false;
let offerAreaIsValid = false;
let offerPriceIsValid = false;
let offerCountryIsValid = false;
let offerCityIsValid = false;
let offerPostalCodeIsValid = false;
let offerAddressIsValid = false;
let offerDescriptionIsValid = false;

// Disable form submit button after loading page
let formBtnSubmitID = document.getElementById('btnSubmit');
addEventListener("load", function () {
    formBtnSubmitID.disabled = true;
});

// Regex
const regexIntAndFloat = /^(?![0,]+$)\d+(\,\d{1,2})?$/;
const regexOnlyIntAndLetters = /^[A-Za-z0-9\sàâçéèêëîïôûùüÿñæœ',]*$/;
const regexOnlyInt = /^[1-9]\d*$/;

// Message of errors
let timeErrorMessage = 'Saisir la durée du contrat';
let countryErrorMessage = 'Saisir le pays';
let cityErrorMessage = 'Indiquer la ville';
let postalCodeErrorMessage = 'Saisir le code postal';
let addressErrorMessage = 'Indiquer la localisation';
let piecesErrorMessage = 'Indiquer le nombre de pièces';
let areaErrorMessage = 'Indiquer la surface en m2';
let priceErrorMessage = 'Saisir le montant du loyé';

// This function is called in the php script for the input field validation
function inputFieldValidation(inputField, inputStatusNotificationFieldId, regexApply, errorMessage) {
    let inputStatusNotificationField = document.getElementById(inputStatusNotificationFieldId);
    if (inputField.value !== '') {
        if (inputField.value.match(regexApply)) {
            inputStatusNotificationField.textContent = 'Saisie Correcte';
            inputStatusNotificationField.style.color = 'green';
            inputField.style.border= '';
            fieldStatusValidation(inputStatusNotificationFieldId);
            if (offerTimeIsValid && offerPiecesIsValid && offerAreaIsValid && offerPriceIsValid && offerCountryIsValid && offerCityIsValid && offerPostalCodeIsValid && offerAddressIsValid)
                formBtnSubmitID.disabled = false;
        } else {
            formBtnSubmitID.disabled = true;
            inputField.style.border = '2px solid red';
            inputStatusNotificationField.textContent = "Saisie incorrecte";
            inputStatusNotificationField.style.color = 'red';
        }
    }
    if (inputField.value === '') {
        formBtnSubmitID.disabled = true;
        inputField.style.border = '2px solid red';
        inputStatusNotificationField.textContent = errorMessage;
        inputStatusNotificationField.style.color = 'red';
    }
}

// This function allow to set status of input field to Valid
function fieldStatusValidation(inputStatusNotificationFieldId) {
    if (inputStatusNotificationFieldId === 'offerTimeError')
        offerTimeIsValid = true;
    if (inputStatusNotificationFieldId === 'offerPiecesError')
        offerPiecesIsValid = true;
    if (inputStatusNotificationFieldId === 'offerAreaError')
        offerAreaIsValid = true;
    if (inputStatusNotificationFieldId === 'offerPriceError')
        offerPriceIsValid = true;
    if (inputStatusNotificationFieldId === 'offerCountryError')
        offerCountryIsValid = true;
    if (inputStatusNotificationFieldId === 'offerCityError')
        offerCityIsValid = true;
    if (inputStatusNotificationFieldId === 'offerPostalCodeError')
        offerPostalCodeIsValid = true;
    if (inputStatusNotificationFieldId === 'offerAddressError')
        offerAddressIsValid = true;
}
