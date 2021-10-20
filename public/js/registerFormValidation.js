// Validation du formulaire d'inscription

addEventListener("load", function () {
    let formBtnSubmitID = document.getElementById('btnSubmit');
    formBtnSubmitID.disabled = true;
});

function disableFormBtnSubmit() {
    let formBtnSubmitID = document.getElementById('btnSubmit');
    formBtnSubmitID.disabled = true;
}

let usernameIsValid = false;
let emailIsValid = false;
let passwordIsValid = false;
let passwordConfirmationIsValid = false;

function displayFormBtnSubmit(usernameStatus, emailStatus, passwordStatus, passwordConfirmationStatus) {
    if (usernameStatus && emailStatus && passwordStatus && passwordConfirmationStatus) {
        let formBtnSubmitID = document.getElementById('btnSubmit');
        formBtnSubmitID.disabled = false;
    }
}

// Validation du username
function inputUsernameValidation(usernameInputFieldValue) {
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

// Validation du champ email
function inputEmailValidation(emailInputFieldValue) {
    const regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let emailErrorInputField = document.getElementById('emailError');
    if (emailInputFieldValue.value !== '') {
        if (emailInputFieldValue.value.match(regex)) {
            emailErrorInputField.textContent = 'Email valide';
            emailErrorInputField.style.color = 'green';
            emailIsValid = true;
            displayFormBtnSubmit(usernameIsValid, emailIsValid, passwordIsValid, passwordConfirmationIsValid);
        } else {
            disableFormBtnSubmit();
            emailErrorInputField.textContent = "L'adresse email saisie est invalide";
            emailErrorInputField.style.color = 'red';
        }
    } else {
        disableFormBtnSubmit();
        emailErrorInputField.textContent = 'Un email est obligatoire';
        emailErrorInputField.style.color = 'red';
    }
}

// Validation du champ passwordConfirmation
function inputPasswordValidation(passwordInputFieldValue) {
    const regex = /^[a-zA-Z0-9-]+$/;
    let passwordErrorInputField = document.getElementById('passwordError');
    if (passwordInputFieldValue.value !== '') {
        if (passwordInputFieldValue.value.length >= 8) {
            if (!passwordInputFieldValue.value.match(regex)) {
                passwordErrorInputField.textContent = 'Mot de passe valide';
                passwordErrorInputField.style.color = 'green';
                passwordIsValid = true;
                displayFormBtnSubmit(usernameIsValid, emailIsValid, passwordIsValid, passwordConfirmationIsValid);
            } else {
                disableFormBtnSubmit();
                passwordErrorInputField.textContent = 'Le mot de passe doit avoir au moins un caractère spécial (?!;/%@_#)';
                passwordErrorInputField.style.color = 'red';
            }
        } else {
            disableFormBtnSubmit();
            passwordErrorInputField.textContent = 'Le mot de passe doit avoir 8 caractères au minimum';
            passwordErrorInputField.style.color = 'red';
        }
    } else {
        disableFormBtnSubmit();
        passwordErrorInputField.textContent = 'Mot de passe obligatoire';
        passwordErrorInputField.style.color = 'red';
    }
}

function inputPasswordConfirmationValidation(passwordConfirmationInputFieldValue) {
    let passwordInputFieldValue = document.getElementById('password');
    let passwordConfirmationErrorInputField = document.getElementById('passwordConfirmationError');
    if (passwordConfirmationInputFieldValue.value !== '') {
        if (passwordConfirmationInputFieldValue.value.length >= 8) {
            if (passwordConfirmationInputFieldValue.value === passwordInputFieldValue.value) {
                passwordConfirmationErrorInputField.textContent = 'Mot de passe confirmé';
                passwordConfirmationErrorInputField.style.color = 'green';
                passwordConfirmationIsValid = true;
                displayFormBtnSubmit(usernameIsValid, emailIsValid, passwordIsValid, passwordConfirmationIsValid);
            } else {
                disableFormBtnSubmit();
                passwordConfirmationErrorInputField.textContent = 'Les mots de passe ne correspondent pas';
                passwordConfirmationErrorInputField.style.color = 'red';
            }
        } else {
            disableFormBtnSubmit();
            passwordConfirmationErrorInputField.textContent = 'Le mot de passe doit avoir 8 caractères au minimum';
            passwordConfirmationErrorInputField.style.color = 'red';
        }
    } else {
        disableFormBtnSubmit();
        passwordConfirmationErrorInputField.textContent = 'Veuillez confirmer le mot de passe';
        passwordConfirmationErrorInputField.style.color = 'red';
    }
}



$(document).ready(function () {
    /*
    setTimeout(function () {
        $("#alert").alert('close');
    }, 5000);
     */
});
