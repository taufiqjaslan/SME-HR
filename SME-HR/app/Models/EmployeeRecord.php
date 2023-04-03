<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRecord extends Model
{
    use HasFactory;

    protected $table='users';

    protected $fillable = [
        'name',
        'username',
        'phone_number',
        'email',
        'password',
        'address',
        'gender',
        'start_date',
        'end_date',
        'position_id',
        'user_type_id',
        'status',
    ];
}
