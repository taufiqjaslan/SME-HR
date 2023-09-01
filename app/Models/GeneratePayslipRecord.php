<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneratePayslipRecord extends Model
{
    use HasFactory;

    protected $table = 'generate_payslips';

    protected $fillable = [
        'user_id',
        'basic_salary',
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
        'year',
        'month',
    ];

    public function employee()
    {
        return $this->belongsTo(EmployeeRecord::class, 'user_id');
    }
}
