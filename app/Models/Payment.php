<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    function getTypeNameAttribute()
    {
        switch ($this->type){
            case 'credit':
                return 'Crédito';
                break;
            case 'debit':
                return 'Débito';
                break;
            case 'voucher':
                return 'Voucher';
        }
    }
}
