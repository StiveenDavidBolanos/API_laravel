<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    use HasFactory;

    protected $table = 'favoritos';
    protected $primaryKey = 'id_favorito';
    public $timestamps = true;

    protected $fillable = [
        'id_usuario',
        'id_propiedad',
        'fecha'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'id_propiedad', 'id_propiedad');
    }
}
