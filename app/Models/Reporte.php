<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $table = 'reportes';
    protected $primaryKey = 'id_reporte';
    public $timestamps = true;

    protected $fillable = [
        'id_reportante',
        'id_reportado',
        'id_propiedad',
        'id_motivo',
        'descripcion',
        'evidencia_url',
        'activo',
        'fecha',
    ];

    // Relaciones
    public function reportante()
    {
        return $this->belongsTo(Usuario::class, 'id_reportante');
    }

    public function reportado()
    {
        return $this->belongsTo(Usuario::class, 'id_reportado');
    }

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'id_propiedad');
    }

    public function motivo()
    {
        return $this->belongsTo(Motivo::class, 'id_motivo');
    }
}
