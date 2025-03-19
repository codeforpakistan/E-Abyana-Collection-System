<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AssignRController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegionAdministration\DivsionController;
use App\Http\Controllers\RegionAdministration\DistrictController;
use App\Http\Controllers\RegionAdministration\TahsilController;
use App\Http\Controllers\RegionAdministration\HalqaController;

use App\Http\Controllers\RegionAdministration\CanalController;
use App\Http\Controllers\RegionAdministration\CanalOutLet;
use App\Models\Cropprice;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/irrigators', [ApiController::class, 'getIrrigators']);
    Route::get('/land-surveys', [ApiController::class, 'getLandSurveys']);
    Route::get('/surveys/{id}', [ApiController::class, 'getSurveyById']);
    Route::get('/survey-bill/{id}', [ApiController::class, 'getSurveyBill']);
});

Route::post('/login', [ApiController::class, 'make_login']);
Route::middleware('auth:sanctum')->post('/logout', [Login::class, 'logout']);

Route::post('AddRoles/add', [RulesController::class, 'storeRoles'])->name('AddRoles.add');
Route::post('AddPermission/add', [PermissionController::class, 'storePermission'])->name('AddPermission.add');
Route::post('AssignRoles_Permission/add', [ApiController::class, 'storeAssignRoles'])->name('AssignRoles_Permission.add');
Route::post('AddUser/add', [ApiController::class, 'storeUser'])->name('AddUser.add');
Route::post('AddDivsion/add', [DivsionController::class, 'StoreDivsion'])->name('AddDivsion.add');
Route::post('AddDistrict/add', [DistrictController::class, 'StoreDistrict'])->name('AddDistrict.add');
Route::post('/AddTahsil/add', [TahsilController::class, 'storeTehsil']);
Route::post('AddHalqa/add', [HalqaController::class, 'storeHalqa'])->name('AddHalqa.add');
Route::get('getDivision', [ApiController::class, 'getDivisions']);
Route::post('AddTahsil/add', [TahsilController::class, 'StoreTehsil'])->name('AddTahsil.add');
Route::post('/village', [ApiController::class, 'StoreVillage']);



Route::match(['get', 'post',], 'canals', [ApiController::class, 'handleCanals']);
Route::match(['get', 'put', 'delete'], 'canals/{id?}', [ApiController::class, 'handleCanals']);

Route::match(['get', 'post',], 'cropprice', [ApiController::class, 'handleCropPrice']);
Route::match(['get', 'put', 'delete'], 'cropprice/{id?}', [ApiController::class, 'handleCropPrice']);
Route::match(['get', 'post',], 'outlet', [ApiController::class, 'handleOutlet']);
Route::match(['get', 'put', 'delete'], 'outlet/{id?}', [ApiController::class, 'handleOutlet']);

// Route::post('CanalOutlet/add', [ApiController::class, 'storeOutlet'])->name('CanalOutlet.add');
Route::get('/districts', [ApiController::class, 'getDistricts']);
Route::get('/getTahsils', [ApiController::class, 'getTahsilData']);
Route::get('/getHalqaData', [ApiController::class, 'getHalqaData']);

Route::get('/getvillageData', [ApiController::class, 'getvillageData']);
Route::get('/villages', [ApiController::class, 'getVillagesWithTehsil']);

Route::post('/AddIrragtor', [ApiController::class, 'storeIrrigator']);
Route::get('/roles', [ApiController::class, 'getRoles']);
Route::get('/permissions', [ApiController::class, 'getPermissions']);
Route::get('/getuserData', [ApiController::class, 'listUsers']);

Route::post('/storesurvey', [ApiController::class, 'storesurvey']);

Route::match(['get', 'post',], 'crops', [ApiController::class, 'manageCrop']);
Route::match(['get', 'put', 'delete'], 'crops/{id?}', [ApiController::class, 'manageCrop']);
// Route::get('/outlets', [ApiController::class, 'getOutlets']);





//










