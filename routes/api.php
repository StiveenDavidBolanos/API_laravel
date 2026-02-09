<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CiudadController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PropiedadController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\MotivoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| AUTH (PÚBLICO)
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('tipos', TipoController::class)->only(['index', 'show']);


/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS (INVITADOS)
|--------------------------------------------------------------------------
| Accesibles sin iniciar sesión
*/
Route::apiResource('ciudades', CiudadController::class)->only(['index', 'show']);

Route::apiResource('propiedades', PropiedadController::class)->only([
    'index',
    'show',
]);
Route::get('/usuarios/{id}/foto', [FotoController::class, 'porUsuario']);

// Obtener propiedades por ciudad
Route::get('/ciudades/{id}/propiedades', [CiudadController::class, 'propiedadesPorCiudad']);

// Motivos (por ejemplo, para reportes)
Route::apiResource('motivos', MotivoController::class)->only(['index', 'show']);
Route::get('/test-drive', [PropiedadController::class, 'testDrive']);
Route::apiResource('calificaciones', CalificacionController::class);
Route::apiResource('usuarios', UsuarioController::class)->only([
    'show',
]);
/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS (USUARIO AUTENTICADO)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {


    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    /*
    |--------------------------------------------------------------------------
    | PERFIL / USUARIOS
    |--------------------------------------------------------------------------
    */
    Route::apiResource('usuarios', UsuarioController::class)->only([
        'update',
    ]);

    /*
    |--------------------------------------------------------------------------
    | PROPIEDADES (GESTIÓN DEL PROPIETARIO)
    |--------------------------------------------------------------------------
    */
    Route::apiResource('propiedades', PropiedadController::class)->only([
        'store',
        'update',
        'destroy',
    ]);
    Route::apiResource('tipos', TipoController::class)->only(['update', 'store', 'destroy']);

    Route::patch('/propiedades/{id}/activar', [PropiedadController::class, 'activar']);
    Route::patch('/propiedades/{id}/desactivar', [PropiedadController::class, 'desactivar']);

    /*
    |--------------------------------------------------------------------------
    | IMÁGENES / FOTOS
    |--------------------------------------------------------------------------
    */
    Route::apiResource('imagenes', ImagenController::class);
    Route::apiResource('fotos', FotoController::class);
    Route::get('/usuarios/{id}/foto', [FotoController::class, 'porUsuario']);

    /*
    |--------------------------------------------------------------------------
    | INTERACCIÓN ENTRE USUARIOS
    |--------------------------------------------------------------------------
    */
    Route::apiResource('favoritos', FavoritoController::class);
    Route::apiResource('contactos', ContactoController::class);
    Route::get('/contactos/{id}', [ContactoController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    | REPORTES
    |--------------------------------------------------------------------------
    */
    Route::apiResource('reportes', ReporteController::class)->only([
        'store',
        'index',
        'show',
    ]);

    Route::get('/usuarios/{id}/reportes-recibidos', [ReporteController::class, 'reportesRecibidos']);
    Route::get('/usuarios/{id}/reportes-enviados', [ReporteController::class, 'reportesEnviados']);
    Route::patch('/reportes/{id}/revisado', [ReporteController::class, 'marcarRevisado']);
    Route::get('/calificaciones/{id}', [CalificacionController::class, 'show']);
});
