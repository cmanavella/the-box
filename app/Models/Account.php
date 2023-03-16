<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\AccountsTypes;
use App\Models\DetailsAccount;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Account extends Model
{
    use HasFactory;

    protected function total(): Attribute
    {
        $total = 0;

        //Recorro los movimientos relacionados si es que tiene.
        if($this->details->count() > 0){
            foreach($this->details as $detail){
                //consulto si el movimiento debita. En base a eso hago el calculo
                if($detail->detail_account_type->is_debit){
                    $total -= $detail->monto;
                }else{
                    $total += $detail->monto;
                }
            }
        }

        return Attribute::make(
            get: fn ($value) => $total,
        );
    }

    //Funcion con la que obtengo todos los movimientos de la cuenta y los ordeno por fecha desc.
    public function details(): hasMany{
        return $this->hasMany(DetailsAccount::class, 'id_account', 'id')->orderBy('fecha', 'desc');
    }

    //Funcion con la que obtengo el tipo de cuenta desde la base de datos.
    public function account_type(): hasOne{
        return $this->hasOne(AccountsTypes::class, 'id', 'id_account_type');
    }
}
