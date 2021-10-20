$(document).ready(function () {
    // Ouverture du modal pour accéder au formulaire de création des offres
    $("#offerModalBtn").click(function () {
        $("#createOfferModal").modal('show');
    });

    // Fermeture du modal permettant de créer une offre
    $("#cancelBtn").click(function () {
        $("#createOfferModal").modal('hide');
    });

    // Création d'une offre
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
                    location.reload();
                    $("#offerModal").modal('hide');
                } else {
                    $('.notificationMessage').html('<p class="alert alert-danger">'+response.message+'</p>');
                }
            }
        });
    });

    // Affichage des informations d'une offre à partir de son ID
    // Ouverture du modal présentant les informations d'une offre
    $(".offer-display-btn").click(function () {
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
        $("#offerDisplayModal").modal('show');
    });

    // Récupération des informations de l'offre à éditer à partir de son ID
    $(".offer-edit-btn").click(function () {
        imagesToDelete = [];
        $(".editNotificationMessage").html("");
        let id_offer = $(this).data('id');
        let offer_edit_modal = "#offerEditModal" + id_offer;
        $(offer_edit_modal).modal('show');
        offerIdToDeleteImages = id_offer;
    });

    // Édition du statut d'une Offre par son ID
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

    // Initialisation des variables
    let offerIdToDeleteImages = 0;
    let imagesToDelete = [];
    let displayOfferImagesDivContentId = document.getElementById("offerImagesDisplay");

    // Gestion des images de l'offre
    $(".edit-image").click(function (e) {
        e.preventDefault();
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
        document.getElementById("imagesToDelete" + offerIdToDeleteImages).value = imagesToDelete;
    });

    // Affichage des images d'une offre par son ID
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
                    let image = '<img src="'+ imageData[i]['url_image'] +'" class="m-1 image-to-edit '+ imgTagClassName +'" alt="'+ imageData[i]['name_image'] +'" data-id="'+ imageData[i]['id_image'] +'"/>';
                    imageDivContent += image;
                }
                imageDivContent += '</div>';
                $(divId).html();
                $(divId).append(imageDivContent);
            }
        }
    }

    // Fermeture du Modal permettant d'éditer les informations d'une offre
    $(".editOfferCancelBtn").click(function () {
        imagesToDelete = []
        $(".offerEditModal").modal('hide');
    });

    let idOfferToDelete = 0;
    // Bouton de suppresion d'une image
    // Ouverture du modal permettant de supprimer une offre
    $(".offerDeleteBtn").click(function () {
        idOfferToDelete = parseInt($(this).data('id'));
        document.getElementById("deleteOfferMessage").innerHTML = "Êtes vous sûr de vouloir supprimer l'offre numéro" + " " + idOfferToDelete + " " + " ?";
        $("#offerDeleteModal").modal('show');
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

    // Suppression d'une offre par son Id
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
