<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $fillable = ['name','project_id'];
    #relacion 1 a muchos inversa (PERTENECE A UNA PROJECTO)
    public function project(){
        return $this->belongsTo(Project::class);
    }
}
