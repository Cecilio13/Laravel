<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HR_Company_payroll_computation_new_hire extends Model
{
    protected $primaryKey = 'new_hire_prorated_comp_id';
    protected $table = 'hr_payroll_new_hire_prorated_comp';
}
