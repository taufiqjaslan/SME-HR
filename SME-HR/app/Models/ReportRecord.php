<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportRecord extends Model
{
    use HasFactory;

    protected $table = 'leave_reports';

    protected $fillable = [
        'user_id',
        'leave_type_id',
        'days_remaining',
        'leave_pending',
        'leave_taken',
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
