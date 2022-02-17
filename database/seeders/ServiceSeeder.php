<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service1 = new Service();
        $service1->name ="GESTIONES";
        $service1->save();

        $service2 = new Service();
        $service2->name ="REPARACIÓN-CAMBIOS";
        $service2->save();

        $service3 = new Service();
        $service3->name ="SOPORTE TÉCNICO";
        $service3->save();

        $service4 = new Service();
        $service4->name ="MANTENIMIENTOS";
        $service4->save();

        $service5 = new Service();
        $service5->name ="INSTALACIONES";
        $service5->save();

        $service6 = new Service();
        $service6->name ="OTROS";
        $service6->save();
    }
}
