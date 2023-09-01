<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTypeRecord extends Model
{
    use HasFactory;

    protected $table = 'user_types';

    public function userType()
    {
        return $this->belongsTo(UserTypeRecord::class, 'user_type_id');
    }
}
