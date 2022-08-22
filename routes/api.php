<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

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
Route::post('add-payee-step1',[InvoiceController::class,'add_payee']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('create-ticket',[TicketController::class,'create_ticket']);
Route::post('ticket-message',[TicketController::class,'ticket_message']);
Route::get('view-ticket/{id?}',[TicketController::class,'is_view_ticket']);

Route::get('products',[ProductController::class,'index']);
