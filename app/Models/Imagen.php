<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;

    protected $table = 'imagenes';
    protected $primaryKey = 'id_imagen';
    public $timestamps = true;

    protected $fillable = [
        'id_propiedad',
        'url',
    ];

    // Relación correcta: una imagen pertenece a una propiedad
    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'id_propiedad', 'id_propiedad');
    }
}
