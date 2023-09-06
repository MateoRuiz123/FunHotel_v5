<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Venta;
use App\Models\Servicio;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Reserva;
use Carbon\Carbon;

class VentaControlador extends Controller
{
    function __construct()
    {
        $this->middleware('permission:venta-list|venta-create|venta-edit|venta-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:venta-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:venta-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:venta-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with('reserva')->get();
        return view('ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $reservas = Reserva::all();
        $servicios = Servicio::all();

        return view('ventas.create', compact('reservas','servicios'));
    }
    public function obtenerInformacionReserva($id)
    {
        $reserva = Reserva::find($id);
        $idCliente = $reserva->idCliente;
        $cliente = Cliente::find($idCliente);
        $servicio = Servicio::find($reserva->idServicio);

        return response()->json([
            'reserva' => $reserva,
            'cliente' => $cliente,
            'servicio' => $servicio,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $venta = new Venta();
        $venta->fecha_venta = $request->input('fecha_venta');
        $venta->estado = Venta::Activo;
        $venta->idReserva = $request->input('idReserva');
        $venta->save();
        $servicios = $request->input('servicios');
        $venta->servicios()->attach($servicios);

        $serviciosElegidos = [];
        if ($request->filled('servicios')) {
            foreach ($request->input('servicios') as $servicioId) {
                $servicio = Servicio::find($servicioId);
                $serviciosElegidos[] = $servicio;
            }
        }
        return redirect()->route('ventas.index')->with('mensaje', 'Venta creada con éxito');
    }

    public function show(Venta $venta, Request $request)
    {
        $clientes = Cliente::all();
        $servicios = Servicio::all();
        return view('ventas.show', compact('venta', 'clientes','servicios'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        $clientes = Cliente::all();
        return view('ventas.update', compact('venta', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        $venta->estado = $request->input('estado');
        $venta->save();
        return redirect()->route('ventas.index')->with('mensaje', 'Venta Actualizar con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        $venta->servicios()->detach();
        $venta->delete();
        return redirect()->back()->with('mensaje', 'Venta eliminada con éxito');
    }
}
