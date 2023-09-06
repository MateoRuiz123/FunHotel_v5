<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleReserva extends Model
{
    protected $table = 'detalle_reserva';

    protected $fillable = ['idReserva', 'idServicio', 'precio', 'cantidad'];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'idReserva');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'idServicio');
    }
}