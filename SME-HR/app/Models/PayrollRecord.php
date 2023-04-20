<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollRecord extends Model
{
    use HasFactory;

    protected $table = 'salaries';

    public function employee()
    {
        return $this->belongsTo(EmployeeRecord::class, 'user_id');
    }

    public function salaryType()
    {
        return $this->hasOne(PayrollRecord::class, 'id', 'salary_type_id')
            ->leftjoin('salary_types', 'salary_types.id', '=', 'salaries.salary_type_id')
            ->select('salary_types.amount');
    }
}
