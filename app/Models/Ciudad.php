<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudades';
    protected $primaryKey = 'id_ciudad';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'coordenada_x',
        'coordenada_y',
    ];

    public function propiedades()
    {
        return $this->hasMany(Propiedad::class, 'id_ciudad', 'id_ciudad');
    }

    public function usuariosProcedencia()
    {
        return $this->hasMany(Usuario::class, 'id_procedencia', 'id_ciudad');
    }

    public function usuariosResidencia()
    {
        return $this->hasMany(Usuario::class, 'id_residencia', 'id_ciudad');
    }
}
