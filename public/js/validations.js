var valida = true; //Bandera que uso para saber si valido o no

//Funcion que me permite validar un formulario de movimiento
//que se encuentra dentro de un modal.
function validar_movimiento(){
    //Limpio el formulario de errores.
    clear_errores();

    //Cargo en constantes los campos obligatorios del formulario.
    let fecha = document.getElementById('account-date').value;
    let monto = document.getElementById('monto').value;

    //Compruebo que fecha no este vacio. Si lo esta, marco la bandera
    //como false, cargo el error en el panel de errores y marco el
    //input como error.
    if(fecha.length == 0){
        valida = false;
        add_error_message("El campo 'Fecha' no debe estar vacío.");
        document.getElementById('account-date').classList.add('error');
    }

    //Hago lo mismo con el campo monto.
    if(monto.length == 0){
        valida = false;
        add_error_message("El campo 'Monto' no debe estar vacío.");
        document.getElementById('monto').classList.add('error');
    }

    if(!valida){
        $('.errores').toggle(500);
    }
}

//Funcion que carga un mensaje de error en el
//panel de errores.
function add_error_message(message){
    let li = document.createElement('li');
    li.innerHTML = message;
    document.getElementById('error-list').appendChild(li);
}

//Funcion que limpia los errores. Cierra el panel errores y saca
//los adornos de errores de los input.
function clear_errores(){
    document.getElementById('error-panel').style.display = 'none';

    valida = true;
    document.getElementById("error-list").innerHTML = "";

    document.getElementById('account-date').classList.remove('error');
    document.getElementById('monto').classList.remove('error');
}
