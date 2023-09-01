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
        'ic',
        'start_date',
        'end_date',
        'position_id',
        'basic_salary',
        'bank_name',
        'account_number',
        'user_type_id',
        'status',
    ];


    public function userType()
    {
        return $this->belongsTo(UserTypeRecord::class);
    }

    public function position()
    {
        return $this->belongsTo(PositionRecord::class, 'position_id');
    }
}
