<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servicio;
use App\Models\Cliente;

class Venta extends Model
{
    use HasFactory;
    protected $table = "ventas";
    protected $primaryKey = 'id';
    protected $fillable = ['fecha_venta', 'estado','idReserva'];
    protected $guarded = [];
    public $timestamps = false;


    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'ventas_servicios', 'venta_id', 'servicio_id');
    }

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'idReserva');
    }

    const Activo = 1;
    const Inactivo = 0;

    public function getEstadoTextoAttribute()
    {
        switch ($this->estado) {
            case Venta::Activo:
                return 'Activo';
            case Venta::Inactivo:
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
