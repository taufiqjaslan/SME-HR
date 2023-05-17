<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EAFormRecord extends Model
{
    use HasFactory;

    protected $table = 'ea_forms';

    public function employee()
    {
        return $this->belongsTo(EmployeeRecord::class, 'user_id');
    }

    public function position()
    {
        return $this->employee->belongsTo(PositionRecord::class, 'position_id');
    }
}
