<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculos extends Model
{
    use HasFactory;

    protected $table = 'vehiculos'; 

    protected $primaryKey = 'placa';

    protected $fillable = [
        'placa',
        'modelo',
        'propietario',
        'cantidadPasajeros',
    ];

    public function catalogoModelo()
    {
        return $this->belongsTo(CatalogoModelos::class, 'modelo');
    }

    public function usuarioConductor()
    {
        return $this->belongsTo(UsuarioConductores::class, 'propietario', 'cedula');
    }
}
