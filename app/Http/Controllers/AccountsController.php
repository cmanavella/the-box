<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountsController extends Controller
{
    public function index(){
        //Obtengo todas las cuentas de la base de datos.
        $accounts = Account::all();

        /*foreach ($accounts as $account){
            $account->total = PublicFunctions::calculateTotal();
        }*/

        //Devuelvo la vista de todas las cuentas, pasandoselas por parametro.
        return view('accounts.resumen', ['accounts' => $accounts]);
    }
}
