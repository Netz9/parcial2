<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Estudiante;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EstudianteControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_estudiantes()
    {
        // Crea múltiples estudiantes utilizando la fábrica
        $estudiantes = Estudiante::factory()->count(3)->create();

        $response = $this->get('/api/estudiantes');

        $response->assertStatus(200);
        // Asegúrate de que todos los estudiantes se devuelvan en la respuesta
        $response->assertJson($estudiantes->toArray());
    }

    /** @test */
    public function it_can_store_a_new_estudiante()
    {
        // Use the factory to create a new estudiante
        $data = Estudiante::factory()->make()->toArray();

        $response = $this->post('/api/estudiantes', $data);

        // Assert that the response status is 201 (Created)
        $response->assertStatus(201);

        // Assert that the data is in the database
        $this->assertDatabaseHas('estudiantes', $data);
    }


    /** @test */
    public function it_can_show_an_estudiante()
    {
        $estudiante = Estudiante::factory()->create();

        $response = $this->get('/api/estudiantes/' . $estudiante->id);

        $response->assertStatus(200);
        $response->assertJson($estudiante->toArray());
    }

    /** @test */
    public function it_returns_not_found_when_showing_non_existing_estudiante()
    {
        $response = $this->get('/api/estudiantes/999');

        $response->assertStatus(404);
        $response->assertJson(['error' => 'Estudiante no encontrado']);
    }

    /** @test */
    public function it_can_update_an_estudiante()
    {
        $estudiante = Estudiante::factory()->create();

        $data = [
            'nombre' => 'Carlos',
            'apellido' => 'Gómez',
            'email' => 'carlos@example.com',
            'telefono' => '0987654321',
            'direccion' => 'Calle Verdadera 456',
            'fecha_nacimiento' => '1999-12-31',
            'carrera' => 'Arquitectura',
            'semestre' => 4,
        ];

        $response = $this->put('/api/estudiantes/' . $estudiante->id, $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('estudiantes', $data);
    }

    /** @test */
    public function it_can_delete_an_estudiante()
    {
        $estudiante = Estudiante::factory()->create();

        $response = $this->delete('/api/estudiantes/' . $estudiante->id);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Estudiante eliminado correctamente']);
        $this->assertDatabaseMissing('estudiantes', ['id' => $estudiante->id]);
    }

    /** @test */
    public function it_returns_not_found_when_deleting_non_existing_estudiante()
    {
        $response = $this->delete('/api/estudiantes/999');

        $response->assertStatus(404);
        $response->assertJson(['error' => 'Estudiante no encontrado']);
    }
}
