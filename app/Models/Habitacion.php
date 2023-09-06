<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Habitacion extends Model
{
    use HasFactory;

    protected $table = "habitaciones";
    protected $primaryKey = 'id';
    protected $fillable = [
        'numeroHabitacion',
        'descripcion',
        'estado'
    ];
    public $timestamps = false;
    protected $guarded = [];
    
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'idCategoria', 'id');
    }
    
    const Disponible = 1;
    const Ocupado = 2;
    const Mantenimiento = 3;
    public function getEstadoTextoAttribute()
    {
        switch ($this->estado) {
            case Habitacion::Disponible:
                return 'Disponible';
            case Habitacion::Ocupado:
                return 'Ocupado';
            case Habitacion::Mantenimiento:
                return 'Mantenimiento';
            default:
                return 'Desconocido';
        }
    }

    public static function getEstadoValue($estado)
    {
        switch ($estado) {
            case 'Disponible':
                return 1;
            case 'Ocupado':
                return 2;
            case 'Mantenimiento':
                return 3;
            default:
                return 0; // Valor por defecto si el estado no coincide con ninguno de los valores anteriores
        }
    }


}
