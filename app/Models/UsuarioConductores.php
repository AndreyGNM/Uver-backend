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
}
