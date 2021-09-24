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
                    let responseData = response.data;
                    /*

                    $("#offer-row").html();
                    let resultDiv = '<div class="col-md-4" id="offer-card">';
                    resultDiv += '<div class="card m-1">';

                    //**************************************************************************************************
                    let offerDisplayModal = "#offerDisplayModal" + responseData['id_offer'];
                    let offerEditModal = "#offerEditModal" + responseData['id_offer'];
                    console.log(offerDisplayModal, offerEditModal);
                    //**************************************************************************************************

                    let cardDiv = '<div class="card-header text-center">';
                    cardDiv += '<button class="btn btn-primary mr-1" data-toggle="modal" data-target="' + offerDisplayModal + '">' + 'Voir' + '</button>';
                    cardDiv += '<button class="btn btn-primary offer-edit-btn" data-toggle="modal" data-target="' + offerEditModal + '" data-id="'+ responseData['id_offer'] +'">' + 'Éditer' + '</button>';
                    cardDiv += '</div>';
                    resultDiv += cardDiv;

                    let resultUl = '<ul class="list-group list-group-flush">';
                    resultUl += '<li class="list-group-item">' + 'Loyé : ' + responseData['price_offer'] + '</li>';
                    resultUl += '<li class="list-group-item">' + 'Nb Pièces  : ' + responseData['pieces_offer'] + '</li>';
                    resultUl += '<li class="list-group-item">' + 'Pays : ' + responseData['country_offer'] + '</li>';
                    resultUl += '<li class="list-group-item">' + 'Ville : ' + responseData['city_offer'] + '</li>';
                    resultDiv += resultUl;
                    resultDiv += '</div>';
                    $('#offer-row').append(resultDiv);
                     */
                    $("#offerModal").modal('hide');
                } else {
                    $('.notificationMessage').html('<p class="alert alert-danger">'+response.message+'</p>');
                }
            }
        });
    });


    // Initialisation des variables
    let imagesToDelete = [];
    let offerId = 0;

    // Récupération des informations de l'offre à éditer à partir de son ID
    $(".offer-edit-btn").click(function () {
        imagesToDelete = [];
        let id_offer = $(this).data('id');
        offerId = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: 'getDataOfOfferWithAJAX',
            data: "offerId=" + id_offer,
            success: function (data) {
                let resData = JSON.parse(data);
                document.getElementById("offerCategory" + id_offer).value = resData['category_offer'];
                document.getElementById("offerPeople" + id_offer).value = resData['public_offer'];
                document.getElementById("offerTime" + id_offer).value = resData['contract_offer'];
                document.getElementById("offerAvailable" + id_offer).value = resData['availablity_offer'];
                document.getElementById("offerPieces" + id_offer).value = resData['pieces_offer'];
                document.getElementById("offerArea" + id_offer).value = resData['area_offer'];
                document.getElementById("offerPrice" + id_offer).value = resData['price_offer'];
                document.getElementById("offerCountry" + id_offer).value = resData['country_offer'];
                document.getElementById("offerCity" + id_offer).value = resData['city_offer'];
                document.getElementById("offerPostalCode" + id_offer).value = resData['postal_code_offer'];
                document.getElementById("offerAddress" + id_offer).value = resData['location_offer'];
                document.getElementById("offerDescription" + id_offer).value = resData['description_offer'];
            }
        });
    });


    // Gestion des images de l'offre
    $(".offer-edit-image").click(function () {
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
        let images_to_delete = document.getElementById("imagesToDelete" + offerId).value = imagesToDelete;
        console.log("imagesToDelete : " + images_to_delete);
    });


    // Édition d'une Offre par son ID
    $(".editOfferForm").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'editDataOfOfferWithAJAX',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                $('.editNotificationMessage').html('');
                if (response.status === 1) {
                    $('.editNotificationMessage').html('<p class="alert alert-success">'+response.message+'</p>');
                    console.log(response.data);
                    //$("#offerModal").modal('hide');
                } else {
                    $('.editNotificationMessage').html('<p class="alert alert-danger">'+response.message+'</p>');
                }
            }
        });
    });


    // Fermeture du Modal permettant d'éditer les informations d'une offre
    $(".editOfferCancelBtn").click(function () {
        $(".offerEditModal").modal('hide');
    });



});
