<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\User;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        $table1Count = User::count();
        $table2Count = Habitacion::count();
        // Agregar más cuentas de tablas según sea necesario

        return view('inicio', compact('table1Count', 'table2Count'));
    }
}
