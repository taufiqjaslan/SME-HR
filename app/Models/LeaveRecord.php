<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRecord extends Model
{
    use HasFactory;

    protected $table = 'leaves';

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'total_day',
        'leave_type_id',
        'detail',
        'attachment',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(EmployeeRecord::class, 'user_id');
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveTypeRecord::class, 'leave_type_id');
    }
}
