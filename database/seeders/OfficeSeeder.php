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
        $office1->address = 'SUQUILLO 12345456';
        $office1->company_id = 1;
        $office1->save();

        $office2 = new Office();
        $office2->name = 'YAULI';
        $office2->address = 'MINA YAULI';
        $office2->company_id = 2;
        $office2->save();

    
        $office3 = new Office();
        $office3->name = 'CERRO LINDO';
        $office3->address = 'CERRO LINDO AVD';
        $office3->company_id = 2;
        $office3->save();

        $office4 = new Office();
        $office4->name = 'ARRIOLA';
        $office4->address = 'AV ARRIOLA';
        $office4->company_id = 2;
        $office4->save();
        
    }
}
