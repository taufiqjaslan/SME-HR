<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimTypeRecord extends Model
{
    use HasFactory;

    protected $table = 'claim_types';

    protected $fillable = [
        'name',
    ];

}
