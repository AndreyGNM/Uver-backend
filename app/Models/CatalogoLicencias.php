<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoLicencias extends Model
{
    use HasFactory;
    protected $table = 'catalogoLicencias'; 

    protected $fillable = [
        'licencia',
    ];

    public function usuarios()
    {
        return $this->hasMany(Usuarios::class, 'licencia');
    }

}
