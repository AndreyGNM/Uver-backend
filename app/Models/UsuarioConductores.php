<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioConductores extends Model
{
    use HasFactory;

    protected $table = 'usuarioConductores'; 

    protected $primaryKey = 'cedula';

    protected $fillable = [
        'cedula',
        'cuentaBancaria',
        'licencia',
        'telefono',
    ];

    public function catalogoLicencias()
    {
        return $this->belongsTo(CatalogoLicencias::class, 'licencia');
    }

    public function vehiculos()
    {
        return $this->hasMany(Vehiculos::class, 'propietario', 'cedula');
    }

    public function viajes()
    {
        return $this->hasMany(Viajes::class, 'conductor', 'cedula');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'telefono', 'telefono');
    }
}
