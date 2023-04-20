<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimRecord extends Model
{
    use HasFactory;

    protected $table = 'claims';

    public function employee()
    {
        return $this->belongsTo(EmployeeRecord::class, 'user_id');
    }

    public function claimType()
    {
        return $this->hasOne(ClaimRecord::class, 'id', 'claim_type_id')
            ->leftjoin('claim_types', 'claim_types.id', '=', 'claims.claim_type_id')
            ->select('claim_types.name');
    }
}
