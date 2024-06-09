<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Usuarios;

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
}
