<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Expense::class;

    public function definition()
    {
        return [

            'employee_id' => $this->faker->numberBetween(1, 20),
            'notes' => $this->faker->unique()->text(),
            'employment_offer' => $this->faker->numberBetween(1, 200),
            'transfer_work_permit_application' => $this->faker->numberBetween(1, 200),
            'pre_approval_typing' => $this->faker->numberBetween(1, 200),
            'work_permit_pre_approval_fee' => $this->faker->numberBetween(1, 200),
            'work_permit_information_update' => $this->faker->numberBetween(1, 200),
            'employment_visa' => $this->faker->numberBetween(1, 200),
            'change_work_status' => $this->faker->numberBetween(1, 200),
            'status_delay_fine' => $this->faker->numberBetween(1, 200),
            'employment_contract' => $this->faker->numberBetween(1, 200),
            'employment_renewal' => $this->faker->numberBetween(1, 200),
            'labour_card_renewal' => $this->faker->numberBetween(1, 200),
            'work_permit_application' => $this->faker->numberBetween(1, 200),
            'id_registration' => $this->faker->numberBetween(1, 200),
            'pre_visa_medical' => $this->faker->numberBetween(1, 200),
            'daman_document_preparation' => $this->faker->numberBetween(1, 200),
            'daman_insurance_delay' => $this->faker->numberBetween(1, 200),
            'insurance_delay_fee' => $this->faker->numberBetween(1, 200),
            'passport_charge' => $this->faker->numberBetween(1, 200),
            'residency' => $this->faker->numberBetween(1, 200),
            'residency_delay_fine' => $this->faker->numberBetween(1, 200),

        ];
    }
}
