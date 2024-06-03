<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoModelos extends Model
{
    use HasFactory;

    protected $table = 'catalogoModelos'; 

    protected $fillable = [
        'modelo',
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculos::class, 'modelo');
    }
}
