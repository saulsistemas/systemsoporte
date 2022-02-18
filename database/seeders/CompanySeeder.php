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
        $company1->code = '123456';
        $company1->name = 'STM SOLUCIONES';
        $company1->address = 'SJDL AV LOS JARDINES';
        $company1->save();

        $company1= new Company();
        $company1->code = '20550045100';
        $company1->name = 'PRISMA TECNOCONSULTORES S.A.C.';
        $company1->address = 'JOSE NEYRA 262, CERCADO DE LIMA 15038';
        $company1->save();

        $company2= new Company();
        $company2->code = '20416074161';
        $company2->name = 'AMERICAN RENTA CAR S.A.C.';
        $company2->address = 'AV NICOLÁS ARRIOLA 555, LA VICTORIA 15034';
        $company2->save();

        $company2= new Company();
        $company2->code = '20547028253';
        $company2->name = 'AMERICA ORGANICA';
        $company2->address = 'JR. SAN AGUSTÍN 228 - SURQUILLO - LIMA';
        $company2->save();

        

    }
}
