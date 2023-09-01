<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EAFormRecord extends Model
{
    use HasFactory;

    protected $table = 'ea_forms';

    protected $fillable = [
        'user_id',
        'date',
        'year',
        'tax_num',
        'payroll_num',
        'epf_num',
        'kwsp_num',
        'start_date',
        'end_date',
        'children_num',
        'gross_salary',
        'fees',
        'gross_tip',
        'income_tax',
        'refund',
        'compensation',
        'pension',
        'annuities',
        'tax_deduction',
        'cp38_deduction',
        'zakat_deduction',
        'zakat',
        'child_relief',
        'amount',
        'socso',

    ];

    public function employee()
    {
        return $this->belongsTo(EmployeeRecord::class, 'user_id');
    }

    public function position()
    {
        return $this->employee->belongsTo(PositionRecord::class, 'position_id');
    }

}
