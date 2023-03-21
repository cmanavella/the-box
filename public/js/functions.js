$( document ).ready(function() {
    /*
    Funcion que muestra el detalle de la cuenta con una animacion.
    */
    $("[id^='info_button_']").click(function () {
        //Capturo el evento clic de los botones info_button y
        //extraigo de su id el id de cuenta
        var id_account = $(this).attr('id').replace('info_button_', '');

        //Muestro el detalle de la cuenta en base al id.
        $("#detail_account_" + id_account).toggle(500);
    });

    /*
    Funcion que muestra los csomentarios de un detalle con animacion.
    */
    $("[id^='detalle_']").click(function () {
        //Obtengo el id del detalle que se encuentra embebido en el id al cual hice clic.
        var id_detalle = $(this).attr('id').replace('detalle_', '');

        //muestro u oculto el detalle de la cuenta.
        $("#detail_comment_" + id_detalle).toggle(500);
    });

    /*
    Funcion que filtra la tabla de detalles de cuenta a medida
    que escribo con el teclado.
    */
    $("[id^='account_input_filter_']").on("keyup", function(){
        //Obtengo el id de la cuenta que se encuentra embebido
        //dentro del id del input en el que estoy escribiendo.
        id_account = $(this).attr('id').replace('account_input_filter_', '');

        //Almaceno en una variable el LowerCase de lo escrito.
        var value = $(this).val().toLowerCase();

        //Llamo a la funcion que filtra la tabla.
        filter_account_details(id_account, value);
    });

    /*
    Funcion que limpia el filtro de los detalles de una cuenta
    cuando se aprieta el boton de borrar.
    */
    $("[id^='clear_account_filter_button_']").click(function() {
        //Obtengo el id de la cuenta que se encuentra embebido
        //dentro del id del boton.
        id_account = $(this).attr('id').replace('clear_account_filter_button_', '');

        //Borro lo escrito en el input de filtro.
        document.getElementById("account_input_filter_" + id_account).value = "";

        //Llamo a la funcion que limpia la tabla, en este caso
        //le paso un valor de filtro vacio asi vuelve a su estado
        //natural.
        filter_account_details(id_account, '');
    });
});

/*
Funcion que filtra la tabla que pertenece a una cuenta y con
los valores pasados por parametros
*/
function filter_account_details(id_account, value){
    //Cierro todos los comentarios abiertos.
    close_comments(id_account);

    //Filtro la tabla, ocultando los elementos que no son necesario
    //mostrar.
    $("#account_table_" + id_account + " tr.tr_visible").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
}

/*
Funcion que cierra todos los comentarios de los detalles abiertos
que pertenecen al detalle desde donde fue llamada.
*/
function close_comments(id_account){
    //Obtengo los elementos de la tabla, es decir las filas.
    var elements = document.getElementById("account_table_" + id_account).children[1].children;

    //Los recorro uno a uno.
    for(let element of elements){
        //Si el elemento tiene asignada la clase "hidden" y
        //el display esta vacio, quiere decir que es un comentario
        //que se esta mostrando y debo cerrarlo.
        if(element.className == "hidden" && element.style.display != ""){
            element.style.display = 'none';
        }
    }
}
