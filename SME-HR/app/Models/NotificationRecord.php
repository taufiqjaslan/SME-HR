<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationRecord extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'noti_type',
        'noti_text',
    ];

    public function employee()
    {
        return $this->belongsTo(EmployeeRecord::class, 'user_id');
    }
}
