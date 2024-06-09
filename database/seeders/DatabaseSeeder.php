<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Modelos
        DB::table('catalogoModelos')->insert([
            ['modelo' => 'Toyota'],
            ['modelo' => 'Honda'],
            ['modelo' => 'Nissan'],
        ]);

        //Licencias
        DB::table('catalogoLicencias')->insert([
            ['licencia' => 'B1'],
            ['licencia' => 'B2'],
            ['licencia' => 'A1'],
            ['licencia' => 'A2'],
            ['licencia' => 'A3'],
        ]);

        //Usuarios
        DB::table('usuarios')->insert([
            [
                'telefono' => 12345678,
                'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'email' => 'juan.perez@example.com'
            ],
            [
                'telefono' => 87654321,
                'nombre' => 'Maria',
                'apellido' => 'Gómez',
                'email' => 'maria.gomez@example.com'
            ],
        ]);

        //Conductores
        DB::table('usuarioConductores')->insert([
            [
                'cedula' => 118760258,
                'cuentaBancaria' => '1234-5678-9012-3456',
                'licencia' => 1,
                'telefono' => 12345678
            ],
            [
                'cedula' => 118765858,
                'cuentaBancaria' => '2345-6789-0123-4567',
                'licencia' => 2, 
                'telefono' => 87654321
            ],
        ]);

        //Vehiculos
        DB::table('vehiculos')->insert([
            [
                'placa' => 'ABC-123',
                'modelo' => 1,  
                'propietario' => 118760258,
                'cantidadPasajeros' => 7
            ],
            [
                'placa' => 'DEF-456',
                'modelo' => 2, 
                'propietario' => 118765858,
                'cantidadPasajeros' => 5
            ],
        ]);
    }
}
