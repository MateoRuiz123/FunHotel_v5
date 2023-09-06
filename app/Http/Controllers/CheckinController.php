<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use Illuminate\Http\Request;
// reserva
use App\Models\Reserva;
// pago
use App\Models\Pago;

class CheckinController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:checkin-list|checkin-create|checkin-edit|checkin-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:checkin-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:checkin-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:checkin-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkins = Checkin::all();
        $reservas = Reserva::all();
        $pago = Pago::all();
        return view('checkins.index', compact('checkins', 'reservas', 'pago'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $checkins = new Checkin();
        $checkins-> fecIngreso = $request->input('ingreso');
        $checkins->idReserva = $request->input('reserva');
        $checkins->estado = Checkin::Activo;
        $checkins->save();
        return redirect()->back();
        //
    }

    public function update(Request $request, $id)
    {
        $checkins = Checkin::find($id);
        // $checkins-> fecIngreso = $request->input('ingreso');
        $checkins->idReserva = $request->input('reserva');
        $checkins->estado = $request->input('estado');
        $checkins->update();
        return redirect()->back();
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $checkins = Checkin::find($id);
        $checkins->delete();
        return redirect()->back();
        //
    }
}
