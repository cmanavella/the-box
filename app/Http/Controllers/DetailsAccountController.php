<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailsAccount;
use App\Models\DetailsAccountsType;
use App\Models\Prueba;

class DetailsAccountController extends Controller{

    /*
    Funcion que permite agregar cualquier tipo de movimiento.
    Rompo la convencion de laravel al no hacer una funcion Store porque
    esta funcion es muy especifica de la App.
    */
    public function ajax_add_movimiento(Request $request){
        //Cuando se entra a esta funcion, los valores ya se encuentran validados
        //desde JS.
        $detalle = new DetailsAccount;

        $detalle->id_account = $request->id_account;
        $detalle->id_detail_type = $request->id_detail_type;
        $detalle->fecha = $request->fecha;
        $detalle->monto = $request->monto;
        $detalle->comments = $request->observaciones;

        $detalle->save();
    }
}
