<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Usuarios;
use App\Models\UsuarioConductores;
use App\Models\CatalogoLicencias;
use App\Models\Viajes;

class UverTest extends TestCase
{

    use RefreshDatabase;

    public function testCrearUsuarioExitosamente()
    {
        $payload = [
            'telefono' => 12345678,
            'nombre' => 'Carlos',
            'apellido' => 'Martinez',
            'email' => 'carlos.martinez@example.com',
        ];

        //dd($payload);

        $response = $this->postJson('/api/usuarios', $payload);

        $response->assertStatus(201)
                ->assertJson([
                    'message' => 'Usuario creado exitosamente',
                    'usuario' => [
                        'telefono' => $payload['telefono'],
                        'nombre' => $payload['nombre'],
                        'apellido' => $payload['apellido'],
                        'email' => $payload['email'],
                    ],
                ]);

        $this->assertDatabaseHas('usuarios', $payload);
    }

    
    public function testCrearUsuarioDuplicado()
    {
        // Crear un usuario inicial
        $usuario = Usuarios::create([
            'telefono' => 123456789,
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'email' => 'juan.perez@example.com',
        ]);

        // Intentar crear un usuario con el mismo telefono y email
        $payload = [
            'telefono' => 123456789,
            'nombre' => 'Carlos',
            'apellido' => 'Martinez',
            'email' => 'juan.perez@example.com',
        ];

        $response = $this->postJson('/api/usuarios', $payload);

        $response->assertStatus(400)
                 ->assertJsonStructure([
                     'errors' => [
                         'telefono',
                         'email',
                     ],
                 ]);
    }

    public function testCrearViajeExitosamente()
    {
        $licencia = CatalogoLicencias::create([
            'licencia' => 'B1'
        ]);
        
        $pasajero = Usuarios::create([
            'telefono' => 12345678,
            'nombre' => 'Carlos',
            'apellido' => 'Martinez',
            'email' => 'carlos.martinez@example.com',
        ]);

        $usuarioConductor = Usuarios::create([
            'telefono' => 87654321,
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'email' => 'juan.perez@example.com',
        ]);

        $conductor = UsuarioConductores::create([
            'cedula' => 118760258,
            'cuentaBancaria' => '1234-5678-9012-3456',
            'licencia' => $licencia->id,
            'telefono' => $usuarioConductor->telefono,
        ]);

        // Datos del viaje
        $payload = [
            'conductor' => $conductor->cedula,
            'pasajero' => $pasajero->telefono,
            'ubicacionPasajero' => 'Ubicacion A',
            'ubicacionDestino' => 'Ubicacion B',
            'estado' => false,
        ];

        //dd($payload);
        $response = $this->postJson('/api/viajes', $payload);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Viaje creado exitosamente',
                     'viaje' => [
                         'conductor' => $payload['conductor'],
                         'pasajero' => $payload['pasajero'],
                         'ubicacionPasajero' => $payload['ubicacionPasajero'],
                         'ubicacionDestino' => $payload['ubicacionDestino'],
                         'estado' => $payload['estado'],
                     ],
                 ]);

        $this->assertDatabaseHas('viajes', [
            'conductor' => $payload['conductor'],
            'pasajero' => $payload['pasajero'],
            'ubicacionPasajero' => $payload['ubicacionPasajero'],
            'ubicacionDestino' => $payload['ubicacionDestino'],
            'estado' => $payload['estado'],
        ]);
    }

    public function testGetTravel()
    {
        $licencia = CatalogoLicencias::create([
            'licencia' => 'B1'
        ]);

        $pasajero = Usuarios::create([
            'telefono' => 12345678,
            'nombre' => 'Carlos',
            'apellido' => 'Martinez',
            'email' => 'carlos.martinez@example.com',
        ]);

        $usuarioConductor = Usuarios::create([
            'telefono' => 87654321,
            'nombre' => 'Carlos',
            'apellido' => 'Martinez',
            'email' => 'carlos.martinez@example.com',
        ]);

        $conductor = UsuarioConductores::create([
            'cedula' => 987654321,
            'cuentaBancaria' => '123-456-789',
            'licencia' => $licencia -> id, 
            'telefono' => $usuarioConductor -> telefono,
        ]);

        $viaje = Viajes::create([
            'conductor' => $conductor->cedula,
            'pasajero' => $pasajero->telefono,
            'ubicacionPasajero' => 'Ubicación de Carlos',
            'ubicacionDestino' => 'Destino de Carlos',
            'estado' => false,
        ]);

        // Hacer una solicitud GET para obtener los detalles del viaje
        $response = $this->getJson("/api/viajes/{$viaje->id}");

        // Verificar la respuesta
        $response->assertStatus(200)
                 ->assertJson([
                     'viaje' => [
                         'id' => $viaje->id,
                         'conductor' => $viaje->conductor,
                         'pasajero' => $viaje->pasajero,
                         'ubicacionPasajero' => $viaje->ubicacionPasajero,
                         'ubicacionDestino' => $viaje->ubicacionDestino,
                         'estado' => $viaje->estado,
                     ]
                 ]);
    }
}
