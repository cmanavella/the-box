<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\AccountsTypes;

class AccountsController extends Controller
{
    public function index(){
        //Obtengo todas las cuentas de la base de datos.
        $accounts = Account::all();

        //Devuelvo la vista de todas las cuentas, pasandoselas por parametro.
        return view('accounts.resumen', ['accounts' => $accounts]);
    }

    public function show($id){
        //Obtengo la cuenta asociada al id pasado por parametro.
        $account = Account::find($id);

        //Por JSON no funciona Elocuent de laravfel, asique debo cargar
        //los modelos o funciones asociados a este modelo de forma manual.
        $account->account_type = $account->account_type->nombre;
        $account->total = $account->total;

        //Paso la cuenta codificada con JSON.
        return json_encode($account);
    }
}
