<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClienteFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_cliente()
    {
        $response = $this->post('/clientes', [
            'razao_social' => 'Empresa Exemplo',
            'cnpj'         => '12.345.678/0001-99',
            'email'        => 'email@example.com',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('clientes', [
            'razao_social' => 'Empresa Exemplo',
            'cnpj'         => '12.345.678/0001-99',
            'email'        => 'email@example.com',
        ]);
    }

    /** @test */
    public function it_can_update_a_cliente()
    {
        $cliente = Cliente::factory()->create();

        $response = $this->put("/clientes/{$cliente->id}", [
            'razao_social' => 'Empresa Atualizada',
            'cnpj'         => '98.765.432/0001-11',
            'email'        => 'updated@example.com',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('clientes', [
            'razao_social' => 'Empresa Atualizada',
            'cnpj'         => '98.765.432/0001-11',
            'email'        => 'updated@example.com',
        ]);
    }

    /** @test */
    public function it_can_delete_a_cliente()
    {
        $cliente = Cliente::factory()->create();

        $this->assertDatabaseHas('clientes', [
            'id' => $cliente->id,
        ]);

        $response = $this->delete("/clientes/{$cliente->id}");

        $response->assertStatus(302);

        $this->assertSoftDeleted($cliente);
    }
}