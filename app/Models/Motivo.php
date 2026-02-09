<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motivo extends Model
{
    use HasFactory;

    protected $table = 'motivos';
    protected $primaryKey = 'id_motivo';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id_motivo');
    }
}
