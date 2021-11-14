/**
 * CHANGE USER PASSWORD
 */
$(".userEditIcon").click(function () {
    formBtnSubmitID.disabled = true;
    $('.notificationMessage').html('');
    $(".userEditModal").appendTo("body").modal('show');
});

$(".userEditForm").submit(function (e) {
    e.preventDefault();
    let spanTags = document.getElementsByClassName("error");
    for (const spanTag of spanTags) {
        spanTag.textContent = " ";
    }
    $.ajax({
        type: 'POST',
        url: 'changeUserPassword',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (response) {
            $('.notificationMessage').html('');
            if (response.status === 1) {
                $('.notificationMessage').html('<p class="alert alert-success">'+response.message+'</p>');
                $(".userEditForm")[0].reset();
                formBtnSubmitID.disabled = true;
            } else {
                $('.notificationMessage').html('<p class="alert alert-danger">'+response.message+'</p>');
            }
        }
    });
});

$(".userEditCancelBtn").click(function () {
    $(".userEditModal").modal('hide');
});


/**
 *
 * @type {HTMLElement}
 */
let formBtnSubmitID = document.getElementById('userFormSubmitBtn');

/**
 * Regex
 * @type {RegExp}
 */
const regexEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
const regexPassword = /^[a-zA-Z0-9-]+$/;
const regexUsername = /^[A-Za-z_]+$/;

/**
 * Notification Message
 * @type {string}
 */
let passwordValidMessage = 'Saisie correcte';
let passwordConfirmationValidMessage = 'Mot de passe confirmé';
let passwordInvalidMessage = 'Le mot de passe doit avoir au moins un caractère spécial (?!;/%@_#)';
let passwordLengthErrorMessage = 'Le mot de passe doit avoir 8 caractères au minimum';

let registerPasswordErrorMessage = "Veuillez saisir votre mot de passe";
let currentPasswordErrorMessage = 'Veillez saisir votre mot de passe actuel';
let newPasswordErrorMessage = 'Veuillez saisir votre nouveau mot de passe';
let newPasswordConfirmationErrorMessage = 'Veuillez confirmer votre mot de passe';

/**
 * This function is called in the php script for the input field validation
 * @param inputField
 * @param inputStatusNotificationFieldId
 * @param regexApply
 * @param passwordValidMessage
 * @param passwordInvalidMessage
 */
function inputFieldValidation(inputField, inputStatusNotificationFieldId, regexApply, passwordValidMessage, passwordInvalidMessage) {
    let inputStatusNotificationField = document.getElementById(inputStatusNotificationFieldId);
    if (inputField.value !== '' && !verifyIfFieldValueContainOnlySpaces(inputField.value))  {
        if (inputField.value.length >= 8) {
            if (!inputField.value.match(regexApply)) {
                displayFieldValidNotification(inputField, inputStatusNotificationFieldId, inputStatusNotificationField, passwordValidMessage);
            } else {
                manageFieldValueStatus(inputStatusNotificationFieldId);
                displayInputFieldValidationStatus(inputField, inputStatusNotificationField, '', 'Le mot de passe doit avoir au moins un caractère spécial (?!;/%@_#)', 'red');
                formBtnSubmitID.disabled = true;
            }
        }
        if (inputField.value.length < 8) {
            manageFieldValueStatus(inputStatusNotificationFieldId);
            displayInputFieldValidationStatus(inputField, inputStatusNotificationField, '', 'Le mot de passe doit avoir 8 caractères au minimum', 'red');
            formBtnSubmitID.disabled = true;
        }
    }
    if (inputField.value === '' || verifyIfFieldValueContainOnlySpaces(inputField.value)) {
        manageFieldValueStatus(inputStatusNotificationFieldId);
        displayInputFieldValidationStatus(inputField, inputStatusNotificationField, '', passwordInvalidMessage, 'red');
        formBtnSubmitID.disabled = true;
    }
}

/**
 * This function is called in the php script for the input field validation
 * @param inputField
 * @param inputStatusNotificationFieldId
 * @param inputStatusNotificationField
 * @param passwordValidMessage
 */
function displayFieldValidNotification(inputField, inputStatusNotificationFieldId, inputStatusNotificationField, passwordValidMessage) {
    if (inputStatusNotificationFieldId === 'newPasswordConfirmationError') {
        if (inputField.value === document.getElementById("newPassword").value) {
            displayInputFieldValidationStatus(inputField, inputStatusNotificationField, '', passwordConfirmationValidMessage, 'green');
            fieldStatusValidation(inputStatusNotificationFieldId);
            displayFormBtnSubmit();
        } else {
            manageFieldValueStatus(inputStatusNotificationFieldId);
            displayInputFieldValidationStatus(inputField, inputStatusNotificationField, '', "Les mots de passes ne correspondent pas", 'red');
            formBtnSubmitID.disabled = true;
        }
    } else {
        displayInputFieldValidationStatus(inputField, inputStatusNotificationField, '', passwordValidMessage, 'green');
        fieldStatusValidation(inputStatusNotificationFieldId);
        displayFormBtnSubmit();
    }
}

