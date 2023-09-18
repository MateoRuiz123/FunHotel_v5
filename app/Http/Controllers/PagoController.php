<?php

namespace App\Http\Controllers;

use App\Models\pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagos = Pago::all();
        return view('pagos.index', compact('pagos'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pagos = new Pago();
        $pagos-> nombre = $request->input('nombre');
        $pagos-> estado = Pago::Activo;
        $pagos->save();
        // return redirect()->back()->with('success', 'Pago creado correctamente');
        return redirect()->route('pagos.index')->with('success', 'Pago creado correctamente');
        //
    }

    public function update(Request $request, $id)
    {
        $pagos = Pago::find($id);
        $pagos-> nombre = $request->input('nombre');
        $pagos-> estado = $request->input('estado');
        $pagos->update();
        // return redirect()->back()->with('success', 'Pago actualizado correctamente');
        return redirect()->route('pagos.index')->with('success', 'Pago actualizado correctamente');
        //
    }

    public function destroy($id)
    {
        $pagos = Pago::find($id);
        $pagos->delete();
        // return redirect()->back()->with('success', 'Pago eliminado correctamente');
        return redirect()->route('pagos.index')->with('success', 'Pago eliminado correctamente');
        //
    }
}
