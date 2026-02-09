<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    use HasFactory;

    protected $table = 'propiedades';
    protected $primaryKey = 'id_propiedad';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'descripcion',
        'direccion',
        'idtipo',
        'precio',
        'coordenada_x',
        'coordenada_y',
        'id_ciudad',
        'id_usuario',
        'banos',
        'dormitorios',
        'bano_compartido',
        'amoblado',
        'dueno_residente',
        'servicios_incluidos',
        'cocina_separada',
        'horario_limitado',
        'aire_acondicionado',
        'permite_mascotas',
        'corriente_220',
        'disponible',
        'verificado',
        'destacado'
    ];

    // Relaciones
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'id_ciudad', 'id_ciudad');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class, 'id_propiedad', 'id_propiedad');
    }

    public function favoritos()
    {
        return $this->hasMany(Favorito::class, 'id_propiedad', 'id_propiedad');
    }

    public function contactos()
    {
        return $this->hasMany(Contacto::class, 'id_propiedad', 'id_propiedad');
    }
}
