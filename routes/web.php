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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/test_mongo', 'MailController@testMongo');

Route::post('/send_email', 'MailController@sendMail');

Route::get('/cache', 'MailController@cache');

Route::post('/sendHtmlMail', 'MailController@sendHtmlMail');

Route::post('/create_account', 'MailController@createAccount');