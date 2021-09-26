$(document).ready(function () {
    // Ouverture du modal pour accéder au formulaire de création des offres
    $("#offerModalBtn").click(function () {
        $("#createOfferModal").modal('show');
    });

    // Fermeture du modal permettant de créer une offre
    $("#cancelBtn").click(function () {
        $("#createOfferModal").modal('hide');
    });

    // Récupérer un utilisateur par son Id
    function getUserById(idUserParam) {
        $.ajax({
            type: 'POST',
            url: 'getUserByIdWithAJAX',
            data: "userId=" + idUserParam,
            success: function (data) {
                let resData = JSON.parse(data);
                let userDataArray = [];
                userDataArray.push(resData['id_user']);
                userDataArray.push(resData['name_user']);
                userDataArray.push(resData['email_user']);
            }
        });
    }

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
                console.log(data);
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
                //document.getElementById("d_offerDescription").innerHTML = offerData['description_offer'];
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

    // Initialisation des variables
    let imagesToDelete = [];
    let displayImage = true;

    // Récupération des informations de l'offre à éditer à partir de son ID
    $(".offer-edit-btn").click(function () {
        imagesToDelete = [];
        let id_offer = $(this).data('id');
        getEditOfferDataById(id_offer);
        getImagesOfOfferById(id_offer);
        $("#offerEditModal").modal('show');
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

    // Récupération des données d'une offre par son ID
    function getEditOfferDataById(idOffer) {
        $.ajax({
            type: 'POST',
            url: 'getDataOfOfferWithAJAX',
            data: "offerId=" + idOffer,
            success: function (data) {
                let resData = JSON.parse(data);
                $('#offerId').val(resData['id_offer']);
                $('#e_offerCategory').val(resData['category_offer']);
                $('#e_offerPeople').val(resData['public_offer']);
                $('#e_offerTime').val(resData['contract_offer']);
                $('#e_offerAvailable').val(resData['availablity_offer']);
                $('#e_offerPieces').val(resData['pieces_offer']);
                $('#e_offerArea').val(resData['area_offer']);
                $('#e_offerPrice').val(resData['price_offer']);
                $('#e_offerCountry').val(resData['country_offer']);
                $('#e_offerCity').val(resData['city_offer']);
                $('#e_offerPostalCode').val(resData['postal_code_offer']);
                $('#e_offerAddress').val(resData['location_offer']);
                $('#e_offerDescription').val(resData['description_offer']);
            }
        });
    }

    let displayEditOfferImagesDivContentId = document.getElementById("displayImages");
    let displayOfferImagesDivContentId = document.getElementById("offerImagesDisplay");
    // Récupération des images d'une offre par son Id
    function getImagesOfOfferById(idOfferParam) {
        $.ajax({
            type: 'POST',
            url: 'getImagesOfOfferByIdWithAJAX',
            data: "offerId=" + idOfferParam,
            success: function (data) {
                let resData = JSON.parse(data);
                let idOffer = resData.offerId
                let imageData = resData.imageData;
                let offer_edit_image = "offer-edit-image-" + idOffer;
                let displayImageTagClassName = document.getElementsByClassName(offer_edit_image);
                let image_div_content_id = "image-div-content-id-" + idOffer;
                // On vérifie qu'aucune image de l'offre séléctionnée n'est déjà affichée
                // Pour éviter d'afficher une nouvelle fois les images déjà affichées lors du premier clic
                displayImagesOfOfferById(offer_edit_image, displayImageTagClassName, image_div_content_id,
                    idOfferParam, imageData, idOffer, displayEditOfferImagesDivContentId);
            }
        });
    }


    // Affichage des images d'une offre par son ID
    function displayImagesOfOfferById(imgTagClassName, countImgTagClassName, imageDivContentId, idOfferParam, imageData,
                                      idOffer, divId)
    {
        if (countImgTagClassName.length === 0) {
            console.log(countImgTagClassName.length);
            // On supprime toutes les images déjà ajoutées dans la DIV (displayEditOfferImagesDivContentId, affichant les images)
            while(divId.firstChild) {
                divId.removeChild(divId.firstChild);
            }
            // On réaffiche les images de l'offre dont l'ID est passé en paramétre
            if (idOfferParam === parseInt(idOffer)) {
                let imageDivContent = '<div id="'+imageDivContentId+'">';
                for (let i = 0; i < imageData.length; i++) {
                    console.log(imageData[i]);
                    console.log(imageData[i]['id_image']);
                    let image = '<img src="'+ imageData[i]['url_image'] +'" class="m-1 '+ imgTagClassName +'" alt="'+ imageData[i]['name_image'] +'" data-id="'+ imageData[i]['id_image'] +'" style="width: 130px; height: 100px;"/>';
                    imageDivContent += image;
                }
                imageDivContent += '</div>';
                console.log(divId);
                $(divId).html();
                $(divId).append(imageDivContent);
            }
        }
    }

    // Gestion des images de l'offre
    $(".offer-edit-image").click(function () {
        let image_id_from_database = $(this).data('id');
        console.log(image_id_from_database + 'test');

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
        let images_to_delete = document.getElementById("imagesToDelete").value = imagesToDelete;
        //console.log("imagesToDelete : " + images_to_delete);
    });

    // Fermeture du Modal permettant d'éditer les informations d'une offre
    $(".editOfferCancelBtn").click(function () {
        console.log("test");
        // On supprime toutes les images déjà ajoutées dans la DIV (displayEditOfferImagesDivContentId, affichant les images)
        while(displayEditOfferImagesDivContentId.firstChild) {
            displayEditOfferImagesDivContentId.removeChild( displayEditOfferImagesDivContentId.firstChild);
        }
        $(".offerEditModal").modal('hide');
    });

});
