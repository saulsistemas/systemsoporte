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
        $service1->name ="GESTIÓN";
        $service1->save();

        $service2 = new Service();
        $service2->name ="REPARACIÓN";
        $service2->save();

        $service3 = new Service();
        $service3->name ="SOPORTE";
        $service3->save();

        $service4 = new Service();
        $service4->name ="INSTALACIONES";
        $service4->save();

        $service5 = new Service();
        $service5->name ="OTROS";
        $service5->save();
    }
}
