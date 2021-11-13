<?php
ob_start();
?>


<div class="container">
    <div class="row justify-content-center mt-5 p-2">
        <div class="card shadow mt-5 p-2">
            <h3 class="">Mes Informations Personnelles <i class='bx bxs-message-square-edit userEditIcon'></i></h3>
            <div class="border-top mt-2 p-2">
                <p class="name_user"><?php echo $_SESSION['name_user']; ?>
                </p>
                <p class="email_user"><?php echo $_SESSION['email_user']; ?>
                </p>
            </div>
        </div>
    </div>
</div>


<!-- user change password  form -->
<div class="modal fade userEditModal p-2" id="userEditModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userEditModalTitle">Changement de mot de passe</h5>
            </div>
            <div class="notificationMessage p-2"></div>
            <form id="userEditForm" class="userEditForm">
            <div class="modal-body">
                    <div class="mb-3">
                        <input type="password" class="form-control" id="currentPassword" name="currentPassword"
                               placeholder="nouveau mot de passe"
                               onkeyup="inputFieldValidation(this, 'currentPasswordError', regexPassword, passwordValidMessage, currentPasswordErrorMessage)"
                        >
                        <span class="error mb-1" id="currentPasswordError"></span>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="newPassword" name="newPassword"
                                placeholder="confirmation du mot de passe"
                               onkeyup="inputFieldValidation(this, 'newPasswordError', regexPassword, passwordValidMessage, newPasswordErrorMessage)"
                        >
                        <span class="error mb-1" id="newPasswordError"></span>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="newPasswordConfirmation" name="newPasswordConfirmation"
                               placeholder="confirmation du mot de passe"
                               onkeyup="inputFieldValidation(this, 'newPasswordConfirmationError', regexPassword, passwordValidMessage, newPasswordConfirmationErrorMessage)"
                        >
                        <span class="error mb-1" id="newPasswordConfirmationError"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary userEditCancelBtn"
                                data-bs-dismiss="modal">Annuler
                        </button>
                        <button type="submit" class="btn btn-primary" name="userEditFormSubmitBtn"
                                id="userEditFormSubmitBtn">
                            Mettre À Jour
                        </button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- user change password form -->


<!-- user change email and username  form -->
<div class="modal fade userEditEmailAndUsernameModal p-2" id="userEditEmailAndUsernameModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userEditEmailAndUsernameModalTitle">Modification d'Informations Personnelles</h5>
            </div>
            <div class="notificationMessage p-2"></div>
            <form id="userEditEmailAndUsernameModalForm" class="userEditEmailAndUsernameModalForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="newUsername" name="username"
                               placeholder="Saisir votre pseudo"
                               onkeyup="usernameInputFieldValidation(this, 'newUsernameError')"
                               value="<?= $_SESSION['name_user'] ?>"
                        >
                        <span class="error mb-1" id="newUsernameError"></span>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="newEmail" name="email"
                               placeholder="Renseigner un email"
                               onkeyup="emailInputFieldValidation(this, 'newEmailError')"
                               value="<?= $_SESSION['email_user'] ?>"
                        >
                        <span class="error mb-1" id="newEmailError"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary userEditEmailAndUsernameModalCancelBtn"
                                data-bs-dismiss="modal">ANNULER
                        </button>
                        <button type="submit" class="btn btn-primary" name="userEditEmailAndUsernameModalFormSubmitBtn"
                                id="userEditEmailAndUsernameModalFormSubmitBtn">
                            VALIDER
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- user change email and username  form -->

<script src="<?= URL ?>public/js/user.js"></script>

<?php
$contentView = ob_get_clean();
?>
