<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $table = 'reservas';
    protected $primarykey = 'id';
    protected $fillable = ['fecIngreso', 'fecSalida', 'estado',];
    protected $guarded = [];
    public $timestamps = false;

    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class, 'idHabitacion', 'id');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'idServicio', 'id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente', 'id');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleReserva::class, 'idReserva');
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
