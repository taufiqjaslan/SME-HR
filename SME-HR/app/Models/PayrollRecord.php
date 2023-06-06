<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollRecord extends Model
{
    use HasFactory;

    protected $table = 'salaries';

    protected $fillable = [
        'user_id',
        'kwsp_staff',
        'kwsp_company',
        'socso_staff',
        'socso_company',
        'eis_staff',
        'eis_company',
        'zakat',
        'deduction',
        'allowance',
        'bonus',
        'netpay',
    ];

    public function employee()
    {
        return $this->belongsTo(EmployeeRecord::class, 'user_id');
    }

}
