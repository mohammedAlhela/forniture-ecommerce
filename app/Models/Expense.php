<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use DateTimeInterface;

class Expense extends Model
{
    use HasFactory;


    protected $fillable = [
        'employee_id',
        'notes',
        'total',
        "employment_offer",
        'transfer_work_permit_application',
        'pre_approval_typing',
        'work_permit_pre_approval_fee',
        'work_permit_information_update',
        'employment_visa',


        'change_work_status',
        'status_delay_fine',
        'employment_contract',
        'employment_renewal',
        'labour_card_renewal',
        'work_permit_application',

        'id_registration',
        'pre_visa_medical',
        'daman_document_preparation',
        'daman_insurance_delay',
        'insurance_delay_fee',
        'passport_charge',
        'residency',
        'residency_delay_fine',
    ];


    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updatd_at' => 'datetime:Y-m-d',
    ];






    protected function serializeDate(DateTimeInterface $date)
{
    return $date->format('Y-m-d');
}


public function employee(){
    return $this->belongsTo(Employee::class);
}

}
