<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name','description','start'];
    #relacion 1 a muchos inversa (PERTENECE A UNA EMPRESA)
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function levels(){
        #relacion 1 a muchos (TIENE MUCHOS LEVELES)
        return $this->hasMany(Level::class);
    }
}
