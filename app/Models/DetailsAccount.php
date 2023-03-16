<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailsAccountsType;

class DetailsAccount extends Model
{
    use HasFactory;

    //Funcion con la que obtengo el tipo de movimiento desde la base de datos.
    public function detail_account_type(): hasOne{
        return $this->hasOne(DetailsAccountsType::class, 'id', 'id_detail_type');
    }
}
