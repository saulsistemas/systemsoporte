<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $office1 = new Office();
        $office1->name = 'SURQUILLO';
        $office1->address = 'JOSE NEYRA 262, CERCADO DE LIMA 15038';
        $office1->company_id = 2;
        $office1->save();

        $office2 = new Office();
        $office2->name = 'YAULI';
        $office2->address = 'MINA YAULI';
        $office2->company_id = 3;
        $office2->save();

    
        $office3 = new Office();
        $office3->name = 'CERRO LINDO';
        $office3->address = 'CERRO LINDO AVD';
        $office3->company_id = 3;
        $office3->save();

        $office4 = new Office();
        $office4->name = 'ARRIOLA';
        $office4->address = 'AV NICOLÁS ARRIOLA 555, LA VICTORIA 15034';
        $office4->company_id = 3;
        $office4->save();

        $office4 = new Office();
        $office4->name = 'SURQUILLO';
        $office4->address = 'JR. SAN AGUSTÍN 228 - SURQUILLO - LIMA';
        $office4->company_id = 3;
        $office4->save();
        
    }
}
