<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimRecord extends Model
{
    use HasFactory;

    protected $table = 'claims';

    protected $fillable = [
        'user_id',
        'claim_type_id',
        'date',
        'amount',
        'detail',
        'attachment',
        'start_time',
        'end_time',
        'start_date',
        'end_date',
        'status',
    ];


    public function employee()
    {
        return $this->belongsTo(EmployeeRecord::class, 'user_id');
    }

    public function claimType()
    {
        return $this->belongsTo(ClaimTypeRecord::class, 'claim_type_id');
    }
}
