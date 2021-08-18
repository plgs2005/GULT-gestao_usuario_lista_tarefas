<?php

use App\Mail\newEmailGult;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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


Route::get('/envio-email', function(){
    
  $user = new stdClass();    
    $user->name = 'Pedro Lucas';
    $user->email = 'plgsantos@icloud.com';

  /*   return new newEmailGult($user); */
 
  Mail::send($user);
});