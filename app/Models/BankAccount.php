<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    //
    protected $table = 'bank_accounts';

    protected $fillable = [
        'user_id',
        'type',
        'bank_name',
        'branch_name',
        'account_holder_name',
        'account_number',
        'mobile_service_name',
        'mobile_number',
    ];
}
