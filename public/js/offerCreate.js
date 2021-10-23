$(document).ready(function () {

    // Création d'une offre
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

    // Validation du formulaire de création d'offre
    let offerTimeIsValid = false;
    let offerPiecesIsValid = false;
    let offerAreaIsValid = false;
    let offerPriceIsValid = false;
    let offerCountryIsValid = false;
    let offerCityIsValid = false;
    let offerPostalCodeIsValid = false;
    let offerAddressIsValid = false;
    let offerDescriptionIsValid = false;

    addEventListener("load", function () {
        let formBtnSubmitID = document.getElementById('btnSubmit');
        formBtnSubmitID.disabled = true;
    });

    function disableFormBtnSubmit() {
        let formBtnSubmitID = document.getElementById('btnSubmit');
        formBtnSubmitID.disabled = true;
    }

    function displayFormBtnSubmit(offerTimeStatus, offerPiecesStatus, offerAreaStatus, offerPriceStatus, offerCountryStatus, offerCityStatus, offerPostalCodeStatus, offerAddressStatus, offerDescriptionStatus) {
        if (offerTimeStatus && offerPiecesStatus && offerAreaStatus && offerPriceStatus && offerCountryStatus && offerCityStatus && offerPostalCodeStatus && offerAddressStatus && offerDescriptionStatus) {
            let formBtnSubmitID = document.getElementById('btnSubmit');
            formBtnSubmitID.disabled = false;
        }
    }

    // Validation du username
    function inputOfferPiecesValidation(usernameInputFieldValue) {
        const regex = /^[A-Za-z_]+$/;
        let usernameErrorInputField = document.getElementById('usernameError');
        if (usernameInputFieldValue.value !== '') {
            if (usernameInputFieldValue.value.length >= 3) {
                if (usernameInputFieldValue.value.match(regex)) {
                    usernameErrorInputField.textContent = 'Pseudo valide';
                    usernameErrorInputField.style.color = 'green';
                    usernameIsValid = true;
                    displayFormBtnSubmit(usernameIsValid, emailIsValid, passwordIsValid, passwordConfirmationIsValid);
                } else {
                    disableFormBtnSubmit();
                    usernameErrorInputField.textContent = 'Seuls les lettres et le caractère tiré (-) sont autorisés';
                    usernameErrorInputField.style.color = 'red';
                }
            } else {
                disableFormBtnSubmit();
                usernameErrorInputField.textContent = 'Le pseudo doit avoir 3 caractères au minimum';
                usernameErrorInputField.style.color = 'red';
            }
        } else {
            disableFormBtnSubmit();
            usernameErrorInputField.textContent = 'Un pseudo est obligatoire';
            usernameErrorInputField.style.color = 'red';
        }
    }

});




