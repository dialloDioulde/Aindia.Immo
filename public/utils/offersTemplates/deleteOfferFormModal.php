<!-- Début : Suppression d'une Offre -->
<div class="modal fade offerDeleteModal p-2" id="offerDeleteModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="offerModalTitle">Suppression d'une Offre</h5>
            </div>
            <div class="modal-body">
                <form id="deleteOfferForm" class="deleteOfferForm" enctype="multipart/form-data">
                    <p id="deleteOfferMessage">Êtes vous sûr de vouloir supprimer l'offre ...</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary deleteOfferCancelBtn"
                                data-bs-dismiss="modal">Non
                        </button>
                        <button type="submit" class="btn btn-danger" name="deleteOfferFormSubmitBtn"
                                id="deleteOfferFormSubmitBtn">
                            Oui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin : Suppression d'une Offre -->
