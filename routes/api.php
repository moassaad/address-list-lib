<?php

use App\Http\Controllers\API\AddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::controller(AddressController::class)->middleware(['auth'])->group(function () {
Route::controller(AddressController::class)->prefix('address/country')->group(function () {
    Route::get('/', 'countryList');
    Route::get('/{code}', 'countryCode');
    Route::get('/{countryCode}/governorate', 'governorateList');
    Route::get('/{countryCode}/governorate/{code}', 'governorateCode');
    Route::get('/{countryCode}/governorate/{governorateCode}/city', 'cityList');
    Route::get('/{countryCode}/governorate/{governorateCode}/city/{code}', 'cityCode');

});
