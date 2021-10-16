<!-- Début : Affichage d'une Offre  -->
<div class="modal fade offerDisplayModal" id="offerDisplayModal" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="offerDisplayModalTitle">Informations de
                    l'Offre</h5>
            </div>
            <div class="modal-body">
                <!-- DÉBUT : Les Images de l'Offre -->
                <div class="row p-1" id="offerImagesDisplay">
                </div>
                <!-- FIN : Les Images de l'Offre  -->

                <!-- DÉBUT : Informations de l'Offre -->
                <div class="row mt-2 border-top">
                    <div class="col-md-4">
                        <h3 class="text-center">Caractéristiques</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" id="d_offerCategory"></li>
                            <li class="list-group-item" id="d_offerPrice"></li>
                            <li class="list-group-item" id="d_offerPieces">Nb Pièces</li>
                            <li class="list-group-item" id="d_offerArea">Surface (m2)</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3 class="text-center">Conditions</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" id="d_offerTime">Contrat</li>
                            <li class="list-group-item" id="d_offerAvailable">Disponibilité</li>
                            <li class="list-group-item" id="d_offerPeople">Locataire Souhaité</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3 class="text-center">Localisation</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" id="d_offerCity"></li>
                            <li class="list-group-item" id="d_offerPostalCode"></li>
                            <li class="list-group-item" id="d_offerAddress"></li>
                        </ul>
                    </div>
                </div>
                <!-- FIN : Informations de l'Offre -->

                <!-- DÉBUT : Auteur de l'Offre -->
                <div class="row mt-2 border-top">
                    <div class="col-md-4">
                        <h3 class="text-center">Auteur</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" id="d_offerOwnerName"></li>
                            <li class="list-group-item" id="d_offerOwnerEmail"></li>
                        </ul>
                    </div>
                </div>
                <!-- FIN : Auteur de l'Offre -->

                <!-- DÉBUT : Description de l'Offre -->
                <div class="row mt-2 border-top">
                    <div class="col-md-4">
                        <h3 class="text-center">Description</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" id="d_offerDescription"></li>
                        </ul>
                    </div>
                </div>
                <!-- FIN : Description de l'Offre -->

            </div>
        </div>
    </div>
</div>
<!-- Fin : Affichage d'une Offre  -->
