// Offer creation
$("#createOfferForm").submit( function (e) {
    e.preventDefault();
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
let offerDateIsValid = false;

// Disable form submit button after loading page
let formBtnSubmitID = document.getElementById('btnSubmit');
addEventListener("load", function () {
    formBtnSubmitID.disabled = true;
});

// Display form submit button
function displayFormBtnSubmit() {
    if (offerTimeIsValid && offerPiecesIsValid && offerAreaIsValid && offerPriceIsValid && offerCountryIsValid && offerCityIsValid
        && offerPostalCodeIsValid && offerAddressIsValid && offerDescriptionIsValid && offerDateIsValid)
        formBtnSubmitID.disabled = false;
}

// Regex
const regexIntAndFloat = /^(?![0,]+$)\d+(\,\d{1,2})?$/;
const regexOnlyIntAndLetters = /^[A-Za-z0-9\sàâçéèêëîïôûùüÿñæœ',]*$/;
const regexOnlyInt = /^[1-9]\d*$/;
const regexOnlyLetters = /^[A-Za-z\sàâçéèêëîïôûùüÿñæœ',]*$/;

// Message of errors
let timeErrorMessage = 'Saisir la durée du contrat';
let countryErrorMessage = 'Saisir le pays';
let cityErrorMessage = 'Indiquer la ville';
let postalCodeErrorMessage = 'Saisir le code postal';
let addressErrorMessage = 'Indiquer la localisation';
let piecesErrorMessage = 'Indiquer le nombre de pièces';
let areaErrorMessage = 'Indiquer la surface en m2';
let priceErrorMessage = 'Saisir le montant du loyé';
let descriptionMessage = 'Veuillez saisir une petite description de votre offre de location';

// This function is called in the php script for the input field validation
function inputFieldValidation(inputField, inputStatusNotificationFieldId, regexApply, errorMessage) {
    let inputStatusNotificationField = document.getElementById(inputStatusNotificationFieldId);
    if (inputField.value !== '' && !verifyIfFieldValueContainOnlySpaces(inputField.value)) {
        if (inputField.value.match(regexApply)) {
            inputStatusNotificationField.textContent = 'Saisie Correcte';
            inputStatusNotificationField.style.color = 'green';
            inputField.style.border= '';
            fieldStatusValidation(inputStatusNotificationFieldId);
            displayFormBtnSubmit();
        } else {
            formBtnSubmitID.disabled = true;
            inputField.style.border = '2px solid red';
            inputStatusNotificationField.textContent = "Saisie incorrecte";
            inputStatusNotificationField.style.color = 'red';
        }
    }
    if (inputField.value === '' || verifyIfFieldValueContainOnlySpaces(inputField.value)) {
        formBtnSubmitID.disabled = true;
        inputField.style.border = '2px solid red';
        inputStatusNotificationField.textContent = errorMessage;
        inputStatusNotificationField.style.color = 'red';
    }
}

// This function allows to set status of input field to Valid
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
    if (inputStatusNotificationFieldId === 'offerDescriptionError')
        offerDescriptionIsValid = true;
}


// Count number of spaces in input value
function calculateNumberOfSpaces(fieldValue) {
    let numberOfSpaces = 0;
    for (let i = 0; i < fieldValue.length; i++) {
        if (fieldValue[i] === " ") {
            numberOfSpaces += 1;
        }
    }
    return numberOfSpaces;
}

// Verify if input field value contain only spaces
function verifyIfFieldValueContainOnlySpaces(fieldValue) {
    return calculateNumberOfSpaces(fieldValue) === fieldValue.length;
}


// This function allows to display date input field validation status notification
function displayDateInputFieldValidationStatus(border, textContent, color) {
    let offerAvailableInputField = document.getElementById("offerAvailable");
    let inputStatusNotificationField = document.getElementById('offerAvailableError');
    formBtnSubmitID.disabled = true;
    offerAvailableInputField.style.border = border;
    inputStatusNotificationField.textContent = textContent;
    inputStatusNotificationField.style.color = color;
}

// Date input field validation
$('#offerAvailable').on('change', function(){
    let dateInput = new Date($('#offerAvailable').val());
    let dateValidator = new Date();
    if(dateInput.getMonth() < dateValidator.getMonth() && dateInput.getFullYear() === dateValidator.getFullYear()) {
        displayDateInputFieldValidationStatus('2px solid red', 'Mois invalide', 'red');
    } else if (dateInput.getFullYear() < dateValidator.getFullYear()) {
        displayDateInputFieldValidationStatus('2px solid red', 'Année invalide', 'red');
    } else if (dateInput.getDate() < dateValidator.getDate() && dateInput.getFullYear() === dateValidator.getFullYear() && dateInput.getMonth() === dateValidator.getMonth()) {
        displayDateInputFieldValidationStatus('2px solid red', 'Date invalide', 'red');
    } else {
        displayDateInputFieldValidationStatus('', 'Date Valide', 'green');
        offerDateIsValid = true;
        displayFormBtnSubmit();
    }
});


