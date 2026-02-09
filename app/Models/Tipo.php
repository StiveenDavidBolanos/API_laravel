<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    // Definimos explícitamente la tabla si no sigue la convención (aunque 'tipos' es estándar para 'Tipo')
    protected $table = 'tipos';

    // Importante: Definir la llave primaria personalizada
    protected $primaryKey = 'idTipo';

    protected $fillable = [
        'tipo',
        'descripcion',
    ];

    /**
     * Relación con Propiedades
     */
    public function propiedades()
    {
        // Primer argumento: Modelo relacionado
        // Segundo argumento: Foreign Key en la tabla 'propiedades' (idtipo)
        // Tercer argumento: Local Key en la tabla 'tipos' (idTipo)
        return $this->hasMany(Propiedad::class, 'idtipo', 'idTipo');
    }
}
