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

        $area2 = new Area();
        $area2->name ='GERENCIA';
        $area2->company_id =2;
        $area2->save();

        $area2 = new Area();
        $area2->name ='SUBGERENCIA';
        $area2->company_id =2;
        $area2->save();

        $area2 = new Area();
        $area2->name ='SISTEMAS';
        $area2->company_id =2;
        $area2->save();

        $area2 = new Area();
        $area2->name ='LOGISTICA';
        $area2->company_id =2;
        $area2->save();

        $area2 = new Area();
        $area2->name ='ALMACÉN';
        $area2->company_id =2;
        $area2->save();
    }
}
