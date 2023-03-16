$( document ).ready(function() {
    var enterRow = false; //Bandera para mostrar el detalle del comentario o no.

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

    /*
    Funcion que muestra los csomentarios de un detalle con animacion.
    */
    $("[id^='detalle_']").click(function () {
        //Obtengo el id del detalle que se encuentra embebido en el id al cual hice clic.
        var id_detalle = $(this).attr('id').match(/[\d]/);

        //Uso la bandera antes de aplicar el Toggle ya que por alguna razon se hace un doble clic
        //que muestra y luego esconde el elemento que pretendo mostrar.
        if(!enterRow){
            $("#detail_comment_" + id_detalle).toggle(500);
            enterRow = true;
        }else{
            enterRow=false;
        }
    });
});
