<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use DB;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'username' => 'mohammed alhelal',
            'email' => 'mohamdalhelal7@gmail.com',
            'password' => Hash::make('Mohammed!@#123'),
            'status' => 1,
            'id' => 4,
        ]);

        DB::table('users')->insert([
            'username' => 'amer alhelal',
            'email' => 'amer@gmail.com',
            'password' => Hash::make('Amer!@#123'),
            'status' => 1,
            'id' => 5,
        ]);

        DB::table('users')->insert([
            'username' => 'alaa alhelal',
            'email' => 'alaa@gmail.com',
            'password' => Hash::make('Alaa!@#123'),
            'status' => 1,
            'id' => 6,
        ]);

    


    }
}