/**
 * Validate password confirmation field value when password field value change
 * @type {HTMLElement}
 */
let newPassword = document.getElementById("newPassword");
newPassword.addEventListener("keydown", function () {
    formBtnSubmitID.disabled = true;
    confirmationIsValid = false;
    document.getElementById("newPasswordConfirmation").value = "";
    document.getElementById("newPasswordConfirmationError").textContent = "";
});


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
 * This function allows to display form input field validation status notification
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
 *
 * @type {boolean}
 */
let currentPasswordIsValid = false;
let newPasswordIsValid = false;
let confirmationIsValid = false;

/**
 *
 * @param inputStatusNotificationFieldId
 */
function fieldStatusValidation(inputStatusNotificationFieldId) {
    if (inputStatusNotificationFieldId === 'currentPasswordError')
        currentPasswordIsValid = true;
    if (inputStatusNotificationFieldId === 'newPasswordError')
        newPasswordIsValid = true;
    if (inputStatusNotificationFieldId === 'newPasswordConfirmationError')
        confirmationIsValid = true;
}

function manageFieldValueStatus(inputStatusNotificationFieldId) {
    if (inputStatusNotificationFieldId === 'currentPasswordError')
        currentPasswordIsValid = false;
    if (inputStatusNotificationFieldId === 'newPasswordError')
        newPasswordIsValid = false;
    if (inputStatusNotificationFieldId === 'newPasswordConfirmationError')
        confirmationIsValid = false;
}


/**
 * Display form submit button
 */
function displayFormBtnSubmit() {
    if (currentPasswordIsValid && newPasswordIsValid && confirmationIsValid)
        formBtnSubmitID.disabled = false;
}

/**
 * UPDATE USERNAME AND EMAIL
 */
$(".name_user").click(function () {
    $('.notificationMessage').html('');
    $(".userEditEmailAndUsernameModal").appendTo("body").modal('show');
});

$(".userEditEmailAndUsernameModalCancelBtn").click(function () {
    $(".userEditEmailAndUsernameModal").modal('hide');
});

let emailAndUsernameSubmitBtn = document.getElementById("userEditEmailAndUsernameModalFormSubmitBtn");

/**
 * Username input field validation
 * @param inputField
 * @param inputStatusNotificationFieldId
 */
function usernameInputFieldValidation(inputField, inputStatusNotificationFieldId) {
    emailAndUsernameSubmitBtn.disabled = true;
    let inputStatusNotificationField = document.getElementById(inputStatusNotificationFieldId);
    if (inputField.value !== '' && !verifyIfFieldValueContainOnlySpaces(inputField.value)) {
        if (inputField.value.length >= 3) {
            if (inputField.value.match(regexUsername)) {
                displayInputFieldValidationStatus(inputField, inputStatusNotificationField, '', "Pseudo valide", 'green');
                emailAndUsernameSubmitBtn.disabled = false;
            } else
                displayInputFieldValidationStatus(inputField, inputStatusNotificationField, '', 'Seules les lettres et le caractère tiré (_) sont autorisés', 'red');
        }
        if (inputField.value.length < 3)
            displayInputFieldValidationStatus(inputField, inputStatusNotificationField, '', 'Le pseudo doit avoir 3 caractères au minimum', 'red');
    }
    if (inputField.value === '' || verifyIfFieldValueContainOnlySpaces(inputField.value))
        displayInputFieldValidationStatus(inputField, inputStatusNotificationField, '', 'Un pseudo est obligatoire', 'red');
}


/**
 * Email input field validation
 * @param inputField
 * @param inputStatusNotificationFieldId
 */
function emailInputFieldValidation(inputField, inputStatusNotificationFieldId) {
    emailAndUsernameSubmitBtn.disabled = true;
    let inputStatusNotificationField = document.getElementById(inputStatusNotificationFieldId);
    if (inputField.value !== '' && !verifyIfFieldValueContainOnlySpaces(inputField.value)) {
        if (inputField.value.match(regexEmail)) {
            displayInputFieldValidationStatus(inputField, inputStatusNotificationField, '', 'Email valide', 'green');
            emailAndUsernameSubmitBtn.disabled = false;
        } else
            displayInputFieldValidationStatus(inputField, inputStatusNotificationField, '', "L'adresse email saisie est invalide", 'red');
    }
    if (inputField.value === '' || verifyIfFieldValueContainOnlySpaces(inputField.value))
        displayInputFieldValidationStatus(inputField, inputStatusNotificationField, '', 'Un email est obligatoire', 'red');
}


$(".userEditEmailAndUsernameModalForm").submit(function (e) {
    e.preventDefault();
    let spanTags = document.getElementsByClassName("error");
    for (const spanTag of spanTags) {
        spanTag.textContent = " ";
    }
    $.ajax({
        type: 'POST',
        url: 'updateUserEmailAndUsername',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (response) {
            $('.notificationMessage').html('');
            if (response.status === 1) {
                $('.notificationMessage').html('<p class="alert alert-success">'+response.message+'</p>');
                $(".userEditForm")[0].reset();
            } else {
                $('.notificationMessage').html('<p class="alert alert-danger">'+response.message+'</p>');
            }
        }
    });
});
