<?php

use App\Events\BroadcastingMessageToUser;
use Illuminate\Support\Facades\Route;
use App\Events\PrivateOrderShipmentEvent;
use App\Http\Controllers\Public\NotificationController;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Not;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   return view('welcome');
});

//////////////////////////public channel///////////////////////////
Route::get('notification-sender', function () {
    $keyword = request("message");
    event(new BroadcastingMessageToUser($keyword));
});
Route::get('/notification/{id}', [NotificationController::class , 'getNotificationPage']);

Route::get('/get_message' ,[NotificationController::class , 'getMyMessage']);
Route::post('/get_message' ,[NotificationController::class , 'insertMessage'])->name('users.store');


///////////////////////////end public channel////////////////////////////////


Route::get('/get_page_private', [NotificationController::class , 'getNotificationPagePrivate'])->middleware(['auth']);
Route::get('/get_message_private' ,[NotificationController::class , 'getMyMessagePrivate']);
Route::post('/get_message_private' ,[NotificationController::class , 'insertMessagePrivate'])->name('message.store.private');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('page_order' , function(){
    $userId = request("user_id");

    $keyword = request("message");

    event(new PrivateOrderShipmentEvent($userId,$keyword));
    return "event has been fired";
});

