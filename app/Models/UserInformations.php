<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformations extends Model
{
    //
    protected $table = 'user_informations';

    protected $fillable = [
        'user_id',
        'relative_name',
        'relative_phone',
        'address',
        'image',
        'gender',
        'date_of_birth',
        'marital_status',
        'blood_group',
        'religion',
        'nationality',
        'nid',
        'cv',
        'joining_date',
        'designation',
        'employee_id',
    ];
}
