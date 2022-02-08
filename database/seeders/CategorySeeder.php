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
        $category1 = new Category();
        $category1->name ='COMPRA';
        $category1->service_id =1;
        $category1->save();

        $category2 = new Category();
        $category2->name ='LAPTOP';
        $category2->service_id =2;
        $category2->save();

        $category3 = new Category();
        $category3->name ='OFFICE';
        $category3->service_id =3;
        $category3->save();

        $category4 = new Category();
        $category4->name ='WINDOWS';
        $category4->service_id =3;
        $category4->save();

        $category5 = new Category();
        $category5->name ='ANYDESK';
        $category5->service_id =3;
        $category5->save();
    }
}
