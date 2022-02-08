<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategoy0 = new Subcategory();
        $subcategoy0->name ='LAPTOP';
        $subcategoy0->category_id =2;
        $subcategoy0->save();

        $subcategoy1 = new Subcategory();
        $subcategoy1->name ='DISCO';
        $subcategoy1->category_id =2;
        $subcategoy1->save();

        $subcategoy2 = new Subcategory();
        $subcategoy2->name ='PANTALLA';
        $subcategoy2->category_id =2;
        $subcategoy2->save();

        $subcategoy6 = new Subcategory();
        $subcategoy6->name ='DESCARGA';
        $subcategoy6->category_id =3;
        $subcategoy6->save();

        $subcategoy7 = new Subcategory();
        $subcategoy7->name ='INSTALACIÓN';
        $subcategoy7->category_id =3;
        $subcategoy7->save();

        $subcategoy8 = new Subcategory();
        $subcategoy8->name ='ACTUALIZACIÓN';
        $subcategoy8->category_id =3;
        $subcategoy8->save();

        $subcategoy9 = new Subcategory();
        $subcategoy9->name ='DESCARGA';
        $subcategoy9->category_id =4;
        $subcategoy9->save();

        $subcategoy10 = new Subcategory();
        $subcategoy10->name ='INSTALACIÓN';
        $subcategoy10->category_id =4;
        $subcategoy10->save();

        $subcategoy11 = new Subcategory();
        $subcategoy11->name ='ACTUALIZACIÓN';
        $subcategoy11->category_id =4;
        $subcategoy11->save();

    }
}
