
<?php

/*
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\UserController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('client')->group(function(){
    //End points Estudiantes
    Route::get('/estudiantes',[EstudianteController::class,'index']);
    Route::post('/estudiantes', [EstudianteController::class, 'store']);
    Route::get('/estudiantes/{id}', [EstudianteController::class, 'show']);
    Route::put('/estudiantes/{id}', [EstudianteController::class, 'update']);
    Route::delete('/estudiantes/{id}', [EstudianteController::class, 'destroy']);

    // Endpoints de usuarios
    Route::get('/usuarios', [UserController::class, 'index']);
    Route::post('/usuarios', [UserController::class, 'store']);
    Route::get('/usuarios/{id}', [UserController::class, 'show']);
    Route::put('/usuarios/{id}', [UserController::class, 'update']);
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy']);

});
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Rutas API versión 1
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Rutas públicas
    |--------------------------------------------------------------------------
    */

    Route::post('/login', [AuthController::class, 'login']);

    /*
    |--------------------------------------------------------------------------
    | Rutas protegidas por Passport
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth:api')->group(function () {

        /*
         * Autenticación
         */
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);

        /*
         * Estudiantes
         */
        Route::get('/estudiantes', [EstudianteController::class, 'index']);
        Route::post('/estudiantes', [EstudianteController::class, 'store']);
        Route::get('/estudiantes/{id}', [EstudianteController::class, 'show']);
        Route::put('/estudiantes/{id}', [EstudianteController::class, 'update']);
        Route::delete('/estudiantes/{id}', [EstudianteController::class, 'destroy']);

        /*
         * Usuarios
         */
        Route::get('/usuarios', [UserController::class, 'index']);
        Route::post('/usuarios', [UserController::class, 'store']);
        Route::get('/usuarios/{id}', [UserController::class, 'show']);
        Route::put('/usuarios/{id}', [UserController::class, 'update']);
        Route::delete('/usuarios/{id}', [UserController::class, 'destroy']);
    });
});




/*
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\EstudiantesController;
use App\Http\Controllers\UserController;

Route::prefix('v1')->group(function () {

    Route::post('/login', [AuthController::class, 'login']);

});


Route::prefix('v1')->middleware('auth:api')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource(
        'estudiantes',
        EstudiantesController::class
    );

    Route::apiResource(
        'usuarios',
        UserController::class
    );

});
*/