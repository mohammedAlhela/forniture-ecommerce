<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use DateTimeInterface;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [

        'first_name',
        'last_name',
        'email',
        'phone_number',
        'employee_type',
        'nationality',
        'gender',
        'date_of_birth',
        'local_mobile_number',
        'local_address',
        'emergency_number',
        'emergency_contact_name',
        'passport_number',
        'passport_expiry_date',
        'residency_number',
        'residency_expiry_date',
        'health_number',
        'health_renewal_date',
        'labour_contract',
        'labout_contract_issue_date',
        'labour_contract_expiry_date',
        'position',
        'position_date_of_joining',
        'position_branch_number',
        'based_at',
        'based_at_started_date',
        'based_at_current_status',
        'basic_salary',
        'total_salary' ,
        'salary_transportation',
        'salary_accommodation',
        'date_of_leaving',
        'reason_of_leaving',

    ];


    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updatd_at' => 'datetime:Y-m-d',
    ];






    protected function serializeDate(DateTimeInterface $date)
{
    return $date->format('Y-m-d');
}


public function expenses(){
    return $this->hasMany(Expense::class , 'employee_id'  , 'id');

}

public function deductions(){
    return $this->hasMany(Deduction::class , 'employee_id'  , 'id');
}

}
