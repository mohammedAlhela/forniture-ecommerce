<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


use App\Models\Expense;


class CalcExpenseTotalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $expenses = Expense::all();





        foreach ($expenses as $expense) {
            $expense->total =
            (int)$expense->employment_offer +
            (int)$expense->transfer_work_permit_application +
            (int)$expense->pre_approval_typing +
            (int)$expense->work_permit_pre_approval_fee +
            (int)$expense->work_permit_information_update +
            (int)$expense->employment_visa +
            (int)$expense->change_work_status +
            (int)$expense->status_delay_fine +
            (int)$expense->employment_contract +
            (int)$expense->employment_renewal +
            (int)$expense->labour_card_renewal +
            (int)$expense->work_permit_application +
            (int)$expense->id_registration +
            (int)$expense->pre_visa_medical +
            (int)$expense->daman_document_preparation +
            (int)$expense->daman_insurance_delay +
            (int)$expense->insurance_delay_fee +
            (int)$expense->passport_charge +
            (int)$expense->residency +
            (int)$expense->residency_delay_fine ;

            $expense->save();
        }
    }
}
