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
        $area1->company_id =2;
        $area1->save();

        $area1 = new Area();
        $area1->name ='SUBGERENCIA';
        $area1->company_id =2;
        $area1->save();

        $area1 = new Area();
        $area1->name ='SISTEMAS';
        $area1->company_id =2;
        $area1->save();

        $area1 = new Area();
        $area1->name ='LOGISTICA';
        $area1->company_id =2;
        $area1->save();

        $area1 = new Area();
        $area1->name ='ALMACÉN';
        $area1->company_id =2;
        $area1->save();

        #ARC
        $area2 = new Area();
        $area2->name ='GERENCIA';
        $area2->company_id =3;
        $area2->save();

        $area2 = new Area();
        $area2->name ='SUBGERENCIA';
        $area2->company_id =3;
        $area2->save();

        $area2 = new Area();
        $area2->name ='COSTOS';
        $area2->company_id =3;
        $area2->save();

        $area2 = new Area();
        $area2->name ='LOGISTICA';
        $area2->company_id =3;
        $area2->save();

        $area2 = new Area();
        $area2->name ='ALMACÉN GENERAL';
        $area2->company_id =3;
        $area2->save();

        $area2 = new Area();
        $area2->name ='CONTABILIDAD';
        $area2->company_id =3;
        $area2->save();

        $area2 = new Area();
        $area2->name ='TESORERIA';
        $area2->company_id =3;
        $area2->save();

        $area2 = new Area();
        $area2->name ='ADMINISTRACION';
        $area2->company_id =3;
        $area2->save();

        $area2 = new Area();
        $area2->name ='MANTENIMIENTO';
        $area2->company_id =3;
        $area2->save();

        $area2 = new Area();
        $area2->name ='RESIDENCIA';
        $area2->company_id =3;
        $area2->save();

        $area2 = new Area();
        $area2->name ='SEGURIDAD';
        $area2->company_id =3;
        $area2->save();

        $area2 = new Area();
        $area2->name ='OPERACIONES';
        $area2->company_id =3;
        $area2->save();

        $area2 = new Area();
        $area2->name ='TALLER LIVIANOS';
        $area2->company_id =3;
        $area2->save();

        $area2 = new Area();
        $area2->name ='TALLER PESADO';
        $area2->company_id =3;
        $area2->save();

        $area2 = new Area();
        $area2->name ='RRHH';
        $area2->company_id =3;
        $area2->save();

        $area2 = new Area();
        $area2->name ='VENTAS';
        $area2->company_id =3;
        $area2->save();

        $area2 = new Area();
        $area2->name ='MARKETING';
        $area2->company_id =3;
        $area2->save();

        $area2 = new Area();
        $area2->name ='OTROS';
        $area2->company_id =3;
        $area2->save();

        #AREAS ORGANICA
        $area1 = new Area();
        $area1->name ='GERENCIA';
        $area1->company_id =4;
        $area1->save();

        $area1 = new Area();
        $area1->name ='SUBGERENCIA';
        $area1->company_id =4;
        $area1->save();

        $area1 = new Area();
        $area1->name ='CONTABILIDAD';
        $area1->company_id =4;
        $area1->save();

        $area1 = new Area();
        $area1->name ='LOGISTICA';
        $area1->company_id =4;
        $area1->save();

        $area1 = new Area();
        $area1->name ='ALMACÉN';
        $area1->company_id =4;
        $area1->save();

        $area1 = new Area();
        $area1->name ='VENTAS';
        $area1->company_id =4;
        $area1->save();

        $area1 = new Area();
        $area1->name ='ADMINISTRACION';
        $area1->company_id =4;
        $area1->save();

        $area1 = new Area();
        $area1->name ='MARKETING';
        $area1->company_id =4;
        $area1->save();

        $area1 = new Area();
        $area1->name ='OTROS';
        $area1->company_id =4;
        $area1->save();
    }
}
