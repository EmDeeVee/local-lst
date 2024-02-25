<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SubscribersController;

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

Route::get('/get/subscriber', ['SubscriberController::class', 'index']);
Route::post('/post/subscriber', ['SubscriberController::class', 'store']);
Route::delete('/delete/subscriber/{id}', ['SubscriberController::class', 'destroy']);

Route::get('/get/mailinglist', ['MailingListController::class', 'index']);
Route::post('/post/mailinglist', ['MailingListController::class', 'store']);
Route::delete('/delete/mailinglist/{id}', ['MailingListController::class', 'destroy']);
