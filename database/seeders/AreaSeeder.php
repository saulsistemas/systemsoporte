<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #AREAS
        $area1 = new Area();
        $area1->name ='GERENCIA';
        $area1->company_id =1;
        $area1->save();

        $area1 = new Area();
        $area1->name ='SUBGERENCIA';
        $area1->company_id =1;
        $area1->save();

        $area1 = new Area();
        $area1->name ='SISTEMAS';
        $area1->company_id =1;
        $area1->save();

        $area1 = new Area();
        $area1->name ='LOGISTICA';
        $area1->company_id =1;
        $area1->save();

        $area1 = new Area();
        $area1->name ='ALMACÉN';
        $area1->company_id =1;
        $area1->save();
    }
}
