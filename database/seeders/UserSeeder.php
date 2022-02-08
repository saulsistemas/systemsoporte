<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'SAUL SANTAMARIA',
            'email'=>'saul@alpama.com',
            'role_id'=>1,
            'office_id'=>1,
            'password'=>bcrypt('123456789'),
        ])->assignRole('Admin');
        User::create([
            'name'=>'CLAUDIO SANTAMARIA',
            'email'=>'Claudio@hotmail.com',
            'role_id'=>2,
            'office_id'=>1,
            'password'=>bcrypt('123456789'),
        ])->assignRole('Soporte');
        User::create([
            'name'=>'EMILY BERROA',
            'email'=>'santamariaramos18@hotmail.com',
            'role_id'=>3,
            'office_id'=>2,
            'password'=>bcrypt('123456789'),
        ])->assignRole('Cliente');
        #User::factory(1)->create();
    }
}
