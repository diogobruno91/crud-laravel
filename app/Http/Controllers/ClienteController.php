<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'razao_social' => 'required|string|max:255',
            'cnpj'         => 'required|string|max:18|unique:clientes,cnpj',
            'email'        => 'required|string|email|max:255|unique:clientes,email',
        ], [
            'razao_social.required' => 'O campo Razão Social é obrigatório.',
            'razao_social.string'   => 'O campo Razão Social deve ser uma string.',
            'razao_social.max'      => 'O campo Razão Social não pode ter mais que 255 caracteres.',
            'cnpj.required'         => 'O campo CNPJ é obrigatório.',
            'cnpj.cnpj'             => 'O campo CNPJ deve ser um CNPJ válido.',
            'cnpj.unique'           => 'O CNPJ informado já está cadastrado.',
            'email.required'        => 'O campo E-mail é obrigatório.',
            'email.email'           => 'O campo E-mail deve ser um endereço de e-mail válido.',
            'email.max'             => 'O campo E-mail não pode ter mais que 255 caracteres.',
            'email.unique'          => 'O E-mail informado já está cadastrado.',
        ]);
        
        $newcliente = Cliente::create($request->all());
        
        return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso.');
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'razao_social' => 'required|string|max:255',
            'cnpj'         => 'required|string|max:18|unique:clientes,cnpj,' . $id,
            'email'        => 'required|string|email|max:255|unique:clientes,email,' . $id,
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente deletado com sucesso.');
    }

    public function filter(Request $request)
    {
        $clientes = Cliente::query()
        ->when($request->filled('razao_social'), function ($query) use ($request) {
            $query->where('razao_social', 'like', '%' . $request->input('razao_social') . '%');
        })
        ->when($request->filled('cnpj'), function ($query) use ($request) {
            $query->where('cnpj', 'like', '%' . $request->input('cnpj') . '%');
        })
        ->when($request->filled('email'), function ($query) use ($request) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        })
        ->get();

        return view('clientes.index', compact('clientes'));
    }
}
