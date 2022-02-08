<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;
    #relacion 1 a muchos inversa (PERTENECE A UNA EMPRESA)
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function users(){
        #relacion 1 a muchos (TIENE MUCHOS USUARIOS)
        return $this->hasMany(User::class);
    }
}
