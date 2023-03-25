$( document ).ready(function() {
    //Funcion que se llama al abrir el modal de Ingresar Dinero.
    $("#ingresarDineroModal").on('show.bs.modal', function(e){
        //Obtengo el id de la cuenta desde donde fue llamado.
        let id_account = $(e.relatedTarget).data('account-id');

        //Por medio de AJAX, busco en el controlador la cuenta, la traigo
        //mediante JSON y cargo sus valores en el modal.
        $.ajax({
            type: "GET",
            url: '/accounts/' + id_account,
            dataType: "JSON",
            success: function(account){
                document.getElementById('id-account').value = account.id;
                document.getElementById('account-name').innerHTML = account.nombre;
                document.getElementById('account-type').innerHTML = account.account_type.nombre;
                document.getElementById('account-money-symbol').innerHTML = account.account_type.simbolo;
                document.getElementById('money-symbol').innerHTML = account.account_type.simbolo;
                document.getElementById('account-total').innerHTML = format_money(account.total);
            }
        });
    });
});

//Funcion que permite dar formato a un numero, de manera que se muestre como dinero.
function format_money(value){
    let formatting_options = {
        style: 'decimal',
        minimumFractionDigits: 2,
    }
    let formatter = new Intl.NumberFormat("es-AR", formatting_options);

    return formatter.format(value);
}

//Funncion que agrega un movimiento en la tabla previa a que sean almacenados.
function agregar_movimiento(){
    validar_movimiento();
}
