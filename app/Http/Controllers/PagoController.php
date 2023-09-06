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
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
        return redirect()->back();
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pagos = Pago::find($id);
        $pagos-> nombre = $request->input('nombre');
        $pagos-> estado = $request->input('estado');
        $pagos->update();
        return redirect()->back();
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pagos = Pago::find($id);
        $pagos->delete();
        return redirect()->back();
        //
    }
}
