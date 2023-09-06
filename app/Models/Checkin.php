<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    use HasFactory;
    protected $table = 'checkins';
    protected $primarykey = 'id';
    protected $fillable = ['fecIngreso', 'idReserva'];
    protected $guarded = [];
    public $timestamps=false;

    const Activo = 1;
    const Inactivo = 0;

    public function getEstadoTextoAttribute()
    {
        switch ($this->estado) {
            case Checkin::Activo:
                return 'Activo';
            case Checkin::Inactivo:
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
