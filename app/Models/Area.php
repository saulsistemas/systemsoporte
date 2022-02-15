<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name','company_id'];
    #relacion 1 a muchos inversa (PERTENECE A UNA EMPRESA)
    public function company(){
        return $this->belongsTo(Company::class);
    }
    
}
