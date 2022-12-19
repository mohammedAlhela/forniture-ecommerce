<?php

namespace Database\Factories;


use App\Models\Employee;


use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     *
     *
     */
    protected $model = Employee::class;

    public function definition()
    {


        $basic_salary = rand(1000,1500) ;
        $salary_transportation =  rand(200,300) ;
        $salary_accommodation =  rand(200,300) ;
         $total_salary = $basic_salary + $salary_accommodation + $salary_transportation  ;


        return [





            'first_name' => $this->faker->unique()->name(),

            'last_name' => $this->faker->unique()->name(),

            'email' =>  $this->faker->unique()->safeEmail(),


            'phone_number' => '05'. $this->faker->numerify('-###-####'),


            'employee_type' =>  $this->faker->randomElement(['Full_time', 'Temporary'])  ,

            'nationality' =>$this->faker->randomElement(['Egyptian', 'Cameroonian' , 'Filipino' , 'Indian' , 'Jordanian'   , 'Malian' , 'Syrian' , 'Pakistani' , 'Nigerian'])  ,

            'date_of_birth' => now(),

            'gender'  =>$this->faker->randomElement(['Male', 'Female'])  ,

            'local_mobile_number'  =>$this->faker->randomElement(['0967678', '09667'])  ,

            'local_address' =>   $this->faker->unique()->text(),

            'emergency_number'  =>$this->faker->randomElement(['876', '687866'])  ,


            'emergency_contact_name'  =>$this->faker->randomElement(['name_1', 'name_2'])  ,

            'passport_number'  =>$this->faker->randomElement(['8r7r7998565656', '8rku78998565656'])  ,


            'residency_number'  => $this->faker->randomElement(['56565757', '6675756'])  ,

            'residency_expiry_date'  => now ()  ,

            'passport_expiry_date'  => now ()  ,

            'health_number'  =>$this->faker->randomElement(['8r7r7998565656', '8rku78998565656'])  ,

            'health_renewal_date'  => now ()  ,


            'labour_contract'  => $this->faker->randomElement(['contract_1', 'contract_2'])  ,


            'labout_contract_issue_date'  => now ()  ,

            'labour_contract_expiry_date'  => now ()  ,


            'position'  =>$this->faker->randomElement(['Sales man', 'Sales manager' , 'General manager' , 'Graphic designer' , 'Finance manager'  , 'Accountact' , 'Administrator'])  ,

            'position_date_of_joining'  => now ()  ,


            'position_branch_number'  => $this->faker->randomElement(['Branch 1', 'Branch 2' , 'Branch 3', 'Branch 4' , 'Branch 5', 'Branch 6' , 'Branch 7', 'Branch 8' , 'Branch 9', 'Branch 10' , 'Dubai branch', 'Main branch'])  ,

            'based_at'  =>  $this->faker->randomElement(['Al Ain Phone HM', 'N 1 Sephora Al Ain' , 'Al Ain Phone Carrfour', 'N 1 Etisalat Al Ain' , 'Makani Mall Al Ain', 'A 1 Bawadi Mall' , 'Al Ghurair',

            'DFC Kiosk' , 'Merdif istyle', 'Jimi istyle' , 'Van', 'Midrif Kiosk' , 'Dalma Mall'  , 'Khaledia' , 'Abu Dhabi istyle' , 'Sahara style' , 'Oud Altoba'])  ,

            'based_at_started_date'  => now ()  ,

            'based_at_current_status'    => $this->faker->randomElement(['Terminated', 'Inactive' , 'Active' , 'On vacation'])  ,


            'date_of_leaving'  => now ()  ,

            'reason_of_leaving'  =>   $this->faker->unique()->text(),

            // 'basic_salary'  =>   $basic_salary ,
            // 'salary_transportation'  =>   $salary_transportation,
            // 'salary_accommodation'  =>   $salary_accommodation,
            // 'total_salary'  =>   $total_salary,

            // 'created_at' => $this->faker->dateTimeThisMonth()



        ];
    }
}
