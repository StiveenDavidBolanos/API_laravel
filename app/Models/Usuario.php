<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'contrasena',
        'id_residencia',
        'id_procedencia',
        'fecha_nacimiento',
    ];
    protected $with = [];
    protected $appends = [];


    protected $hidden = ['contrasena'];

    // 🔐 Indicar a Laravel qué campo es la contraseña
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
    // Relaciones
    public function propiedades()
    {
        return $this->hasMany(Propiedad::class, 'id_usuario', 'id_usuario');
    }

    public function ciudadProcedencia()
    {
        return $this->belongsTo(Ciudad::class, 'id_procedencia', 'id_ciudad');
    }

    public function ciudadResidencia()
    {
        return $this->belongsTo(Ciudad::class, 'id_residencia', 'id_ciudad');
    }

    public function fotos()
    {
        return $this->hasMany(Foto::class, 'id_usuario', 'id_usuario');
    }

    public function calificacionesDadas()
    {
        return $this->hasMany(Calificacion::class, 'id_usuario_calificador', 'id_usuario');
    }

    public function calificacionesRecibidas()
    {
        return $this->hasMany(Calificacion::class, 'id_usuario_calificado', 'id_usuario');
    }

    public function favoritos()
    {
        return $this->hasMany(Favorito::class, 'id_usuario', 'id_usuario');
    }

    public function contactosRealizados()
    {
        return $this->hasMany(Contacto::class, 'id_usuario_contactador', 'id_usuario');
    }

    public function contactosRecibidos()
    {
        return $this->hasMany(Contacto::class, 'id_usuario_contactado', 'id_usuario');
    }
}
