<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $table = 'checkouts';
    protected $primarykey = 'id';
    protected $fillable = ['fecSalida'];
    protected $guarded = [];
    public $timestamps = false;

    // checkin
    public function checkin()
    {
        return $this->belongsTo(Checkin::class, 'idCheckin', 'id');
    }

    // metodo de pago
    public function metpago()
    {
        return $this->belongsTo(Pago::class, 'idMetodoPago', 'id');
    }

    //venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'idVenta', 'id');
    }

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'idReserva', 'id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente', 'id');
    }

    const Activo = 1;
    const Inactivo = 0;

    public function getEstadoTextoAttribute()
    {
        switch ($this->estado) {
            case Reserva::Activo:
                return 'Activo';
            case Reserva::Inactivo:
                return 'Inactivo';
            default:
                return 'Desconocido';
        }
    }

    public static function getEstadoValue($estado)
    {
        switch ($estado) {
            case 'Activo':
                return 1;
            case 'Inactivo':
                return 0;
            default:
                return 69; // Valor por defecto si el estado no coincide con ninguno de los valores anteriores
        }
    }
}
