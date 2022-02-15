<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    #relacion 1 a muchos (TIENE MUCHOS AREAS)
    public function areas(){
        return $this->hasMany(Area::class);
    }
    public function offices(){
        #relacion 1 a muchos (TIENE MUCHAS OFFICINAS)
        return $this->hasMany(Office::class);
    }
    public function projects(){
        #relacion 1 a muchos (TIENE MUCHOS PROYECTOS)
        return $this->hasMany(Project::class);
    }
}
