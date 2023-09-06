$(document).ajaxStart(function () {
    $(".loader").show(); // Muestra el loader al inicio de una petición AJAX
});

$(document).ajaxStop(function () {
    $(".loader").hide(); // Oculta el loader al finalizar una petición AJAX
});
