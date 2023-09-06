<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $table = 'servicios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'created_at',
    ];
    public $timestamps = false;
    protected $guarded = [];

    const Activo = 1;
    const Inactivo = 0;

    public function getEstadoTextoAttribute()
    {
        switch ($this->estado) {
            case Servicio::Activo:
                return 'Activo';
            case Servicio::Inactivo:
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

    public function detalles()
    {
        return $this->hasMany(DetalleReserva::class, 'idServicio');
    }


    public function ventas()
    {
        return $this->belongsToMany(Venta::class, 'ventas_servicios', 'servicio_id', 'venta_id');
    }
}
