<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveTypeRecord extends Model
{
    use HasFactory;

    protected $table = 'leave_types';

    protected $fillable = [
        'leave_name',
        'leave_days',
    ];
}


