<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project1 = new Project();
        $project1->name = "PROYECTO ARC";
        $project1->description ="Proyecto de Mesa dde ayuda en ARC SOPORTE TECNICO";
        $project1->start =now();
        $project1->company_id = 2;
        $project1->save();

        $project2 = new Project();
        $project2->name = "PROYECTO ALPAMA";
        $project2->description ="Proyecto de Mesa dde ayuda en ALPAMA SOPORTE TECNICO";
        $project2->start =now();
        $project2->company_id = 3;
        $project2->save();

        $project3 = new Project();
        $project3->name = "PROYECTO SOLGAS";
        $project3->description ="Proyecto de Mesa dde ayuda en SOLGAS SOPORTE TECNICO";
        $project3->start =now();
        $project3->company_id = 4;
        $project3->save();
    }
}
