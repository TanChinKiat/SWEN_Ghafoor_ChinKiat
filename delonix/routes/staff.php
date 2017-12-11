<?php

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

/*
Route::get('/', 'Controller@home');
Route::post('/view-prices', 'Controller@viewPrices');
Route::post('/book', 'Controller@book');
*/
Route::get('/staff', 'Controller@staffHome');
Route::get('/staff/manage-room', 'Controller@manageRooms');
Route::get('/staff/sign-out', 'Controller@signOut');

Route::post('/staff/manage-room', 'Controller@manageRooms2');
Route::get('/staff/manage-booking', 'Controller@manageBookings');
Route::get('/staff/manage-booking/{transaction_id}', 'Controller@viewBooking');
Route::post('/staff/manage-booking', 'Controller@manageBookings3');

Route::post('/staff/update-booking', 'Controller@updateBooking');
Route::post('/staff/update-customer', 'Controller@updateCustomer');
Route::get('/staff/delete-booking/{transaction_id}', 'Controller@deleteBooking');

Route::get('/staff/manage-staff', 'Controller@listStaff');
Route::post('/staff/update-staff', 'Controller@updateStaff');
Route::post('/staff/new-staff', 'Controller@newStaff');

Route::get('/staff/delete-staff/{staffid}', 'Controller@deleteStaff');
