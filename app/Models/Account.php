<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\AccountsTypes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Account extends Model
{
    use HasFactory;

    protected function total(): Attribute
    {
        $total = 1000*2;
        return Attribute::make(
            get: fn ($value) => $total,
        );
    }

    //Funcion con la que obtengo el tipo de cuenta desde la base de datos.
    public function account_type(): hasOne{
        return $this->hasOne(AccountsTypes::class, 'id', 'id_account_type');
    }
}
