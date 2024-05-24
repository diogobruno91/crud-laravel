<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Cliente;

class ClienteTest extends TestCase
{

    /** @test */
    public function it_can_create_a_cliente()
    {
        $cliente = Cliente::factory()->create([
            'razao_social' => 'Empresa Exemplo',
            'cnpj' => '12.345.678/0001-99',
            'email' => 'email@example.com',
        ]);

        $this->assertDatabaseHas('clientes', [
            'razao_social' => 'Empresa Exemplo',
            'cnpj' => '12.345.678/0001-99',
            'email' => 'email@example.com',
        ]);
    }

    /** @test */
    public function it_can_update_a_cliente()
    {
        $cliente = Cliente::factory()->create();

        $cliente->update([
            'razao_social' => 'Empresa Atualizada',
            'cnpj' => '98.765.432/0001-11',
            'email' => 'updated@example.com',
        ]);

        $this->assertDatabaseHas('clientes', [
            'razao_social' => 'Empresa Atualizada',
            'cnpj' => '98.765.432/0001-11',
            'email' => 'updated@example.com',
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