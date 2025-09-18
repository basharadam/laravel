<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RFQController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\POController;

use App\Models\RFQ;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function () {
    return response()->json([   
        'message' => 'Laravel API is working ✅',
        'timestamp' => now(),
    ]);
});
Route::post('/rfqs', [RFQController::class, 'store']);
Route::post('/bids', [BidController::class, 'store']);
Route::get('/rfqs', function () {
    return RFQ::all();
});

Route::get('/rfqs/{id}/bids', [BidController::class, 'listByRFQ']);
Route::post('/bids/{id}/approve', [BidController::class, 'approve']);
Route::post('/bids/{id}/reject', [BidController::class, 'reject']);

Route::post('/purchase-orders', [POController::class, 'store']);
// routes/api.php
Route::get('/rfqs/buyer', function () {
    return RFQ::all(); // optionally: ->where('buyer_id', auth()->id())
});

Route::get('/vendor-pos/{vendor_name}', [POController::class, 'vendorPOs']);
Route::post('/vendor-po-status', [POController::class, 'updateStatus']);

Route::post('/buyer-po-payment', [POController::class, 'confirmPayment']);
Route::get('/buyer-pos', [POController::class, 'allPOs']); // for listing
