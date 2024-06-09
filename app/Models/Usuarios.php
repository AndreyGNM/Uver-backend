<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    protected $table = 'usuarios'; 

    protected $primaryKey = 'telefono';
    public $incrementing = false;

    protected $fillable = [
        'telefono',
        'nombre',
        'apellido',
        'email',
    ];

    public function viajes()
    {
        return $this->hasMany(Viajes::class, 'pasajero', 'telefono');
    }   
    
    public function usuarioConductor()
    {
        return $this->hasOne(UsuarioConductores::class, 'telefono', 'telefono');
    }
}
