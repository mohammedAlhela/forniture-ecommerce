<?php

namespace App\Exports;

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ExpenseExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        $expenses = Expense::where('employee_id', $this->id)->get();
        foreach ($expenses as $expense) {
            $expense->employee_id = $expense->employee->first_name . ' ' . $expense->employee->last_name;
        }
        return $expenses ;
    }

    public function headings(): array
    {
        return [
            'Addmission',
            'employee',
            'Notes',
            'Total',
            'employment_offer',
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
            'created_at',
            'updated_at', 
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
