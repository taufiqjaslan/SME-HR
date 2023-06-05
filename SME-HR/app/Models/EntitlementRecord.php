<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntitlementRecord extends Model
{
    use HasFactory;

    protected $table = 'leave_entitlements';

    protected $fillable = [
        'user_id',
        'leave_type_id',
        'valid_from',
        'valid_to',
        'leave_assign',
    ];

    public function leaveType()
    {
        return $this->belongsTo(LeaveTypeRecord::class, 'leave_type_id');
    }

    public function employee()
    {
        return $this->belongsTo(EmployeeRecord::class, 'user_id');
    }
}
