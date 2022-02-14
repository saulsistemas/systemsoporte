<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #GESTION
        $category1 = new Category();
        $category1->name ='COMPRA';
        $category1->service_id =1;
        $category1->save();

        $category2 = new Category();
        $category2->name ='ENVIO';
        $category2->service_id =1;
        $category2->save();

        $category3 = new Category();
        $category3->name ='ASIGNACIÓN';
        $category3->service_id =1;
        $category3->save();

        $category4 = new Category();
        $category4->name ='COTIZACIÓN';
        $category4->service_id =1;
        $category4->save();

        $category5 = new Category();
        $category5->name ='RECEPCIÓN';
        $category5->service_id =1;
        $category5->save();

        $category6 = new Category();
        $category6->name ='OTROS';
        $category6->service_id =1;
        $category6->save();

        
        #REPARACION
        $category7 = new Category();
        $category7->name ='LAPTOP';
        $category7->service_id =2;
        $category7->save();

        $category8 = new Category();
        $category8->name ='PC';
        $category8->service_id =2;
        $category8->save();

        $category9 = new Category();
        $category9->name ='IMPRESORA';
        $category9->service_id =2;
        $category9->save();

        $category10 = new Category();
        $category10->name ='SCANER';
        $category10->service_id =2;
        $category10->save();

        $category11 = new Category();
        $category11->name ='TV';
        $category11->service_id =2;
        $category11->save();

        $category12 = new Category();
        $category12->name ='CELULAR';
        $category12->service_id =2;
        $category12->save();

        $category13 = new Category();
        $category13->name ='MONITOR';
        $category13->service_id =2;
        $category13->save();

        $category14 = new Category();
        $category14->name ='TECLADO';
        $category14->service_id =2;
        $category14->save();

        $category15 = new Category();
        $category15->name ='MOUSE';
        $category15->service_id =2;
        $category15->save();

        $category16 = new Category();
        $category16->name ='TABLET';
        $category16->service_id =2;
        $category16->save();

        $category17 = new Category();
        $category17->name ='PARLANTE';
        $category17->service_id =2;
        $category17->save();

        $category18 = new Category();
        $category18->name ='OTROS';
        $category18->service_id =2;
        $category18->save();

        #SOPORTE
        $category19 = new Category();
        $category19->name ='OFFICE';
        $category19->service_id =3;
        $category19->save();

        $category20 = new Category();
        $category20->name ='WINDOWS';
        $category20->service_id =3;
        $category20->save();

        $category21 = new Category();
        $category21->name ='ANYDESK';
        $category21->service_id =3;
        $category21->save();
    }
}
