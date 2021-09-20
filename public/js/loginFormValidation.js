// Validation du formulaire de connexion

addEventListener("load", function () {
    let formBtnSubmitID = document.getElementById('btnSubmit');
    formBtnSubmitID.disabled = true;
});

function disableFormBtnSubmit() {
    let formBtnSubmitID = document.getElementById('btnSubmit');
    formBtnSubmitID.disabled = true;
}

let usernameIsValid = false;
let passwordIsValid = false;

function displayFormBtnSubmit(usernameStatus, passwordStatus) {
    if (usernameStatus && passwordStatus) {
        let formBtnSubmitID = document.getElementById('btnSubmit');
        formBtnSubmitID.disabled = false;
    }
}

// Validation du champ username
function loginInputUsernameValidation(usernameInputFieldValue) {
    let usernameErrorInputField = document.getElementById('usernameError');
    if (usernameInputFieldValue.value !== '') {
        if (usernameInputFieldValue.value.length >= 3) {
            usernameErrorInputField.textContent = 'Pseudo renseigné';
            usernameErrorInputField.style.color = 'green';
            usernameIsValid = true;
            displayFormBtnSubmit(usernameIsValid, passwordIsValid);
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

// Validation du champ password
function loginInputPasswordValidation(passwordInputFieldValue) {
    let passwordErrorInputField = document.getElementById('passwordError');
    if (passwordInputFieldValue.value !== '') {
        if (passwordInputFieldValue.value.length >= 8) {
            passwordErrorInputField.textContent = 'Mot de passe renseigné';
            passwordErrorInputField.style.color = 'green';
            passwordIsValid = true;
            displayFormBtnSubmit(usernameIsValid, passwordIsValid);
        } else {
            disableFormBtnSubmit();
            passwordErrorInputField.textContent = 'Le mot de passe doit avoir 8 caractères au minimum';
            passwordErrorInputField.style.color = 'red';
        }
    } else {
        disableFormBtnSubmit();
        passwordErrorInputField.textContent = 'Veuillez saisir un mot de passe';
        passwordErrorInputField.style.color = 'red';
    }
}


$(document).ready(function () {
    setTimeout(function () {
        $("#alert").alert('close');
    }, 10000);
});

