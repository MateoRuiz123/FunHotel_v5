<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:cliente-list|cliente-create|cliente-edit|cliente-delete', ['only' => ['index', ' show']]);
        $this->middleware('permission:cliente-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:cliente-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:cliente-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cliente = Cliente::create([
            'primerNombre' => $request->input('primernombre'),
            'segundoNombre' => $request->input('segundonombre'),
            'primerApellido' => $request->input('primerapellido'),
            'segundoApellido' => $request->input('segundoapellido'),
            'documento' => $request->input('tipodocumento'),
            'numeroDocumento' => $request->input('documento'),
            'celular' => $request->input('celular'),
            'correo' => $request->input('correo'),
            'estado' => Cliente::Activo,
        ]);

        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente');
    }


    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        // return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        // return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        $cliente->primerNombre = $request->input('primernombre');
        $cliente->segundoNombre = $request->input('segundonombre');
        $cliente->primerApellido = $request->input('primerapellido');
        $cliente->segundoApellido = $request->input('segundoapellido');
        $cliente->documento = $request->input('documento');
        $cliente->numeroDocumento = $request->input('numeroDocumento');
        $cliente->celular = $request->input('celular');
        $cliente->correo = $request->input('correo');
        // $cliente->estado = $request->input('estado') ? 1 : 2;
        $cliente->estado = $request->input('estado');
        $cliente->update();
        return redirect()->back()->with('success', 'Cliente actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente = Cliente::find($cliente->id);
        $cliente->delete();
        return redirect()->back()->with('success', 'Cliente eliminado exitosamente');
    }
}
