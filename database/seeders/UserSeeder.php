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
            'code'=>'0001',
            'name'=>'SAUL SANTAMARIA',
            'email'=>'saul@alpama.com',
            'role_id'=>1,
            'company_id'=>1,
            'office_id'=>1,
            'area_id'=>1,
            'password'=>bcrypt('123456789'),
        ])->assignRole('SUPERADMIN');
        User::create([
            'code'=>'0002',
            'name'=>'SAUL SANTAMARIA',
            'email'=>'ssantamaria@prisma.com',
            'role_id'=>3,
            'company_id'=>2,
            'office_id'=>1,
            'area_id'=>3,
            'password'=>bcrypt('123456789'),
        ])->assignRole('Soporte');
        User::create([
            'code'=>'0003',
            'name'=>'PAOLO ROJAS',
            'email'=>'projas@prisma.com',
            'role_id'=>3,
            'company_id'=>2,
            'office_id'=>1,
            'area_id'=>3,
            'password'=>bcrypt('123456789'),
        ])->assignRole('Soporte');
        
        #User::factory(1)->create();
    }
}
