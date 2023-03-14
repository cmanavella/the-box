<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\AccountsTypes;

class Account extends Model
{
    use HasFactory;

    //Funcion con la que obtengo el tipo de cuenta desde la base de datos.
    public function account_type(): hasOne{
        return $this->hasOne(AccountsTypes::class, 'id', 'id_account_type');
    }
}
