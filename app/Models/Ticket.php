<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    #relacion 1 a muchos inversa (PERTENECE A UNA SUBCATEGORIA)
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
    #relacion 1 a muchos inversa (PERTENECE A UN LEVEL)
    public function level(){
        return $this->belongsTo(Level::class);
    }
    #relacion 1 a muchos inversa (PERTENECE A UN COnTACTO)
    public function contact(){
        return $this->belongsTo(Contact::class);
    }
    #relacion 1 a muchos inversa (PERTENECE A UN USUARIO SOPORTE)
    public function support(){
        return $this->belongsTo(User::class,'support_id');
    }
    #relacion 1 a muchos inversa (PERTENECE A UN USUARIO CLIENTE)
    public function client(){
        return $this->belongsTo(User::class,'client_id');
    }

    public function setTitleShort($title){
        return mb_strimwidth($title, 0,20,'...');
    }
    public function getIncident(){
        if ($this->active ==0) {
            return 'RESUELTO';
        }
        if ($this->support_id) {
            return "ASIGNADO";
        }

        return 'PENDIENTE';
    }
    public function getSupport(){
        #metodo support creado arriba
        if ($this->support) {
            return $this->support->name;
        }
        return 'SIN ASIGNAR';
    }
    public function setSeverity($sevetiry){
        switch ($sevetiry) {
            case 1:
                return 'BAJA';
            case 2:
                return 'MEDIA';
            default:
                return 'ALTA';
        }
    }
}
