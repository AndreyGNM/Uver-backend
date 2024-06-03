<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Viajes extends Model
{
    use HasFactory;

    protected $table = 'viajes'; 

    protected $fillable = [
        'conductor',
        'pasajero',
        'ubicacionPasajero',
        'ubicacionDestino',
        'estado',
    ];

    public function usuarioConductor()
    {
        return $this->belongsTo(UsuarioConductores::class, 'conductor', 'cedula');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'pasajero', 'telefono');
    }
    
 public function casts():array //castea el booleano de estado de 0-1 a true or false.
 {
    return [
        'estado' => 'boolean',
        
    ];
 }
}
