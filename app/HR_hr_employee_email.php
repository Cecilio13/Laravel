<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HR_hr_employee_email extends Model
{
    protected $primaryKey = 'email_address_id';
    protected $table = 'hr_employee_email_address';
}
