$("#numberOfImage").on("keyup click", function () {
    var numberOfImageToAd = $(this).val();
    var fileInput = "";
    for (var i = 0; i < numberOfImageToAd; i++) {
        fileInput += "<input type='File' class='form-control-file mt-2' name='offerImage"+i+"' id='offerImage"+i+"'/>"
    }
    $("#addImage").html(fileInput);
})


$(document).ready(function () {
    setTimeout(function () {
        $("#alert").alert('close');
    }, 5000);
});
