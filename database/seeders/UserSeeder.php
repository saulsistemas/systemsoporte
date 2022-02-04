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
            'name'=>'Saul Santamaria',
            'email'=>'saul@alpama.com',
            'password'=>bcrypt('123456789'),
        ])->assignRole('Admin');
        User::create([
            'name'=>'Claudio Santamaria',
            'email'=>'Claudio@hotmail.com',
            'password'=>bcrypt('123456789'),
        ])->assignRole('Soporte');
        User::factory(1)->create();
    }
}
