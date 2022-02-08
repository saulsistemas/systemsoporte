<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company1= new Company();
        $company1->name = 'PRISMA';
        $company1->address = 'SURQUILLO 123';
        $company1->save();

        $company2= new Company();
        $company2->name = 'ARC SAC';
        $company2->address = 'AV ARRIOLA N 112';
        $company2->save();

        $company3= new Company();
        $company3->name = 'ALPAMA SAC';
        $company3->address = 'AV LIMA N 112';
        $company3->save();

    }
}
