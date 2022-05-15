<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReceiveController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\RequisitionController;

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
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::resource('/item', ItemController::class);
    Route::resource('/supplier', SupplierController::class);
    Route::resource('/receive', ReceiveController::class);
    Route::resource('/requisition', RequisitionController::class);
    Route::resource('/issue', IssueController::class);
    Route::resource('/stock', StockController::class);
    Route::post('/get_receive_item_for_requisition', [ReceiveController::class,'receiveItemForRequisition']);
    Route::post('/requisition_approve/{id}', [RequisitionController::class,'requisitionApprove']);
    Route::post('/search_requisition', [RequisitionController::class,'searchRequisition']);
    Route::post('/get_requisition_item_for_issue', [IssueController::class,'requisitionItemForIssue']);
});

