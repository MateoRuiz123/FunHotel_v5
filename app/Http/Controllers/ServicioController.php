<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:servicio-list|servicio-create|servicio-edit|servicio-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:servicio-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:servicio-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:servicio-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicios = Servicio::all();
        return view('servicios.index', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('servicios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $servicio = new Servicio();
        $servicio->nombre = $request->input('nombre');
        $servicio->descripcion = $request->input('descripcion');
        $servicio->precio = $request->input('precio');
        $servicio->created_at = $request->input('created_at');
        $servicio->estado = Servicio::Activo;
        $servicio->save();
        return redirect()->back()->with('success', 'Servicio creado exitosamente');
        // return dd
        // return dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Servicio $servicio)
    {
        return view('servicios.show', compact('servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $servicio)
    {
        return view('servicios.edit', compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servicio $servicio)
    {
        $servicio = Servicio::find($servicio->id);
        $servicio->nombre = $request->input('nombre');
        $servicio->descripcion = $request->input('descripcion');
        $servicio->precio = $request->input('precio');
        $servicio->estado = $request->input('estado');
        $servicio->update();
        return redirect()->back()->with('success', 'Servicio actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servicio $servicio)
    {
        $servicio = Servicio::find($servicio->id);
        $servicio->delete();
        return redirect()->back()->with('success', 'Servicio eliminado exitosamente');
    }
}
