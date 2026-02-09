<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;

    protected $table = 'calificaciones';
    protected $primaryKey = 'id_calificacion';
    public $timestamps = true;

    protected $fillable = [
        'calificacion',
        'id_usuario_calificador',
        'id_usuario_calificado',
        'resena',
    ];

    public function usuarioCalificador()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_calificador', 'id_usuario');
    }

    public function usuarioCalificado()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_calificado', 'id_usuario');
    }
}
