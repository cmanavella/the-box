$( document ).ready(function() {
    /*
    Funcion que muestra el detalle de la cuenta con una animacion.
    */
    $("[id^='info_button_']").click(function () {
        //Capturo el evento clic de los botones info_button y
        //extraigo de su id el id de cuenta
        var id_account = $(this).attr('id').match(/[\d]/);

        //Muestro el detalle de la cuenta en base al id.
        $("#detalle_account_" + id_account).toggle(500);
    });
});
