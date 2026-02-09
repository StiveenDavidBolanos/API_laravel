<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $table = 'contactos';
    protected $primaryKey = 'id_contacto';
    public $timestamps = true;

    protected $fillable = [
        'id_usuario_contactado',
        'id_usuario_contactador',
        'id_propiedad',
        'fecha'
    ];

    public function usuarioContactado()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_contactado', 'id_usuario');
    }

    public function usuarioContactador()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_contactador', 'id_usuario');
    }

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'id_propiedad', 'id_propiedad');
    }
}
