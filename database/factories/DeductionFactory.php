<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Deduction;


class DeductionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Deduction::class;


    public function definition()
    {

        $deduction = $this->faker->numberBetween(1, 200) ;
        $salary_payments = $this->faker->numberBetween(1, 200) ;
        $bouns = $this->faker->numberBetween(1, 200) ;
        $total = $deduction + $salary_payments + $bouns ;
        return [
            'employee_id' => $this->faker->numberBetween(1, 20),

            'notes' => $this->faker->unique()->text(),

            'details' => $this->faker->unique()->text(),

            'date' => $this->faker->date(),

            'deduction' => $deduction,
            'salary_payments' => $salary_payments,
            'bouns' => $bouns,
            'total' => $total,



        ];
    }
}
