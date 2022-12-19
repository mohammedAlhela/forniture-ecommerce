<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class EmployeeExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    public function collection()
    {
        return Employee::all();
    }

    public function headings(): array
    {
        return [

            'Admission',
            'First name',
            'Last name',

            'Employee type',
            'Email',
            'Phone number',
            'Nationality',
            'Gender',
            'Date of birth',

            'local mobile number',
            'local address',
            'Emergency number',
            'Emergency contact name',
            'Passport number',

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

            'salary_transportation',
            'salary_accommodation',
            'total_salary',


            'date_of_leaving',
            'reason_of_leaving',

            'Created at',
            'Updated At', 
            'Image batch'

        ];
    }

    // ...

    /**
     * @return array
     */
    public function registerEvents(): array

    {

        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont('arial')->setSize(16);
            },

        ];
    }
}
