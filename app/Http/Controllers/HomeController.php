<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $table1Count = User::count();
        $table2Count = Habitacion::count();
        // Agregar más cuentas de tablas según sea necesario

        return view('home', compact('table1Count', 'table2Count'));
    }
}
