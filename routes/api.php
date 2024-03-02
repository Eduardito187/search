<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CustomValidateToken;
use App\Http\Middleware\AdminValidateToken;
use App\Http\Controllers\Api\System;
use App\Http\Controllers\Api\Search\Product as SearchProduct;
use App\Http\Controllers\Api\Import\Process as SearchProccess;
use App\Http\Controllers\Api\System\Core as SystemCore;

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

Route::middleware([CustomValidateToken::class])->group(function () {
    Route::controller(System::class)->group(function() {
        Route::get('system/getAllIp', 'getAllIp');
        Route::get('system/getAllConfig', 'getAllConfig');
        Route::get('system/getAllMigrations', 'getAllMigrations');
        Route::get('system/getAllRestictIp', 'getAllRestictIp');
        Route::get('system/getAllRestictDomain', 'getAllRestictDomain');
    });
    Route::controller(SearchProduct::class)->group(function() {
        Route::post('search/productFeed', 'searchProductFeed');
        Route::post('search/productResult', 'searchProductResult');
        Route::post('search/getFiltersPage', 'getFiltersPage');
    });
    Route::controller(SearchProccess::class)->group(function() {
        Route::post('import/importSingle', 'importSingle');
        Route::post('import/importCollection', 'importCollection');
        Route::post('import/importIndexSearch', 'importIndexSearch');
        Route::post('import/updateStatusIndexSearch', 'updateStatusIndexSearch');
        Route::post('import/importAttributesFilter', 'importAttributesFilter');
        Route::post('import/importAttributesOrder', 'importAttributesOrder');
        Route::post('import/importAttributesSearch', 'importAttributesSearch');
        Route::post('import/importAttributesRulesExclude', 'importAttributesRulesExclude');
        Route::post('import/importAttributes', 'importAttributes');
        Route::post('import/disableSingleProduct', 'disableSingleProduct');
        Route::post('import/disableCollectionProduct', 'disableCollectionProduct');
        Route::post('import/desactivateSingleProduct', 'desactivateSingleProduct');
        Route::post('import/desactivateCollectionProduct', 'desactivateCollectionProduct');
        Route::post('import/deleteSingleProduct', 'deleteSingleProduct');
        Route::post('import/deleteCollectionProduct', 'deleteCollectionProduct');
    });
});

Route::middleware([AdminValidateToken::class])->group(function () {
    Route::controller(SystemCore::class)->group(function() {
        Route::post('system/createClient', 'createClient');
    });
});
