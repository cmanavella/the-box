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

/*
Funcion que agrega un movimiento en la tabla previa a que sean almacenados.
*/
function agregar_movimiento(){
    if (validar_movimiento()){
        //Si valida, cargo los campos del form en constantes.
        let fecha = document.getElementById('account-date');
        let monto = document.getElementById('monto');
        let observaciones = document.getElementById('observaciones');

        //Cargo el tbody de la tabla en una constante.
        let tbody = document.getElementById('tabla-movimientos').tBodies[0];

        //Tengo que armar un Table Row con los valores pasados.
        //Primero creo un objeto tr.
        let tr = document.createElement('tr');
        //Creo un objeto td para cada uno de los valores.
        let tdFecha = document.createElement('td');
        let tdMonto = document.createElement('td');
        let tdObservaciones = document.createElement('td');
        tdObservaciones.innerHTML = "";

        //Agrego el icono de eliminar el movimiento.
        let tdIcon = document.createElement('td');
        let a = document.createElement('a');
        a.classList.add('td-icon');
        a.onclick = function func(){
            eliminar_movimiento(this);
        };
        a.innerHTML = '<i class="fa-solid fa-trash"></i>';
        tdIcon.appendChild(a);
        tr.appendChild(tdIcon);

        //Dentro del objeto td, voy cargando un valor y luego cargo ese td al tr.
        tdFecha.innerHTML = format_date_to_show(fecha.value);
        tr.appendChild(tdFecha);

        tdMonto.innerHTML = format_money(monto.value);
        tr.appendChild(tdMonto);

        //Cargo observaciones solo si no esta vacio.
        if(observaciones.value.length > 0){
            tdObservaciones.innerHTML = observaciones.value;
        }
        tr.appendChild(tdObservaciones);

        tr.appendChild(tdIcon);

        //Una vez que tengo la fila lista, la agrego al tbody de la tabla.
        tbody.appendChild(tr);

        //Muestro la tabla, si no esta visible.
        let tabla = document.getElementById('tabla-movimientos');
        if(window.getComputedStyle(tabla).display === "none"){
            $('#tabla-movimientos').toggle(500);
        }

        //Borro los campos.
        fecha.value = "";
        monto.value = "";
        observaciones.value = "";
    }
}

/*
Funcion que elimina una fila de la tabla que coincide con la fila desde donde se
cliqueo con el boton de eliminar.
*/
function eliminar_movimiento(element){
    //Obtengo el elemento tr al cual pertenece el boton que llamo a esta funcion.
    let tr = element.parentElement.parentElement;
    tr.remove();

    //Compruebo que a la tabla no le quede ningunn elemento de tipo movimiento.
    //Si ya no le queda ninguno, oculto la tabla
    let tabla = document.getElementById('tabla-movimientos');
    let tbody = tabla.getElementsByTagName('tbody')[0];
    let trs = tbody.getElementsByTagName('tr');

    if(trs.length == 0){
        $('#tabla-movimientos').toggle(500);
    }
}

/*
Funcion que limpia los errores. Cierra el panel errores y saca
los adornos de errores de los input.
*/
function clear_errores(){
    document.getElementById('error-panel').style.display = 'none';

    valida = true;
    document.getElementById("error-list").innerHTML = "";

    document.getElementById('account-date').classList.remove('error');
    document.getElementById('monto').classList.remove('error');
}

/*
Funcion que se ejecuta al cerrar el modal
*/
function close_modal(){
    //Limpio el panel de errores.
    clear_errores();

    //Limpio la tabla de movimientos.
    let tabla = document.getElementById('tabla-movimientos');
    let tbody = tabla.getElementsByTagName('tbody')[0];
    tbody.innerHTML = "";

    //Oculto la tabla movimientos.
    tabla.style.display = 'none';
}
