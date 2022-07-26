<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/buscas',[apiController::class,'buscas']);
Route::post('/cep',[apiController::class,'index']);
Route::put('/insertbusca',[apiController::class,'insertbuscas']);
Route::delete('/deletaBusca',[apiController::class,'deletebusca']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
