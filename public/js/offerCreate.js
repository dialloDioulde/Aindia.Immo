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
            } else {
                $('.notificationMessage').html('<p class="alert alert-danger">'+response.message+'</p>');
            }
        }
    });
});



